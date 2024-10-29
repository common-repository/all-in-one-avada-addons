<?php

global $aio_avada;

if(!class_exists('aio_carousel_post_type_class')){

    class aio_carousel_post_type_class{

        public $aio_avada, $atts, $css, $output_css, $counter, $all_news;
        public $i = 0;

        public function __construct($opt_var){

            /**
             * Get Aio Options Setting
             * Don't change it.
             */
            $this->aio_avada = get_option('aio_avada');

            add_action('wp_head', array($this, 'aio_add_owl_library'));

            /**
             * Shortcode Registration
             * This is custom condition and change for each of element builder type
             */
            add_shortcode('carousel_post_type', array($this, 'aio_carousel_post_type_shortcode_generator'));

            /**
             * Get a list of all Post types
             */
            add_action( 'init', array($this, 'get_list_post_types') );

            /**
             * Get a list of all Taxonomies
             */
            add_action( 'init', array($this, 'get_list_taxonomies') );
        }

        /**
         * Load Owl Carousel Scripts
         *
         * @return void
         */
        public function aio_add_owl_library(){
            ?>
            <link rel="stylesheet" href="<?php echo PLUGIN_URL.'inc/owl-carousel/node_modules/owl.carousel/dist/assets/owl.carousel.min.css' ?>">
            <link rel="stylesheet" href="<?php echo PLUGIN_URL.'inc/owl-carousel/node_modules/owl.carousel/dist/assets/owl.theme.default.min.css' ?>">
            <script src="<?php echo PLUGIN_URL.'inc/owl-carousel/node_modules/jquery/dist/jquery.min.js' ?>"></script>
            <script src="<?php echo PLUGIN_URL.'inc/owl-carousel/node_modules/owl.carousel/dist/owl.carousel.min.js' ?>"></script>
            <script>

           jQuery(document).ready(function(){
                jQuery(".owl-carousel").owlCarousel();
            });

            </script>

            <?php
        }


        public function aio_carousel_post_type_shortcode_generator($atts){
            
            /**
             * Generation shortcode atts
             * These are custom condition and change for each of element builder type
             */

            $this->atts = shortcode_atts (
                array(
                    'post_type'                         => '',
                    'posts_per_page'                    => '-1', 
                    'exclude'                           => '', //(array) An array of post IDs not to retrieve. Default empty array.
                    'order'                             => '', //(string) Designates ascending or descending order of posts. Default 'DESC'. Accepts 'ASC', 'DESC'.
                    'orderby'                           => '', //Accepts 'none', 'name', 'author', 'date', 'title', 'modified', 'menu_order', 'parent', 'ID', 'rand', 'relevance', 'RAND(x)' (where 'x' is an integer seed value), 'comment_count', 'meta_value', 'meta_value_num', 'post__in', 'post_name__in', 'post_parent__in', and the array keys of $meta_query. Default is 'date', except when a search is being performed, when the default is 'relevance'.,
                    'items_carousel'                    => '',
                    'items_carousel_medium'             => '',
                    'items_carousel_small'              => '',
                    'owl_nav'                           => '',
                    'owl_nav_medium'                    => '',
                    'owl_nav_small'                     => '',
                    'owl_dots_nav'                      => '',
                    'owl_dots_nav_medium'               => '',
                    'owl_dots_nav_small'                => '',
                    'owl_autoplay'                      => '',
                    'owl_margin'                        => '',
                    'owl_item_background_color'         => '',
                    'owl_item_border_radius_top'        => '',
                    'owl_item_border_radius_right'      => '',
                    'owl_item_border_radius_bottom'     => '',
                    'owl_item_border_radius_left'       => '',
                    'owl_item_padding_top'              => '',
                    'owl_item_padding_right'            => '',
                    'owl_item_padding_bottom'           => '',
                    'owl_item_padding_left'             => '',

                    //BUTTON TAB
                    'show_button'                   => '',
                    'show_button_medium'            => '',
                    'show_button_small'             => '',
                    'button_padding_top'            => '',
                    'button_padding_right'          => '',
                    'button_padding_bottom'         => '',
                    'button_padding_left'           => '',
                    'button_margin_top'             => '',
                    'button_margin_right'           => '',
                    'button_margin_bottom'          => '',
                    'button_margin_left'            => '',
                    'fusion_font_family_button'     => '',
                    'fusion_font_variant_button'    => '',
                    'font_size_button'              => '',
                    'font_button_line_height'       => '',
                    'font_button_letter_spacing'    => '',
                    'button_color'                  => '',
                    'button_background_color'       => '',
                    'button_text_transform'         => '',
                    'button_text'                   => '',


                    'show_content'                  => '',
                    'show_content_medium'           => '',
                    'show_content_small'            => '',
                    'show_title'                    => '',
                    'show_title_medium'             => '',
                    'show_title_small'              => '',
                    'show_image'                    => '',
                    'show_image_medium'             => '',
                    'show_image_small'              => '',
                    'show_link'                     => '',
                    'filtering_by_taxonomy'         => '',
                    'taxonomy'                      => '',
                    'field'                         => 'slug',
                    'terms'                         => array(''),
                    'excerpt'                       => '100',
                    'title_color'                   => '',
                    'excerpt_symbol'                => '',
                    'content_color'                 => '',
                    'class'                         => '',
                    'id'                            => '',
                    'fusion_font_family_title'      => '',
                    'fusion_font_variant_title'     => '',
                    'font_size_title'               => '',
                    'font_title_line_height'        => '',
                    'font_title_letter_spacing'     => '',
                    'title_text_transform'          => '',

                    'title_padding_top'             => '',
                    'title_padding_right'           => '',
                    'title_padding_bottom'          => '',
                    'title_padding_left'            => '',
                    
                    'title_margin_top'              => '',
                    'title_margin_right'            => '',
                    'title_margin_bottom'           => '',
                    'title_margin_left'             => '',
                    
                ), $atts, 'carousel_post_type'
            );

            //Atts conditions
            if($this->atts['filtering_by_taxonomy']=='yes'){
                $args = array(
                    'post_type' => $this->atts['post_type'],
                    'posts_per_page' => $this->atts['posts_per_page'],
                    'exclude' => $this->atts['exclude'],
                    'order' => $this->atts['order'],
                    'orderby' => $this->atts['orderby'],
                    'tax_query' => array(
                        array(
                            'taxonomy' => $this->atts['taxonomy'],
                            'field'    => 'slug',
                            'terms'    => explode(",", $this->atts['terms']),
                        ),
                    )
                );
                $this->all_news = new WP_Query($args);
            }
    
            if($this->atts['filtering_by_taxonomy']=='no'){
                $args_no_cat = array(
                    'post_type' => $this->atts['post_type'],
                    'posts_per_page' => $this->atts['posts_per_page'],
                    //'exclude' => $this->atts['exclude'],
                    'order' => $this->atts['order'],
                    'orderby' => $this->atts['orderby'],
                );
                $this->all_news = new WP_Query($args_no_cat);
            }
            
            return $this->aio_carousel_post_type_render_html();
    
        }

        public function aio_carousel_post_type_render_html(){

            /**
             * Variable to retrive. This variable memorize the html code
             * Don't change it.
             */
            $html = null;

            /**
             * Element Counter Implementation
             * Don't change it.
             */
            $this->i ++;
            
            /**
             * Conditional Class
             */
            //IMAGE VISIBILITY
            if($this->atts['show_image']=='no'){
                $image_visibility[] = 'aio-large-hidden';
            }else{
                $image_visibility[] = '';
            }
            if($this->atts['show_image_medium']=='no'){
                $image_visibility[] = 'aio-medium-hidden';
            }else{
                $image_visibility[] = '';
            }
            if($this->atts['show_image_small']=='no'){
                $image_visibility[] = 'aio-small-hidden';
            }else{
                $image_visibility[] = '';
            }
            //TITLE VISIBILITY
            if($this->atts['show_title']=='no'){
                $title_visibility[] = 'aio-large-hidden';
            }else{
                $title_visibility[] = '';
            }
            if($this->atts['show_title_medium']=='no'){
                $title_visibility[] = 'aio-medium-hidden';
            }else{
                $title_visibility[] = '';
            }
            if($this->atts['show_title_small']=='no'){
                $title_visibility[] = 'aio-small-hidden';
            }else{
                $title_visibility[] = '';
            }
            //CONTENT VISIBILITY
            if($this->atts['show_content']=='no'){
                $content_visibility[] = 'aio-large-hidden';
            }else{
                $content_visibility[] = '';
            }
            if($this->atts['show_content_medium']=='no'){
                $content_visibility[] = 'aio-medium-hidden';
            }else{
                $content_visibility[] = '';
            }
            if($this->atts['show_content_small']=='no'){
                $content_visibility[] = 'aio-small-hidden';
            }else{
                $content_visibility[] = '';
            }
            //BUTTON VISIBILITY
            if($this->atts['show_button']=='no'){
                $button_visibility[] = 'aio-large-hidden';
            }else{
                $button_visibility[] = '';
            }
            if($this->atts['show_button_medium']=='no'){
                $button_visibility[] = 'aio-medium-hidden';
            }else{
                $button_visibility[] = '';
            }
            if($this->atts['show_button_small']=='no'){
                $button_visibility[] = 'aio-small-hidden';
            }else{
                $button_visibility[] = '';
            }
            
            
            ob_start();
            /**
             * Html to renderize in frontend
             * This is a custom condition and change for each of element builder type
             */
            $html .= '<div id="aio-carousel-'.$this->i.'" class="owl-carousel">';

            if ( $this->all_news->have_posts() ) {
                while ( $this->all_news->have_posts() ) { 
                    $this->all_news->the_post();

                    $image_preview = get_the_post_thumbnail();
                    $link = get_permalink();
                    $title = get_the_title();
                    $content = get_the_content();

                    $html .= '<div id="'.$this->atts['id'].'" class="item '.$this->atts['class'].'">';

                            if($this->atts['show_link']=='yes'){
                        $html .= '<a href="'.$link.'">';
                            }
                        $html .= '<div class="aio-image-preview '.implode(" ", $image_visibility).'">';
                            $html .= $image_preview;
                        $html .= '</div>';
                        $html .= '</a>';

                        $html .= '<div class="aio-single-content-carousel">';

                        $html .= '<div class="aio-carousel-title '.implode(" ", $title_visibility).'">';
                            if($this->atts['show_link']=='yes'){
                                $html .= '<a href="'.$link.'">';
                            }
                            $html .= $title;
                                if($this->atts['show_link']=='yes'){
                            $html .= '</a>';
                            }
                                    $html .= '</div>';
                        
                        $html .= '<div class="aio-carousel-excerpt '.implode(" ", $content_visibility).'"><p>'.substr($content, 0, $this->atts['excerpt']);
                            $html .= ' <span class="aio-excerpt-symbol">[...]</span></div>';

                            $html .= '<div class="aio-single-button-owl"><a class="button-single-news-carousel '.implode(" ", $button_visibility).'" href="'.$link.'">'.__($this->atts['button_text'], "avada_addons").'</a></div>';

                        $html .= '</div>';
                        $html .= '</div>';
                
                };
            };

            $html .= '</div>';

            $script = '<script> jQuery(".owl-carousel").owlCarousel({
                loop:true,
                margin: '.$this->atts['owl_margin'].',
                autoplay: '.$this->atts['owl_autoplay'].',
                responsive:{
                    0:{
                        items: '.$this->atts['items_carousel_small'].',
                        nav: '.$this->atts['owl_nav_small'].',
                        dots: '.$this->atts['owl_dots_nav_small'].',
                    },
                    '.$this->aio_avada['aio-small-brackpoint'].':{
                        items: '.$this->atts['items_carousel_medium'].',
                        nav: '.$this->atts['owl_nav_medium'].',
                        dots: '.$this->atts['owl_dots_nav_medium'].',
                    },
                    '.$this->aio_avada['aio-medium-brackpoint'].':{
                        items: '.$this->atts['items_carousel'].',
                        nav: '.$this->atts['owl_nav'].',
                        dots: '.$this->atts['owl_dots_nav'].',
                    }
                }
            })</script>';

            echo $html;
            echo $script;

            /**
             * Call a function for css generation
             */
            $this->aio_carousel_post_type_css_generator($this->atts, $this->i);
            return ob_get_clean();

        }

        /**
         * Create an array of all post types registered
         */
        public static function get_list_post_types(){

            $post_types = get_post_types(['public'=>true], 'objects');

            foreach ($post_types as $post_type) {
                $post_list[$post_type->name] = $post_type->label;
            }

            return $post_list;

        }

        /**
         * Create an array of all taxonomies
         */
        public static function get_list_taxonomies(){

            $taxonomies = get_taxonomies('', 'objects');

            foreach($taxonomies as $taxonomy){
                $taxonomies_list[$taxonomy->name] = $taxonomy->label;
            }

            return($taxonomies_list);

        }

        public function aio_carousel_post_type_css_generator($atts, $counter){

            $this->css = null;
            /**
             * Element Counter Implementation
             * Don't change it.
             */
            $this->i = $counter;
            
            $this->css .= '#aio-carousel-'.$this->i.' .owl-stage {';
                $this->css .= 'display: grid; grid-auto-flow: column;';
            $this->css .= '}';

            /**
             * 'owl_item_background_color'
             */
            $this->css .= '#aio-carousel-'.$this->i.' {';
                if($this->atts['owl_item_background_color']){
                    $this->css .= 'background-color: '.$this->atts['owl_item_background_color'].'; display: block !important;';
                }


                
                if($this->atts['owl_item_border_radius_top'] || $this->atts['owl_item_border_radius_right'] || $this->atts['owl_item_border_radius_bottom'] || $this->atts['owl_item_border_radius_left']){
                    $owl_border_radius_item[] = 'border-radius: ';
                    if($this->atts['owl_item_border_radius_top']){
                        $owl_border_radius_item[] = $this->atts['owl_item_border_radius_top'];
                    }else{
                        $owl_border_radius_item[] = '0';
                    }
                    if($this->atts['owl_item_border_radius_right']){
                        $owl_border_radius_item[] = $this->atts['owl_item_border_radius_right'];
                    }else{
                        $owl_border_radius_item[] = '0';
                    }
                    if($this->atts['owl_item_border_radius_bottom']){
                        $owl_border_radius_item[] = $this->atts['owl_item_border_radius_bottom'];
                    }else{
                        $owl_border_radius_item[] = '0';
                    }
                    if($this->atts['owl_item_border_radius_left']){
                        $owl_border_radius_item[] = $this->atts['owl_item_border_radius_left'];
                    }else{
                        $owl_border_radius_item[] = '0';
                    }
                    $owl_border_radius_item[] = ';';
                    $owl_border_radius_item[] = 'overflow: hidden;';
                }
                if(!empty($owl_border_radius_item)){
                    $this->css .= implode(" ",$owl_border_radius_item);
                }

                if($this->atts['owl_item_padding_top'] || $this->atts['owl_item_padding_right'] || $this->atts['owl_item_padding_bottom'] || $this->atts['owl_item_padding_left']){
                    $owl_item_padding[] = 'padding: ';
                    if($this->atts['owl_item_padding_top']){
                        $owl_item_padding[] = $this->atts['owl_item_padding_top'];
                    }else{
                        $owl_item_padding[] = '0';
                    }
                    if($this->atts['owl_item_padding_right']){
                        $owl_item_padding[] = $this->atts['owl_item_padding_right'];
                    }else{
                        $owl_item_padding[] = '0';
                    }
                    if($this->atts['owl_item_padding_bottom']){
                        $owl_item_padding[] = $this->atts['owl_item_padding_bottom'];
                    }else{
                        $owl_item_padding[] = '0';
                    }
                    if($this->atts['owl_item_padding_left']){
                        $owl_item_padding[] = $this->atts['owl_item_padding_left'];
                    }else{
                        $owl_item_padding[] = '0';
                    }
                    $owl_item_padding[] = ';';
                    $owl_item_padding[] = 'overflow: hidden;';
                }
                if(!empty($owl_item_padding)){
                    $this->css .= implode(" ",$owl_item_padding);
                }

            $this->css .= '}';

            /**
             * Arrary for title style
             */
            if($this->atts['font_size_title']){
                $title_style[] = 'font-size:' .$this->atts['font_size_title'].';';
            }
            if($this->atts['font_title_line_height']){
                $title_style[] = 'line-height:' .$this->atts['font_title_line_height'].';';
            }
            if($this->atts['font_title_letter_spacing']){
                $title_style[] = 'letter-spacing:' .$this->atts['font_title_letter_spacing'].';';
            }
            if($this->atts['title_color']){
                $title_style[] = 'color:' .$this->atts['title_color'].';';
            }
            if($this->atts['title_text_transform']){
                $title_style[] = 'text-transform:' .$this->atts['title_text_transform'].';';
            }

            /**
             * Margin Title
             */
            if($this->atts['title_margin_top']){
                $title_margin[] = 'margin-top: '.$this->atts['title_margin_top'].';';
            }
            if($this->atts['title_margin_right']){
                $title_margin[] = 'margin-right: '.$this->atts['title_margin_right'].';';
            }
            if($this->atts['title_margin_bottom']){
                $title_margin[] = 'margin-bottom: '.$this->atts['title_margin_bottom'].';';
            }
            if($this->atts['title_margin_left']){
                $title_margin[] = 'margin-left: '.$this->atts['title_margin_left'].';';
            }
            

            /**
             * Padding Title
             */
            if($this->atts['title_padding_top']){
                $title_padding[] = 'padding-top: '.$this->atts['title_padding_top'].';';
            }
            if($this->atts['title_padding_right']){
                $title_padding[] = 'padding-right: '.$this->atts['title_padding_right'].';';
            }
            if($this->atts['title_padding_bottom']){
                $title_padding[] = 'padding-bottom: '.$this->atts['title_padding_bottom'].';';
            }
            if($this->atts['title_padding_left']){
                $title_padding[] = 'padding-left: '.$this->atts['title_padding_left'].';';
            }

            if(!empty($title_style)){
                $this->css .= '#aio-carousel-'.$this->i.' .aio-carousel-title a, #aio-carousel-'.$this->i.' .aio-carousel-title { '.implode(" ", $title_style);
                    if(!empty($title_margin)){
                        $this->css .= implode(" ", $title_margin);
                    }
                    if(!empty($title_padding)){
                        $this->css .= implode(" ", $title_padding);
                    }
                    $this->css .= Fusion_Builder_Element_Helper::get_font_styling( $this->atts, 'title' );
                $this->css .= ' } ';
            }

            /**
             * Css Condition and generation
             * These are custom condition and change for each of element builder type
             */
            if($this->atts['content_color']){
                $this->css .= '#aio-carousel-'.$this->i.' .aio-carousel-excerpt p { color: '.$this->atts['content_color'].' } ';
            }
            $this->css .= '.owl-dot {
                    width: 10px;
                    height: 10px;
                    background-color: #fff !important;
                    margin-right: 5px;
                    border-radius: 100%;
                }
                .owl-dot.active {
                    background-color: transparent !important;
                    border: 2px solid #fff !important;
                }';

            /**
             * Responsive Elements - Large Size
             */
            $this->css .= '@media (min-width: '.$this->aio_avada['aio-medium-brackpoint'].'px) {
                .aio-large-hidden {display: none;}
            }';

            /**
             * Responsive Elements - Medium Size
             */
            $this->css .= '@media (min-width: '.$this->aio_avada['aio-small-brackpoint'].'px) and (max-width: '.$this->aio_avada['aio-medium-brackpoint'].'px) {
                .aio-medium-hidden {display: none;}
              }';
            /**
             * Responsive Elements - Small Size
             */
            $this->css .= '@media (max-width: '.$this->aio_avada['aio-small-brackpoint'].'px) {
                .aio-small-hidden {display: none;}
            }';

            /**
             * Arrary for Font Button Style
             */
            if($this->atts['font_size_button']){
                $button_style[] = 'font-size:' .$this->atts['font_size_button'].';';
            }
            if($this->atts['font_button_line_height']){
                $button_style[] = 'line-height:' .$this->atts['font_button_line_height'].';';
            }
            if($this->atts['font_button_letter_spacing']){
                $button_style[] = 'letter-spacing:' .$this->atts['font_button_letter_spacing'].';';
            }
            if($this->atts['button_color']){
                $button_style[] = 'color:' .$this->atts['button_color'].';';
            }
            if($this->atts['button_background_color']){
                $button_style[] = 'background-color:' .$this->atts['button_background_color'].';';
            }
            if($this->atts['button_text_transform']){
                $button_style[] = 'text-transform:' .$this->atts['button_text_transform'].';';
            }
            else{$button_style[] = '';}

            /**
             * Button Tab Css
             */
            $this->css .= '#aio-carousel-'.$this->i.' .button-single-news-carousel {';
                $this->css .= Fusion_Builder_Element_Helper::get_font_styling( $this->atts, 'button' );
                $this->css .= implode(" ", $button_style);

                    /**
                     * Padding Button
                     */
                    if($this->atts['button_padding_top']){
                        $this->css .= 'padding-top: '.$this->atts['button_padding_top'].';';
                    }
                    if($this->atts['button_padding_right']){
                        $this->css .= 'padding-right: '.$this->atts['button_padding_right'].';';
                    }
                    if($this->atts['button_padding_bottom']){
                        $this->css .= 'padding-bottom: '.$this->atts['button_padding_bottom'].';';
                    }
                    if($this->atts['button_padding_left']){
                        $this->css .= 'padding-left: '.$this->atts['button_padding_left'].';';
                    }

            $this->css .= '}';

            $this->css .= '#aio-carousel-'.$this->i.' .aio-single-button-owl {';
                /**
                * Margin Button
                */
                if($this->atts['button_margin_top']){
                    $this->css .= 'margin-top: '.$this->atts['button_margin_top'].';';
                }
                if($this->atts['button_margin_right']){
                    $this->css .= 'margin-right: '.$this->atts['button_margin_right'].';';
                }
                if($this->atts['button_margin_bottom']){
                    $this->css .= 'margin-bottom: '.$this->atts['button_margin_bottom'].';';
                }
                if($this->atts['button_margin_left']){
                    $this->css .= 'margin-left: '.$this->atts['button_margin_left'].';';
                }
            $this->css .= '}';

            
            

            /**
             * $output_css is the variable who contain the final css to write
             * Don't change it.
             */
            echo '<style>'.$this->css.'</style>';

        }

    }
}
$aio_carousel_post_type_class = new aio_carousel_post_type_class($aio_avada);

