<?php
/**
 * User registration process
 */

/**
 * Included Shortcode
 * [dcrf_advisor_register_form]
 * [dcrf_firm_register_form]
 */

/**
 * Advisor Registration process
 */
add_shortcode( 'dcrf_advisor_register_form', 'dcrf_advisor_register_form_func' );

function dcrf_advisor_register_form_func(){

	if (is_user_logged_in()) {
		echo do_shortcode('[alert style="success"] You are already login [/alert]');
		echo do_shortcode('[button title="Go To Home" link="'.home_url().'" target="" icon="icon-home" icon_position="left" color="theme" font_color="" size="2" full_width="" class="" download="" onclick=""]');
	}else{
		
		echo dcrf_get_error_messages('username_exists');
		echo dcrf_get_error_messages('email_exists');
		echo dcrf_get_error_messages('reg_fill_form');
		?>
		<section class="dcrf dcrf_adregform_container">
			
			<!-- Progress Bar -->
			<div class="progress_steps">
				<ul class="ad_reg_progressbar">
					<li class="active">Welcome</li>
					<li class="">Personal Info</li>
					<li class="">Portfolio</li>
					<li class="" style="width: 141px;">Employment History</li>
					<li class="">Addendum</li>
					<li class="">Register</li>
				</ul>
			</div>
			
			<!-- Form Start -->
			<form action="" method="post" class="advisor_register_form">
				
				<!-- Step 1 -->
				
				<fieldset aria-label="Step One" tabindex="-1" id="step-1">
					<!-- Row 1 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>First Name *</label>
							<span class="first-name">
								<input type="text" name="first_name" value="" required>
							</span>
						</div>
						<div class="column one-second">
							<label>Last Name</label>
							<span class="last-name">
								<input type="text" name="last_name" value="">
							</span>
						</div>
					</div>

					<!-- Row 2 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Email Address *</label>
							<span class="your-email">
								<input type="email" name="email" value="" required>
							</span>
						</div>
						<div class="column one-second">
							<label>Phone Number</label>
							<span class="last-name">
								<input type="number" name="phone_number" value="">
							</span>
						</div>
					</div>
					<!-- Next Button -->
					<div class="vc_row column_attr align_right">
						<button class="btn btn-default btn-next" type="button" aria-controls="step-2">Next</button>
					</div>
				</fieldset>
				
				<!-- Step 2 -->
				
				<fieldset aria-label="Step Two" tabindex="-1" id="step-2">
					<!-- Row 3 -->
					<div class="column one vc_row">
						<label>Office Address</label>
						<textarea name="office_address" rows="1" cols="50"></textarea>
					</div>

					<!-- Row 4 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Investment Dealer Name:</label>
							<span class="your-subject">
								<input type="text" name="investment_dealer_name" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>Country:</label>
							<span class="country">
								<input type="text" name="country" value="">
							</span>
						</div>
					</div>

					<!-- Row 5 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Province:</label>
							<span class="your-subject">
								<input type="text" name="state" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>City:</label>
							<span class="city">
								<input type="text" name="city" value="">
							</span>
						</div>
					</div>

					<!-- Row 6 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Postal Code:</label>
							<span class="city">
								<input type="text" name="postal_code" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>Governing Regulatory Body:</label>
							<span class="country">
								<select name="governing_regulatory_body">
									<option value="mfda_advisor">MFDA Advisor</option>
									<option value="iiroc_advisor">IIROC Advisor</option>
								</select>
							</span>
						</div>
						
					</div>

					<div class="vc_row">
						<div class="column one">
							<label>As an advisor I am looking to accomplish the following objective: </label>
							<span class="checkbox_row"><input type="checkbox" name="looking_to_accomplish[]" value="sell_my_book_of_business">Sell my book of business</span>
							<span class="checkbox_row"><input type="checkbox" name="looking_to_accomplish[]" value="purchase_a_book_of_business">Purchase a book of business</span>
							<span class="checkbox_row"><input type="checkbox" name="looking_to_accomplish[]" value="change_firm">Change firm</span>
							<span class="checkbox_row"><input type="checkbox" name="looking_to_accomplish[]" value="certification_of_my_book_of_business">An evaluation and certification of my book of business</span>
						</div>
					</div>
					
					<div class="vc_row">
						<div class="column one-second column_attr align_left">
							<button class="btn btn-default btn-prev" type="button" aria-controls="step-1">Previous</button>
						</div>
						<div class="column one-second column_attr align_right">
							<button class="btn btn-default btn-next" type="button" aria-controls="step-3">Next</button>
						</div>
					</div>
				</fieldset>
				
				<!-- Step 3 -->
				
				<fieldset aria-label="Step Three" tabindex="-1" id="step-3">
					
					<!-- Row 7 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>AUM:</label>
							<span class="your-subject">
								<input type="text" name="aum" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>Number of household accounts:</label>
							<span class="city">
								<input type="text" name="household_accounts" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>Number of clients accounts:</label>
							<span class="city">
								<input type="text" name="client_accounts" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>How much is the highest dollar amount invested by a client.</label>
							<span class="city">
								<input type="text" name="high_dollor_amt_by_client" value="">
							</span>
						</div>
					</div>

					<!-- Row 8 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>How much is the lowest dollar amount invested by a client.</label>
							<span class="city">
								<input type="text" name="lowest_dollor_amt_by_client" value="">
							</span>
						</div>
					</div>

					<!-- Row 12 -->
					<div class="vc_row">
						<div class="column one client_fall_age border_bottom">
							<label>How many clients fall within the following age range</label>
						</div>
						<div class="column one-third">
							<label>% between the ages of 1-18</label>
							<span class="1_18">
								<input type="text" name="age_range[1_18]" value="">
							</span>
						</div><div class="column one-third">
							<label>% between the ages of 18-30</label>
							<span class="18_30">
								<input type="text" name="age_range[18_30]" value="">
							</span>
						</div><div class="column one-third">
							<label>% between the ages of 31-40</label>
							<span class="31_40">
								<input type="text" name="age_range[31_40]" value="">
							</span>
						</div><div class="column one-third">
							<label>% between the ages of 41-54</label>
							<span class="41_54">
								<input type="text" name="age_range[41_54]" value="">
							</span>
						</div><div class="column one-third">
							<label>% between the ages of 55-65</label>
							<span class="55_65">
								<input type="text" name="age_range[55_65]" value="">
							</span>
						</div><div class="column one-third">
							<label>% between the ages of 66+</label>
							<span class="66_">
								<input type="text" name="age_range[66_]" value="">
							</span>
						</div>
					</div>

					<div class="vc_row">
						<div class="column one border_bottom">
							<label>Identify how many clients are invested in the following investment vehicles: </label>
						</div>
					</div>
					<div class="vc_row">
						<div class="column one-second">
							<label>Cash and Cash equivalents</label>
							<span class="city">
								<input type="text" name="cash_and_cash_equivalents" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>Fixed Income Securities</label>
							<span class="city">
								<input type="text" name="fixed_income_scurities" value="">
							</span>
						</div>
					</div>
					<div class="vc_row">
						<div class="column one-second">
							<label>Equities</label>
							<span class="city">
								<input type="text" name="equities" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>Investment Funds</label>
							<span class="city">
								<input type="text" name="investment_fund" value="">
							</span>
						</div>
					</div>

					<div class="vc_row">
						<div class="column one border_bottom">
							<h4>Client account type break down</h4>
						</div>
					</div>
					<!-- row 9 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Number of clients with a Registered Retirement Account (RRSP, RRIF)</label>
							<span class="city">
								<input type="text" name="registered_retirement_account" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>Number of clients with a Locked-In Retirement Account (LIRA, LRSP, LIF)</label>
							<span class="city">
								<input type="text" name="locked_retirement_account" value="">
							</span>
						</div>
					</div>

					<!-- Row 10 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Number of clients with a Tax-Free Savings Account (TFSA)</label>
							<span class="city">
								<input type="text" name="tax_free_savings_account" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>Number of clients with a Registered Education Savings Plan (RESP)</label>
							<span class="city">
								<input type="text" name="registered_education_savings_plan" value="">
							</span>
						</div>
					</div>

					<!-- row 11 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Number of Clients with a Taxable Investment Account (Brokerage, Mutual Fund, etc)</label>
							<span class="city">
								<input type="text" name="taxable_investment_account" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>How many accounts are Leveraged accounts (Monies borrowed to invest)</label>
							<span class="city">
								<input type="text" name="leveraged_accounts" value="">
							</span>
						</div>
					</div>

					<div class="vc_row">
						<div class="column one-second column_attr align_left">
							<button class="btn btn-default btn-prev" type="button" aria-controls="step-2">Previous</button>
						</div>
						<div class="column one-second column_attr align_right">
							<button class="btn btn-default btn-next" type="button" aria-controls="step-4">Next</button>
						</div>
					</div>

				</fieldset>

				<!-- Step 4 -->

				<fieldset aria-label="Step Four" tabindex="-1" id="step-4">

					<!-- Work Experience -->
					<div class="work_experience">
						<div class="column one">
							<h4>Work Experience</h4>
						</div>

						<div class="work_experience_wrap">
							<div class="column one-third">
								<label>Company Name</label>
								<span class="city">
									<input type="text" name="work_experience[0][company_name]" value="">
								</span>
							</div>
							<div class="column one-third">
								<label>Job Title</label>
								<span class="city">
									<input type="text" name="work_experience[0][job_title]" value="">
								</span>
							</div>
							<div class="column one-third">
								<label>Year start- End Year</label>
								<span class="city">
									<input type="text" name="work_experience[0][duration]" value="">
								</span>
							</div>
							<div class="column one office-address">
								<label>Office Address:</label>
								<span class="office-address">
									<textarea name="work_experience[0][office_address]" cols="40" rows="1"></textarea>
								</span>
							</div>
						</div>

						<div class="vc_row">
							<?php echo do_shortcode('[fancy_link title="Add More Experience" link="javascript:void(0)" target="" style="4" class="add_more_experience" download=""]'); ?>
						</div>

						<div class="vc_row">
							<div class="column one-second column_attr align_left">
								<button class="btn btn-default btn-prev" type="button" aria-controls="step-3">Previous</button>
							</div>
							<div class="column one-second column_attr align_right">
								<button class="btn btn-default btn-next" type="button" aria-controls="step-5">Next</button>
							</div>
						</div>

					</div>
				</fieldset>

				<!-- Step 5 -->

				<fieldset aria-label="Step Four" tabindex="-1" id="step-5">
					<div class="vc_row">
						<div class="column one">
							<label>Additional Information</label>
							<textarea name="addendum" class="column" rows="4" cols="40"></textarea>
						</div>
					</div>

					<div class="vc_row">
						<div class="column one-second column_attr align_left">
							<button class="btn btn-default btn-prev" type="button" aria-controls="step-4">Previous</button>
						</div>
						<div class="column one-second column_attr align_right">
							<button class="btn btn-default btn-next" type="button" aria-controls="step-6">Next</button>
						</div>
					</div>
				</fieldset>

				<!-- Step 5 Final -->

				<fieldset aria-label="Step Five" tabindex="-1" id="step-6">
					<!-- UserName And Password -->
					<div class="vc_row">
						<div class="column one">
							<label>Username:</label>
							<span class="user-name">
								<input type="text" name="username" value="" required>
							</span>
						</div>	
					</div>
					<div class="vc_row">
						<div class="column one-second">
							<label>Password</label>
							<span class="password">
								<input id="advisor_pass_field" type="password" name="password" value="" required>
							</span>
						</div>
						<div class="column one-second">
							<label>Confirm Password</label>
							<span class="confirm-password">
								<input type="password" name="c_password" value="" required>
							</span>
						</div>	
					</div>

					<div class="vc_row">
					<!-- <div class="column one">
						<span class="casl">
                            <input type="checkbox" name="casl" checked required> CASL 
                        </span>	
                    </div> -->
                    <div class="column one">
                    	<input type="checkbox" name="casl" checked required>
                    	You are about to become a member of  Advisor Broker™ By subscribing to our Sign-Up form, I agree to receive electronic communications and/or newsletters from Advisor Broker™. Please refer to our <a href="<?php echo site_url('privacy-policy'); ?>"> Privacy Policy </a> or <a href="<?php echo site_url('terms-of-use'); ?>"> Terms of Use </a> for more details.
                    </div>
                </div>

                <div class="vc_row">
                	<div class="column one-second column_attr align_left">
                		<button class="btn btn-danger" type="reset">Start Over</button>
                	</div>
                	<div class="column one-second column_attr align_right">
                		<input type="submit" name="advisor_submit" value="Register" class="button">
                	</div>
                </div>
				<!-- <div class="vc_row column_attr align_right">
					<input type="submit" name="advisor_submit" value="Register" class="button">
					<button class="btn btn-default btn-edit" type="button">Edit</button> 
					<button class="btn btn-danger" type="reset">Start Over</button>
				</div> -->
			</fieldset>

		</form>
	</section>
	
	<?php
		dcrf_register_form_validation_scripts();
	} // is_user_logged_in

}

