<?php
/**
 * Title: Hero
 * Slug: folio/hero
 * Description: A bold hero section with a gradient headline and two buttons.
 * Categories: folio
 * Keywords: hero, banner, intro, landing
 */
?>

<!-- wp:group {"align":"full","className":"folio-hero","backgroundColor":"dark","textColor":"light","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull folio-hero has-light-color has-dark-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:paragraph {"className":"folio-eyebrow"} -->
<p class="folio-eyebrow"><?php esc_html_e( 'Available for new projects', 'folio' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"folio-hero__title"} -->
<h1 class="wp-block-heading folio-hero__title"><?php esc_html_e( 'I build fast, beautiful', 'folio' ); ?> <span class="folio-gradient-text"><?php esc_html_e( 'WordPress websites', 'folio' ); ?></span></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"large","className":"folio-hero__lead"} -->
<p class="folio-hero__lead has-large-font-size"><?php esc_html_e( 'Custom themes, plugins and WooCommerce stores, built with clean code and a focus on performance.', 'folio' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#work"><?php esc_html_e( 'View my work', 'folio' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#contact"><?php esc_html_e( 'Get in touch', 'folio' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->