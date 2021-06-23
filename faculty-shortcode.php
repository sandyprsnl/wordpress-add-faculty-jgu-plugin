<?php
class FacultyShortCode
{
  private $modal;
  private $postdata=array();
  public function modal()
  {
    return $this;
    
  }
  public function postData(){
    
  }
  public function createmodal()
  {
    require_once NECPATH.'templates/faculty.php'; 
    // return $this;
   
  }
  
}
