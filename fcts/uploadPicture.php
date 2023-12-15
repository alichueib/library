<?php
    function uploadPicture($pic){
        //1st.Let's retrieve data from $pic
        $picName=$pic['name'];
        $picSize=$pic['size'];
        $picType=$pic['type'];
        $tempDestination=$pic['tmp_name'];
        $picError=$pic['error'];

        $picExt=explode(".",$picName); // this will give me array of two elements, one before . and the second after
        $actualExt=strtolower(end($picExt));//this will get the extension type
        $actualName=reset($picExt); // this will get the name with no extension

        //Now we will declare an array and initialise it with allowed extensions
        $allowedExt=array("jpg","jpeg","png");

        if(in_array($actualExt,$allowedExt)){//This will check if the ext entered by user is in the array allowed
            if($picError==0){//here if I got an error I didn't proceed
                if($picSize<50000000){//If the file is greater than 50MegaByte then dont proceed

                    //Everything is fine -> proceed!
                    //let's generate an new name, so that if a user entered similar name, then I can have unique photos
                    $generatedName=$actualName ."_". uniqid('',true). ".".$actualExt; //uniqid will give a nb based on current time in milliseconds , so impossible for repition
                    $actualDestination="images/".$generatedName;
                    move_uploaded_file($tempDestination,$actualDestination);//at first the file is put in a temp destination, now we have to move it to our desired destination
                    return $generatedName; // I have returned the name so that I can use it in the database
                
                }else{
                    return -1;//size
                }
            }else{
                return -1;//error
            }
        }else{
            return -1;//extension
        }
    }