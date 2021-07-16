<?php
session_start();
if(empty($_SESSION['log'])){
  header('location: login.php');
}
$id = $_SESSION['i'];

// PDOでDBに接続
$db = new PDO('mysql:dbname=fits;host=localhost', 'root', 'root');

// GETで現在のページ数を取得する（未入力の場合は1を挿入）
if (isset($_GET['page'])) {
	$page = (int)$_GET['page'];
} else {
	$page = 1;
}

// スタートのポジションを計算する
if ($page > 1) {
	// 例：２ページ目の場合は、『(2 × 10) - 10 = 10』
	$start = ($page * 4) - 4;
} else {
	$start = 0;
}

// internテーブルから4件のデータを取得する
$posts = $db->prepare("
	SELECT  *
	FROM intern
	LIMIT {$start}, 4
");
$posts->execute();
$posts = $posts->fetchAll(PDO::FETCH_ASSOC);
 foreach ($posts as $post)



// internテーブルから業種取得（重複排除）
$inds = $db->prepare("
	SELECT DISTINCT  industry
	FROM intern
");
$inds->execute();
$inds = $inds->fetchAll(PDO::FETCH_ASSOC);

$areas = $db->prepare("
	SELECT DISTINCT  area
	FROM intern
");
$areas->execute();
$areas = $areas->fetchAll(PDO::FETCH_ASSOC);

$jobs = $db->prepare("
	SELECT DISTINCT  job
	FROM intern
");
$jobs->execute();
$jobs = $jobs->fetchAll(PDO::FETCH_ASSOC);



// postsテーブルのデータ件数を取得する
$page_num = $db->prepare("
	SELECT COUNT(*) id
	FROM intern
");
$page_num->execute();
$page_num = $page_num->fetchColumn();

// ページネーションの数を取得する
$pagination = ceil($page_num / 4);


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
    <title> インターンページ</title>

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
    <link href="intern.css" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Round" rel="stylesheet">
<link rel="stylesheet" href="iine_app/iine.css">
  </head>
  <body>

		<?php include 'header.php'; ?>


<main>
  <section class="py-3 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h3 class="fw-light">インターン一覧</h3>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light ">
    <div class="container">

  <div class="dropdown text-center mb-3">
  <button class="btn btn-secondary dropdown-toggle mb-4" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
    エリア
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<?php foreach ($areas as $area) : ?>

		<li><a class="dropdown-item" href="intern_area.php?area=<?=$area['area']?>"><?=$area['area']?></a></li>

			<?php endforeach;?>


  </ul>

  <button class="btn btn-secondary dropdown-toggle mb-4" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
    業　種
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<?php foreach ($inds as $ind) : ?>

    <li><a class="dropdown-item" href="intern_industry.php?industry=<?=$ind['industry']?>"><?=$ind['industry']?></a></li>

		  <?php endforeach;?>

  </ul>

  <button class="btn btn-secondary dropdown-toggle mb-4" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
    職　種
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<?php foreach ($jobs as $job) : ?>

		<li><a class="dropdown-item" href="intern_job.php?job=<?=$job['job']?>"><?=$job['job']?></a></li>

			<?php endforeach;?>

  </ul>



  </div>



	<?php foreach ($posts as $post):?>

    <div class="card mb-4 mx-auto" style="width: 70%;">

    <img src="<?=$post['image']?>"  class="img-fluid d-block mx-auto" width="50%" height="50%" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?=htmlspecialchars($post['title'])?></h5>
      <p class="card-text"><?=htmlspecialchars($post['task'])?></p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><?=htmlspecialchars($post['salary'])?></li>
      <li class="list-group-item"><?=htmlspecialchars($post['time'])?></li>
      <li class="list-group-item"><?=$post['area']?></li>


    </ul>

    <div class="card-body ">
      <a class="btn btn-primary" href="intern_details.php?id=<?=($post['id']) ?>" role="button" id="l-showBtn">詳細</a>

    </div>
    </div>

<?php endforeach ?>



    <nav aria-label="Page navigation example"　class="mx-auto">
      <ul class="pagination mx-auto" style="width:70%">
        <?php for ($x=1; $x <= $pagination ; $x++) { ?>
        <li class="page-item">	<a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x; ?></a></li>
          <?php } // End of for ?>
      </ul>
    </nav>

      <div class="back">
        <button type="button" class="btn btn-primary mt-4 text-center" onclick="location.href='./top.php'">トップページへ戻る</button></br>

      </div>
    </div>

  </div>


</main>


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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </body>
</html>
