<?php
/**
 * Custom login form functions
 */


/**
 * Login form on reload
 */
// Shortcode for login [dcrf_login_form title=login]
add_shortcode( 'dcrf_login_form', 'dcrf_user_login_form_shortcode' );

function dcrf_user_login_form_shortcode( $atts ) {

    $atts = shortcode_atts( array(
        'title'     => get_the_title(),
    ), $atts, 'dcrf_login_form' );

    if (is_user_logged_in()) {
        echo do_shortcode('[alert style="success"] You are already login [/alert]');
    }else{

        ?>
        
        <?php echo dcrf_get_error_messages('login_fill_all_fields'); ?>
        <?php echo dcrf_get_error_messages('login_invalid_user'); ?>
        <div class="dcrf_login_form">
            <div class="column main">
                <form method="POST" action="">
                    <div class="column one">
                        <label>Email or Username:</label>
                        <span class="first-name">
                            <input type="text" name="user_name" value="" required>
                        </span>
                    </div>
                    <div class="column one">
                        <label>Password:</label>
                        <span class="first-name">
                            <input type="password" name="user_pass" value="" required>
                        </span>
                    </div>

                    <!-- <div class="column one">
                        <span class="first-name">
                            <input type="checkbox" name="casl" value=""> CASL 
                        </span>
                    </div> -->
                    <div class="column one">
                        <input type="submit" class="theme_btn" name="login_submit" value="Login">
                        <a href="<?php echo site_url('forget-password/'); ?>">Forgot password?</a>
                    </div>
                    <div class="column one">
                        <p>Don't Have An Account. Register <a href="<?php echo site_url('register'); ?>">Click Here</a></p>
                    </div>
                </form>
            </div>
        </div>


        <?php
    }
}

// Add login process hooks
function dcrf_user_login_process() {

    if(isset($_POST['login_submit']) && $_POST['login_submit']){

        $user_login     = $_POST['user_name'];
        $user_password  = $_POST['user_pass'];

        if( $user_login && $user_password ){

            $creds = array();
            $creds['user_login']    = $user_login;
            $creds['user_password'] = $user_password;
            $creds['remember']      = true;
            $user = wp_signon( $creds, false );
            if ( is_wp_error( $user ) ) {
                dcrf_add_wp_errors()->add( 'login_invalid_user', '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> we don\'t recognize that email address, username or password</div><a href="#" class="close"><i class="icon-cancel"></i></a></div>' );
            }else{
                $user_roles = implode(" ",$user->roles);
                if ($user_roles == 'administrator') {
                    wp_redirect( admin_url(), 301 ); exit;
                }else{
                    wp_redirect( site_url('dashboard'), 301 ); exit;
                }
            }

        }else{
            dcrf_add_wp_errors()->add( 'login_fill_all_fields', '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> Fill all required fields</div><a href="#" class="close"><i class="icon-cancel"></i></a></div>' );
        }
        
    }
}
add_action( 'init', 'dcrf_user_login_process' ); // run it before the headers and cookies are sent

// Redirect to homepage after succesful login when another user is logged
function dcrf_after_login_redirect( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) { //is there a user to check?
        if ( in_array( 'administrator', $user->roles ) ) { //check for admins
            return $redirect_to; // redirect them to the default place
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}
add_filter( 'login_redirect', 'dcrf_after_login_redirect', 10, 3 );


/**
 * Logout Page
 */
// Shortcode for Logout [dcrf_login_form title=login]
add_shortcode( 'dcrf_logout', 'dcrf_user_logout_shortcode' );
function dcrf_user_logout_shortcode( $atts ) {

    $atts = shortcode_atts(array(
        'url'     => home_url(),
    ), $atts, 'dcrf_logout' );

    wp_logout();
    ob_start();
    wp_redirect( $atts['url'], 301 ); exit;
}









/**
 * Login form with ajax
 */

/*========================================================
 || User Registration Process
 ========================================================*/
//add_action( 'wp_ajax_ejobb_register_function', 'ejobb_register_func' );
// add_action( 'wp_ajax_nopriv_dcrf_login_ajax_function', 'dcrf_login_ajax_func' );

// function dcrf_login_ajax_func(){

//      // Ajax Login process

//     if(isset($_POST['user_name'])){
//         $user_login = $_POST['user_name'];
//         $user_password = $_POST['user_pass'];

//         $creds = array();
//         $creds['user_login'] = $user_login;
//         $creds['user_password'] = $user_password;
//         $creds['remember'] = $remember;
//         $login_user = wp_signon( $creds, false );
//         if ( is_wp_error($login_user) ){
//             // Add Login error message
//             echo json_encode(array('type' => 'wrong_credentials' , 'msg' => '<div class="alert-danger">Du har angett felaktiga uppgifter!</div>' ));
//             //login_error_msg()->add('login_credentials_error', __('Username and passwords do not match'));
//         }else{
//             echo json_encode(array('type' => 'login_sucess' , 'msg' => '<div class="alert-success">logga framgångsrikt</div>' ));
//         }
//         exit;
//     }
// }

// function ejobb_login_redirect( $redirect_to, $request, $user ) {
//     //is there a user to check?
//     if ( isset( $user->roles ) && is_array( $user->roles ) ) {
//         //check for admins
//         if ( in_array( 'administrator', $user->roles ) ) {
//             // redirect them to the default place
//             return $redirect_to;
//         } else {
//             return home_url();
//         }
//     } else {
//         return $redirect_to;
//     }
// }

// add_filter( 'login_redirect', 'ejobb_login_redirect', 10, 3 );


/*?>

<script type="text/javascript">
// User Login Process
    jQuery('#user_login_submit').click(function(event){
    
        event.preventDefault();
        var this_var = jQuery(this);
        this_var.attr('disabled','disabled');

        this_var.next(".login_loder").addClass("lode_tr");

        var user_name = jQuery('#user_login_email').val();
        var user_pass = jQuery('#user_login_pass').val();

        jQuery.ajax({
            type : "POST",
            url  : ejobb_ajax_object.ajax_url,
            data : {
                action : 'dcrf_login_ajax_function',
                user_name : user_name,
                user_pass : user_pass,

            },
            dataType: "json",
            success: function(data){
                this_var.removeAttr('disabled');
                this_var.next(".login_loder").removeClass("lode_tr");
                if (data.type == 'wrong_credentials') {
                    jQuery('.login_form_message').html(data.msg);
                    jQuery( ".login_form_message div.alert-danger" ).effect( "shake", {times:2}, 1000 );;
                }
                if (data.type == 'login_sucess') {
                    window.location.href = ejobb_ajax_object.site_url;
                }
            }
        })
    });
</script>

<form class="form-signin" id="user_login_form" method="POST" action="">
    <h3 class="text-center">Inloggningsformulär</h3>

    <div class="login_form_message"></div>
    
    <div class="form-group">
        <label for="inputEmail" class="sr-only">E-post</label>
        <input id="user_login_email" name="user_name" class="form-control" placeholder="E-post" type="text" required>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="sr-only">Lösenord</label>
        <input id="user_login_pass" name="user_pass" class="form-control" placeholder="Lösenord" type="password" required>
    </div>

    <div class="forget-passwoed">
        <a href="<?php echo site_url('/glomt-losenord/'); ?>">Glömt lösenord</a>
    </div>
    <input type="submit" class="btn btn-primary" id="user_login_submit" name="login_submit" value="Logga in">
    <div class="login_loder"></div><!-- Loader -->
</form>
*/