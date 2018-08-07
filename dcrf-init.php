<?php
/**
 * User Custom functions
 * Include login,register,profile
 * @author Devkaran Patidar
 * @package Developer
 */

if ( defined( 'ABSPATH' ) && ! defined( 'DCRF_PATH' ) ) {
	define( 'DCRF_PATH', dirname( __FILE__ ) );
}

    list( $path, $url ) = dcrf_get_file_url( dirname( dirname( __FILE__ ) ) );
    // Plugin URLs, for fast enqueuing scripts and styles
    define( 'DCRF_URL', $url );

// Hide Admin Bar
add_action('after_setup_theme', 'dcrf_remove_admin_bar');
function dcrf_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

/*----------------------------------------------------------------------------------
 || Added new role for job posting
-----------------------------------------------------------------------------------*/

function dcrf_manage_user_roles() {
    global $wp_roles;
    
    // Advisor
    add_role( 'ab_advisor', __( 'Advisor', 'boat_lst' ), array('unfiltered_html' => true,'upload_files' => true,) );
    // Firm
    add_role( 'ab_firm', __( 'Firm', 'boat_lst' ), array('unfiltered_html' => true,'upload_files' => true,) );
    $firm_roles = get_role( 'ab_firm' );
    $firm_roles->add_cap('edit_posts');
    $firm_roles->add_cap('delete_posts');

    // Remove "read" Capability For "subscriber" Role.
    $role_subscriber = get_role( 'subscriber' );
    $role_subscriber->remove_cap( 'read' );
    $role_subscriber->add_cap('upload_files');
    $role_subscriber->add_cap('unfiltered_html');
}
add_action( 'init', 'dcrf_manage_user_roles' );

/**
 * Get current user data
 * @param $output ->all data
 */
function dcrf_get_current_user_data( $output = '', $user_id = false ){

    if ($user_id) {
        $user_data = get_userdata( $user_id );
    }else{
        global $current_user;
        $user_data = wp_get_current_user();
    }
    if (!empty($output)) {
        // Check If User Data Available
        if (property_exists($user_data, 'data') && $output != 'roles') {
            return $user_data->{$output};
        }
        // Return If User roles Available
        if (property_exists($user_data, $output) && $output == 'roles') {
            return implode(" ",$user_data->roles);
        }
    }else{
        return $user_data;
    }

}

/**
 * Get Current User meta data
 * @param $metakey -> metakey
 */
function dcrf_current_user_meta( $meta_key, $user_id = '', $output = true ){

    if (empty($user_id)) {
        $user_id = dcrf_get_current_user_data()->ID;
    }

    return get_user_meta($user_id, $meta_key, $output);
}

/**
 * Update Current User meta data
 * @param $metakey -> metakey
 */
function dcrf_update_current_user_meta( $meta_key, $value='', $user_id = '' ){

    if (empty($user_id)) {
        $user_id = dcrf_get_current_user_data()->ID;
    }

    if (!empty($meta_key) && is_array($meta_key)) {
        foreach ($meta_key as $key => $value) {
            update_user_meta( $user_id, $key, $value );    
        }
    }else{
        update_user_meta( $user_id, $meta_key, $value );
    }

}


/**
 * Get current user Roles
 * @param $output -> User_roles
 */
function dcrf_get_user_roles( $roles = '', $user_id = '' ){

    if ($user_id) {
        $user_data = get_userdata( $user_id );
    }else{
        global $current_user;
        $user_data = wp_get_current_user();
    }

    // Get User Roles
    if (property_exists($user_data, 'roles')) {
        $user_roles = implode(" ",$user_data->roles);
    }else{
        $user_roles = '';
    }
    
    if (!empty($roles)) {
        if (is_array($roles)) {
            return ( in_array($user_roles, $roles) ) ? true : false;
        }else{
            return ( $roles == $user_roles ) ? true : false;
        }
    }else{
        return $user_roles;
    }

}


