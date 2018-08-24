<div class="wrap">
	<h2>Welcome To <?php echo esc_attr( $title ); ?></h2>
	<div class="">
		<form method="get" id="aws_cloud_watch_form" enctype="multipart/form-data">
			<label>Aws Cloud Watch Group :</label><br/>
			<input type="text" name="aws_cloud_watch_group"
				value="<?php echo esc_attr( get_option(
					'aws_cloud_watch_group',
					AWS_CLOUD_WATCH_GROUP_NAME
				) ); ?>"/><br/>
			<?php wp_nonce_field( 'aws_cloud_watch_submit' ); ?>
			<input type="hidden" name="nonce_key" value="aws_cloud_watch_submit"/>
			<?php submit_button( 'Submit', 'primary', 'aws_cloud_watch_submit' ); ?>
		</form>
	</div>
</div>