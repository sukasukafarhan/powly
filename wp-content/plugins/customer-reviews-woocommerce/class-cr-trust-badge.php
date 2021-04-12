<?php

if (! defined('ABSPATH')) {
	exit;
}

if (! class_exists('CR_Trust_Badge')) :

	class CR_Trust_Badge
	{

		/**
		* @var array holds the current shorcode attributes
		*/
		public $shortcode_atts;
		protected $lang;

		public function __construct() {
			if ( 'yes' === get_option( 'ivole_reviews_verified', 'no' ) ) {
				$this->register_shortcode();
				$this->lang = CR_Trust_Badge::get_badge_language();
				add_action( 'init', array( 'CR_Reviews_Grid', 'cr_register_blocks_script' ) );
				add_action( 'enqueue_block_assets', array( 'CR_Reviews_Grid', 'cr_enqueue_block_scripts' ) );
				add_action( 'init', array( $this, 'register_block' ) );
			}
		}

		public function register_shortcode() {
			add_shortcode( 'cusrev_trustbadge', array( $this, 'render_trustbadge_shortcode' ) );
		}

		public function render_trustbadge_shortcode( $attributes ) {
			$defaults = array(
				'type' => 'sl',
				'border' => 'yes',
				'color' => ''
			);
			if ( isset( $attributes['type'] ) ) {
				$type = str_replace( ' ', '', $attributes['type'] );
				$type = strtolower( $type );
				$allowed_types = array( 'sl', 'slp', 'sd', 'sdp', 'wl', 'wlp', 'wd', 'wdp', 'vsl', 'vsd' );
				if( in_array( $type, $allowed_types ) ) {
					$attributes['type'] = $type;
				} else {
					$attributes['type'] = null;
				}
			}
			if ( isset( $attributes['border'] ) ) {
				$border = str_replace( ' ', '', $attributes['border'] );
				$border = strtolower( $border );
				$allowed_borders = array( 'yes', 'no' );
				if( in_array( $border, $allowed_borders ) ) {
					$attributes['border'] = $border;
				} else {
					$attributes['border'] = 'yes';
				}
			}
			if ( isset( $attributes['color'] ) ) {
				$color = str_replace( ' ', '', $attributes['color'] );
				$color = strtolower( $color );
				if( preg_match( '/#([a-f0-9]{3}){1,2}\b/i', $color ) ) {
					$attributes['color'] = $color;
				} else {
					$attributes['color'] = '';
				}
			}
			$this->shortcode_atts = shortcode_atts( $defaults, $attributes );
			return $this->show_trust_badge();
		}

		public function show_trust_badge()
		{
			$l_suffix = '';
			$site_lang = '';
			if( 'en' !== $this->lang ) {
				$l_suffix = '-' . $this->lang;
				$site_lang = $this->lang . '/';
			}
			$color = '';
			if( 0 < strlen( $this->shortcode_atts['color'] ) ) {
				$color = '" style="background-color:' . $this->shortcode_atts['color'] . ';';
			}
			$class_img = 'ivole-trustbadgefi-' . $this->shortcode_atts['type'] . ' ivole-trustbadgefi-b' . $this->shortcode_atts['border'];
			$return = '<div id="ivole_trustbadgef_' . $this->shortcode_atts['type'] . '" class="ivole-trustbadgef-' . $this->shortcode_atts['type'] . '">';
			$return .= '<a href="https://www.cusrev.com/' . $site_lang . 'reviews/' . get_option( 'ivole_reviews_verified_page', Ivole_Email::get_blogdomain() ) . '" rel="nofollow" target="_blank">';
			if( 'wdp' === $this->shortcode_atts['type'] ) {
				$return .= '<picture><source media="(min-width: 500px)" srcset="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . $this->shortcode_atts['type'] . $l_suffix . '.png' . '">';
				$return .= '<source media="(min-width: 10px)" srcset="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . 'wdpm' . $l_suffix . '.png' . '">';
				$return .= '<img id="ivole_trustbadgefi_' . $this->shortcode_atts['type'] . '" class="' . $class_img . '" src="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . $this->shortcode_atts['type'] . $l_suffix . '.png' . $color . '" alt="' . __( 'Trust Badge', 'customer-reviews-woocommerce' ) . '">';
				$return .= '</picture>';
			} elseif ('wd' === $this->shortcode_atts['type']) {
				$return .= '<picture><source media="(min-width: 500px)" srcset="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . $this->shortcode_atts['type'] . $l_suffix . '.png' . '">';
				$return .= '<source media="(min-width: 10px)" srcset="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . 'wdm' . $l_suffix . '.png' . '">';
				$return .= '<img id="ivole_trustbadgefi_' . $this->shortcode_atts['type'] . '" class="' . $class_img . '" src="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . $this->shortcode_atts['type'] . $l_suffix . '.png' . $color . '" alt="' . __( 'Trust Badge', 'customer-reviews-woocommerce' ) . '">';
				$return .= '</picture>';
			} elseif ('wlp' === $this->shortcode_atts['type']) {
				$return .= '<picture><source media="(min-width: 500px)" srcset="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . $this->shortcode_atts['type'] . $l_suffix . '.png' . '">';
				$return .= '<source media="(min-width: 10px)" srcset="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . 'wlpm' . $l_suffix . '.png' . '">';
				$return .= '<img id="ivole_trustbadgefi_' . $this->shortcode_atts['type'] . '" class="' . $class_img . '" src="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . $this->shortcode_atts['type'] . $l_suffix . '.png' . $color . '" alt="' . __( 'Trust Badge', 'customer-reviews-woocommerce' ) . '">';
				$return .= '</picture>';
			} elseif ('wl' === $this->shortcode_atts['type']) {
				$return .= '<picture><source media="(min-width: 500px)" srcset="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . $this->shortcode_atts['type'] . $l_suffix . '.png' . '">';
				$return .= '<source media="(min-width: 10px)" srcset="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . 'wlm' . $l_suffix . '.png' . '">';
				$return .= '<img id="ivole_trustbadgefi_' . $this->shortcode_atts['type'] . '" class="' . $class_img . '" src="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . $this->shortcode_atts['type'] . $l_suffix . '.png' . $color . '" alt="' . __( 'Trust Badge', 'customer-reviews-woocommerce' ) . '">';
				$return .= '</picture>';
			} else {
				$return .= '<img id="ivole_trustbadgefi_' . $this->shortcode_atts['type'] . '" class="' . $class_img . '" src="' . 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . $this->shortcode_atts['type'] . $l_suffix . '.png' . $color . '" alt="' . __( 'Trust Badge', 'customer-reviews-woocommerce' ) . '">';
			}
			$return .= '</a></div>';
			return $return;
		}

		/**
		* Registers the trustbadge block
		*
		* @since 3.53
		*/
		public static function register_block() {
			// Only register the block if the WP is at least 5.0, or gutenberg is installed.
			if ( function_exists( 'register_block_type' ) ) {
				register_block_type( 'ivole/cusrev-trustbadge', array(
					'attributes' => array(
						'badge_size' => array(
							'type' => 'string',
							'enum' => array( 'small', 'wide', 'compact' ),
							'default' => 'small'
						),
						'badge_style' => array(
							'type' => 'string',
							'enum' => array( 'light', 'dark' ),
							'default' => 'light'
						),
						'store_rating' => array(
							'type' => 'boolean',
							'default' => false
						),
						'badge_border' => array(
							'type' => 'boolean',
							'default' => true
						),
						'badge_color' => array(
							'type' => 'string',
							'default' => '#ffffff'
						)
					),
					'render_callback' => array( self::class, 'render_block' )
				) );
			}
		}

		/**
		* Render the trust_badges block
		*
		* @since 3.53
		*
		* @param array $block_attributes An array of block attributes
		*
		* @return string
		*/
		public static function render_block( $block_attributes ) {
			// If trust badges are not enabled, display nothing.
			if ( get_option( 'ivole_reviews_verified', 'no' ) === 'no' ) {
				return '';
			}

			switch( $block_attributes['badge_size'] ) {
				case 'small':
				$badge_type = 's';
				break;
				case 'wide':
				$badge_type = 'w';
				break;
				case 'compact':
				$badge_type = 'vs';
				$block_attributes['store_rating']  = '';
				break;
				default:
				$badge_type = 's';
				break;
			}
			$badge_type .= $block_attributes['badge_style'] === 'light' ? 'l' : 'd';
			$badge_type .= $block_attributes['store_rating'] ? 'p' : '';

			$badge_border = $block_attributes['badge_border'] ? 'yes': 'no';

			$badge_color = $block_attributes['badge_color'];
			$color = str_replace( ' ', '', $badge_color );
			$color = strtolower( $badge_color );
			if( preg_match( '/#([a-f0-9]{3}){1,2}\b/i', $color ) ) {
				$color = '" style="background-color:' . $color . ';';
			} else {
				$color = '';
			}

			$l_suffix = '';
			$site_lang = '';
			$lng = CR_Trust_Badge::get_badge_language();
			if( 'en' !== $lng ) {
				$l_suffix = '-' . $lng;
				$site_lang = $lng . '/';
			}

			$verified_reviews_page = get_option( 'ivole_reviews_verified_page', Ivole_Email::get_blogdomain() );
			$badge_img_src = 'https://www.cusrev.com/badges/' . Ivole_Email::get_blogurl() . '-' . $badge_type . $l_suffix . '.png';

			$class_img = 'ivole-trustbadgefi-' . $badge_type . ' ivole-trustbadgefi-b' . $badge_border;
			$return = '<div id="ivole_trustbadgef_' . $badge_type . '" class="ivole-trustbadgef-' . $badge_type . '">';
			$return .= '<a href="https://www.cusrev.com/' . $site_lang . 'reviews/' . $verified_reviews_page . '" rel="nofollow" target="_blank"><img id="ivole_trustbadgefi_' . $badge_type . '" class="' . $class_img . '" src="' . $badge_img_src . $color . '" alt="' . __( 'Trust Badge', 'customer-reviews-woocommerce' ) . '"></a>';
			$return .= '</div>';

			return $return;
		}

		public static function get_badge_language() {
			$language = 'en';
			$blog_language = get_bloginfo( 'language', 'display' );
			if( is_string( $blog_language ) ) {
				$blog_language = substr( $blog_language, 0, 2 );
				if( 2 === strlen( $blog_language ) ) {
					$language = strtolower( $blog_language );
				}
				// special case for Norwegian language
				if( 'nb' === $language || 'nn' === $language ) {
					$language = 'no';
				}
			}
			return $language;
		}

		public function cr_enqueue_block_scripts() {
			global $current_screen;

			wp_register_style( 'ivole-frontend-css', plugins_url( '/css/frontend.css', __FILE__ ), array(), null, 'all' );
			wp_enqueue_style( 'ivole-frontend-css' );

			if ( ( $current_screen instanceof WP_Screen ) && $current_screen->is_block_editor() ) {
				wp_enqueue_script( 'ivole-blocks' );
			}
		}

	}

endif;
