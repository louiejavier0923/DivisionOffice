<?php
           
    if($_FILES['file']['error'] > 0){
   
    }
    else{
               $sourcefile= $_FILES['file']['name'];
               $tempfile= $_FILES['file']['tmp_name'];


              rename_appending_unique_id($sourcefile, $tempfile);
    }

    function rename_appending_unique_id($source, $tempfile){
               $fileName='';
               $target_path ='../../files/appfiles/'.$source;
                while(file_exists($target_path)){
                     $fileName = uniqid().'-'.$source;
                     $target_path = ('../../files/appfiles/'.$fileName);
                  }

    move_uploaded_file($tempfile, $target_path);
    print_r($fileName);

}

     
?>