function dcrf_advisor_register_process(){

	if ( isset($_POST['advisor_submit']) && $_POST['advisor_submit']) {

		$first_name                 = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
		$last_name                  = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
		$email                      = (isset($_POST['email'])) ? $_POST['email'] : '';
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
		$leveraged_accounts         = (isset($_POST['leveraged_accounts'])) ? $_POST['leveraged_accounts'] : '';
		$cash_and_cash_equivalents  = (isset($_POST['cash_and_cash_equivalents'])) ? $_POST['cash_and_cash_equivalents'] : '';
		$fixed_income_scurities     = (isset($_POST['fixed_income_scurities'])) ? $_POST['fixed_income_scurities'] : '';
		$equities        			= (isset($_POST['equities'])) ? $_POST['equities'] : '';
		$investment_fund        	= (isset($_POST['investment_fund'])) ? $_POST['investment_fund'] : '';
		$looking_to_accomplish      = (isset($_POST['looking_to_accomplish'])) ? $_POST['looking_to_accomplish'] : '';
		$work_experience            = (isset($_POST['work_experience'])) ? $_POST['work_experience'] : '';

		$username                   = (isset($_POST['username'])) ? $_POST['username'] : '';
		$password                   = (isset($_POST['password'])) ? $_POST['password'] : '';
		$c_password                 = (isset($_POST['c_password'])) ? $_POST['c_password'] : '';
		
		$casl                 		= (isset($_POST['casl'])) ? $_POST['casl'] : '';

		if ($first_name && $email && $password && $username) {

            // check if user email/ username is exists
			if ( username_exists( $username ) ){
				dcrf_add_wp_errors( 'username_exists' , '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> UserName Already Taken By Another User </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
			} elseif ( email_exists($email) ) {
				dcrf_add_wp_errors( 'email_exists' , '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> E-mail Already Registered </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
			} else{
				$register_userdata = array(
                    'user_login'    => $username,// username
                    'user_email'    => $email,// user email
                    'first_name'    => $first_name, // first name
                    'last_name'     => $last_name, // last name
                    'user_pass'     => $password, // user password
                    'display_name'  => $first_name, // display name
                    'role'          => 'ab_advisor', // User role
                );

				$user_id = wp_insert_user( $register_userdata ) ;
				$user_id_role = new WP_User($user_id);

				update_user_meta($user_id, 'first_name', $first_name);
				update_user_meta($user_id, 'last_name', $last_name);
				update_user_meta($user_id, 'phone_number', $phone_number);
				update_user_meta($user_id, 'office_address', $office_address);
				update_user_meta($user_id, 'investment_dealer_name', $investment_dealer_name);
				update_user_meta($user_id, 'country', $country);
				update_user_meta($user_id, 'state', $state);
				update_user_meta($user_id, 'city', $city);
				update_user_meta($user_id, 'postal_code', $postal_code);
				update_user_meta($user_id, 'governing_regulatory_body', $governing_regulatory_body);
				update_user_meta($user_id, 'aum', $aum);
				update_user_meta($user_id, 'household_accounts', $household_accounts);
				update_user_meta($user_id, 'client_accounts', $client_accounts);
				update_user_meta($user_id, 'high_dollor_amt_by_client', $high_dollor_amt_by_client);
				update_user_meta($user_id, 'lowest_dollor_amt_by_client', $lowest_dollor_amt_by_client);
				update_user_meta($user_id, 'registered_retirement_account', $registered_retirement_account);
				update_user_meta($user_id, 'locked_retirement_account', $locked_retirement_account);
				update_user_meta($user_id, 'tax_free_savings_account', $tax_free_savings_account);
				update_user_meta($user_id, 'registered_education_savings_plan', $registered_education_savings_plan);
				update_user_meta($user_id, 'taxable_investment_account', $taxable_investment_account);
				update_user_meta($user_id, 'leveraged_accounts', $leveraged_accounts);
				update_user_meta($user_id, 'cash_and_cash_equivalents', $cash_and_cash_equivalents);
				update_user_meta($user_id, 'fixed_income_scurities', $fixed_income_scurities);
				update_user_meta($user_id, 'equities', $equities);
				update_user_meta($user_id, 'investment_fund', $investment_fund);
				update_user_meta($user_id, 'looking_to_accomplish', $looking_to_accomplish);
				update_user_meta($user_id, 'work_experience', $work_experience);
				update_user_meta($user_id, 'casl', $casl);
                // Auto Logged in when user register sucess
                //if ($user_role == 'company') {
                    //update_user_meta( $user_id, 'pw_user_status', 'pending');
                //}
				wp_setcookie($username, $password, true);
				wp_set_current_user($user_id, $username); 

				do_action('wp_login', $username);
				wp_redirect( home_url() );
				exit;
			}
		}else{
			dcrf_add_wp_errors( 'reg_fill_form' , '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> Fill all required fields </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
		}

    } // ---end $_POST[]
}
add_action( 'init', 'dcrf_advisor_register_process' );


// end user registration--------------------------------------------------------------------


/**
 * Firm Registration Process
 */
add_shortcode( 'dcrf_firm_register_form', 'dcrf_firm_register_form_func' );
function dcrf_firm_register_form_func(){

	if (is_user_logged_in()) {
		echo do_shortcode('[alert style="success"] You are already login [/alert]');
		echo do_shortcode('[button title="Go To Home" link="'.home_url().'" target="" icon="icon-home" icon_position="left" color="theme" font_color="" size="2" full_width="" class="" download="" onclick=""]');
	}else{
		
		echo dcrf_get_error_messages('username_exists');
		echo dcrf_get_error_messages('email_exists');
		echo dcrf_get_error_messages('password_not_match');
		echo dcrf_get_error_messages('reg_fill_form');
		?>
		<section class="dcrf dcrf_adregform_container">
			
			<!-- Progress Bar -->
			<div class="progress_steps">
				<ul class="firm_reg_progressbar">
					<li class="active">Firms Discovery</li>
					<li class="">Advisor Profile</li>
					<li class="">Advisor Portfolio</li>
					<li class="">Addendum</li>
					<li class="">Register</li>
				</ul>
			</div>
			
			<!-- Form Start -->
			<form action="" method="post" class="advisor_register_form">
				
				<!-- Step 1 -->
				
				<fieldset aria-label="Step One" tabindex="-1" id="step-1">
					<!-- Row 1 -->
					<div class="vc_row">
						<div class="column one">
							<label>Investment Dealer Name:</label>
							<span class="your-subject">
								<input type="text" name="investment_dealer_name" value="">
							</span>
						</div>
						<!-- <div class="column one-second">
							<label>Investment Dealer First Name*</label>
							<span class="first-name">
								<input type="text" name="first_name" value="" required>
							</span>
						</div>
						<div class="column one-second">
							<label>Investment Dealer Last Name</label>
							<span class="last-name">
								<input type="text" name="last_name" value="">
							</span>
						</div> -->
					</div>

					<!-- Row 2 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Email Address *</label>
							<span class="your-email">
								<input type="email" name="email" value="" required>
							</span>
						</div>
						<div class="column one-second">
							<label>Phone Number</label>
							<span class="last-name">
								<input type="number" name="phone_number" value="">
							</span>
						</div>
					</div>
					<!-- Row 3 -->
					<div class="column one vc_row">
						<label>Office Address</label>
						<textarea name="office_address" rows="2" cols="50"></textarea>
					</div>
					<!-- Row 4 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>City:</label>
							<span class="city">
								<input type="text" name="city" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>Province:</label>
							<span class="your-subject">
								<input type="text" name="state" value="">
							</span>
						</div>
					</div>
					<!-- Row 5 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Country:</label>
							<span class="country">
								<input type="text" name="country" value="">
							</span>
						</div>
						<div class="column one-second">
							<label>Postal Code:</label>
							<span class="city">
								<input type="text" name="postal_code" value="">
							</span>
						</div>
					</div>
					<!-- Row 6 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Governing Regulatory Body</label>
							<span class="country">
								<select name="governing_regulatory_body">
									<option value="mfda_advisor">MFDA Dealer</option>
									<option value="iiroc_advisor">IIROC Dealer</option>
									<option value="mfda_and_iiroc">MFDA & IIROC Dealer</option>
								</select>
							</span>
						</div>
					</div>

					<!-- Next Button -->
					<div class="vc_row column_attr align_right">
						<button class="btn btn-default btn-next" type="button" aria-controls="step-2">Next</button>
					</div>
				</fieldset>
				
				<!-- Step 2 -->
				
				<fieldset aria-label="Step Two" tabindex="-1" id="step-2">
					<!-- Row 7 -->
					<div class="vc_row">
						<div class="column one-second">
							<label>Advisor must be registered with</label>
							<span class="country">
								<select name="advisor_must_register_with">
									<option value="mfda">MFDA</option>
									<option value="iiroc">IIROC</option>
								</select>
							</span>
						</div>
						<div class="column one-second">
							<label>Advisor must be located in</label>
							<span class="your-subject">
								<input type="text" name="advisor_must_located" value="">
							</span>
						</div>
					</div>
					
					<!-- Row 7 -->
					<div class="vc_row">
						<div class="column one">
							<label>We are looking for advisors interested in changing firms</label>
							<span class="radio_row"><input type="radio" name="looking_to_advisor_interested" value="yes">Yes</span>
							<span class="radio_row"><input type="radio" name="looking_to_advisor_interested" value="no">No</span>
						</div>
					</div>

					<!-- Row 8 -->
					<div class="vc_row">
						<h4 class="reg_form_title">We will provide the following services</h4>
						<div class="column one-second">
							<label>We are willing to pay transfer fees</label>
							<span class="radio_row"><input type="radio" name="we_pay_transfer_fees" value="yes">Yes</span>
							<span class="radio_row"><input type="radio" name="we_pay_transfer_fees" value="no">No</span>
						</div>
						<div class="column one-second">
							<label>We will help with the repapering of client documents</label>
							<span class="radio_row"><input type="radio" name="we_will_repapairing_client" value="yes">Yes</span>
							<span class="radio_row"><input type="radio" name="we_will_repapairing_client" value="no">No</span>
						</div>
					</div>
					<!-- Button -->
					<div class="vc_row">
						<div class="column one-second column_attr align_left">
							<button class="btn btn-default btn-prev" type="button" aria-controls="step-1">Previous</button>
						</div>
						<div class="column one-second column_attr align_right">
							<button class="btn btn-default btn-next" type="button" aria-controls="step-3">Next</button>
						</div>
					</div>
				</fieldset>
				
				<!-- Step 3 -->
				
				<fieldset aria-label="Step Three" tabindex="-1" id="step-3">
					
					<!-- Row 7 -->
					<div class="vc_row">
						<div class="column one">
							<label>The advisors book of businss must fall within the following AUM</label>
							<span class="checkbox_row"><input type="checkbox" name="business_fall_with_aum[]" value="5_10_million">$5 Million - $10 Million</span>
							<span class="checkbox_row"><input type="checkbox" name="business_fall_with_aum[]" value="10_25_million">$10 Million - $25 Million</span>
							<span class="checkbox_row"><input type="checkbox" name="business_fall_with_aum[]" value="25_50_million">$25 Million - $50 Million</span>
							<span class="checkbox_row"><input type="checkbox" name="business_fall_with_aum[]" value="50_100_million">$50 Million - $100 Million</span>
							<span class="checkbox_row"><input type="checkbox" name="business_fall_with_aum[]" value="100_250_million">$100 Million - $250 Million</span>
							<span class="checkbox_row"><input type="checkbox" name="business_fall_with_aum[]" value="250_500_million">$250 Million - $500 Million</span>
							<span class="checkbox_row"><input type="checkbox" name="business_fall_with_aum[]" value="500_million_plus">$500 Million +</span>
						</div>

						<div class="column one">
							<label>We are looking for advisors with the following number of household accounts</label>
							<span class="checkbox_row"><input type="checkbox" name="household_accounts[]" value="1_50_ha">1 - 50</span>
							<span class="checkbox_row"><input type="checkbox" name="household_accounts[]" value="50_100_ha">50 - 100</span>
							<span class="checkbox_row"><input type="checkbox" name="household_accounts[]" value="100_250_ha">100 - 250</span>
							<span class="checkbox_row"><input type="checkbox" name="household_accounts[]" value="250_500_ha">250 - 500</span>
							<span class="checkbox_row"><input type="checkbox" name="household_accounts[]" value="500_1000_ha">500 - 1000</span>
							<span class="checkbox_row"><input type="checkbox" name="household_accounts[]" value="1000_plus_ha">1000+</span>
						</div>

						<div class="column one">
							<label>We are looking for advisors with the following number of client accounts</label>
							<span class="checkbox_row"><input type="checkbox" name="client_accounts[]" value="1_50_ha">1 - 50</span>
							<span class="checkbox_row"><input type="checkbox" name="client_accounts[]" value="50_100_ha">50 - 100</span>
							<span class="checkbox_row"><input type="checkbox" name="client_accounts[]" value="100_250_ha">100 - 250</span>
							<span class="checkbox_row"><input type="checkbox" name="client_accounts[]" value="250_500_ha">250 - 500</span>
							<span class="checkbox_row"><input type="checkbox" name="client_accounts[]" value="500_1000_ha">500 - 1000</span>
							<span class="checkbox_row"><input type="checkbox" name="client_accounts[]" value="1000_plus_ha">1000+</span>
						</div>
					</div>

					<!-- Row 8 -->
					<div class="vc_row">
						<h4 class="reg_form_title">We are looking for advisors with the following client account type break down</h4>
						
						<div class="column one-second">
							<label>Number of clients with a Registered Retirement Account (RRSP, RRIF)</label>
							<span class="country">
								<select name="registered_retirement_account">
									<option value="0_10_percent">0% - 10%</option>
									<option value="10_20_percent">10% - 20%</option>
									<option value="20_30_percent">20% - 30%</option>
									<option value="30_40_percent">30% - 40%</option>
									<option value="40_50_percent">40% - 50%</option>
									<option value="50_60_percent">50% - 60%</option>
									<option value="60_70_percent">60% - 70%</option>
									<option value="70_80_percent">70% - 80%</option>
									<option value="80_90_percent">80% - 90%</option>
									<option value="90_100_percent">90% - 100%</option>
								</select>
							</span>
						</div>

						<div class="column one-second">
							<label>Number of clients with a Locked-In Retirement Account (LIRA, LRSP, LIF)</label>
							<span class="country">
								<select name="locked_retirement_account">
									<option value="0_10_percent">0% - 10%</option>
									<option value="10_20_percent">10% - 20%</option>
									<option value="20_30_percent">20% - 30%</option>
									<option value="30_40_percent">30% - 40%</option>
									<option value="40_50_percent">40% - 50%</option>
									<option value="50_60_percent">50% - 60%</option>
									<option value="60_70_percent">60% - 70%</option>
									<option value="70_80_percent">70% - 80%</option>
									<option value="80_90_percent">80% - 90%</option>
									<option value="90_100_percent">90% - 100%</option>
								</select>
							</span>
						</div>

						<div class="column one-second">
							<label>Number of clients with a Tax-Free Savings Account (TFSA)</label>
							<span class="country">
								<select name="tax_free_savings_account">
									<option value="0_10_percent">0% - 10%</option>
									<option value="10_20_percent">10% - 20%</option>
									<option value="20_30_percent">20% - 30%</option>
									<option value="30_40_percent">30% - 40%</option>
									<option value="40_50_percent">40% - 50%</option>
									<option value="50_60_percent">50% - 60%</option>
									<option value="60_70_percent">60% - 70%</option>
									<option value="70_80_percent">70% - 80%</option>
									<option value="80_90_percent">80% - 90%</option>
									<option value="90_100_percent">90% - 100%</option>
								</select>
							</span>
						</div>

						<div class="column one-second">
							<label>Number of clients with a Registered Education Savings Plan (RESP)</label>
							<span class="country">
								<select name="registered_education_savings_plan">
									<option value="0_10_percent">0% - 10%</option>
									<option value="10_20_percent">10% - 20%</option>
									<option value="20_30_percent">20% - 30%</option>
									<option value="30_40_percent">30% - 40%</option>
									<option value="40_50_percent">40% - 50%</option>
									<option value="50_60_percent">50% - 60%</option>
									<option value="60_70_percent">60% - 70%</option>
									<option value="70_80_percent">70% - 80%</option>
									<option value="80_90_percent">80% - 90%</option>
									<option value="90_100_percent">90% - 100%</option>
								</select>
							</span>
						</div>

						<div class="column one-second">
							<label>Number of Clients with a Taxable Investment Account (Brokerage, Mutual Fund, etc)</label>
							<span class="country">
								<select name="taxable_investment_account">
									<option value="0_10_percent">0% - 10%</option>
									<option value="10_20_percent">10% - 20%</option>
									<option value="20_30_percent">20% - 30%</option>
									<option value="30_40_percent">30% - 40%</option>
									<option value="40_50_percent">40% - 50%</option>
									<option value="50_60_percent">50% - 60%</option>
									<option value="60_70_percent">60% - 70%</option>
									<option value="70_80_percent">70% - 80%</option>
									<option value="80_90_percent">80% - 90%</option>
									<option value="90_100_percent">90% - 100%</option>
								</select>
							</span>
						</div>
					</div>

					<div class="vc_row">
						<div class="column one-second column_attr align_left">
							<button class="btn btn-default btn-prev" type="button" aria-controls="step-2">Previous</button>
						</div>
						<div class="column one-second column_attr align_right">
							<button class="btn btn-default btn-next" type="button" aria-controls="step-4">Next</button>
						</div>
					</div>

				</fieldset>

				<!-- Step 4 -->

				<fieldset aria-label="Step Four" tabindex="-1" id="step-4">

					<div class="vc_row">
						<div class="column one">
							<label>Additional Information</label>
							<textarea name="addendum" class="column" rows="4" cols="40"></textarea>
						</div>
					</div>
					<div class="vc_row">
						<div class="column one-second column_attr align_left">
							<button class="btn btn-default btn-prev" type="button" aria-controls="step-3">Previous</button>
						</div>
						<div class="column one-second column_attr align_right">
							<button class="btn btn-default btn-next" type="button" aria-controls="step-5">Next</button>
						</div>
					</div>
				</fieldset>

				<!-- Step 5 Final -->

				<fieldset aria-label="Step Five" tabindex="-1" id="step-5">
					<!-- UserName And Password -->
					<div class="vc_row">
						<div class="column one">
							<label>Username</label>
							<span class="user-name">
								<input type="text" name="username" value="" required>
							</span>
						</div>	
					</div>
					<div class="vc_row">
						<div class="column one-second">
							<label>Password</label>
							<span class="password">
								<input id="advisor_pass_field" type="password" name="password" value="" required>
							</span>
						</div>
						<div class="column one-second">
							<label>Confirm Password</label>
							<span class="confirm-password">
								<input type="password" name="c_password" value="" required>
							</span>
						</div>	
					</div>
					<div class="vc_row">
						<div class="column one">
							<input type="checkbox" name="casl" checked required>
							You are about to become a member of  Advisor Broker™ By subscribing to our Sign-Up form, I agree to receive electronic communications and/or newsletters from Advisor Broker™. Please refer to our <a href="<?php echo site_url('privacy-policy'); ?>"> Privacy Policy </a> or <a href="<?php echo site_url('terms-of-use'); ?>"> Terms of Use </a> for more details.
						</div>
					</div>
					<div class="vc_row">
						<div class="column one-second column_attr align_left">
							<button class="btn btn-danger" type="reset">Start Over</button>
						</div>
						<div class="column one-second column_attr align_right">
							<input type="submit" name="firm_submit" value="Register" class="button">
						</div>
					</div>
				</fieldset>

			</form>
		</section>

		<?php
		dcrf_register_form_validation_scripts();
	} //-> is_user_logged_in

} //-> dcrf_firm_register_form_func

/**
 * Firm Registration Process
 */
add_action('init','dcrf_firm_register_form_process');
function dcrf_firm_register_form_process(){
	if ( isset($_POST['firm_submit']) && $_POST['firm_submit']) {
		//$first_name                 = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
		//$last_name                  = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
		$email                      	= (isset($_POST['email'])) ? $_POST['email'] : '';
		$phone_number               	= (isset($_POST['phone_number'])) ? $_POST['phone_number'] : '';
		$office_address             	= (isset($_POST['office_address'])) ? $_POST['office_address'] : '';
		$investment_dealer_name     	= (isset($_POST['investment_dealer_name'])) ? $_POST['investment_dealer_name'] : '';
		$country                    	= (isset($_POST['country'])) ? $_POST['country'] : '';
		$state                      	= (isset($_POST['state'])) ? $_POST['state'] : '';
		$city                       	= (isset($_POST['city'])) ? $_POST['city'] : '';
		$postal_code                	= (isset($_POST['postal_code'])) ? $_POST['postal_code'] : '';
		$governing_regulatory_body  	= (isset($_POST['governing_regulatory_body'])) ? $_POST['governing_regulatory_body'] : '';
		$advisor_must_register_with 	= (isset($_POST['advisor_must_register_with'])) ? $_POST['advisor_must_register_with'] : '';
		$advisor_must_located 			= (isset($_POST['advisor_must_located'])) ? $_POST['advisor_must_located'] : '';
		$looking_to_advisor_interested 	= (isset($_POST['looking_to_advisor_interested'])) ? $_POST['looking_to_advisor_interested'] : '';
		$we_pay_transfer_fees 			= (isset($_POST['we_pay_transfer_fees'])) ? $_POST['we_pay_transfer_fees'] : '';
		$we_will_repapairing_client 	= (isset($_POST['we_will_repapairing_client'])) ? $_POST['we_will_repapairing_client'] : '';
		$business_fall_with_aum 		= (isset($_POST['business_fall_with_aum'])) ? $_POST['business_fall_with_aum'] : '';
		$household_accounts 			= (isset($_POST['household_accounts'])) ? $_POST['household_accounts'] : '';
		$client_accounts 				= (isset($_POST['client_accounts'])) ? $_POST['client_accounts'] : '';
		$registered_retirement_account 	= (isset($_POST['registered_retirement_account'])) ? $_POST['registered_retirement_account'] : '';
		$locked_retirement_account  	= (isset($_POST['locked_retirement_account'])) ? $_POST['locked_retirement_account'] : '';
		$tax_free_savings_account   	= (isset($_POST['tax_free_savings_account'])) ? $_POST['tax_free_savings_account'] : '';
		$registered_education_savings_plan = (isset($_POST['registered_education_savings_plan'])) ? $_POST['registered_education_savings_plan'] : '';
		$taxable_investment_account 	= (isset($_POST['taxable_investment_account'])) ? $_POST['taxable_investment_account'] : '';
		$addendum            			= (isset($_POST['addendum'])) ? $_POST['addendum'] : '';
		$username                   	= (isset($_POST['username'])) ? $_POST['username'] : '';
		$password                   	= (isset($_POST['password'])) ? $_POST['password'] : '';
		$c_password                 	= (isset($_POST['c_password'])) ? $_POST['c_password'] : '';
		$casl                 			= (isset($_POST['casl'])) ? $_POST['casl'] : '';

		if ($email && $password && $username && $c_password ) {

			if ($password == $c_password ) {
				// check if user email/ username is exists
				if ( username_exists( $username ) ){
					dcrf_add_wp_errors( 'username_exists' , '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> UserName Already Taken By Another User </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
				} elseif ( email_exists($email) ) {
					dcrf_add_wp_errors( 'email_exists' , '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> E-mail Already Registered </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
				} else{
					$register_userdata = array(
	                    'user_login'    => $username,// username
	                    'user_email'    => $email,// user email
	                    'first_name'    => $investment_dealer_name, // first name
	                    //'last_name'     => $last_name, // last name
	                    'user_pass'     => $password, // user password
	                    'display_name'  => $investment_dealer_name, // display name
	                    'role'          => 'ab_firm', // User role
	                );
					$user_id = wp_insert_user( $register_userdata ) ;
					$user_id_role = new WP_User($user_id);

					//update_user_meta($user_id, 'first_name', $first_name);
					//update_user_meta($user_id, 'last_name', $last_name);
					update_user_meta($user_id, 'phone_number', $phone_number);
					update_user_meta($user_id, 'office_address', $office_address);
					update_user_meta($user_id, 'investment_dealer_name', $investment_dealer_name);
					update_user_meta($user_id, 'country', $country);
					update_user_meta($user_id, 'state', $state);
					update_user_meta($user_id, 'city', $city);
					update_user_meta($user_id, 'postal_code', $postal_code);
					update_user_meta($user_id, 'governing_regulatory_body', $governing_regulatory_body);
					update_user_meta($user_id, 'advisor_must_register_with', $advisor_must_register_with);
					update_user_meta($user_id, 'advisor_must_located', $advisor_must_located);
					update_user_meta($user_id, 'looking_to_advisor_interested', $looking_to_advisor_interested);
					update_user_meta($user_id, 'we_pay_transfer_fees', $we_pay_transfer_fees);
					update_user_meta($user_id, 'we_will_repapairing_client', $we_will_repapairing_client);
					update_user_meta($user_id, 'aum', $business_fall_with_aum);
					update_user_meta($user_id, 'household_accounts', $household_accounts);
					update_user_meta($user_id, 'client_accounts', $client_accounts);		
					update_user_meta($user_id, 'registered_retirement_account', $registered_retirement_account);
					update_user_meta($user_id, 'locked_retirement_account', $locked_retirement_account);
					update_user_meta($user_id, 'tax_free_savings_account', $tax_free_savings_account);
					update_user_meta($user_id, 'registered_education_savings_plan', $registered_education_savings_plan);
					update_user_meta($user_id, 'taxable_investment_account', $taxable_investment_account);
					update_user_meta($user_id, 'addendum', $addendum);
					update_user_meta($user_id, 'casl', $casl);
	              
					wp_setcookie($username, $password, true);
					wp_set_current_user($user_id, $username); 

					do_action('wp_login', $username);
					wp_redirect( home_url() );
					exit;
				}
			}else{
				dcrf_add_wp_errors( 'password_not_match' , '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> Password And Confirm Password Not Match </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
			}
		}else{
			dcrf_add_wp_errors( 'reg_fill_form' , '<div class="alert alert_error"><div class="alert_icon"><i class="icon-alert"></i></div><div class="alert_wrapper"> Fill all required fields </div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
		}
	} //-> $_POST[]
}

// End Firm Registration--------------------------------------------------------------------


/** Register Process Jquery Scripts **/
function dcrf_register_form_validation_scripts(){
	
	wp_enqueue_script('child_jquery_validation'); ?>
	
	<script type="text/javascript">
		jQuery(document).ready(function($){
				// Multi Step Form Script
				var app = {
					init: function(){
						this.cacheDOM();
						this.setupAria();
						this.nextButton();
						this.prevButton();
						this.validateForm();
						this.startOver();
						this.editForm();
						this.killEnterKey();
						this.handleStepClicks();
					},
					cacheDOM: function(){
						if(jQuery(".dcrf_adregform_container").size() === 0){ return; }
						this.$formParent = $(".dcrf_adregform_container");
						this.$form = this.$formParent.find("form");
						this.$formStepParents = this.$form.find("fieldset"),
						this.$nextButton = this.$form.find(".btn-next");
						this.$prevButton = this.$form.find(".btn-prev");
						this.$editButton = this.$form.find(".btn-edit");
						this.$resetButton = this.$form.find("[type='reset']");
						this.$stepsParent = $(".progress_steps");
						this.$steps = this.$stepsParent.find("ul li");
					},
					htmlClasses: {
						activeClass: "active",
						hiddenClass: "hidden",
						visibleClass: "visible",
						editFormClass: "edit-form",
						animatedVisibleClass: "animated fadeIn",
						animatedHiddenClass: "animated fadeOut",
						animatingClass: "animating"
					},
					setupAria: function(){
						// set first parent to visible
						this.$formStepParents.eq(0).attr("aria-hidden",false);
						// set all other parents to hidden
						this.$formStepParents.not(":first").attr("aria-hidden",true);
						// handle aria-expanded on next/prev buttons
						app.handleAriaExpanded();
					},
					nextButton: function(){
						this.$nextButton.on("click", function(e){
							e.preventDefault();
							// grab current step and next step parent
							var $this = jQuery(this),
							currentParent = $this.closest("fieldset"),
							nextParent = currentParent.next();
								// if the form is valid hide current step
								// trigger next step
								if(app.checkForValidForm()){
									currentParent.removeClass(app.htmlClasses.visibleClass);
									app.showNextStep(currentParent, nextParent);
								}
							});
					},
					prevButton: function(){
						this.$prevButton.on("click", function(e){
							e.preventDefault();
							// grab current step parent and previous parent
							var $this = jQuery(this),
							currentParent = jQuery(this).closest("fieldset"),
							prevParent = currentParent.prev();
								// hide current step and show previous step
								// no need to validate form here
								currentParent.removeClass(app.htmlClasses.visibleClass);
								app.showPrevStep(currentParent, prevParent);
							});
					},
					showNextStep: function(currentParent,nextParent){
						// hide previous parent
						currentParent
						.addClass(app.htmlClasses.hiddenClass)
						.attr("aria-hidden",true);
						// show next parent
						nextParent
						.removeClass(app.htmlClasses.hiddenClass)
						.addClass(app.htmlClasses.visibleClass)
						.attr("aria-hidden",false);
						// focus first input on next parent
						nextParent.focus();
						// activate appropriate step
						app.handleState(nextParent.index());
						// handle aria-expanded on next/prev buttons
						app.handleAriaExpanded();
					},
					showPrevStep: function(currentParent,prevParent){
						// hide previous parent
						currentParent
						.addClass(app.htmlClasses.hiddenClass)
						.attr("aria-hidden",true);
						// show next parent
						prevParent
						.removeClass(app.htmlClasses.hiddenClass)
						.addClass(app.htmlClasses.visibleClass)
						.attr("aria-hidden",false);
						// send focus to first input on next parent
						prevParent.focus();
						// activate appropriate step
						app.handleState(prevParent.index());
						// handle aria-expanded on next/prev buttons
						app.handleAriaExpanded();
					},
					handleAriaExpanded: function(){
						$.each(this.$nextButton, function(idx,item){
							var controls = jQuery(item).attr("aria-controls");
							if(jQuery("#"+controls).attr("aria-hidden") == "true"){
								jQuery(item).attr("aria-expanded",false);
							}else{
								jQuery(item).attr("aria-expanded",true);
							}
						});
						$.each(this.$prevButton, function(idx,item){
							var controls = jQuery(item).attr("aria-controls");
							if(jQuery("#"+controls).attr("aria-hidden") == "true"){
								jQuery(item).attr("aria-expanded",false);
							}else{
								jQuery(item).attr("aria-expanded",true);
							}
						});
					},
					validateForm: function(){
						// jquery validate form validation
						this.$form.validate({
							ignore: ":hidden", // any children of hidden desc are ignored
							errorElement: "span", // wrap error elements in span not label
							invalidHandler: function(event, validator){ // add aria-invalid to el with error
								$.each(validator.errorList, function(idx,item){
									if(idx === 0){
										jQuery(item.element).focus(); // send focus to first el with error
									}
									jQuery(item.element).attr("aria-invalid",true); // add invalid aria
								})
							},
							submitHandler: function(form) {
								//alert("form submitted!");
								form.submit();
							}
						});
					},
					checkForValidForm: function(){
						if(this.$form.valid()){
							return true;
						}
					},
					startOver: function(){
						var $parents = this.$formStepParents,
						$firstParent = this.$formStepParents.eq(0),
						$formParent = this.$formParent,
						$stepsParent = this.$stepsParent;
						this.$resetButton.on("click", function(e){
								// hide all parents - show first
								$parents
								.removeClass(app.htmlClasses.visibleClass)
								.addClass(app.htmlClasses.hiddenClass)
								.eq(0).removeClass(app.htmlClasses.hiddenClass)
								.eq(0).addClass(app.htmlClasses.visibleClass);
									// remove edit state if present
									$formParent.removeClass(app.htmlClasses.editFormClass);
									// manage state - set to first item
									app.handleState(0);
									// reset stage for initial aria state
									app.setupAria();
									// send focus to first item
									setTimeout(function(){
										$firstParent.focus();
									},200);
							}); // click
					},
					handleState: function(step){
						this.$steps.eq(step).prevAll().removeAttr("disabled");
						this.$steps.eq(step).addClass(app.htmlClasses.activeClass);
						// restart scenario
						if(step === 0){
							this.$steps
							.removeClass(app.htmlClasses.activeClass)
							.attr("disabled","disabled");
							this.$steps.eq(0).addClass(app.htmlClasses.activeClass)
						}
					},
					editForm: function(){
						var $formParent = this.$formParent,
						$formStepParents = this.$formStepParents,
						$stepsParent = this.$stepsParent;
						this.$editButton.on("click",function(){
							$formParent.toggleClass(app.htmlClasses.editFormClass);
							$formStepParents.attr("aria-hidden",false);
							$formStepParents.eq(0).find("input").eq(0).focus();
							app.handleAriaExpanded();
						});
					},
					killEnterKey: function(){
						jQuery(document).on("keypress", ":input:not(textarea,button)", function(event) {
							return event.keyCode != 13;
						});
					},
					handleStepClicks: function(){
						var $stepTriggers = this.$steps,
						$stepParents = this.$formStepParents;
						$stepTriggers.on("click", function(e){
							e.preventDefault();
							var btnClickedIndex = jQuery(this).index();
								// kill active state for items after step trigger
								$stepTriggers.nextAll()
								.removeClass(app.htmlClasses.activeClass)
								.attr("disabled",true);
								// activate button clicked
								jQuery(this)
								.addClass(app.htmlClasses.activeClass)
								.attr("disabled",false)
								// hide all step parents
								$stepParents
								.removeClass(app.htmlClasses.visibleClass)
								.addClass(app.htmlClasses.hiddenClass)
								.attr("aria-hidden",true);
								// show step that matches index of button
								$stepParents.eq(btnClickedIndex)
								.removeClass(app.htmlClasses.hiddenClass)
								.addClass(app.htmlClasses.visibleClass)
								.attr("aria-hidden",false)
								.focus();
							});
					}
				};
				app.init();
				// End Form steps
			});
		</script>
		<?php
}//-> dcrf_register_form_validaton scripts





















/**
 * Registration process with Ajax
 */

//add_action( 'wp_ajax_ejobb_register_function', 'ejobb_register_func' );
// add_action( 'wp_ajax_nopriv_dcrf_register_ajax_function', 'dcrf_register_ajax_func' );

// function dcrf_register_ajax_func(){

//     //Register process
//     if (isset($_POST['ejobb_reg_data'])) {

//         parse_str($_POST['ejobb_reg_data'] , $params);

//         $user_first_name = $params['reg_user_first_name'];
//         $user_last_name = $params['reg_user_last_name'];
//         $user_name = $params['reg_user_username'];
//         $user_email = $params['reg_user_email'];
//         $user_password = $params['reg_user_pass'];
//         $user_confrm_password = $params['reg_user_confrm_pass'];
//         $user_role = $params['reg_user_role'];
//         $reg_user_term_conditions = $params['reg_user_term_conditions'];

//         if (!$user_first_name || !$user_name || !$user_email || !$user_password || !$user_confrm_password || !$user_role || !$reg_user_term_conditions || $user_password != $user_confrm_password) :
//             echo json_encode(array('type' => 'reg_login_error' , 'msg' => '<div class="alert alert-danger reg_error_text_msg">Please fill up all required Fields</div>' ));
//         else :
//         if ( !username_exists( $user_name ) and email_exists($user_email) == false) {

//             $register_userdata = array(
//                 'first_name'    => $user_first_name,
//                 'last_name'     => $user_last_name,
//                 'user_login'    => $user_name,
//                 'user_email'    => $user_email,
//                 'user_pass'     => $user_password,
//                 'user_nicename' => $user_first_name,
//                 'display_name'  => $user_first_name,
//             );

//             $user_id = wp_insert_user( $register_userdata ) ;

//             $user_id_role = new WP_User($user_id);

//             $user_role_status = $user_id_role->set_role($user_role);

//             // Confirmation mail
//             // $subject = 'Confirmation Mail From ';
//             // $message = 'Thanks for signing up';
//             // $user_info = get_userdata($user_id);
//             // $user_mail = $user_info->user_email;
//             // $status = wp_mail( $user_mail, $subject, $message );

//             // Auto Logged in when user register sucess

//             if ($user_role == 'job_visitors') {

//                 update_user_meta( $user_id, 'pw_user_status', 'approved');

//                 $creds = array();
//                 $creds['user_login'] = $user_email;
//                 $creds['user_password'] = $user_password;

//                 $user = wp_signon( $creds, false );
//                 if ( is_wp_error($user) ){
//                     echo json_encode(array('type' => 'reg_login_error' , 'msg' => '<div class="alert alert-danger reg_error_text_msg">Inloggningsfel!</div>' ));
//                 }else{
//                     echo json_encode(array('type' => 'reg_auto_login' , 'msg' => '<div class="alert alert-success">Logga in med framgång!</div>' ));
//                 }
//             }elseif ($user_role == 'job_agencies') {
//                 echo json_encode(array('type' => 'go_for_approval' , 'msg' => '<div class="alert alert-success">Tack för din registrering. Vi meddelar dig när din registrering har blivit godkänd.</div>' ));
//             }
//         } else {
//             echo json_encode(array('type' => 'already_exist' , 'msg' => '<div class="alert alert-info reg_error_text_msg">Redan skapas med denna E-post eller användarnamn!</div>' ));
//         }
//         endif;
//         exit();
//     }

// }


/* ?>
<script type="text/javascript">

// Register process
    jQuery('#reg_user_register_form').submit(function(event){

        event.preventDefault();
        var this_var = jQuery(this);
        this_var.attr('disabled','disabled');
        jQuery(".register_loder").addClass("lode_tr");
                
        var serialize_form_data = this_var.serialize();
        jQuery.ajax({
            type : "POST",
            url  : ejobb_ajax_object.ajax_url,
            data : {
                action : 'dcrf_register_ajax_function',
                ejobb_reg_data : serialize_form_data,
            },
            dataType: "json",
            success: function(data){
                if (data.type == 'reg_login_error') {
                    jQuery('.reg_form_message').html(data.msg);
                    jQuery( ".reg_form_message .reg_error_text_msg" ).effect( "shake", {times:2}, 1000 );;
                }
                if (data.type == 'reg_auto_login') {
                    window.location.href = ejobb_ajax_object.site_url;
                }
                if (data.type == 'go_for_approval') {
                    jQuery('.reg_form_message').html(data.msg);
                }
                if (data.type == 'already_exist') {
                    jQuery('.reg_form_message').html(data.msg);
                }
                this_var.removeAttr('disabled');
                jQuery(".register_loder").removeClass("lode_tr");
            }
        })
    });

    // confirm password checker
     function reg_user_checkPass(){
        var reg_user_pass = document.getElementById('reg_user_pass');
        var reg_user_confrm_pass = document.getElementById('reg_user_confrm_pass');
        var message = document.getElementById('reg_user_confrm_pass_check');

        if(reg_user_pass.value == reg_user_confrm_pass.value){
            message.style.color = "#66cc66";
            message.innerHTML = "Lösenord matchar!"
        }else{
            message.style.color = "#ff6666";
            message.innerHTML = "Lösenord matchar inte!"
        }
    }

</script>

<form id="reg_user_register_form" method="POST" action="">

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <input type="text" name="reg_user_first_name" id="first_name" class="form-control required" placeholder="Förnamn" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <input type="text" name="reg_user_last_name" id="last_name" class="form-control" placeholder="Efternamn">
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="text" name="reg_user_username" id="username" class="form-control  required" placeholder="Användarnamn" required>
    </div>
    <div class="form-group">
        <input type="email" name="reg_user_email" id="email" class="form-control required" placeholder="E-postadress" required>
    </div>
    <div class="form-group">
        <select name="reg_user_role" class="reg_select_role form-control" required>
            <option value="">Välj din roll</option>
            <option value="job_agencies">Rekryterare / företag</option>
            <option value="job_visitors">Jobbsökande</option>
        </select>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <input type="password" name="reg_user_pass" id="reg_user_pass" class="form-control" placeholder="Lösenord" required>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <input type="password" name="reg_user_confrm_pass" id="reg_user_confrm_pass" class="form-control" placeholder="Bekräfta lösenord" onkeyup="reg_user_checkPass(); return false;" required>
            </div>
        </div>
        <div id="reg_user_confrm_pass_check" class="col-xs-6 col-sm-6 col-md-6 confirmMessage"></div>
        <div class="form-group col-sm-12 col-xs-12 term_nd_conditions">
            <label><input type="checkbox" name="reg_user_term_conditions" class="terms_and_conditions" required>  Godkänn våra villkor. <a href="<?php echo site_url('terms-and-conditions'); ?>" target="_blank">Läs dem här</a></label>
        </div>
        <div class="col-sm-12">
            <input type="submit" name="reg_user_submit" value="Registrera" class="btn btn-primary">
        </div>
    </div>
</form>
*/ ?>