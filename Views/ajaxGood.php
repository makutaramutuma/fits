<?php
//共通変数・関数ファイルを読込み
session_start();
// postがある場合
if(isset($_POST['i_id'])){
    $i_id = $_POST['i_id'];
    $u_id = $_POST['u_id'];


    try{
        //DB接続
        $db = new PDO('mysql:dbname=fits;host=localhost', 'root', 'root');
        $posts = $db->prepare("
        SELECT *
        FROM favorite
        WHERE intern_id = $i_id AND user_id = $u_id
        ");
        // goodテーブルから投稿IDとユーザーIDが一致したレコードを取得するSQL文
        $posts->execute();

        // クエリ実行
        $resultCount = $posts->rowCount();
        // レコードが1件でもある場合
        if($resultCount>=1){
            // レコードを削除する
            $deletes = $db->prepare("
            DELETE FROM favorite
            WHERE intern_id = $i_id AND user_id = $u_id
            ");
            // goodテーブルから投稿IDとユーザーIDが一致したレコードを取得するSQL文
            $deletes->execute();

            echo "お気に入り登録";
        }else{
            // レコードを挿入する
            $db->beginTransaction();
             $sql = "INSERT INTO favorite (intern_id,user_id) VALUES (:intern_id, :user_id)";
             $stmt = $db->prepare($sql);
             $params = array(':intern_id' => $i_id, ':user_id' => $u_id);
             $stmt->execute($params);
             $db->commit();

            echo "お気に入り解除";
        }
    }catch(Exception $e){
        error_log('エラー発生：'.$e->getMessage());
    }
}
