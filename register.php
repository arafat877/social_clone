<?php
//Connection Variable
$con = mysqli_connect("localhost", "root", "", "social");

//If error connecting to DB:
if(mysqli_connect_errno()) {
  echo "Failed to connect: " . mysqli_connect_errno();
}

//Variable Declaration
$fname = ''; //First Name
$lname = ''; //Last Name
$em = ''; //Email
$em2 = ''; //Email Confirm
$password = ''; //Password
$password2 = ''; //Password Confirm
$date = ''; //Registration Date
$error_array = ''; //Error Message Holding

//Form Handling
if(isset($_POST['register_button'])) {
  //Registration button has been clicked ...
    //First Name
    $fname = strip_tags($_POST['reg_fname']); //strip_tags removes HTML tags
    $fname = str_replace(' ', '', $fname); //remove spaces
    $fname = ucfirst(strtolower($fname)); //capitalize first letter after complete lowercase

    //Last Name
    $lname = strip_tags($_POST['reg_lname']); //strip_tags removes HTML tags
    $lname = str_replace(' ', '', $lname); //remove spaces
    $lname = ucfirst(strtolower($lname)); //capitalize first letter after complete lowercase

    //Email
    $em = strip_tags($_POST['reg_email']); //strip_tags removes HTML tags
    $em = str_replace(' ', '', $em); //remove spaces
    $em = ucfirst(strtolower($em)); //capitalize first letter after complete lowercase

    //Email Confirmation
    $em2 = strip_tags($_POST['reg_email2']); //strip_tags removes HTML tags
    $em2 = str_replace(' ', '', $em2); //remove spaces
    $em2 = ucfirst(strtolower($em2)); //capitalize first letter after complete lowercase

    //Password & Confirmation
    $password = strip_tags($_POST['reg_password']); //strip_tags removes HTML tags
    $password2 = strip_tags($_POST['reg_password2']); //strip_tags removes HTML tags

    //Date
    $date = date("Y-m-d"); //Date Formatting of current date

    // Validation of Email
    if($em == $em2) {
      if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
        $em = filter_var($em, FILTER_VALIDATE_EMAIL);
        //Query for email in database
        $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'"); //If false, account can be created
        $num_rows = mysqli_num_rows($e_check); //If zero, false
          if ($num_rows > 0) {
            echo "Email already in use."
          }
      } else {
        echo "Invalid e-mail format."
      }
    } else {
      echo "Emails do not match."
    }

}

 ?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Social</title>
  </head>
  <body>
    <form action="register.php" method="POST">
      <input type="text" name="reg_fname" placeholder="First Name" required>
      <br>
      <input type="text" name="reg_lname" placeholder="Last Name" required>
      <br>
      <input type="email" name="reg_email" placeholder="Email" required>
      <br>
      <input type="email" name="reg_email2" placeholder="Confirm Email" required>
      <br>
      <input type="password" name="reg_password" placeholder="Password" required>
      <br>
      <input type="password" name="reg_password2" placeholder="Confirm Password" required>
      <br>
      <input type="submit" name="register_button" value="Register">
    </form>
  </body>
</html>