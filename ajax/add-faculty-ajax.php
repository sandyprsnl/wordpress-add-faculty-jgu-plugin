<?php

class Faculty
{
    private $wpdb;
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        add_action('wp_ajax_loadFaculty', array($this, 'loadFaculty'));
        add_action('wp_ajax_addFaculty', array($this, 'addFaculty'));
        add_action('wp_ajax_deleteFaculty', array($this, 'deleteFaculty'));
        add_action('wp_ajax_editFaculty', array($this, 'editFaculty'));
        add_action('wp_ajax_UpdateFaculty', array($this, 'UpdateFaculty'));
    }
    public function loadFaculty()
    {
        $final_array = [];
        $wpdb_tablename = $this->wpdb->prefix . 'faculty';
        $faculties =  $this->wpdb->get_results("SELECT id,name,image_url,school_name FROM $wpdb_tablename", ARRAY_A);
        for ($i = 0; $i <= count($faculties) - 1; $i++) {
            $id = $faculties[$i]['id'];
            $newfaculties = array('sr' => $i, 'image' => "<img src='" . $faculties[$i]['image_url'] . "'/>", 'action' => "<img class='edit-faculty' edit-faculty='" . $id . "' src='" . NECURL . "assets/img/pencil.svg' ><img class='delete-faculty' delete-faculty='" . $id . "' src='" . NECURL . "assets/img/delete.svg' >");
            $final_array[] = array_reverse(array_merge($faculties[$i], $newfaculties));
        }
        wp_send_json_success($final_array, 200);
    }

    public function addFaculty()
    {
        if (!$_POST) {
            wp_send_json_error("Something wrong please try after sometime", 404);
            return;
        }


        if (isset($_POST['facultynonce']) && wp_verify_nonce($_POST['facultynonce'], 'add_faculty')) {

            $action = $_POST['action'];
            $fname = sanitize_text_field($_POST['fname']);
            $schoolename = sanitize_text_field($_POST['schoolename']);
            $imgurl = esc_url_raw($_POST['imgurl']);
            $schoolid = sanitize_text_field($_POST['schoolid']);
            $fid = sanitize_text_field($_POST['fid']);

            $query = $this->wpdb->insert("{$this->wpdb->base_prefix}faculty", array(
                "name" => $fname,
                "image_url" => $imgurl,
                "school_name" => $schoolename,
                'school_order' => $schoolid,
                'faculty_order' => $fid,
            ));
            if ($query) {
                wp_send_json_success('Faculty added Successfully', 200);
            } else {
                wp_send_json_error("Something wrong please try after sometime", 404);
                return;
            }
        } else {
            wp_send_json_error("Something wrong please try after sometime", 404);
            return;
        }
    }
    public function deleteFaculty()
    {
        if ($_POST['action'] == 'deleteFaculty') {
            $result = $this->wpdb->delete("{$this->wpdb->base_prefix}faculty", array('id' => $_POST['delte_data_id']));
            if ($result) {
                wp_send_json_success('faculty deleted Scccessfully', 200);
            } else {
                wp_send_json_success('Something wrong please try after sometime', 404);
            }
        }
    }
    public function editFaculty()
    {
        if ($_POST['action'] == 'editFaculty') {
            $editid = $_POST['editid'];
            $wpdb_tablename = $this->wpdb->prefix . 'faculty';
            $editfaculties =  $this->wpdb->get_results("SELECT id,name,image_url,school_name,school_order,faculty_order FROM $wpdb_tablename WHERE id=$editid");
            wp_send_json_success($editfaculties, 200);
        }
    }
    public function UpdateFaculty()
    {
        if (!$_POST) {
            wp_send_json_error("Something wrong please try after sometime", 502);
            return;
        }


        if (isset($_POST['facultynonce']) && wp_verify_nonce($_POST['facultynonce'], 'update_faculty')) {
            $fname = sanitize_text_field($_POST['fname']);
            $schoolename = sanitize_text_field($_POST['schoolename']);
            $schoolid = sanitize_text_field($_POST['schoolid']);
            $fid = sanitize_text_field($_POST['fid']);
            $imgurl = esc_url_raw($_POST['imgurl']);
            $data = array(
                "name" => $fname,
                "image_url" => $imgurl,
                "school_name" => $schoolename,
                'school_order' => (int)$schoolid,
                'faculty_order' => (int)$fid,
            );
            $where = ['id' => $_POST['id']];
            $updatequery = $this->wpdb->update($this->wpdb->prefix . 'faculty', $data, $where);
            // print_r($this->wpdb);
            if ($updatequery) {
                wp_send_json_success('Faculty Updated Successfully', 200);
            } else {
                wp_send_json_error("Something wrong please try after sometime", 502);
                return;
            }
        } else {
            wp_send_json_error("Something wrong please try after sometime", 404);
            return;
        }
    }
}
new Faculty();
