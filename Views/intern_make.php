<?php
// PDOでDBに接続
session_start();
if(empty($_SESSION['log'])){
  header('location: login.php');
}
$i = $_SESSION['i'];
$id=$_GET['id'];
?>
<!doctype html>
<html lang="ja">
  <head>
    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>インターン作成画面</title>

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
  <form style="width: 70%;" class="mx-auto" method="POST" action="make_comfirm.php">
    <div class="mx-auto text-center" style="width: 100%;">
      <h1 class="mb-4 mt-4 fw-normal mx-auto" style="width: 100%;">インターン作成画面</h1>
    </div>
    <div class="mb-3">
    <p class=" mx-auto mb-1">インターン名</p>
      <input  name="title" type="text" class="form-control" id="formGroupExampleInput" placeholder="インターンタイトルを入力" required>
    </div>
    <p class="mb-1">エリア</p>
      <select class="form-control mb-2" name="area" style="display: inline; width: 100%;">
        <option>東京23区</option>
        <option>東京23区外</option>
        <option>神奈川県</option>
        <option>横浜市</option>
        <option>川崎市</option>
        <option>埼玉県</option>
        <option>千葉県</option>
        <option>大阪府</option>
        <option>福岡県</option>
        <option>北海道</option>
        <option>名古屋市</option>
        <option>その他</option>
      </select>

    <p class="mb-1">業種</p>
      <select class="form-control mb-2" name="industry" style="display: inline; width: 100%;">
        <option>IT</option>
        <option>人材</option>
        <option>金融・保険</option>
        <option>広告・マーケティング</option>
        <option>不動産</option>
        <option>建設</option>
        <option>コンサル</option>
        <option>製造業</option>
        <option>エンタメ</option>
        <option>通信</option>
        <option>飲食</option>
        <option>その他</option>

      </select>


    <p class="mb-1 ">職種</p>
    <select class="form-control mb-2" name="job" style="display: inline; width: 100%;">
      <option>営業</option>
      <option>管理職</option>
      <option>事務</option>
      <option>エンジニア</option>
      <option>企画</option>
      <option>その他</option>

    </select>


    <p class="mt-3 mb-1">イメージ画像</p>
    <div class="input-group mb-3">
  <input name="image" type="file" class="form-control" id="inputGroupFile02">

  </div>

  <div class="mb-3">
  <p class=" mx-auto mb-1">給与</p>
    <input name="salary" type="text"  class="form-control" id="formGroupExampleInput" placeholder="時給1500円" required>
  </div>

  <div class="mb-3">
  <p class=" mx-auto mb-1">勤務時間</p>
    <input name="time" type="text"  class="form-control" id="formGroupExampleInput" placeholder="年末年始を除く平日・土日10時～19時　最低週2日勤務" required>
  </div>

  <div class="mb-3">
  <p class="mb-1">業務内容</p>
  <textarea name="task" class="form-control" id="exampleFormControlTextarea1" rows="3" style="white-space:pre-wrap;"></textarea>
  </div>

  <div class="mb-3">
  <p class="mb-1">募集要項</p>
  <textarea name="request" class="form-control" id="exampleFormControlTextarea1" rows="3" style="white-space:pre-wrap;"></textarea>
  </div>

 <div class="mx-auto" style="width: 70%;">
  <input type="hidden" name="id" value="<?=$id ?>">

  <button class="w-100 btn btn-lg btn-primary mb-4" type="submit">次へ</button>

  <button type="button" class="w-100 btn btn-secondary mx-auto mb-4" style="width: 70%;"  onclick="location.href='./company_mypage.php'">戻る</button>
  </div>

  </form>


</div>
    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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


  </body>
</html>
