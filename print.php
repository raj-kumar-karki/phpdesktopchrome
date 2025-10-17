<?php
@include 'config.php';

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM members WHERE id=$id");
$member = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ID Card</title>
<br><br><br>
<style>
body { font-family: Arial, sans-serif; text-align:center; }
.id-card {
  width: 350px; height: 220px; border:2px solid #333; border-radius:10px;
  padding:10px; font-size:13px; margin:20px auto; position:relative;
}
.id-header { text-align:center; font-weight:bold; font-size:16px; margin-bottom:8px; }
.id-body { display:flex; }
.id-photo { width:90px; height:110px; object-fit:cover; padding-top: 15px; }
.id-details { margin-left:10px; font-size:12px; text-align:left; }
.id-footer { position:absolute; bottom:10px; right:30px; font-size:11px; }
</style>
</head>
<body onload="window.print()">

<div class="id-card">
  <div class="id-header">New Life Church <br> Gwarko, Lalitpur</div>
  <div class="id-body">
    <img src="<?= $member['photo'] ?>" class="id-photo">
    <div class="id-details">
      <p><b>Name:</b> <?= $member['name'] ?></p>
      <p><b>DOB:</b> <?= $member['dob'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Contact:</b> <?= $member['contact'] ?></p>
      <p><b>Address:</b> <?= $member['address'] ?></p>
      <p><b>Baptism Date:</b> <?= $member['baptism_date'] ?></p>
    </div>
  </div>
  <div class="id-footer">Signature of Ps. Krishna : ...................</div>
</div>
<br><br><br>

</body> 
</html>