/**
 * Post Meta By ID
 */

function dcrf_get_post_meta( $metakey, $post_id){
    
    return get_post_meta( $post_id, $metakey, true );
    
}

add_filter('body_class', function (array $classes) {
    if (is_page('login')) {
        $classes[] = 'dcrf_login_page';
    }
  return $classes;
});


/**============================================================================
 * wordpress error handling
 =============================================================================*/
// Add errors with codes
function dcrf_add_wp_errors( $code = '' , $msg = '' ){
    
    static $wp_error; // Will hold global variable safely
    $errors = isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
    if ($code || $msg) {
        return $errors->add( $code, $msg );
    }else{
        return $errors;
    }
}

// get storage errors
function dcrf_get_error_messages( $code = '' ){
    if ($code) {
        $errors = dcrf_add_wp_errors()->get_error_messages( $code );
        if ($errors) {
            return (isset($errors[0])) ? $errors[0] : '';
        }
    }else{
        return dcrf_add_wp_errors()->get_error_messages();
    }
}


// /**
//  * Get current user role
//  */
// // Get current user role
// function boat_lst_cureent_user_info(){
//     global $current_user;
//     return $current_user;
// }

// // get current user role
// function boat_lst_get_current_user_roles(){
    
//     global $current_user;

//     $current_user = wp_get_current_user();
//     $current_user_role = implode(" ",$current_user->roles);

//     return $current_user_role;
// }


// included registration form  process

require_once DCRF_PATH . '/user-register.php';
require_once DCRF_PATH . '/user-login.php';
require_once DCRF_PATH . '/user-profile.php';
require_once DCRF_PATH . '/user-dashboard.php';
require_once DCRF_PATH . '/user-forget-password.php';
require_once DCRF_PATH . '/user-settings.php';
require_once DCRF_PATH . '/user-documents.php';

if (is_admin()) {
    require_once DCRF_PATH . '/user-admin-functions.php';
}


/**
 * Get plugin base path and URL.
 * The method is static and can be used in extensions.
 *
 * @link http://www.deluxeblogtips.com/2013/07/get-url-of-php-file-in-wordpress.html
 * @param string $path Base folder path
 * @return array Path and URL.
 */

function dcrf_get_file_url( $path = '' ) {
    // Plugin base path
    $path       = wp_normalize_path( untrailingslashit( $path ) );
    $themes_dir = wp_normalize_path( untrailingslashit( dirname( realpath( get_stylesheet_directory() ) ) ) );

    // Default URL
    $url = plugins_url( '', $path . '/' . basename( $path ) . '.php' );

    // Included into themes
    if (
        0 !== strpos( $path, wp_normalize_path( WP_PLUGIN_DIR ) )
        && 0 !== strpos( $path, wp_normalize_path( WPMU_PLUGIN_DIR ) )
        && 0 === strpos( $path, $themes_dir )
    ) {
        $themes_url = untrailingslashit( dirname( get_stylesheet_directory_uri() ) );
        $url        = str_replace( $themes_dir, $themes_url, $path );
    }

    $path = trailingslashit( $path );
    $url  = trailingslashit( $url );

    return array( $path, $url );
}

/**
 * Include plugin styles and scripts
 */

add_action( 'wp_enqueue_scripts', 'dcrf_add_styles_script_func' );

function dcrf_add_styles_script_func(){

    wp_enqueue_style( 'dcrf-styles', DCRF_URL.'/DCRF/css/dcrf-style.css', array(), '1.0.0', 'all');
    
    /* Load Theme Script */
    //wp_enqueue_script( 'jquery' );
    // wp_enqueue_script( 'jquery-ui-accordion' );

    // wp_enqueue_style( 'wp-color-picker');
    // wp_enqueue_script( 'wp-color-picker');
    
    //wp_enqueue_media(); 
    
    //wp_enqueue_script('jquery-ui-datepicker');

    wp_register_script( 'dcrf-jquery', DCRF_URL.'/DCRF/js/dcrf-script.js' );
    wp_enqueue_script( 'dcrf-jquery' );
    // wp_localize_script( 'dmof-jquery', 'dmof_ajax_object',array(
    //                     'ajax_url'          => admin_url( 'admin-ajax.php' ),
    //                     'current_user_id'   => get_current_user_id(),
    //                     'site_url'          => site_url(),
    //                 ) );
}







