<?php
session_start();

if(empty($_SESSION['log'])){
  header('location: login.php');
}
// PDOでDBに接続
$id = $_GET['id'];
if(empty($id)) {
  exit('リストIDが不正です。');
}
$db = new PDO('mysql:dbname=fits;host=localhost', 'root', 'root');
$posts = $db->prepare("
	SELECT  *
	FROM users
  WHERE id=$id
");
$posts->execute();
$posts = $posts->fetchAll(PDO::FETCH_ASSOC);
$data[]=$id;


?>
<!doctype html>
<html lang="ja">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>ユーザーメッセージ画面</title>

    <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/album/">



    <!-- Bootstrap core CSS -->
<link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="top.css" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  </head>
  <body>

  <?php include 'header.php'; ?>

<main>
  <form id="joinForm" action="message_user_complete.php?id=<?=$id ?>" style="width: 70%;" class="mx-auto" method="POST">
    <div class="mx-auto text-center" style="width: 100%;">
      <h1 class="mb-4 mt-4 fw-normal mx-auto" style="width: 100%;">メッセージ画面</h1>
    </div>
    <div class="">
    <p class="mb-1 mx-auto">氏名　※必須</p>
    <input id="name" name="name" type="text"  class="form-control" id="formGroupExampleInput" placeholder="フィッツ太郎" required>
    </div>

    <p class="mt-3 mb-1">メールアドレス　必須</p>
    <input id="email" name="mail" type="email" id="inputEmail" class="form-control" placeholder="メールアドレス" required autofocus>

  <div class="mb-5">
  <p class="mb-1">メッセージ内容</p>
  <textarea id="text" name="contents" class="form-control" id="exampleFormControlTextarea1" style="white-space:pre-wrap;" rows="5"></textarea>
  </div>

 <div class="mx-auto" style="width: 70%;">
   <input id="subject" type="hidden" name="subject" value="フィッツユーザーからメッセージがありました">

   <button class="w-100 btn btn-lg btn-primary mb-4" type="submit" onclick="sendEmail()">メッセージを送信する</button>

  <button type="button" class="w-100 btn btn-secondary mx-auto" style="width: 70%;"  onclick="location.href='./user_details.php?id=<?=$id ?>'">戻る</button>
  </div>

  </form>


</div>
    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

    <script type="text/javascript">
    function sendEmail(){
      var name = $("#name");
      var email = $("#email");
      var text = $("#text");
      var subject = $("#subject");

      if(isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(text) && isNotEmpty(subject)){
        $.ajax({
          url: 'sendEmail.php',
          method: 'POST',
          dataType: 'json',
          data:{
            name: name.val(),
            email: email.val(),
            text: text.val(),
            subject: subject.val()
          }, success:function(response){
            $('#joinForm')[0].reset();
            $('.sent-notification').text("Message sent successfully.");
          }
        });
      }
    }
    function isNotEmpty(caller){
      if(caller.val()==""){
        caller.css('border','1px solid red');
        return false;
      }
      else
      {
        caller.css('border','');
        return true;
      }
    }
    </script>

  </body>
</html>
