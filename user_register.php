<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name']; 
   $email = $_POST['email'];
   $pass = sha1($_POST['pass']);
   $cpass = sha1($_POST['cpass']);
   $address = $_POST['address']; 
   $phone = $_POST['phone'];

   $checkMail= preg_match ( '/^[a-z\d._-]+@([a-z\d-]+\.)+[a-z]{2,6}$/i' , $email ) ;
   $checkPassword=preg_match ('/^.{6,}$/', $pass);
   $checkPhone=preg_match('/^[0-9]{8}$/', $phone );
   
   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email already exists';
   }else
      if($pass != $cpass){
         $message[] = 'confirm password not matched';
      }else
         if($checkMail==0){
            $message[]='Invalid email format';
         }else
            if($checkPassword==0){
               $message[]='Password should be at least 6 characters';
            } else
            if($checkPhone==0){
               $message[]='Phone number should be 8 digits';
            }else
            {
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password, address, phone) VALUES(?,?,?,?,?)");
         $insert_user->execute([$name, $email, $cpass, $address, $phone]);
         $message[] = 'Successfully registered. Please login';
      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirm your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="address" name="address" required placeholder="enter your address" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="phone" name="phone" required placeholder="enter your phone number" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" class="btn" name="submit">
      <p>already have an account?</p>
      <a href="user_login.php" class="option-btn">Login</a>
   </form>

</section>

<script src="js/script.js"></script>

</body>
</html>