<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package essential-blocks
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */

function post_grid_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	
	$index_js = 'post-grid/index.js';
	wp_register_script(
		'post-grid-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			// 'wp-blocks',
			// 'wp-i18n',
			// 'wp-element',
			// 'wp-block-editor',
			'wp-api-fetch',
			'essential-blocks-controls-util'
		),
		ESSENTIAL_BLOCKS_VERSION
	);

	$style_css = 'post-grid/style.css';
	wp_register_style(
		'post-grid-block-frontend-css',
		plugins_url( $style_css, __FILE__ ),
		array(),
		ESSENTIAL_BLOCKS_VERSION
	);

	register_block_type(
		$dir . "/post-grid",
		array (
			'editor_script' => 'post-grid-block-editor',
			'editor_style'  => 'post-grid-block-frontend-css',
			'render_callback' => 'render_block_eb_post_grid_block',
		)
	);
}
add_action( 'init', 'post_grid_block_init' );

function render_block_eb_post_grid_block($attributes) {
	if( !is_admin() ) {
		//Enqueue Styles
		$style_css = 'post-grid/style.css';
		wp_enqueue_style(
			'post-grid-block-frontend-css',
			plugins_url( $style_css, __FILE__ ),
			array(),
			ESSENTIAL_BLOCKS_VERSION
		);

		$queryData = $attributes["queryData"];

		$args = array(
			'posts_per_page'	=> (int)$queryData['per_page'],
			'order'				=> $queryData['order'],
			'orderby'			=> $queryData['orderby'],
			'offset' 			=> $queryData['offset'],
		);

		if ($queryData['orderby'] == "id") {
			$args['orderby'] = "ID";
		}

		if (isset($queryData['categories']) && strlen($queryData['categories']) > 0 ) {
			$catJsonDecode = json_decode($queryData['categories']);
			$catArray = array();
			foreach($catJsonDecode as $item) {
				array_push($catArray, $item->value);
			}
			$args['category__in'] = $catArray;
		}

		if (isset($queryData['tags']) && strlen($queryData['tags']) > 0 ) {
			$tagJsonDecode = json_decode($queryData['tags']);
			$tagArray = array();
			foreach($tagJsonDecode as $item) {
				array_push($tagArray, $item->value);
			}
			$args['tag__in'] = $tagArray;
		}

		if (isset($queryData['author']) && strlen($queryData['author']) > 0 ) {
			$authorJsonDecode = json_decode($queryData['author']);
			$authorArray = array();
			foreach($authorJsonDecode as $item) {
				array_push($authorArray, $item->value);
			}
			$args['author__in'] = $authorArray;
		}

		if (isset($queryData['include']) && strlen($queryData['include']) > 0 ) {
			$includeJsonDecode = json_decode($queryData['include']);
			$includeArray = array();
			foreach($includeJsonDecode as $item) {
				array_push($includeArray, $item->value);
			}
			$args['post__in'] = $includeArray;
		}

		if (isset($queryData['exclude']) && strlen($queryData['exclude']) > 0 ) {
			$excludeJsonDecode = json_decode($queryData['exclude']);
			$excludeArray = array();
			foreach($excludeJsonDecode as $item) {
				array_push($excludeArray, $item->value);
			}
			$args['exclude'] = $excludeArray;
		}

		$query = get_posts( $args );

		$attributes = wp_parse_args(
			$attributes,
			[
				'preset' => 'style-1',
				'showThumbnail' => true,
				'showTitle' => true,
				'titleTag' => 'h2',
				'showContent' => true,
				'contentLength' => 20,
				'expansionIndicator' => '...',
				'showReadMore' => false,
				'readmoreText' => 'Read More',
				'showMeta' => true,
				'headerMeta' => '[{"value":"categories","label":"Categories"}]',
				'footerMeta' => '[{"value":"avatar","label":"Author Avatar"},{"value":"author","label":"Author Name"},{"value":"date","label":"Published Date"}]',
			]
		);

		$className = isset($attributes["className"]) ? $attributes["className"] : "";

		//HTML
		$html = sprintf(
			'<div class="eb-post-grid-wrapper %1$s %2$s %3$s" data-id="%1$s">',
			$attributes["blockId"], $attributes["preset"], $className
		);
			
		foreach($query as $result) {

			//Get Header and Footer Meta
			$headerMetaString = strlen($attributes["headerMeta"]) > 0 ? json_decode($attributes["headerMeta"]) : "";
			$headerMeta = array();
			if (is_array($headerMetaString)) {
				foreach($headerMetaString as $item) {
					array_push($headerMeta, $item->value);
				}
			}
			$footerMetaString = strlen($attributes["footerMeta"]) > 0 ? json_decode($attributes["footerMeta"]) : "";
			$footerMeta = array();
			if (is_array($footerMetaString)) {
				foreach($footerMetaString as $item) {
					array_push($footerMeta, $item->value);
				}
			}
			$allMeta = array_merge($headerMeta, $footerMeta);
			
			//Author HTML
			$authorId = $result->post_author;
			$author = "";
			if (in_array("author", $allMeta)) {
				$authorName = esc_html(get_the_author_meta('display_name', $authorId));
				$authorUrl = esc_url( get_author_posts_url( get_the_author_meta( 'ID', $authorId ) ) );
				$author .= sprintf(
					'<span class="ebpg-posted-by">
						by <a href="%2$s" title="%1$s" rel="author">%1$s</a>
					</span>',
					$authorName, $authorUrl
				);
			}

			//Avatar HTML
			$authorId = $result->post_author;
			$avatar = "";
			if (in_array("avatar", $allMeta)) {
				$authorName = esc_html(get_the_author_meta('display_name', $authorId));
				$authorUrl = esc_url( get_author_posts_url( get_the_author_meta( 'ID', $authorId ) ) );
				$authorAvatar = get_avatar_url($authorId, ['size' => '96']);
				$avatar .= sprintf(
					'<div class="ebpg-author-avatar">
						<a href="%1$s">
							<img 
								alt="%2$s"
								src="%3$s"
							/>
						</a>
					</div>',
					$authorUrl, $authorName, $authorAvatar
				);
			}

			//Date HTML
			$date = "";
			if (in_array("date", $allMeta)) {
				$date .= sprintf(
					'<span class="ebpg-posted-on">
						on <time dateTime="%1$s">%2$s</time>
					</span>',
					esc_attr( get_the_date( 'c', $result ) ),
					esc_html( get_the_date( '', $result ) )
				);
			}

			//Category HTML
			$categories = "";
			if (in_array("categories", $allMeta)) {
				$catArray = wp_get_post_categories( $result->ID, array( 'fields' => 'all' ));
				if (is_array($catArray) && count($catArray) > 0) {
					$categories .= '<div class="ebpg-categories-meta">';
					foreach($catArray as $cat) {
						$categories .= sprintf(
							'<a href="%1$s" title="%2$s">%2$s</a>',
							esc_attr( esc_url( get_category_link( $cat->term_id ) ) ),
							esc_html( $cat->name )
						);
					}
					$categories .= '</div>';
				}
			}

			//Tags HTML
			$tags = "";
			if (in_array("tags", $allMeta)) {
				$tagArray = get_the_tags( $result->ID);
				if (is_array($tagArray) && count($tagArray) > 0) {
					$tags .= '<div class="ebpg-tags-meta">';
					foreach($tagArray as $tag) {
						$tags .= sprintf(
							'<a href="%1$s" title="%2$s">%2$s</a>',
							esc_attr( esc_url( get_tag_link( $tag->term_id ) ) ),
							esc_html( $tag->name )
						);
					}
					$tags .= '</div>';
				}
			}

			//Final Header HTML
			$headerMetaHtml = "";
			if ($attributes["showMeta"]) {
				if (in_array("avatar", $headerMeta)) {
					$headerMetaHtml .= $avatar;
				}
				$headerMetaHtml .= '<div class="ebpg-entry-meta-items">';
				foreach($headerMeta as $meta) {
					if ($meta != "avatar") {
						$headerMetaHtml .= ${$meta};
					}
				}
				$headerMetaHtml .= '</div>';
			}

			//Final Footer HTML
			$footerMetaHtml = "";
			if ($attributes["showMeta"]) {
				if (in_array("avatar", $footerMeta)) {
					$footerMetaHtml .= $avatar;
				}
				$footerMetaHtml .= '<div class="ebpg-entry-meta-items">';
				foreach($footerMeta as $meta) {
					if ($meta != "avatar") {
						$footerMetaHtml .= ${$meta};
					}
				}
				$footerMetaHtml .= '</div>';
			}

			$html .= sprintf('<article class="ebpg-grid-post ebpg-post-grid-column" data-id="%1$s">', $result->ID);
			$html .= '<div class="ebpg-grid-post-holder">';
			$wrapper_link_html = sprintf('<a class="ebpg-post-link-wrapper" href="%1$s"></a>', $result->guid);
			if ($attributes["preset"] === "style-5") {
				$html .= $wrapper_link_html;
				$wrapper_link_html = "";
			}

			//Post Thumbnail
			if ($attributes["showThumbnail"]) {
				$thumbnail = get_the_post_thumbnail( $result->ID );
				if (!empty($thumbnail)) {
					$html .= sprintf(
						'<div class="ebpg-entry-media">
							<div class="ebpg-entry-thumbnail">
								%1$s
								%2$s
							</div>
						</div>',
						$wrapper_link_html, $thumbnail
					);
				}
				else {
					$html .= '
					<div class="ebpg-entry-media">
						<div class="ebpg-entry-thumbnail">
							<img src="https://via.placeholder.com/250x250.png" alt="No Thumbnail Found">
						</div>
					</div>';
				}
			}

			$html .= '<div class="ebpg-entry-wrapper">';

			//Post Title
			if ($attributes["showTitle"]) {
				$ebpg_title = $result->post_title;
				if (!empty($attributes["titleLength"]) ) {
					$ebpg_title = eb_trunc($result->post_title, $attributes["titleLength"]);
				}
				$html .= sprintf(
					'<header class="ebpg-entry-header">
						<%1$s class="ebpg-entry-title">
							<a class="ebpg-grid-post-link" href="%2$s" title="%3$s">%3$s</a>
						</%1$s>
					</header>',
					$attributes["titleTag"], $result->guid, $ebpg_title
				);
			}
			$html .= '';
			$html .= '';
			
			$html .= '</h2>';
			$html .= '</header>';

			//Header Meta
			$html .= sprintf(
				'<div class="ebpg-entry-meta ebpg-header-meta">%1$s</div>', 
				$headerMetaHtml
			);

			$html .= '<div class="ebpg-entry-content">';
			//Post Excerpt
			if ($attributes["showContent"]) {
				if (!empty($result->post_excerpt)) {
					$post_content = wp_kses_post(strip_tags($result->post_excerpt));
				}
				else {
					$post_content = wp_kses_post(strip_tags($result->post_content));
				}
				$content = eb_trunc($post_content, $attributes["contentLength"]);

				$html .= sprintf(
					'<div class="ebpg-grid-post-excerpt">
						<p>%1$s%2$s</p>
					</div>',
					$content, $attributes["expansionIndicator"]
				);
			}

			if ($attributes["showReadMore"]) {
				$html .= sprintf(
					'<div class="ebpg-readmore-btn">
						<a href="%1$s">%2$s</a>
					</div>',
					$result->guid, $attributes["readmoreText"]
				);
			}

			$html .= '</div>';

			//Footer Meta
			$html .= sprintf(
				'<div class="ebpg-entry-meta ebpg-footer-meta">%1$s</div>', 
				$footerMetaHtml
			);
			
			$html .= '</div>'; //End of class "ebpg-entry-wrapper"
			$html .= '</div>'; //End of class "ebpg-grid-post-holder"
			$html .= '</article>';
		}
		$html .= '</div>';

		return $html;
		 
		// Reset the `$post` data to the current post in main query.
		wp_reset_postdata();
	}
}

//Limit Word Function
function eb_trunc($phrase, $max_words) {
	$phrase_array = explode(' ', $phrase);
	if(count($phrase_array) > $max_words && $max_words >= 0)
	   $phrase = implode(' ',array_slice($phrase_array, 0, $max_words));
	return $phrase;
}