<html>

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
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.w3-bar .w3-button{
        width:50%;
    }
    .w3-container{
        display: grid;
        justify-content: center;
    }
    table{
        width: 80%;
    }
</style>
<body>
<div class="w3-container w3-teal header">
  <h3>Traffic Voilation Detection and Reporting System</h3>
</div>
<div class="center">
    <form class="w3-container" method="POST">
<label>Username</label>
<input name="username" class="w3-input" type="text">
<label>Password</label>
<input name="password" class="w3-input" type="password">
<input name="login"  type="submit" value="Login" class="w3-btn w3-black w3-margin"/>
    </form>
    <?php
    if (isset($_POST['login'])) {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            if($_POST['username']=='admin@traffic' && $_POST['password']=='123456'){
                setcookie("token", "qwerty1234", time() + (86400 * 30), "/");
                header("location: adminhome.php");
            }else{
                echo "<script>alert(\"Enter valid username and password!\")</script>";
            }

        }else{
            echo "<script>alert(\"Both fields are mandatory!\")</script>";
        }

    }
    ?>
</div>
</body>

</html>