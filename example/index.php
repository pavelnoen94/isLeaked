<?php 
include_once("../pwnedChecker.php");

function sanitizerHTML($string){
  return htmlspecialchars($string);
}

function print_rejected($reason){
  switch ($reason) {
    case "leaked":
      print("<div><label>password has been leaked. Choose another password </label></div>");
      break;
    
    case "error":
    print("<div><label>password check is broken for some reason. Changing password and registration is temporary closed.</label></div>");
  }
}

function print_accepted(){
  print("<div><label>password has not been leaked yet. Registration successful </label></div>");
}

$UNSAFE_password = $_POST["password"];
$password = sanitizerHTML($UNSAFE_password, ENT_QUOTES);

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>isLeaked</title>
   </head>
   <body>
     
     <div class="">
       
     <form class="" action="index.php" method="post">
       
       <label for="password">Password:</label>
       <input type="password" name="password">
       <input type="submit" name="">
       
     </form>
   </div>
   <div class="">
     
     <?php 
     
switch (isLeaked($password)) {
  
  case -1:
    // error. Good luck debugging
    print_rejected("error");
    break;
    
  case 0:
    // password has not been leaked yet
    print_accepted("ok");
    // register($password); how ever you like
    break;
  
  default:
    // password has been leaked
    print_rejected("leaked");
    break;
}
     
      ?>
      </div>
   </body>
 </html>
