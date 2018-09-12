<?php
// ReduxFramework Config File

if (!class_exists("wpgumby_redux_framework_config")) {

    class wpgumby_redux_framework_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
			if ( strpos( Redux_Helpers::cleanFilePath( __FILE__ ), Redux_Helpers::cleanFilePath( get_template_directory() ) ) !== false) {
				$this->initSettings();
            } else {
				add_action('plugins_loaded', array($this, 'initSettings'), 10);
			}
        }

        public function initSettings() {
            if ( !class_exists("ReduxFramework" ) ) { return; }       
            $this->setArguments();
            $this->setSections();
            if (!isset($this->args['opt_name'])) { return; }
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) { remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2); }
            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
        }

        public function setSections() {
            ob_start();
            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'wpgumby'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','wpgumby'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','wpgumby'); ?>" />
            <?php endif; ?>

                <h4>
            <?php echo $this->theme->display('Name'); ?>
                </h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'wpgumby'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'wpgumby'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'wpgumby') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
                <?php
                if ($this->theme->parent()) {
                    printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.','wpgumby') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'wpgumby'), $this->theme->parent()->display('Name'));
                }
                ?>

                </div>
            </div>
            <?php
            $item_info = ob_get_contents();
            ob_end_clean();

			// ACTUAL DECLARATION OF SECTIONS
			$this->sections[] = array(
                'icon' => 'el-icon-website',
                'title' => __('Layout settings', 'wpgumby'),
                'fields' => array(
				
					array(
                        'id' => 'logotype',
                        'type' => 'select',
                        'title' => __('Logo', 'wpgumby'),
                        'subtitle' => __('Select logo type.', 'wpgumby'),
                        'options' => array(
							'image'						=> __('Uploaded image', 'wpgumby'),
							'site_title'				=> __('Default site title', 'wpgumby'),
							'site_title_description'	=> __('Default site title & description', 'wpgumby')),
                        'default' => '',
                    ),
					array(
                        'id' => 'hidden_uploader',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Upload logo image', 'wpgumby'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri() . '/images/wpgumby_mainlogo.png'),
                    ),
					array(
                        'id' => 'hidden_custom_text',
                        'type' => 'text',
                        'title' => __('Custom logo text', 'wpgumby'),
                        'default' => 'wpGumby'
                    ),
					array(
                        'id' => 'logo_margin',
                        'type' => 'text',
                        'title' => __('Logo margin', 'wpgumby'),
                        'subtitle' => __('9px (margin: top/right/bottom/left);<br/>9px 4px (margin: top/bottom right/left);<br/>9px 8px 7px 6px (margin: top bottom right left).', 'wpgumby'),
                        'default' => '0px'
                    ),
					array(
                        'id' => 'logo_padding',
                        'type' => 'text',
                        'title' => __('Logo padding', 'wpgumby'),
                        'subtitle' => __('9px (padding: top/right/bottom/left);<br/>9px 4px (padding: top/bottom right/left);<br/>9px 8px 7px 6px (padding: top bottom right left).', 'wpgumby'),
                        'default' => '0px'
                    ),
					array(
                        'id' => 'columns_footer_radio',
                        'type' => 'radio',
                        'title' => __('Number of columns in footer', 'wpgumby'),
                        'options' => array('1' => __('One', 'wpgumby'), '2' => __('Two', 'wpgumby'), '3' => __('Three', 'wpgumby'), '4' => __('Four', 'wpgumby')),
                        'default' => '4'
                    ),
					array(
                        'id' => 'layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => __('Main layout', 'wpgumby'),
                        'subtitle' => __('Select main content and sidebar alignment. Choose between 1, 2 or full width layouts.', 'wpgumby'),
                        'options' => array(
                            '1col' => array('alt' => '1 Column', 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                            '2c-l' => array('alt' => '2 Column left', 'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                            '2c-r' => array('alt' => '2 Column right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png')
                        ),
                        'default' => '2c-l'
                    ),
					array(
                        'id' => 'excerpt_or_readmore',
                        'type' => 'radio',
                        'title' => __('Post display type', 'wpgumby'),
                        'subtitle' => __('Select post display type what will be used in your blog page.', 'wpgumby'),
                        'options' => array("excerpt" => __('Excerpt', 'wpgumby'), "readmore" =>__('Full post', 'wpgumby')),
                        'default' => 'readmore'
                    ),
					
				),
            );
			
			$this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('Configuration', 'wpgumby'),
                'fields' => array(			
			
					
					array(
                        'id' => 'width_radio',
                        'type' => 'radio',
                        'title' => __('Choose layout width', 'wpgumby'),
                        'options' => array("fixed" =>__('Fixed (960px)', 'wpgumby'), "full_width" => __('Full width (100%)', 'wpgumby')),
                        'default' => 'fixed'
                    ),
					array(
                        'id' => 'social_fp',
                        'type' => 'text',
                        'title' => __('Facebook profile link', 'wpgumby'),
                        'subtitle' => __('Enter link to Facebook profile ex.: http://www.facebook.com/example', 'wpgumby')
                    ),
					array(
                        'id' => 'social_gp',
                        'type' => 'text',
                        'title' => __('Google+ profile link', 'wpgumby'),
                        'subtitle' => __('Enter link to Google+ profile ex.: http://plus.google.com/example', 'wpgumby')
                    ),
					array(
                        'id' => 'social_tw',
                        'type' => 'text',
                        'title' => __('Twitter profile link', 'wpgumby'),
                        'subtitle' => __('Enter link to Twitter profile ex.: http://twitter.com/example', 'wpgumby')
                    ),
					array(
                        'id' => 'social_yt',
                        'type' => 'text',
                        'title' => __('Youtube profile link', 'wpgumby'),
                        'subtitle' => __('Enter link to Youtube profile ex.: http://www.youtube.com/example', 'wpgumby')
                    ),
					array(
                        'id' => 'social_pi',
                        'type' => 'text',
                        'title' => __('Pinterest profile link', 'wpgumby'),
                        'subtitle' => __('Enter link to Pinterest profile ex.: http://pinterest.com/example', 'wpgumby')
                    ),
					array(
                        'id' => 'social_position',
                        'type' => 'radio',
                        'title' => __('Social icons position', 'wpgumby'),
                        'options' => array("footer" => __('Footer', 'wpgumby'), "sidebar" => __('Sidebar', 'wpgumby')),
                        'default' => 'footer'
                    ),
					
					array(
							'id'        => 'camera_slider',
							'type'      => 'multi_media',
							'title'     => __('Multi Media Selector', 'wpgumby'),
							'subtitle'  => 'Multi file media selector',
							'labels'    => array(
								'upload_file'       => __('Select File(s)', 'wpgumby'),
								'remove_image'      => __('Remove Image', 'wpgumby'),
								'remove_file'       => __('Remove', 'wpgumby'),
								'file'              => __('File: ', 'wpgumby'),
								'download'          => __('Download', 'wpgumby'),
								'title'             => __('Multi Media Selector', 'wpgumby'),
								'button'            => __('Add or Upload File','wpgumby')
							),
							'library_filter'  => array('gif','jpg','png'),
							'max_file_upload' => 5,
							'default' => '40'
					),
				),
            );			
			
			$this->sections[] = array(
                'icon' => 'el-icon-home',
                'title' => __('Front page Settings', 'wpgumby'),
                'fields' => array(	
				array(
                        'id' => 'slider_on',
                        'type' => 'switch',
                        'title' => __('Enable Slider', 'wpgumby'),
                        "default" => 0,
                    ),
					array(
                        'id' => 'camera_slider',
                        'type' => 'slides',
                        'title' => __('Slides options', 'wpgumby'),
                        'subtitle' => __('Unlimited slides with drag and drop sortings.', 'wpgumby'),
                        'placeholder' => array(),
                    ),
					array(
                        'id' => 'slider_animation',
                        'type' => 'select',
                        'title' => __('Slider caption animation', 'wpgumby'),
                        'options' => array(
							'moveFromLeft'				=>  __('Move from left', 'wpgumby'), 
							'moveFromRight'				=>  __('Move from right', 'wpgumby'), 
							'moveFromTop'				=>  __('Move from top', 'wpgumby'),  
							'moveFromBottom'			=>  __('Move from bottom', 'wpgumby'), 
							'fadeIn'					=>  __('Fade in', 'wpgumby'), 
							'fadeFromLeft'				=>  __('Fade from left', 'wpgumby'), 
							'fadeFromRight'				=>  __('Fade from right', 'wpgumby'), 
							'fadeFromTop'				=>  __('Fade from top', 'wpgumby'), 
							'fadeFromBottom'			=>  __('Fade from bottom', 'wpgumby')),
                        'default' => 'fadeIn',
                    ),
					array(
                        'id' => 'slider_resize',
                        'type' => 'radio',
                        'title' => __('Slider images resize options', 'wpgumby'),
                        'options' => array("zoom" => __('Resize to fit (no cropping)', 'wpgumby'), "crop" => __('Crop', 'wpgumby')),
                        'default' => 'zoom'
                    ),
					array(
                        'id' => 'cta_text',
                        'type' => 'textarea',
                        'title' => __('Call to action text', 'wpgumby'),
                        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit! Maecenas at convallis urna. Vestibulum varius, leo sit amet interdum mattis, arcu sem ultricies nulla, eget placerat metus lectus sit amet dolor.',
                    ),
					array(
                        'id' => 'cta_link',
                        'type' => 'text',
                        'title' => __('Call to action button link', 'wpgumby'),
                        'default' => 'http://shopitpress.com/'
                    ),
					array(
                        'id' => 'cta_button',
                        'type' => 'text',
                        'title' => __('Call to action button text', 'wpgumby'),
                        'default' => __('Download NOW!', 'wpgumby'),
                    ),
					array(
                        'id' => 'cta_open',
                        'type' => 'switch',
                        'title' => __('Call to action link open in the new window', 'wpgumby'),
                        "default" => 0,
                        'on' => __('On', 'wpgumby'),
                        'off' => __('Off', 'wpgumby'),
                    ),
					array(
						'id' => 'frontpage_lb_img',
						'type' => 'media',
						'url' => true,
						'title' => __('Left block content', 'wpgumby'),
						'subtitle' => __('Column 1 image', 'wpgumby'),
						'compiler' => 'true',
					        ),
				  array(
						'id' => 'frontpage_lb_title',
						'type' => 'text',
						'compiler' => true,
						'title' => __('', 'wpgumby'),
						'subtitle' => __('Column 1 title', 'wpgumby'),
						'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit!',
				  ),
				    array(
                        'id' => 'frontpage_lb_link',
                        'type' => 'text',
                        'title' => __('', 'wpgumby'),
                        'subtitle' => __('Column 1 link', 'wpgumby')
                    ),
				  array(
						'id' => 'frontpage_lb_text',
						'type' => 'textarea',
						'compiler' => true,
						'title' => __('', 'wpgumby'),
						'subtitle' => __('Column 1 text', 'wpgumby'),
						 'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit!',
				  ),
					array(
                        'id' => 'frontpage_cb_img',
                       	'type' => 'media',
						'url' => true,
                        'title' => __('Center block content', 'wpgumby'),
						'subtitle' => __('Column 2 image', 'wpgumby'),
						'compiler' => 'true',
						 
                  ),
				   array(
						'id' => 'frontpage_cb_title',
						'type' => 'text',
						'compiler' => true,
						'title' => __('', 'wpgumby'),
						'subtitle' => __('Column 2 title', 'wpgumby'),
						'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit!',
				  ),
				     array(
                        'id' => 'frontpage_cb_link',
                        'type' => 'text',
                        'title' => __('', 'wpgumby'),
                        'subtitle' => __('Column 2 link', 'wpgumby')
                    ),
				  array(
						'id' => 'frontpage_cb_text',
						'type' => 'textarea',
						'compiler' => true,
						'title' => __('', 'wpgumby'),
						'subtitle' => __('Column 2 text', 'wpgumby'),
						 'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit!',
				  ),
							array(
                        'id' => 'frontpage_rb_img',
                       	'type' => 'media',
						'url' => true,
                        'title' => __('Right block content', 'wpgumby'),
						'subtitle' => __('Column 3 image', 'wpgumby'),
						'compiler' => 'true',
						),
				   array(
						'id' => 'frontpage_rb_title',
						'type' => 'text',
						'compiler' => true,
						'title' => __('', 'wpgumby'),
						'subtitle' => __('Column 3 title', 'wpgumby'),
						'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit!',
				  ),
				   array(
                        'id' => 'frontpage_rb_link',
                        'type' => 'text',
                        'title' => __('', 'wpgumby'),
                        'subtitle' => __('Column 3 link', 'wpgumby')
                    ),
				  array(
						'id' => 'frontpage_rb_text',
						'type' => 'textarea',
						'compiler' => true,
						'title' => __('', 'wpgumby'),
						'subtitle' => __('Column 3 text', 'wpgumby'),
						 'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit!',
				  ),
				),
            );
			
			$this->sections[] = array(
                'icon' => 'el-icon-th',
                'title' => __('Portfolio settings', 'wpgumby'),
                'fields' => array(
					array(
                        'id' => 'portfolio_on',
                        'type' => 'switch',
                        'title' => __('Enable portfolio', 'wpgumby'),
                        "default" => 0,
                    ),
					array(
                        'id' => 'portfolio_category',
                        'type' => 'select',
                        'data' => 'categories',
                        'title' => __('Select category', 'wpgumby'),
                        'subtitle' => __('Select category where you will store your portfolio posts.', 'wpgumby'),
                    ),
					array(
                        'id' => 'portfolio_remove',
                        'type' => 'switch',
                        'title' => __('Exclude category from blog page', 'wpgumby'),
                        "default" => 1,
                    ),
					array(
                        'id' => 'portfolio_page',
                        'type' => 'select',
                        'data' => 'pages',
                        'title' => __('Select portfolio page', 'wpgumby'),
                    ),
					array(
                        'id' => 'p_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => __('Portfolio page layout', 'wpgumby'),
                        'options' => array(
                            '2c-p' => array('alt' => '2 Columns', 'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'),
                            '3c-p' => array('alt' => '3 Columns', 'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'),
                            '4c-p' => array('alt' => '4 Columns', 'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png')
                        ),
                        'default' => '4c-p'
                    ),
					
					array(
                        'id' => 'portfolio_count',
                        'type' => 'text',
                        'title' => __('Portfolio items per page', 'wpgumby'),
                        'default' => '40'
                    ),
						
					
				),
         	);			
			
			
        }

        public function setArguments() {
            $theme = wp_get_theme();
            $this->args = array(
                'opt_name' => 'wpgumby_data', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'hidden', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => false, // Show the sections below the admin menu item or not
                'menu_title' => __('Theme options', 'wpgumby'),
                'page' => __('Theme options', 'wpgumby'),
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => 'theme-options', // Page slug used to denote the panel
                'save_defaults' => false, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'             	=> 'wpgumby', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'      	=> '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );            
            );
			
			$this->args['intro_text'] = __('<p>&nbsp;</p>', 'wpgumby');
            $this->args['footer_text'] = __('<p>&nbsp;</p>', 'wpgumby');
			$this->args['footer_credit'] = __( '<p>&nbsp;</p>', 'wpgumby');
        }
    }

    new wpgumby_redux_framework_config();
}