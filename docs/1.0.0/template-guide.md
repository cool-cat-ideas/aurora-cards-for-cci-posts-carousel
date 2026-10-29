# Aurora Cards template guide

Aurora Cards is a standalone no-cost template package for CCI Posts Carousel.

## Use it

1. Install and activate CCI Posts Carousel 2.0.0 or newer.
2. Install and activate Aurora Cards for CCI Posts Carousel.
3. Open **CCI Posts Carousel All In One > Dashboard** and create or edit a carousel.
4. Use the **PHP** renderer and **Owl Carousel** engine under **General**. Aurora Cards does not supply a Swiper/React template.
5. Select **Aurora Cards** under **Design > Template**.
6. Choose published content under **Query**, or select **Manual slides** and add items under **Slides**.
7. Set **Status** to **Published**, save the carousel and add it to a page with the main plugin's Gutenberg block or generated shortcode.

Use **General > Responsive items** to set the number of visible cards for the page width. Add featured images to your posts; cards without an image display a placeholder. If the carousel is empty, check its publication status and content selection. Activating the template alone does not create a carousel.

Blog cards use the public slide payload from the base plugin. Product cards remain useful with the base plugin and link to the product page. When Pro is active, its WooCommerce module enriches the same cards with prices, ratings, sale state and an add-to-cart action.

When **Show categories** or **Show tags** is enabled in the carousel display settings, Aurora Cards renders the public taxonomy terms as links to their WordPress archive pages. Categories use the primary card pill and tags appear below the description. Keyboard focus and pointer hover states are included for taxonomy links, titles, media, actions and carousel navigation.

The maintained product demo enables Owl dots, autoplay and the Pro autoplay progress indicator on the second Aurora carousel. These controls inherit Aurora-specific colors and responsive spacing; the progress indicator remains a Pro feature rather than a dependency of this template.

## Extend it

The template consumes the standard public slide payload. Extend that payload through `wp_posts_carousel_slide_view_model` or change individual fragments through the documented `wp_posts_carousel_item_*` filters. Keep additions optional so the template can still render a generic post or custom slide.
