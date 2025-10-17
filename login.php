<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $pass = md5($_POST['password']);

 // 🔹 Default hardcoded admin (raj / 123)
   if($name === 'Developer' && $_POST['password'] === 'develop123'){
      $_SESSION['admin_name'] = $name;
      header('location:adminregister.php');
      exit;
   }

   $select = " SELECT * FROM user_form WHERE name = '$name' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:believer.php');
         exit;

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:ubeliever.php');
         exit;

      }
     
   }else{
      $error[] = 'incorrect name or password!';
   }

};
?>

<style>
.lang-switcher {
   margin-left: 20px;
   display: flex;
   gap: 10px;
   margin-top: -30px;
}
.lang-switcher button {
   padding: 5px 10px;
   border: none;
   border-radius: 5px;
   cursor: pointer;
   background: #4CAF50;
   color: white;
   font-size: 14px;
}
.lang-switcher button:hover {
   background: #2e7d32;
}

</style>
<header class="header">
   
   <section class="flex1">

       <center> <a href="login.php" class="logo"><span data-key="church_name">नव जीवन मण्डली</span></a></center>
   
     <div class="lang-switcher">
      <h1>Language:</h1>
   <button id="lang-en">English</button>
   <button id="lang-ne">नेपाली</button>
</div>
      </section>

</header>   

<section class="home-grid">

   <center><h1 class="heading"><span data-key="account">Login Page</span></h1>
     



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
 <style>
      body{
   background-color: var(--light-bg);
   padding-left: 0;
      }

   .form-container1 {
   min-height: 64.1vh;
   display: flex;
   align-items: center;
   justify-content: center;
   /* padding:20px;
   padding-bottom: 60px; */
}

.form-container1 form{
   padding:20px;
   border-radius: 25px;
   box-shadow: 0 5px 10px rgba(0,0,0,.1);
   background: #fff;
   text-align: center;
   width: 500px;
}

.form-container1 form h3{
   font-size: 30px;
   text-transform: uppercase;
   margin-bottom: 10px;
   color:#333;
}

.form-container1 form input,
.form-container1 form select{
   width: 100%;
   padding:10px 15px;
   font-size: 17px;
   margin:8px 0;
   background: #eee;
   border-radius: 5px;
}

.form-container1 form select option{
   background: #fff;
}

.form-container1 form .form-btn{
   background: #fbd0d9;
   color:crimson;
   text-transform: capitalize;
   font-size: 20px;
   cursor: pointer;
}

.form-container1 form .form-btn:hover{
   background: crimson;
   color:#fff;
}

.form-container1 form p{
   margin-top: 10px;
   font-size: 20px;
   color:#333;
}

.form-container1 form p a{
   color:crimson;
}

.form-container1 form .error-msg{
   margin:10px 0;
   display: block;
   background: crimson;
   color:#fff;
   border-radius: 5px;
   font-size: 20px;
   padding:10px;

}
   </style>
</head>
<body>


   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style1.css">

<!-- <br> -->
   
 <div class="form-container1">

   <form action="" method="post">
      <h3 data-key="register_title">login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="name" name="name" required placeholder="तपाईको नाम राखुनुहोस्" data-placeholder-en="Enter your name" data-placeholder-ne="तपाईको नाम राखुनुहोस्">
      <input type="password" name="password" required placeholder="पासवर्ड राखुनुहोस्" data-placeholder-en="Enter password" data-placeholder-ne="पासवर्ड राखुनुहोस्">
      <input type="submit" name="submit" value="login now" class="form-btn" data-key="register_button">
      <!-- <p>don't have an account?<a href="developerlogin.php">register now</a></p> -->
   </form>
  </div>
   
</section>

<!-- <br><br><br><br><br><br><br><br><br> -->
<footer class="footer">

   &copy; copyright @ 2025 by <span>New Life Church</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script>
   
 const translations = {
   en: {
      account:"Login Page",
      church_name: "New Life Church",
      register_title: "Login Now",
      register_button: "Login"
   },
   ne: {
      account:"लगइन पृष्ठ",
      church_name: "नव जीवन मण्डली",
      register_title: "अहिले    लगइन गर्नुहोस्",
      register_button: "लगइन गर्नुहोस्"
   }
};

function setLanguage(lang) {
   // Normal text (with data-key)
   document.querySelectorAll("[data-key]").forEach(el => {
      const key = el.getAttribute("data-key");
      if(translations[lang][key]){
         el.textContent = translations[lang][key];
      }
   });

   // Placeholders
   document.querySelectorAll("[data-placeholder-en]").forEach(el => {
      el.placeholder = el.getAttribute(`data-placeholder-${lang}`);
   });

   // Save choice
   localStorage.setItem("language", lang);
}

// Event listeners
document.getElementById("lang-en").addEventListener("click", () => setLanguage("en"));
document.getElementById("lang-ne").addEventListener("click", () => setLanguage("ne"));

// Load saved or default Nepali
setLanguage(localStorage.getItem("language") || "ne");
</script>   

   
</body>
</html>