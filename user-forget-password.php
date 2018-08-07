<?php
/**
 * User forget password process
 * included all function related to forget password
 */

/*=============================================================================================
 * Change User Password ( Frontend Only When User Logged In )
================================================================================================*/
// [dcrf_change_password] use this shortcode for change password
add_shortcode('dcrf_change_password','dcrf_change_password_func');

function dcrf_change_password_func(){

    if (is_user_logged_in()) {

        $current_user   = dcrf_get_current_user_data();
        $currnt_user_id = $current_user->ID;

        if (isset($_POST['chn_pass_submit_btn'])) {

            $user_old_pass      = $_POST['chn_pass_old_pass'];
            $user_new_pass      = $_POST['chn_pass_new_pass'];
            $user_confrm_pass   = $_POST['chn_pass_confrm_pass'];

            if ($user_old_pass && $user_new_pass && $user_confrm_pass) {

                $user_info = get_userdata($currnt_user_id);
                if ($user_new_pass == $user_confrm_pass ) {

                    if ( $currnt_user_id && wp_check_password( $user_old_pass, $user_info->user_pass, $currnt_user_id) ) {

                        wp_set_password( $user_new_pass, $currnt_user_id );

                        dcrf_add_wp_errors('chn_pass_sucess', '<div class="alert alert-success"><div class="alert_icon"><i class="icon-check"></i></div><div class="alert_wrapper"> Password Change Successfully</div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');

                    }else {
                        dcrf_add_wp_errors('chn_pass_invalid_old_pass', '<div class="alert alert-danger"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> Invalid Old Password </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
                    }
                }else{
                    dcrf_add_wp_errors('chn_pass_not_match', '<div class="alert alert-danger"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> Password And Confirm Password Not Match </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
                }
            }else{
                dcrf_add_wp_errors('chn_pass_fill_all_fields', '<div class="alert alert-danger"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> Fill All Required Fields </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
            }
        }
        ?>
        <?php echo dcrf_get_error_messages('chn_pass_sucess'); ?>
        <?php echo dcrf_get_error_messages('chn_pass_invalid_old_pass'); ?>
        <?php echo dcrf_get_error_messages('chn_pass_not_match'); ?>
        <?php echo dcrf_get_error_messages('chn_pass_fill_all_fields'); ?>
        
        <div class="dcrf_change_password_wrap">
            <h5 class="title">Change Password</h5>
            <div class="row">
                <form id="change_pass_form" method="POST" action="">
                    <div class="col-sm-12 prf_user_password">
                        <label>Old Password</label>
                        <input type="password" name="chn_pass_old_pass" class="form-control" placeholder="Old Password">
                    </div>
                    <div class="col-sm-12 prf_user_password">
                        <label>Password</label>
                        <input type="password" id="chn_pass_new_pass" name="chn_pass_new_pass" onkeyup="CheckPasswordStrength(this.value)" class="form-control" placeholder="Password">
                        <span id="password_strength"></span>
                    </div>
                    <div class="col-sm-12 prf_user_password">
                        <label>Conform Password</label>
                        <input type="password" id="chn_pass_confrm_pass" name="chn_pass_confrm_pass" onkeyup="chn_pass_checkPass(); return false;" class="form-control" placeholder="Confirm Password">
                    </div>
                    <div class="col-md-12 pb-3"><span id="chn_pass_check_msg"></span></div>

                    <div class="col-md-12 pb-4">
                        <input type="submit" name="chn_pass_submit_btn" class="btn btn-primary" value="Submit">
                    </div>
                </form>

            </div>
        </div>

        <script type="text/javascript">
            function chn_pass_checkPass(){
                    var reg_user_pass = document.getElementById('chn_pass_new_pass');
                    var reg_user_confrm_pass = document.getElementById('chn_pass_confrm_pass');
                    var message = document.getElementById('chn_pass_check_msg');

                    if(reg_user_pass.value == reg_user_confrm_pass.value){
                    message.style.color = "#66cc66";
                            message.innerHTML   = "Password Match"
                    }else{
                    message.style.color = "#c13f31";
                            message.innerHTML   = "Password Not Match"    
                    }
            }

            function CheckPasswordStrength(password) {
                var password_strength = document.getElementById("password_strength");
                var chn_pass_new_pass = document.getElementById("chn_pass_new_pass");

            //TextBox left blank.
            if (password.length == 0) {
                password_strength.innerHTML = "";
                return;
            }

            //Regular Expressions.
            var regex = new Array();
            regex.push("[a-z]"); //Lowercase Alphabet.
            regex.push("[0-9]"); //Digit.
            regex.push("[$@$!%*#?&]"); //Special Character.
            var passed = 0;
            //Validate for each Regular Expression.
            for (var i = 0; i < regex.length; i++) {
                if (new RegExp(regex[i]).test(password)) {
                    passed++;
                }
            }
            //Validate for length of Password.
            if (passed > 5 && password.length > 8) {
                passed++;
            }
            //Display status.
            var color = "";
            var strength = "";
            switch (passed) {
                case 0:
                case 1:
                strength = "Weak";
                color = "red";
                break;
                case 2:
                strength = "Good";
                color = "darkorange";
                break;
                case 3:
                case 4:
                strength = "Strong";
                color = "green";
                break;
                case 5:
                strength = "Very Strong";
                color = "darkgreen";
                break;
            }
            password_strength.innerHTML = strength;
            password_strength.style.color = color;
            chn_pass_new_pass.style.color = color;
        }
    </script>
    <?php
}else{
    echo '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> You Haven\'t Permission to access this page</div><a href="#" class="close"><i class="icon-cancel"></i></a></div>';
}
}












































/*=====================================================================
 || Forget Password Process
 ======================================================================*/
// Add Shortcode for Forget Password Form and process

 add_shortcode( 'dcrf_forget_password', 'dcrf_forget_password_func' );
 if(!function_exists('dcrf_forget_password_func')){
    function dcrf_forget_password_func(){
        $message = '';
        if (is_user_logged_in()) {
            echo '<div class="alert alert_info"><div class="alert_icon"><i class="icon-help"></i></div><div class="alert_wrapper"> You Are Already Logged In</div><a href="#" class="close"><i class="icon-cancel"></i></a></div>';
        }else{

            //-> Forget Password Link Check
            $reset_key = (isset($_GET['reset_password'])) ? $_GET['reset_password'] : '';

            if (empty($reset_key)) {

                if (isset($_POST['login_user_forget_pass_btn'])) {
                    $forget_user_email = $_POST['login_user_forget_email'];

                    // User by username
                    if (is_email( $forget_user_email )) {
                        if(email_exists( $forget_user_email )){
                            $forget_user_info = get_user_by( 'email', $forget_user_email );
                        }else{
                            $message = '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> Invalid Email</div><a href="#" class="close"><i class="icon-cancel"></i></a></div>';
                        }
                    }else{
                        if ( username_exists( $forget_user_email )) {
                            $forget_user_info = get_user_by( 'login', $forget_user_email );
                        }else{
                            $message = '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> Invalid Username</div><a href="#" class="close"><i class="icon-cancel"></i></a></div>';
                        }
                    }
                    
                    // user Info By email And Username

                    if (isset($forget_user_info)) {

                        $user_id = $forget_user_info->ID;
                        $user_email = $forget_user_info->user_email;

                            //$key_approve = get_user_meta($user_id,'pw_user_status',true);

                            // if($key_approve !='approved'){
                            //     $message = '<div class="alert alert-warning">Your Account are '.$key_approve.' .You can not reset you password</div>';

                            // }elseif($user_id) {

                        $temp_pass = wp_generate_password(20);
                        global $wpdb;

                        $update_user_key = $wpdb->update( $wpdb->prefix . 'users', 
                            array( 'user_activation_key' => $temp_pass), array( 'ID' => $user_id )
                        );

                        $subject = 'Reset Your Profile Password';
                        $body = 'Please <a href="'.site_url('/forget-password/?reset_password='.$temp_pass).'"><b>Click Here</b></a> to reset password.';

                            //echo $body;

                            $headers = array('Content-Type: text/html; charset=UTF-8');// For Send html data

                            $mail_status = wp_mail( $user_email, $subject, $body, $headers );

                            if($mail_status) {
                                $message = '<div class="alert alert_info"><div class="alert_icon"><i class="icon-help"></i></div><div class="alert_wrapper"> Please check your email. Password Reset Link has been send to your register email</div><a href="#" class="close"><i class="icon-cancel"></i></a></div>';
                            } else {
                                $message = '<div class="alert alert-warning"><span>There is some error to send email. please try after some time</span></div>';
                            }
                            //}// $user_id close
                    } // forget_user_info            
                }
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $message; ?>
                            <form name="forget_password_form" method="POST" action="">
                                <div class="form-group">
                                    <label>Email / Username</label>
                                    <input type="text" name="login_user_forget_email" class="form-control input-sm" placeholder="Email or Username" required>
                                </div>
                                
                                <div class="form-group">
                                    <input type="submit" name="login_user_forget_pass_btn" class="btn forget_pass_submit_btn" value="Submit">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <?php
            }else{

                //-> Reset Password Link Process
                if (!$reset_key) return "You haven't Permission To Acess This page";

                if (isset($_POST['forget_new_pass_btn'])) {

                    $forget_new_pass = $_POST['forget_new_pass'];
                    $forget_new_c_pass = $_POST['forget_new_confrm_pass'];

                    if ($forget_new_pass && $forget_new_c_pass && $forget_new_pass == $forget_new_c_pass) {
                        $hash_new_pass =  wp_hash_password($forget_new_pass);
                        global $wpdb;
                        $update_new_pass = $wpdb->update( $wpdb->prefix.'users', 
                            array( 'user_pass' => $hash_new_pass,'user_activation_key' => ''), 
                            array( 'user_activation_key' => $reset_key )
                        );

                        if($update_new_pass) {
                            $reset_msg = '<div class="sucess alert alert-success"><span class="successlogin">Password reset successfully.</span></div>';
                        } else {
                            $reset_msg = '<div class="sucess alert alert-danger"><span class="errorlogin">Invalid reset key.</span></div>';
                        }
                    }else{
                        $reset_msg = '<div class="sucess alert alert-danger"><span>New Password And Confirm Password did not match</span></div>';
                    }
                }
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if(isset($reset_msg)) : echo $reset_msg; endif; ?>

                            <form name="reset_password_link" method="POST" action="">
                                <div class="form-group">
                                    <label>Enter your new password</label>
                                    <input type="password" name="forget_new_pass" id="forget_new_pass" class="form-control input-sm" placeholder="New Password" required>
                                </div>

                                <div class="form-group">
                                    <label>Confirm new password</label>
                                    <input type="password" name="forget_new_confrm_pass" id="forget_new_confrm_pass" class="form-control input-sm" placeholder="Confirm New Password" onkeyup="forget_user_checkPass(); return false;" required>
                                    <span id="show_forget_confrm_msg"></span>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="forget_new_pass_btn" class="btn btn-primary" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    /* Forget password confirm msg */
                    function forget_user_checkPass(){
                            var reg_user_pass = document.getElementById('forget_new_pass');
                            var reg_user_confrm_pass = document.getElementById('forget_new_confrm_pass');
                            var message = document.getElementById('show_forget_confrm_msg');

                            if(reg_user_pass.value == reg_user_confrm_pass.value){
                            message.style.color = "#66cc66";
                                    message.innerHTML = "Password Match"
                            }else{
                            message.style.color = "#ff6666";
                                    message.innerHTML = "Password Not Match"
                            }
                    }
                </script>
                <?php

            }
        }
    }

} //-> Forget_password_func


/*==================================== Forget Password end  ===================================================*/
