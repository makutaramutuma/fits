<?php
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST['name']) && isset($_POST['email'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $text = $_POST['text'];
  $subject = $_POST['subject'];
  $mail_body = 'メッセージ内容' . "<br><br>";
  $mail_body .=  "お名前： " .htmlspecialchars($name) . "<br><br>";
  $mail_body .=  "メールアドレス：" . htmlspecialchars($email) . "<br><br>" ;
  $mail_body .=  "本文：" . htmlspecialchars($text)  ;

  require_once "PHPMailer/PHPMailer.php";
  require_once "PHPMailer/SMTP.php";
  require_once "PHPMailer/Exception.php";

  $mail = new PHPMailer();

  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->Username = "makutaramutuma@gmail.com";
  $mail->Password = "35943594";
  $mail->Port = 465;
  $mail->SMTPSecure = "ssl";
  $mail->CharSet = 'UTF-8';

  $mail->isHTML(true);
  $mail->setFrom($email,$name);
  $mail->addAddress("makutaramutuma@gmail.com");
  $mail->Subject = $subject;
  $mail->Body = $mail_body;

  if($mail->send()){
    $status = "success";
    $response = "Email is sent!";
  }
  else
  {
    $status = "failed";
    $response = "Something is wrong: <br>" . $mail->ErroInfo;
  }
  exit(json_encode(array("status" => $status, "response" => $response)));
}
?>
