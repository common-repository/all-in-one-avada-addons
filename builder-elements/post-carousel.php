<?php

require_once(PLUGIN_PATH.'template/shortcode-post-carousel.php');

if(!function_exists('aio_post_carousel_element')){
    function aio_add_post_carousel_element() {

    fusion_builder_map(
                fusion_builder_frontend_data(
                'FusionPostCarousel',
                [
                    'name'              => esc_attr__('Post Carousel AIO', 'avada_addons'),
                    'shortcode'         => 'carousel_post_type',
                    'icon'              => 'fusiona-tag',
                    'help_url'          => 'https://theme-fusion.com/documentation/avada_addons/elements/button-element/',
                    'inline_editor'     => true,
                    'params'            => [
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Post Type Name', 'avada_addons' ),
                            'description' => esc_attr__( 'Enter the name of the post type you want to view. Default is Post.', 'avada_addons' ),
                            'param_name'  => 'post_type',
                            'value'       => aio_carousel_post_type_class::get_list_post_types(),
                        ],
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Filter by Taxonomy e Term', 'avada_addons' ),
                            'description' => esc_attr__( 'Choose no if you want to get all posts', 'avada_addons' ),
                            'param_name'  => 'filtering_by_taxonomy',
                            'value'       => [
                                'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                                'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'default'     => 'no',
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Taxonomy', 'avada_addons' ),
                            'description' => esc_attr__( 'Write taxonomy slug to filter', 'avada_addons' ),
                            'param_name'  => 'taxonomy',
                            'value'       => '',
                            'dependency'  => [
                                [
                                    'element'  => 'filtering_by_taxonomy',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Terms', 'avada_addons' ),
                            'description' => esc_attr__( 'Write a list of term slug to show.', 'avada_addons' ),
                            'param_name'  => 'terms',
                            'value'       => '',
                            'dependency'  => [
                                [
                                    'element'  => 'filtering_by_taxonomy',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'range',
                            'heading'     => esc_attr__( 'Post per Page', 'avada_addons' ),
                            'description' => esc_attr__( 'Select the number of posts to show in the carousel.', 'avada_addons' ),
                            'param_name'  => 'posts_per_page',
                            'value'       => '-1',
                            'min'         => '-1',
                            'max'         => '300',
                            'step'        => '1',
                        ],
/*                         [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Exclude Categories Slug', 'avada_addons' ),
                            'description' => esc_attr__( 'Filter categories to exclude by Comma-separated slug or leave blank for show all.', 'avada_addons' ),
                            'param_name'  => 'exclude',
                            'value'       => '',
                        ], */
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Order', 'avada_addons' ),
                            'description' => esc_attr__( 'Defines the sorting order of posts.', 'avada_addons' ),
                            'param_name'  => 'order',
                            'default'     => 'DESC',
                            'value'       => [
                                'DESC' => esc_attr__( 'Descending', 'avada_addons' ),
                                'ASC'  => esc_attr__( 'Ascending', 'avada_addons' ),
                            ],
                            'dependency'  => [
                                [
                                    'element'  => 'orderby',
                                    'value'    => 'rand',
                                    'operator' => '!=',
                                ],
                            ],
                            'callback'    => [
                                'function' => 'fusion_ajax',
                                'action'   => 'get_fusion_blog',
                                'ajax'     => true,
                            ],
                        ],
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Order By', 'avada_addons' ),
                            'description' => esc_attr__( 'Defines how posts should be ordered.', 'avada_addons' ),
                            'param_name'  => 'orderby',
                            'default'     => 'date',
                            'value'       => [
                                'date'          => esc_attr__( 'Date', 'avada_addons' ),
                                'title'         => esc_attr__( 'Post Title', 'avada_addons' ),
                                'name'          => esc_attr__( 'Post Slug', 'avada_addons' ),
                                'author'        => esc_attr__( 'Author', 'avada_addons' ),
                                'comment_count' => esc_attr__( 'Number of Comments', 'avada_addons' ),
                                'modified'      => esc_attr__( 'Last Modified', 'avada_addons' ),
                                'rand'          => esc_attr__( 'Random', 'avada_addons' ),
                            ],
                            'callback'    => [
                                'function' => 'fusion_ajax',
                                'action'   => 'get_fusion_blog',
                                'ajax'     => true,
                            ],
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'CSS Class', 'avada_addons' ),
                            'description' => esc_attr__( 'Add a class to the wrapping HTML element.', 'avada_addons' ),
                            'param_name'  => 'class',
                            'value'       => '',
                            'group'       => esc_attr__( 'General', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'CSS ID', 'avada_addons' ),
                            'description' => esc_attr__( 'Add an ID to the wrapping HTML element.', 'avada_addons' ),
                            'param_name'  => 'id',
                            'value'       => '',
                            'group'       => esc_attr__( 'General', 'avada_addons' ),
                        ],
        
                        



                        /**
                         * Owl Options
                         */
                        [
                            'type'        => 'range',
                            'heading'     => esc_attr__( 'Items', 'avada_addons' ),
                            'description' => esc_attr__( 'The number of items you want to see on the screen.', 'avada_addons' ),
                            'param_name'  => 'items_carousel',
                            'value'       => '4',
                            'min'         => '1',
                            'max'         => '12',
                            'step'        => '1',
                            'responsive'  => [
                                'state' => 'large',
                                'additional_states' => [ 'medium', 'small' ],
                            ],
                            'group'       => esc_attr__( 'Owl Options', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Navigation Buttons', 'avada_addons' ),
                            'description' => esc_attr__( 'Show next/prev buttons.', 'avada_addons' ),
                            'param_name'  => 'owl_nav',
                            'value'       => [
                                'true' => esc_attr__( 'Yes', 'avada_addons' ),
                                'false'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'default'     => 'false',
                            'responsive'  => [
                                'state' => 'large',
                                'additional_states' => [ 'medium', 'small' ],
                            ],
                            'group'       => esc_attr__( 'Owl Options', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Dots navigation.', 'avada_addons' ),
                            'description' => esc_attr__( 'Show dots navigation.', 'avada_addons' ),
                            'param_name'  => 'owl_dots_nav',
                            'value'       => [
                                'true' => esc_attr__( 'Yes', 'avada_addons' ),
                                'false'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'default'     => 'false',
                            'responsive'  => [
                                'state' => 'large',
                                'additional_states' => [ 'medium', 'small' ],
                            ],
                            'group'       => esc_attr__( 'Owl Options', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Autoplay', 'avada_addons' ),
                            'param_name'  => 'owl_autoplay',
                            'value'       => [
                                'true' => esc_attr__( 'Yes', 'avada_addons' ),
                                'false'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'default'     => 'true',
                            'group'       => esc_attr__( 'Owl Options', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'range',
                            'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
                            'description' => esc_attr__( 'margin-right(px) on item.', 'avada_addons' ),
                            'param_name'  => 'owl_margin',
                            'value'       => '20',
                            'min'         => '0',
                            'max'         => '300',
                            'step'        => '1',
                            'group'       => esc_attr__( 'Owl Options', 'avada_addons' ),
                        ],

                        /**
                         * Owl Design
                         */
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the background color of the button.', 'avada_addons' ),
                            'param_name'  => 'owl_item_background_color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Owl Design', 'avada_addons' ),
                        ],
                        [
                            'type'          => 'dimension',
                            'heading'       => esc_attr__( 'Border Radius', 'avada_addons' ),
                            'description'   => esc_attr__( 'Choose to the border radius for each image.', 'avada_addons' ),
                            'param_name'    => 'owl_item_border_radius',
                            'value'         => array(
                                'owl_item_border_radius_top'       => '',
                                'owl_item_border_radius_right'     => '',
                                'owl_item_border_radius_bottom'    => '',
                                'owl_item_border_radius_left'      => '',
                            ),
                            'group'       => esc_attr__( 'Owl Design', 'avada_addons' ),
                        ],
                        [
                            'type'          => 'dimension',
                            'heading'       => esc_attr__( 'Item Padding', 'avada_addons' ),
                            'description'   => esc_attr__( 'Choose item padding.', 'avada_addons' ),
                            'param_name'    => 'owl_item_padding',
                            'value'         => array(
                                'owl_item_padding_top'       => '',
                                'owl_item_padding_right'     => '',
                                'owl_item_padding_bottom'    => '',
                                'owl_item_padding_left'      => '',
                            ),
                            'group'       => esc_attr__( 'Owl Design', 'avada_addons' ),
                        ],

                        
                        /**
                         * Image Group
                         */
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Show Image preview', 'avada_addons' ),
                            'description' => esc_attr__( 'Choose to show the image preview.', 'avada_addons' ),
                            'param_name'  => 'show_image',
                            'responsive'  => [
                                'state' => 'large',
                                'additional_states' => [ 'medium', 'small' ],
                            ],
                            'value'       => [
                                'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                                'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'default'     => 'yes',
                            'group'       => esc_attr__( 'Image', 'avada_addons' ),
                        ],


                        /**
                         * Title Group
                         */
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Show Title', 'avada_addons' ),
                            'description' => esc_attr__( 'Choose to show the title.', 'avada_addons' ),
                            'param_name'  => 'show_title',
                            'responsive'  => [
                                'state' => 'large',
                                'additional_states' => [ 'medium', 'small' ],
                            ],
                            'value'       => [
                                'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                                'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'default'     => 'yes',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Title Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'title_color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Font Size', 'avada_addons' ),
                            /* translators: URL for the link. */
                            'description' => sprintf( esc_html__( 'Controls the font size of the title. Enter value including any valid CSS unit, ex: 20px. Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'avada_addons' )),
                            'param_name'  => 'font_size_title',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        ],
                        [
                            'type'             => 'font_family',
                            'remove_from_atts' => true,
                            'heading'          => esc_attr__( 'Font Family', 'avada_addons' ),
                            /* translators: URL for the link. */
                            'description'      => sprintf( esc_html__( 'Controls the font family of the title text.  Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'avada_addons' ) ),
                            'param_name'       => 'title',
                            'group'            => esc_attr__( 'Title', 'avada_addons' ),
                            'default'          => [
                                'font-family'  => '',
                                'font-variant' => '400',
                            ],
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Line Height', 'avada_addons' ),
                            /* translators: URL for the link. */
                            'description' => sprintf( esc_html__( 'Controls the line height of the title. Enter value including any valid CSS unit, ex: 28px. Leave empty if the global line height for the corresponding heading size (h1-h6) should be used.', 'avada_addons' )),
                            'param_name'  => 'font_title_line_height',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Letter Spacing ', 'avada_addons' ),
                            /* translators: URL for the link. */
                            'description' => sprintf( esc_html__( 'Controls the letter spacing of the title. Enter value including any valid CSS unit, ex: 2px. Leave empty if the global letter spacing for the corresponding heading size (h1-h6) should be used.', 'avada_addons' )),
                            'param_name'  => 'font_title_letter_spacing',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Text transfom', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to choose the text transform style.', 'avada_addons' ),
                            'param_name'  => 'title_text_transform',
                            'value'       => array(
                                'none'          => esc_attr__( 'None', 'avada_addons' ),
                                'capitalize'    => esc_attr__( 'Capitalize', 'avada_addons' ),
                                'uppercase'     => esc_attr__( 'Uppercase', 'avada_addons' ),
                                'lowercase'     => esc_attr__( 'Lowercase', 'avada_addons' ),
                                'initial'       => esc_attr__( 'Initial', 'avada_addons' ),
                                'inherit'       => esc_attr__( 'Inherit', 'avada_addons' ),
                            ),
                            'default'     => 'none',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),                       
                        ],
                        [
                            'type'          => 'dimension',
                            'heading'       => esc_attr__( 'Title Padding', 'avada_addons' ),
                            'description'   => esc_attr__( 'Choose to the padding.', 'avada_addons' ),
                            'param_name'    => 'title_padding',
                            'value'         => array(
                                'title_padding_top'       => '',
                                'title_padding_right'     => '',
                                'title_padding_bottom'    => '',
                                'title_padding_left'      => '',
                            ),
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        ],
                        [
                            'type'          => 'dimension',
                            'heading'       => esc_attr__( 'Title Margin', 'avada_addons' ),
                            'description'   => esc_attr__( 'Choose to the margin.', 'avada_addons' ),
                            'param_name'    => 'title_margin',
                            'value'         => array(
                                'title_margin_top'       => '',
                                'title_margin_right'     => '',
                                'title_margin_bottom'    => '',
                                'title_margin_left'      => '',
                            ),
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        ],


                        /**
                         * Content Group
                         */
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Show Content', 'avada_addons' ),
                            'description' => esc_attr__( 'Choose to show the content.', 'avada_addons' ),
                            'param_name'  => 'show_content',
                            'responsive'  => [
                                'state' => 'large',
                                'additional_states' => [ 'medium', 'small' ],
                            ],
                            'value'       => [
                                'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                                'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'default'     => 'yes',
                            'group'       => esc_attr__( 'Content', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Content Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'content_color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Content', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'range',
                            'heading'     => esc_attr__( 'Excerpt Length', 'avada_addons' ),
                            'description' => esc_attr__( 'Insert the Excerpt Length', 'avada_addons' ),
                            'param_name'  => 'excerpt',
                            'value'       => '100',
                            'min'         => '0',
                            'max'         => '3000',
                            'step'        => '1',
                            'group'       => esc_attr__( 'Content', 'avada_addons' ),
                        ],


                        /**
                         * Button Group
                         */
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Show Button', 'avada_addons' ),
                            'description' => esc_attr__( 'Choose to show the button.', 'avada_addons' ),
                            'param_name'  => 'show_button',
                            'responsive'  => [
                                'state' => 'large',
                                'additional_states' => [ 'medium', 'small' ],
                            ],
                            'value'       => [
                                'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                                'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'default'     => 'yes',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'          => 'dimension',
                            'heading'       => esc_attr__( 'Button Padding', 'avada_addons' ),
                            'description'   => esc_attr__( 'Choose to the padding.', 'avada_addons' ),
                            'param_name'    => 'button_padding',
                            'value'         => array(
                                'button_padding_top'       => '',
                                'button_padding_right'     => '',
                                'button_padding_bottom'    => '',
                                'button_padding_left'      => '',
                            ),
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'          => 'dimension',
                            'heading'       => esc_attr__( 'Button Margin', 'avada_addons' ),
                            'description'   => esc_attr__( 'Choose to the margin.', 'avada_addons' ),
                            'param_name'    => 'button_margin',
                            'value'         => array(
                                'button_margin_top'       => '',
                                'button_margin_right'     => '',
                                'button_margin_bottom'    => '',
                                'button_margin_left'      => '',
                            ),
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Font Size', 'avada_addons' ),
                            /* translators: URL for the link. */
                            'description' => sprintf( esc_html__( 'Controls the font size of the button. Enter value including any valid CSS unit, ex: 20px. Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'avada_addons' )),
                            'param_name'  => 'font_size_button',
                            'value'       => '',
                            'group'       => esc_attr__( 'Content', 'avada_addons' ),
                        ],
                        [
                            'type'             => 'font_family',
                            'remove_from_atts' => true,
                            'heading'          => esc_attr__( 'Font Family', 'avada_addons' ),
                            /* translators: URL for the link. */
                            'description'      => sprintf( esc_html__( 'Controls the button family of the title text.  Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'avada_addons' ) ),
                            'param_name'       => 'button',
                            'group'            => esc_attr__( 'Button', 'avada_addons' ),
                            'default'          => [
                                'font-family'  => '',
                                'font-variant' => '400',
                            ],
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Line Height', 'avada_addons' ),
                            /* translators: URL for the link. */
                            'description' => sprintf( esc_html__( 'Controls the line height of the button. Enter value including any valid CSS unit, ex: 28px. Leave empty if the global line height for the corresponding heading size (h1-h6) should be used.', 'avada_addons' )),
                            'param_name'  => 'font_button_line_height',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Letter Spacing ', 'avada_addons' ),
                            /* translators: URL for the link. */
                            'description' => sprintf( esc_html__( 'Controls the letter spacing of the button. Enter value including any valid CSS unit, ex: 2px. Leave empty if the global letter spacing for the corresponding heading size (h1-h6) should be used.', 'avada_addons' )),
                            'param_name'  => 'font_button_letter_spacing',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Button Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the color of the button, ex: #000. Leave empty if the global color for the corresponding heading size (h1-h6) should be used.', 'avada_addons' ),
                            'param_name'  => 'button_color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the background color of the button.', 'avada_addons' ),
                            'param_name'  => 'button_background_color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Text transfom', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to choose the text transform style.', 'avada_addons' ),
                            'param_name'  => 'button_text_transform',
                            'value'       => array(
                                'none'          => esc_attr__( 'None', 'avada_addons' ),
                                'capitalize'    => esc_attr__( 'Capitalize', 'avada_addons' ),
                                'uppercase'     => esc_attr__( 'Uppercase', 'avada_addons' ),
                                'lowercase'     => esc_attr__( 'Lowercase', 'avada_addons' ),
                                'initial'       => esc_attr__( 'Initial', 'avada_addons' ),
                                'inherit'       => esc_attr__( 'Inherit', 'avada_addons' ),
                            ),
                            'default'     => 'none',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),                       
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Button text', 'avada_addons' ),
                            'description' => esc_attr__( 'Type the text should be write in this button.', 'avada_addons' ),
                            'param_name'  => 'button_text',
                            'value'       => 'read more',
                            'default'     => 'none',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),                       
                        ],

                    ],
                ]
    ));
    }

    add_action( 'fusion_builder_before_init', 'aio_add_post_carousel_element' );
    add_action( 'init', 'aio_add_post_carousel_element' );
}
