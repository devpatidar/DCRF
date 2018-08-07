<?php
/**
* User Dashboard Section
* User info, User Profile, Change Password
*/

add_shortcode( 'dcrf_user_dashboard', 'dcrf_user_dashboard_func' );
function dcrf_user_dashboard_func(){

	?>

	<!-- Icon Cards-->
	<div class="row">
		<!-- <div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-primary o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fa fa-fw fa-comments"></i>
					</div>
					<div class="mr-5">26 New Messages!</div>
				</div>
				<a href="#" class="card-footer text-white clearfix small z-1">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fa fa-angle-right"></i>
					</span>
				</a>
			</div>
		</div> -->
		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-warning o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fa fa-fw fa-list"></i>
					</div>
					<div class="mr-5">
						<?php
						$current_month_year 		= date('_m_Y');
						$current_month_name 		= date('M');
						$current_date 				= date('d');
						$get_current_month_data 	= dcrf_current_user_meta('dcrf_visitor_count'.$current_month_year,dcrf_get_current_user_data()->ID);
						$total_pre_mon_data 		= (!empty($get_current_month_data) && is_array($get_current_month_data)) ? array_sum($get_current_month_data) : '';
						echo $total_pre_mon_data;
						?> 
						Users Visits
					</div>
				</div>
				<a href="#" class="card-footer text-white clearfix small z-1">
					<span class="float-left"></span>
					<span class="float-right">
						<i class="fa fa-angle-right"></i>
					</span>
				</a>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-success o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fa fa-fw fa-shopping-cart"></i>
					</div>
					<?php $interested_user_list = dcrf_current_user_meta('interested_advisor_list'); ?>
					<div class="mr-5"><?php if ($interested_user_list && is_array($interested_user_list)) { echo count($interested_user_list); }else{ echo '0';} ?> User Interested!</div>
				</div>
				<a href="<?php echo site_url('dashboard/interested-user-notification'); ?>" class="card-footer text-white clearfix small z-1">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fa fa-angle-right"></i>
					</span>
				</a>
			</div>
		</div>
		<!-- <div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-danger o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fa fa-fw fa-support"></i>
					</div>
					<div class="mr-5">13 New Tickets!</div>
				</div>
				<a href="#" class="card-footer text-white clearfix small z-1">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fa fa-angle-right"></i>
					</span>
				</a>
			</div>
		</div> -->
	</div>
	
	<!-- Area Chart Example-->
	<!-- <div class="card mb-3">
		<div class="card-header">
			<i class="fa fa-area-chart"></i> Area Chart Example</div>
			<div class="card-body"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;" class="chartjs-size-monitor-expand"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;" class="chartjs-size-monitor-shrink"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
			<canvas height="308" width="1027" id="myAreaChart" style="display: block; width: 1027px; height: 308px;" class="chartjs-render-monitor"></canvas>
		</div>
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	</div> -->
	
	<?php if (dcrf_get_current_user_data('roles') == 'ab_advisor') { ?>

	<div class="row">
		<div class="col-lg-4 col-md-4">
			<!-- Example Pie Chart Card-->
			<div class="card mb-3">
				<div class="card-header">
					<i class="fa fa-pie-chart"></i> Leveraged Accounts </div>
					<div class="card-body"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;" class="chartjs-size-monitor-expand"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;" class="chartjs-size-monitor-shrink"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
					<canvas height="294" width="294" id="myPieChart2" style="display: block; width: 294px; height: 294px;" class="chartjs-render-monitor"></canvas>
				</div>
				<!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
			</div>	
		</div>

		<div class="col-lg-8 col-md-8">
			<!-- Example Bar Chart Card-->
			<div class="card mb-3">
				<div class="card-header">
					<i class="fa fa-bar-chart"></i>	Account types </div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-9 my-auto"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;" class="chartjs-size-monitor-expand"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;" class="chartjs-size-monitor-shrink"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
							<canvas height="215" width="430" id="myBarChart" style="display: block; width: 430px; height: 215px;" class="chartjs-render-monitor"></canvas>
						</div>
						<div class="col-sm-3 my-auto">
							<!-- <div class="h4 mb-0 text-primary"><?php echo dcrf_current_user_meta('registered_retirement_account'); ?></div> -->
							<div class="small text-muted">Registered Retirement Account - RRSP, RRIF</div>
							<hr>
							<!-- <div class="h4 mb-0 text-primary"><?php echo dcrf_current_user_meta('locked_retirement_account'); ?></div> -->
							<div class="small text-muted">Locked-In Retirement Account  - LIRA, LRSP, LIF</div>
							<hr>
							<!-- <div class="h4 mb-0 text-primary"><?php echo dcrf_current_user_meta('tax_free_savings_account'); ?></div> -->
							<div class="small text-muted">Tax-Free Savings Account  - TFSA</div>
							<hr>
							<!-- <div class="h4 mb-0 text-primary"><?php echo dcrf_current_user_meta('registered_education_savings_plan'); ?></div> -->
							<div class="small text-muted">Registered Education Savings Plan - RESP</div>
							<hr>
							<!-- <div class="h4 mb-0 text-primary"><?php echo dcrf_current_user_meta('taxable_investment_account'); ?></div> -->
							<div class="small text-muted">Taxable Investment Account  - Taxable</div>
						</div>
					</div>
				</div>
				<!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-md-8">
			<!-- Example Pie Chart Card-->
			<div class="card mb-3">
				<div class="card-header">
					<i class="fa fa-bar-chart"></i> Age Breakdown </div>
					<div class="card-body"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;" class="chartjs-size-monitor-expand"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;" class="chartjs-size-monitor-shrink"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
					<canvas height="215" width="430" id="myBarChart2" style="display: block; width: 294px; height: 294px;" class="chartjs-render-monitor"></canvas>
				</div>
			</div>	
		</div>

		<div class="col-lg-4 col-md-4">
			
			<!-- Example Pie Chart Card-->
			<div class="card mb-3">
				<div class="card-header">
					<i class="fa fa-pie-chart"></i> Asset Allocations </div>
					<div class="card-body"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;" class="chartjs-size-monitor-expand"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;" class="chartjs-size-monitor-shrink"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
					<canvas height="294" width="294" id="myPieChart3" style="display: block; width: 294px; height: 294px;margin: 18px 0;" class="chartjs-render-monitor"></canvas>
				</div>
				<!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
			</div>
		</div>
	</div>

	<div class="row">
		<!-- Area Chart Example-->
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header"><i class="fa fa-area-chart"></i> Peoples Has Viewed Your Profile</div>
				<div class="card-body">
					<canvas id="myAreaChart1" width="100%" height="30"></canvas>
				</div>
				<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
			</div>
		</div>
	</div>

	<?php } ?>

	<?php if (dcrf_get_current_user_data('roles') != 'administrator') { ?>
	<!-- Example DataTables Card-->
	<div class="card mb-3">
		<div class="card-header"><i class="fa fa-table"></i> User List</div>
		<div class="card-body">
			<div class="table-responsive">
				<div id="dataTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
					<div class="row">
						<div class="col-sm-12">
							<table width="100%" cellspacing="0" id="dataTable" class="table table-bordered dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
								<thead>
									<tr role="row">
										<th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 153px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Purpose</th>
										<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 239px;" aria-label="Position: activate to sort column ascending">Location</th>
										<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 110px;" aria-label="Office: activate to sort column ascending">Governing Regulatory Body</th>
										<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 50px;" aria-label="Age: activate to sort column ascending">Aum</th>
										<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 50px;" aria-label="Age: activate to sort column ascending">Inquiry</th>
									</tr>
								</thead>
								
								<tbody>
									<?php
									$interested_user_list = dcrf_current_user_meta('interested_advisor_list');
									if (!empty($interested_user_list) && is_array($interested_user_list)) {
										foreach ($interested_user_list as $key => $value) {
											$user_id 	= $value['user_id'];
											$data_type 	= ($value['data_type']) ? $value['data_type'] : '';
											?>
											<tr class="results_row">
												<td>
													<?php 
													if ($data_type == 'sell_my_book_of_business') {
														?><img src="<?php echo CHILD_THEME_URI; ?>/images/Seller.png" width="100px" alt="touch.png" class="img-responsive"><?php
													}
													if ($data_type == 'purchase_a_book_of_business') {
														?><img src="<?php echo CHILD_THEME_URI; ?>/images/Buyer.png" width="100px" alt="touch.png" class="img-responsive"><?php
													}
													if ($data_type == 'change_firm') {
														?><img src="<?php echo CHILD_THEME_URI; ?>/images/Transitioning.png" width="100px" alt="touch.png" class="img-responsive"><?php
													}
													?>
												</td>
												<td><strong><?php echo dcrf_current_user_meta('city',$user_id); ?> <br/> <?php echo dcrf_current_user_meta('postal_code',$user_id); ?></strong></td>
												<td><strong>
													<?php
													$grbody = dcrf_current_user_meta('governing_regulatory_body',$user_id);
													echo ($grbody == 'mfda_advisor') ? 'MFDA Advisor' : '';
													echo ($grbody == 'iiroc_advisor') ? 'IIROC Advisor' : '';
													?>
												</strong></td>
												<td><strong>
													<?php
													$aum =  dcrf_current_user_meta('aum',$user_id);
													if (empty($aum) || is_array($aum)) {

													}else{
														echo $aum;
													}
													?></strong></td>

												</tr>
												<?php
											}
										}
										?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
		</div>
		<?php } ?>

		<?php if (dcrf_get_current_user_data('roles') == 'administrator') { ?>
		<!-- Example DataTables Card-->
		<div class="card mb-3">
			<div class="card-header"><i class="fa fa-table"></i> Interested User List</div>
			<div class="card-body">
				<div class="table-responsive">
					<div id="dataTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
						<div class="row">
							<div class="col-sm-12">
								<table width="100%" cellspacing="0" id="dataTable" class="table table-bordered dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
									<thead>
										<tr role="row">
											<th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 153px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">For Advisor</th>
											<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 239px;" aria-label="Position: activate to sort column ascending">Interested User</th>
											<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 110px;" aria-label="Office: activate to sort column ascending">Date</th>
											<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 50px;" aria-label="Age: activate to sort column ascending">Status</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th rowspan="1" colspan="1">For Advisor</th>
											<th rowspan="1" colspan="1">Interested User</th>
											<th rowspan="1" colspan="1">Date</th>
											<th rowspan="1" colspan="1">Status</th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										$users = get_users(array( 'meta_key' => 'interested_user_list','orderby' => 'meta_value','order' => 'ASC'));
										if (!empty($users)) {
											$i=1;
											foreach ($users as $user) {
												$int_advisor_id = $user->ID;
												$interested_user_list = dcrf_current_user_meta('interested_user_list',$int_advisor_id);
												if ($interested_user_list && is_array($interested_user_list)) {
													foreach ($interested_user_list as $key => $user_list) {
														$int_user_id    = (isset($user_list['user_id'])) ? $user_list['user_id'] : '';
														$status         = (isset($user_list['status'])) ? $user_list['status'] : '';
														if ($status == 'unread') {
															$status = 'open';
														}
														$time           = (isset($user_list['time'])) ? $user_list['time'] : '';
														?>
														<tr role="row" class="odd">
															<td class="sorting_1"><?php echo $user->user_email; ?></td>
															<td><?php echo dcrf_get_current_user_data('',$int_user_id)->user_email; ?></td>
															<td><?php echo date("Y-m-d",$time); ?></td>
															<td><?php echo $status; ?></td>
														</tr>
														<?php
														$i++;
													}
												}
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
		</div>
		<?php
	}

} //end user dashboard

/**
* Interested User List
*/
add_shortcode('dcrf_dashboard_interested_user_list','dcrf_dashboard_interested_user_list_func');
function dcrf_dashboard_interested_user_list_func(){

	?>
	<div class="row">
		<?php
		$interested_user_list = dcrf_current_user_meta('interested_user_list');
		if ($interested_user_list && is_array($interested_user_list)) {
			$i = 0;
			foreach ($interested_user_list as $key => $user_list) {
				if ($i < 3) {
					$user_id 	= (isset($user_list['user_id'])) ? $user_list['user_id'] : '';
					$status 	= (isset($user_list['status'])) ? $user_list['status'] : '';
					$time 		= (isset($user_list['time'])) ? $user_list['time'] : '';
					?>
					<a class="dropdown-item" href="javascript:void(0);">
						<span class="text-success1"><strong>Someone is interested</strong></span>
						<span class="small float-right text-muted"><?php echo date("d-m-y h:i a",$time); ?></span>
						<div class="dropdown-message small">Admin will contact to you</div>
					</a>
					<div class="dropdown-divider"></div>
					<?php
				}else{

				}
				$i++;
			}
		}else{
			echo '<div class="dropdown-message small text-center">No Notification</div><div class="dropdown-divider"></div>';
		}
		?>
	</div>

	<?php
}