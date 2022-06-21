<?php
/**
 * Framework fields.class file.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/public
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'WCGS_Fields' ) ) {
	/**
	 *
	 * Fields Class
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	abstract class WCGS_Fields extends WCGS_Abstract {

		/**
		 * Field class constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct( $field = array(), $value = '', $unique = '', $where = '', $parent = '' ) {

			$this->field  = $field;
			$this->value  = $value;
			$this->unique = $unique;
			$this->where  = $where;
			$this->parent = $parent;
		}

		/**
		 * Field name method.
		 *
		 * @param string $nested_name Nested field name.
		 * @return string
		 */
		public function field_name( $nested_name = '' ) {

			$field_id   = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
			$unique_id  = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $field_id . ']' : $field_id;
			$field_name = ( ! empty( $this->field['name'] ) ) ? $this->field['name'] : $unique_id;
			$tag_prefix = ( ! empty( $this->field['tag_prefix'] ) ) ? $this->field['tag_prefix'] : '';

			if ( ! empty( $tag_prefix ) ) {
				$nested_name = str_replace( '[', '[' . $tag_prefix, $nested_name );
			}

			return $field_name . $nested_name;

		}

		/**
		 * Field attributes.
		 *
		 * @param array $custom_atts Custom attributes.
		 * @return mixed
		 */
		public function field_attributes( $custom_atts = array() ) {

			$field_id   = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
			$attributes = ( ! empty( $this->field['attributes'] ) ) ? $this->field['attributes'] : array();

			if ( ! empty( $field_id ) ) {
				$attributes['data-depend-id'] = $field_id;
			}

			if ( ! empty( $this->field['placeholder'] ) ) {
				$attributes['placeholder'] = $this->field['placeholder'];
			}

			$attributes = wp_parse_args( $attributes, $custom_atts );

			$atts = '';

			if ( ! empty( $attributes ) ) {
				foreach ( $attributes as $key => $value ) {
					if ( 'only-key' === $value ) {
						$atts .= ' ' . esc_attr( $key );
					} else {
						$atts .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
					}
				}
			}

			return $atts;

		}

		/**
		 * Field before.
		 *
		 * @return mixed
		 */
		public function field_before() {
			return ( ! empty( $this->field['before'] ) ) ? $this->field['before'] : '';
		}

		/**
		 * Field after.
		 *
		 * @return mixed
		 */
		public function field_after() {

			$output  = ( ! empty( $this->field['after'] ) ) ? $this->field['after'] : '';
			$output .= ( ! empty( $this->field['desc'] ) ) ? '<p class="wcgs-text-desc">' . $this->field['desc'] . '</p>' : '';
			$output .= ( ! empty( $this->field['help'] ) ) ? '<span class="wcgs-help"><span class="wcgs-help-text">' . $this->field['help'] . '</span><span class="fa fa-question-circle"></span></span>' : '';
			$output .= ( ! empty( $this->field['_error'] ) ) ? '<p class="wcgs-text-error">' . $this->field['_error'] . '</p>' : '';

			return $output;

		}

		/**
		 * Field Data.
		 *
		 * @param array $type post types.
		 *
		 * @return statement
		 */
		public function field_data( $type = '' ) {

			$options    = array();
			$query_args = ( ! empty( $this->field['query_args'] ) ) ? $this->field['query_args'] : array();

			switch ( $type ) {

				case 'page':
				case 'pages':
					$pages = get_pages( $query_args );

					if ( ! is_wp_error( $pages ) && ! empty( $pages ) ) {
						foreach ( $pages as $page ) {
							$options[ $page->ID ] = $page->post_title;
						}
					}

					break;

				case 'post':
				case 'posts':
					$posts = get_posts( $query_args );

					if ( ! is_wp_error( $posts ) && ! empty( $posts ) ) {
						foreach ( $posts as $post ) {
							$options[ $post->ID ] = $post->post_title;
						}
					}

					break;

				case 'category':
				case 'categories':
					$categories = get_categories( $query_args );

					if ( ! is_wp_error( $categories ) && ! empty( $categories ) && ! isset( $categories['errors'] ) ) {
						foreach ( $categories as $category ) {
							$options[ $category->term_id ] = $category->name;
						}
					}

					break;

				case 'tag':
				case 'tags':
					$taxonomies = ( isset( $query_args['taxonomies'] ) ) ? $query_args['taxonomies'] : 'post_tag';
					$tags       = get_terms( $taxonomies, $query_args );

					if ( ! is_wp_error( $tags ) && ! empty( $tags ) ) {
						foreach ( $tags as $tag ) {
							$options[ $tag->term_id ] = $tag->name;
						}
					}

					break;

				case 'menu':
				case 'menus':
					$menus = wp_get_nav_menus( $query_args );

					if ( ! is_wp_error( $menus ) && ! empty( $menus ) ) {
						foreach ( $menus as $menu ) {
							$options[ $menu->term_id ] = $menu->name;
						}
					}

					break;

				case 'post_type':
				case 'post_types':
					$post_types = get_post_types(
						array(
							'show_in_nav_menus' => true,
						)
					);

					if ( ! is_wp_error( $post_types ) && ! empty( $post_types ) ) {
						foreach ( $post_types as $post_type ) {
							$options[ $post_type ] = ucfirst( $post_type );
						}
					}

					break;

				case 'sidebar':
				case 'sidebars':
					global $wp_registered_sidebars;

					if ( ! empty( $wp_registered_sidebars ) ) {
						foreach ( $wp_registered_sidebars as $sidebar ) {
							$options[ $sidebar['id'] ] = $sidebar['name'];
						}
					}

					break;

				case 'role':
				case 'roles':
					global $wp_roles;

					if ( is_object( $wp_roles ) ) {
						$roles = $wp_roles->get_names();
						if ( ! empty( $wp_roles ) ) {
							foreach ( $roles as $key => $value ) {
								$options[ $key ] = $value;
							}
						}
					}

					break;

				default:
					if ( function_exists( $type ) ) {
						$options = call_user_func( $type, $this->value, $this->field );
					}
					break;

			}

			return $options;

		}

	}
}

