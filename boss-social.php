<?php
/*
Plugin Name: BossSocial
Plugin URI: http://profiles.wordpress.org/the-boss-1
Description: Provides a widget that allows you to easily share your social profiles on your website.
Version: 1.0
Author: The Boss
Author URI: http://profiles.wordpress.org/the-boss-1
License: GPLv2 or later

Copyright (c) 2012, The Boss. 
This program is free software; you can redistribute it and/or 
modify it under the terms of the GNU General Public License 
as published by the Free Software Foundation; either version 2 
of the License, or (at your option) any later version. 
This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
GNU General Public License for more details. 
You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA. 
*/

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
	
	function boss_social_site_enqueue()
	{
		// Register style
		wp_register_style( 'boss-social-widget', plugins_url( 'boss-social-widget.css' , __FILE__ ), null, null );
		
		// Enqueue style
		wp_enqueue_style( 'boss-social-widget' );
	}
	// end boss_social_site_enqueue
	
	add_action( 'wp_enqueue_scripts', 'boss_social_site_enqueue' );
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	if ( is_admin() )
	{
		function boss_social_admin_enqueue()
		{
			// Register style
			wp_register_style( 'boss-social-admin', plugins_url( 'boss-social-admin.css' , __FILE__ ), null, null );
			
			// Enqueue style
			wp_enqueue_style( 'boss-social-admin' );
		}
		// end boss_social_admin_enqueue

		add_action( 'admin_enqueue_scripts', 'boss_social_admin_enqueue' );
		
		
		include_once 'boss-social-admin.php';
		
	}
	// end if is_admin
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
	
	class Boss_Social_Icons_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('boss_social_icons_widget',
								__( 'BossSocial', 'boss-social' ),
								array( 'description' => __( 'Displays your BossSocial profiles', 'boss-social' ) ) );
		}
		
		
		public function form( $instance )
		{
			if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; } else { $title = ""; }
		?>
		
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title:', 'boss-social' ); ?></label>
				
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>">
			</p>
			
		<?php
		}
		// end form
		
		
		public function update( $new_instance, $old_instance )
		{
			$instance = array();
			
			$instance['title'] = strip_tags( $new_instance['title'] );

			return $instance;
		}
		// end update

		
		public function widget( $args, $instance )
		{
			extract( $args );
			
			$title = apply_filters( 'widget_title', $instance['title'] );

			echo $before_widget;
			
			
			if ( ! empty( $title ) )
			{
				echo $before_title . $title . $after_title;
			}
			
			
			if ( get_option( 'boss_social_open_links' ) != 'In same tab' )
			{
				$open_links = 'target="_blank"';
			}
			else
			{
				$open_links = "";
			}
			
			
			echo '<div class="boss-social">';
				
				if ( get_option( 'boss_social_facebook' ) != "" ) { echo '<a ' . $open_links . ' class="facebook" href="' . get_option( 'boss_social_facebook' ) . '">Facebook</a>'; }
				if ( get_option( 'boss_social_twitter' ) != "" ) { echo '<a ' . $open_links . ' class="twitter" href="' . get_option( 'boss_social_twitter' ) . '">Twitter</a>'; }
				if ( get_option( 'boss_social_google' ) != "" ) { echo '<a ' . $open_links . ' class="google" href="' . get_option( 'boss_social_google' ) . '">Google+</a>'; }
				
				if ( get_option( 'boss_social_blogger' ) != "" ) { echo '<a ' . $open_links . ' class="blogger" href="' . get_option( 'boss_social_blogger' ) . '">Blogger</a>'; }
				if ( get_option( 'boss_social_tumblr' ) != "" ) { echo '<a ' . $open_links . ' class="tumblr" href="' . get_option( 'boss_social_tumblr' ) . '">Tumblr</a>'; }
				if ( get_option( 'boss_social_wordpress' ) != "" ) { echo '<a ' . $open_links . ' class="wordpress" href="' . get_option( 'boss_social_wordpress' ) . '">WordPress</a>'; }
				if ( get_option( 'boss_social_behance' ) != "" ) { echo '<a ' . $open_links . ' class="behance" href="' . get_option( 'boss_social_behance' ) . '">Behance</a>'; }
				
				if ( get_option( 'boss_social_pinterest' ) != "" ) { echo '<a ' . $open_links . ' class="pinterest" href="' . get_option( 'boss_social_pinterest' ) . '">Pinterest</a>'; }
				if ( get_option( 'boss_social_stumbleupon' ) != "" ) { echo '<a ' . $open_links . ' class="stumbleupon" href="' . get_option( 'boss_social_stumbleupon' ) . '">StumbleUpon</a>'; }
				if ( get_option( 'boss_social_digg' ) != "" ) { echo '<a ' . $open_links . ' class="digg" href="' . get_option( 'boss_social_digg' ) . '">Digg</a>'; }
				if ( get_option( 'boss_social_delicious' ) != "" ) { echo '<a ' . $open_links . ' class="delicious" href="' . get_option( 'boss_social_delicious' ) . '">Delicious</a>'; }
				if ( get_option( 'boss_social_deviantart' ) != "" ) { echo '<a ' . $open_links . ' class="deviantart" href="' . get_option( 'boss_social_deviantart' ) . '">Deviantart</a>'; }
				
				if ( get_option( 'boss_social_linkedin' ) != "" ) { echo '<a ' . $open_links . ' class="linkedin" href="' . get_option( 'boss_social_linkedin' ) . '">LinkedIn</a>'; }
				
				if ( get_option( 'boss_social_skype' ) != "" ) { echo '<a ' . $open_links . ' class="skype" href="' . get_option( 'boss_social_skype' ) . '">Skype</a>'; }
				
				if ( get_option( 'boss_social_flickr' ) != "" ) { echo '<a ' . $open_links . ' class="flickr" href="' . get_option( 'boss_social_flickr' ) . '">Flickr</a>'; }
				if ( get_option( 'boss_social_picasa' ) != "" ) { echo '<a ' . $open_links . ' class="picassa" href="' . get_option( 'boss_social_picasa' ) . '">Picassa</a>'; }
				if ( get_option( 'boss_social_instagram' ) != "" ) { echo '<a ' . $open_links . ' class="instagram" href="' . get_option( 'boss_social_instagram' ) . '">Instagram</a>'; }
				
				if ( get_option( 'boss_social_dribbble' ) != "" ) { echo '<a ' . $open_links . ' class="dribble" href="' . get_option( 'boss_social_dribbble' ) . '">Dribble</a>'; }
				if ( get_option( 'boss_social_forrst' ) != "" ) { echo '<a ' . $open_links . ' class="forrst" href="' . get_option( 'boss_social_forrst' ) . '">Forrst</a>'; }
				
				if ( get_option( 'boss_social_lastfm' ) != "" ) { echo '<a ' . $open_links . ' class="lastfm" href="' . get_option( 'boss_social_lastfm' ) . '">Last.fm</a>'; }
				if ( get_option( 'boss_social_soundcloud' ) != "" ) { echo '<a ' . $open_links . ' class="soundcloud" href="' . get_option( 'boss_social_soundcloud' ) . '">SoundCloud</a>'; }
				if ( get_option( 'boss_social_myspace' ) != "" ) { echo '<a ' . $open_links . ' class="myspace" href="' . get_option( 'boss_social_myspace' ) . '">MySpace</a>'; }
				
				if ( get_option( 'boss_social_vimeo' ) != "" ) { echo '<a ' . $open_links . ' class="vimeo" href="' . get_option( 'boss_social_vimeo' ) . '">Vimeo</a>'; }
				if ( get_option( 'boss_social_youtube' ) != "" ) { echo '<a ' . $open_links . ' class="youtube" href="' . get_option( 'boss_social_youtube' ) . '">YouTube</a>'; }
				
				if ( get_option( 'boss_social_paypal' ) != "" ) { echo '<a ' . $open_links . ' class="paypal" href="' . get_option( 'boss_social_paypal' ) . '">PayPal</a>'; }
				
				if ( get_option( 'boss_social_rss' ) != "" ) { echo '<a ' . $open_links . ' class="rss" href="' . get_option( 'boss_social_rss' ) . '">RSS</a>'; }
				
			echo '</div>';
			
			echo $after_widget;
		}
		// end widget

	}
	// end class Boss_Social_Icons_Widget

	add_action( 'widgets_init', create_function( "", 'register_widget( "boss_social_icons_widget" );' ) );
	
/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */

	function boss_social_icon( $atts, $content = "" )
	{
		extract( shortcode_atts( array( 'type' => "",
										'url' => "" ), $atts ) );
		
		$boss_social_icon =  '<div class="boss-social"><a target="_blank" class="' . $type . '" href="' . $url . '">' . $type . '</a></div>';
		
		return $boss_social_icon;
	}
	
	add_shortcode( 'boss_social_icon', 'boss_social_icon' );

/* ------------------------------------------------------------------------------------------------------------------------------------------------------ */
	
?>