/**
 * User categories
 */

/**
 * Registers the 'boat_user_categories' taxonomy for users.  This is a taxonomy for the 'user' object type rather than a 
 * post being the object type.
 */

add_action('init','dmof_register_user_taxonomy');

function dmof_register_user_taxonomy() {

     register_taxonomy(
        'boat_user_categories',
        'users',
        array(
            'public' => true,
            'hierarchical'=> true,
            'labels' => array(
                'name'          => __( 'Categories' ),
                'singular_name' => __( 'Categories' ),
                'menu_name'     => __( 'Categories' ),
                'search_items'  => __( 'Search Categories' ),
                'popular_items' => __( 'Popular Categories' ),
                'all_items'     => __( 'All Categories' ),
                'edit_item'     => __( 'Edit Categories' ),
                'update_item'   => __( 'Update Categories' ),
                'add_new_item'  => __( 'Add New Categories' ),
                'new_item_name' => __( 'New Categories Name' ),
                'separate_items_with_commas'    => __( 'Separate boat_user_categoriess with commas' ),
                'add_or_remove_items'           => __( 'Add or remove boat_user_categoriess' ),
                'choose_from_most_used'         => __( 'Choose from the most popular boat_user_categoriess' ),
            ),
            'rewrite' => array(
                'with_front'    => true,
                'slug'          => 'boat_user_categories' // Use 'author' (default WP user slug).
            ),
            'capabilities' => array(
                'manage_terms'  => 'edit_users', // Using 'edit_users' cap to keep this simple.
                'edit_terms'    => 'edit_users',
                'delete_terms'  => 'edit_users',
                'assign_terms'  => 'read',
            ),
            'update_count_callback' => 'my_update_boat_user_categories_count' // Use a custom function to update the count.
        )
    );
}



/**
 * Function for updating the 'boat_user_categories' taxonomy count.  What this does is update the count of a specific term 
 * by the number of users that have been given the term.  We're not doing any checks for users specifically here. 
 * We're just updating the count with no specifics for simplicity.
 *
 * See the _update_post_term_count() function in WordPress for more info.
 *
 * @param array $terms List of Term taxonomy IDs
 * @param object $taxonomy Current taxonomy object of terms
 */
function my_update_boat_user_categories_count( $terms, $taxonomy ) {
    global $wpdb;

    foreach ( (array) $terms as $term ) {

        $count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );

        do_action( 'edit_term_taxonomy', $term, $taxonomy );
        $wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
        do_action( 'edited_term_taxonomy', $term, $taxonomy );
    }
}

/* Adds the taxonomy page in the admin. */
add_action( 'admin_menu', 'my_add_boat_user_categories_admin_page' );

/**
 * Creates the admin page for the 'boat_user_categories' taxonomy under the 'Users' menu.  It works the same as any 
 * other taxonomy page in the admin.  However, this is kind of hacky and is meant as a quick solution.  When 
 * clicking on the menu item in the admin, WordPress' menu system thinks you're viewing something under 'Posts' 
 * instead of 'Users'.  We really need WP core support for this.
 */
function my_add_boat_user_categories_admin_page() {

    $tax = get_taxonomy( 'boat_user_categories' );

    add_users_page(
        esc_attr( $tax->labels->menu_name ),
        esc_attr( $tax->labels->menu_name ),
        $tax->cap->manage_terms,
        'edit-tags.php?taxonomy=' . $tax->name
    );
}


