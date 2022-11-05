<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


   if(isset($_POST['add_to_cart'])){

    if($user_id == ''){
       header('location:user_login.php');
    }else{
 
       $pid = $_POST['pid'];
       $pid = filter_var($pid, FILTER_SANITIZE_STRING);
       $name = $_POST['name'];
       $name = filter_var($name, FILTER_SANITIZE_STRING);
       $price = $_POST['price'];
       $price = filter_var($price, FILTER_SANITIZE_STRING);
       $image = $_POST['image'];
       $image = filter_var($image, FILTER_SANITIZE_STRING);
       $qty = $_POST['qty'];
       $qty = filter_var($qty, FILTER_SANITIZE_STRING);
 
       $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
       $check_cart_numbers->execute([$name, $user_id]);
 
       if($check_cart_numbers->rowCount() > 0){
          $message[] = 'already added to cart!';
       }else{
 
          $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
          $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
          $message[] = 'added to cart!';         
       }
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'user_header.php'; ?>


<div class="home-bg">
<section class="products">

   <h1 class="heading">Laptop </h1>
   <div class="categories" style= "display: flex;
    font-size: 2rem;
    margin: 1rem;
    justify-content: center";>
    <a href="shop.php" style="padding-right: 2rem">All Products </a> 
    <a href="watch.php" style="padding-right: 2rem"> Watch </a>  
    <a href="mobile.php"> Mobile phone </a>
</div>
   <div class="box-container">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE category='Laptop'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">  
      <input type="hidden" name="details" value="<?= $fetch_product['details']; ?>"> 

      <img src="images/<?= $fetch_product['image']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><?= $fetch_product['price']; ?><span>kr</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">Empty!</p>';
   }
   ?>

   </div>

</section>

</div>

<script src="js/script.js"></script>

</body>
</html>