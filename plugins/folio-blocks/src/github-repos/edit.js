import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	RangeControl,
	SelectControl,
	ToggleControl,
	Disabled,
} from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { username, count, sortBy, hideForks } = attributes;
	const [ draft, setDraft ] = useState( username );
	const blockProps = useBlockProps();

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'GitHub settings', 'folio-blocks' ) }>
					<TextControl
						label={ __( 'GitHub username', 'folio-blocks' ) }
						help={ __( 'Click outside the field to load the repositories.', 'folio-blocks' ) }
						value={ draft }
						onChange={ setDraft }
						onBlur={ () => setAttributes( { username: draft.trim() } ) }
					/>
					<RangeControl
						label={ __( 'Number of repositories', 'folio-blocks' ) }
						value={ count }
						onChange={ ( value ) => setAttributes( { count: value } ) }
						min={ 1 }
						max={ 12 }
					/>
					<SelectControl
						label={ __( 'Sort by', 'folio-blocks' ) }
						value={ sortBy }
						options={ [
							{ label: __( 'Recently updated', 'folio-blocks' ), value: 'updated' },
							{ label: __( 'Most stars', 'folio-blocks' ), value: 'stars' },
						] }
						onChange={ ( value ) => setAttributes( { sortBy: value } ) }
					/>
					<ToggleControl
						label={ __( 'Hide forks', 'folio-blocks' ) }
						checked={ hideForks }
						onChange={ ( value ) => setAttributes( { hideForks: value } ) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<Disabled>
					<ServerSideRender block="folio/github-repos" attributes={ attributes } />
				</Disabled>
			</div>
		</>
	);
}