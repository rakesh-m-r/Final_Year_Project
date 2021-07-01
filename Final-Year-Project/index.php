<html>

<head>
    <title>Traffic Voilation Detection and Reporting System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
</head>
<style>
body{
    height:100%;
    width: 100%;
}
.center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.w3-bar{
    display:flex;
    justify-content:space-evenly;
}
.w3-bar .w3-button{
        width:50%;
    }
    .w3-container{
        display: grid;
        justify-content: center;
    }
</style>
<?php
if (isset($_POST['vn'])) {
    if (isset($_POST['data1'])) {
        require_once 'sql.php';
        $conn = mysqli_connect($host, $user, $ps, $project);if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $data = mysqli_real_escape_string($conn, $_POST['data1']);
        $sql = "select * from users where num_plate='{$data}'";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            $row = mysqli_fetch_array($res);
           if(count($row)==0){
            echo "<script>alert(\" Data not found\")</script>";

           }else{    
                setcookie("type", "num_plate", time() + (86400 * 30), "/");
                setcookie("data", $row['num_plate'], time() + (86400 * 30), "/");
                header("Location: home.php");
           }
        }
     }
     else{
        echo "<script>alert(\"Please enter the Vechical number\")</script>";
    }
    
}
if (isset($_POST['phno'])) {
    if (isset($_POST['data2'])) {
        require_once 'sql.php';
        $conn = mysqli_connect($host, $user, $ps, $project);if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $data = mysqli_real_escape_string($conn, $_POST['data2']);
        $sql = "select * from users where phone_num='{$data}'";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            $row = mysqli_fetch_array($res);
           if(count($row)==0){
            echo "<script>alert(\" Data not found\")</script>";

           }else{    
                setcookie("type", "phone_num", time() + (86400 * 30), "/");
                setcookie("data", $row['phone_num'], time() + (86400 * 30), "/");
                header("Location: home.php");
           }
        }
     }
     else{
        echo "<script>alert(\"Please enter the Vechical number\")</script>";
    }
    
}
?>
<body>
<div class="w3-container w3-teal">
  <h3>Traffic Voilation Detection and Reporting System</h3>
</div>
<div class="center">
<div class="w3-bar w3-black">
  <button class="w3-bar-item w3-button" onclick="openCity('London')">Vehical Number</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Paris')">Mobile Number</button>
</div>

<div id="London" class="city w3-padding-16">
<form class="w3-container" method="POST">
<label>Vehical Number Plate</label>
<input name="data1" class="w3-input" type="text">
<input name="vn"  type="submit" value="Get Deatails" class="w3-btn w3-black w3-margin"/>
</form>
</div>

<div id="Paris" class="city w3-padding-16" style="display:none">
<form class="w3-container" method="POST">

<label>Mobile Number</label>
<input name="data2" class="w3-input" type="number">
<input name="phno"  type="submit" value="Get Deatails" class="w3-btn w3-black w3-margin">
</form>
</div>
</div>
<script>function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(cityName).style.display = "block";
}</script>

</body>

</html>