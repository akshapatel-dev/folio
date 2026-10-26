<?php
// This file is generated. Do not modify it manually.
return array(
	'folio-blocks' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'folio/pricing-plan',
		'version' => '0.1.0',
		'title' => 'Pricing Plan',
		'category' => 'design',
		'icon' => 'money-alt',
		'description' => 'A pricing card with a price, feature list and button.',
		'keywords' => array(
			'pricing',
			'plan',
			'card'
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'name' => array(
				'type' => 'string',
				'source' => 'html',
				'selector' => '.folio-plan__name',
				'default' => 'Starter'
			),
			'price' => array(
				'type' => 'string',
				'source' => 'html',
				'selector' => '.folio-plan__price',
				'default' => '$499'
			),
			'note' => array(
				'type' => 'string',
				'source' => 'html',
				'selector' => '.folio-plan__note',
				'default' => 'One landing page'
			),
			'features' => array(
				'type' => 'string',
				'default' => 'Responsive design
Contact form
Basic SEO setup'
			),
			'featured' => array(
				'type' => 'boolean',
				'default' => false
			),
			'badgeText' => array(
				'type' => 'string',
				'default' => 'Most popular'
			),
			'buttonText' => array(
				'type' => 'string',
				'default' => 'Get started'
			),
			'buttonUrl' => array(
				'type' => 'string',
				'default' => '#contact'
			)
		),
		'textdomain' => 'folio-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css'
	),
	'github-repos' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'folio/github-repos',
		'version' => '0.1.0',
		'title' => 'GitHub Repositories',
		'category' => 'widgets',
		'icon' => 'editor-code',
		'description' => 'Shows public repositories from the GitHub API.',
		'keywords' => array(
			'github',
			'repositories',
			'api'
		),
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			)
		),
		'attributes' => array(
			'username' => array(
				'type' => 'string',
				'default' => 'akshapatel-dev'
			),
			'count' => array(
				'type' => 'number',
				'default' => 6
			),
			'sortBy' => array(
				'type' => 'string',
				'default' => 'updated'
			),
			'hideForks' => array(
				'type' => 'boolean',
				'default' => true
			)
		),
		'textdomain' => 'folio-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'pricing-table' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'folio/pricing-table',
		'version' => '0.1.0',
		'title' => 'Pricing Table',
		'category' => 'design',
		'icon' => 'columns',
		'description' => 'A responsive grid of pricing plans.',
		'keywords' => array(
			'pricing',
			'plans',
			'table'
		),
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			),
			'spacing' => array(
				'margin' => array(
					'top',
					'bottom'
				)
			)
		),
		'attributes' => array(
			'align' => array(
				'type' => 'string',
				'default' => 'wide'
			),
			'columns' => array(
				'type' => 'number',
				'default' => 3
			)
		),
		'textdomain' => 'folio-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css'
	)
);
