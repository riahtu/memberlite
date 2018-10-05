<?php
/**
 * Custom admin theme pages and scripts
 *
 * @package Memberlite
 */

/*
	Adds Theme Support submenu page to "Appearance" menu.
*/
function memberlite_theme_menu() {
	add_theme_page( esc_html__( 'Memberlite Documentation and Support', 'memberlite' ), esc_html__( 'Memberlite Guide', 'memberlite' ), 'edit_theme_options', 'memberlite-support', 'memberlite_support' );
}
add_action( 'admin_menu', 'memberlite_theme_menu' );

/*
	Redirect to Welcome tab if the user hasn't been there yet.
*/
function memberlite_admin_init_redirect_to_welcome() {
	$memberlite_welcome_version = get_option( 'memberlite_welcome_version', 0 );
	if (version_compare( $memberlite_welcome_version, MEMBERLITE_VERSION) < 0 ) {
		update_option( 'memberlite_welcome_version', MEMBERLITE_VERSION, 'no' );
		wp_redirect( admin_url( 'admin.php?page=memberlite-support' ) );
		exit;
	}
}
add_action( 'admin_init', 'memberlite_admin_init_redirect_to_welcome' );

/*
	Render the welcome/support page
*/
function memberlite_support() {
	?>
	<div id="wpbody-content" aria-label="<?php esc_attr_e( 'Main content', 'memberlite' ); ?>" tabindex="0">
		<style>
			.about-wrap {max-width: 100%; }
			.about-wrap .memberlite-badge {background-image: url(<?php echo get_template_directory_uri() . '/images/Memberlite_icon.png'; ?>); background-color: #FFF; color: #2C3E50; }
			.about-wrap .dashicons {font-size: 40px; height: 40px; width: 40px; }
			.about-wrap .plugin-card h3 {margin: 0 0 12px; }
			.about-wrap .about-text.about-text-no-right-margin {margin-right: 0; }
		</style>
		<div class="wrap about-wrap">
			<h1><?php esc_html_e( 'Welcome to the Memberlite Theme', 'memberlite' ); ?></h1>
			<div class="about-text"><?php esc_html_e( "Memberlite is the ideal theme for your membership site - packed with integration for top membership site plugins including Paid Memberships Pro. It's fully customizable with your logo, colors, fonts, custom sidebars and more global layout settings.", 'memberlite' ); ?></div>
			<div class="wp-badge memberlite-badge">
				<?php
					/* translators: Memberlite version number */
					printf( esc_html__( 'Version %s', 'memberlite' ), MEMBERLITE_VERSION );
				?>
			</div>
			<div class="feature-section two-col">
				<div class="col">
					<h2><span class="dashicons dashicons-format-image"></span> <?php esc_html_e( 'Adding Your Logo', 'memberlite' ); ?></h2>
					<p><?php esc_html_e( 'Use the Customize > Site Identity screen to add a custom logo and update or toggle the display of your Site Title and Tagline.', 'memberlite' ); ?></p>
					<p>
						<a class="button button-primary" href="<?php echo esc_url( wp_customize_url() ); ?>"><?php esc_html_e( 'Add Your Logo', 'memberlite' ); ?></a>
						<a class="button" href="https://memberlitetheme.com/documentation/site-branding/" target="_blank"><?php esc_html_e( 'View Docs on Site Branding in Memberlite', 'memberlite' ); ?></a>
					</p>
				</div>
				<div class="col">
					<h2><span class="dashicons dashicons-admin-customizer"></span> <?php esc_html_e( 'Customize the Theme', 'memberlite' ); ?></h2>
					<p><?php esc_html_e( 'Use the Customize > Memberlite Options screen to modify theme layout, logo, fonts, colors, copyright message and more.', 'memberlite' ); ?></p>
					<p>
						<a class="button button-primary" href="<?php echo esc_url( wp_customize_url() ); ?>"><?php esc_html_e( 'Customize Your Theme', 'memberlite' ); ?></a>
						<a class="button" href="https://memberlitetheme.com/documentation/customize/" target="_blank"><?php esc_html_e( 'View Docs on on Customizing Memberlite', 'memberlite' ); ?></a>
					</p>
				</div>
				<br class="clear" />&nbsp;<br class="clear" />&nbsp;
				<hr />
				<div class="col">
					<h2><span class="dashicons dashicons-admin-appearance"></span> <?php esc_html_e( 'Using Child Themes', 'memberlite' ); ?></h2>
					<p><?php esc_html_e( 'If you need to customize the theme beyond the settings in Appearance > Customize, use a child theme.', 'memberlite' ); ?></p>
					<p>
						<a class="button button-primary"href="https://github.com/strangerstudios/memberlite-child" target="_blank">
						<?php esc_html_e( 'Download a Blank Child Theme', 'memberlite' ); ?></a>
						<a class="button" href="https://developer.wordpress.org/themes/advanced-topics/child-themes/" target="_blank">
						<?php esc_html_e( 'About Child Themes (WordPress Codex)', 'memberlite' ); ?></a>
					</p>
				</div>
				<div class="col">
					<h2><span class="dashicons dashicons-lightbulb"></span> <?php esc_html_e( 'Theme Demo, Docs and Support', 'memberlite' ); ?></h2>
					<p><?php esc_html_e( 'We offer a simple annual support membership if you need additional help with your Memberlite-powered WordPress site.', 'memberlite' ); ?></p>
					<p>
						<a class="button button-primary" href="https://demo.memberlitetheme.com" target="_blank"><?php esc_html_e( 'View Theme Demo', 'memberlite' ); ?></a>
						<a class="button" href="https://memberlitetheme.com" target="_blank"><?php esc_html_e( 'View All Docs and Get Support', 'memberlite' ); ?></a>
					</p>
				</div>
			</div> <!-- end feature-section -->

			<?php
				$pmpro_license_key = get_option( 'pmpro_license_key', '' );
			if ( ! empty( $pmpro_license_key ) ) {
				?>

			<br class="clear" />
			<hr />
			<h2><?php esc_html_e( 'Upgrading from Memberlite v3.0?', 'memberlite' ); ?></h2>
			<div class="wrap">
				<div class="about-text about-text-no-right-margin">
					<?php esc_html_e( "We've done our best to make upgrading as smooth as possible. To comply with the WordPress.org Theme Repository guidelines, we have moved some banner and sidebar functionality into a separate plugin. <strong>You will have to install the Memberlite Elements plugin below to retain access to all Memberlite features.</strong>", 'memberlite' ); ?>
				</div>
			</div> <!-- end upgrade notice -->
			<?php } ?>

			<br class="clear" />
			<hr />

			<h2><?php esc_html_e( 'We highly recommend using these plugins for every site running Memberlite:', 'memberlite' ); ?></h2>
			<div class="wp-list-table widefat plugin-install">
				<h2 class="screen-reader-text">Plugins list</h2>
				<div id="the-list">
					<div class="plugin-card plugin-card-memberlite-elements">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="https://memberlitetheme.com/memberlite-elements/" target="_blank"><?php esc_html_e( 'Memberlite Elements', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/memberlite-elements-icon-256x256.png" class="plugin-icon" alt="Memberlite Elements" />
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li>
										<?php if ( is_plugin_active( 'memberlite-elements/memberlite-elements.php' ) ) { ?>
											<a class="button button-disabled"><?php esc_html_e( 'Installed', 'memberlite' ); ?></a>
										<?php } else { ?>
											<a class="install-now button" href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=memberlite+elements' ) ); ?>"><?php esc_html_e( 'Install Now', 'memberlite' ); ?></a>
										<?php } ?>
									</li>
									<li><a href="https://memberlitetheme.com/memberlite-elements/" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p><?php esc_html_e( 'Improved features and control for your Memberlite banners, sidebars, and landing pages.', 'memberlite' ); ?></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="https://www.strangerstudios.com" target="_blank"><?php esc_html_e( 'Stranger Studios', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-memberlite-elements -->
					<div class="plugin-card plugin-card-memberlite-shortcodes">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="https://memberlitetheme.com/memberlite-shortcodes/" target="_blank"><?php esc_html_e( 'Memberlite Shortcodes', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/memberlite-shortcodes-icon-256x256.png" class="plugin-icon" alt="Memberlite Shortcodes">
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li>
										<?php if ( is_plugin_active( 'memberlite-shortcodes/memberlite-shortcodes.php' ) ) { ?>
											<a class="button button-disabled"><?php esc_html_e( 'Installed', 'memberlite' ); ?></a>
										<?php } else { ?>
											<a class="install-now button" href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=memberlite+shortcodes' ) ); ?>"><?php esc_html_e( 'Install Now', 'memberlite' ); ?></a>
										<?php } ?>
									</li>
									<li><a href="https://memberlitetheme.com/memberlite-shortcodes/" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p><?php esc_html_e( 'Enhance the appearance of your content with shortcodes for Accordions, Banners, Buttons, Columns, Icons, Member Signup, Messages, and Recent Posts.', 'memberlite' ); ?></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="https://www.strangerstudios.com" target="_blank"><?php esc_html_e( 'Stranger Studios', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-memberlite-shortcodes -->
					<div class="plugin-card plugin-card-paid-memberships-pro">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="https://www.paidmembershipspro.com" target="_blank"><?php esc_html_e( 'Paid Memberships Pro', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/paid-memberships-pro-icon-256x256.png" class="plugin-icon" alt="Paid Memberships Pro">
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li><a class="install-now button" href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=paid+memberships+pro' ) ); ?>"><?php esc_html_e( 'Install Now', 'memberlite' ); ?></a></li>
									<li><a href="https://www.paidmembershipspro.com" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p><?php esc_html_e( 'A revenue-generating machine for membership sites. Unlimited levels with recurring payment, protected content and member management.', 'memberlite' ); ?></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="https://www.paidmembershipspro.com" target="_blank"><?php esc_html_e( 'Paid Memberships Pro', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-paid-memberships-pro -->
					<div class="plugin-card plugin-card-multiple-post-thumbnails">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="https://wordpress.org/plugins/multiple-post-thumbnails/" target="_blank"><?php esc_html_e( 'Multiple Post Thumbnails', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/multiple-post-thumbnails-icon-256x256.png" class="plugin-icon" alt="Multiple Post Thumbnails">
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li><a class="install-now button" href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=multiple+post+thumbnails' ) ); ?>"><?php esc_html_e( 'Install Now', 'memberlite' ); ?></a></li>
									<li><a href="https://wordpress.org/plugins/multiple-post-thumbnails/" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p><?php esc_html_e( 'Adds multiple post thumbnails to a post type. Required if you want to use the banner image/thumbnail features in Memberlite.', 'memberlite' ); ?></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="http://voceplatforms.com/" target="_blank"><?php esc_html_e( 'Chris Scott', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-multiple-post-thumbnails -->
					<div class="plugin-card plugin-card-theme-my-login">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="https://thememylogin.com/" target="_blank"><?php esc_html_e( 'Theme My Login', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/theme-my-login-icon-256x256.png" class="plugin-icon" alt="Theme My Login">
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li><a class="install-now button" href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=theme+my+login' ) ); ?>"><?php esc_html_e( 'Install Now', 'memberlite' ); ?></a></li>
									<li><a href="https://thememylogin.com/" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p><?php esc_html_e( 'Themes the WordPress login and profile pages according to your theme. Additional settings for restricting admin access and redirection.', 'memberlite' ); ?></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="https://www.jfarthing.com/" target="_blank"><?php esc_html_e( 'Jeff Farthing', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-theme-my-login -->
					<?php if ( ! empty( $pmpro_license_key ) ) { ?>
					<div class="plugin-card plugin-card-pmpro-advanced-levels-shortcode">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="https://www.paidmembershipspro.com/add-ons/pmpro-advanced-levels-shortcode/" target="_blank"><?php esc_html_e( 'Advanced Levels Page Shortcode', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/pmpro-advanced-levels-shortcode-icon-256x256.png" class="plugin-icon" alt="Advanced Levels Page Shortcode" />
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li>
										<?php if ( is_plugin_active( 'pmpro-advanced-levels-shortcode/pmpro-advanced-levels-shortcode.php' ) ) { ?>
												<a class="button button-disabled"><?php esc_html_e( 'Installed', 'memberlite' ); ?></a>
										<?php } else {
											if ( function_exists( 'pmpro_license_isValid' ) && pmpro_license_isValid( $pmpro_license_key, 'plus' ) ) {
												// valid key
												echo '<span class="install"><a class="install-now button" href="' . wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=pmpro-advanced-levels-shortcode', 'install-plugin_pmpro-advanced-levels-shortcode' ) ) . '">' . esc_html_e( 'Install Now', 'memberlite' ) . '</a></span>';
											} else {
												// invalid key
												echo '<span class="download"><a class="install-now button" target="_blank" href="http://license.paidmembershipspro.com/downloads/plus/pmpro-advanced-levels-shortcode.zip?key=' . $pmpro_license_key . '">' . esc_html__( 'Download', 'memberlite' ) . '</a></span>';
											}
										} ?>
									</li>
									<li><a href="https://www.paidmembershipspro.com/add-ons/pmpro-advanced-levels-shortcode/" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p><?php esc_html_e( 'Adds a new shortcode with many attributes to customize the levels page, including integrated styles for widely used theme frameworks/parent themes.', 'memberlite' );?></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="https://www.paidmembershipspro.com/" target="_blank"><?php esc_html_e( 'Paid Memberships Pro', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-pmpro-advanced-levels-shortcode -->
					<?php } ?>
				</div> <!-- end the-list -->
			</div> <!-- end plugin-install -->
			<br class="clear" />
			<hr />
			<h2><?php esc_html_e( 'Memberlite offers integration for these recommended plugins:', 'memberlite' ); ?></h2>
			<div class="wp-list-table widefat plugin-install">
				<h2 class="screen-reader-text">Plugins list</h2>
				<div id="the-list">
					<div class="plugin-card plugin-card-bbpress">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="https://www.bbpress.org" target="_blank"><?php esc_html_e( 'bbPress', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/bbpress-icon.svg" class="plugin-icon" alt="bbPress" />
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li><a class="install-now button" href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=bbpress' ) ); ?>"><?php esc_html_e( 'Install Now', 'memberlite' ); ?></a></li>
									<li><a href="https://www.bbpress.org" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p><?php esc_html_e( 'bbPress is forum software, made the WordPress way.', 'memberlite' ); ?></p>
								<p><a href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&type=term&s=Paid+Memberships+Pro+-+bbPress+Add+On' ) ); ?>"><?php esc_html_e( 'Install Paid Memberships Pro - bbPress Add On', 'memberlite' ); ?></a></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="https://www.bbpress.org" target="_blank"><?php esc_html_e( 'The bbPress Community', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-bbpress -->
					<div class="plugin-card plugin-card-events-manager">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="http://wp-events-plugin.com" target="_blank"><?php esc_html_e( 'Events Manager', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/events-manager-icon-256x256.png" class="plugin-icon" alt="Events Manager" />
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li><a class="install-now button" href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=events+manager' ) ); ?>"><?php esc_html_e( 'Install Now', 'memberlite' ); ?></a></li>
									<li><a href="http://wp-events-plugin.com" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p><?php esc_html_e( 'Fully featured event registration management including recurring events, locations management, calendar, Google map integration, booking management', 'memberlite' ); ?></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="http://wp-events-plugin.com" target="_blank"><?php esc_html_e( 'Marcus Sykes', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-events-manager -->
					<div class="plugin-card plugin-card-paid-memberships-pro">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="https://www.paidmembershipspro.com" target="_blank"><?php esc_html_e( 'Paid Memberships Pro', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/paid-memberships-pro-icon-256x256.png" class="plugin-icon" alt="Paid Memberships Pro" />
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li><a class="install-now button" href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=paid+memberships+pro' ) ); ?>"><?php esc_html_e( 'Install Now', 'memberlite' ); ?></a></li>
									<li><a href="https://www.paidmembershipspro.com" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p><?php esc_html_e( 'A revenue-generating machine for membership sites. Unlimited levels with recurring payment, protected content and member management.', 'memberlite' ); ?></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="https://www.paidmembershipspro.com" target="_blank"> <?php esc_html_e( 'Paid Memberships Pro', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-paid-memberships-pro -->
					<div class="plugin-card plugin-card-testimonials-widget">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="https://wordpress.org/plugins/testimonials-widget/" target="_blank"><?php esc_html_e( 'Testimonials Widget', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/testimonials-widget-icon-256x256.png" class="plugin-icon" alt="">
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li><a class="install-now button" href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=' ) ); ?>"><?php esc_html_e( 'Install Now', 'memberlite' ); ?></a></li>
									<li><a href="https://wordpress.org/plugins/testimonials-widget/" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p>
								<?php esc_html_e( 'Easily add social proofing to your website with Testimonials Widget. List or slide reviews via functions, shortcodes, or widgets.', 'memberlite' ); ?></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="https://wordpress.org/plugins/testimonials-widget/" target="_blank"><?php esc_html_e( 'Axelerant', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-testimonials-widget -->
					<div class="plugin-card plugin-card-woocommerce">
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3><a href="https://woocommerce.com" target="_blank"><?php esc_html_e( 'WooCommerce', 'memberlite' ); ?></a></h3>
								<img src="<?php echo get_template_directory_uri(); ?>/images/woocommerce-icon-256x256.png" class="plugin-icon" alt="WooCommerce">
							</div>
							<div class="action-links">
								<ul class="plugin-action-buttons">
									<li><a class="install-now button" href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=woocommerce' ) ); ?>"><?php esc_html_e( 'Install Now', 'memberlite' ); ?></a></li>
									<li><a href="https://woocommerce.com" target="_blank"><?php esc_html_e( 'More Details', 'memberlite' ); ?></a></li>
								</ul>
							</div>
							<div class="desc column-description">
								<p><?php esc_html_e( 'WooCommerce is a powerful, extendable eCommerce plugin that helps you sell anything. Beautifully.', 'memberlite' ); ?></p>
								<p><a href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&type=term&s=Paid+Memberships+Pro+-+WooCommerce+Add+On' ) ); ?>"><?php esc_html_e( 'Install Paid Memberships Pro - WooCommerce Add On', 'memberlite' ); ?></a></p>
								<p class="authors"><cite><?php esc_html_e( 'By', 'memberlite' ); ?> <a href="https://woocommerce.com" target="_blank"><?php esc_html_e( 'Automattic', 'memberlite' ); ?></a></cite></p>
							</div>
						</div>
					</div> <!-- end plugin-card-woocommerce -->

				</div> <!-- end the-list -->
			</div> <!-- end plugin-install -->
		</div> <!-- end about-wrap -->
	</div> <!-- end wpbody-content -->
	<?php
}

/*
	Load any notifications.

	1. Prompt the installation of memberlite-shortcodes if it's not activated already.
	2. Prompt the installation of pmpro-advanced-levels-shortcode if it's not activated already.
*/
// check for notifications
function memberlite_admin_init_notifications() {
	global $wpdb;

	// we want to avoid notices on some screens
	$script           = basename( $_SERVER['SCRIPT_NAME'] );
	$maybe_installing = $script == 'update.php' || $script == 'plugins.php';

	// 1. Prompt the installation of memberlite-elements if it's not activated already.
	if ( ! defined( 'MEMBERLITE_ELEMENTS_VERSION' ) && ! $maybe_installing ) {
		// check if this notice has been dismissed already
		$mle_dismissed = get_option( 'memberlite_notice_install_memberlite_elements_dismissed', false );
		if ( ! $mle_dismissed ) {
			wp_enqueue_script( 'memberlite-admin-dismiss-notice', get_template_directory_uri() . '/js/admin-dismiss-notice.js', array( 'jquery' ), MEMBERLITE_VERSION, true );
			add_action( 'admin_notices', 'memberlite_admin_notice_install_memberlite_elements' );
		}
	}

	// 2. Prompt the installation of memberlite-shortcodes if it's not activated already.
	if ( ! defined( 'MEMBERLITESC_VERSION' ) && ! $maybe_installing ) {
		// check if this notice has been dismissed already
		$mls_dismissed = get_option( 'memberlite_notice_install_memberlite_shortcodes_dismissed', false );
		if ( ! $mls_dismissed ) {
			wp_enqueue_script( 'memberlite-admin-dismiss-notice', get_template_directory_uri() . '/js/admin-dismiss-notice.js', array( 'jquery' ), MEMBERLITE_VERSION, true );
			add_action( 'admin_notices', 'memberlite_admin_notice_install_memberlite_shortcodes' );
		}
	}

	// 3. Prompt the installation of pmpro-advanced-levels-shortcode if it's not activated already.
	if ( ! function_exists( 'pmpro_advanced_levels_shortcode' ) && ! $maybe_installing ) {
		// check if this notice has been dismissed already
		$als_dismissed = get_option( 'memberlite_notice_install_advanced_levels_shortcode_dismissed', false );
		if ( ! $als_dismissed ) {
			// check if they are using the [memberlite_levels] shortcode
			$using_shortcode = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_type = 'page' AND post_status = 'publish' AND post_content LIKE '%[memberlite_levels%' LIMIT 1" );

			if ( $using_shortcode ) {
				// show notice
				wp_enqueue_script( 'memberlite-admin-dismiss-notice', get_template_directory_uri() . '/js/admin-dismiss-notice.js', array( 'jquery' ), MEMBERLITE_VERSION, true );
				add_action( 'admin_notices', 'memberlite_admin_notice_install_advanced_levels_shortcode' );
			} else {
				// not using the shortcode, so let's just dismiss the notice
				update_option( 'memberlite_notice_install_advanced_levels_shortcode_dismissed', 1, 'no' );
			}
		}
	}
}
add_action( 'admin_init', 'memberlite_admin_init_notifications' );

// AJAX to handle notice dismissal
function memberlite_wp_ajax_dismiss_notice() {
	// whitelist of notices
	$notices = array( 'install_advanced_levels_shortcode', 'install_memberlite_shortcodes' );

	// get and check notice
	$notice = $_REQUEST['notice'];
	if ( ! in_array( $notice, $notices ) ) {
		wp_die( 'Invalid notice.' );
	}

	// update option and leave
	update_option( 'memberlite_notice_' . $notice . '_dismissed', 1, 'no' );

	exit;
}
add_action( 'wp_ajax_nopriv_memberlite_dismiss_notice', 'memberlite_wp_ajax_dismiss_notice' );
add_action( 'wp_ajax_memberlite_dismiss_notice', 'memberlite_wp_ajax_dismiss_notice' );

// Install Memberlite Elements Notice
function memberlite_admin_notice_install_memberlite_elements() {
	// check if the plugin is installed, but not active
	if ( file_exists( WP_PLUGIN_DIR . '/memberlite-elements/memberlite-elements.php' ) ) {
		// installed but not activated
		$click_link = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=memberlite-elements/memberlite-elements.php' ), 'activate-plugin_memberlite-elements/memberlite-elements.php' );
		$click_text = __(
			'Click here to activate the Memberlite Elements plugin.',
			'memberlite'
		);
	} else {
		// need to install
		$click_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=memberlite-elements' ), 'install-plugin_memberlite-elements' );
		$click_text = __(
			'Click here to install the Memberlite Elements plugin.',
			'memberlite'
		);
	}

	// notice HTML
	?>
	<div id="memberlite-admin-notice-install_memberlite_elements" class="notice notice-error is-dismissible memberlite-notice">
		<p><strong><?php esc_html_e( 'Memberlite', 'memberlite' ); ?>:</strong> <?php echo esc_html__( 'Some features of Memberlite now require the Memberlite Elements plugin.', 'memberlite' ) . ' <a href="' . $click_link . '">' . $click_text . '</a>'; ?></p>
	</div>
	<?php
}

// Install Memberlite Shortcodes Notice
function memberlite_admin_notice_install_memberlite_shortcodes() {
	// check if the plugin is installed, but not active
	if ( file_exists( WP_PLUGIN_DIR . '/memberlite-shortcodes/memberlite-shortcodes.php' ) ) {
		// installed but not activated
		$click_link = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=memberlite-shortcodes/memberlite-shortcodes.php' ), 'activate-plugin_memberlite-shortcodes/memberlite-shortcodes.php' );
		$click_text = __(
			'Click here to activate the Memberlite Shortcodes plugin.',
			'memberlite'
		);
	} else {
		// need to install
		$click_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=memberlite-shortcodes' ), 'install-plugin_memberlite-shortcodes' );
		$click_text = __(
			'Click here to install the Memberlite Shortcodes plugin.',
			'memberlite'
		);
	}

	// notice HTML
	?>
	<div id="memberlite-admin-notice-install_memberlite_shortcodes" class="notice notice-error is-dismissible memberlite-notice">
		<p><strong><?php esc_html_e( 'Memberlite', 'memberlite' ); ?>:</strong> <?php echo esc_html__( 'Some features of Memberlite now require the Memberlite Shortcodes plugin.', 'memberlite' ) . ' <a href="' . $click_link . '">' . $click_text . '</a>'; ?></p>
	</div>
	<?php
}

// Install Advanced Levels Shortcode Notice
function memberlite_admin_notice_install_advanced_levels_shortcode() {
	// check if the plugin is installed, but not active
	if ( file_exists( WP_PLUGIN_DIR . '/pmpro-advanced-levels-shortcode/pmpro-advanced-levels-shortcode.php' ) ) {
		// installed but not activated
		$click_link = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=pmpro-advanced-levels-shortcode/pmpro-advanced-levels-shortcode.php' ), 'activate-plugin_pmpro-advanced-levels-shortcode/pmpro-advanced-levels-shortcode.php' );
		$click_text = __(
			'Click here to activate the Advanced Levels Shortcode plugin.',
			'memberlite'
		);
	} else {
		// need to install
		$click_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=pmpro-advanced-levels-shortcode' ), 'install-plugin_pmpro-advanced-levels-shortcode' );
		$click_text = __(
			'Click here to install the Advanced Levels Shortcode plugin.',
			'memberlite'
		);
	}

	// notice HTML
	?>
	<div id="memberlite-admin-notice-install_advanced_levels_shortcode" class="notice notice-error is-dismissible memberlite-notice">
		<p><strong><?php esc_html_e( 'Memberlite', 'memberlite' ); ?>:</strong> <?php echo esc_html__( 'The [memberlite_levels] shortcode has been merged into the Advanced Levels Shortcode add on.', 'memberlite' ) . ' <a href="' . $click_link . '">' . $click_text . '</a>'; ?></p>
	</div>
	<?php
}
