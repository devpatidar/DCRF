<?php
// Add jobs admin Menu
add_action( 'admin_menu', 'ejobb_my_admin_menu' );
function ejobb_my_admin_menu() {
    global $submenu;
    
    add_menu_page( 'Interested Users', 'Interested Users', 'manage_options', 'dcrf_interested_users', 'dcrf_interested_users_func', 'dashicons-dashboard' );
    //add_submenu_page( 'ejobb_jobs_statistics', 'Visits Jobs', 'Visits Jobs','manage_options', 'ejobb_dash_visit_jobs','ejobb_dash_statistics');
}

/** 
* All Jobs List
*/
function dcrf_interested_users_func(){
    ?>
    <div class="wrap">
        <?php _e('<h1>All Interested Users List</h1>','dcrf'); ?>
        <!-- Filter and export button -->
        <!-- <div class="tablenav top">
            <div class="alignleft actions">
                <?php $results = '';//ejobb_wp_get_archives(array('post_type'=>'job_posting','type'=>'monthly')); ?>
                <form name="cus_sorting_month" method="post" action="">
                    <select name="all_job_month_filter_val" id="filter-by-date">
                        <option selected="selected" value="0">All dates</option>
                       
                    </select>
                    <input name="all_job_month_filter_btn" class="button button-primary" value="Filter" type="submit">
                </form>
            </div>
            
            <div class="alignright actions"><button class="dash_all_month_jobs_list_btn button button-primary">Export Data</button></div>
        </div> -->
        <!-- Clicked Jobs table data -->
        <?php /*<div class="all_visits_jobs">
            <table class="dash_all_month_jobs_list wp-list-table widefat fixed striped comments ejobb_custom_list">
                <thead>
                    <tr>
                        <th scope="col" class="manage-column column-primary">S No</th>
                        <th scope="col" class="manage-column column-primary">For Advisor</th>
                        <th scope="col" class="manage-column column-primary">Interested User</th>
                        <th scope="col" class="manage-column column-primary">Date</th>
                        <th scope="col" class="manage-column column-primary">Status</th>
                    </tr>
                </thead>

                <tbody id="the-comment-list" class="ejobb_custom_list_tbody" data-wp-lists="list:comment">

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
                                    
                                    echo '<tr class="jobs-items">';
                                    echo '<td class="colspanchange">'.$i.'</td>';
                                    echo '<td class="colspanchange"><a href="'.admin_url('user-edit.php?user_id='.$user->ID).'">'.$user->user_email.'</a></td>';
                                    echo '<td class="colspanchange"><a href="'.admin_url('user-edit.php?user_id='.$int_user_id).'">'.dcrf_get_current_user_data('',$int_user_id)->user_email.'</a></td>';
                                    echo '<td class="colspanchange">'.date("Y-m-d",$time).'</td>';
                                    echo '<td class="colspanchange">'.$status.'</td>';
                                    echo '</tr>';
                                    $i++;
                                }
                            }
                        }//-> User Foreach
                    }else{
                        echo '<tr class="jobs-items"><td class="colspanchange" colspan="5">No Jobs found.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
            <!-- Pagination Section -->
            <div class="visitor_jobs_list_pagination">
            </div>
            
        </div>*/ ?>
    </div>



    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">

    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>For Advisor</th>
                <th>Interested User</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>For Advisor</th>
                <th>Interested User</th>
                <th>Date</th>
                <th>Status</th>
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
                            <tr>
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

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#example').DataTable();
        } );
    </script>
    <?php
}
