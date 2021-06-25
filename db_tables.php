<?php
class CPT_db
{
    private $wpdb,$charset_collate;
    public function __construct()
    {
        global $wpdb;

        $this->wpdb=$wpdb;
        $this->charset_collate = $this->wpdb->get_charset_collate();
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    }
    public function create_tables(){
        

$faculty_table = "CREATE TABLE IF NOT EXISTS `{$this->wpdb->base_prefix}faculty` (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  image_url varchar(255) NOT NULL,
  school_name varchar(255) NOT NULL,
  school_order int NOT NULL,
  faculty_order int NOT NULL,
  created_at datetime default now(),
  PRIMARY KEY  (id)
) $this->charset_collate;";

// $school_table= "CREATE TABLE IF NOT EXISTS `{$this->wpdb->base_prefix}faculty_school` (
//     id int NOT NULL AUTO_INCREMENT,
//     schoole_name varchar(255) NOT NULL,
//     created_at datetime NOT NULL,
//     PRIMARY KEY  (id)
//   ) $this->charset_collate;";

dbDelta($faculty_table);
// dbDelta($school_table);
    }
    
}
$db = new CPT_db();
$db->create_tables();
