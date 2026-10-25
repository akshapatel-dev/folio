import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
	InspectorControls,
	InnerBlocks,
} from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';
import './editor.scss';

const ALLOWED_BLOCKS = [ 'folio/pricing-plan' ];

const TEMPLATE = [
	[
		'folio/pricing-plan',
		{
			name: 'Starter',
			price: '$499',
			note: 'One landing page',
			features: 'Responsive design\nContact form\nBasic SEO setup',
		},
	],
	[
		'folio/pricing-plan',
		{
			name: 'Business',
			price: '$1,499',
			note: 'Custom multi-page website',
			features:
				'Up to 8 custom pages\nCustom post types and fields\nSpeed and SEO optimization\n30 days of support',
			featured: true,
		},
	],
	[
		'folio/pricing-plan',
		{
			name: 'Store',
			price: '$2,999',
			note: 'WooCommerce online store',
			features:
				'Full store setup\nPayment gateway integration\nCustom checkout\n60 days of support',
		},
	],
];

export default function Edit( { attributes, setAttributes } ) {
	const { columns } = attributes;

	const blockProps = useBlockProps( {
		className: 'folio-pricing-table',
		style: { '--folio-columns': columns },
	} );

	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		allowedBlocks: ALLOWED_BLOCKS,
		template: TEMPLATE,
		orientation: 'horizontal',
		renderAppender: InnerBlocks.ButtonBlockAppender,
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Layout', 'folio-blocks' ) }>
					<RangeControl
						label={ __( 'Columns', 'folio-blocks' ) }
						value={ columns }
						onChange={ ( value ) => setAttributes( { columns: value } ) }
						min={ 1 }
						max={ 4 }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...innerBlocksProps } />
		</>
	);
}