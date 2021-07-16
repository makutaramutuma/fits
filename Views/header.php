<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="top.php">フィッツ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page"
        href="<?php
                if($_SESSION['log']<=1){
                  echo "user_mypage.php";
                }elseif ($_SESSION['log']>2) {
                  echo "company_mypage.php";
                  // code...
                }else {
                  echo "admin_mypage.php";
                  // code...
                }
                ?>">マイページ</a>
        <a class="nav-link" href="logout.php">ログアウト</a>
      </div>
    </div>
  </div>
</nav>
</header>
