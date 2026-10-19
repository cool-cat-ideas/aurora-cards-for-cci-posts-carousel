<?php
/**
 * Aurora Cards template.
 *
 * @package WP_Posts_Carousel_Aurora_Cards
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slide         = isset( $this->slide ) && is_array( $this->slide ) ? $this->slide : array();
$commerce      = isset( $slide['commerce'] ) && is_array( $slide['commerce'] ) ? $slide['commerce'] : array();
$meta          = isset( $slide['meta'] ) && is_array( $slide['meta'] ) ? $slide['meta'] : array();
$post          = isset( $this->post ) ? $this->post : null;
$post_type     = ! empty( $slide['post_type'] ) ? sanitize_key( $slide['post_type'] ) : ( $post ? get_post_type( $post ) : 'post' );
$url           = ! empty( $slide['url'] ) ? esc_url_raw( $slide['url'] ) : esc_url_raw( $this->post_url );
$title         = ! empty( $slide['title']['text'] ) ? wp_strip_all_tags( $slide['title']['text'] ) : wp_strip_all_tags( $this->title );
$description   = ! empty( $slide['description']['text'] ) ? wp_strip_all_tags( $slide['description']['text'] ) : wp_strip_all_tags( $this->post_description );
$image         = ! empty( $slide['image']['src'] ) ? esc_url_raw( $slide['image']['src'] ) : ( ! empty( $this->image[0] ) ? esc_url_raw( $this->image[0] ) : '' );
$image_alt     = ! empty( $slide['image']['alt'] ) ? wp_strip_all_tags( $slide['image']['alt'] ) : $title;
$image_srcset  = ! empty( $slide['image']['srcset'] ) ? ' srcset="' . esc_attr( $slide['image']['srcset'] ) . '"' : '';
$image_sizes   = ! empty( $slide['image']['sizes'] ) ? ' sizes="' . esc_attr( $slide['image']['sizes'] ) . '"' : '';
$categories    = ! empty( $this->categories ) && ! empty( $meta['categories'] ) && is_array( $meta['categories'] )
	? $meta['categories']
	: array();
$tags          = ! empty( $this->tags ) && ! empty( $meta['tags'] ) && is_array( $meta['tags'] )
	? $meta['tags']
	: array();
$category_name = '';
$category_url  = '';

if ( $categories ) {
	$category = reset( $categories );

	if ( is_array( $category ) ) {
		$category_name = ! empty( $category['name'] ) ? sanitize_text_field( $category['name'] ) : '';
		$category_url  = ! empty( $category['url'] ) && ! is_wp_error( $category['url'] )
			? esc_url_raw( $category['url'] )
			: '';
	}
}

$has_pro_commerce  = $post_type === 'product' && ! empty( $commerce['price_html'] );
$price_html        = $has_pro_commerce ? wp_kses_post( $commerce['price_html'] ) : '';
$rating            = $has_pro_commerce && isset( $commerce['average_rating'] ) ? (float) $commerce['average_rating'] : 0;
$rating_count      = $has_pro_commerce && isset( $commerce['rating_count'] ) ? absint( $commerce['rating_count'] ) : 0;
$on_sale           = $has_pro_commerce && ( ! empty( $commerce['on_sale'] ) || ! empty( $commerce['is_on_sale'] ) );
$button_url        = $url;
$button_label      = $post_type === 'product'
	? __( 'View product', 'aurora-cards-for-cci-posts-carousel' )
	: __( 'Read article', 'aurora-cards-for-cci-posts-carousel' );
$button_classes    = array( 'cci-wpc-aurora-button' );
$button_attributes = array();

if ( $has_pro_commerce && $post && function_exists( 'wc_get_product' ) ) {
	$product = wc_get_product( $post->ID );

	if ( $product && is_a( $product, 'WC_Product' ) && $product->is_purchasable() && $product->is_in_stock() ) {
		$button_url          = $product->add_to_cart_url();
		$button_label        = $product->add_to_cart_text();
		$button_classes[]    = 'button';
		$button_classes[]    = 'add_to_cart_button';
		$button_classes[]    = 'product_type_' . sanitize_html_class( $product->get_type() );
		$button_attributes[] = 'data-product_id="' . esc_attr( $product->get_id() ) . '"';
		$button_attributes[] = 'data-product_sku="' . esc_attr( $product->get_sku() ) . '"';
		$button_attributes[] = 'data-quantity="1"';
		$button_attributes[] = 'rel="nofollow"';

		if ( method_exists( $product, 'supports' ) && $product->supports( 'ajax_add_to_cart' ) ) {
			$button_classes[] = 'ajax_add_to_cart';
		}
	}
}

$type_label             = $post_type === 'product'
	? __( 'Product', 'aurora-cards-for-cci-posts-carousel' )
	: __( 'Article', 'aurora-cards-for-cci-posts-carousel' );
$button_class           = implode( ' ', array_unique( array_filter( array_map( 'sanitize_html_class', $button_classes ) ) ) );
$button_attributes_html = $button_attributes ? ' ' . implode( ' ', $button_attributes ) : '';
$template               = '';

$template         .= '<article class="' . esc_attr( trim( 'cci-wpc-slide cci-wpc-aurora-slide ' . $this->slide_layout_classes() ) ) . '"' . $this->slide_layout_attributes() . '>';
	$template     .= '<div class="cci-wpc-aurora-card" data-post-type="' . esc_attr( $post_type ) . '">';
		$template .= '<div class="cci-wpc-aurora-glow" aria-hidden="true"></div>';
if ( $image || $url ) {
	$media_tag = $url ? 'a' : 'div';
	$template .= '<' . $media_tag . ' class="cci-wpc-aurora-media"' . ( $url ? ' href="' . esc_url( $url ) . '"' : '' ) . '>';
	if ( $image ) {
			$template .= '<img src="' . esc_url( $image ) . '"' . $image_srcset . $image_sizes . ' alt="' . esc_attr( $image_alt ) . '" loading="lazy" decoding="async">';
	} else {
				$placeholder = $title ?: $type_label;
				$placeholder = function_exists( 'mb_substr' ) ? mb_substr( $placeholder, 0, 1 ) : substr( $placeholder, 0, 1 );
				$template   .= '<span class="cci-wpc-aurora-placeholder" aria-hidden="true">' . esc_html( $placeholder ) . '</span>';
	}
	if ( $on_sale ) {
		$template .= '<span class="cci-wpc-aurora-sale">' . esc_html__( 'Sale', 'aurora-cards-for-cci-posts-carousel' ) . '</span>';
	}
					$template .= '</' . $media_tag . '>';
}

		$template     .= '<div class="cci-wpc-aurora-body">';
			$template .= '<div class="cci-wpc-aurora-eyebrow">';
if ( $category_name && $category_url ) {
	$template .= '<a class="cci-wpc-aurora-kind cci-wpc-aurora-kind-link" href="' . esc_url( $category_url ) . '" rel="tag">' . esc_html( $category_name ) . '</a>';
} else {
	$template .= '<span class="cci-wpc-aurora-kind">' . esc_html( $category_name ?: $type_label ) . '</span>';
}
if ( $rating > 0 ) {
	$rating_label = sprintf(
		/* translators: 1: average rating, 2: number of reviews. */
		__( 'Rated %1$s out of 5 from %2$d reviews', 'aurora-cards-for-cci-posts-carousel' ),
		number_format_i18n( $rating, 1 ),
		$rating_count
	);
	$template     .= '<span class="cci-wpc-aurora-rating" aria-label="' . esc_attr( $rating_label ) . '">';
		$template .= '<span aria-hidden="true">&#9733;</span> ' . esc_html( number_format_i18n( $rating, 1 ) );
	$template     .= '</span>';
}
			$template .= '</div>';

