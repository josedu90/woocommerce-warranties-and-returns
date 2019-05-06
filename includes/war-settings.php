<?php

	class WC_War_Settings {

		public static function init() {
			add_filter( 'svx_plugins_settings', __CLASS__ . '::get_settings', 50 );
		}

		public static function get_settings( $plugins ) {

			$presets = get_terms( 'wcwar_warranty_pre', array('hide_empty' => false) );

			$ready_presets = array(
				'' => esc_html__( 'None', 'woocommerce-warranties-and-returns' )
			);

			foreach ( $presets as $preset ) {
				$ready_presets[$preset->term_id] = $preset->name;
			}

			$pages = get_pages();

			$ready_pages = array(
				'' => esc_html__( 'None', 'woocommerce-warranties-and-returns' )
			);

			foreach ( $pages as $page ) {
				$ready_pages[$page->ID] = $page->post_title;
			}

			$plugins['warranties_and_returns'] = array(
				'slug' => 'warranties_and_returns',

				'name' => function_exists( 'XforWC' ) ? esc_html__( 'Warranties and Returns', 'woocommerce-warranties-and-returns' ) : esc_html__( 'Warranties and Returns for WooCommerce', 'woocommerce-warranties-and-returns' ),
				'desc' => function_exists( 'XforWC' ) ? esc_html__( 'Warranties and Returns for WooCommerce', 'woocommerce-warranties-and-returns' ) . ' v' . WC_Warranties_And_Returns::$version : esc_html__( 'Settings page for Warranties and Returns for WooCommerce!', 'woocommerce-warranties-and-returns' ),
				'link' => 'https://xforwoocommerce.com/store/warranties-and-returns/',
				'ref' => array(
					'name' => esc_html__( 'Visit XforWooCommerce.com', 'woocommerce-warranties-and-returns' ),
					'url' => 'https://xforwoocommerce.com',
				),
				'doc' => array(
					'name' => esc_html__( 'Get help', 'woocommerce-warranties-and-returns' ),
					'url' => 'https://help.xforwoocommerce.com',
				),
				'sections' => array(
					'dashboard' => array(
						'name' => esc_html__( 'Dashboard', 'woocommerce-warranties-and-returns' ),
						'desc' => esc_html__( 'Dashboard Overview', 'woocommerce-warranties-and-returns' ),
					),
					'warranties' => array(
						'name' => esc_html__( 'Warranties', 'woocommerce-warranties-and-returns' ),
						'desc' => esc_html__( 'Warranties Options', 'woocommerce-warranties-and-returns' ),
					),
					'returns' => array(
						'name' => esc_html__( 'Returns', 'woocommerce-warranties-and-returns' ),
						'desc' => esc_html__( 'Returns Options', 'woocommerce-warranties-and-returns' ),
					),
					'email' => array(
						'name' => esc_html__( 'E-Mail', 'woocommerce-warranties-and-returns' ),
						'desc' => esc_html__( 'E-Mail Options', 'woocommerce-warranties-and-returns' ),
					),
					'installation' => array(
						'name' => esc_html__( 'Installation', 'woocommerce-warranties-and-returns' ),
						'desc' => esc_html__( 'Installation Options', 'woocommerce-warranties-and-returns' ),
					),
				),
				'settings' => array(

					'wcmn_dashboard' => array(
						'type' => 'html',
						'id' => 'wcmn_dashboard',
						'desc' => '
						<img src="' . WC_Warranties_And_Returns::$url_path . 'assets/images/warranties-and-returns-for-woocommerce-shop.png" class="svx-dashboard-image" />
						<h3 style="margin-top: 0;"><span class="dashicons dashicons-store"></span> Get plugins and themes</h3><p>Like what you see? Improve your shop even more! Use our standardized items in your Shop today and earn more. Get <a href="https://www.mihajlovicnenad.com" target="_blank">Mihajlovicnenad.com</a> plugins and themes <a href="https://www.mihajlovicnenad.com/shop/" target="_blank">here</a>.</p>
						<h3><span class="dashicons dashicons-welcome-learn-more"></span> Knowledge Base</h3><p>Find everything about <a href="https://www.mihajlovicnenad.com" target="_blank">Mihajlovicnenad.com</a> plugins and themes in our <a href="https://www.mihajlovicnenad.com/knowledge-base/" target="_blank">Knowledge Base</a>. In-depth documentation for the items, including dozens of guide videos and plugin information.</p>
						<h3><span class="dashicons dashicons-admin-tools"></span> Support</h3><p>Need support? Please use one of the support channels provided <a href="https://www.mihajlovicnenad.com/support/" target="_blank">here</a>. If you have valid support, use the Premium Support and click the Connect with Envato. Open a ticket and an agent will reply asap. Further, use the Community Forums to get help from the community.</p>
						<h3><span class="dashicons dashicons-update"></span> Automatic Updates</h3><p>To get automatic updates use the Envato Market plugin! Install this simple plugin, and you will be noted about the new updates right in your WordPress Dashboard! Get Envato Market plugin <a href="https://envato.com/market-plugin/" target="_blank">here</a>.</p>',
						'section' => 'dashboard',
					),

					'wcmn_utility' => array(
						'name' => esc_html__( 'Plugin Options', 'woocommerce-warranties-and-returns' ),
						'type' => 'utility',
						'id' => 'wcmn_utility',
						'desc' => esc_html__( 'Quick export/import, backup and restore, or just reset your optons here', 'woocommerce-warranties-and-returns' ),
						'section' => 'dashboard',
					),

					'war_settings_page' => array(
						'name'    => esc_html__( 'Request Page', 'woocommerce-warranties-and-returns' ),
						'type'    => 'select',
						'desc'    => esc_html__( 'Please select the page for requesting warranties. Check Documentation FAQ if the page was not created automatically.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'war_settings_page',
						'options' => $ready_pages,
						'default' => '',
						'autoload' => true,
						'section' => 'installation'
					),
					'wcwar_single_action' => array(
						'name'    => esc_html__( 'Init Action', 'woocommerce-warranties-and-returns' ),
						'type'    => 'text',
						'desc'    => esc_html__( 'Change default plugin initialization action on single product pages. Use actions done in your content-single-product.php file. Please enter action in the following format action_name:priority.', 'woocommerce-warranties-and-returns' ) . ' ( default: woocommerce_before_add_to_cart_form )',
						'id'      => 'wcwar_single_action',
						'default' => '',
						'autoload' => true,
						'section' => 'installation'
					),
					'wcwar_force_scripts' => array(
						'name' => esc_html__( 'Plugin Scripts', 'woocommerce-warranties-and-returns' ),
						'type' => 'checkbox',
						'desc' => esc_html__( 'Check this option to enable plugin scripts in all pages. This option fixes issues in Quick Views.', 'woocommerce-warranties-and-returns' ),
						'id'   => 'wcwar_force_scripts',
						'default' => 'no',
						'autoload' => true,
						'section' => 'installation'
					),
					'wcwar_single_mode' => array(
						'name'    => esc_html__( 'Customer Request Display Mode', 'woocommerce-warranties-and-returns' ),
						'type'    => 'select',
						'desc'    => esc_html__( 'Select display mode for the Single Warranty/Return Customer Post.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_single_mode',
						'default' => 'new',
						'options' => array(
							'old' => 'Old - WooThemes, Basic Themes',
							'new' => 'New - Most Supported in Premium Themes'
						),
						'autoload' => true,
						'section' => 'installation'
					),
					'wcwar_single_titles' => array(
						'name'    => esc_html__( 'Heading Size', 'woocommerce-warranties-and-returns' ),
						'type'    => 'select',
						'desc'    => esc_html__( 'Select heading size of warranty titles on single product pages.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_single_titles',
						'default' => 'h4',
						'options' => array(
							'h2' => 'H2',
							'h3' => 'H3',
							'h4' => 'H4',
							'h5' => 'H5',
							'h6' => 'H6'
						),
						'autoload' => false,
						'section' => 'installation'
					),


					'wcwar_default_warranty' => array(
						'name'    => esc_html__( 'Default Warranty', 'woocommerce-warranties-and-returns' ),
						'type'    => 'select',
						'desc'    => esc_html__( 'Products without warranties can have a default warranty. Please select warranty preset.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_default_warranty',
						'default' => '',
						'options' => $ready_presets,
						'autoload' => false,
						'section' => 'warranties'
					),
					'wcwar_default_post' => array(
						'name'    => esc_html__( 'Warranty Status', 'woocommerce-warranties-and-returns' ),
						'type'    => 'select',
						'desc'    => esc_html__( 'Select status for the newly submitted warranty request posts.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_default_post',
						'default' => 'pending',
						'options' => array(
							'draft' => esc_html__( 'Draft', 'woocommerce-warranties-and-returns' ),
							'publish' => esc_html__( 'Published', 'woocommerce-warranties-and-returns' ),
							'pending' => esc_html__( 'Pending', 'woocommerce-warranties-and-returns' )
						),
						'autoload' => false,
						'section' => 'warranties'
					),
					'wcwar_enable_multi_requests' => array(
						'name'    => esc_html__( 'Multi Requests', 'woocommerce-warranties-and-returns' ),
						'type'    => 'checkbox',
						'desc'    => esc_html__( 'Check this option to enable multi requests in the defined warranty period. New requests will available upon completing the previous requests.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_enable_multi_requests',
						'default' => 'no',
						'autoload' => false,
						'section' => 'warranties'
					),
					'wcwar_enable_guest_requests' => array(
						'name'    => esc_html__( 'Guest Requests', 'woocommerce-warranties-and-returns' ),
						'type'    => 'checkbox',
						'desc'    => esc_html__( 'Guests can access warranties using their Order ID and an E-Mail address to confirm their identity. Check this option if you want to allow guests to request warranties and returns.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_enable_guest_requests',
						'default' => 'no',
						'autoload' => false,
						'section' => 'warranties'
					),
					'wcwar_enable_admin_requests' => array(
						'name'    => esc_html__( 'Admin Warranties', 'woocommerce-warranties-and-returns' ),
						'type'    => 'checkbox',
						'desc'    => esc_html__( 'If checked admins will have the ability to create warranty requests for items without warranties.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_enable_admin_requests',
						'default' => 'yes',
						'autoload' => false,
						'section' => 'warranties'
					),
					'wcwar_form' => array(
						'name'    => esc_html__( 'Warranty Form', 'woocommerce-warranties-and-returns' ),
						'type'    => 'hidden',
						'desc'    => esc_html__( 'Use the manager to create a warranty form.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_form',
						'default' => '',
						'autoload' => false,
						'section' => 'warranties'
					),

					'wcwar_email_disable' => array(
						'name'    => esc_html__( 'Show/Hide Warranty Info', 'woocommerce-warranties-and-returns' ),
						'type'    => 'checkbox',
						'desc'    => esc_html__( 'Check this option to hide warranty information in WooCommerce Order E-Mails notifications.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_email_disable',
						'default' => 'no',
						'autoload' => true,
						'section' => 'email'
					),
					'wcwar_email_name' => array(
						'name'    => esc_html__( 'From Name', 'woocommerce-warranties-and-returns' ),
						'type'    => 'text',
						'desc'    => esc_html__( 'Enter email From Name: which should appear in quick emails.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_email_name',
						'default' => get_bloginfo( 'name' ),
						'autoload' => false,
						'section' => 'email'
					),
					'wcwar_email_address' => array(
						'name'    => esc_html__( 'Reply To', 'woocommerce-warranties-and-returns' ),
						'type'    => 'text',
						'desc'    => esc_html__( 'Enter email address that will appear as a Reply To: address in quick emails.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_email_address',
						'default' => get_bloginfo( 'admin_email' ),
						'autoload' => false,
						'section' => 'email'
					),
					'wcwar_email_bcc' => array(
						'name'    => esc_html__( 'BCC Copies', 'woocommerce-warranties-and-returns' ),
						'type'    => 'text',
						'desc'    => esc_html__( 'Enter E-Mail addresses separated by comma to send BCC copies of quick emails.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_email_bcc',
						'default' => '',
						'autoload' => false,
						'section' => 'email'
					),


					'wcwar_enable_returns' => array(
						'name'    => esc_html__( 'Enable Returns', 'woocommerce-warranties-and-returns' ),
						'type'    => 'checkbox',
						'desc'    => esc_html__( 'This option will enable the in store returns. Set your return period in which the items can be sent back by customers with a refund.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_enable_returns',
						'default' => 'no',
						'autoload' => false,
						'section' => 'returns'
					),
					'wcwar_returns_period' => array(
						'name' => esc_html__( 'Return Limit', 'woocommerce-warranties-and-returns' ),
						'type' => 'number',
						'desc' => esc_html__( 'Number of days for returning items upon order completition. If 0 is set, items will have a lifetime return period.', 'woocommerce-warranties-and-returns' ),
						'id'   => 'wcwar_returns_period',
						'default' => 0,
						'custom_attributes' => array(
							'min' 	=> 0,
							'max' 	=> 1826,
							'step' 	=> 1
						),
						'autoload' => false,
						'section' => 'returns'
					),
					'wcwar_returns_no_warranty' => array(
						'name'    => esc_html__( 'Returns Without a Warranty', 'woocommerce-warranties-and-returns' ),
						'type'    => 'checkbox',
						'desc'    => esc_html__( 'If checked, returns will be available for items that have no warranty.', 'woocommerce-warranties-and-returns' ),
						'id'      => 'wcwar_returns_no_warranty',
						'default' => 'no',
						'autoload' => false,
						'section' => 'returns'
					),

				)
			);

			foreach ( $plugins['warranties_and_returns']['settings'] as $k => $v ) {
				$get = isset( $v['translate'] ) ? $v['id'] . SevenVX()->language() : $v['id'];
				$std = isset( $v['default'] ) ?  $v['default'] : '';
				$set = ( $set = get_option( $get, false ) ) === false ? $std : $set;
				$plugins['warranties_and_returns']['settings'][$k]['val'] = SevenVX()->stripslashes_deep( $set );
			}

			return apply_filters( 'wc_warrantiesandreturns_settings', $plugins );
		}

	}

	if ( isset($_GET['page'], $_GET['tab']) && ($_GET['page'] == 'wc-settings' ) && $_GET['tab'] == 'warranties_and_returns' ) {
		add_action( 'init', array( 'WC_War_Settings', 'init' ), 100 );
	}

?>