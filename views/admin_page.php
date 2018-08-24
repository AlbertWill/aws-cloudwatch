<div class="wrap">
	<h2>Welcome To <?php echo esc_attr( $title ); ?></h2>
	<?php
	$credential = filter_input( INPUT_GET, 'credential', FILTER_SANITIZE_STRING );

	if ( $this->is_credentials_set() && ( 'reset' !== $credential || empty( $credential ) ) ) {
		echo '<p class="description"> Credential`s is encrypted and cannot be visibale.</p>';
		echo '<p class="description"> To Change Credential`s please click Reset <a href="?page=' . esc_attr( $this->parent_page ) . '&credential=reset">here</a>  </p>';

		return '';
	}
	?>
	<p class="description"> The Below data will be encrypted when adding into database, Due to security reasons.</p>
	<p class="description"> Once submitted, values below input is totally encrypted, so please store values in safe
		location.</p>
	<div class="">
		<form method="get" id="aws_credentials_form" enctype="multipart/form-data">
			<label>Select Region :</label><br/>
			<select name="aws_region">
				<option value=""> Select Region</option>
				<?php
				if ( ! empty( $this->get_regions_list() ) ) {
					foreach ( $this->get_regions_list() as $key => $value ) {
						?>
						<option value="<?php echo esc_html( $key ); ?>"> <?php echo esc_html( $value ); ?></option>
						<?php
					}
				}
				?>
			</select><br/>
			<label>Aws Key :</label><br/>
			<input type="text" name="aws_key" value=""/><br/>
			<label>Aws Secret :</label><br/>
			<input type="text" name="aws_secret" value=""/><br/>
			<?php wp_nonce_field( 'aws_credentials_submit' ); ?>
			<input type="hidden" name="nonce_key" value="aws_credentials_submit" />
			<?php submit_button( 'Submit', 'primary', 'aws_credentials_submit' ); ?>
		</form>
	</div>
</div>