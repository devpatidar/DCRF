<?php
/**
 * Users Profile Section
 */


/**------------------------------------------------------------------------------------------------------------
 * User profile for Frontend
 */

    /*===========================================================================================================
     || User Profile Section
     =============================================================================================================*/
    // Shortcode For Show user profile
     add_shortcode( 'dcrf_user_profile', 'dcrf_user_profile_func');
     function dcrf_user_profile_func(){

        //-> Check If Firm Advisor Page GET
        if (!isset($_GET['advisor_profile'])) {

            if (isset($_POST['update_dash_profile_info'])) {

                $current_user_data  = dcrf_get_current_user_data();
                $crrnt_user_id = $current_user_data->ID;

                $first_name                 = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
                $last_name                  = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
                $phone_number               = (isset($_POST['phone_number'])) ? $_POST['phone_number'] : '';
                $office_address             = (isset($_POST['office_address'])) ? $_POST['office_address'] : '';
                $investment_dealer_name     = (isset($_POST['investment_dealer_name'])) ? $_POST['investment_dealer_name'] : '';
                $country                    = (isset($_POST['country'])) ? $_POST['country'] : '';
                $state                      = (isset($_POST['state'])) ? $_POST['state'] : '';
                $city                       = (isset($_POST['city'])) ? $_POST['city'] : '';
                $postal_code                = (isset($_POST['postal_code'])) ? $_POST['postal_code'] : '';
                $governing_regulatory_body  = (isset($_POST['governing_regulatory_body'])) ? $_POST['governing_regulatory_body'] : '';
                if (dcrf_get_current_user_data('roles') == 'ab_advisor' || dcrf_get_current_user_data('roles') == 'administrator') :
                    $looking_to_accomplish      = (isset($_POST['looking_to_accomplish'])) ? $_POST['looking_to_accomplish'] : '';
                endif;
                $update_prof_qry = wp_update_user( array( 
                    'ID'                => $crrnt_user_id,
                    'first_name'        => $first_name,
                    'last_name'         => $last_name,
                    //'user_email'        => $_POST['edit_user_email'],
                ) );
                // Update User meta
                update_user_meta($crrnt_user_id, 'first_name', $first_name);
                update_user_meta($crrnt_user_id, 'last_name', $last_name);
                update_user_meta($crrnt_user_id, 'phone_number', $phone_number);
                update_user_meta($crrnt_user_id, 'office_address', $office_address);
                update_user_meta($crrnt_user_id, 'investment_dealer_name', $investment_dealer_name);
                update_user_meta($crrnt_user_id, 'country', $country);
                update_user_meta($crrnt_user_id, 'state', $state);
                update_user_meta($crrnt_user_id, 'city', $city);
                update_user_meta($crrnt_user_id, 'postal_code', $postal_code);
                update_user_meta($crrnt_user_id, 'governing_regulatory_body', $governing_regulatory_body);
                if (dcrf_get_current_user_data('roles') == 'ab_advisor' || dcrf_get_current_user_data('roles') == 'administrator') :
                    update_user_meta($crrnt_user_id, 'looking_to_accomplish', $looking_to_accomplish);
                endif;
                if ( is_wp_error( $update_prof_qry ) ) { 
                    dcrf_add_wp_errors('udpi_error_in_update','<div class="alert alert-danger" role="alert">Error In Update</div>');
                }else{
                    dcrf_add_wp_errors('udpi_sucess_update','<div class="alert alert-success col-md-8" role="alert">Profile Sucessfully Updated</div>');
                }
            }

            /**
             * User Profile Bio Update
             */

            if (isset($_POST['update_dash_profile_bio'])) {

                $current_user_data  = dcrf_get_current_user_data();
                $crrnt_user_id = $current_user_data->ID;

                $profile_bio_text = (isset($_POST['profile_bio_text'])) ? $_POST['profile_bio_text'] : '';
                
                $update_prof_qry = wp_update_user( array( 
                    'ID'            => $crrnt_user_id,
                    'description'   => $profile_bio_text
                ) );
            }

            /**
             * Profile Pic Update
             */
            // Check that the nonce is valid, and the user can edit this post.
            $current_user_data  = dcrf_get_current_user_data();
            $crrnt_user_id = $current_user_data->ID;

            if ( 
                isset( $_POST['profile_picture_nonce'], $crrnt_user_id ) 
                && wp_verify_nonce( $_POST['profile_picture_nonce'], 'profile_picture' )
            ) {
                // The nonce was valid and the user has the capabilities, it is safe to continue.
                // These files need to be included as dependencies when on the front end.
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                
                // Let WordPress handle the upload.
                // Remember, 'my_image_upload' is the name of our file input in our form above.
                $attachment_id  = media_handle_upload( 'profile_picture', $crrnt_user_id );
                $attach_url     = wp_get_attachment_url($attachment_id);

                $attchment_data = array(
                    'id'    => $attachment_id,
                    'url'   => $attach_url,
                );
                update_user_meta( $crrnt_user_id, 'profile_picture', $attchment_data );

                if ( is_wp_error( $attachment_id ) ) {
                    //echo 'Error in attchment';
                } else {
                    //echo 'Image Uploaded';
                }
            } else {
                //echo 'Check Nonce Data';
            }
            ?>
            <div class="row error col-md-6">
                <?php echo dcrf_get_error_messages('udpi_error_in_update'); ?>
                <?php echo dcrf_get_error_messages('udpi_sucess_update'); ?>
            </div>
            <div class="row">
                <!-- Left Content -->
                <div class="col-md-8">
                    <div class="dcrf_user_profile_info">
                        <!-- Tabs -->
                  <!--       <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#user-profile-content" role="tab" data-toggle="tab">Personal Info</a></li>
                        </ul> -->
                        <!-- Tabs Content -->

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active show" id="user-profile-content">
                                <form class="form-control" method="POST" action="">
                                    <h4 class="title">Personal Info</h4>
                                    <div class="row">
                                        <div class="column col-md-6 pt-2 pb-2">
                                            <label>First Name *</label>
                                            <span class="first-name">
                                                <input class="form-control" type="text" name="first_name" value="<?php echo dcrf_current_user_meta('first_name'); ?>" required>
                                            </span>
                                        </div>
                                        <div class="column col-md-6 pt-2 pb-2">
                                            <label>Last Name</label>
                                            <span class="last-name">
                                                <input class="form-control" type="text" name="last_name" value="<?php echo dcrf_current_user_meta('last_name'); ?>">
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Row 2 -->
                                    <div class="row">
                                        <div class="column col-md-6 pt-2 pb-2">
                                            <label>Email Address *</label>
                                            <span class="your-email">
                                                <input class="form-control" type="email" value="<?php echo dcrf_get_current_user_data()->user_email; ?>" disabled>
                                            </span>
                                        </div>
                                        <div class="column col-md-6 pt-2 pb-2">
                                            <label>Phone Number</label>
                                            <span class="last-name">
                                                <input class="form-control" type="number" name="phone_number" value="<?php echo dcrf_current_user_meta('phone_number'); ?>">
                                            </span>
                                        </div>
                                    </div>


                                    <!-- Row 3 -->
                                    <div class="row">
                                        <div class="col-md-12 pt-2 pb-2">
                                            <label>Office Address</label>
                                            <textarea class="form-control" name="office_address" rows="1" cols="50"><?php echo dcrf_current_user_meta('office_address'); ?></textarea>
                                        </div>
                                    </div>

                                    <!-- Row 4 -->
                                    <div class="row">
                                        <div class="column col-md-6 pt-2 pb-2">
                                            <label>Investment Dealer Name:</label>
                                            <span class="your-subject">
                                                <input class="form-control" type="text" name="investment_dealer_name" value="<?php echo dcrf_current_user_meta('investment_dealer_name'); ?>">
                                            </span>
                                        </div>
                                        <div class="column col-md-6 pt-2 pb-2">
                                            <label>Country:</label>
                                            <span class="country">
                                                <input class="form-control" type="text" name="country" value="<?php echo dcrf_current_user_meta('country'); ?>">
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Row 5 -->
                                    <div class="row">
                                        <div class="col-md-4 pt-2 pb-2">
                                            <label>Province:</label>
                                            <span class="your-subject">
                                                <input class="form-control" type="text" name="state" value="<?php echo dcrf_current_user_meta('state'); ?>">
                                            </span>
                                        </div>
                                        <div class="col-md-4 pt-2 pb-2">
                                            <label>City:</label>
                                            <span class="city">
                                                <input class="form-control" type="text" name="city" value="<?php echo dcrf_current_user_meta('city'); ?>">
                                            </span>
                                        </div>
                                        <div class="col-md-4 pt-2 pb-2">
                                            <label>Postal Code:</label>
                                            <span class="city">
                                                <input class="form-control" type="text" name="postal_code" value="<?php echo dcrf_current_user_meta('postal_code'); ?>">
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Row 6 -->
                                    <div class="row">
                                        <div class="col-md-6 pt-2 pb-2">
                                            <label>Governing Regulatory Body:</label>
                                            <span class="country">
                                                <?php $grbody = dcrf_current_user_meta('governing_regulatory_body'); ?>
                                                <select class="form-control" name="governing_regulatory_body">
                                                    <option value="mfda_advisor" <?php echo ($grbody == 'mfda_advisor') ? 'selected' : ''; ?>>MFDA Advisor</option>
                                                    <option value="iiroc_advisor" <?php echo ($grbody == 'iiroc_advisor') ? 'selected' : ''; ?>>IIROC Advisor</option>
                                                    <?php if (dcrf_get_current_user_data('roles') == 'ab_firm') : ?>
                                                        <option value="mfda_and_iiroc" <?php echo ($grbody == 'mfda_and_iiroc') ? 'selected' : ''; ?>>MFDA & IIROC Dealer</option>
                                                    <?php endif; ?>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <?php if (dcrf_get_current_user_data('roles') == 'ab_advisor' || dcrf_get_current_user_data('roles') == 'administrator') : ?>
                                        <div class="row">
                                            <div class="col-md-12 pt-2 pb-2">
                                                <label>As an advisor I am looking to accomplish the following objective: </label>
                                            </div>
                                            <div class="col-md-12 pt-2 pb-2">
                                                <?php $looking_acmplish = dcrf_current_user_meta('looking_to_accomplish'); ?>

                                                <label class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="looking_to_accomplish[]" <?php echo ( is_array($looking_acmplish) && in_array('sell_my_book_of_business',$looking_acmplish) ) ? 'checked' : ''; ?> value="sell_my_book_of_business">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Sell my book of business</span>
                                                </label>
                                                <label class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="looking_to_accomplish[]" <?php echo ( is_array($looking_acmplish) && in_array('purchase_a_book_of_business',$looking_acmplish) ) ? 'checked' : ''; ?> value="purchase_a_book_of_business">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Purchase a book of business</span>
                                                </label>
                                                <label class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="looking_to_accomplish[]" <?php echo ( is_array($looking_acmplish) && in_array('change_firm',$looking_acmplish) ) ? 'checked' : ''; ?> value="change_firm">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Change firm</span>
                                                </label>
                                                <label class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="looking_to_accomplish[]" <?php echo ( is_array($looking_acmplish) && in_array('certification_of_my_book_of_business',$looking_acmplish) ) ? 'checked' : ''; ?> value="certification_of_my_book_of_business">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">An evaluation and certification of my book of business</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="col-md-12 mt-4 mb-2">
                                            <input class="btn btn-primary" type="submit" name="update_dash_profile_info" value="Update" class="button">
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                Profile
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Content -->
                <div class="col-md-4">
                    <!-- Profile Pic -->
                    <div class="dcrf_user_profile_pic">
                        <h5 class="pic_title">My Profile</h5>
                        <div class="text-center">
                            <?php
                            $prof_pic = dcrf_current_user_meta('profile_picture');
                            $thumbnail = '';
                            if (is_array($prof_pic)) {
                                $id = $prof_pic['id'];
                                if ($id) {
                                    $thumbnail = wp_get_attachment_image_url($id,'medium');
                                }
                                ?><img src="<?php echo $thumbnail; ?>" class="mx-auto img-fluid img-circle d-block" alt="avatar"><?php
                            }else{
                                ?><img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar"><?php
                            }
                            ?>
                            <h6 class="mt-2">Upload a different photo</h6>
                            <label class="custom-file">
                                <form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
                                    <input type="file" class="file" name="profile_picture" id="profile_picture"  multiple="false" />
                                    <?php wp_nonce_field( 'profile_picture', 'profile_picture_nonce' ); ?>

                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control input-lg" disabled="" placeholder="Upload Image">
                                        <span class="input-group-btn">
                                            <button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                        </span>
                                    </div>
                                    <input id="submit_my_image_upload" class="btn btn-primary m-3" name="submit_my_image_upload" type="submit" value="Upload" />
                                </form>
                                <!-- <span class="custom-file-control">Choose file</span> -->
                            </label>

                        </div>
                    </div>

                    <!-- Profile Bio -->
                    <div class="dcrf_user_profile_bio">
                        <h5 class="pic_title">About Me</h5>
                        <div class="bio-text">
                            <p class="dcrf_user_bio_text"><?php echo dcrf_get_current_user_data()->description; ?></p>
                            <form action="" method="POST" class="prof-bio-form d-none">
                                <textarea class="form-control mb-2" name="profile_bio_text" rows="4" cols="50"><?php echo dcrf_get_current_user_data()->description; ?></textarea>
                                <input type="submit" value="Update" name="update_dash_profile_bio" class="btn btn-primary mb-2">
                            </form>
                        </div>
                        <div class="bio_edit_btn"> 
                            <a href="javascript:void(0);" class="edit-bio-btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i> Edit </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }else{

            // Firm Advisor Profile Start
            if (isset($_POST['update_dash_profile_firm_profile'])) {

                $current_user_data  = dcrf_get_current_user_data();
                $crrnt_user_id      = $current_user_data->ID;

                $advisor_must_register_with     = (isset($_POST['advisor_must_register_with'])) ? $_POST['advisor_must_register_with'] : '';
                $advisor_must_located           = (isset($_POST['advisor_must_located'])) ? $_POST['advisor_must_located'] : '';
                $looking_to_advisor_interested  = (isset($_POST['looking_to_advisor_interested'])) ? $_POST['looking_to_advisor_interested'] : '';
                $we_pay_transfer_fees           = (isset($_POST['we_pay_transfer_fees'])) ? $_POST['we_pay_transfer_fees'] : '';
                $we_will_repapairing_client     = (isset($_POST['we_will_repapairing_client'])) ? $_POST['we_will_repapairing_client'] : '';
                
                // Update User meta
                update_user_meta($crrnt_user_id, 'advisor_must_register_with', $advisor_must_register_with);
                update_user_meta($crrnt_user_id, 'advisor_must_located', $advisor_must_located);
                update_user_meta($crrnt_user_id, 'looking_to_advisor_interested', $looking_to_advisor_interested);
                update_user_meta($crrnt_user_id, 'we_pay_transfer_fees', $we_pay_transfer_fees);
                update_user_meta($crrnt_user_id, 'we_will_repapairing_client', $we_will_repapairing_client);
                
                dcrf_add_wp_errors('udpi_sucess_update','<div class="alert alert-success col-md-8 text-center" role="alert">Profile Sucessfully Updated</div>');
            }

            ?>
            <div class="row error col-md-12">
                <?php echo dcrf_get_error_messages('udpi_error_in_update'); ?>
                <?php echo dcrf_get_error_messages('udpi_sucess_update'); ?>
            </div>
            <div class="row">
                <!-- Left Content -->
                <div class="col-md-8">
                    <div class="dcrf_user_profile_portfolio">
                        <form class="form-control" method="POST" action="">

                            <h5 class="title">Advisor Profile</h5>
                            <div class="row pb-2">
                                <div class="col-md-6">
                                    <label>Advisor must be registered with</label>
                                    <span class="country">
                                        <?php $must_register_with = dcrf_current_user_meta('advisor_must_register_with'); ?>
                                        <select name="advisor_must_register_with" class="form-control">
                                            <option value="mfda" <?php echo ($must_register_with == 'mfda')?'selected':''; ?>>MFDA</option>
                                            <option value="iiroc" <?php echo ($must_register_with == 'iiroc')?'selected':''; ?>>IIROC</option>
                                        </select>
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <label>Advisor must be located in</label>
                                    <span class="your-subject">
                                        <input type="text" class="form-control" name="advisor_must_located" value="<?php echo dcrf_current_user_meta('advisor_must_located'); ?>">
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Row 7 -->
                            <div class="row">
                                <div class="col-md-12 pt-2 pb-2">
                                    <label>We are looking for advisors interested in changing firms</label>
                                </div>
                                <div class="col-md-12 pt-2 pb-2">
                                    <?php $advisor_interested = dcrf_current_user_meta('looking_to_advisor_interested'); ?>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary <?php echo ($advisor_interested =='yes') ?'active':'';?>">
                                            <input type="radio" name="looking_to_advisor_interested" autocomplete="off" <?php echo ($advisor_interested =='yes') ?'checked':'';?> value="yes"> Yes
                                        </label>
                                        <label class="btn btn-primary <?php echo ($advisor_interested =='no') ?'active':'';?>">
                                            <input type="radio" name="looking_to_advisor_interested" <?php echo ($advisor_interested =='no') ?'checked':'';?> autocomplete="off" value="no"> No
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Row 8 -->
                            <div class="row">
                                <div class="col-md-12 pt-2 pb-2">
                                    <h5 class="reg_form_title">We will provide the following services</h5>
                                </div>
                                <div class="col-md-12 pt-2 pb-2">
                                    <label>We are willing to pay transfer fees</label>
                                </div>
                                <div class="col-md-12 pt-2 pb-2">
                                    <?php $transfer_fees = dcrf_current_user_meta('we_pay_transfer_fees'); ?>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary <?php echo ($transfer_fees =='yes') ?'active':'';?>">
                                            <input type="radio" name="we_pay_transfer_fees" autocomplete="off" <?php echo ($transfer_fees =='yes') ?'checked':'';?> value="yes"> Yes
                                        </label>
                                        <label class="btn btn-primary <?php echo ($transfer_fees =='no') ?'active':'';?>">
                                            <input type="radio" name="we_pay_transfer_fees" autocomplete="off" <?php echo ($transfer_fees =='no') ?'checked':'';?> value="no"> No
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-2 pb-2">
                                    <label>We will help with the repapering of client documents</label>
                                </div>
                                <div class="col-md-12 pt-2 pb-2">
                                    <?php $repapairing_client = dcrf_current_user_meta('we_will_repapairing_client'); ?>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary <?php echo ($repapairing_client =='yes') ?'active':'';?>">
                                            <input type="radio" name="we_will_repapairing_client" autocomplete="off" <?php echo ($repapairing_client =='yes') ?'checked':'';?> value="yes"> Yes
                                        </label>
                                        <label class="btn btn-primary <?php echo ($repapairing_client =='no') ?'active':'';?>">
                                            <input type="radio" name="we_will_repapairing_client" autocomplete="off" <?php echo ($repapairing_client =='no') ?'checked':'';?> value="no"> No
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mt-4 mb-2">
                                    <input class="btn btn-primary" type="submit" name="update_dash_profile_firm_profile" value="Update" class="button">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }

    } // dcrf_user_profile_func


    /* Portfolio */
    // Shortcode For Show user profile
    add_shortcode( 'dcrf_user_profile_portfolio', 'dcrf_user_profile_portfolio_func');
    function dcrf_user_profile_portfolio_func(){

        if (isset($_POST['update_dash_profile_port'])) {

            $current_user_data  = dcrf_get_current_user_data();
            $crrnt_user_id = $current_user_data->ID;

            // Common Things
            $aum                            = (isset($_POST['aum'])) ? $_POST['aum'] : '';
            $household_accounts             = (isset($_POST['household_accounts'])) ? $_POST['household_accounts'] : '';
            $client_accounts                = (isset($_POST['client_accounts'])) ? $_POST['client_accounts'] : '';
            $registered_retirement_account  = (isset($_POST['registered_retirement_account'])) ? $_POST['registered_retirement_account'] : '';
            $locked_retirement_account      = (isset($_POST['locked_retirement_account'])) ? $_POST['locked_retirement_account'] : '';
            $tax_free_savings_account       = (isset($_POST['tax_free_savings_account'])) ? $_POST['tax_free_savings_account'] : '';
            $registered_education_savings_plan = (isset($_POST['registered_education_savings_plan'])) ? $_POST['registered_education_savings_plan'] : '';
            $taxable_investment_account     = (isset($_POST['taxable_investment_account'])) ? $_POST['taxable_investment_account'] : '';


            if (dcrf_get_current_user_data('roles') == 'ab_advisor' || dcrf_get_current_user_data('roles') == 'administrator') :
                $high_dollor_amt_by_client      = (isset($_POST['high_dollor_amt_by_client'])) ? $_POST['high_dollor_amt_by_client'] : '';
                $lowest_dollor_amt_by_client    = (isset($_POST['lowest_dollor_amt_by_client'])) ? $_POST['lowest_dollor_amt_by_client'] : '';
                $age_range                      = (isset($_POST['age_range'])) ? $_POST['age_range'] : '';
                $cash_and_cash_equivalents      = (isset($_POST['cash_and_cash_equivalents'])) ? $_POST['cash_and_cash_equivalents'] : '';
                $fixed_income_scurities         = (isset($_POST['fixed_income_scurities'])) ? $_POST['fixed_income_scurities'] : '';
                $equities                       = (isset($_POST['equities'])) ? $_POST['equities'] : '';
                $investment_fund                = (isset($_POST['investment_fund'])) ? $_POST['investment_fund'] : '';
                $leveraged_accounts             = (isset($_POST['leveraged_accounts'])) ? $_POST['leveraged_accounts'] : '';
                $investment_vehicles            = (isset($_POST['investment_vehicles'])) ? $_POST['investment_vehicles'] : '';

                update_user_meta($crrnt_user_id, 'high_dollor_amt_by_client', $high_dollor_amt_by_client);
                update_user_meta($crrnt_user_id, 'lowest_dollor_amt_by_client', $lowest_dollor_amt_by_client);
                update_user_meta($crrnt_user_id, 'age_range', $age_range);
                update_user_meta($crrnt_user_id, 'cash_and_cash_equivalents', $cash_and_cash_equivalents);
                update_user_meta($crrnt_user_id, 'fixed_income_scurities', $fixed_income_scurities);
                update_user_meta($crrnt_user_id, 'equities', $equities);
                update_user_meta($crrnt_user_id, 'investment_fund', $investment_fund);
                update_user_meta($crrnt_user_id, 'leveraged_accounts', $leveraged_accounts);
                update_user_meta($crrnt_user_id, 'investment_vehicles', $investment_vehicles);
            endif;
            // Common Things
            update_user_meta($crrnt_user_id, 'aum', $aum);
            update_user_meta($crrnt_user_id, 'household_accounts', $household_accounts);
            update_user_meta($crrnt_user_id, 'client_accounts', $client_accounts);
            update_user_meta($crrnt_user_id, 'registered_retirement_account', $registered_retirement_account);
            update_user_meta($crrnt_user_id, 'locked_retirement_account', $locked_retirement_account);
            update_user_meta($crrnt_user_id, 'tax_free_savings_account', $tax_free_savings_account);
            update_user_meta($crrnt_user_id, 'registered_education_savings_plan', $registered_education_savings_plan);
            update_user_meta($crrnt_user_id, 'taxable_investment_account', $taxable_investment_account);

            dcrf_add_wp_errors('udpi_sucess_update','<div class="alert alert-success" role="alert">Profile Sucessfully Updated</div>');
            
        }   

        ?>
        <div class="row error col-md-12">
            <?php echo dcrf_get_error_messages('udpi_error_in_update'); ?>
            <?php echo dcrf_get_error_messages('udpi_sucess_update'); ?>
        </div>
        <div class="row">
            <!-- Left Content -->
            <div class="col-md-8">
                <div class="dcrf_user_profile_portfolio">
                    <form class="form-control" method="POST" action="">

                        <h5 class="title">Portfolio</h5>
                        <?php if (dcrf_get_current_user_data('roles') == 'ab_advisor' || dcrf_get_current_user_data('roles') == 'administrator') : ?>
                            <div class="row">
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>AUM:</label>
                                    <span class="your-subject">
                                        <input class="form-control" type="text" name="aum" value="<?php echo dcrf_current_user_meta('aum'); ?>">
                                    </span>
                                </div>
                                <div class="column col-md-6 pt-2 pb-2">
                                    <label>Number of household accounts:</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="household_accounts" value="<?php echo dcrf_current_user_meta('household_accounts'); ?>">
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of client accounts:</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="client_accounts" value="<?php echo dcrf_current_user_meta('client_accounts'); ?>">
                                    </span>
                                </div>
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>How much is the highest dollar amount invested by a client.</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="high_dollor_amt_by_client" value="<?php echo dcrf_current_user_meta('high_dollor_amt_by_client'); ?>">
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>How much is the lowest dollar amount invested by a client.</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="lowest_dollor_amt_by_client" value="<?php echo dcrf_current_user_meta('lowest_dollor_amt_by_client'); ?>">
                                    </span>
                                </div>
                            </div>

                            <!-- Row 12 -->
                            <div class="row">
                                <div class="col-md-12 pt-2 pb-2">
                                    <label>How many clients fall within the following age range</label>
                                </div>
                                <div class="row col">
                                    <?php $age_range = dcrf_current_user_meta('age_range'); ?>
                                    <div class="col-md-4 pb-1">
                                        <input type="text" class="form-control" name="age_range[1_18]" value="<?php echo $age_range['1_18']; ?>">
                                    </div>
                                    <div class="col-md-8 pb-1">
                                        <label>of my clients are between the ages of 1 - 18</label>
                                    </div>

                                    <div class="col-md-4 pb-1">
                                        <input type="text" class="form-control" name="age_range[18_30]" value="<?php echo $age_range['18_30']; ?>">
                                    </div>
                                    <div class="col-md-8 pb-1">
                                        <label>of my clients are between the ages of 18 - 30</label>
                                    </div>

                                    <div class="col-md-4 pb-1">
                                        <input type="text" class="form-control" name="age_range[31_40]" value="<?php echo $age_range['31_40']; ?>">
                                    </div>
                                    <div class="col-md-8 pb-1">
                                        <label>of my clients are between the ages of 31 - 40</label>                                    
                                    </div>
                                    <div class="col-md-4 pb-1">
                                        <input type="text" class="form-control" name="age_range[41_54]" value="<?php echo $age_range['41_54']; ?>">
                                    </div>
                                    <div class="col-md-8 pb-1">
                                        <label>of my clients are between the ages of 41 - 54</label>
                                    </div>
                                    <div class="col-md-4 pb-1">
                                        <input type="text" class="form-control" name="age_range[55_65]" value="<?php echo $age_range['55_65']; ?>">
                                    </div>
                                    <div class="col-md-8 pb-1">
                                        <label>of my clients are between the ages of 55 - 65</label>
                                    </div>
                                    <div class="col-md-4 pb-1">
                                        <input type="text" class="form-control" name="age_range[66_]" value="<?php echo $age_range['66_']; ?>">
                                    </div>
                                    <div class="col-md-8 pb-1">
                                        <label>of my clients are between the ages of 66 +</label>
                                    </div>
                                </div>
                            </div>                        

                            <div class="row col-md-12 pt-2 pb-2">
                                <label>Identify how many clients are invested in the following investment vehicles </label>
                            </div>
                            <div class="row">

                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Cash and Cash equivalents</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="cash_and_cash_equivalents" value="<?php echo dcrf_current_user_meta('cash_and_cash_equivalents'); ?>">
                                    </span>
                                </div>
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Fixed Income Securities</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="fixed_income_scurities" value="<?php echo dcrf_current_user_meta('fixed_income_scurities'); ?>">
                                    </span>
                                </div>

                                <div class="col-md-6 pt-2 pb-2">
                                    <div class="column one-second">
                                        <label>Equities</label>
                                        <span class="city">
                                            <input class="form-control" type="text" name="equities" value="<?php echo dcrf_current_user_meta('equities'); ?>">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-2 pb-2">
                                    <div class="column one-second">
                                        <label>Investment Funds</label>
                                        <span class="city">
                                            <input class="form-control" type="text" name="investment_fund" value="<?php echo dcrf_current_user_meta('investment_fund'); ?>">
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Client account type break down -->
                            <div class="row col-md-12">
                                <h4>Client account type break down</h4>
                            </div>
                            <!-- row 9 -->
                            <div class="row">
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of clients with a Registered Retirement Account (RRSP, RRIF)</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="registered_retirement_account" value="<?php echo dcrf_current_user_meta('registered_retirement_account'); ?>">
                                    </span>
                                </div>
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of clients with a Locked-In Retirement Account (LIRA, LRSP, LIF)</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="locked_retirement_account" value="<?php echo dcrf_current_user_meta('locked_retirement_account'); ?>">
                                    </span>
                                </div>

                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of clients with a Tax-Free Savings Account (TFSA)</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="tax_free_savings_account" value="<?php echo dcrf_current_user_meta('tax_free_savings_account'); ?>">
                                    </span>
                                </div>
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of clients with a Registered Education Savings Plan (RESP)</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="registered_education_savings_plan" value="<?php echo dcrf_current_user_meta('registered_education_savings_plan'); ?>">
                                    </span>
                                </div>
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of Clients with a Taxable Investment Account (Brokerage, Mutual Fund, etc)</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="taxable_investment_account" value="<?php echo dcrf_current_user_meta('taxable_investment_account'); ?>">
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>How many accounts are Leveraged accounts (Monies borrowed to invest)</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="leveraged_accounts" value="<?php echo dcrf_current_user_meta('leveraged_accounts'); ?>">
                                    </span>
                                </div>
                            </div>

                        <?php endif; ?>


                        <?php if (dcrf_get_current_user_data('roles') == 'ab_firm') : ?>
                            <div class="row">
                                <div class="col-md-12 pt-2 pb-2">
                                    <label>The advisors book of businss must fall within the following AUM</label>
                                </div>
                                <div class="col-md-12 pt-2 pb-2">
                                    <?php $business_fall_with_aum = dcrf_current_user_meta('aum'); ?>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="aum[]" <?php echo ( is_array($business_fall_with_aum) && in_array('5_10_million',$business_fall_with_aum) ) ? 'checked' : ''; ?> value="5_10_million"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">$5 Million - $10 Million</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="aum[]" <?php echo ( is_array($business_fall_with_aum) && in_array('10_25_million',$business_fall_with_aum) ) ? 'checked' : ''; ?> value="10_25_million"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">$10 Million - $25 Million</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="aum[]" <?php echo ( is_array($business_fall_with_aum) && in_array('25_50_million',$business_fall_with_aum) ) ? 'checked' : ''; ?> value="25_50_million"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">$25 Million - $50 Million</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="aum[]" <?php echo ( is_array($business_fall_with_aum) && in_array('50_100_million',$business_fall_with_aum) ) ? 'checked' : ''; ?> value="50_100_million"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">$50 Million - $100 Million</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="aum[]" <?php echo ( is_array($business_fall_with_aum) && in_array('100_250_million',$business_fall_with_aum) ) ? 'checked' : ''; ?> value="100_250_million"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">$100 Million - $250 Million</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="aum[]" <?php echo ( is_array($business_fall_with_aum) && in_array('250_500_million',$business_fall_with_aum) ) ? 'checked' : ''; ?> value="250_500_million"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">$250 Million - $500 Million</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="aum[]" <?php echo ( is_array($business_fall_with_aum) && in_array('500_million_plus',$business_fall_with_aum) ) ? 'checked' : ''; ?> value="500_million_plus"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">$500 Million +</span>
                                    </label>
                                </div>

                                <div class="col-md-12 pt-2 pb-2">
                                    <label>We are looking for advisors with the following number of household accounts</label>
                                </div>
                                <div class="col-md-12 pt-2 pb-2">
                                    <?php $household_accounts = dcrf_current_user_meta('household_accounts'); ?>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="household_accounts[]" <?php echo ( is_array($household_accounts) && in_array('1_50_ha',$household_accounts) ) ? 'checked' : ''; ?> value="1_50_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">1 - 50</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="household_accounts[]" <?php echo ( is_array($household_accounts) && in_array('50_100_ha',$household_accounts) ) ? 'checked' : ''; ?> value="50_100_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">50 - 100</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="household_accounts[]" <?php echo ( is_array($household_accounts) && in_array('100_250_ha',$household_accounts) ) ? 'checked' : ''; ?> value="100_250_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">100 - 250</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="household_accounts[]" <?php echo ( is_array($household_accounts) && in_array('250_500_ha',$household_accounts) ) ? 'checked' : ''; ?> value="250_500_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">250 - 500</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="household_accounts[]" <?php echo ( is_array($household_accounts) && in_array('500_1000_ha',$household_accounts) ) ? 'checked' : ''; ?> value="500_1000_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">500 - 1000</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="household_accounts[]" <?php echo ( is_array($household_accounts) && in_array('1000_plus_ha',$household_accounts) ) ? 'checked' : ''; ?> value="1000_plus_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">1000+</span>
                                    </label>
                                </div>

                                <div class="col-md-12 pt-2 pb-2">
                                    <label>We are looking for advisors with the following number of client accounts</label>
                                </div>
                                <div class="col-md-12 pt-2 pb-2">
                                    <?php $client_accounts = dcrf_current_user_meta('client_accounts'); ?>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="client_accounts[]" <?php echo ( is_array($client_accounts) && in_array('1_50_ha',$client_accounts) ) ? 'checked' : ''; ?> value="1_50_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">1 - 50</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="client_accounts[]" <?php echo ( is_array($client_accounts) && in_array('50_100_ha',$client_accounts) ) ? 'checked' : ''; ?> value="50_100_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">50 - 100</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="client_accounts[]" <?php echo ( is_array($client_accounts) && in_array('100_250_ha',$client_accounts) ) ? 'checked' : ''; ?> value="100_250_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">100 - 250</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="client_accounts[]" <?php echo ( is_array($client_accounts) && in_array('250_500_ha',$client_accounts) ) ? 'checked' : ''; ?> value="250_500_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">250 - 500</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="client_accounts[]" <?php echo ( is_array($client_accounts) && in_array('500_1000_ha',$client_accounts) ) ? 'checked' : ''; ?> value="500_1000_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">500 - 1000</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="client_accounts[]" <?php echo ( is_array($client_accounts) && in_array('1000_plus_ha',$client_accounts) ) ? 'checked' : ''; ?> value="1000_plus_ha"><span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">1000+</span>
                                    </label>
                                </div>
                            </div>
                            <!-- Client account type break down -->
                            <div class="row col-md-12 pt-2 pb-2">
                                <h5>We are looking for advisors with the following client account type break down</h5>
                            </div>
                            <!-- row 9 -->
                            <div class="row">
                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of clients with a Registered Retirement Account (RRSP, RRIF)</label>
                                    <span class="country">
                                        <?php $reg_ret_acunt = dcrf_current_user_meta('registered_retirement_account'); ?>
                                        <select name="registered_retirement_account" class="form-control">
                                            <option value="0_10_percent" <?php echo ($reg_ret_acunt =='0_10_percent')?'selected':''; ?>>0% - 10%</option>
                                            <option value="10_20_percent" <?php echo ($reg_ret_acunt =='10_20_percent')?'selected':''; ?>>10% - 20%</option>
                                            <option value="20_30_percent" <?php echo ($reg_ret_acunt =='20_30_percent')?'selected':''; ?>>20% - 30%</option>
                                            <option value="30_40_percent" <?php echo ($reg_ret_acunt =='30_40_percent')?'selected':''; ?>>30% - 40%</option>
                                            <option value="40_50_percent" <?php echo ($reg_ret_acunt =='40_50_percent')?'selected':''; ?>>40% - 50%</option>
                                            <option value="50_60_percent" <?php echo ($reg_ret_acunt =='50_60_percent')?'selected':''; ?>>50% - 60%</option>
                                            <option value="60_70_percent" <?php echo ($reg_ret_acunt =='60_70_percent')?'selected':''; ?>>60% - 70%</option>
                                            <option value="70_80_percent" <?php echo ($reg_ret_acunt =='70_80_percent')?'selected':''; ?>>70% - 80%</option>
                                            <option value="80_90_percent" <?php echo ($reg_ret_acunt =='80_90_percent')?'selected':''; ?>>80% - 90%</option>
                                            <option value="90_100_percent" <?php echo ($reg_ret_acunt =='90_100_percent')?'selected':''; ?>>90% - 100%</option>
                                        </select>
                                    </span>
                                </div>

                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of clients with a Locked-In Retirement Account (LIRA, LRSP, LIF)</label>
                                    <span class="country">
                                        <?php $loked_ret_acunt = dcrf_current_user_meta('locked_retirement_account'); ?>
                                        <select name="locked_retirement_account" class="form-control">
                                            <option value="0_10_percent" <?php echo ($loked_ret_acunt =='0_10_percent')?'selected':''; ?>>0% - 10%</option>
                                            <option value="10_20_percent" <?php echo ($loked_ret_acunt =='10_20_percent')?'selected':''; ?>>10% - 20%</option>
                                            <option value="20_30_percent" <?php echo ($loked_ret_acunt =='20_30_percent')?'selected':''; ?>>20% - 30%</option>
                                            <option value="30_40_percent" <?php echo ($loked_ret_acunt =='30_40_percent')?'selected':''; ?>>30% - 40%</option>
                                            <option value="40_50_percent" <?php echo ($loked_ret_acunt =='40_50_percent')?'selected':''; ?>>40% - 50%</option>
                                            <option value="50_60_percent" <?php echo ($loked_ret_acunt =='50_60_percent')?'selected':''; ?>>50% - 60%</option>
                                            <option value="60_70_percent" <?php echo ($loked_ret_acunt =='60_70_percent')?'selected':''; ?>>60% - 70%</option>
                                            <option value="70_80_percent" <?php echo ($loked_ret_acunt =='70_80_percent')?'selected':''; ?>>70% - 80%</option>
                                            <option value="80_90_percent" <?php echo ($loked_ret_acunt =='80_90_percent')?'selected':''; ?>>80% - 90%</option>
                                            <option value="90_100_percent" <?php echo ($loked_ret_acunt =='90_100_percent')?'selected':''; ?>>90% - 100%</option>
                                        </select>
                                    </span>
                                </div>

                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of clients with a Tax-Free Savings Account (TFSA)</label>
                                    <span class="country">
                                        <?php $tx_fre_svin_acunt = dcrf_current_user_meta('tax_free_savings_account'); ?>
                                        <select name="tax_free_savings_account" class="form-control">
                                            <option value="0_10_percent" <?php echo ($tx_fre_svin_acunt =='0_10_percent')?'selected':''; ?>>0% - 10%</option>
                                            <option value="10_20_percent" <?php echo ($tx_fre_svin_acunt =='10_20_percent')?'selected':''; ?>>10% - 20%</option>
                                            <option value="20_30_percent" <?php echo ($tx_fre_svin_acunt =='20_30_percent')?'selected':''; ?>>20% - 30%</option>
                                            <option value="30_40_percent" <?php echo ($tx_fre_svin_acunt =='30_40_percent')?'selected':''; ?>>30% - 40%</option>
                                            <option value="40_50_percent" <?php echo ($tx_fre_svin_acunt =='40_50_percent')?'selected':''; ?>>40% - 50%</option>
                                            <option value="50_60_percent" <?php echo ($tx_fre_svin_acunt =='50_60_percent')?'selected':''; ?>>50% - 60%</option>
                                            <option value="60_70_percent" <?php echo ($tx_fre_svin_acunt =='60_70_percent')?'selected':''; ?>>60% - 70%</option>
                                            <option value="70_80_percent" <?php echo ($tx_fre_svin_acunt =='70_80_percent')?'selected':''; ?>>70% - 80%</option>
                                            <option value="80_90_percent" <?php echo ($tx_fre_svin_acunt =='80_90_percent')?'selected':''; ?>>80% - 90%</option>
                                            <option value="90_100_percent" <?php echo ($tx_fre_svin_acunt =='90_100_percent')?'selected':''; ?>>90% - 100%</option>
                                        </select>
                                    </span>
                                </div>

                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of clients with a Registered Education Savings Plan (RESP)</label>
                                    <span class="country">
                                        <?php $reg_edu_svin_pln = dcrf_current_user_meta('registered_education_savings_plan'); ?>
                                        <select name="registered_education_savings_plan" class="form-control">
                                            <option value="0_10_percent" <?php echo ($reg_edu_svin_pln =='0_10_percent')?'selected':''; ?>>0% - 10%</option>
                                            <option value="10_20_percent" <?php echo ($reg_edu_svin_pln =='10_20_percent')?'selected':''; ?>>10% - 20%</option>
                                            <option value="20_30_percent" <?php echo ($reg_edu_svin_pln =='20_30_percent')?'selected':''; ?>>20% - 30%</option>
                                            <option value="30_40_percent" <?php echo ($reg_edu_svin_pln =='30_40_percent')?'selected':''; ?>>30% - 40%</option>
                                            <option value="40_50_percent" <?php echo ($reg_edu_svin_pln =='40_50_percent')?'selected':''; ?>>40% - 50%</option>
                                            <option value="50_60_percent" <?php echo ($reg_edu_svin_pln =='50_60_percent')?'selected':''; ?>>50% - 60%</option>
                                            <option value="60_70_percent" <?php echo ($reg_edu_svin_pln =='60_70_percent')?'selected':''; ?>>60% - 70%</option>
                                            <option value="70_80_percent" <?php echo ($reg_edu_svin_pln =='70_80_percent')?'selected':''; ?>>70% - 80%</option>
                                            <option value="80_90_percent" <?php echo ($reg_edu_svin_pln =='80_90_percent')?'selected':''; ?>>80% - 90%</option>
                                            <option value="90_100_percent" <?php echo ($reg_edu_svin_pln =='90_100_percent')?'selected':''; ?>>90% - 100%</option>
                                        </select>
                                    </span>
                                </div>

                                <div class="col-md-6 pt-2 pb-2">
                                    <label>Number of Clients with a Taxable Investment Account (Brokerage, Mutual Fund, etc)</label>
                                    <span class="country">
                                        <?php $tax_invstmnt_acunt = dcrf_current_user_meta('taxable_investment_account'); ?>
                                        <select name="taxable_investment_account" class="form-control">
                                            <option value="0_10_percent" <?php echo ($tax_invstmnt_acunt =='0_10_percent')?'selected':''; ?>>0% - 10%</option>
                                            <option value="10_20_percent" <?php echo ($tax_invstmnt_acunt =='10_20_percent')?'selected':''; ?>>10% - 20%</option>
                                            <option value="20_30_percent" <?php echo ($tax_invstmnt_acunt =='20_30_percent')?'selected':''; ?>>20% - 30%</option>
                                            <option value="30_40_percent" <?php echo ($tax_invstmnt_acunt =='30_40_percent')?'selected':''; ?>>30% - 40%</option>
                                            <option value="40_50_percent" <?php echo ($tax_invstmnt_acunt =='40_50_percent')?'selected':''; ?>>40% - 50%</option>
                                            <option value="50_60_percent" <?php echo ($tax_invstmnt_acunt =='50_60_percent')?'selected':''; ?>>50% - 60%</option>
                                            <option value="60_70_percent" <?php echo ($tax_invstmnt_acunt =='60_70_percent')?'selected':''; ?>>60% - 70%</option>
                                            <option value="70_80_percent" <?php echo ($tax_invstmnt_acunt =='70_80_percent')?'selected':''; ?>>70% - 80%</option>
                                            <option value="80_90_percent" <?php echo ($tax_invstmnt_acunt =='80_90_percent')?'selected':''; ?>>80% - 90%</option>
                                            <option value="90_100_percent" <?php echo ($tax_invstmnt_acunt =='90_100_percent')?'selected':''; ?>>90% - 100%</option>
                                        </select>
                                    </span>
                                </div>
                            </div>

                        <?php endif; ?>


                        <div class="col-md-12 row pt-2 pb-2">
                            <input class="btn btn-primary" type="submit" name="update_dash_profile_port" value="Update" class="button">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <?php
    }


        /**
         * Work Experience Tan
         */

        // Shortcode For Show user profile
        add_shortcode( 'dcrf_employment_history', 'dcrf_employment_history_func');
        function dcrf_employment_history_func(){

            if (isset($_POST['update_dash_profile_em_history'])) {
                $current_user_data  = dcrf_get_current_user_data();
                $crrnt_user_id      = $current_user_data->ID;
                $work_experience    = (isset($_POST['work_experience'])) ? $_POST['work_experience'] : '';
                update_user_meta($crrnt_user_id, 'work_experience', $work_experience);
                dcrf_add_wp_errors('emphis_sucess_update','<div class="alert alert-success col-md-12" role="alert">Employment History Sucessfully Updated</div>');
            }
            ?>
            <div class="row dcrf_user_profile_em_history">
                <div class="col-md-8 form-control">
                    <h5 class="title">Work Experience</h5>
                    <div class="row col-md-12">
                        <?php echo dcrf_get_error_messages('emphis_sucess_update'); ?>
                    </div>

                    <form method="POST" action="">
                        <div class="row work_experience_wrap">
                            <?php 
                            $work_exp_data = dcrf_current_user_meta('work_experience');
                            if (is_array($work_exp_data)) {
                                $i = 1;
                                $j = 0;
                                foreach ($work_exp_data as $key => $value) {
                                    $company_name   = (isset($value['company_name'])) ? $value['company_name'] : '';
                                    $job_title      = (isset($value['job_title'])) ? $value['job_title'] : '';
                                    $duration       = (isset($value['duration'])) ? $value['duration'] : '';
                                    $office_address = (isset($value['office_address'])) ? $value['office_address'] : '';

                                    if ($company_name || $job_title || $duration || $office_address) {
                                        if ($i >= 2) { ?>
                                        <div class="col-md-12 pt-3 exp_title">
                                            <label>Work Experience <?php echo $i; ?>:</label>
                                        </div>
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <label>Company Name</label>
                                            <span class="city">
                                                <input class="form-control" type="text" name="work_experience[<?php echo $j; ?>][company_name]" value="<?php echo $company_name; ?>">
                                            </span>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Job Title</label>
                                            <span class="city">
                                                <input class="form-control" type="text" name="work_experience[<?php echo $j; ?>][job_title]" value="<?php echo $job_title; ?>">
                                            </span>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Year start- End Year</label>
                                            <span class="city">
                                                <input class="form-control" type="text" name="work_experience[<?php echo $j; ?>][duration]" value="<?php echo $duration; ?>">
                                            </span>
                                        </div>
                                        <div class="col-md-12 office-address" data-exp="<?php echo $j; ?>">
                                            <label>Office Address:</label>
                                            <span class="office-address">
                                                <textarea class="form-control" name="work_experience[<?php echo $j; ?>][office_address]" cols="40" rows="1"><?php echo $office_address; ?></textarea>
                                            </span>
                                        </div>
                                        <?php
                                        $i++;
                                        $j++;
                                    }
                                }
                            }else{
                                ?>
                                <div class="col-md-4">
                                    <label>Company Name</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="work_experience[0][company_name]" value="">
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label>Job Title</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="work_experience[0][job_title]" value="">
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label>Year start- End Year</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="work_experience[0][duration]" value="">
                                    </span>
                                </div>
                                <div class="col-md-12 office-address" data-exp="0">
                                    <label>Office Address:</label>
                                    <span class="office-address">
                                        <textarea class="form-control" name="work_experience[0][office_address]" cols="40" rows="1"></textarea>
                                    </span>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-12 pt-2 pb-2">
                            <?php echo do_shortcode('[fancy_link title="Add More Experience" link="javascript:void(0)" target="" style="4" class="add_more_experience" download=""]'); ?>
                        </div>

                        <div class="col-md-12 row pt-2 pb-2">
                            <input class="btn btn-primary" type="submit" name="update_dash_profile_em_history" value="Update" class="button">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <?php
    }//-> DCRF Employment History End

    // Shortcode For Show user profile
    add_shortcode( 'dcrf_user_profile_addendum', 'dcrf_user_profile_addendum_func');
    function dcrf_user_profile_addendum_func(){

        if (isset($_POST['update_dash_profile_addendum'])) {
            $current_user_data  = dcrf_get_current_user_data();
            $crrnt_user_id      = $current_user_data->ID;
            $addendum    = (isset($_POST['addendum'])) ? $_POST['addendum'] : '';
            update_user_meta($crrnt_user_id, 'addendum', $addendum);
            dcrf_add_wp_errors('emphis_sucess_update','<div class="alert alert-success col-md-12" role="alert">Additional Information Sucessfully Updated</div>');
        }
        ?>
        <div class="row dcrf_user_profile_em_history">
            <div class="col-md-8 form-control">
                <h5 class="title">Addendum</h5>
                <div class="row col-md-12">
                    <?php echo dcrf_get_error_messages('emphis_sucess_update'); ?>
                </div>

                <form method="POST" action="">
                    <div class="col-md-12">
                        <label>Additional Information</label>
                        <textarea name="addendum" class="form-control" rows="10" cols="50"><?php echo dcrf_current_user_meta('addendum'); ?></textarea>
                    </div>

                    <div class="col-md-12 pt-4 pb-5">
                        <input class="btn btn-primary" type="submit" name="update_dash_profile_addendum" value="Update" class="button">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php
    }//-> DCRF Employment History End

    /*===================================================
     * Edit Profile Shortcode (Frontend)
    =====================================================*/
    add_shortcode('dcrf_edit_user_profile','dcrf_edit_user_profile_frontend_func');
    function dcrf_edit_user_profile_frontend_func(){
        if (is_user_logged_in()) {

            $current_user_id    = get_current_user_id();
            $current_user_data  = dcrf_get_current_user_data('', $current_user_id);
            
            if (isset($_POST['update_advisor_submit'])) {

                $first_name                 = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
                $last_name                  = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
                $phone_number               = (isset($_POST['phone_number'])) ? $_POST['phone_number'] : '';
                $office_address             = (isset($_POST['office_address'])) ? $_POST['office_address'] : '';
                $investment_dealer_name     = (isset($_POST['investment_dealer_name'])) ? $_POST['investment_dealer_name'] : '';
                $country                    = (isset($_POST['country'])) ? $_POST['country'] : '';
                $state                      = (isset($_POST['state'])) ? $_POST['state'] : '';
                $city                       = (isset($_POST['city'])) ? $_POST['city'] : '';
                $postal_code                = (isset($_POST['postal_code'])) ? $_POST['postal_code'] : '';
                $governing_regulatory_body  = (isset($_POST['governing_regulatory_body'])) ? $_POST['governing_regulatory_body'] : '';
                $aum                        = (isset($_POST['aum'])) ? $_POST['aum'] : '';
                $household_accounts         = (isset($_POST['household_accounts'])) ? $_POST['household_accounts'] : '';
                $client_accounts            = (isset($_POST['client_accounts'])) ? $_POST['client_accounts'] : '';
                $high_dollor_amt_by_client  = (isset($_POST['high_dollor_amt_by_client'])) ? $_POST['high_dollor_amt_by_client'] : '';
                $lowest_dollor_amt_by_client = (isset($_POST['lowest_dollor_amt_by_client'])) ? $_POST['lowest_dollor_amt_by_client'] : '';
                $registered_retirement_account = (isset($_POST['registered_retirement_account'])) ? $_POST['registered_retirement_account'] : '';
                $locked_retirement_account  = (isset($_POST['locked_retirement_account'])) ? $_POST['locked_retirement_account'] : '';
                $tax_free_savings_account   = (isset($_POST['tax_free_savings_account'])) ? $_POST['tax_free_savings_account'] : '';
                $registered_education_savings_plan = (isset($_POST['registered_education_savings_plan'])) ? $_POST['registered_education_savings_plan'] : '';
                $taxable_investment_account = (isset($_POST['taxable_investment_account'])) ? $_POST['taxable_investment_account'] : '';
                $age_range                  = (isset($_POST['age_range'])) ? $_POST['age_range'] : '';
                
                $cash_and_cash_equivalents      = (isset($_POST['cash_and_cash_equivalents'])) ? $_POST['cash_and_cash_equivalents'] : '';
                $fixed_income_scurities         = (isset($_POST['fixed_income_scurities'])) ? $_POST['fixed_income_scurities'] : '';
                $equities                       = (isset($_POST['equities'])) ? $_POST['equities'] : '';
                $investment_fund                = (isset($_POST['investment_fund'])) ? $_POST['investment_fund'] : '';

                $leveraged_accounts         = (isset($_POST['leveraged_accounts'])) ? $_POST['leveraged_accounts'] : '';
                $investment_vehicles        = (isset($_POST['investment_vehicles'])) ? $_POST['investment_vehicles'] : '';
                $looking_to_accomplish      = (isset($_POST['looking_to_accomplish'])) ? $_POST['looking_to_accomplish'] : '';
                $work_experience            = (isset($_POST['work_experience'])) ? $_POST['work_experience'] : '';

                $update_prof_qry = wp_update_user( array( 
                    'ID'                => $current_user_id,
                    'first_name'        => $first_name,
                    'last_name'         => $last_name,
                    //'user_email'        => $_POST['edit_user_email'],
                ) );
                // Update User meta
                //update_user_meta( $current_user_id, 'profile_picture', $_POST['profile_picture'] );

                update_user_meta($current_user_id, 'first_name', $first_name);
                update_user_meta($current_user_id, 'last_name', $last_name);
                update_user_meta($current_user_id, 'phone_number', $phone_number);
                update_user_meta($current_user_id, 'office_address', $office_address);
                update_user_meta($current_user_id, 'investment_dealer_name', $investment_dealer_name);
                update_user_meta($current_user_id, 'country', $country);
                update_user_meta($current_user_id, 'state', $state);
                update_user_meta($current_user_id, 'city', $city);
                update_user_meta($current_user_id, 'postal_code', $postal_code);
                update_user_meta($current_user_id, 'governing_regulatory_body', $governing_regulatory_body);
                update_user_meta($current_user_id, 'aum', $aum);
                update_user_meta($current_user_id, 'household_accounts', $household_accounts);
                update_user_meta($current_user_id, 'client_accounts', $client_accounts);
                update_user_meta($current_user_id, 'high_dollor_amt_by_client', $high_dollor_amt_by_client);
                update_user_meta($current_user_id, 'lowest_dollor_amt_by_client', $lowest_dollor_amt_by_client);
                update_user_meta($current_user_id, 'registered_retirement_account', $registered_retirement_account);
                update_user_meta($current_user_id, 'locked_retirement_account', $locked_retirement_account);
                update_user_meta($current_user_id, 'tax_free_savings_account', $tax_free_savings_account);
                update_user_meta($current_user_id, 'registered_education_savings_plan', $registered_education_savings_plan);
                update_user_meta($current_user_id, 'taxable_investment_account', $taxable_investment_account);
                update_user_meta($current_user_id, 'age_range', $age_range);
                update_user_meta($current_user_id, 'cash_and_cash_equivalents', $cash_and_cash_equivalents);
                update_user_meta($current_user_id, 'fixed_income_scurities', $fixed_income_scurities);
                update_user_meta($current_user_id, 'equities', $equities);
                update_user_meta($current_user_id, 'investment_fund', $investment_fund);
                update_user_meta($current_user_id, 'leveraged_accounts', $leveraged_accounts);
                update_user_meta($current_user_id, 'investment_vehicles', $investment_vehicles);
                update_user_meta($current_user_id, 'looking_to_accomplish', $looking_to_accomplish);
                update_user_meta($current_user_id, 'work_experience', $work_experience);
                
                if ( is_wp_error( $update_prof_qry ) ) { 

                }else{

                }
            }
            ?>

            <section class="dcrf dcrf_adupdateform_container form-group">
                <!-- Form Start -->
                <form action="" method="post" class="advisor_register_form">

                    <!-- Row 1 -->
                    <div class="row">
                        <div class="column col-md-6">
                            <label>First Name *</label>
                            <span class="first-name">
                                <input class="form-control" type="text" name="first_name" value="<?php echo dcrf_current_user_meta('first_name',$current_user_id); ?>" required>
                            </span>
                        </div>
                        <div class="column col-md-6">
                            <label>Last Name</label>
                            <span class="last-name">
                                <input class="form-control" type="text" name="last_name" value="<?php echo dcrf_current_user_meta('last_name',$current_user_id); ?>">
                            </span>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="row">
                        <div class="column col-md-6">
                            <label>Email Address *</label>
                            <span class="your-email">
                                <input class="form-control" type="email" value="<?php echo $current_user_data->user_email; ?>" disabled>
                            </span>
                        </div>
                        <div class="column col-md-6">
                            <label>Phone Number</label>
                            <span class="last-name">
                                <input class="form-control" type="number" name="phone_number" value="<?php echo dcrf_current_user_meta('phone_number',$current_user_id); ?>">
                            </span>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="row">
                        <div class="col-md-12">
                            <label>Office Address</label>
                            <textarea class="form-control" name="office_address" rows="1" cols="50"><?php echo dcrf_current_user_meta('office_address',$current_user_id); ?></textarea>
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="row">
                        <div class="column col-md-6">
                            <label>Investment Dealer Name:</label>
                            <span class="your-subject">
                                <input class="form-control" type="text" name="investment_dealer_name" value="<?php echo dcrf_current_user_meta('investment_dealer_name',$current_user_id); ?>">
                            </span>
                        </div>
                        <div class="column col-md-6">
                            <label>Country:</label>
                            <span class="country">
                                <input class="form-control" type="text" name="country" value="<?php echo dcrf_current_user_meta('country',$current_user_id); ?>">
                            </span>
                        </div>
                    </div>
                    
                    <!-- Row 5 -->
                    <div class="row">
                        <div class="col-md-4">
                            <label>Province:</label>
                            <span class="your-subject">
                                <input class="form-control" type="text" name="state" value="<?php echo dcrf_current_user_meta('state',$current_user_id); ?>">
                            </span>
                        </div>
                        <div class="col-md-4">
                            <label>City:</label>
                            <span class="city">
                                <input class="form-control" type="text" name="city" value="<?php echo dcrf_current_user_meta('city',$current_user_id); ?>">
                            </span>
                        </div>
                        <div class="col-md-4">
                            <label>Postal Code:</label>
                            <span class="city">
                                <input class="form-control" type="text" name="postal_code" value="<?php echo dcrf_current_user_meta('postal_code',$current_user_id); ?>">
                            </span>
                        </div>
                    </div>

                    <!-- Row 6 -->
                    <div class="row">
                        <div class="column col-md-6">
                            <label>Governing Regulatory Body:</label>
                            <span class="country">
                                <?php $grbody = dcrf_current_user_meta('governing_regulatory_body',$current_user_id); ?>
                                <select class="form-control" name="governing_regulatory_body">
                                    <option value="mfda_advisor" <?php echo ($grbody == 'mfda_advisor') ? 'selected' : ''; ?>>MFDA Advisor</option>
                                    <option value="iiroc_advisor" <?php echo ($grbody == 'iiroc_advisor') ? 'selected' : ''; ?>>IIROC Advisor</option>
                                </select>
                            </span>
                        </div>
                        <div class="column col-md-6">
                            <label>AUM:</label>
                            <span class="your-subject">
                                <input class="form-control" type="text" name="aum" value="<?php echo dcrf_current_user_meta('aum',$current_user_id); ?>">
                            </span>
                        </div>
                    </div>

                    <!-- Row 7 -->
                    <div class="row">
                        <div class="column col-md-6">
                            <label>Number of household accounts:</label>
                            <span class="city">
                                <input class="form-control" type="text" name="household_accounts" value="<?php echo dcrf_current_user_meta('household_accounts',$current_user_id); ?>">
                            </span>
                        </div>
                        <div class="column col-md-6">
                            <label>Number of client accounts:</label>
                            <span class="city">
                                <input class="form-control" type="text" name="client_accounts" value="<?php echo dcrf_current_user_meta('client_accounts',$current_user_id); ?>">
                            </span>
                        </div>
                    </div>

                    <!-- Row 8 -->
                    <div class="row">
                        <div class="column col-md-6">
                            <label>How much is the highest dollar amount invested by a client.</label>
                            <span class="city">
                                <input class="form-control" type="text" name="high_dollor_amt_by_client" value="<?php echo dcrf_current_user_meta('high_dollor_amt_by_client',$current_user_id); ?>">
                            </span>
                        </div>

                        <div class="column col-md-6">
                            <label>How much is the lowest dollar amount invested by a client.</label>
                            <span class="city">
                                <input class="form-control" type="text" name="lowest_dollor_amt_by_client" value="<?php echo dcrf_current_user_meta('lowest_dollor_amt_by_client',$current_user_id); ?>">
                            </span>
                        </div>
                    </div>
                    
                    <div class="row col-md-12">
                        <h4>Client account type break down</h4>
                    </div>
                    <!-- row 9 -->
                    <div class="row">
                        <div class="column col-md-6">
                            <label>Number of clients with a Registered Retirement Account (RRSP, RRIF)</label>
                            <span class="city">
                                <input class="form-control" type="text" name="registered_retirement_account" value="<?php echo dcrf_current_user_meta('registered_retirement_account',$current_user_id); ?>">
                            </span>
                        </div>
                        <div class="column col-md-6">
                            <label>Number of clients with a Locked-In Retirement Account (LIRA, LRSP, LIF)</label>
                            <span class="city">
                                <input class="form-control" type="text" name="locked_retirement_account" value="<?php echo dcrf_current_user_meta('locked_retirement_account',$current_user_id); ?>">
                            </span>
                        </div>
                    </div>

                    <!-- Row 10 -->
                    <div class="row">
                        <div class="column col-md-6">
                            <label>Number of clients with a Tax-Free Savings Account (TFSA)</label>
                            <span class="city">
                                <input class="form-control" type="text" name="tax_free_savings_account" value="<?php echo dcrf_current_user_meta('tax_free_savings_account',$current_user_id); ?>">
                            </span>
                        </div>
                        <div class="column col-md-6">
                            <label>Number of clients with a Registered Education Savings Plan (RESP)</label>
                            <span class="city">
                                <input class="form-control" type="text" name="registered_education_savings_plan" value="<?php echo dcrf_current_user_meta('registered_education_savings_plan',$current_user_id); ?>">
                            </span>
                        </div>
                    </div>

                    <!-- row 11 -->
                    <div class="row">
                        <div class="column col-md-6">
                            <label>Number of Clients with a Taxable Investment Account (Brokerage, Mutual Fund, etc)</label>
                            <span class="city">
                                <input class="form-control" type="text" name="taxable_investment_account" value="<?php echo dcrf_current_user_meta('taxable_investment_account',$current_user_id); ?>">
                            </span>
                        </div>

                        <!-- Row 10 -->
                        <div class="column col-md-6">
                            <label>How many clients fall within the following age range</label>
                            <span class="city">
                                <?php $age_range = dcrf_current_user_meta('age_range',$current_user_id); ?>
                                <select class="form-control" name="age_range">
                                    <option value="1_18" <?php echo ($age_range == '1_18') ? 'selected' : ''; ?>>1-18</option>
                                    <option value="18_30" <?php echo ($age_range == '18_30') ? 'selected' : ''; ?>>18-30</option>
                                    <option value="31_40" <?php echo ($age_range == '31_40') ? 'selected' : ''; ?>>31-40</option>
                                    <option value="41_54" <?php echo ($age_range == '41_54') ? 'selected' : ''; ?>>41-54</option>
                                    <option value="55_65" <?php echo ($age_range == '55_65') ? 'selected' : ''; ?>>55-65</option>
                                    <option value="66_" <?php echo ($age_range == '66_') ? 'selected' : ''; ?>>66+</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Row 12 -->
                    <div class="row">
                        <div class="column col-md-6">
                            <label>How many accounts are Leveraged accounts (Monies borrowed to invest)</label>
                            <span class="city">
                                <input class="form-control" type="text" name="leveraged_accounts" value="<?php echo dcrf_current_user_meta('leveraged_accounts',$current_user_id); ?>">
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label>Identify how many clients are invested in the following investment vehicles </label>
                        </div>
                        <div class="col-md-12">
                            <div class="column one-second">
                                <label>Cash and Cash equivalents</label>
                                <span class="city">
                                    <input type="text" name="cash_and_cash_equivalents" value="<?php echo dcrf_current_user_meta('cash_and_cash_equivalents',$current_user_id); ?>">
                                </span>
                            </div>
                            <div class="column one-second">
                                <label>Fixed Income Securities</label>
                                <span class="city">
                                    <input type="text" name="fixed_income_scurities" value="<?php echo dcrf_current_user_meta('fixed_income_scurities',$current_user_id); ?>">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="column one-second">
                                <label>Equities</label>
                                <span class="city">
                                    <input type="text" name="equities" value="<?php echo dcrf_current_user_meta('equities',$current_user_id); ?>">
                                </span>
                            </div>
                            <div class="column one-second">
                                <label>Investment Funds</label>
                                <span class="city">
                                    <input type="text" name="investment_fund" value="<?php echo dcrf_current_user_meta('investment_fund',$current_user_id); ?>">
                                </span>
                            </div>
                        </div>
                            <!-- <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="investment_vehicles[]" <?php echo ( is_array($investment_vehicles) && in_array('cash_equivalents',$investment_vehicles) ) ? 'checked' : ''; ?> value="cash_equivalents">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Cash and Cash equivalents</span>
                            </label>
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="investment_vehicles[]" <?php echo ( is_array($investment_vehicles) && in_array('fixed_income_securities',$investment_vehicles) ) ? 'checked' : ''; ?> value="fixed_income_securities">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Fixed Income Securities</span>
                            </label>                            
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="investment_vehicles[]" <?php echo ( is_array($investment_vehicles) && in_array('equities',$investment_vehicles) ) ? 'checked' : ''; ?> value="equities">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Equities</span>
                            </label>
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="investment_vehicles[]" <?php echo ( is_array($investment_vehicles) && in_array('investment_funds',$investment_vehicles) ) ? 'checked' : ''; ?> value="investment_funds">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Investment Funds</span>
                            </label> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label>As an advisor I am looking to accomplish the following objective: </label>
                        </div>
                        <div class="col-md-12">
                            <?php $looking_acmplish = dcrf_current_user_meta('looking_to_accomplish',$current_user_id); ?>
                            
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="looking_to_accomplish[]" <?php echo ( is_array($looking_acmplish) && in_array('sell_my_book_of_business',$looking_acmplish) ) ? 'checked' : ''; ?> value="sell_my_book_of_business">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Sell my book of business</span>
                            </label>
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="looking_to_accomplish[]" <?php echo ( is_array($looking_acmplish) && in_array('purchase_a_book_of_business',$looking_acmplish) ) ? 'checked' : ''; ?> value="purchase_a_book_of_business">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Purchase a book of business</span>
                            </label>
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="looking_to_accomplish[]" <?php echo ( is_array($looking_acmplish) && in_array('change_firm',$looking_acmplish) ) ? 'checked' : ''; ?> value="change_firm">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Change firm</span>
                            </label>
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="looking_to_accomplish[]" <?php echo ( is_array($looking_acmplish) && in_array('certification_of_my_book_of_business',$looking_acmplish) ) ? 'checked' : ''; ?> value="certification_of_my_book_of_business">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">An evaluation and certification of my book of business</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Work Experience -->
                    <div class="work_experience">
                        <div class="row col-md-12">
                            <h4>Work Experience</h4>
                        </div>

                        <div class="row work_experience_wrap">
                            <?php 
                            $work_exp_data = dcrf_current_user_meta('work_experience',$current_user_id);
                            
                            if (is_array($work_exp_data)) {
                                $i = 1;
                                $j = 0;
                                foreach ($work_exp_data as $key => $value) {
                                    $company_name   = (isset($value['company_name'])) ? $value['company_name'] : '';
                                    $job_title      = (isset($value['job_title'])) ? $value['job_title'] : '';
                                    $duration       = (isset($value['duration'])) ? $value['duration'] : '';
                                    $office_address = (isset($value['office_address'])) ? $value['office_address'] : '';
                                    
                                    if ($i >= 2) {
                                        ?>
                                        <div class="col-md-12 office-address">
                                            <label>Work Experience <?php echo $i; ?>:</label>
                                        </div>
                                        <?php
                                    }

                                    ?>
                                    <div class="col-md-4">
                                        <label>Company Name</label>
                                        <span class="city">
                                            <input class="form-control" type="text" name="work_experience[<?php echo $j; ?>][company_name]" value="<?php echo $company_name; ?>">
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Job Title</label>
                                        <span class="city">
                                            <input class="form-control" type="text" name="work_experience[<?php echo $j; ?>][job_title]" value="<?php echo $job_title; ?>">
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Year start- End Year</label>
                                        <span class="city">
                                            <input class="form-control" type="text" name="work_experience[<?php echo $j; ?>][duration]" value="<?php echo $duration; ?>">
                                        </span>
                                    </div>
                                    <div class="col-md-12 office-address" data-exp="<?php echo $j; ?>">
                                        <label>Office Address:</label>
                                        <span class="office-address">
                                            <textarea class="form-control" name="work_experience[<?php echo $j; ?>][office_address]" cols="40" rows="1"><?php echo $office_address; ?></textarea>
                                        </span>
                                    </div>
                                    <?php
                                    $i++;
                                    $j++;
                                }
                            }else{
                                ?>
                                <div class="col-md-4">
                                    <label>Company Name</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="work_experience[0][company_name]" value="">
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label>Job Title</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="work_experience[0][job_title]" value="">
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label>Year start- End Year</label>
                                    <span class="city">
                                        <input class="form-control" type="text" name="work_experience[0][duration]" value="">
                                    </span>
                                </div>
                                <div class="col-md-12 office-address" data-exp="0">
                                    <label>Office Address:</label>
                                    <span class="office-address">
                                        <textarea class="form-control" name="work_experience[0][office_address]" cols="40" rows="1"></textarea>
                                    </span>
                                </div>
                                <?php
                            }
                            ?>

                            
                        </div>

                        <div class="col-md-12">
                            <?php echo do_shortcode('[fancy_link title="Add More Experience" link="javascript:void(0)" target="" style="4" class="add_more_experience" download=""]'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-12 row">
                        <input class="btn btn-primary" type="submit" name="update_advisor_submit" value="Update" class="button">
                    </div>
                    
                </form>
            </section>

            <?php
        }else{
            echo '<div class="alert alert_warning"><div class="alert_icon"><i class="icon-lamp"></i></div><div class="alert_wrapper"> You Haven\'t Permission to access this page </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>';
        }
    }// dcrf_edit_user_profile_frontend_func

    /*------------------------------------------------End Frontend User Profile------------------------------------------------*/

/**-----------------------------------------------Start Backend Functions---------------------------------------------------
 *
 *
 *
 *
 *
 * User Profile ADMIN Section
 *
 *
 *
 *
 */

    // Remove default field from user profile page & re-title the section
if(!function_exists('dcrf_remove_fields_from_edit_user_admin')){
    function dcrf_remove_fields_from_edit_user_admin($buffer){
        $buffer = str_replace('<h2>About Yourself</h2>','',$buffer);
        $buffer = str_replace('<h2>About the user</h2>','',$buffer);
        $buffer = preg_replace('/<tr class=\"user-profile-picture\"[\s\S]*?<\/tr>/','',$buffer,1);
        $buffer = preg_replace('/<tr class=\"user-url-wrap\"[\s\S]*?<\/tr>/','',$buffer,1);
        $buffer = preg_replace('/<tr class=\"user-first-name-wrap\"[\s\S]*?<\/tr>/','',$buffer,1);
        $buffer = preg_replace('/<tr class=\"user-last-name-wrap\"[\s\S]*?<\/tr>/','',$buffer,1);

        return $buffer;
            //$buffer = preg_replace('/<tr class=\"user-description-wrap\"[\s\S]*?<\/tr>/','',$buffer,1);
    }
    function dcrf_user_profile_subject_start(){ ob_start('dcrf_remove_fields_from_edit_user_admin'); }
    function dcrf_user_profile_subject_end(){ ob_end_flush(); }
}
add_action('admin_head-profile.php','dcrf_user_profile_subject_start');
add_action('admin_footer-profile.php','dcrf_user_profile_subject_end');
add_action('admin_head-user-edit.php','dcrf_user_profile_subject_start');
add_action('admin_footer-user-edit.php','dcrf_user_profile_subject_end');


    /**
     * Added Custom User meta fields
     * User Profile, user multiple images
     *
     */

    add_action( 'show_user_profile', 'betheme_extra_user_profile_fields' );
    add_action( 'edit_user_profile', 'betheme_extra_user_profile_fields' );
    //add_action( 'user_new_form', 'betheme_extra_user_profile_fields' );

    function betheme_extra_user_profile_fields( $user ) {

    	if ($user != 'add-new-user' && $user->exists()) {
    		$user_id = $user->ID;
    		$user_roles = implode(" ",$user->roles);
    	}else{
    		$user_id = $user_roles = 'NO_USERS';
    	};

        echo '<h3 class="border_bottom">'.__("Additional information", "betheme").'</h3>';
        echo '<table class="form-table">';

        if (class_exists( 'DMOF_Fields_Files' )) {
            /* User Profile Picture */
            echo '<tr>'.DMOF_Fields_Files::file_fields( 'profile_picture', 'Profile Picture', '', 'image', get_the_author_meta( 'profile_picture', $user_id ) ).'</tr>';
        }

        // Show User extra fields when Advisor is edited
        if ($user_roles == 'ab_advisor' || dcrf_get_current_user_data('roles') == 'administrator') {
            if (class_exists('DMOF_Fields_Text')) {
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'first_name', 'First Name', ''/*Description*/, ''/*placeholder*/, ''/*default*/, get_the_author_meta( 'first_name', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'last_name', 'Last Name', '', '', '', get_the_author_meta( 'last_name', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'phone_number', 'Phone Number', '', '', '', get_the_author_meta( 'phone_number', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'office_address', 'Office Address', '', 'office', '', dcrf_current_user_meta( 'office_address', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'investment_dealer_name', 'investment dealer name', '', '', '', get_the_author_meta( 'investment_dealer_name', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'country', 'Country', '', '', '', get_the_author_meta( 'country', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'state', 'State', '', '', '', get_the_author_meta( 'state', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'city', 'City', '', '', '', get_the_author_meta( 'city', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'postal_code', 'postal_code', '', '', '', get_the_author_meta( 'postal_code', $user_id )).'</tr>';

                echo '<tr>'.DMOF_Fields_Select::get_select( 'governing_regulatory_body', 'Governing Regulatory Body', '', array('mfda_advisor'=>'MFDA Advisor','iiroc_advisor'=>'IIROC Advisor',), '', '', '', get_the_author_meta( 'governing_regulatory_body', $user_id ) ).'</tr>';

                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'aum', 'aum', '', '', '', get_the_author_meta( 'aum', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'household_accounts', 'household_accounts', '', '', '', get_the_author_meta( 'household_accounts', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'client_accounts', 'client_accounts', '', '', '', get_the_author_meta( 'client_accounts', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'high_dollor_amt_by_client', 'high_dollor_amt_by_client', '', '', '', get_the_author_meta( 'high_dollor_amt_by_client', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'lowest_dollor_amt_by_client', 'lowest_dollor_amt_by_client', '', '', '', get_the_author_meta( 'lowest_dollor_amt_by_client', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'registered_retirement_account', 'registered_retirement_account', '', '', '', get_the_author_meta( 'registered_retirement_account', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'locked_retirement_account', 'locked_retirement_account', '', '', '', get_the_author_meta( 'locked_retirement_account', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'tax_free_savings_account', 'tax_free_savings_account', '', '', '', get_the_author_meta( 'tax_free_savings_account', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'registered_education_savings_plan', 'registered_education_savings_plan', '', '', '', get_the_author_meta( 'registered_education_savings_plan', $user_id )).'</tr>';
                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'taxable_investment_account', 'taxable_investment_account', '', '', '', get_the_author_meta( 'taxable_investment_account', $user_id )).'</tr>';

                $age_range = get_the_author_meta( 'age_range', $user_id );
                echo '<tr class="dmof_multi_td">';
                echo DMOF_Fields_Text::get_textbox( 'age_range[1_18]', 'How many clients fall within the following age range', '', '', '', (isset($age_range['1_18'])) ? $age_range['1_18'] : '');
                echo DMOF_Fields_Text::get_textbox( 'age_range[18_30]', '', '', '', '', (isset($age_range['18_30'])) ? $age_range['18_30'] : '');
                echo DMOF_Fields_Text::get_textbox( 'age_range[31_40]', '', '', '', '', (isset($age_range['31_40'])) ? $age_range['31_40'] : '');
                echo DMOF_Fields_Text::get_textbox( 'age_range[41_54]', '', '', '', '', (isset($age_range['41_54'])) ? $age_range['41_54'] : '');
                echo DMOF_Fields_Text::get_textbox( 'age_range[55_65]', '', '', '', '', (isset($age_range['55_65'])) ? $age_range['55_65'] : '');
                echo DMOF_Fields_Text::get_textbox( 'age_range[66_]', '', '', '', '', (isset($age_range['66_'])) ? $age_range['66_'] : '');
                echo '</tr>';

                echo '<tr class="dmof_multi_td">';
                echo DMOF_Fields_Text::get_textbox( 'cash_and_cash_equivalents', 'Identify how many clients are invested in the following investment vehicles', '', '', '', get_the_author_meta( 'cash_and_cash_equivalents', $user_id ));
                echo DMOF_Fields_Text::get_textbox( 'fixed_income_scurities', '', '', '', '', get_the_author_meta( 'fixed_income_scurities', $user_id ));
                echo DMOF_Fields_Text::get_textbox( 'equities', '', '', '', '', get_the_author_meta( 'equities', $user_id ));
                echo DMOF_Fields_Text::get_textbox( 'investment_fund', '', '', '', '', get_the_author_meta( 'investment_fund', $user_id ));
                echo '</tr>';

                echo '<tr>'.DMOF_Fields_Text::get_textbox( 'leveraged_accounts', 'leveraged_accounts', '', '', '', get_the_author_meta( 'leveraged_accounts', $user_id )).'</tr>';
                
                echo '<tr>'.DMOF_Fields_Checkbox::get_checkbox( 'looking_to_accomplish', 'looking_to_accomplish', '', array('sell_my_book_of_business'=>'Sell my book of business','purchase_a_book_of_business'=>'Purchase a book of business','change_firm'=>'Change firm','certification_of_my_book_of_business'=>'An evaluation and certification of my book of business'), '', '', get_the_author_meta( 'looking_to_accomplish', $user_id )).'</tr>';

                $user_exp =  get_the_author_meta( 'work_experience', $user_id );

                if (is_array($user_exp) && !empty($user_exp)) {
                    $i = 1;
                    $j = 0;
                    foreach ($user_exp as $key => $value) {
                        if (is_array($value)) {
                            echo '<tr class="work_experience_wrap dmof_multi_td">';
                            if ($i == 1) {
                                echo DMOF_Fields_Text::get_textbox( 'work_experience['.$j.'][company_name]', 'work experience', '', '', '', $value['company_name']);
                                echo DMOF_Fields_Text::get_textbox( 'work_experience['.$j.'][job_title]', '', '', '', '', $value['job_title']);
                                echo DMOF_Fields_Text::get_textbox( 'work_experience['.$j.'][duration]', '', '', '', '', $value['duration']);
                                echo DMOF_Fields_Text::get_textbox( 'work_experience['.$j.'][office_address]', '', '', '', '', $value['office_address']);
                            }else{
                                echo DMOF_Fields_Text::get_textbox( 'work_experience['.$j.'][company_name]', 'work experience '.$i, '', '', '', $value['company_name']);
                                echo DMOF_Fields_Text::get_textbox( 'work_experience['.$j.'][job_title]', '', '', '', '', $value['job_title']);
                                echo DMOF_Fields_Text::get_textbox( 'work_experience['.$j.'][duration]', '', '', '', '', $value['duration']);
                                echo DMOF_Fields_Text::get_textbox( 'work_experience['.$j.'][office_address]', '', '', '', '', $value['office_address']);
                            }
                            $i++;
                            $j++;
                            echo '</tr>';
                        }
                    }
                }else{
                    echo '<tr class="dmof_multi_td">';
                    echo DMOF_Fields_Text::get_textbox( 'work_experience[0][company_name]', 'work experience', '', '', '', '');
                    echo DMOF_Fields_Text::get_textbox( 'work_experience[0][job_title]', '', '', '', '', '');
                    echo DMOF_Fields_Text::get_textbox( 'work_experience[0][duration]', '', '', '', '', '');
                    echo DMOF_Fields_Text::get_textbox( 'work_experience[0][office_address]', '', '', '', '', '');
                    echo '</tr>';
                }
            }
        	} //-> Advisor Fields End

        	// Show User extra fields when Firm is edited
        	if ($user_roles == 'ab_firm') {
               if (class_exists('DMOF_Fields_Text')) {
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'first_name', 'First Name', ''/*Description*/, ''/*placeholder*/, ''/*default*/, get_the_author_meta( 'first_name', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'last_name', 'Last Name', '', '', '', get_the_author_meta( 'last_name', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'phone_number', 'Phone Number', '', '', '', get_the_author_meta( 'phone_number', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'office_address', 'Office Address', '', 'office', '', dcrf_current_user_meta( 'office_address', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'investment_dealer_name', 'investment dealer name', '', '', '', get_the_author_meta( 'investment_dealer_name', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'country', 'Country', '', '', '', get_the_author_meta( 'country', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'state', 'State', '', '', '', get_the_author_meta( 'state', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'city', 'City', '', '', '', get_the_author_meta( 'city', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'postal_code', 'postal_code', '', '', '', get_the_author_meta( 'postal_code', $user_id )).'</tr>';

                   echo '<tr>'.DMOF_Fields_Select::get_select( 'governing_regulatory_body', 'Governing Regulatory Body', '', array('mfda_advisor'=>'MFDA Advisor','iiroc_advisor'=>'IIROC Advisor',), '', '', '', get_the_author_meta( 'governing_regulatory_body', $user_id ) ).'</tr>';

                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'aum', 'aum', '', '', '', get_the_author_meta( 'aum', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'household_accounts', 'household_accounts', '', '', '', get_the_author_meta( 'household_accounts', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'client_accounts', 'client_accounts', '', '', '', get_the_author_meta( 'client_accounts', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'high_dollor_amt_by_client', 'high_dollor_amt_by_client', '', '', '', get_the_author_meta( 'high_dollor_amt_by_client', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'lowest_dollor_amt_by_client', 'lowest_dollor_amt_by_client', '', '', '', get_the_author_meta( 'lowest_dollor_amt_by_client', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'registered_retirement_account', 'registered_retirement_account', '', '', '', get_the_author_meta( 'registered_retirement_account', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'locked_retirement_account', 'locked_retirement_account', '', '', '', get_the_author_meta( 'locked_retirement_account', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'tax_free_savings_account', 'tax_free_savings_account', '', '', '', get_the_author_meta( 'tax_free_savings_account', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'registered_education_savings_plan', 'registered_education_savings_plan', '', '', '', get_the_author_meta( 'registered_education_savings_plan', $user_id )).'</tr>';
                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'taxable_investment_account', 'taxable_investment_account', '', '', '', get_the_author_meta( 'taxable_investment_account', $user_id )).'</tr>';

                   echo '<tr>'.DMOF_Fields_Select::get_select( 'age_range', 'How many clients fall within the following age range', '', array('1_18'	=> '1-18','18_30'	=> '18-30','31_40'	=> '31-40','41_54'	=> '41-54','55_65'	=> '55-65','66_'	=> '66+'), '', '', '', get_the_author_meta( 'age_range', $user_id ) ).'</tr>';

                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'leveraged_accounts', 'leveraged_accounts', '', '', '', get_the_author_meta( 'leveraged_accounts', $user_id )).'</tr>';

                   echo '<tr>'.DMOF_Fields_Checkbox::get_checkbox( 'investment_vehicles', 'investment_vehicles', '', array('cash_equivalents'	=>'Cash and Cash equivalents','fixed_income_securities'=>'Fixed Income Securities','equities'=>'Equities','investment_funds'=>'Investment Funds'), '', '', get_the_author_meta( 'investment_vehicles', $user_id )).'</tr>';

                   echo '<tr>'.DMOF_Fields_Checkbox::get_checkbox( 'looking_to_accomplish', 'looking_to_accomplish', '', array('sell_my_book_of_business'=>'Sell my book of business','purchase_a_book_of_business'=>'Purchase a book of business','change_firm'=>'Change firm','certification_of_my_book_of_business'=>'An evaluation and certification of my book of business'), '', '', get_the_author_meta( 'looking_to_accomplish', $user_id )).'</tr>';

                   echo '<tr>'.DMOF_Fields_Text::get_textbox( 'work_experience', 'work_experience', '', '', '', get_the_author_meta( 'work_experience', $user_id )).'</tr>';

               }
        	} //-> Firm Fields End

            // if ( class_exists('DMOF_Fields_Switch') ) {                
            //     echo '<tr>'.DMOF_Fields_Switch::dmof_switch( 'user_private_name', 'Private Name' , '', '', get_the_author_meta( 'user_private_name', $user_id )).'</tr>';
            // }

            /**
             * User Categories
             *
            $user_taxonomy = "boat_user_categories";
            /** Get all taxonomy terms *
            $user_category = get_terms($user_taxonomy, array("orderby"    => "count","hide_empty" => false));
            $hierarchy = _get_term_hierarchy($user_taxonomy);
            $get_user_category = get_the_author_meta( 'boat_user_categories', $user_id );
            ?>
            <th><label for="boat_user_categories"><?php _e( 'Select Categories' ); ?></label></th>

            <td class="categorydiv">
                <?php if ( !empty( $user_category ) ) : ?>

                <div id="user_category-all" class="tabs-panel">
                    <ul id="categorychecklist" data-wp-lists="list:category" class="categorychecklist form-no-clear">
                        <?php
                        foreach($user_category as $term) {
                            if($term->parent) {
                                continue;
                            }
                            // if ($get_user_category && in_array($term->term_id, $get_user_category)) {
                            //     echo '<li id="'.$term->term_id.'" class="popular-category"><label class="selectit"><input class="form-control" value="'.$term->term_id.'" name="boat_user_categories[]" id="in-'.$term->term_id.'" type="checkbox" checked="checked">'.$term->name.'</label></li>';
                            // }else{
                            //     echo '<li id="'.$term->term_id.'" class="popular-category"><label class="selectit"><input class="form-control" value="'.$term->term_id.'" name="boat_user_categories[]" id="in-'.$term->term_id.'" type="checkbox">'.$term->name.'</label></li>';
                            // }
                            echo '<li id="'.$term->term_id.'" class="popular-category"><label class="selectit">'.$term->name.'</label></li>';

                            if($hierarchy[$term->term_id]) {
                                echo '<ul class="children">';
                                foreach($hierarchy[$term->term_id] as $child) {
                                    $child = get_term($child);
                                    if ($get_user_category && in_array($child->term_id, $get_user_category)) {
                                        echo '<li id="'.$child->term_id.'"><label class="selectit"><input class="form-control" value="'.$child->term_id.'" name="boat_user_categories[]" id="in-'.$child->term_id.'" type="checkbox" checked="checked">'.$child->name.'</label></li>';
                                    }else{
                                        echo '<li id="'.$child->term_id.'"><label class="selectit"><input class="form-control" value="'.$child->term_id.'" name="boat_user_categories[]" id="in-'.$child->term_id.'" type="checkbox">'.$child->name.'</label></li>';
                                    }    
                                }
                                echo '</ul>';
                            }
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            <?php endif; ?>
            </td>*/

            echo '</table>';

    } //-> betheme_extra_user_profile_fields

    // Save user extran fields in user meta
    add_action( 'personal_options_update', 'betheme_save_extra_user_profile_fields' );
    add_action( 'edit_user_profile_update', 'betheme_save_extra_user_profile_fields' );

    function betheme_save_extra_user_profile_fields( $user_id ) {
        $saved = false;
        if ( current_user_can( 'edit_user', $user_id ) ) {

        	$user_roles = dcrf_get_current_user_data('roles', $user_id);

        	// Update User extra fields when Advisor is edited
        	if ($user_roles == 'ab_advisor' || dcrf_get_current_user_data('roles') == 'administrator') {
              update_user_meta( $user_id, 'phone_number', isset($_POST['phone_number']) ? $_POST['phone_number'] : '' );
              update_user_meta( $user_id, 'office_address', isset($_POST['office_address']) ? $_POST['office_address'] : '' );
              update_user_meta( $user_id, 'investment_dealer_name', isset($_POST['investment_dealer_name']) ? $_POST['investment_dealer_name'] : '' );
              update_user_meta( $user_id, 'country', isset($_POST['country']) ? $_POST['country'] : '' );
              update_user_meta( $user_id, 'state', isset($_POST['state']) ? $_POST['state'] : '' );
              update_user_meta( $user_id, 'city', isset($_POST['city']) ? $_POST['city'] : '' );
              update_user_meta( $user_id, 'postal_code', isset($_POST['postal_code']) ? $_POST['postal_code'] : '' );
              update_user_meta( $user_id, 'governing_regulatory_body', isset($_POST['governing_regulatory_body']) ? $_POST['governing_regulatory_body'] : '' );
              update_user_meta( $user_id, 'aum', isset($_POST['aum']) ? $_POST['aum'] : '' );
              update_user_meta( $user_id, 'household_accounts', isset($_POST['household_accounts']) ? $_POST['household_accounts'] : '' );
              update_user_meta( $user_id, 'client_accounts', isset($_POST['client_accounts']) ? $_POST['client_accounts'] : '' );
              update_user_meta( $user_id, 'high_dollor_amt_by_client', isset($_POST['high_dollor_amt_by_client']) ? $_POST['high_dollor_amt_by_client'] : '' );
              update_user_meta( $user_id, 'lowest_dollor_amt_by_client', isset($_POST['lowest_dollor_amt_by_client']) ? $_POST['lowest_dollor_amt_by_client'] : '' );
              update_user_meta( $user_id, 'registered_retirement_account', isset($_POST['registered_retirement_account']) ? $_POST['registered_retirement_account'] : '' );
              update_user_meta( $user_id, 'locked_retirement_account', isset($_POST['locked_retirement_account']) ? $_POST['locked_retirement_account'] : '' );
              update_user_meta( $user_id, 'tax_free_savings_account', isset($_POST['tax_free_savings_account']) ? $_POST['tax_free_savings_account'] : '' );
              update_user_meta( $user_id, 'registered_education_savings_plan', isset($_POST['registered_education_savings_plan']) ? $_POST['registered_education_savings_plan'] : '' );
              update_user_meta( $user_id, 'taxable_investment_account', isset($_POST['taxable_investment_account']) ? $_POST['taxable_investment_account'] : '' );
              update_user_meta( $user_id, 'age_range', isset($_POST['age_range']) ? $_POST['age_range'] : '' );
              update_user_meta( $user_id, 'leveraged_accounts', isset($_POST['leveraged_accounts']) ? $_POST['leveraged_accounts'] : '' );
              update_user_meta( $user_id, 'investment_vehicles', isset($_POST['investment_vehicles']) ? $_POST['investment_vehicles'] : '' );
              update_user_meta( $user_id, 'looking_to_accomplish', isset($_POST['looking_to_accomplish']) ? $_POST['looking_to_accomplish'] : '' );
              update_user_meta( $user_id, 'work_experience', isset($_POST['work_experience']) ? $_POST['work_experience'] : '' );
			} //-> Advisor Fields End

			// Update User extra fields when Firm is edited
           if ($user_roles == 'ab_firm') {
              update_user_meta( $user_id, 'phone_number', isset($_POST['phone_number']) ? $_POST['phone_number'] : '' );
              update_user_meta( $user_id, 'office_address', isset($_POST['office_address']) ? $_POST['office_address'] : '' );
              update_user_meta( $user_id, 'investment_dealer_name', isset($_POST['investment_dealer_name']) ? $_POST['investment_dealer_name'] : '' );
              update_user_meta( $user_id, 'country', isset($_POST['country']) ? $_POST['country'] : '' );
              update_user_meta( $user_id, 'state', isset($_POST['state']) ? $_POST['state'] : '' );
              update_user_meta( $user_id, 'city', isset($_POST['city']) ? $_POST['city'] : '' );
              update_user_meta( $user_id, 'postal_code', isset($_POST['postal_code']) ? $_POST['postal_code'] : '' );
              update_user_meta( $user_id, 'governing_regulatory_body', isset($_POST['governing_regulatory_body']) ? $_POST['governing_regulatory_body'] : '' );
              update_user_meta( $user_id, 'aum', isset($_POST['aum']) ? $_POST['aum'] : '' );
              update_user_meta( $user_id, 'household_accounts', isset($_POST['household_accounts']) ? $_POST['household_accounts'] : '' );
              update_user_meta( $user_id, 'client_accounts', isset($_POST['client_accounts']) ? $_POST['client_accounts'] : '' );
              update_user_meta( $user_id, 'high_dollor_amt_by_client', isset($_POST['high_dollor_amt_by_client']) ? $_POST['high_dollor_amt_by_client'] : '' );
              update_user_meta( $user_id, 'lowest_dollor_amt_by_client', isset($_POST['lowest_dollor_amt_by_client']) ? $_POST['lowest_dollor_amt_by_client'] : '' );
              update_user_meta( $user_id, 'registered_retirement_account', isset($_POST['registered_retirement_account']) ? $_POST['registered_retirement_account'] : '' );
              update_user_meta( $user_id, 'locked_retirement_account', isset($_POST['locked_retirement_account']) ? $_POST['locked_retirement_account'] : '' );
              update_user_meta( $user_id, 'tax_free_savings_account', isset($_POST['tax_free_savings_account']) ? $_POST['tax_free_savings_account'] : '' );
              update_user_meta( $user_id, 'registered_education_savings_plan', isset($_POST['registered_education_savings_plan']) ? $_POST['registered_education_savings_plan'] : '' );
              update_user_meta( $user_id, 'taxable_investment_account', isset($_POST['taxable_investment_account']) ? $_POST['taxable_investment_account'] : '' );
              update_user_meta( $user_id, 'age_range', isset($_POST['age_range']) ? $_POST['age_range'] : '' );
              update_user_meta( $user_id, 'leveraged_accounts', isset($_POST['leveraged_accounts']) ? $_POST['leveraged_accounts'] : '' );
              update_user_meta( $user_id, 'investment_vehicles', isset($_POST['investment_vehicles']) ? $_POST['investment_vehicles'] : '' );
              update_user_meta( $user_id, 'looking_to_accomplish', isset($_POST['looking_to_accomplish']) ? $_POST['looking_to_accomplish'] : '' );
              update_user_meta( $user_id, 'work_experience', isset($_POST['work_experience']) ? $_POST['work_experience'] : '' );
			}//-> Firm Fields End

			// Extra Fields
            update_user_meta( $user_id, 'profile_picture', isset($_POST['profile_picture']) ? $_POST['profile_picture'] : '' );
            update_user_meta( $user_id, 'user_company_images', isset($_POST['user_company_images']) ? $_POST['user_company_images'] : '' );


            // update user categories
            // update_user_meta( $user_id, 'boat_user_categories', $_POST['boat_user_categories'] );
            // clean_object_term_cache( $user_id, 'boat_user_categories' );

            $saved = true;
        }
        return true;
    } //-> betheme_save_extra_user_profile_fields