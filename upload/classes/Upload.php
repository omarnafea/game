<?php
/**
 * Created by PhpStorm.
 * User: ultimate-pc
 * Date: 2022/04/08
 * Time: 03:59 م
 */

class Upload
{

     static function uploadImage($file){
         $output=array();
         $allowed_extension=array('jpeg','jpg','png');

         $imageName=$file['name'];
         $imageSize=$file['size'];
         $imageTempName=$file['tmp_name'];

         $image_extension=explode('.',$imageName );

         $image_extension=strtolower(end($image_extension));  // the capital extension may be make an error

         if(!empty($imageName) &&  ! in_array($image_extension, $allowed_extension)){
             $output['success']=false;
             $output['error']='This extension Is Not Allowed';
             return  $output;
         }

         if(!empty($imageName) && $imageSize > 4194304){
             $output['success']=false;
             $output['error']='Image Size Must Be Less Than 4MB';
             return  $output;
         }

         $images_folder =  $_SERVER['DOCUMENT_ROOT'] . "/game/upload/images/";


         $Image=rand(0,1000000).'_'.strtolower($imageName);

         $Image=str_replace(' ','',$Image);
         move_uploaded_file($imageTempName,  $images_folder.$Image);


         $HTTP_HOST =  $_SERVER['HTTP_HOST'];
         $uploadImagePath = "http://{$HTTP_HOST}/game/upload/images/" . $Image;

         $output['success']=true;
         $output['image']=$uploadImagePath;
         return $output;

     }


     static function uploadVoice($file){

         $output=array();
         $allowed_extension=array('mp3');

         $imageName=$file['name'];
         $imageSize=$file['size'];
         $imageTempName=$file['tmp_name'];

         $image_extension=explode('.',$imageName );

         $image_extension=strtolower(end($image_extension));  // the capital extension may be make an error

         if(!empty($imageName) &&  ! in_array($image_extension, $allowed_extension)){
             $output['success']=false;
             $output['error']='This extension Is Not Allowed';
             return  $output;
         }

         if(!empty($imageName) && $imageSize > 9194304){
             $output['success']=false;
             $output['error']='Image Size Must Be Less Than 4MB';
             return  $output;
         }

         $images_folder =  $_SERVER['DOCUMENT_ROOT'] . "/game/upload/voices/";


         $Image=rand(0,1000000).'_'.strtolower($imageName);

         $Image=str_replace(' ','',$Image);
         move_uploaded_file($imageTempName,  $images_folder.$Image);


         $HTTP_HOST =  $_SERVER['HTTP_HOST'];
         $uploadVoicePath = "http://{$HTTP_HOST}/game/upload/voices/" . $Image;

         $output['success']=true;
         $output['voice']=$uploadVoicePath;
         return $output;
     }
}