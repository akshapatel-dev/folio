import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl, TextControl, TextareaControl } from '@wordpress/components';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { name, price, note, features, featured, badgeText, buttonText, buttonUrl } = attributes;

	const items = features
		.split( '\n' )
		.map( ( line ) => line.trim() )
		.filter( Boolean );

	const blockProps = useBlockProps( {
		className: featured ? 'folio-plan is-featured' : 'folio-plan',
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Plan settings', 'folio-blocks' ) }>
					<ToggleControl
						label={ __( 'Highlight this plan', 'folio-blocks' ) }
						checked={ featured }
						onChange={ ( value ) => setAttributes( { featured: value } ) }
					/>
					{ featured && (
						<TextControl
							label={ __( 'Badge text', 'folio-blocks' ) }
							value={ badgeText }
							onChange={ ( value ) => setAttributes( { badgeText: value } ) }
						/>
					) }
					<TextareaControl
						label={ __( 'Features (one per line)', 'folio-blocks' ) }
						value={ features }
						rows={ 6 }
						onChange={ ( value ) => setAttributes( { features: value } ) }
					/>
				</PanelBody>
				<PanelBody title={ __( 'Button', 'folio-blocks' ) } initialOpen={ false }>
					<TextControl
						label={ __( 'Button text', 'folio-blocks' ) }
						value={ buttonText }
						onChange={ ( value ) => setAttributes( { buttonText: value } ) }
					/>
					<TextControl
						label={ __( 'Button link', 'folio-blocks' ) }
						value={ buttonUrl }
						onChange={ ( value ) => setAttributes( { buttonUrl: value } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				{ featured && badgeText && <p className="folio-plan__badge">{ badgeText }</p> }
				<RichText
					tagName="p"
					className="folio-plan__name"
					value={ name }
					onChange={ ( value ) => setAttributes( { name: value } ) }
					placeholder={ __( 'Plan name', 'folio-blocks' ) }
					allowedFormats={ [] }
				/>
				<RichText
					tagName="p"
					className="folio-plan__price"
					value={ price }
					onChange={ ( value ) => setAttributes( { price: value } ) }
					placeholder={ __( '$0', 'folio-blocks' ) }
					allowedFormats={ [] }
				/>
				<RichText
					tagName="p"
					className="folio-plan__note"
					value={ note }
					onChange={ ( value ) => setAttributes( { note: value } ) }
					placeholder={ __( 'Short description', 'folio-blocks' ) }
					allowedFormats={ [] }
				/>
				<ul className="folio-plan__features">
					{ items.map( ( item, index ) => (
						<li key={ index }>{ item }</li>
					) ) }
				</ul>
				<div className="wp-block-buttons">
					<div className={ featured ? 'wp-block-button' : 'wp-block-button is-style-outline' }>
						<span className="wp-block-button__link wp-element-button">{ buttonText }</span>
					</div>
				</div>
			</div>
		</>
	);
}