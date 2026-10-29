<a href="https://coolcatideas.com/products/cci-posts-carousel-all-in-one/"><img src=".github/assets/cci-posts-carousel-logo.png" alt="Aurora Cards for CCI Posts Carousel" width="460"></a>

# Aurora Cards for CCI Posts Carousel

Give posts, pages and product links a consistent card layout with a large image, title and excerpt. Aurora Cards adds a template to CCI Posts Carousel and uses its existing content, navigation and responsive settings.

[Product and download](https://coolcatideas.com/products/cci-posts-carousel-aurora-cards/) · [Template guide](docs/1.0.0/template-guide.md) · [Support](https://github.com/cool-cat-ideas/aurora-cards-for-cci-posts-carousel/issues)

## See what you can build

### Show editorial content with the base plugin

Aurora Cards works without Pro or a license key. Posts, pages, manual slides and ordinary product links share the same template.

![Aurora Cards editorial carousel using the base plugin](.wordpress-org/screenshot-1.png)

### Add optional WooCommerce details with Pro

The main CCI Posts Carousel Pro package can supply current prices, ratings, sale details and cart actions. These details are optional; Aurora Cards has no separate paid edition.

![Aurora Cards product carousel with optional WooCommerce details supplied by CCI Posts Carousel Pro](.wordpress-org/screenshot-2.png)

## Use the template

1. Install and activate CCI Posts Carousel 2.0.0 or newer.
2. Install and activate Aurora Cards.
3. Open **CCI Posts Carousel All In One > Dashboard** and create a carousel or edit an existing one.
4. Under **Query**, choose an automatic selection of published content, or choose **Manual slides** and add items under **Slides**.
5. Under **General**, use the **PHP** renderer and **Owl Carousel** engine. Select **Aurora Cards** under **Design > Template**.
6. Set **Status** to **Published** and save.
7. Add the **CCI Posts Carousel All In One** block to a page and select your saved carousel, or paste its generated shortcode into a **Shortcode** block. Publish the page and check the result.

If the template is missing, confirm that both plugins are active and the main plugin is version 2.0.0 or newer, then reload the editor. If the carousel is empty, check its publication status and content selection. A fresh site needs published content or manual slides. Aurora Cards adds a template to the main plugin; it does not create a carousel or add a separate settings page.

Add featured images and excerpts to your posts. Adjust **General > Responsive items** to fit the number of cards to the page width, and use **Design** to choose visible card fields. Aurora Cards supplies a PHP/Owl template; it does not supply a Swiper/React template.

## Customize and extend

The [template guide](docs/1.0.0/template-guide.md) explains supported slide data and customization filters. The template source is in `templates/aurora-cards/`.

## Support and license

Use [GitHub issues](https://github.com/cool-cat-ideas/aurora-cards-for-cci-posts-carousel/issues) for public questions and bug reports. See the [changelog](CHANGELOG.md) for release history.

GPL-2.0-or-later. See [LICENSE](LICENSE).
