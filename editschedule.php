<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
   exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM monthly_service WHERE id = $id");
$record = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date_label'];
    $text = $_POST['bible_study'];
    $text2 = $_POST['prayer_leader'];
    $text3 = $_POST['worship_leader'];
    $text4 = $_POST['prayer_meeting'];
    $text5 = $_POST['preaching_leader'];
    $text6 = $_POST['preacher'];

    $stmt = $conn->prepare("UPDATE monthly_service SET date_label=?, bible_study=?, prayer_leader=?, worship_leader=?, prayer_meeting=?, preaching_leader=?, preacher=? WHERE id=?");
    $stmt->bind_param("sssssssi", $date, $text, $text2, $text3, $text4, $text5, $text6,$id);
    $stmt->execute();

    header("Location: schedule.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>सूची</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <link href="https://nepalidatepicker.sajanmaharjan.com.np/v5/nepali.datepicker/css/nepali.datepicker.v5.0.6.min.css" rel="stylesheet" type="text/css"/>


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
   
   /* body {
    font-family: Arial;
    padding: 20px;
    background: #f0f0f0;
} */
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
}
input, button, select {
    margin: 5px 0;
    padding: 8px;
    /* width: 10%;
    max-width: 400px; */
}

button {
     background: #6ff0dfff;
     border-radius: 10px;

}
/* form {
    margin-bottom: 10px;
    border-radius: 5px;
} */
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
      account:"Schedule Details",
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
      edit:"Update",
      register_button: "Register Now"
   },
   ne: {
      account:"सूची विवरण",
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
      edit:"सचाउनु",
      register_button: "दर्ता गर्नुहोस्"
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
            <    <a href="logout.php" class="option-btn">logout</a>
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
   <a href="schedule.php" class="active"><i class="fas fa-calendar-alt"></i><span data-key="menu_contact">सूची</span></a>
   <a href="account.php"><i class="fas fa-user-cog"></i><span data-key="menu_account">खाता</span></a>
</nav>

</div>


<section class="home-grid">

   <h1 class="heading"><span data-key="account">सूची विवरण</span></h1>

</section>

  

    <style>
/* body { font-family: Arial, sans-serif; margin:20px; } */
form { border:1px solid #ccc; padding:15px; margin-bottom:20px;  border-radius:20px;   width: 50%; }
input,textarea,select { width:95%; padding:8px; margin:5px 0; font-size:16px; border-radius:10px;}
table { width:90%; border-collapse: collapse; margin-top:20px; font-size:16px;}
th,td { border:1px solid #ccc; padding:10px; text-align:center;}
th { background:#eee; }
.id-card {
  width: 350px; height: 220px; border:2px solid #333; border-radius:10px;
  padding:10px; font-size:13px; margin:20px auto; position:relative;
}
.h2 { font-size:25px;}
.btn { font-size:16px;     width: 30%;  }
.id-header { text-align:center; font-weight:bold; font-size:16px; margin-bottom:8px; }
.id-body { display:flex; }
.id-photo { width:90px; height:110px; border:1px solid #000; object-fit:cover; }
.id-details { margin-left:10px; font-size:12px; }
.id-footer { position:absolute; bottom:5px; right:10px; font-size:11px; }
</style>

<center>
<table>
    <thead>
        <tr>
            <th>गते</th>
            <th>बाइबल अध्ययन र प्रार्थना</th>
            <th>संचालन र सुचना</th>
            <th>आराधना सेवा</th>
            <th>भेटी संकलन र प्रार्थना</th>
            <th>प्रवचनको प्रार्थना</th>
            <th>प्रवचनको सेवा</th>
            <th>Action</th>
        </tr>
    </thead>


    <tfoot>
    <?php
    $options1 = [   "ए. किरण सुजी", "घनश्याम सुवेदी", "राज कुमार कार्की",
    "प्रेमिला र श्रद्धा", "सीमित्रा शाही", "विुष्णु परिवार", "मन्ना सुजी", "इन्द्रस सुवेदी",
    "अञ्जिला लोलङ्गी", "विमला गाइरेले र ज्योति", "री के गदाल", "श्याम गाइरेले र राजन", 
    "मदन मगर", "ए.भुवन अधिकारी", "पवित्र परिवार", "माया गदाल र बसन्ती", "पु.कृष्ण डेविड परिवार" ];
    ?>
<form method="POST">
<tr>  
<td class="date"><center><input type="text" id="nepali-datepicker" name="date_label" value="<?= $record['date_label'] ?>" required></center></td>
      <td><select name="bible_study" required>
    <option value="<?= $record['bible_study'] ?>"><?= $record['bible_study'] ?></option>
    <?php foreach ($options1 as $option) echo "<option value='$option'>$option</option>"; ?>
  </select></td>    

  <td><select name="prayer_leader" required>
    <option value="<?= $record['prayer_leader'] ?>"><?= $record['prayer_leader'] ?></option>
    <?php foreach ($options1 as $option) echo "<option value='$option'>$option</option>"; ?>
  </select></td>    

  <td><select name="worship_leader" required>
    <option value="<?= $record['worship_leader'] ?>"><?= $record['worship_leader'] ?></option>
    <?php foreach ($options1 as $option) echo "<option value='$option'>$option</option>"; ?>
  </select></td>    

  <td><select name="prayer_meeting" required>
    <option value="<?= $record['prayer_meeting'] ?>"><?= $record['prayer_meeting'] ?></option>
    <?php foreach ($options1 as $option) echo "<option value='$option'>$option</option>"; ?>
  </select></td>    

  <td><select name="preaching_leader" required>
    <option value="<?= $record['preaching_leader'] ?>"><?= $record['preaching_leader'] ?></option>
    <?php foreach ($options1 as $option) echo "<option value='$option'>$option</option>"; ?>
  </select></td>    

    <td><select name="preacher" required>
    <option value="<?= $record['preacher'] ?>"><?= $record['preacher'] ?></option>
    <?php foreach ($options1 as $option) echo "<option value='$option'>$option</option>"; ?>
  </select></td>    
    <td><center><button class="btn3" type="submit" data-key="edit">चाउनु</button></center></td>
</tr>
</form>
</tfoot>
</table></center>




<script src="https://nepalidatepicker.sajanmaharjan.com.np/v5/nepali.datepicker/js/nepali.datepicker.v5.0.6.min.js" type="text/javascript"></script>
 <script type="text/javascript">
 window.onload = function() {
 var mainInput = document.getElementById("nepali-datepicker");
 mainInput.NepaliDatePicker();
 };
 </script>
</body>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<footer class="footer">

   &copy; copyright @ 2025 by <span>New Life Church</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="js/script.js">
  
</script>

   
</body>
</html>