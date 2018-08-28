<?php

/**
 * Create Aws Cloud Watch Admin in WordPress.
 *
 * Class AWS_Cloud_Watch_Admin
 */
class AWS_Cloud_Watch_Admin {

	/**
	 * Parent Page Title.
	 *
	 * @var string
	 */
	public $menu_title = 'AWS';

	/**
	 * Parent Page Title.
	 *
	 * @var string
	 */
	public $parent_title = 'Aws Settings';

	/**
	 * Parent Page Slug.
	 *
	 * @var string
	 */
	public $parent_page = 'aws';

	/**
	 * Child Page Slug.
	 *
	 * @var string
	 */
	public $child_slug = 'aws-cloud-watch-settings';

	/**
	 * Child Page Title.
	 *
	 * @var string
	 */
	public $child_menu_title = 'Cloud Watch';

	/**
	 * Child Page Title.
	 *
	 * @var string
	 */
	public $child_title = 'Aws Cloud Watch Settings';

	/**
	 * Manage Page permissions.
	 *
	 * @var string
	 */
	public $page_permission = 'manage_options';

	/**
	 * Encryption Method
	 */
	public $enc_method = 'AES-256-CBC';

	/**
	 * AWS_Cloud_Watch_Admin constructor.
	 */
	public function __construct() {
		$this->parent_page      = apply_filters( 'aws_parent_page_slug', $this->parent_page );
		$this->parent_title     = apply_filters( 'aws_parent_page_title', $this->parent_title );
		$this->child_slug       = apply_filters( 'aws_child_page_slug', $this->child_slug );
		$this->child_title      = apply_filters( 'aws_child_page_title', $this->child_title );
		$this->child_menu_title = apply_filters( 'aws_child_menu_title', $this->child_menu_title );
		$this->page_permission  = apply_filters( 'aws_page_permission', $this->page_permission );

		add_action( 'admin_menu', [ $this, 'create_admin_interface' ], 10 );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_script' ] );
		add_action( 'wp_ajax_nopriv_aws_credentials', [ $this, 'aws_ajax_request' ], 11 );
		add_action( 'wp_ajax_aws_credentials', [ $this, 'aws_ajax_request' ], 11 );
		add_action( 'wp_ajax_nopriv_aws_cloud_watch_region', [ $this, 'aws_ajax_request' ], 11 );
		add_action( 'wp_ajax_aws_cloud_watch_region', [ $this, 'aws_ajax_request' ], 11 );
	}

	/**
	 * Check id a Page hook exists to create Top level page for cloud watch.
	 */
	public function create_admin_interface() {
		if ( empty( $GLOBALS['admin_page_hooks'][ $this->parent_page ] ) ) {
			$this->create_main_page();
			$this->create_sub_page();
		} else {
			$this->create_sub_page();
		}
	}

	/**
	 * Create Sub Menu Page.
	 */
	public function create_sub_page() {
		add_submenu_page(
			$this->parent_page,
			$this->child_title,
			$this->child_menu_title,
			'manage_options',
			$this->child_slug,
			[ $this, 'cloudwatch_page' ]
		);
	}

	/**
	 * Create Main menu ( Top level ).
	 */
	public function create_main_page() {
		add_menu_page(
			$this->parent_title,
			$this->menu_title,
			'manage_options',
			$this->parent_page,
			[ $this, 'menu_page' ],
			AWS_PLUGIN_DIR_URL . 'assets/img/icon.png',
			100
		);
	}

	/**
	 * Admin Main page.
	 */
	public function menu_page() {
		global $title;

		echo '<div class="wrap">';
		$file = AWS_PLUGIN_BASE_DIR . '/views/admin_page.php';

		if ( file_exists( $file ) ) {
			require $file;
		}

		echo '</div>';
	}

	/**
	 * Admin Cloud watch page.
	 */
	public function cloudwatch_page() {
		global $title;

		echo '<div class="wrap">';
		$file = AWS_PLUGIN_BASE_DIR . '/views/cloudwatch.php';

		if ( file_exists( $file ) ) {
			require $file;
		}

		echo '</div>';
	}

	/**
	 * List of Aws Regions.
	 *
	 * @return array
	 */
	public function get_regions_list() {
		$regions = array(
			'us-east-1'      => 'US Standard',
			'us-west-1'      => 'Northern California',
			'us-west-2'      => 'Oregon',
			'ca-central-1'   => 'Montreal',
			'eu-west-1'      => 'Ireland',
			'eu-west-2'      => 'London',
			'eu-central-1'   => 'Frankfurt',
			'ap-southeast-1' => 'Singapore',
			'ap-southeast-2' => 'Sydney',
			'ap-northeast-1' => 'Tokyo',
			'ap-northeast-2' => 'Seoul',
			'ap-south-1'     => 'Mumbai',
			'sa-east-1'      => 'Sao Paulo',
		);

		return apply_filters( 'aws_get_regions', $regions );
	}

