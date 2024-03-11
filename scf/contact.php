<?php
function contact_page_fields( $settings, $type, $id, $meta_type, $types ) {
	if ( $id == 788 && $type === 'page' ) {

		$Section = SCF::add_setting( 'contacts', 'Map settings' );

		$Section->add_group(
			'contacts_settings',
			false,
			array(
				array(
					'name'        => 'map_key',
					'label'       => 'Map key',
					'type'        => 'text',
					'notes'       => 'Get Google maps API key https://developers.google.com/maps/documentation/javascript/get-api-key',
				),
				array(
					'name'        => 'LatLng',
					'label'       => 'Coordinates',
					'type'        => 'text',
					'notes'       => 'Get coord from Google maps https://support.google.com/maps/answer/18539?hl=en&co=GENIE.Platform%3DDesktop',
				),
				array(
					'name'        => 'map_zoom',
					'label'       => 'Map zoom',
					'type'        => 'text',
					'default'     => 10,
				),
				array(
					'name'        => 'map_marker',
					'label'       => 'Map marker',
					'type'        => 'image',
					'size'        => 'medium',
				),
			)
		);

		$settings[] = $Section;
	}

	return $settings;
}
add_filter( 'smart-cf-register-fields', 'contact_page_fields', 7, 5 );
