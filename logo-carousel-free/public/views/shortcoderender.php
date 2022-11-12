<?php
/**
 * This file render the shortcode to the frontend
 *
 * @package logo-carousel-free
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'SPLC_Shortcode_Render' ) ) {
	/**
	 * Logo Carousel - Shortcode Render class
	 *
	 * @since 3.0
	 */
	class SPLC_Shortcode_Render {
		/**
		 * Single instance of the class
		 *
		 * @var mixed SPLC_Shortcode_Render single instance of the class
		 *
		 * @since 3.0
		 */
		protected static $_instance = null;


		/**
		 * Main SPLC Instance
		 *
		 * @since 3.0
		 * @static
		 * @return self Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * SPLC_Shortcode_Render constructor.
		 */
		public function __construct() {
			add_shortcode( 'logocarousel', array( $this, 'sp_logo_carousel_render' ) );
		}

		/**
		 * Full html show.
		 *
		 * @param array $post_id Shortcode ID.
		 * @param array $logo_data get all meta options.
		 * @param array $main_section_title shows section title.
		 */
		public static function splcp_html_show( $post_id, $logo_data, $main_section_title ) {
			$columns             = isset( $logo_data['lcp_number_of_columns'] ) ? $logo_data['lcp_number_of_columns'] : '';
			$items               = isset( $columns['lg_desktop'] ) ? $columns['lg_desktop'] : 5;
			$items_desktop       = isset( $columns['desktop'] ) ? $columns['desktop'] : 4;
			$items_desktop_small = isset( $columns['tablet'] ) ? $columns['tablet'] : 3;
			$items_tablet        = isset( $columns['mobile_landscape'] ) ? $columns['mobile_landscape'] : 2;
			$items_mobile        = isset( $columns['mobile'] ) ? $columns['mobile'] : 1;
			$total_items         = isset( $logo_data['lcp_number_of_total_items'] ) && $logo_data['lcp_number_of_total_items'] ? $logo_data['lcp_number_of_total_items'] : 10000;
			// Navigation.
			$nav_data = isset( $logo_data['lcp_nav_show'] ) ? $logo_data['lcp_nav_show'] : '';
			if ( 'show' === $nav_data ) {
				$nav        = 'true';
				$nav_mobile = 'true';
			} elseif ( 'hide_on_mobile' === $nav_data ) {
				$nav        = 'true';
				$nav_mobile = 'false';
			} else {
				$nav        = 'false';
				$nav_mobile = 'false';
			}
			$dots_data = isset( $logo_data['lcp_carousel_dots'] ) ? $logo_data['lcp_carousel_dots'] : '';
			if ( 'show' === $dots_data ) {
				$dots        = 'true';
				$dots_mobile = 'true';
			} elseif ( 'hide_on_mobile' === $dots_data ) {
				$dots        = 'true';
				$dots_mobile = 'false';
			} else {
				$dots        = 'false';
				$dots_mobile = 'false';
			}
			$auto_play      = isset( $logo_data['lcp_carousel_auto_play'] ) && $logo_data['lcp_carousel_auto_play'] ? 'true' : 'false';
			$pause_on_hover = isset( $logo_data['lcp_carousel_pause_on_hover'] ) && $logo_data['lcp_carousel_pause_on_hover'] ? 'true' : 'false';
			$swipe          = isset( $logo_data['lcp_carousel_swipe'] ) && $logo_data['lcp_carousel_swipe'] ? 'true' : 'false';
			$draggable      = isset( $logo_data['lcp_carousel_draggable'] ) && $logo_data['lcp_carousel_draggable'] ? 'true' : 'false';
			$free_mode      = isset( $logo_data['lcp_free_mode'] ) && $logo_data['lcp_free_mode'] ? 'true' : 'false';
			$infinite       = 'true';
			if ( isset( $logo_data['lcp_carousel_infinite'] ) ) {
				$infinite = $logo_data['lcp_carousel_infinite'] ? 'true' : 'false';
			}
			$logo_border = isset( $logo_data['lc_logo_border'] ) ? $logo_data['lc_logo_border'] : true;
			$rtl_mode    = isset( $logo_data['lcp_rtl_mode'] ) ? $logo_data['lcp_rtl_mode'] : 'false';
			$rtl         = ( 'true' == $rtl_mode ) ? 'rtl' : 'ltr';

			$autoplay_speed   = isset( $logo_data['lcp_carousel_auto_play_speed'] ) ? $logo_data['lcp_carousel_auto_play_speed'] : '3000';
			$pagination_speed = isset( $logo_data['lcp_carousel_scroll_speed'] ) ? $logo_data['lcp_carousel_scroll_speed'] : '600';

			$section_title         = isset( $logo_data['lcp_section_title'] ) ? $logo_data['lcp_section_title'] : 'false';
			$order_by              = isset( $logo_data['lcp_item_order_by'] ) ? $logo_data['lcp_item_order_by'] : 'date';
			$order                 = isset( $logo_data['lcp_item_order'] ) ? $logo_data['lcp_item_order'] : 'ASC';
			$preloader             = isset( $logo_data['lcp_preloader'] ) ? $logo_data['lcp_preloader'] : false;
			$show_image            = isset( $logo_data['lcp_logo_image'] ) ? $logo_data['lcp_logo_image'] : true;
			$image_sizes           = isset( $logo_data['lcp_image_sizes'] ) ? $logo_data['lcp_image_sizes'] : '';
			$show_image_title_attr = isset( $logo_data['lcp_image_title_attr'] ) ? $logo_data['lcp_image_title_attr'] : false;
			$logo_margin           = isset( $logo_data['lcp_logo_margin']['all'] ) && ! empty( $logo_data['lcp_logo_margin']['all'] ) ? $logo_data['lcp_logo_margin']['all'] : '12';

			$args = new WP_Query(
				array(
					'post_type'      => 'sp_logo_carousel',
					'orderby'        => $order_by,
					'order'          => $order,
					'posts_per_page' => intval( $total_items ),
				)
			);

			// wp_enqueue_style( 'sp-lc-swiper' );
			// wp_enqueue_style( 'sp-lc-font-awesome' );
			// wp_enqueue_style( 'sp-lc-style' );
			// // Enqueue Script.
			// wp_enqueue_script( 'sp-lc-swiper-js' );
			// wp_enqueue_script( 'sp-lc-script' );

			// swiper data attributes.
			$swiper_data_attr = 'data-carousel=\'{ "speed":' . esc_attr( $pagination_speed ) . ',"spaceBetween": ' . esc_attr( $logo_margin ) . ', "autoplay": ' . esc_attr( $auto_play ) . ', "infinite":' . esc_attr( $infinite ) . ', "autoplay_speed": ' . esc_attr( $autoplay_speed ) . ', "stop_onHover": ' . esc_attr( $pause_on_hover ) . ', "pagination": ' . esc_attr( $dots ) . ', "navigation": ' . esc_attr( $nav ) . ', "MobileNav": ' . esc_attr( $nav_mobile ) . ', "MobilePagi": ' . esc_attr( $dots_mobile ) . ', "simulateTouch": ' . esc_attr( $draggable ) . ',"freeMode": ' . esc_attr( $free_mode ) . ', "allowTouchMove": ' . esc_attr( $swipe ) . ', "slidesPerView": { "lg_desktop": ' . esc_attr( $items ) . ', "desktop": ' . esc_attr( $items_desktop ) . ', "tablet": ' . esc_attr( $items_desktop_small ) . ', "mobile": ' . esc_attr( $items_mobile ) . ', "mobile_landscape": ' . esc_attr( $items_tablet ) . ' } }\'';

			$output          = '';
			$preloader_class = '';
			require SP_LC_PATH . 'public/views/templates/carousel.php';
			echo $output;
		}

		/**
		 * Shortcode render
		 *
		 * @param  mixed $attribute attributes.
		 * @return mixed
		 */
		public function sp_logo_carousel_render( $attribute ) {
			if ( empty( $attribute['id'] ) || ( get_post_status( $attribute['id'] ) === 'trash' ) || ( get_post_status( $attribute['id'] ) === 'draft' ) ) {
				return;
			}
			$post_id      = $attribute['id'];
			$setting_data = get_option( '_sp_lcpro_options' );
			// All Options of Shortcode.
			$logo_data = get_post_meta( $post_id, 'sp_lcp_shortcode_options', true );
			ob_start();
			// Stylesheet loading problem solving here. Shortcode id to push page id option for getting how many shortcode in the page.
			$current_page_id    = get_queried_object_id();
			$option_key         = 'sp_lcp_page_id' . $current_page_id;
			$found_generator_id = get_option( $option_key );
			if ( is_multisite() ) {
				$option_key         = 'sp_lcp_page_id' . get_current_blog_id() . $current_page_id;
				$found_generator_id = get_site_option( $option_key );
			}
			if ( ! is_array( $found_generator_id ) || ! $found_generator_id || ! in_array( $post_id, $found_generator_id ) ) {
				wp_enqueue_style( 'sp-lc-swiper' );
				wp_enqueue_style( 'sp-lc-font-awesome' );
				wp_enqueue_style( 'sp-lc-style' );
				$custom_css  = isset( $setting_data['lcpro_custom_css'] ) ? trim( html_entity_decode( $setting_data['lcpro_custom_css'] ) ) : '';
				$dynamic_css = '';
				require SP_LC_PATH . 'public/views/dynamic-style.php';
				if ( ! empty( $custom_css ) ) {
					$dynamic_css .= $custom_css;
				}
				echo '<style id="sp_lcp_dynamic_css' . $post_id . '">' . $dynamic_css . '</style>';
			}
			if ( $found_generator_id ) {
				$found_generator_id = is_array( $found_generator_id ) ? $found_generator_id : array( $found_generator_id );
				if ( ! in_array( $post_id, $found_generator_id ) || empty( $found_generator_id ) ) { // If not found the shortcode id in the page options.
					array_push( $found_generator_id, $post_id );
					if ( is_multisite() ) {
						update_site_option( $option_key, $found_generator_id );
					} else {
						update_option( $option_key, $found_generator_id );
					}
				}
			} else { // If option not set in current page add option.
				if ( $current_page_id ) {
					if ( is_multisite() ) {
						add_site_option( $option_key, array( $post_id ) );
					} else {
						add_option( $option_key, array( $post_id ) );
					}
				}
			}

			$main_section_title = get_the_title( $post_id );
			self::splcp_html_show( $post_id, $logo_data, $main_section_title );
			return ob_get_clean();
		}

	}

	new SPLC_Shortcode_Render();
}
