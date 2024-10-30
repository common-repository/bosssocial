<?php

	function create_boss_social_tabs( $current = 'social-icons' )
	{
		$tabs = array(  'social-icons' => 'Social Icons',
						'shortcodes' => 'Shortcodes' );
		
		?>
		
			<h2 class="nav-tab-wrapper">
			
				<div id="icon-themes" class="icon32"></div>
			
				<div><h2>BossSocial</h2></div>
		
				<?php
				
					foreach ( $tabs as $tab => $name )
					{
						$class = ( $tab == $current ) ? ' nav-tab-active' : "";
						
						echo "<a class='nav-tab$class' href='?page=boss-social&tab=$tab'>$name</a>";
						
					}
					// end foreach
				
				?>
		
			</h2>
		
		<?php
	
	}
	// end create_boss_social_tabs
	
	
	function boss_social_page()
	{
		global $pagenow;
		
		?>
			
			<div class="wrap wrap-boss-social">
			
				<div class="status"><img alt="" src="<?php echo plugins_url( 'ajax-loader.gif' , __FILE__ ); ?>"><strong></strong></div>
				
				<script>
				
					jQuery(document).ready(function($)
					{
						$( 'form.ajax-form' ).submit(function()
						{
							$.ajax(
							{
								data : $(this).serialize(),
								type: "POST",
								beforeSend: function()
								{
									$('.status img').show();
									$('.status strong').html('Saving...');
									$('.status').fadeIn();
								},
								success: function(data)
								{
									$('.status img').hide();
									$('.status strong').html('Done.');
									$('.status').delay(1000).fadeOut();
								}
							});
							
							return false;
						});
					});
					
				</script>
				
				<?php
					
					if ( isset( $_GET['tab'] ) )
					{
						create_boss_social_tabs( $_GET['tab'] );
					}	
					else
					{
						create_boss_social_tabs( 'social-icons' );
					}
					
				?>

				<div id="poststuff">
					
					<?php
					
						// settings page
						if ( $pagenow == 'admin.php' && $_GET['page'] == 'boss-social' )
						{
							// tab from url
							if ( isset( $_GET['tab'] ) )
							{
								$tab = $_GET['tab'];
							}
							else
							{
								$tab = 'social-icons'; 
							}
							// end tab from url
							
							// tab content
							switch ( $tab )
							{
								case 'social-icons' :
								
									if ( esc_attr( @$_GET['saved'] ) == 'true' )
									{
										echo '<div class="updated below-h2"><p><strong>Changes saved.</strong></p></div>';
									}
									
								?>
								
									<div class="postbox">
									
										<div class="inside">
										
											<form method="post" action="<?php admin_url( 'admin.php?page=boss-social' ); ?>" class="ajax-form">
											
												<?php
												
													wp_nonce_field( 'boss-social-settings-page' );
													
												?>
												
												<table>
												
													<tr>
														<td class="option-left">
														
															<h4>Facebook URL</h4>
															
															<input type="text" id="social_facebook" name="social_facebook" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_facebook' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://www.facebook.com/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Twitter URL</h4>
															
															<input type="text" id="social_twitter" name="social_twitter" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_twitter' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://twitter.com/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Google+ URL</h4>
															
															<input type="text" id="social_google" name="social_google" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_google' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://plus.google.com/userID</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Blogger URL</h4>
															
															<input type="text" id="boss_social_blogger" name="boss_social_blogger" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_blogger' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://username.blogspot.com</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Tumblr URL</h4>
															
															<input type="text" id="social_tumblr" name="social_tumblr" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_tumblr' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://username.tumblr.com</span>
														
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>WordPress URL</h4>
															
															<input type="text" id="boss_social_wordpress" name="boss_social_wordpress" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_wordpress' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://username.wordpress.com</span>
														
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Behance URL</h4>
															
															<input type="text" id="boss_social_behance" name="boss_social_behance" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_behance' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://www.behance.net/username</span>
														
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Pinterest URL</h4>
															
															<input type="text" id="social_pinterest" name="social_pinterest" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_pinterest' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://pinterest.com/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>StumbleUpon URL</h4>
															
															<input type="text" id="boss_social_stumbleupon" name="boss_social_stumbleupon" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_stumbleupon' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://www.stumbleupon.com/stumbler/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Digg URL</h4>
															
															<input type="text" id="boss_social_digg" name="boss_social_digg" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_digg' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://digg.com/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Delicious URL</h4>
															
															<input type="text" id="boss_social_delicious" name="boss_social_delicious" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_delicious' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://delicious.com/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>DeviantART URL</h4>
															
															<input type="text" id="boss_social_deviantart" name="boss_social_deviantart" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_deviantart' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://username.deviantart.com</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>LinkedIn URL</h4>
															
															<input type="text" id="social_linkedin" name="social_linkedin" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_linkedin' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://www.linkedin.com/in/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Skype URL</h4>
															
															<input type="text" id="social_skype" name="social_skype" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_skype' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">skype:username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Flickr URL</h4>
															
															<input type="text" id="social_flickr" name="social_flickr" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_flickr' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://www.flickr.com/photos/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Picasa URL</h4>
															
															<input type="text" id="social_picasa" name="social_picasa" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_picasa' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">https://picasaweb.google.com/userID</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Instagram URL</h4>
															
															<input type="text" id="boss_social_instagram" name="boss_social_instagram" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_instagram' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://instagr.am/p/picID</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Dribbble URL</h4>
															
															<input type="text" id="social_dribbble" name="social_dribbble" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_dribbble' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://dribbble.com/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Forrst URL</h4>
															
															<input type="text" id="social_forrst" name="social_forrst" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_forrst' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://forrst.me/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Last.fm URL</h4>
															
															<input type="text" id="social_lastfm" name="social_lastfm" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_lastfm' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://www.last.fm/user/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>SoundCloud URL</h4>
															
															<input type="text" id="boss_social_soundcloud" name="boss_social_soundcloud" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_soundcloud' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://soundcloud.com/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>MySpace URL</h4>
															
															<input type="text" id="boss_social_myspace" name="boss_social_myspace" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_myspace' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://www.myspace.com/userID</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Vimeo URL</h4>
															
															<input type="text" id="social_vimeo" name="social_vimeo" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_vimeo' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://vimeo.com/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>YouTube URL</h4>
															
															<input type="text" id="social_youtube" name="social_youtube" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_youtube' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://www.youtube.com/user/username</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>PayPal URL</h4>
															
															<input type="text" id="boss_social_paypal" name="boss_social_paypal" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_paypal' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">mailto:email@address</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>RSS URL</h4>
															
															<input type="text" id="social_rss" name="social_rss" class="code2" style="width: 100%;" value="<?php echo get_option( 'boss_social_rss' ); ?>">
														
														</td>
														
														<td class="option-right">
														
															e.g.
															<br>
															<span class="code2">http://example.com/feed</span>
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<h4>Open Links</h4>
															
															<?php
															
																$boss_social_open_links = get_option( 'boss_social_open_links' );
																
															?>
															
															<select id="boss_social_open_links" name="boss_social_open_links" style="width: 100%;">
															
																<option <?php if ( $boss_social_open_links == 'In new tab' ) { echo 'selected="selected"'; } ?>>In new tab</option>
																<option <?php if ( $boss_social_open_links == 'In same tab' ) { echo 'selected="selected"'; } ?>>In same tab</option>
																
															</select>
														
														</td>
														
														<td class="option-right">
														
															
															
														</td>
													</tr>
													
													<tr>
														<td class="option-left">
														
															<input type="submit" name="submit" class="button button-primary button-large" value="Save Changes">
															
															<input type="hidden" name="settings-submit" value="Y">
														
														</td>
														
														<td class="option-right">
														
															Save changes
															
														</td>
													</tr>
													
												</table>
												
											</form>
											
										</div>
										<!-- end .inside -->
										
									</div>
									<!-- end .postbox -->
									
								<?php
								
								break;
								
								case 'shortcodes' :
								
									if ( esc_attr( @$_GET['saved'] ) == 'true' )
									{
										echo '<div class="updated below-h2"><p><strong>Changes saved.</strong></p></div>';
									}
									
								?>
								
									<div class="postbox">
									
										<div class="inside">
										
											To use BossSocial in your posts and pages you can use the shortcode:
											<br>
											<br>
											<code>[boss_social_icon type="" url=""]</code>
											<br>
											<br>
											You can use "type" parameter to select social icon eg:
											<br>
											<br>
											<code>[boss_social_icon type="facebook" url=""]</code>
											<br>
											<br>
											or:
											<br>
											<br>
											<code>[boss_social_icon type="twitter" url=""]</code>
											
										</div>
										<!-- end .inside -->
										
									</div>
									<!-- end .postbox -->
									
								<?php
								
								break;
								
							}
							// end tab content
						}
						// end settings page
					
					?>
					
				</div>
				<!-- end #poststuff -->

			</div>
			<!-- end .wrap-boss-social -->

		<?php

	}
	// end boss_social_page
	
	
	function boss_social_save_changes()
	{
		global $pagenow;
		
		if ( $pagenow == 'admin.php' && $_GET['page'] == 'boss-social' )
		{
			if ( isset ( $_GET['tab'] ) )
			{
				$tab = $_GET['tab'];
			}
			else
			{
				$tab = 'social-icons';
			}

			
			switch ( $tab )
			{
				case 'social-icons' :
				
					update_option( 'boss_social_facebook', esc_attr( $_POST['social_facebook'] ) );
					update_option( 'boss_social_twitter', esc_attr( $_POST['social_twitter'] ) );
					update_option( 'boss_social_google', esc_attr( $_POST['social_google'] ) );
					update_option( 'boss_social_blogger', esc_attr( $_POST['boss_social_blogger'] ) );
					update_option( 'boss_social_tumblr', esc_attr( $_POST['social_tumblr'] ) );
					update_option( 'boss_social_wordpress', esc_attr( $_POST['boss_social_wordpress'] ) );
					update_option( 'boss_social_behance', esc_attr( $_POST['boss_social_behance'] ) );
					update_option( 'boss_social_pinterest', esc_attr( $_POST['social_pinterest'] ) );
					update_option( 'boss_social_stumbleupon', esc_attr( $_POST['boss_social_stumbleupon'] ) );
					update_option( 'boss_social_digg', esc_attr( $_POST['boss_social_digg'] ) );
					update_option( 'boss_social_delicious', esc_attr( $_POST['boss_social_delicious'] ) );
					update_option( 'boss_social_deviantart', esc_attr( $_POST['boss_social_deviantart'] ) );
					update_option( 'boss_social_linkedin', esc_attr( $_POST['social_linkedin'] ) );
					update_option( 'boss_social_skype', esc_attr( $_POST['social_skype'] ) );
					update_option( 'boss_social_flickr', esc_attr( $_POST['social_flickr'] ) );
					update_option( 'boss_social_picasa', esc_attr( $_POST['social_picasa'] ) );
					update_option( 'boss_social_instagram', esc_attr( $_POST['boss_social_instagram'] ) );
					update_option( 'boss_social_dribbble', esc_attr( $_POST['social_dribbble'] ) );
					update_option( 'boss_social_forrst', esc_attr( $_POST['social_forrst'] ) );
					update_option( 'boss_social_lastfm', esc_attr( $_POST['social_lastfm'] ) );
					update_option( 'boss_social_soundcloud', esc_attr( $_POST['boss_social_soundcloud'] ) );
					update_option( 'boss_social_myspace', esc_attr( $_POST['boss_social_myspace'] ) );
					update_option( 'boss_social_vimeo', esc_attr( $_POST['social_vimeo'] ) );
					update_option( 'boss_social_youtube', esc_attr( $_POST['social_youtube'] ) );
					update_option( 'boss_social_paypal', esc_attr( $_POST['boss_social_paypal'] ) );
					update_option( 'boss_social_rss', esc_attr( $_POST['social_rss'] ) );
					update_option( 'boss_social_open_links', esc_attr( $_POST['boss_social_open_links'] ) );
					
				break;
			}
			// end switch
		}
		// end if
	}
	// end boss_social_save_changes
	
	
	function boss_social_load_settings()
	{
		if ( @$_POST["settings-submit"] == 'Y' )
		{
			check_admin_referer( 'boss-social-settings-page' );
			
			boss_social_save_changes();
			
			$url_parameters = isset( $_GET['tab'] ) ? 'tab=' . $_GET['tab'] . '&saved=true' : 'saved=true';
			
			wp_redirect( admin_url( 'admin.php?page=boss-social&' . $url_parameters ) );
			
			exit;
		}
	}
	// end boss_social_load_settings


	function boss_social_menu()
	{
		$settings_page = add_menu_page( 'BossSocial',
										'BossSocial',
										'edit_theme_options',
										'boss-social',
										'boss_social_page',
										plugins_url( 'boss-social.png' , __FILE__ ) );
		
		add_action( "load-{$settings_page}", 'boss_social_load_settings' );
	}
	// end boss_social_menu

	add_action( 'admin_menu', 'boss_social_menu' );
	
?>