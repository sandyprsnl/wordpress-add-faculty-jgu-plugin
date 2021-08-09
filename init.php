<?php

class Init
{
    private $loadFiles;
    public static function register()
    {
        new self();
    }
    public function __construct()
    {
        add_shortcode('custom-news', array($this, 'newshortcode'));
        add_shortcode('custom-faculty', array($this, 'facultyshortcode'));
        // add_action('wp_enqueue_scripts', array($this, 'enqueue_js'));
        add_action('admin_enqueue_scripts', array($this, 'admin_css_js'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_css'));
        add_action('init', array($this, 'addEventSubmenues'));
        add_action('init', array($this, 'addNewsSubmenues'));
        $this->load_files();
    }
    public function load_files()
    {
        if (file_exists(NECPATH . 'menues.php')) {
            require_once NECPATH . 'menues.php';
        }
        if (file_exists(NECPATH . 'db_tables.php')) {
            require_once NECPATH . 'db_tables.php';
        }
        if (file_exists(NECPATH . 'ajax/add-faculty-ajax.php')) {
            require_once NECPATH . 'ajax/add-faculty-ajax.php';
        }
        if (file_exists(NECPATH . 'ajax/shortcode_faculty-ajax.php')) {
            require_once NECPATH . 'ajax/shortcode_faculty-ajax.php';
        }
    }
    public function newshortcode()
    {

        $modal = new NewsShortCode();
        $message = $modal->modal()->createmodal();
        return $message;
    }
    public function facultyshortcode($atts)
    {
        $attr = shortcode_atts(array(
            'files' => false,
            'faculty' => false
        ), $atts);
        $this->loadFiles = $attr['files'];
        if ($attr['faculty'] == true) {
            $this->enqueue_js();
            // $this->enqueue_css();
            $modal = new FacultyShortCode();
            $message = $modal->modal()->createmodal();
            return $message;
        }
    }
    public function addEventSubmenues()
    {
        // set up labels
        $labels = array(
            'name' => 'Events',
            'singular_name' => 'Event',
            'add_new' => 'Add New Event',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'new_item' => 'New Event',
            'all_items' => 'All Events',
            'view_item' => 'View Event',
            'search_items' => 'Search Events',
            'not_found' => 'No Events Found',
            'not_found_in_trash' => 'No Events found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'Events',
        );
        //register post type
        register_post_type(
            'event',
            array(
                'labels' => $labels,
                'has_archive' => true,
                'public' => true,
                'supports' => array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes'),
                'taxonomies' => array('post_tag', 'category'),
                'exclude_from_search' => false,
                'capability_type' => 'post',
                'rewrite' => array('slug' => 'events'),
            )
        );
    }
    public function addNewsSubmenues()
    {
        $labels = array(
            'name' => 'News',
            'singular_name' => 'News',
            'add_new' => 'Add New News',
            'add_new_item' => 'Add New News',
            'edit_item' => 'Edit News',
            'new_item' => 'New News',
            'all_items' => 'All News',
            'view_item' => 'View News',
            'search_items' => 'Search News',
            'not_found' => 'No News Found',
            'not_found_in_trash' => 'No News found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'News',
        );
        //register post type
        register_post_type(
            'news',
            array(
                'labels' => $labels,
                'has_archive' => true,
                'public' => true,
                'supports' => array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes'),
                'taxonomies' => array('post_tag', 'category'),
                'exclude_from_search' => false,
                'capability_type' => 'post',
                'rewrite' => array('slug' => 'news'),
            )
        );
    }
    function event_column_content($column, $id)
    {
        if ($column === 'custom_post_id_clmn') {
            echo $id;
        }
        if ($column === 'event_date') {
            echo get_post_meta($id, 'date', true);
        }
    }
    function event_add_column($columns)
    {
        $columns['custom_post_id_clmn'] = 'ID';
        $columns['event_date'] = 'Event Date'; // $columns['Column ID'] = 'Column Title';
        // print_r($columns);
        return $columns;
    }
    public function enqueue_css()
    {
        wp_enqueue_style('bootstrap-css', NECURL . 'assets/css/bootstrap/bootstrap.min.css', array(), '4.7');
        wp_enqueue_style('faculty-css', NECURL . 'assets/css/faculty.css', array(), '1.0');
    }
    public function enqueue_js()
    {
        wp_enqueue_script('jquery-main-js', NECURL . 'assets/js/jquery.js', array(), '3.6');
        // wp_enqueue_script('booking-validation-js', NECURL . 'assets/validation.js', array(), '1.0');
        wp_enqueue_script('bootstrap-js', NECURL . 'assets/js/bootstrap/bootstrap.min.js', array('jquery-js'), '4.7');
        wp_enqueue_script('bootstrap-bundle-js', NECURL . 'assets/js/bootstrap/bootstrap.bundle.min.js', array('jquery-js'), '4.7');
        wp_enqueue_script('faculty-js', NECURL . 'assets/js/faculty.js', array('jquery-main-js'), '1.0');
        wp_localize_script(
            'faculty-js',
            'CPT_obj',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'home_url' => home_url()
            )
        );
    }
    function admin_css_js()
    {
        //admin js
        $screen = get_current_screen();
        if ($screen->id == "toplevel_page_jgu-faculty") {
            wp_enqueue_media();
            wp_enqueue_script('jquery-js', NECURL . 'assets/js/jquery.js', array(), '3.6');
            wp_enqueue_script('bootstrap-js', NECURL . 'assets/js/bootstrap/bootstrap.min.js', array('jquery-js'), '4.7');
            wp_enqueue_script('bootstrap-bundle-js', NECURL . 'assets/js/bootstrap/bootstrap.bundle.min.js', array('jquery-js'), '4.7');
            wp_enqueue_script('datatables', NECURL . 'assets/DataTables/datatables.min.js', array(), '4.9.3');
            wp_enqueue_script('faculty-admin-js', NECURL . 'assets/js/faculty-admin.js', array(), '1.0');
            wp_localize_script(
                'faculty-admin-js',
                'faculty_admin_obj',
                array(
                    'ajax_url' => admin_url('admin-ajax.php'),
                )
            );
            //admin css
            wp_enqueue_style('bootstrap-css', NECURL . 'assets/css/bootstrap/bootstrap.min.css', array(), '4.7');
            wp_enqueue_style('tabulator-css', NECURL . 'assets/DataTables/datatables.min.css', array(), '4.7');
            wp_enqueue_style('admin-faculty-css', NECURL . 'assets/css/admin-faculty.css', array(), '4.7');
        }
    }
}
