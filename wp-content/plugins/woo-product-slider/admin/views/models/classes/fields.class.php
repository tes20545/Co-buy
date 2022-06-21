<?php
/**
 * Framework fields.class file.
 *
 * @link http://shapedplugin.com
 * @since 2.0.0
 * @package Woo_Product_Slider.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPWPS_Fields' ) ) {
	/**
	 *
	 * Fields Class
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	abstract class SPWPS_Fields extends SPWPS_Abstract {

		/**
		 * Constructor function.
		 *
		 * @param array  $field field.
		 * @param string $value field value.
		 * @param string $unique field unique.
		 * @param string $where field where.
		 * @param string $parent field parent.
		 * @since 2.0
		 */
		public function __construct( $field = array(), $value = '', $unique = '', $where = '', $parent = '' ) {
			$this->field  = $field;
			$this->value  = $value;
			$this->unique = $unique;
			$this->where  = $where;
			$this->parent = $parent;
		}

		/**
		 * Field name function.
		 *
		 * @param string $nested_name Nested name.
		 * @since 2.0
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
		 * @param array $custom_atts Field attributes.
		 * @since 2.0
		 */
		public function field_attributes( $custom_atts = array() ) {

			$field_id   = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
			$attributes = ( ! empty( $this->field['attributes'] ) ) ? $this->field['attributes'] : array();

			if ( ! empty( $field_id ) && empty( $attributes['data-depend-id'] ) ) {
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
		 */
		public function field_before() {
			return ( ! empty( $this->field['before'] ) ) ? wp_kses_post( $this->field['before'] ) : '';
		}

		/**
		 * Field after.
		 */
		public function field_after() {

			$output  = ( ! empty( $this->field['after'] ) ) ? wp_kses_post( $this->field['after'] ) : '';
			$output .= ( ! empty( $this->field['desc'] ) ) ? '<div class="clear"></div><div class="spwps-text-desc">' . wp_kses_post( $this->field['desc'] ) . '</div>' : '';
			$output .= ( ! empty( $this->field['help'] ) ) ? '<div class="spwps-help"><span class="spwps-help-text">' . wp_kses_post( $this->field['help'] ) . '</span><i class="fas fa-question-circle"></i></div>' : '';
			$output .= ( ! empty( $this->field['_error'] ) ) ? '<div class="spwps-text-error">' . wp_kses_post( $this->field['_error'] ) . '</div>' : '';

			return $output;

		}

		/**
		 * Field data.
		 *
		 * @param string  $type field data type.
		 * @param boolean $term field data boolean.
		 * @param array   $query_args field data args.
		 */
		public static function field_data( $type = '', $term = false, $query_args = array() ) {

			$options      = array();
			$array_search = false;

			// sanitize type name.
			if ( in_array( $type, array( 'page', 'pages' ), true ) ) {
				$option = 'page';
			} elseif ( in_array( $type, array( 'post', 'posts' ), true ) ) {
				$option = 'post';
			} elseif ( in_array( $type, array( 'category', 'categories' ), true ) ) {
				$option = 'category';
			} elseif ( in_array( $type, array( 'tag', 'tags' ), true ) ) {
				$option = 'post_tag';
			} elseif ( in_array( $type, array( 'menu', 'menus' ), true ) ) {
				$option = 'nav_menu';
			} else {
				$option = '';
			}

			// switch type.
			switch ( $type ) {

				case 'page':
				case 'pages':
				case 'post':
				case 'posts':
					// term query required for ajax select.
					if ( ! empty( $term ) ) {

						$query = new WP_Query(
							wp_parse_args(
								$query_args,
								array(
									's'              => $term,
									'post_type'      => $option,
									'post_status'    => 'publish',
									'posts_per_page' => 25,
								)
							)
						);

					} else {

						$query = new WP_Query(
							wp_parse_args(
								$query_args,
								array(
									'post_type'   => $option,
									'post_status' => 'publish',
								)
							)
						);

					}

					if ( ! is_wp_error( $query ) && ! empty( $query->posts ) ) {
						$product_id = apply_filters( 'sp_wpspro_product_id', true );
						foreach ( $query->posts as $item ) {
							$title                = $product_id ? ( '#' . $item->ID . ' ' . $item->post_title ) : $item->post_title;
							$options[ $item->ID ] = $title;
						}
					}

					break;
				case 'sp_wps_shortcodes':
					$wps_get_specific = array(
						'post_type' => 'sp_wps_shortcodes',
					);
					$query_args       = array_merge( $query_args, $wps_get_specific );
					$all_posts        = get_posts( $query_args );

					if ( ! is_wp_error( $all_posts ) && ! empty( $all_posts ) ) {
						foreach ( $all_posts as $post_obj ) {
							$options[ $post_obj->ID ] = isset( $post_obj->post_title ) && ! empty( $post_obj->post_title ) ? $post_obj->post_title : 'Untitled';
						}
					}
					wp_reset_postdata();
					break;

				case 'category':
				case 'categories':
				case 'tag':
				case 'tags':
				case 'menu':
				case 'menus':
					if ( ! empty( $term ) ) {

						$query = new WP_Term_Query(
							wp_parse_args(
								$query_args,
								array(
									'search'     => $term,
									'taxonomy'   => $option,
									'hide_empty' => false,
									'number'     => 25,
								)
							)
						);

					} else {

						$query = new WP_Term_Query(
							wp_parse_args(
								$query_args,
								array(
									'taxonomy'   => $option,
									'hide_empty' => false,
								)
							)
						);

					}

					if ( ! is_wp_error( $query ) && ! empty( $query->terms ) ) {
						foreach ( $query->terms as $item ) {
							$options[ $item->term_id ] = $item->name . ' (' . $item->count . ')';
						}
					}

					break;

				case 'user':
				case 'users':
					if ( ! empty( $term ) ) {

						$query = new WP_User_Query(
							array(
								'search'  => '*' . $term . '*',
								'number'  => 25,
								'orderby' => 'title',
								'order'   => 'ASC',
								'fields'  => array( 'display_name', 'ID' ),
							)
						);

					} else {

						$query = new WP_User_Query( array( 'fields' => array( 'display_name', 'ID' ) ) );

					}

					if ( ! is_wp_error( $query ) && ! empty( $query->get_results() ) ) {
						foreach ( $query->get_results() as $item ) {
							$options[ $item->ID ] = $item->display_name;
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

					$array_search = true;

					break;

				case 'role':
				case 'roles':
					global $wp_roles;

					if ( ! empty( $wp_roles ) ) {
						if ( ! empty( $wp_roles->roles ) ) {
							foreach ( $wp_roles->roles as $role_key => $role_value ) {
								$options[ $role_key ] = $role_value['name'];
							}
						}
					}

					$array_search = true;

					break;

				case 'post_type':
				case 'post_types':
					$post_types = get_post_types( array( 'show_in_nav_menus' => true ), 'objects' );

					if ( ! is_wp_error( $post_types ) && ! empty( $post_types ) ) {
						foreach ( $post_types as $post_type ) {
							$options[ $post_type->name ] = $post_type->labels->name;
						}
					}

					$array_search = true;

					break;

				// SKU Meta.
				case 'sku_meta':
				case 'sku_metas':
					global $wpdb;
					$key    = '_sku';
					$type   = 'product';
					$status = 'publish';

					if ( empty( $key ) ) {
						return;
					}

					$skus = $wpdb->get_col(
						$wpdb->prepare(
							"
							SELECT pm.meta_value FROM {$wpdb->postmeta} pm
							LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
							WHERE pm.meta_key = %s
							AND p.post_status = %s
							AND p.post_type = %s
							",
							$key,
							$status,
							$type
						)
					);

					foreach ( $skus as $sku ) {
						if ( $sku && ! empty( $sku ) ) {
							$options[ $sku ] = $sku;
						}
					}

					break;

				// Attribute.
				case 'attribute_taxonomies':
				case 'attribute_taxonomy':
					$attribute_taxonomies = wc_get_attribute_taxonomies();

					foreach ( $attribute_taxonomies as $attribute_taxonomy ) {
						$options[ 'pa_' . $attribute_taxonomy->attribute_name ] = $attribute_taxonomy->attribute_label;
					}

					break;

				case 'attr_terms':
				case 'attr_term':
					global $post;
					$saved_meta = get_post_meta( $post->ID, 'sp_wpsp_shortcode_options', true );
					if ( isset( $saved_meta['product_attribute'] ) && '' !== $saved_meta['product_attribute'] ) {
						$terms = get_terms( $saved_meta['product_attribute'] );
						foreach ( $terms as $key => $value ) {
							$options[ $value->slug ] = $value->name;
						}
					} else {
						$attribute_taxonomies = wc_get_attribute_taxonomies();

						if ( $attribute_taxonomies ) {
								$attr_taxonomies      = array();
								$attr_taxonomy_number = 1;
							foreach ( $attribute_taxonomies as $attribute_taxonomy ) {
								$attr_taxonomies[ $attr_taxonomy_number++ ] = 'pa_' . $attribute_taxonomy->attribute_name;
							}
							$terms = get_terms( $attr_taxonomies['1'] );
							foreach ( $terms as $key => $value ) {
								$options[ $value->slug ] = $value->name;
							}
						}
					}

					break;

				case 'shortcode_list':
					$shortcode_posts = get_posts( $query_args );

					if ( ! is_wp_error( $shortcode_posts ) && ! empty( $shortcode_posts ) ) {
						$options['none'] = '– Select option –';
						foreach ( $shortcode_posts as $shortcode_post ) {
							$options[ $shortcode_post->ID ] = $shortcode_post->post_title;
						}
					}

					break;

				default:
					if ( function_exists( $type ) ) {
						if ( ! empty( $term ) ) {
							$options = call_user_func( $type, $query_args );
						} else {
							$options = call_user_func( $type, $term, $query_args );
						}
					}

					break;

			}

			// Array search by "term".
			if ( ! empty( $term ) && ! empty( $options ) && ! empty( $array_search ) ) {
				$options = preg_grep( '/' . $term . '/i', $options );
			}

			// Make multidimensional array for ajax search.
			if ( ! empty( $term ) && ! empty( $options ) ) {
				$arr = array();
				foreach ( $options as $option_key => $option_value ) {
					$arr[] = array(
						'value' => $option_key,
						'text'  => $option_value,
					);
				}
				$options = $arr;
			}

			return $options;

		}

		/**
		 * Field_wp_query_data_title function.
		 *
		 * @param string $type Data title.
		 * @param array  $values Data title values.
		 */
		public function field_wp_query_data_title( $type, $values ) {

			$options = array();

			if ( ! empty( $values ) && is_array( $values ) ) {

				foreach ( $values as $value ) {

					switch ( $type ) {

						case 'post':
						case 'posts':
						case 'page':
						case 'pages':
							$title = get_the_title( $value );

							if ( ! is_wp_error( $title ) && ! empty( $title ) ) {
								$product_id        = apply_filters( 'sp_wpspro_product_id', true );
								$title             = $product_id ? ( '#' . $value . ' ' . $title ) : $title;
								$options[ $value ] = $title;
							}

							break;

						case 'category':
						case 'categories':
						case 'tag':
						case 'tags':
						case 'menu':
						case 'menus':
							$term = get_term( $value );

							if ( ! is_wp_error( $term ) && ! empty( $term ) ) {
								$options[ $value ] = $term->name;
							}

							break;

						case 'user':
						case 'users':
							$user = get_user_by( 'id', $value );

							if ( ! is_wp_error( $user ) && ! empty( $user ) ) {
								$options[ $value ] = $user->display_name;
							}

							break;

						case 'sidebar':
						case 'sidebars':
							global $wp_registered_sidebars;

							if ( ! empty( $wp_registered_sidebars[ $value ] ) ) {
									$options[ $value ] = $wp_registered_sidebars[ $value ]['name'];
							}

							break;

						case 'role':
						case 'roles':
							global $wp_roles;

							if ( ! empty( $wp_roles ) && ! empty( $wp_roles->roles ) && ! empty( $wp_roles->roles[ $value ] ) ) {
								$options[ $value ] = $wp_roles->roles[ $value ]['name'];
							}

							break;

						case 'post_type':
						case 'post_types':
							$post_types = get_post_types( array( 'show_in_nav_menus' => true ) );

							if ( ! is_wp_error( $post_types ) && ! empty( $post_types ) && ! empty( $post_types[ $value ] ) ) {
								$options[ $value ] = ucfirst( $value );
							}

							break;

						default:
							if ( function_exists( $type . '_title' ) ) {
								$options[ $value ] = call_user_func( $type . '_title', $value );
							} else {
								$options[ $value ] = ucfirst( $value );
							}

							break;

					}
				}
			}

			return $options;

		}

	}
}
