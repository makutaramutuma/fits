<?php
session_start();
if(empty($_SESSION['log'])){
  header('location: login.php');
}
$mail = $_SESSION['mail'];
$id = $_SESSION['i'];
$db = new PDO('mysql:dbname=fits;host=localhost', 'root', 'root');
$posts = $db->prepare("
	SELECT *
	FROM company
  WHERE id='$id'
");
$posts->execute();
$posts = $posts->fetchAll(PDO::FETCH_ASSOC);
 foreach ($posts as $post)


$interns = $db->prepare("
	SELECT *
	FROM intern
  WHERE company_id={$post['id']}
");
$interns->execute();
$interns = $interns->fetchAll(PDO::FETCH_ASSOC);

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
    <title>企業詳細</title>

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
<h2 class="mx-auto mt-3 text-center" style="width: 70%;">企業マイページ</h2>

  <div class="card mt-4 mb-4 mx-auto" style="width: 70%;">
    <img src="<?=$post['image']?>" class="img-fluid d-block mx-auto" width="50%" height="50%" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?=htmlspecialchars($post['name'])?></h5>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><?=htmlspecialchars($post['mail'])?></li>

      <li class="list-group-item" style="white-space:pre-wrap;"><?=htmlspecialchars($post['profile'])?></li>
    </ul>
    <button type="button" class="btn btn-primary mx-auto mt-4 mb-4" width="100%" onclick="location.href='./company_edit.php?id=<?=($post['id']) ?>'">プロフィールを編集する</button>


    </div>


  <section class="py-3 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h3 class="fw-light">登録済みインターン一覧</h3>
      </div>
    </div>
  </section>



  <div class="album py-5 bg-light">
    <div class="container">



      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
				<?php foreach ($interns as $intern): ?>
        <div class="col">
          <div class="card shadow-sm">
						<img src="<?=htmlspecialchars($intern['image'])?>" class="img-fluid d-block mx-auto" width="50%" height="50%" alt="...">
            <div class="card-body">
              <p class="card-text text-center"><?=htmlspecialchars($intern['title'])?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group mx-auto">
									<a class="btn btn-primary text-center" href="intern_company_details.php?id=<?=($intern['id']) ?>" role="button" id="l-showBtn">詳細</a>
                </div>
              </div>
            </div>
          </div>
        </div>
				<?php endforeach; ?>


      </div>
    </div>

  </div>


</main>

<div class="select">
  <button type="button" class="btn btn-success mx-auto mb-4 mt-4" width="70%" onclick="location.href='./intern_make.php?id=<?=($post['id']) ?>'">インターンを登録する</button>
  <button type="button" class="btn btn-danger mx-auto mb-4 " width="70%" onclick="location.href='./company_delete.php'">アカウントを削除する</button>
  <button type="button" class="btn btn-secondary mx-auto mb-4" width="70%" onclick="location.href='./top.php'">戻　る</button>
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
