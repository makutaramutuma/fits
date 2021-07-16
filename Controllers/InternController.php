<?php
require_once(ROOT_PATH.'/Models/Intern.php');

class InternController{
  private $Intern;

  public function __construct(){
    $this->Intern=new Intern();
  }

  public function index(){
    $intern=$this->Intern->findAll();
    $params=[
      'intern'=>$intern
    ];
    return $params;
  }
}

?>
<?php ?>
