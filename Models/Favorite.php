<?php

require_once(ROOT_PATH .'/Models/Db.php');
ini_set('display_errors', "On");

class favorite
{


  public function check_favolite_duplicate($company_id, $post_id)
  {
    $sql = 'SELECT *
            FROM favorite
            WHERE company_id = :company_id AND intern_id = :intern_id';
    try {
      $stmt = connect()->prepare($sql);
      $stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
      $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->execute();
      $favorite = $stmt->fetch(PDO::FETCH_ASSOC);
      return $favorite;
    } catch(\Exception $e) {
      return $favorite = false;
    }
  }



  public function favoriteDone($company_id,$intern_id)
  {
    $sql = 'INSERT INTO favorite(company_id, intern_id)
            VALUES (:company_id, :intern_id)';

    try {
    $pdo = connect();
    $pdo->beginTransaction();
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':company_id', $company_id, PDO::PARAM_INT);
    $stmt->bindValue(':intern_id', $intern_id, PDO::PARAM_INT);
    $favorite = $stmt->execute();
    $pdo->commit();
    return $favorite;
    } catch(\Exception $e) {
      $pdo->rollBack();
      return $favorite = false;
    }
  }


  public function favoriteCancal($company_id,$intern_id)
  {
    $sql = 'DELETE FROM favorite WHERE company_id = :company_id AND intern_id = :intern_id';

    try {
    $pdo = connect();
    $pdo->beginTransaction();
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':company_id', (int)$company_id, PDO::PARAM_INT);
    $stmt->bindValue(':intern_id', (int)$intern_id, PDO::PARAM_INT);
    $favorite = $stmt->execute();
    $pdo->commit();
    return $favorite;
    } catch(\Exception $e) {
      $pdo->rollBack();
      return $favorite = false;
    }
  }


  public function getFavoriteById($company_id)
  {
    $sql = 'SELECT f.id AS お気に入りID, f.company_id AS 企業ID, f.post_id AS リストID, i.id AS i_id, i.title, c.id AS c_id
            FROM intern i
            INNER JOIN favorites f
            ON f.post_id = i.id
            INNER JOIN companies c
            ON f.company_id = c.id
            WHERE f.company_id = :company_id';
    try {
      $stmt = connect()->prepare($sql);
      $stmt->bindValue(':company_id', (int)$company_id, PDO::PARAM_INT);
      $stmt->execute();
      $favorite = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $favorite;
    } catch(\Exception $e) {
      return $favorite = false;
    }
  }
}
