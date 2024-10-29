<?php
require_once(PLUGIN_PATH.'template/shortcode-credit.php');

if (!function_exists('avada_addons_credit')){
    function avada_addons_credit() {
    fusion_builder_map( 	
                fusion_builder_frontend_data(
                'FusionPostCarousel',
                [
                    'name'              => esc_attr__('Credit AIO', 'avada_addons'),
                    'shortcode'         => 'aio_credit',
                    'icon'              => 'fusiona-tag',
                    'help_url'          => 'https://theme-fusion.com/documentation/avada_addons/elements/button-element/',
                    'inline_editor'     => true,
                    'params'            => [
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Image Max Width', 'avada_addons' ),
                            'description' => esc_attr__( 'Set the max width for the logo credit.', 'avada_addons' ),
                            'param_name'  => 'max_width',
                            'value'       => '100%',
                        ],
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Alignment', 'fusion-builder' ),
                            'description' => esc_attr__( 'Choose to align the image left, right or center.', 'fusion-builder' ),
                            'param_name'  => 'align-credit-image',
                            'value'       => array(
                                    'left'      => esc_attr__( 'Left', 'fusion-builder' ),
                                    'center'    => esc_attr__( 'Center', 'fusion-builder' ),
                                    'right'     => esc_attr__( 'Right', 'fusion-builder' ),
                                ),
                            'default'     =>   'center',
                            'responsive'  => [
                                'state' => 'large',
                                'additional_states' => [ 'medium', 'small' ],
                            ],
                        ],
                    ],
                ]
    ));
    }
    add_action( 'fusion_builder_before_init', 'avada_addons_credit' );
}




