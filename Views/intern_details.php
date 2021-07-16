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
	FROM intern
  WHERE id=$id
");
$posts->execute();
$posts = $posts->fetchAll(PDO::FETCH_ASSOC);

$favos = $db->prepare("
SELECT *
FROM favorite
WHERE intern_id = $id AND user_id = {$_SESSION['i']}
");
// goodテーブルから投稿IDとユーザーIDが一致したレコードを取得するSQL文
$favos->execute();

// クエリ実行
$resultCount = $favos->rowCount();

?>
<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>インターン詳細</title>

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

  </head>
  <body>

    <?php include 'header.php'; ?>


<main>
  <section class="py-3 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h3 class="fw-light">インターン詳細</h3>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light ">
    <?php foreach ($posts as $post) : ?>

    <div class="container">


  <div class="card mb-4 mx-auto" style="width: 70%;">
    <img src="<?=$post['image']?>" class="img-fluid d-block mx-auto" width="50%" height="50%"  alt="...">
    <div class="card-body">
      <h5 class="card-title"><?=htmlspecialchars($post['title']) ?></h5>
      <p class="card-text">業務内容：</br><?=htmlspecialchars($post['task'])?></p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">業種：<?=$post['industry']?></li>
      <li class="list-group-item">職種：<?=$post['job']?></li>
      <li class="list-group-item">募集要項：<?=htmlspecialchars($post['request'])?></li>
      <li class="list-group-item">給与：<?=htmlspecialchars($post['salary'])?></li>
      <li class="list-group-item">勤務時間：<?=htmlspecialchars($post['time'])?></li>
      <li class="list-group-item">エリア：<?=$post['area']?></li>


    </ul>

    </div>


    </div>
    <div class="select">

    <?php if($_SESSION['log']<=1){ ?><a class="btn btn-primary mt-4" href="join.php?id=<?=($post['id']) ?>" role="button" id="l-showBtn">申し込む</a></br><?php } ?>
    <?php if($_SESSION['log']<=1){ ?><a id="f_btn" class="btn btn-success mt-4" role="button" id="l-showBtn"><?php
      if($resultCount>=1){
        echo "お気に入り解除";
      }else{
        echo "お気に入り登録";
      } ?></a></br><?php } ?>
    <button type="button" class="btn btn-secondary mt-4"  onclick="location.href='./intern.php'">インターン一覧へ戻る</button>
    </div>
  <?php endforeach;?>


    </div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    //.sampleをクリックしてajax通信を行う
    $('#f_btn').click(function(){

        $.ajax({
            url: 'ajaxGood.php',
            /* 自サイトのドメインであれば、https://kinocolog.com/ajax/test.html というURL指定も可 */
            type: 'POST',
            data: {
              i_id : <?php echo $_GET['id']?>,
              u_id :<?php echo $_SESSION['i']?>

            }
        }).done(function(data){
            /* 通信成功時 */
            $('#f_btn').html(data); //取得したHTMLを.resultに反映

        }).fail(function(data){
            /* 通信失敗時 */
            alert('通信失敗！');

        });
    });
});
</script>
</main>





    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
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
