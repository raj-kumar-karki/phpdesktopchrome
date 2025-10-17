<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE name = '$name' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, password, user_type) VALUES('$name','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
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

   <center><h1 class="heading"><span data-key="account">Welcome - Developer </span></h1>
     



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
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
   <h3 data-key="register_title">दर्ता गर्नुहोस्</h3>
   <input type="text" name="name" required placeholder="तपाईको नाम राखुनुहोस्" data-placeholder-en="Enter your name" data-placeholder-ne="तपाईको नाम राखुनुहोस्">
   <input type="password" name="password" required placeholder="पासवर्ड राखुनुहोस्" data-placeholder-en="Enter password" data-placeholder-ne="पासवर्ड राखुनुहोस्">
   <input type="password" name="cpassword" required placeholder="फेरि पासवर्ड पुष्टि गर्नुहोस् " data-placeholder-en="Confirm password" data-placeholder-ne="फेरि पासवर्ड पुष्टि गर्नुहोस्">
   <select name="user_type">
      <option value="user" data-key="user">प्रयोगकर्ता</option>
      <option value="admin" data-key="admin">व्यवस्थापक</option>
   </select>
   <input type="submit" name="submit" value="register now" class="form-btn" data-key="register_button">
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
      account:"Welcome - Developer",
      church_name: "New Life Church",
      register_title: "Register Now",
      user: "User",
      admin: "Admin",
      register_button: "Register"
   },
   ne: {
      account:"स्वागतम् - विकासकर्ता",
      church_name: "नव जीवन मण्डली",
      register_title: "अहिले दर्ता गर्नुहोस्",
      register_button: "दर्ता गर्नुहोस्",
      user: "प्रयोगकर्ता",
      admin: "व्यवस्थापक"
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



   

  



      





