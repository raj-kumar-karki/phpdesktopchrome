<?php
// 🚨 Make sure there is NOTHING (no space/newline) before this line
@include 'config.php';
session_start();

// check if admin logged in
if(!isset($_SESSION['admin_name'])){
   header('Location: login.php');
   exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM members WHERE id = $id");
$record = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $baptism_date = $_POST['baptism_date'];

    $stmt = $conn->prepare("UPDATE members SET name=?, dob=?, address=?, contact=?, baptism_date=? WHERE id=?");
    $stmt->bind_param("sssssi", $name,$dob,$address,$contact,$baptism_date, $id);
    $stmt->execute();

    header("Location: baptism.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>बप्तिस्मा</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   

   <style>
      body{
   background-color: var(--light-bg);
   padding-left: 20rem;
}
.form-container1 {
   /* min-height: 68.1vh; */
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

table {
    width: 90%;
    border-collapse: collapse;
    margin-top: 20px;
    
}
th, td {
    padding: 10px;
    border: 1px solid #ccc;
    background: #b4f8e9ff;
    border-radius: 5px;
    font-size: 16px;
}
input, button, select {
    margin: 5px 0;
    padding: 8px;
    /* width: 100%; */
    max-width: 400px;
    font-size: 16px;
    border-radius: 10px;
}

button {
    background: #6ff0dfff;
    border-radius: 10px;
}

form {
    margin-bottom: 10px;
    border-radius: 5px;
}
a {
    margin-right: 10px;
    text-decoration: none;
    color: blue;
    font-size: 16px;
}
tfoot {
    font-weight: bold;
    background: #e6e6e6;
}

@media print {
  form, button {
    display: none;
  }
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
      account:"Baptism Details",
      church_name: "New Life Church",
      menu_believer: "Believer",
      menu_baptism: "Baptism",
      menu_offering: "Offering",
      menu_tithe: "Tithe",
      menu_expense: "Expense",
      menu_account: "Account",
      menu_contact: "Schedule",
      register_title: "Register Now",
      user: "User",
      admin: "Admin",
      register_button: "Register Now",
      edit:"Update",
      part:"Date of Birth",
      action:"Action",
      act:"Address",
      name:"Name",
      number:"Contact",
      date:"Date of Baptism"
   },
   ne: {
      account:"बप्तिस्माकाे विवरण",
      church_name: "नव जीवन मण्डली",
      menu_believer: "विश्वासी",
      menu_baptism: "बप्तिस्मा",
      menu_offering: "भेटी",
      menu_tithe: "दशांश",
      menu_expense: "खर्च",
      menu_account: "खाता",
      menu_contact: "सूची",
      register_title: "दर्ता गर्नुहोस्",
      user: "प्रयोगकर्ता",
      admin: "व्यवस्थापक",
      register_button: "दर्ता गर्नुहोस्",
       edit:"सचाउनु",
       part:"जन्म मिति",
      action:"कार्य",
      act:"ठेगाना",
      name:"नाम",
      number:"सम्पर्क",
      date:"बप्तिस्मा मिति"
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


      <a href="baptism.php" class="logo"><span data-key="church_name">नव जीवन मण्डली</span></a>

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
         <h3 class="name">username</h3>
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
   <a href="baptism.php" class="active"><i class="fas fa-water"></i><span data-key="menu_baptism">बप्तिस्मा</span></a>
   <a href="offer.php"><i class="fas fa-donate"></i><span data-key="menu_offering">भेटी</span></a>
   <a href="tithe.php"><i class="fas fa-hand-holding-usd"></i><span data-key="menu_tithe">दशांश</span></a>
   <a href="expense.php"><i class="fas fa-receipt"></i><span data-key="menu_expense">खर्च</span></a>
   <a href="schedule.php"><i class="fas fa-calendar-alt"></i><span data-key="menu_contact">सूची</span></a>
   <a href="account.php"><i class="fas fa-user-cog"></i><span data-key="menu_account">खाता</span></a>
</nav>

</div>


<section class="home-grid">

   <h1 class="heading"><span data-key="account">बप्तिस्माकाे विवरण</span></h1>

</section>


<style>
/* body { font-family: Arial, sans-serif; margin:20px; } */
form { border:1px solid #ccc; padding:15px; margin-bottom:20px;     width: 50%; border-radius:20px;}
input,textarea { width:95%; padding:8px; margin:5px 0; font-size:16px;}
table { width:90%; border-collapse: collapse; margin-top:20px; font-size:16px;}
th,td { border:1px solid #ccc; padding:10px; text-align:center; background: #b4f8e9ff;}
th { background: #b4f8e9ff; }
.id-card {
  width: 350px; height: 220px; border:2px solid #333; border-radius:10px;
  padding:10px; font-size:13px; margin:20px auto; position:relative;
}
.h2 { font-size:25px;}
.btn { font-size:16px; width:30%;}
.id-header { text-align:center; font-weight:bold; font-size:16px; margin-bottom:8px; }
.id-body { display:flex; }
.id-photo { width:90px; height:110px; border:1px solid #000; object-fit:cover; }
.id-details { margin-left:10px; font-size:12px; }
.id-footer { position:absolute; bottom:5px; right:10px; font-size:11px; }
</style>
</head>
<body>

<center>
<div class="container1">

  

</center>
<center>
<table>
    <thead>
        <tr>
            <th data-key="name">नाम</th>
            <th data-key="part">जन्म मिति</th>
            <th data-key="act">ठेगाना</th>
            <th data-key="number">सम्पर्क</th>
            <th data-key="date">बप्तिस्मा मिति</th>
             <th data-key="action">कार्य</th>
        </tr>
    </thead>
    <tbody>

<form method="POST">
    <tr>
<td><center><input type="text" id="nepali-datepicker" name="name" value="<?= $record['name'] ?>" required></center></td>
    <td><center><input type="text" name="dob" value="<?= $record['dob'] ?>" required></center></td>
    <td><center><input type="text" name="address" value="<?= $record['address'] ?>" required></center></td>
    <td><center><input type="number" name="contact" value="<?= $record['contact'] ?>" required></center></td>
    <td><center><input type="text" id="nepali-datepicker" name="baptism_date" value="<?= $record['baptism_date'] ?>" required></center></td>
    <td><center><button class="btn3" type="submit" data-key="edit">सचाउनु</button></center></td>
</tr>
</form>
    </tbody>
</table></center>
</div>





 <script src="https://nepalidatepicker.sajanmaharjan.com.np/v5/nepali.datepicker/js/nepali.datepicker.v5.0.6.min.js" type="text/javascript"></script>
 <script type="text/javascript">
 window.onload = function() {
 var mainInput = document.getElementById("nepali-datepicker");
 mainInput.NepaliDatePicker();
 };
 </script>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer class="footer">

   &copy; copyright @ 2025 by <span>New Life Church</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="js/script.js">
  
</script>

   
</body>
</html>