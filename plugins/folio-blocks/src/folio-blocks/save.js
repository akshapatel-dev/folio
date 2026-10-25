import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { name, price, note, features, featured, badgeText, buttonText, buttonUrl } = attributes;

	const items = features
		.split( '\n' )
		.map( ( line ) => line.trim() )
		.filter( Boolean );

	const blockProps = useBlockProps.save( {
		className: featured ? 'folio-plan is-featured' : 'folio-plan',
	} );

	return (
		<div { ...blockProps }>
			{ featured && badgeText && <p className="folio-plan__badge">{ badgeText }</p> }
			<RichText.Content tagName="p" className="folio-plan__name" value={ name } />
			<RichText.Content tagName="p" className="folio-plan__price" value={ price } />
			<RichText.Content tagName="p" className="folio-plan__note" value={ note } />
			<ul className="folio-plan__features">
				{ items.map( ( item, index ) => (
					<li key={ index }>{ item }</li>
				) ) }
			</ul>
			<div className="wp-block-buttons">
				<div className={ featured ? 'wp-block-button' : 'wp-block-button is-style-outline' }>
					<a className="wp-block-button__link wp-element-button" href={ buttonUrl }>
						{ buttonText }
					</a>
				</div>
			</div>
		</div>
	);
}