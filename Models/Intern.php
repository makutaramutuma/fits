<?php
require_once(ROOT_PATH.'/Models/Db.php');

class Intern extends Db {

  public function __construct($dbh=null){
    parent::__construct($dbh);
  }

  public function findAll():Array{
    $sql = 'SELECT * FROM intern' ;
    $sth=$this->dbh->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  ?>
