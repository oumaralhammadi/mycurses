<?php 

function upload_file($files, $allowed_exs, $path){

    $name       = $files['name'];
    $tmp_name   = $files['tmp_name'];
    $error      = $files['error'];

    if($error === 0){

        $file_ex = pathinfo($name, PATHINFO_EXTENSION);
        $file_ex_lc = strtolower($file_ex);
        if(in_array($file_ex_lc,$allowed_exs)){
            $new_file_name = uniqid("",true).".".$file_ex_lc ;
            $file_upload_path = "../uploads/".$path.'/'.$new_file_name ;
            move_uploaded_file($tmp_name,  $file_upload_path);
            // success msg 
            $sm['status'] = 'success';
            $sm['data']   = $new_file_name;
            return $sm ;
        }else{
            // error msg 
            $em['status'] = 'error';
            $em['data']   = 'You Cant upload files of this type';
            return $em ;
        }

    }else{
        // error msg 
        $em['status'] = 'error';
        $em['data']   = 'Error occurred while uploading';
        return $em ;
    }
}









?>