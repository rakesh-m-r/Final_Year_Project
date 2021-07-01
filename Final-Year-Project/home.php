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
    top: 15%;
    left: 50%;
    transform: translateX(-50%);
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
    .header{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    table{
        width: 80%;
    }
</style>
<body>
<div class="w3-container w3-teal header">
  <h3>Traffic Voilation Detection and Reporting System</h3>
  <a href="index.php">Logout</a>
</div>
<div class="center">
<table class="w3-table w3-bordered w3-border"><tr class="w3-teal">
    <th>Number Plate</th>
    <th>Voilation Type</th>
    <th>Date and Time</th>
    <th>Payment status</th>
  </tr>
<?php
if(!isset($_COOKIE['type'])&& !isset($_COOKIE['data'])) {
    header("location: index.php");
  } else {
    $type=$_COOKIE['type'];
    $data=$_COOKIE['data'];
    require_once 'sql.php';
        $conn = mysqli_connect($host, $user, $ps, $project);if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        if($type=="num_plate")
        {
            $sql = "select * from victim where {$type}='{$data}' ORDER BY timestamp DESC";
        }else{
            $sql = "select * from victim,users where victim.num_plate=users.num_plate and {$type}='{$data}' ORDER BY timestamp DESC";
        }
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            while ($row = mysqli_fetch_array($res)) { 
                echo "<tr><td>".$row["num_plate"]."</td><td>".$row["cases"]."</td><td>".$row["timestamp"]."</td><td>";
                if($row['paid'] == 0){
                echo "<button class=\"w3-btn w3-teal\"> Pay Fine";
                }else{
                    echo "<button class=\"w3-btn w3-teal\" disabled> Paid";
                }
                echo "</nutton></td></tr>"; 
         }
        }
  }
?>
</table>
</div>
<script>
</script>

</body>

</html>