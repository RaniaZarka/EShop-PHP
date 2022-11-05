<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <div class="logo">Admin</div>

   
      <div class="icons">
         <div id="user-btn" class="fas fa-user"></div>
         <a style=" text-decoration:none;
             color: var(--black);
             font-size: 1.3rem;
             margin: 1.2rem;"
    href="../home.php"><i class="fas fa-solid fa-house-user fa-2xl"></i> </a>
      
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
        
         <div class="flex-btn">
          
         <a href="admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
           
         </div>
      </div>

   </section>

</header>