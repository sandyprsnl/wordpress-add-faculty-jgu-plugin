<?php
class ShortCodeFacultyAjax
{
    private $wpdb;
    private $wpdb_tablename;
    private $totalfaculty;
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->wpdb_tablename = $this->wpdb->prefix . 'faculty';
        add_action('wp_ajax_shortcodeAjaxLoadfaculty', array($this, 'shortcodeAjaxLoadfaculty'));
        add_action('wp_ajax_loadSchooles', array($this, 'loadSchooles'));
        add_action('wp_ajax_nameSchoolesFilters', array($this, 'nameSchoolesFilters'));
    }
    private function gettotalfaculties()
    {
        $totalfaculties =  $this->wpdb->get_results("SELECT COUNT(id) as total FROM $this->wpdb_tablename ");
        return $total = $totalfaculties[0]->total;
    }
    public function shortcodeAjaxLoadfaculty()
    {

        $row = $_POST['row'];
        $nameFilter = $_POST['namefilter'];
        $schoolfilter = $_POST['schoolfilter'];
        $rowperpage = 3;
        $total = $this->gettotalfaculties();
        $facultiesquery = "SELECT * FROM $this->wpdb_tablename ";
        if (!empty($schoolfilter) || !empty($nameFilter)) {

            $facultiesquery .= "WHERE name ='" . $nameFilter . "' OR school_name = '" . $schoolfilter . "' ";
        }
        $facultiesquery .= " limit $row,$rowperpage ";
        $facultiesresult =  $this->wpdb->get_results($facultiesquery);

        $facultyhtml = $this->facultyhtml($facultiesresult);
        wp_send_json_success(array('html' => $facultyhtml, 'total' => $total), 200);
    }
    public function loadSchooles()
    {

        $schooles =  $this->wpdb->get_results("SELECT DISTINCT school_name FROM $this->wpdb_tablename ");
        $schooleshtml = "<option value='*'>All</option>";
        foreach ($schooles as $schoole) {
            $schooleshtml .= "<option value='" . $schoole->school_name . "'>" . $schoole->school_name . "</option>";
        }
        wp_send_json_success($schooleshtml, 200);
    }
    public function nameSchoolesFilters()
    {
        if (!$_POST) {
            return;
        }
        $row = $_POST['row'];
        $nameFilter = $_POST['namefilter'];
        $schoolfilter = $_POST['schoolfilter'];
        $rowperpage = 3;
        $total = $this->gettotalfaculties();
        $facultiesquery = "SELECT * FROM $this->wpdb_tablename ";
        if (!empty($schoolfilter) || !empty($nameFilter)) {

            $facultiesquery .= "WHERE name ='" . $nameFilter . "' OR school_name = '" . $schoolfilter . "' ";
        }
        $facultiesquery .= " limit $row,$rowperpage ";
        // print_r($facultiesquery);
        $facultiesresult =  $this->wpdb->get_results($facultiesquery);

        $facultyhtml = $this->facultyhtml($facultiesresult);
        wp_send_json_success(array('html' => $facultyhtml, 'total' => $total), 200);
    }
    private function facultyhtml(array $faculties)
    {
        $facultyhtml = '';
        foreach ($faculties as $faculty) {
            $facultyhtml .= "
           <div class='col-sm-3'>
           
           <div class='card faculty-card' id=#card-" . $faculty->id . ">
                   <img class='card-img-top faculty-img' src='" . $faculty->image_url . "'
                       alt='Card image cap'>
                   <div class='card-body'>
                       <h3 class='card-text faculty-name text-center'>" . $faculty->name . "</h3>
                       <p class='card-text faculty-school text-center'>" . $faculty->school_name . "</p>
                   </div>
              </div>
           </div>
           ";
        }
        return $facultyhtml;
    }
}
new ShortCodeFacultyAjax();
