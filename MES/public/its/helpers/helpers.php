<?php 

function display_errors($errors){
  $display ='<ul class="bg-danger">';
  foreach($errors as $error){
    $display .='<li class= "text-danger">'.$error.'</li>';
  }
  $display .='</ul>';
  return $display;
}

function display_sucess($sucess){
  $display ='<ul class="bg-success">';
  foreach($sucess as $success){
    $display .='<li class= "text-success">'.$success.'</li>';
  }
  $display .='</ul>';
  return $display;
}

?>