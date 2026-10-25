<?php
/**
 * Title: Call to action
 * Slug: folio/cta
 * Description: A full-width gradient call to action with a button.
 * Categories: folio
 * Keywords: cta, contact, call to action
 */
?>
<!-- wp:group {"anchor":"contact","align":"full","className":"folio-cta","gradient":"brand","textColor":"light","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div id="contact" class="wp-block-group alignfull folio-cta has-light-color has-brand-gradient-background has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Have a project in mind?', 'folio' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size"><?php esc_html_e( 'Tell me what you need and I will get back to you within one working day.', 'folio' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"light","textColor":"dark"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-dark-color has-light-background-color has-text-color has-background wp-element-button" href="mailto:akshapatel.dev@gmail.com"><?php esc_html_e( 'Email me', 'folio' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->