/* Create custom columns for the manage boat_user_categories page. */
add_filter( 'manage_edit-boat_user_categories_columns', 'my_manage_boat_user_categories_user_column' );

/**
 * Unsets the 'posts' column and adds a 'users' column on the manage boat_user_categories admin page.
 *
 * @param array $columns An array of columns to be shown in the manage terms table.
 */
function my_manage_boat_user_categories_user_column( $columns ) {

    unset( $columns['posts'] );

    $columns['users'] = __( 'Users' );

    return $columns;
}

/* Customize the output of the custom column on the manage boat_user_categoriess page. */
add_action( 'manage_boat_user_categories_custom_column', 'my_manage_boat_user_categories_column', 10, 3 );

/**
 * Displays content for custom columns on the manage boat_user_categoriess page in the admin.
 *
 * @param string $display WP just passes an empty string here.
 * @param string $column The name of the custom column.
 * @param int $term_id The ID of the term being displayed in the table.
 */
function my_manage_boat_user_categories_column( $display, $column, $term_id ) {

    if ( 'users' === $column ) {
        $term = get_term( $term_id, 'boat_user_categories' );
        echo $term->count;
    }
}















/**
 *
 *
 *
 *
 */


 // Get current user roles
//dcrf_get_current_user_data('roles')

/**
 * Create A snackbar temp info popup
 * use function dcrf_snackbars_temp_info_popup('DEV');
 */
function dcrf_snackbars_temp_info_popup($content="Some text some message..",$time_stamp=100){
    ?>
    <style>
        #snackbar {visibility: hidden;min-width: 250px;margin-left: -125px;background-color: #a5de5c;color: #fff;text-align: center;border-radius: 2px;padding: 16px;position: fixed;z-index: 1;left: 50%;bottom: 30px;font-size: 17px;}
        #snackbar.show {visibility: visible;-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;animation: fadein 0.5s, fadeout 0.5s 2.5s;}
        @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;} 
        to {bottom: 30px; opacity: 1;}
        }
        @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
        }
        @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;} 
        to {bottom: 0; opacity: 0;}
        }
        @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
        }
    </style>

    <div id="snackbar"><?php echo $content; ?></div>

    <script type="text/javascript">
        setTimeout(function(){myFunction();}, <?php echo $time_stamp; ?>);
        function myFunction() {
            var x = document.getElementById("snackbar")
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
    </script>
    <?php
}



/**
 * Visitor Counter Function
 * Count VIsitor By Days, Month, Years
 * User Meta Key for get Meta data
 * @param $object_id -> POSTID or AUTHOREID
 * dcrf_visitor_count_MonthNumber_FullYearNumber
 * @return Array of visitor by days ( NOTE : This function not return Anything )
 * @return array keys is Date ( NOTE : This function not return Anything )
 */
function dcrf_visitor_count_by_days($object_id){
    
    if ($object_id) {
    
        $current_month_year = date('_m_Y');
        $current_date = date('d');
        $visitor_data = '';
        $visitor_data[$current_date] = 1;

        $visited_user = dcrf_current_user_meta('dcrf_visitor_count'.$current_month_year,$object_id);
        if (!empty($visited_user) && is_array($visited_user)) {
            // If Current Day Exist
            if (array_key_exists($current_date, $visited_user)) {
                if (isset($visited_user[$current_date])) {
                    $current_date_data = $visited_user[$current_date];
                    $visited_user[$current_date] = $current_date_data + 1;
                    // Update NEW Exist Date Data
                    dcrf_update_current_user_meta('dcrf_visitor_count'.$current_month_year, $visited_user, $object_id);
                }
            }else{
                $merge_data = $visited_user + $visitor_data;
                dcrf_update_current_user_meta('dcrf_visitor_count'.$current_month_year, $merge_data, $object_id);
            }
        //-> If Data Empty
        }else{
            dcrf_update_current_user_meta('dcrf_visitor_count'.$current_month_year, $visitor_data, $object_id);
        }

    }
}