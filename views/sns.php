<div class="wrap">
	<h2>Welcome To <?php echo esc_attr( $title ); ?></h2>
	<div class="">
		<form method="get" id="aws_sns_form" enctype="multipart/form-data">
			<label>SNS Topic ARN :</label><br />
			<input
				type="text"
				name="aws_sns_topic_arn"
				value="<?php echo esc_attr( get_option(
					'aws_sns_topic_arn',
					AWS_SNS_TOPIC_ARN
				) ); ?>"
				style="width: 400px;"
				class="aws-sns-topic-input"
			/><br />

			<?php wp_nonce_field( 'aws_sns_submit' ); ?>
			<input type="hidden" name="nonce_key" value="aws_sns_submit" />
			<?php submit_button( 'Submit', 'primary', 'aws_sns_submit' ); ?>
		</form>
	</div>
</div>
