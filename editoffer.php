<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
   exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM offerrecords WHERE id = $id");
$record = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['record_date'];
    $particular = $_POST['particular'];
    $amount = $_POST['amount'];

    $stmt = $conn->prepare("UPDATE offerrecords SET record_date=?, particular=?, amount=? WHERE id=?");
    $stmt->bind_param("ssdi", $date, $particular, $amount, $id);
    $stmt->execute();

    header("Location: offer.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>भेटी</title>

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
      name:"Date",
      account:"Offering Details",
      church_name: "New Life Church",
      menu_believer: "Believer",
      menu_baptism: "Baptism",
      menu_offering: "Offering",
      menu_tithe: "Tithe",
      menu_expense: "Expense",
      menu_account: "Account",
      menu_contact: "Contact Us",
      register_title: "New Registration",
      pass:"Add Entry",
      user:"View Offering Records",
      part:"Month",
      action:"Action",
      act:"Amount",
      delete:"Delete",
      total:"Total",
      edit:"Update"
   },
   ne: {
      name:"मिति",
      account:"भेटीको रेकर्डहरू",
      church_name: "नव जीवन मण्डली",
      menu_believer: "विश्वासी",
      menu_baptism: "बप्तिस्मा",
      menu_offering: "भेटी",
      menu_tithe: "दशांश",
      menu_expense: "खर्च",
      menu_account: "खाता",
      menu_contact: "सम्पर्क",
      register_title: "नयाँ खाता दर्ता गर्नुहोस्",
      pass:"थप्नुहोस्",
      user:"रेकर्डहरू हेर्नुहोस्",
      part:"महिना",
      action:"कार्य",
      act:"गणना",
      delete:"हटाउनुहोस्",
      total:"जम्मा",
      edit:"सचाउनु"
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


      <a href="offer.php" class="logo"><span data-key="church_name">नव जीवन मण्डली</span></a>

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
   <a href="baptism.php"><i class="fas fa-water"></i><span data-key="menu_baptism">बप्तिस्मा</span></a>
   <a href="offer.php" class="active"><i class="fas fa-donate"></i><span data-key="menu_offering">भेटी</span></a>
   <a href="tithe.php"><i class="fas fa-hand-holding-usd"></i><span data-key="menu_tithe">दशांश</span></a>
   <a href="expense.php"><i class="fas fa-receipt"></i><span data-key="menu_expense">खर्च</span></a>
   <a href="schedule.php"><i class="fas fa-calendar-alt"></i><span data-key="menu_contact">सूची</span></a>
   <a href="account.php"><i class="fas fa-user-cog"></i><span data-key="menu_account">खाता</span></a>
</nav>

</div>


<section class="home-grid">

   <h1 class="heading"><span data-key="account">भेटीको रेकर्डहरू</span></h1>

</section>


 <?php
    $options1 = [ "बैशाख", "जेठ","असार","श्रावण","भाद्र","अश्विन","कार्तिक","मंसिर","पौष","माघ","फाल्गुण","चैत्र" ];
    ?> 



 
<center>
<div class="container1">

  

</center>
<center>
<table>
    <thead>
        <tr>
            <th data-key="name">मिति</th>
            <th data-key="part">महिना</th>
            <th data-key="act">गणना</th>
            <th data-key="action">कार्य</th>
        </tr>
    </thead>
    <tbody>

<form method="POST">
    <tr>
<td><center><input type="text" id="nepali-datepicker" name="record_date" value="<?= $record['record_date'] ?>" required></center></td>
    <td><center><select name="particular" required>
    <option value="<?= $record['particular'] ?>"><?= $record['particular'] ?></option>
    <?php foreach ($options1 as $option) echo "<option value='$option'>$option</option>"; ?>
  </select></center></td> 
    <td><center><input type="number" step="0.01" name="amount" value="<?= $record['amount'] ?>" required></center></td>
    <td><center><button type="submit" class="btn3" data-key="edit">सचाउनु</button></center></td>
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



<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer class="footer">

   &copy; copyright @ 2025 by <span>New Life Church</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="js/script.js">
  
</script>

   
</body>
</html>