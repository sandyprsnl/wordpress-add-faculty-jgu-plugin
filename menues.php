<?php
class AddMenues
{
    public function __construct()
    {
        add_action( 'admin_menu', array($this,'AddFacultyMenu' ));
    }
public function AddFacultyMenu(){
    add_menu_page(
        "JGU Faculty",
         "JGU Faculty", 
         "manage_options", 
         "jgu-faculty", 
         array($this,'all_faculty'), 
         'dashicons-id-alt', 
         21 );
        //  add_submenu_page("all-faculty", 
        //  "Add Schools", 
        //  "Add Schools", 
        //  "manage_options", 
        //  "add-schools", 
        //  array($this,'add_schools')
        // );
}
public function addSubmenues(){
    
}
public function all_faculty(){
if(file_exists(NECPATH.'templates/add_faculty.php')){
    require_once NECPATH.'templates/add_faculty.php';
}
}
public function add_schools(){
    if(file_exists(NECPATH.'templates/add_schools.php')){
        require_once NECPATH.'templates/add_schools.php';
    }
    }
    
}
new AddMenues();
