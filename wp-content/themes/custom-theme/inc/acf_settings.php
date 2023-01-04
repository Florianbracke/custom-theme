<?php 
/*--------------------------------------------------------------------------------------*\
| ADD COLOURS PAGE
\*--------------------------------------------------------------------------------------*/
function ACF_colourpage() {   
    acf_add_local_field_group(array(
        'key' => 'group_6315dce19cbdd',
        'title' => 'Colours',
        'fields' => array(
            array(
                'key' => 'field_6315ddc2f64ec',
                'label' => 'Theme colours',
                'name' => 'theme_colours',
                'aria-label' => '',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => 'Add Row',
                'sub_fields' => array(
                    array(
                        'key' => 'field_6315e0a124c0c',
                        'label' => 'Color Name',
                        'name' => 'color_name',
                        'aria-label' => '',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'grijs' => 'grijs',
                            'wit' => 'wit',
                            'zwart' => 'zwart',
                            'geel' => 'geel',
                            'licht-grijs' => 'licht-grijs',
                            'licht-zwart' => 'licht-zwart',
                        ),
                        'default_value' => false,
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'return_format' => 'value',
                        'ajax' => 0,
                        'placeholder' => '',
                        'parent_repeater' => 'field_6315ddc2f64ec',
                    ),
                    array(
                        'key' => 'field_6315e0b024c0d',
                        'label' => 'Color Value',
                        'name' => 'color_value',
                        'aria-label' => '',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'enable_opacity' => 0,
                        'return_format' => 'string',
                        'parent_repeater' => 'field_6315ddc2f64ec',
                    ),
                ),
                'rows_per_page' => 20,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'options page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
}
if( function_exists('acf_add_local_field_group') ){
    add_action('acf/init', 'ACF_colourpage');
}

    
/*--------------------------------------------------------------------------------------*\
| ADD OPTIONS PAGE
\*--------------------------------------------------------------------------------------*/
function ACF_optionspage() {
    acf_add_local_field_group(array(
        'key' => 'group_636a22febcae7',
        'title' => 'Options page',
        'fields' => array(
            array(
                'key' => 'field_636a243b64401',
                'label' => 'Gegevens',
                'name' => 'gegevens',
                'type' => 'group',
                'instructions' => 'Vul hier de gegevens van je bedrijf in. Dit wordt aan de klanten getoont.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_636a244d64402',
                        'label' => 'Email',
                        'name' => 'email',
                        'type' => 'email',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_636a245464403',
                        'label' => 'Telefoon nummer',
                        'name' => 'telefoon_nummer',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_636a246c64404',
                        'label' => 'Straat + nummer',
                        'name' => 'straat_nummer',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_636a248164405',
                        'label' => 'Gemeente + postcode',
                        'name' => 'gemeente_postcode',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_636a258c8634f',
                        'label' => 'Naam bedrijf',
                        'name' => 'naam_bedrijf',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_636a23b4a16cf',
                        'label' => 'Maatschappelijke zetel',
                        'name' => 'maatschappelijke_zetel',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_636a23afa16ce',
                        'label' => 'Ondernemingsnummer',
                        'name' => 'ondernemingsnummer',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
}
if( function_exists('acf_add_local_field_group') ){
    add_action('acf/init', 'ACF_optionspage');
}
