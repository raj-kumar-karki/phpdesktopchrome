<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>खाता</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   

   <style>
      body{
   background-color: var(--light-bg);
   padding-left: 20rem;
}

table {
    width: 90%;
    /* border-collapse: collapse; */
    margin-top: 20px;
    
}
th, td {
    padding: 10px;
    border: 1px solid #ccc;
    background: #f5f5f5ff;
    border-radius: 5px;
    font-size: 16px;
}
input, button, select {
    /* margin: 5px 0; */
    /* padding: 8px; */
    width: 100%;
    max-width: 400px;
}
form {
    /* margin-bottom: 10px; */
    border-radius: 5px;
}
a {
    margin-right: 10px;
    text-decoration: none;
    color: blue;
}
tfoot {
    font-weight: bold;
    background: #e6e6e6;
}

/* @media print {
  form, button {
    display: none;
  }
} */

  /* language  */

.lang-switcher {
   margin-left: 20px;
   display: flex;
   gap: 10px;
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

.side-bar .profile .image{
   height: 15rem;
   width: 15rem;
   border-radius: 50%;
   object-fit: contain;
   margin-bottom: -30px;
   margin-top: -15px;
}

button{
    margin: 5px 0;
    padding: 8px;
    /* width: 100%; */
    /* width: 15%; */
    font-size: 16px;
    border-radius:10px;
}

button {
    background: #6ff0dfff;
    border-radius: 10px;
}
.btn3:hover {
   background-color: var(--black);
   color: var(--white);
   cursor: pointer;
}
   </style>

</head>
<body>

<header class="header">
   
   <section class="flex">

   <div class="lang-switcher">
      <h1>Language:</h1>
   <button id="lang-en">English</button>
   <button id="lang-ne">नेपाली</button>
</div>

<script>
   
 const translations = {
   en: {
      name:"Name",
      account:"Account Details",
      church_name: "New Life Church",
      menu_believer: "Believer",
      menu_baptism: "Baptism",
      menu_offering: "Offering",
      menu_tithe: "Tithe",
      menu_expense: "Expense",
      menu_account: "Account",
      menu_contact: "Contact Us",
      register_title: "New Registration",
      pass:"Password",
      user:"User Types",
      action:"Action",
      delete:"Delete"
   },
   ne: {
      name:"नाम",
      account:"खाता विवरण",
      church_name: "नव जीवन मण्डली",
      menu_believer: "विश्वासी",
      menu_baptism: "बप्तिस्मा",
      menu_offering: "भेटी",
      menu_tithe: "दशांश",
      menu_expense: "खर्च",
      menu_account: "खाता",
      menu_contact: "सम्पर्क",
      register_title: "नयाँ खाता दर्ता गर्नुहोस्",
      pass:"पासवर्ड",
      user:"प्रयोगकर्ता",
      action:"कार्य",
      delete:"हटाउनुहोस्"
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

      <a href="account.php" class="logo"><span data-key="church_name">नव जीवन मण्डली</span></a>

      <!-- <form action="search.html" method="post" class="search-form">
         <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
         <button type="submit" class="fas fa-search"></button>
      </form> -->

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
         <!-- <img src="images/pic-1.jpg" class="image" alt=""> -->
         <h3 class="name">Username</h3>
         <p class="role">Admin:&nbsp;&nbsp;<?php echo $_SESSION['admin_name'] ?></p>
         <!-- <a href="profile.html" class="btn">view profile</a> -->
         <div class="flex-btn">
                <a href="logout.php" class="option-btn">logout</a>
            <!-- <a href="register.html" class="option-btn">register</a> -->
         </div>
      </div>

   </section>

</header>   

<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="images/logo.png" class="image" alt="">
   </div>

<nav class="navbar">
   <a href="believer.php"><i class="fas fa-user-friends"></i><span data-key="menu_believer">विश्वासी</span></a>
   <a href="baptism.php"><i class="fas fa-water"></i><span data-key="menu_baptism">बप्तिस्मा</span></a>
   <a href="offer.php"><i class="fas fa-donate"></i><span data-key="menu_offering">भेटी</span></a>
   <a href="tithe.php"><i class="fas fa-hand-holding-usd"></i><span data-key="menu_tithe">दशांश</span></a>
   <a href="expense.php"><i class="fas fa-receipt"></i><span data-key="menu_expense">खर्च</span></a>
   <a href="schedule.php"><i class="fas fa-calendar-alt"></i><span data-key="menu_contact">सूची</span></a>
   <a href="account.php" class="active"><i class="fas fa-user-cog"></i><span data-key="menu_account">खाता</span></a>
</nav>

</div>


<section class="home-grid">

   <h1 class="heading"><span data-key="account">खाता विवरण</span></h1>

</section>




  





 

<center><button class="btn3" onclick="window.location.href='register.php'" data-key="register_title">नयाँ खाता दर्ता गर्नुहोस्</button></center>
<center>
<div class="container1">

</center>
<center>
<table>
    <thead>
        <tr>
            <th data-key="name">नाम</th>
            <th data-key="pass">पासवर्ड</th>
            <th data-key="user">प्रयोगकर्ता</th>
            <th data-key="action">कार्य</th>
        </tr>
    </thead>
    <tbody>
<?php
$total = 0;
$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM user_form ";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()):
?>
    <tr>
        <td><center><?= $row['name'] ?></center></td>
        <td><center><?= htmlspecialchars($row['password']) ?></center></td>
        <td><center><?= $row['user_type'] ?></center></td>
        <td>
           <center> 
            <button class="btn3" onclick="window.location.href='delaccount.php?id=<?= $row['id'] ?>'" onclick="return confirm('Delete this entry?')" data-key="delete">हटाउनुहोस्</button></center>
        </td>
    </tr>
<?php endwhile; ?>
    </tbody>    
   
</table></center>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer class="footer">

   &copy; copyright @ 2025 by <span>New Life Church</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>