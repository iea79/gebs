<?php
function faqs_section_fields( $settings, $type, $id, $meta_type, $types ) {
	if ( $id == 38 && $type === 'page' ) {

		$Section = SCF::add_setting( 'faqs', 'FAQs' );

		$Section->add_group(
			'faqs_list',
			true,
			array(
				array(
					'name'        => 'faqs__name',
					'label'       => 'FAQ name',
					'type'        => 'text',
				),
				array(
					'name'        => 'faqs__text',
					'label'       => 'FAQ text',
					'type'        => 'wysiwyg',
				),
			)
		);

        $Section->add_group(
			'faqs_button',
			false,
			array(
				array(
					'name'        => 'faqs__btn',
					'label'       => 'FAQs button text',
					'type'        => 'text',
				),
			)
		);

		$settings[] = $Section;
	}

	return $settings;
}
add_filter( 'smart-cf-register-fields', 'faqs_section_fields', 7, 5 );
