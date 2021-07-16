<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Signin Template for Bootstrap · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.jp/docs/5.0/examples/sign-in/">



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


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark ">
  <div class="container-fluid">
  <a class="navbar-brand" href="login_user.php">フィッツへようこそ</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav me-auto mb-2 mb-md-0">
      <li class="nav-item active">
        <a class="nav-link" aria-current="page" href="#"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
      </li>
    </ul>

  </div>
  </nav>

  <body class="text-center">


<main class="form-signin">

  <form action="signup_user_complete.php" method="POST">
    <img class="mb-4"  src="img/signup.png" alt="" width="120" height="120">
    <h1 class="h3 mb-4 fw-normal">登録情報確認画面</h1>
    <div class="">

    <p class="mt-3 mb-1">ユーザー名</p>
    <div class="input-group mb-3">
   <p class="fw-bold"><?=($_POST['name']) ?></p>

</div>

<p class="mt-3 mb-1">メールアドレス</p>
<div class="input-group mb-3">
<p class="fw-bold"><?=($_POST['mail']) ?></p>

</div>

<p class="mt-3 mb-1">パスワード</p>
<div class="input-group mb-3">
<p class="fw-bold"><?=($_POST['password']) ?></p>

</div>

<p class="mt-3 mb-1">イメージ画像</p>
<div class="input-group mb-3">
  <img src="<?=('img/'.$_POST['image']) ?>" class="card-img-top" alt="...">

</div>

<p class="mt-3 mb-1">Twitter</p>
<div class="input-group mb-5">
<p class="fw-bold" style="white-space:pre-wrap;"><?=($_POST['twitter']) ?></p>

</div>

<p class="mt-3 mb-1">Facebook</p>
<div class="input-group mb-5">
<p class="fw-bold" style="white-space:pre-wrap;"><?=($_POST['facebook']) ?></p>

</div>

<p class="mt-3 mb-1">プロフィール</p>
<div class="input-group mb-5">
<p class="fw-bold" style="white-space:pre-wrap;"><?=($_POST['profile']) ?></p>

</div>

<input type="hidden" name="name" value="<?=($_POST['name']) ?>">
<input type="hidden" name="image" value="<?=('img/'.$_POST['image']) ?>">
<input type="hidden" name="mail" value="<?=($_POST['mail']) ?>">
<input type="hidden" name="password" value="<?=($_POST['password']) ?>">
<input type="hidden" name="profile" value="<?=($_POST['profile']) ?>">
<input type="hidden" name="twitter" value="<?=($_POST['twitter']) ?>">
<input type="hidden" name="facebook" value="<?=($_POST['facebook']) ?>">

  <button class="w-100 btn btn-lg btn-primary mb-4" type="submit">登録を完了する</button>

<button type="button" class="btn btn-secondary" onclick="location.href='./signup_user.php'">戻る</button>


  </form>
</main>



  </body>
</html>
