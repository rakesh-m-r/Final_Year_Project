<html>
<?php
if( !isset($_COOKIE['token']) || (isset($_COOKIE['token']) && $_COOKIE['token']!="qwerty1234" ))  {
    header("location: admin.php");
  } ?>
<head>
    <title>Traffic Voilation detection and Reporting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
</head>
<style>
body{
    height:100%;
    width: 100%;
}
.center{
    width: 80vw;
    position: absolute;
    top: 10%;
    left: 50%;
    transform: translateX(-50%);
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
    .flex-end{
        display: flex;
        justify-content: flex-end;
    }
</style>
<body>
<div class="w3-container w3-teal header">
  <h3>Traffic Voilation Detection and Reporting System</h3>
  <a href="admin.php">Logout</a>
</div>
<div class="center">
    <div class="flex-end">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Plate number..">

    </div>

<table id="myTable" class="w3-table w3-bordered w3-border">
  <tr class="w3-teal">
    <th>licence plate Number</th>
    <th>Victim Name</th>
    <th>Date and Time</th>
    <th>Phone No</th>
    <th>Aaddress</th>
    <th>Email</th>
    <th>Payment Status</th>
    <th>Action</th>

  </tr>
  <?php
  require_once 'sql.php';
  $conn = mysqli_connect($host, $user, $ps, $project);if (!$conn) {
      echo "<script>alert(\"Database error retry after some time !\")</script>";
  }
      $sql = "select * from victim Inner Join users on victim.num_plate=users.num_plate ORDER BY timestamp DESC";
  $res =   mysqli_query($conn, $sql);
  if ($res == true) {
      while ($row = mysqli_fetch_array($res)) { 
          echo "<tr><td>".$row["num_plate"]."</td><td>".$row["name"]."</td><td>".$row["timestamp"]."</td><td>".$row["phone_num"]."</td><td>".$row["address"]."</td><td>".$row["email"]."</td><td>";
          if($row['paid'] == 0){
          echo "Not Paid Fine</td><td><button class=\"w3-btn w3-teal\" onclick=\"email('".$row["num_plate"]."')\">Notify";
          }else{
              echo "Paid</td><td><button class=\"w3-btn w3-teal\" disabled> Not needed";
          }
          echo "</button></td></tr>"; 
   }
  }
  ?>
</table>
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function email(data){
    var request = new XMLHttpRequest();
    request.open("GET", "notify.php?num_plate="+data, true);
  request.send();
  alert("email sent")
}
</script>
    
</div>
</body>

</html>