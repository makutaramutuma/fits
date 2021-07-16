<?php
require_once(ROOT_PATH .'/Models/Db.php');
ini_set('display_errors', "On");

class Company
{

  public static function createCompany($companyDate)
  {
    $result = false;
    $sql =
    'INSERT INTO company
    (name, mail, tel, image, profile, password)
    VALUES (:name, :mail, :tel, :image, :profile, :password)';

    $name = $companyDate['name'];
    $mail = $companyDate['mail'];
    $tel = $companyDate['tel'];
    $image = $companyDate['image'];
    $image = $companyDate['profile'];
    $password = $companyDate['password'];


    try {
      $pdo = connect();
      $pdo->beginTransaction();
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':name', $name, PDO::PARAM_STR);
      $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
      $stmt->bindValue(':tel', $tel, PDO::PARAM_INT);
      $stmt->bindValue(':image', $iamge, PDO::PARAM_INT);
      $stmt->bindValue(':profile', $profile, PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);

      $result = $stmt->execute();
      $pdo->commit();
      return $result;
    } catch(\Exception $e) {
      $pdo->rollBack();
      return $result;
    }
  }


  public function getCompanyById($id)
  {
    $sql = 'SELECT * FROM company WHERE id = :id';
    try {
      $stmt = connect()->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    } catch(\Exception $e) {
      return $result = false;
    }
  }


  public static function updateCompany($companyDate)
  {
    $sql = 'UPDATE company SET
              name = :name, mail = :mail, tel = :tel, image = :iamge, profile = :profile,password = :password
            WHERE
              id = :id';

          $name = $companyDate['name'];
          $mail = $companyDate['mail'];
          $tel = $companyDate['tel'];
          $image = $companyDate['image'];
          $image = $companyDate['profile'];
          $password = $companyDate['password'];

    try {
      $pdo = connect();
      $pdo->beginTransaction();
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':name', $name, PDO::PARAM_STR);
      $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
      $stmt->bindValue(':tel', $tel, PDO::PARAM_INT);
      $stmt->bindValue(':image', $iamge, PDO::PARAM_INT);
      $stmt->bindValue(':profile', $profile, PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);
      $result = $stmt->execute();
      $pdo->commit();
      return $result;
    } catch(\Exception $e) {
      $pdo->rollBack();
      return $result = false;
    }
  }

 
  public static function login($email, $password)
  {
    $result = false;
    
    $company = self::getCompanyByEmail($email);
    if(!$company) {
      $_SESSION['msg'] = 'メールアドレスまたはパスワードが一致しません。';
      return $result;
    }

    
    if(password_verify($password, $company['password'])) {
      session_regenerate_id(true);
      $_SESSION['login_company'] = $company;
      $result = true;
      return $result;
    } else {
      $_SESSION['msg'] = 'メールアドレスまたはパスワードが一致しません。';
      return $result;
    }
  }

}
