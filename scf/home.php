<?php
if ( ! defined( 'HOME_ID' ) ) {
	define( 'HOME_ID', 8 );
}

function home_first_section_fields( $settings, $type, $id, $meta_type, $types ) {
	if ( $id == HOME_ID && $type === 'page' ) {

		$Section = SCF::add_setting( 'home-1', 'First section' );

		$Section->add_group(
			'first_section',
			false,
			array(
				array(
					'name'        => 'first__title',
					'label'       => 'First section title',
					'type'        => 'text',
				),
				array(
					'name'        => 'first__text',
					'label'       => 'First section text',
					'type'        => 'wysiwyg',
				),
				array(
					'name'        => 'first__bg',
					'label'       => 'First section background',
					'type'        => 'image',
					'size'        => 'medium',
				),
				array(
					'name'        => 'first__json',
					'label'       => 'First section animation',
					'type'        => 'file',
					'notice'	  => 'Json animation file'
				),
				array(
					'name'        => 'first__video',
					'label'       => 'First section video',
					'type'        => 'file',
				),
				array(
					'name'        => 'first__btn',
					'label'       => 'First section button text',
					'type'        => 'text',
				),
				array(
					'name'        => 'first__btn_link',
					'label'       => 'First section button link',
					'type'        => 'text',
				),
			)
		);

		$settings[] = $Section;
	}

	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_first_section_fields', 1, 5 );

function home_perks_section_fields( $settings, $type, $id, $meta_type, $types ) {
	if ( $id == HOME_ID && $type === 'page' ) {

		$Section = SCF::add_setting( 'home-2', 'Perks of Shopping' );

		$Section->add_group(
			'perks_section',
			false,
			array(
				array(
					'name'        => 'perks__title',
					'label'       => 'Section title',
					'type'        => 'text',
				),
				array(
					'name'        => 'perks__text',
					'label'       => 'Section text',
					'type'        => 'wysiwyg',
				),
			)
		);

		$Section->add_group(
			'perks_section_list',
			true,
			array(
				array(
					'name'        => 'perks__img',
					'label'       => 'List item image',
					'type'        => 'file',
				),
				array(
					'name'        => 'perks__name',
					'label'       => 'List item description',
					'type'        => 'text',
				),
			)
		);

		$settings[] = $Section;
	}

	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_perks_section_fields', 2, 5 );

function home_products_section_fields( $settings, $type, $id, $meta_type, $types ) {
	if ( $id == HOME_ID && $type === 'page' ) {

		$Section = SCF::add_setting( 'home-3', 'Product categories' );

		$Section->add_group(
			'products_section',
			false,
			array(
				array(
					'name'        => 'products__title',
					'label'       => 'Section title',
					'type'        => 'text',
				),
				array(
					'name'        => 'products__text',
					'label'       => 'Section text',
					'type'        => 'wysiwyg',
				),
				array(
					'name'        => 'products__bg',
					'label'       => 'Section background',
					'type'        => 'image',
					'size'        => 'medium',
				),
				array(
					'name'        => 'products__bg_json',
					'label'       => 'Section background animation',
					'type'        => 'file',
				),
				array(
					'type'        => 'relation',
					'name'        => 'products__list',
					'label'       => 'Products list',
					'post-type'   => array('product'),
					'limit'       => 4,
				),
			)
		);

		$Section->add_group(
			'products_section_points',
			true,
			array(
				array(
					'name'        => 'products__img',
					'label'       => 'List item image',
					'type'        => 'image',
					'size'        => 'medium',
				),
				array(
					'name'        => 'products__descr',
					'label'       => 'List item description',
					'type'        => 'text',
				),
			)
		);

		$settings[] = $Section;
	}

	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_products_section_fields', 3, 5 );

function home_thc_section_fields( $settings, $type, $id, $meta_type, $types ) {
	if ( $id == HOME_ID && $type === 'page' ) {

		$Section = SCF::add_setting( 'home-4', 'THC vs CBD' );

		$Section->add_group(
			'thc_section',
			false,
			array(
				array(
					'name'        => 'thc__title',
					'label'       => 'Section title',
					'type'        => 'text',
				),
				array(
					'name'        => 'thc__bg',
					'label'       => 'Section background',
					'type'        => 'image',
					'size'        => 'medium',
				),
			)
		);

		$Section->add_group(
			'thc_column',
			false,
			array(
				array(
					'name'        => 'thc__img',
					'label'       => 'THC image',
					'type'        => 'image',
					'size'        => 'medium',
				),
				array(
					'name'        => 'thc__json',
					'label'       => 'THC animation',
					'type'        => 'file',
				),
				array(
					'name'        => 'thc__text',
					'label'       => 'THC text',
					'type'        => 'wysiwyg',
				),
			)
		);


		$Section->add_group(
			'cbd_column',
			false,
			array(
				array(
					'name'        => 'cbd__img',
					'label'       => 'CBD image',
					'type'        => 'image',
					'size'        => 'medium',
				),
				array(
					'name'        => 'cbd__json',
					'label'       => 'CBD animation',
					'type'        => 'file',
				),
				array(
					'name'        => 'cbd__text',
					'label'       => 'CBD text',
					'type'        => 'wysiwyg',
				),
			)
		);


		$settings[] = $Section;
	}

	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_thc_section_fields', 4, 5 );

function home_cbd_section_fields( $settings, $type, $id, $meta_type, $types ) {
	if ( $id == HOME_ID && $type === 'page' ) {

		$Section = SCF::add_setting( 'home-5', 'CBD Section' );

		$Section->add_group(
			'cbd_section',
			false,
			array(
				array(
					'name'        => 'cbd__title',
					'label'       => 'Section title',
					'type'        => 'text',
				),
				array(
					'name'        => 'cbd__bg',
					'label'       => 'Section background',
					'type'        => 'image',
					'size'        => 'medium',
				),
				array(
					'name'        => 'cbd__cub',
					'label'       => 'Section sub',
					'type'        => 'textarea',
				),
				array(
					'name'        => 'cbd__list',
					'label'       => 'Section list',
					'type'        => 'wysiwyg',
				),
				array(
					'name'        => 'cbd__image',
					'label'       => 'Section image',
					'type'        => 'file',
				),
			)
		);

		$settings[] = $Section;
	}

	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_cbd_section_fields', 5, 5 );

function home_choice_section_fields( $settings, $type, $id, $meta_type, $types ) {
	if ( $id == HOME_ID && $type === 'page' ) {

		$Section = SCF::add_setting( 'home-6', 'What’s the right' );

		$Section->add_group(
			'choice_section',
			false,
			array(
				array(
					'name'        => 'choice__title',
					'label'       => 'Section title',
					'type'        => 'text',
				),
				array(
					'name'        => 'choice__sub',
					'label'       => 'Section subtitle',
					'type'        => 'textarea',
				),
				array(
					'name'        => 'choice__bg',
					'label'       => 'Section background',
					'type'        => 'image',
					'size'        => 'medium',
				),
				array(
					'name'        => 'choice__json',
					'label'       => 'Section background animation',
					'type'        => 'file',
				),
				array(
					'name'        => 'choice__text',
					'label'       => 'Section bottom text',
					'type'        => 'textarea',
				),
			)
		);

		$Section->add_group(
			'choice_list',
			true,
			array(
				array(
					'name'        => 'choice__img',
					'label'       => 'List item image',
					'type'        => 'image',
					'size'        => 'medium',
				),
				array(
					'name'        => 'choice__name',
					'label'       => 'List item name',
					'type'        => 'text',
				),
			)
		);

		$settings[] = $Section;
	}

	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_choice_section_fields', 6, 5 );

function home_faqs_section_fields( $settings, $type, $id, $meta_type, $types ) {
	if ( $id == HOME_ID && $type === 'page' ) {

		$Section = SCF::add_setting( 'home-7', 'FAQs' );

		$Section->add_group(
			'faqs_section',
			false,
			array(
				array(
					'name'        => 'faqs__title',
					'label'       => 'Section title',
					'type'        => 'text',
				),
			)
		);

		$settings[] = $Section;
	}

	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_faqs_section_fields', 7, 5 );

function home_ready_section_fields( $settings, $type, $id, $meta_type, $types ) {
	if ( $id == HOME_ID && $type === 'page' ) {

		$Section = SCF::add_setting( 'home-8', 'Ready to Shop' );

		$Section->add_group(
			'ready_section',
			false,
			array(
				array(
					'name'        => 'ready__title',
					'label'       => 'Section title',
					'type'        => 'text',
				),
				// array(
				// 	'name'        => 'ready__bg',
				// 	'label'       => 'Section background',
				// 	'type'        => 'image',
				// 	'size'        => 'medium',
				// ),
				array(
					'name'        => 'ready__sub',
					'label'       => 'Section sub',
					'type'        => 'textarea',
				),
				array(
					'name'        => 'ready__image',
					'label'       => 'Section image',
					'type'        => 'file',
				),
			)
		);

		$settings[] = $Section;
	}

	return $settings;
}
add_filter( 'smart-cf-register-fields', 'home_ready_section_fields', 8, 5 );
