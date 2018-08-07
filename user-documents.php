<?php
add_shortcode('dcrf_user_documents','dcrf_user_documents_func');
function dcrf_user_documents_func(){

	// Check that the nonce is valid, and the user can edit this post.
	$current_user_data  = dcrf_get_current_user_data();
	$crrnt_user_id = $current_user_data->ID;

	/**================================================================
	 * Upload NRD Files
	==================================================================*/

	if ( 
		isset( $_POST['upload_nrd_file_nonce'], $crrnt_user_id ) 
		&& wp_verify_nonce( $_POST['upload_nrd_file_nonce'], 'upload_nrd_file' )
	) {
		// The nonce was valid and the user has the capabilities, it is safe to continue.
		// These files need to be included as dependencies when on the front end.
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );

		// Let WordPress handle the upload.
		// Remember, 'my_image_upload' is the name of our file input in our form above.
		$attachment_id  = media_handle_upload( 'upload_nrd_file', $crrnt_user_id );
		if ( is_wp_error( $attachment_id ) ) {
			dcrf_add_wp_errors('doc_nrd_file_upload_failed','<div class="alert alert-danger col-md-12" role="alert"> Error in Upload File </div>');
		} else {
			// Save Upload File
			$uploaded_file = dcrf_current_user_meta('upload_nrd_file');
			$save_attachment_id = '';
			if (!empty($uploaded_file) && is_array($uploaded_file)) {
				$save_attachment_id = $uploaded_file;
				$save_attachment_id[] = $attachment_id;
			}else{
				$save_attachment_id[] = $attachment_id;
			}
			update_user_meta( $crrnt_user_id, 'upload_nrd_file', $save_attachment_id );
			dcrf_add_wp_errors('doc_nrd_file_upload_sucss','<div class="alert alert-success col-md-12" role="alert"> NRD File Uploaded </div>');

			clean_object_term_cache( $crrnt_user_id, 'upload_nrd_file' );
		}
	} else {
		//echo 'Check Nonce Data';
	}
	?>
	<div class="col-md-12 mb-4">
		<?php echo dcrf_get_error_messages('doc_nrd_file_upload_failed'); ?>
		<?php echo dcrf_get_error_messages('doc_nrd_file_upload_sucss'); ?>
		<div class="dcrf_user_profile_pic">
			<h5 class="pic_title"> NRD file </h5>
			
			<!-- Upload NRD Files -->
			<div class="dcrf_upload_nrd_files">
				<h6 class="mt-2">NRD file</h6>
				<label class="custom-file">
					<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
						<input type="file" class="file" name="upload_nrd_file" id="profile_picture"  multiple="false" />
						<?php wp_nonce_field( 'upload_nrd_file', 'upload_nrd_file_nonce' ); ?>

						<div class="input-group col-xs-12">
							<input type="text" class="form-control input-lg" disabled="" placeholder="Upload File">
							<span class="input-group-btn">
								<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
							</span>
						</div>
						<div class="col-xs-12">
							<input id="submit_my_image_upload" class="btn btn-primary mb-4 mt-3" name="upload_nrd_file_btn" type="submit" value="Upload" />
						</div>
					</form>
				</label>
			</div>

			<!-- NRD File listings -->
			<?php
			$NRD_files = dcrf_current_user_meta('upload_nrd_file');
			if (!empty($NRD_files) && is_array($NRD_files)) :
				?>	
				<div class="dcrf_nrd_file_lists mt-4">
					<table class="table table-striped">
						<thead><tr><th>#</th><th>File Name</th><th>Download / View</th><th>Action</th></tr></thead>
						<tbody>
							<?php
							$i = 1;
							foreach ($NRD_files as $key => $file_ID) {
								$file_name = basename ( get_attached_file( $file_ID ) );
								$file_url = wp_get_attachment_url($file_ID);
								?>
								<tr class="<?php echo base64_encode($file_ID); ?>">
									<th scope="row"><?php echo $i; ?></th>
									<td><?php echo $file_name; ?></td>
									<td><a href="<?php echo esc_url($file_url); ?>" target="_blank">Download / View</a> </td>
									<td><a href="javascript:void(0)" data-id="<?php echo base64_encode($file_ID); ?>" data-meta="upload_nrd_file" class="dcrf_delete_uploaded_file">Delete</a></td>
								</tr>
								<?php
								$i++;
							}
							?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php

	/**================================================================
	 * Upload Uniform Termination Notice Files
	==================================================================*/
	if (dcrf_get_current_user_data('roles') == 'ab_firm') {
		$title = 'Current Monthly Financial Report';
	}else{
		$title = 'Uniform Termination Notice';
	}
	if ( 
		isset( $_POST['upload_utn_file_nonce'], $crrnt_user_id ) 
		&& wp_verify_nonce( $_POST['upload_utn_file_nonce'], 'upload_utn_file' )
	) {
		// The nonce was valid and the user has the capabilities, it is safe to continue.
		// These files need to be included as dependencies when on the front end.
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );

		// Let WordPress handle the upload.
		// Remember, 'my_image_upload' is the name of our file input in our form above.
		$attachment_id  = media_handle_upload( 'upload_utn_file', $crrnt_user_id );
		if ( is_wp_error( $attachment_id ) ) {
			dcrf_add_wp_errors('doc_utn_file_upload_failed','<div class="alert alert-danger col-md-12" role="alert"> Error in Upload File </div>');
		} else {
			// Save Upload File
			$uploaded_file = dcrf_current_user_meta('upload_utn_file');
			$save_attachment_id = '';
			if (!empty($uploaded_file) && is_array($uploaded_file)) {
				$save_attachment_id = $uploaded_file;
				$save_attachment_id[] = $attachment_id;
			}else{
				$save_attachment_id[] = $attachment_id;
			}
			update_user_meta( $crrnt_user_id, 'upload_utn_file', $save_attachment_id );
			dcrf_add_wp_errors('doc_nrd_file_upload_sucss','<div class="alert alert-success col-md-12" role="alert"> '.$title.' Uploaded </div>');
		}
	} else {
			//echo 'Check Nonce Data';
	}
	?>
	<div class="col-md-12 mb-4 mt-4">
		<?php echo dcrf_get_error_messages('doc_utn_file_upload_failed'); ?>
		<?php echo dcrf_get_error_messages('doc_utn_file_upload_sucss'); ?>
		<div class="dcrf_user_profile_pic">
		
			<h5 class="pic_title"><?php echo $title; ?></h5>
			
			<!-- Upload NRD Files -->
			<div class="dcrf_upload_utn_files">
				<h6 class="mt-2">Upload <?php echo $title; ?></h6>
				<label class="custom-file">
					<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
						<input type="file" class="file" name="upload_utn_file" id="profile_picture"  multiple="false" />
						<?php wp_nonce_field( 'upload_utn_file', 'upload_utn_file_nonce' ); ?>

						<div class="input-group col-xs-12">
							<input type="text" class="form-control input-lg" disabled="" placeholder="Upload File">
							<span class="input-group-btn">
								<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
							</span>
						</div>
						<div class="col-xs-12">
							<input id="submit_my_image_upload" class="btn btn-primary mb-4 mt-3" name="upload_utn_file_btn" type="submit" value="Upload" />
						</div>
					</form>
				</label>
			</div>

			<!-- NRD File listings -->
			<?php
			$utn_files = dcrf_current_user_meta('upload_utn_file');
			if (!empty($utn_files) && is_array($utn_files)) :
				?>	
				<div class="dcrf_nrd_file_lists mt-4">
					<table class="table table-striped">
						<thead><tr><th>#</th><th>File Name</th><th>Download / View</th><th>Action</th></tr></thead>
						<tbody>
							<?php
							$i = 1;
							foreach ($utn_files as $key => $file_ID) {
								$file_name = basename ( get_attached_file( $file_ID ) );
								$file_url = wp_get_attachment_url($file_ID);
								?>
								<tr class="<?php echo base64_encode($file_ID); ?>">
									<th scope="row"><?php echo $i; ?></th>
									<td><?php echo $file_name; ?></td>
									<td><a href="<?php echo esc_url($file_url); ?>" target="_blank">Download / View</a> </td>
									<td><a href="javascript:void(0)" data-id="<?php echo base64_encode($file_ID); ?>" data-meta="upload_utn_file" class="dcrf_delete_uploaded_file">Delete</a></td>
								</tr>
								<?php
								$i++;
							}
							?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php

	/**================================================================
	 * Upload Resume
	==================================================================*/
	if (dcrf_get_current_user_data('roles') == 'ab_firm') {
		$resume_title = 'Recent Monthly Financial Report';
	}else{
		$resume_title = 'Resume';
	}

	if ( 
		isset( $_POST['upload_resume_file_nonce'], $crrnt_user_id ) 
		&& wp_verify_nonce( $_POST['upload_resume_file_nonce'], 'upload_resume_file' )
	) {
		// The nonce was valid and the user has the capabilities, it is safe to continue.
		// These files need to be included as dependencies when on the front end.
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );

		// Let WordPress handle the upload.
		// Remember, 'my_image_upload' is the name of our file input in our form above.
		$attachment_id  = media_handle_upload( 'upload_resume_file', $crrnt_user_id );
		if ( is_wp_error( $attachment_id ) ) {
			dcrf_add_wp_errors('doc_resume_file_upload_failed','<div class="alert alert-danger col-md-12" role="alert"> Error in Upload File </div>');
		} else {
			// Save Upload File
			$uploaded_file = dcrf_current_user_meta('upload_resume_file');
			$save_attachment_id = '';
			if (!empty($uploaded_file) && is_array($uploaded_file)) {
				$save_attachment_id = $uploaded_file;
				$save_attachment_id[] = $attachment_id;
			}else{
				$save_attachment_id[] = $attachment_id;
			}
			update_user_meta( $crrnt_user_id, 'upload_resume_file', $save_attachment_id );
			dcrf_add_wp_errors('doc_resume_file_upload_sucss','<div class="alert alert-success col-md-12" role="alert"> '.$resume_title.' Uploaded </div>');
		}
	} else {
			//echo 'Check Nonce Data';
	}
	?>
	<div class="col-md-12 mb-4 mt-4">
		<?php echo dcrf_get_error_messages('doc_resume_file_upload_failed'); ?>
		<?php echo dcrf_get_error_messages('doc_resume_file_upload_sucss'); ?>
		<div class="dcrf_user_profile_pic">
			
			<h5 class="pic_title"><?php echo $resume_title; ?></h5>
			
			<!-- Upload NRD Files -->
			<div class="dcrf_upload_resume_files">
				<h6 class="mt-2">Upload <?php echo $resume_title; ?></h6>
				<label class="custom-file">
					<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
						<input type="file" class="file" name="upload_resume_file" id="profile_picture"  multiple="false" />
						<?php wp_nonce_field( 'upload_resume_file', 'upload_resume_file_nonce' ); ?>

						<div class="input-group col-xs-12">
							<input type="text" class="form-control input-lg" disabled="" placeholder="Upload File">
							<span class="input-group-btn">
								<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
							</span>
						</div>
						<div class="col-xs-12">
							<input id="submit_my_image_upload" class="btn btn-primary mb-4 mt-3" name="upload_resume_file_btn" type="submit" value="Upload" />
						</div>
					</form>
				</label>
			</div>

			<!-- NRD File listings -->
			<?php
			$resume_files = dcrf_current_user_meta('upload_resume_file');
			if (!empty($resume_files) && is_array($resume_files)) :
				?>	
				<div class="dcrf_nrd_file_lists mt-4">
					<table class="table table-striped">
						<thead><tr><th>#</th><th>File Name</th><th>Download / View</th><th>Action</th></tr></thead>
						<tbody>
							<?php
							$i = 1;
							foreach ($resume_files as $key => $file_ID) {
								$file_name = basename ( get_attached_file( $file_ID ) );
								$file_url = wp_get_attachment_url($file_ID);
								?>
								<tr class="<?php echo base64_encode($file_ID); ?>">
									<th scope="row"><?php echo $i; ?></th>
									<td><?php echo $file_name; ?></td>
									<td><a href="<?php echo esc_url($file_url); ?>" target="_blank">Download / View</a> </td>
									<td><a href="javascript:void(0)" data-id="<?php echo base64_encode($file_ID); ?>" data-meta="upload_resume_file" class="dcrf_delete_uploaded_file">Delete</a></td>
								</tr>
								<?php
								$i++;
							}
							?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php

} //-> dcrf_user_documents_func