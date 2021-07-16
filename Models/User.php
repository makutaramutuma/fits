<?php
require_once(ROOT_PATH .'/Models/Db.php');
ini_set('display_errors', "On");

class User
{

  public static function createUser($userDate)
  {
    $result = false;
    $sql =
    'INSERT INTO user
    (name, mail, tel, image, profile, password)
    VALUES (:name, :mail, :tel, :image, :profile, :password)';

    $name = $userDate['name'];
    $mail = $userDate['mail'];
    $tel = $userDate['tel'];
    $image = $userDate['image'];
    $image = $userDate['profile'];
    $password = $userDate['password'];


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


  public function getUserById($id)
  {
    $sql = 'SELECT * FROM use WHERE id = :id';
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
              company_name = :company_name, company_url = :company_url, tel = :tel, postal_code = :postal_code, company_adress = :company_adress, email = :email, free_text = :free_text
            WHERE
              id = :id';

          $name = $userDate['name'];
          $mail = $userDate['mail'];
          $tel = $userDate['tel'];
          $image = $userDate['image'];
          $image = $userDate['profile'];
          $password = $userDate['password'];

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

  /**
   * ログイン処理
   * @param string $email
   * @param string $password
   * @return bool $result
   */
  public static function login($email, $password)
  {
    $result = false;
    // 会社をemailで検索
    $user = self::getUseryByEmail($email);
    if(!$company) {
      $_SESSION['msg'] = 'メールアドレスまたはパスワードが一致しません。';
      return $result;
    }

    // パスワードの照会
    if(password_verify($password, $user['password'])) {
      session_regenerate_id(true);
      $_SESSION['login_user'] = $user;
      $result = true;
      return $result;
    } else {
      $_SESSION['msg'] = 'メールアドレスまたはパスワードが一致しません。';
      return $result;
    }
  }

}
