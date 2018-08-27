<div class="wrap">
	<h2>Welcome To <?php echo esc_attr( $title ); ?></h2>
	<div class="">
		<form method="get" id="aws_cloud_watch_form" enctype="multipart/form-data">
			<label>Aws Cloud Watch Group :</label><br />
			<input
				type="text" name="aws_cloud_watch_group"
				value="<?php echo esc_attr( get_option(
					'aws_cloud_watch_group',
					AWS_CLOUD_WATCH_GROUP_NAME
				) ); ?>" /><br />

			<label>Aws Cloud Watch Stream Recursive :</label><br />
			<?php
				$recursive = get_option(
					'aws_cloud_watch_stream_recursive',
					AWS_CLOUD_WATCH_STREAM_RECURSIVE
				);
			?>
			<select name="aws_cloud_watch_stream_recursive">
				<option <?php if ( 'yes' === esc_attr( $recursive ) ) {
					echo 'selected';
				}
				?> value="yes">Yes
				</option>
				<option <?php if ( 'no' === esc_attr( $recursive ) ) {
					echo 'selected';
				} ?> value="no">No
				</option>
			</select><br />
			<label>Aws Cloud Watch Stream :</label><br />
			<input
				type="text" name="aws_log_stream_name"
				value="<?php echo esc_attr( get_option(
					'aws_log_stream_name',
					AWS_CLOUD_WATCH_STREAM_NAME
				) ); ?>" /><br />
			<?php wp_nonce_field( 'aws_cloud_watch_submit' ); ?>
			<input type="hidden" name="nonce_key" value="aws_cloud_watch_submit" />
			<?php submit_button( 'Submit', 'primary', 'aws_cloud_watch_submit' ); ?>
		</form>
	</div>
</div>