if ( $title ) {
	$template     .= '<h3 class="cci-wpc-aurora-title">';
		$template .= $url ? '<a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a>' : esc_html( $title );
	$template     .= '</h3>';
}

if ( $description ) {
	$template .= '<p class="cci-wpc-aurora-description">' . esc_html( wp_trim_words( $description, 18 ) ) . '</p>';
}

if ( $tags ) {
	$template .= '<div class="cci-wpc-aurora-tags" aria-label="' . esc_attr__( 'Tags', 'aurora-cards-for-cci-posts-carousel' ) . '">';
	foreach ( $tags as $tag ) {
		if ( ! is_array( $tag ) || empty( $tag['name'] ) ) {
			continue;
		}

				$tag_name = sanitize_text_field( $tag['name'] );
				$tag_url  = ! empty( $tag['url'] ) && ! is_wp_error( $tag['url'] )
					? esc_url_raw( $tag['url'] )
					: '';

		if ( $tag_url ) {
			$template .= '<a class="cci-wpc-aurora-tag" href="' . esc_url( $tag_url ) . '" rel="tag">#' . esc_html( $tag_name ) . '</a>';
		} else {
			$template .= '<span class="cci-wpc-aurora-tag">#' . esc_html( $tag_name ) . '</span>';
		}
	}
				$template .= '</div>';
}

			$template .= '<div class="cci-wpc-aurora-footer">';
if ( $price_html ) {
	$template .= '<span class="cci-wpc-aurora-price">' . $price_html . '</span>';
} elseif ( ! empty( $this->created_date ) ) {
	$template .= '<span class="cci-wpc-aurora-date">' . wp_kses_post( $this->created_date ) . '</span>';
} else {
	$template .= '<span class="cci-wpc-aurora-type">' . esc_html( $type_label ) . '</span>';
}

if ( $button_url ) {
	$template     .= '<a class="' . esc_attr( $button_class ) . '" href="' . esc_url( $button_url ) . '"' . $button_attributes_html . '>';
		$template .= esc_html( $button_label ) . '<span aria-hidden="true"> &rarr;</span>';
	$template     .= '</a>';
}
			$template .= '</div>';
		$template     .= '</div>';
	$template         .= '</div>';
$template             .= '</article>';

return $template;
