<?php
/**
 * Folio theme functions.
 */

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'folio-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
} );
add_action( 'init', function () {
	register_block_pattern_category(
		'folio',
		array( 'label' => __( 'Folio', 'folio' ) )
	);
} );
add_action( 'after_setup_theme', function () {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
} );