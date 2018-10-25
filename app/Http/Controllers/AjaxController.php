<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller {
   public function index(){
      $msg = "This is a simple message.";
      return response()->json(array('msg'=> $msg), 200);
   }
   public function store(){
        if($_FILES['file']['name'] != '')  
 {  
      $extension = end(explode(".", $_FILES['file']['name']));  
      $allowed_type = array("jpg", "jpeg", "png", "gif");  
      if(in_array($extension, $allowed_type))  
      {  
           $new_name = rand() . "." . $extension;  
           $path = "images/" . $new_name;  
           if(move_uploaded_file($_FILES['file']['tmp_name'], $path))  
           {  
                echo '  
                     <div class="col-md-8">       
                          <img src="'.$path.'" class="img-responsive" />  
                     </div>  
                     <div class="col-md-4">  
                          <button type="button" data-path="'.$path.'" id="remove_button" class="btn btn-danger">x</button>  
                     </div>  
                     ';  
           }  
      }  
      else  
      {  
           echo '<script>alert("Invalid File Formate")</script>';  
      }  
 }  
 else  
 {  
      echo '<script>alert("Please Select File")</script>';  
 }  


   }




}