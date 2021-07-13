<?php
global $data;
global $email,$name,$case,$time;
$data=$_GET["num_plate"];
require_once 'sql.php';
$conn = mysqli_connect($host, $user, $ps, $project);
if (!$conn) {
    return "Email Not sent";
}else{
$sql = "select * from victim where num_plate=\"{$data}\" ORDER BY timestamp DESC";
echo $sql;  
$res =   mysqli_query($conn, $sql);
        if ($res == true) {
            $row = mysqli_fetch_array($res);
                $time=$row['timestamp'];
                $case=$row['cases'];
         }else{
             echo "sql error";
         }
         $sql = "select * from users where num_plate=\"{$data}\"";
echo $sql;        
$res =   mysqli_query($conn, $sql);
        if ($res == true) {
            $row = mysqli_fetch_array($res);
                $email=$row['email'];
                $name=$row['name'];
         }else{
             echo "sql error";
         }
        }
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'rakeshmrtemp@gmail.com';
$mail->Password = 'Mariyaplar1999';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
$mail->setFrom('rakeshmr723@gmail.com');
$mail->addAddress($email);
$mail->addReplyTo('rakeshmr723@gmail.com');
$mail->isHTML(true);
$mail->Subject = 'Traffic Rule Voilation Details';
$mail->Body = "Hey {$name},<br>This mail is to inform you to that you voilated the {$case} voilation on {$time}. Please pay the fine to avoid any legal action on same.<br><bR>Thank You<br> Dept of Traffic";
if (!$mail->send()) {
    echo $mail->ErrorInfo;
} else {
    echo "email sent";    
}
?>