	/**
	 * Check credentials.
	 *
	 * @return bool
	 */
	public function is_credentials_set() {
		$aws_region = apply_filters( 'aws_set_region', get_option( 'aws_region', '' ) );
		$aws_key    = apply_filters( 'aws_set_key', get_option( 'aws_key', '' ) );
		$aws_secret = apply_filters( 'aws_set_secret', get_option( 'aws_secret', '' ) );

		if ( $aws_region && $aws_key && $aws_secret ) {
			return true;
		}

		return false;
	}

	/**
	 * Enqueue Scripts.
	 */
	public function enqueue_script( $hook ) {
		if ( ( 'toplevel_page_' . $this->parent_page === $hook ) || ( strtolower( str_replace( ' ', '-',
					$this->menu_title ) ) . '_page_' . $this->child_slug === $hook )
		) {
			$version = date( 'ymdGis' );
			wp_register_script( 'aws-main-js', AWS_PLUGIN_DIR_URL . 'assets/js/main.js', [ 'jquery' ], $version, true );
			wp_localize_script( 'aws-main-js', 'aws_localize_ajax', [ 'ajax_url' => admin_url( 'admin-ajax.php' ) ] );
			wp_enqueue_script( 'aws-main-js' );
		}
	}

	/**
	 * Ajax Request.
	 */
	public function aws_ajax_request() {
		if ( ! wp_verify_nonce( $_REQUEST['data']['_wpnonce'], $_REQUEST['data']['nonce_key'] ) ) {
			exit( 'No naughty business please' );
		}

		$key = $_REQUEST['data']['nonce_key'];

		unset( $_REQUEST['data']['nonce_key'] );
		unset( $_REQUEST['data']['_wpnonce'] );
		unset( $_REQUEST['data']['_wp_http_referer'] );

		/**
		 * Encrypt Crediantials
		 */
		if ( ! empty( $_REQUEST['data'] ) && 'aws_credentials_submit' === $key ) {
			foreach ( $_REQUEST['data'] as $key => $value ) {
				if ( 'aws_cloud_watch_group' === $key && ! empty( $value ) && get_option( $key ) !== $value ) {
					aws_create_loggroup( $value );
				}
				update_option( $key, $this->encrypt( $value ) );
			}
		} elseif ( ! empty( $_REQUEST['data'] ) && 'aws_cloud_watch_submit' === $key ) {
			foreach ( $_REQUEST['data'] as $key => $value ) {
				if ( 'aws_cloud_watch_group' === $key && ! empty( $value ) && get_option( $key ) !== $value ) {
					aws_create_loggroup( $value );
				}

				$recursive = apply_filters( 'aws_cloud_watch_stream_recursive', get_option( 'aws_cloud_watch_stream_recursive', AWS_CLOUD_WATCH_STREAM_RECURSIVE ) );

				if ( 'no' === $recursive && 'aws_log_stream_name' === $key && ! empty( $value ) && get_option( $key ) !== $value ) {
					aws_create_stream( $value );
					aws_add_log_to_cloud_watch( 'New stream Created', 'New' );
				}

				update_option( $key, $value );
			}
		} else {
			echo false;
		}
		die();
	}

	/**
	 * Encrypt the data.
	 *
	 * @param $input_string
	 *
	 * @return string
	 */
	public function encrypt( $input_string ) {

		if ( empty( $input_string ) ) {
			return;
		}

		$iv_size        = openssl_cipher_iv_length( $this->enc_method );
		$iv             = openssl_random_pseudo_bytes( $iv_size );
		$encrypted_data = openssl_encrypt( $input_string, $this->enc_method, AUTH_KEY, 0, $iv );

		return base64_encode( $iv . $encrypted_data );
	}

	/**
	 * Decrypt the data.
	 *
	 * @param $encrypted_input_string
	 *
	 * @return string
	 */
	public function decrypt( $encrypted_input_string ) {
		if ( empty( $encrypted_input_string ) ) {
			return;
		}

		$c              = base64_decode( $encrypted_input_string );
		$ivlen          = openssl_cipher_iv_length( $this->enc_method );
		$iv             = substr( $c, 0, $ivlen );
		$encrypted_data = substr( $c, $ivlen );

		return openssl_decrypt( $encrypted_data, $this->enc_method, AUTH_KEY, 0, $iv );
	}
}

new AWS_Cloud_Watch_Admin();
