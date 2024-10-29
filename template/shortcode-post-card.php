<?php

global $aio_avada;

if(!class_exists('aio_post_card_class')){

    class aio_post_card_class{

        public $aio_avada, $atts, $css, $output_css, $counter, $posts;
        private $display_col_type, $title_font, $pagination_visibility, $image_visibility, $title_visibility, $content_visibility, $button_visibility, $number_of_columns;
        public $i = 0;

        public function __construct($opt_var){

            /**
             * Get Aio Options Setting
             * Don't change it.
             */
            $this->aio_avada = get_option('aio_avada');

            /**
             * Shortcode Registration
             * This is custom condition and change for each of element builder type
             */
            add_shortcode('aio_post_card', array($this, 'aio_shortcode_generator'));

            /**
             * Get a list of all Post types
             */
            add_action( 'init', array($this, 'get_list_post_types') );

            /**
             * Get a list of all Taxonomies
             */
            add_action( 'init', array($this, 'get_list_taxonomies') );
        }


        public function aio_shortcode_generator($atts){
            
            /**
             * Generation shortcode atts
             * These are custom condition and change for each of element builder type
             */

            $this->atts = shortcode_atts (
                array(

                    //GENERAL TAB
                    'post_type'                     => '',
                    'filtering_by_taxonomy'         => '',
                    'taxonomy'                      => '',
                    'terms'                         => array(''),
                    'posts_per_page'                => '',
                    'exclude'                       => '',
                    'order'                         => '',
                    'orderby'                       => '',
                    'linkable'                      => '',
                    'class'                         => '',
                    'id'                            => '',

                    //DESIGN
                    'columns'                       => '',
                    'columns_medium'                => '',
                    'columns_small'                 => '',
                    'template'                      => '', 
                    'large_alternate'               => '',
                    'padding_top'                   => '',
                    'padding_right'                 => '',
                    'padding_bottom'                => '',
                    'padding_left'                  => '',
                    'margin_top'                    => '',
                    'margin_right'                  => '',
                    'margin_bottom'                 => '',
                    'margin_left'                   => '',
                    'content_alignment'             => '',
                    'post_card_background_color'    => '',
                    'pagination'                    => '',
                    'pagination_medium'             => '',
                    'pagination_small'              => '',
                    'pagination_align'              => '',

                    //IMAGE TAB
                    'show_image'                    => '',
                    'show_image_medium'             => '',
                    'show_image_small'              => '',
                    'width-image'                   => '',
                    'border-radius-image_top'       => '',
                    'border-radius-image_right'     => '',
                    'border-radius-image_bottom'    => '',
                    'border-radius-image_left'      => '',
                    
                    //TITLE TAB
                    'show_title'                    => '',
                    'show_title_medium'             => '',
                    'show_title_small'              => '',
                    'title_tag'                     => '',
                    'fusion_font_family_title'      => '',
                    'fusion_font_variant_title'     => '',
                    'font_size_title'               => '',
                    'font_title_line_height'        => '',
                    'font_title_letter_spacing'     => '',
                    'title_color'                   => '',
                    'title_padding_top'             => '',
                    'title_padding_right'           => '',
                    'title_padding_bottom'          => '',
                    'title_padding_left'            => '',
                    'title_margin_top'              => '',
                    'title_margin_right'            => '',
                    'title_margin_bottom'           => '',
                    'title_margin_left'             => '',
                    'title_text_transform'          => '',

                    //CONTENT TAB
                    'show_content'                  => '',
                    'show_content_medium'           => '',
                    'show_content_small'            => '',
                    'fusion_font_family_content'    => '',
                    'fusion_font_variant_content'   => '',
                    'font_size_content'             => '',
                    'font_content_line_height'      => '',
                    'font_content_letter_spacing'   => '',
                    'content_color'                 => '',
                    'excerpt'                       => '',
                    'show_excerpt_symble'           => '',
                    'content_padding_top'           => '',
                    'content_padding_right'         => '',
                    'content_padding_bottom'        => '',
                    'content_padding_left'          => '',
                    'content_margin_top'            => '',
                    'content_margin_right'          => '',
                    'content_margin_bottom'         => '',
                    'content_margin_left'           => '',
                    'content_text_transform'        => '',

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

                ), $atts, 'aio_post_card'
            );

            //Font variables
            $this->title_font = Fusion_Builder_Element_Helper::get_font_styling($this->atts, 'title' );

            //Atts conditions
            if($this->atts['filtering_by_taxonomy']=='yes'){
                $args = array(
                    'post_type'         => $this->atts['post_type'],
                    'posts_per_page'    => $this->atts['posts_per_page'],
                    'exclude'           => $this->atts['exclude'],
                    'order'             => $this->atts['order'],
                    'orderby'           => $this->atts['orderby'],
                    'tax_query' => array(
                        array(
                            'taxonomy' => $this->atts['taxonomy'],
                            'field'    => 'slug',
                            'terms'    => explode(",", $this->atts['terms']),
                        ),
                    ),
                    'paged'             => get_query_var('paged'),
                );
                $this->posts = new WP_Query($args);
            }
    
    
            if($this->atts['filtering_by_taxonomy']=='no'){
                $args_no_cat = array(
                    'post_type'         => $this->atts['post_type'],
                    'posts_per_page'    => $this->atts['posts_per_page'],
                    'exclude'           => $this->atts['exclude'],
                    'order'             => $this->atts['order'],
                    'orderby'           => $this->atts['orderby'],
                    'paged'             => get_query_var('paged'),
                );
                $this->posts = new WP_Query($args_no_cat);
            }
            
            return $this->aio_render_html();
    
        }

        public function aio_render_html(){

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
                $this->image_visibility[] = 'aio-large-hidden';
            }else{
                $this->image_visibility[] = '';
            }
            if($this->atts['show_image_medium']=='no'){
                $this->image_visibility[] = 'aio-medium-hidden';
            }else{
                $this->image_visibility[] = '';
            }
            if($this->atts['show_image_small']=='no'){
                $this->image_visibility[] = 'aio-small-hidden';
            }else{
                $this->image_visibility[] = '';
            }
            //TITLE VISIBILITY
            if($this->atts['show_title']=='no'){
                $this->title_visibility[] = 'aio-large-hidden';
            }else{
                $this->title_visibility[] = '';
            }
            if($this->atts['show_title_medium']=='no'){
                $this->title_visibility[] = 'aio-medium-hidden';
            }else{
                $this->title_visibility[] = '';
            }
            if($this->atts['show_title_small']=='no'){
                $this->title_visibility[] = 'aio-small-hidden';
            }else{
                $this->title_visibility[] = '';
            }
            //CONTENT VISIBILITY
            if($this->atts['show_content']=='no'){
                $this->content_visibility[] = 'aio-large-hidden';
            }else{
                $this->content_visibility[] = '';
            }
            if($this->atts['show_content_medium']=='no'){
                $this->content_visibility[] = 'aio-medium-hidden';
            }else{
                $this->content_visibility[] = '';
            }
            if($this->atts['show_content_small']=='no'){
                $this->content_visibility[] = 'aio-small-hidden';
            }else{
                $this->content_visibility[] = '';
            }
            //BUTTON VISIBILITY
            if($this->atts['show_button']=='no'){
                $this->button_visibility[] = 'aio-large-hidden';
            }else{
                $this->button_visibility[] = '';
            }
            if($this->atts['show_button_medium']=='no'){
                $this->button_visibility[] = 'aio-medium-hidden';
            }else{
                $this->button_visibility[] = '';
            }
            if($this->atts['show_button_small']=='no'){
                $this->button_visibility[] = 'aio-small-hidden';
            }else{
                $this->button_visibility[] = '';
            }
            //PAGINATION VISIBILITY
            if($this->atts['pagination']=='no'){
                $this->pagination_visibility[] = 'aio-large-hidden';
            }else{
                $this->pagination_visibility[] = '';
            }
            if($this->atts['pagination_medium']=='no'){
                $this->pagination_visibility[] = 'aio-medium-hidden';
            }else{
                $this->pagination_visibility[] = '';
            }
            if($this->atts['pagination_small']=='no'){
                $this->pagination_visibility[] = 'aio-small-hidden';
            }else{
                $this->pagination_visibility[] = '';
            }

            //COLUMNS DISPLAY TYPE
            switch($this->atts['template']){
                case 'grid':
                    $this->display_col_type = 'display: flex; flex-direction: column;';
                    break;
                case 'large':
                    $this->display_col_type = 'display: flex;';
                    break;                
            }
            

            ob_start();
            /**
             * GRID TEMPLATE
             * Html to renderize in frontend
             * This is a custom condition and change for each of element builder type
             */
            if($this->atts['template'] == 'grid'){
                $this->template_grid();
            }

            /**
            * LARGE TEMPLATE
            * Html to renderize in frontend
            * This is a custom condition and change for each of element builder type
            */
            if($this->atts['template'] == 'large'){
                $this->template_large();
            }
            

            /**
             * Call a function for css generation
             */
            $this->aio_css_generator($this->atts, $this->i);

            return ob_get_clean();
        }

        function template_large(){

            $this->number_of_columns();

            do_action('before_aio_large_postcard');

            //Open div Aio Post Card Large
            echo '<div id="aio-post-card-'.$this->i.'" class="aio-post-card aio-post-card-large">';

            do_action('before_aio_large_postcard_inside');

            if ( $this->posts->have_posts() ) {

                while ( $this->posts->have_posts() ) {
                $this->posts->the_post(); 

                    $content = get_the_content();

                    //Open div Item
                    echo '<div id="'.$this->atts['id'].'" class="item '.$this->atts['class'].' '.implode(" ", $this->number_of_columns).'">';
                    
                    do_action('before_aio_large_postcard_content');

                    //Open div Aio Single Post Card Content
                    echo '<div class="aio-single-post-card-content">';
                        
                        do_action('before_aio_large_postcard_image');

                        //Open div Aio Post Card Image Link
                        echo '<div class="aio-post-card-image-link">';

                        do_action('in_aio_large_postcard_image');
                        if($this->atts['linkable']=='yes'){

                            //Open a Aio Post Card Image Link
                            echo '<a href="'.get_permalink().'">';

                        }

                        //Open div Aio Post Card Image Preview
                        echo '<div class="aio-post-card-image-preview '.implode(" ", $this->image_visibility).'">';

                            //Get Image Preview
                            echo get_the_post_thumbnail();
                            
                        //Close div Aio Post Card Image Preview
                        echo '</div>';

                        if($this->atts['linkable']=='yes'){

                            //Close a Aio Post Card Image Link
                            echo '</a>';

                        }
                        
                        //Close div Aio Post Card Image Link
                        echo '</div>';

                        do_action('after_aio_large_postcard_image');

                        //Open div Aio Post Card Content
                        echo '<div class="aio-post-card-content">';

                        do_action('before_aio_large_postcard_title');

                        //Open div Aio Post Card Title
                        echo '<div class="aio-post-card-title '.implode(" ", $this->title_visibility).'">';

                            if($this->atts['linkable']=='yes'){

                                //Open a Aio Post Card Title
                                echo '<a href="'.get_permalink().'">';
                            }

                            //Tag H Aio Post Card Title and Title
                            echo '<h'.$this->atts['title_tag'].'>'.get_the_title().'</h'.$this->atts['title_tag'].'>';

                            if($this->atts['linkable']=='yes'){
                                
                                //Close a Aio Post Card Title
                                echo '</a>';

                            }

                        //Close div Aio Post Card Title
                        echo '</div>';

                        do_action('after_aio_large_postcard_title');

                        do_action('before_aio_large_postcard_excerpt');

                        //Open div Aio Post Card Excerpt
                        echo '<div class="aio-post-card-excerpt '.implode(" ", $this->content_visibility).'">';
                            
                            //Paragraph Aio Post Card Excerpt
                            echo substr(substr($content, 0, $this->atts['excerpt']));
                            
                        //Close div Aio Post Card Excerpt
                        if($this->atts['show_excerpt_symble'] == 'yes'){
                            echo ' <span class="aio-excerpt-symbol">...</span>';
                        }

                        echo '</div>';

                        do_action('after_aio_large_postcard_excerpt');
                            
                            do_action('before_aio_large_postcard_button');

                            //Open div Aio Post Card Main Button
                            echo '<div class="aio-post-card-main-button">';

                                //tag a Aio Post Card Main Button
                                echo '<a class="aio-post-card-button '.implode(" ", $this->button_visibility).'" href="'.get_permalink().'">'.__($this->atts['button_text'], "avada_addons").'</a>';
                            
                            //Close div Aio Post Card Main Button
                            echo '</div>';

                            do_action('after_aio_large_postcard_button');

                        //Close div Aio Post Card Content
                        echo '</div>';

                        //Close div Aio Single Post Card Content
                        echo '</div>';

                        do_action('after_aio_large_postcard_content');

                        //Close div Item
                        echo '</div>';

                } // end while
            } // end if

            /**
             * Pagination
             */
            $this->pagination();

                do_action('after_aio_large_postcard_inside');

                //Close div Aio Post Card Large
                echo '</div>';
                do_action('after_aio_large_postcard');

            unset($this->number_of_columns);
        }

        function template_grid(){

            $this->number_of_columns();

            do_action('before_aio_grid_postcard');

                //Open div Aio Post Card Grid
                echo '<div id="aio-post-card-'.$this->i.'" class="aio-post-card aio-post-card-grid">';

                do_action('before_aio_grid_postcard_inside');

                if ( $this->posts->have_posts() ) {
                    while ( $this->posts->have_posts() ) {
                    $this->posts->the_post();

                        //Open div Item Aio Post Card Grid
                        echo '<div id="'.$this->atts['id'].'" class="item '.$this->atts['class'].' '.implode(" ", $this->number_of_columns).'">';

                            //Open div Aio Single Post Card Content
                            echo '<div class="aio-single-post-card-content">';

                                do_action('before_aio_grid_postcard_image');

                                //Open div Aio Single Post Card Image Link
                                echo '<div class="aio-post-card-image-link">';

                                    do_action('in_aio_large_postcard_image');
                                    if($this->atts['linkable']=='yes'){
                                        //Open tag a Aio Single Post Card Content
                                        echo '<a href="'.get_permalink().'">';
                                    }
                                    
                                        //Open div Aio Single Post Card Image Preview
                                        echo '<div class="aio-post-card-image-preview '.implode(" ", $this->image_visibility).'">';
                                            echo get_the_post_thumbnail();
                                        echo '</div>';
                                    
                                    if($this->atts['linkable']=='yes'){
                                        //Close tag a Aio Single Post Card Content
                                        echo '</a>';
                                    }

                                //Close div Aio Single Post Card Image Link
                                echo '</div>';

                                do_action('after_aio_grid_postcard_image');

                                do_action('before_aio_grid_postcard_content');

                                //Open div Aio Single Post Card Content
                                echo '<div class="aio-post-card-content">';

                                    do_action('before_aio_grid_postcard_title');

                                    //Open div Aio Single Post Card Title
                                    echo '<div class="aio-post-card-title '.implode(" ", $this->title_visibility).'">';

                                        if($this->atts['linkable']=='yes'){

                                            //Open tag a Aio Single Post Card Title
                                            echo '<a href="'.get_permalink().'">';

                                        }

                                        //Tag h Aio Single Post Card Title and Titile
                                        echo '<h'.$this->atts['title_tag'].'>'.get_the_title().'</h'.$this->atts['title_tag'].'>';
                                        
                                        if($this->atts['linkable']=='yes'){

                                            //Close tag a Aio Single Post Card Title
                                            echo '</a>';

                                        }

                                    //Close div Aio Single Post Card Title
                                    echo '</div>';

                                    do_action('after_aio_grid_postcard_title');

                                    do_action('before_aio_grid_postcard_excerpt');

                                    //Open Aio Single Post Card Excerpt
                                    echo '<div class="aio-post-card-excerpt '.implode(" ", $this->content_visibility).'">';

                                        //Paragraph Aio Single Post Card Excerpt
                                        echo substr(get_the_content(), 0, $this->atts['excerpt']);

                                    //Close Aio Single Post Card Excerpt
                                    if($this->atts['show_excerpt_symble'] == 'yes'){
                                        echo ' <span class="aio-excerpt-symbol">...</span>';
                                    }

                                    echo '</div>';

                                    do_action('after_aio_grid_postcard_excerpt');

                                        do_action('before_aio_grid_postcard_button');

                                        //Open Aio Single Post Card Main Button
                                        echo '<div class="aio-post-card-main-button">';

                                            //Open tag a Aio Single Post Card Main Button
                                            echo '<a class="aio-post-card-button '.implode(" ", $this->button_visibility).'" href="'.get_permalink().'">'.__($this->atts['button_text'], "avada_addons").'</a>';
                                        
                                        //Close Aio Single Post Card Main Button
                                        echo '</div>'; 
                                        do_action('after_aio_grid_postcard_button');

                                //Close div Aio Single Post Card Content
                                echo '</div>';
                                do_action('after_aio_grid_postcard_content');

                            //Close div Aio Single Post Card Content
                            echo '</div>';

                            //Close div Item Aio Post Card Grid
                            echo '</div>';

                    } // end while
                } // end if
                
                /**
                 * Pagination
                 */
                $this->pagination();

                do_action('after_aio_grid_postcard_inside');

                //Close div Aio Post Card Grid
                echo '</div>';

                do_action('after_aio_grid_postcard');
        
                unset($this->number_of_columns);
        }

        /**
         * Generate pagination
         */
        function pagination(){
            //Pagination for alternate tempalte
            echo '<div class="aio-post-card-pagination '.implode(" ", $this->pagination_visibility).'">';

            $total_pages = $this->posts->max_num_pages;

            if ($total_pages > 1){

                $current_page = max(1, get_query_var('paged'));

                echo paginate_links(array(
                    'format'        => '?page_id='.get_queried_object_id().'&paged=%#%',    
                    'current'       => $current_page,
                    'total'         => $total_pages,
                    'prev_text'     => __('« '),
                    'next_text'     => __('»'),
                    'type'          => 'list',
                ));
                    
                }

                echo '</div>';
        }

        function number_of_columns(){
            //NUMBER OF COLUMN ON LARGE SCREEN
            switch($this->atts['columns']){
                case 1:
                    $this->number_of_columns[] = 'aio-col-lg-1';
                    break;
                case 2:
                    $this->number_of_columns[] = 'aio-col-lg-2';
                    break;
                case 3:
                    $this->number_of_columns[] = 'aio-col-lg-3';
                    break;
                case 4:
                    $this->number_of_columns[] = 'aio-col-lg-4';
                    break;
                case 5:
                    $this->number_of_columns[] = 'aio-col-lg-5';
                    break;
                case 6:
                    $this->number_of_columns[] = 'aio-col-lg-6';
                    break;
                }
                //NUMBER OF COLUMN ON MEDIUM SCREEN
                switch($this->atts['columns_medium']){
                    case 1:
                        $this->number_of_columns[] = 'aio-col-md-1';
                        break;
                    case 2:
                        $this->number_of_columns[] = 'aio-col-md-2';
                        break;
                    case 3:
                        $this->number_of_columns[] = 'aio-col-md-3';
                        break;
                    case 4:
                        $this->number_of_columns[] = 'aio-col-md-4';
                        break;
                    case 5:
                        $this->number_of_columns[] = 'aio-col-md-5';
                        break;
                    case 6:
                        $this->number_of_columns[] = 'aio-col-md-6';
                        break;
                }
                //NUMBER OF COLUMN ON SMALL SCREEN
                switch($this->atts['columns_small']){
                    case 1:
                        $this->number_of_columns[] = 'aio-col-sm-1';
                        break;
                    case 2:
                        $this->number_of_columns[] = 'aio-col-sm-2';
                        break;
                    case 3:
                        $this->number_of_columns[] = 'aio-col-sm-3';
                        break;
                    case 4:
                        $this->number_of_columns[] = 'aio-col-sm-4';
                        break;
                    case 5:
                        $this->number_of_columns[] = 'aio-col-sm-5';
                        break;
                    case 6:
                        $this->number_of_columns[] = 'aio-col-sm-6';
                        break;
                    }
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

        public function aio_css_generator($atts, $counter){

            $this->css = null;
            /**
             * Element Counter Implementation
             * Don't change it.
             */
            $this->i = $counter;
            
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
             * Arrary for Font Content Style
             */
            if($this->atts['font_size_content']){
                $content_style[] = 'font-size:' .$this->atts['font_size_content'].';';
            }
            if($this->atts['font_content_line_height']){
                $content_style[] = 'line-height:' .$this->atts['font_content_line_height'].';';
            }
            if($this->atts['font_content_letter_spacing']){
                $content_style[] = 'letter-spacing:' .$this->atts['font_content_letter_spacing'].';';
            }
            if($this->atts['content_color']){
                $content_style[] = 'color:' .$this->atts['content_color'].';';
            }
            if($this->atts['content_text_transform']){
                $content_style[] = 'text-transform:' .$this->atts['content_text_transform'].';';
            }
            else{$content_style[] = '';}

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

            /**
             * Padding for the columns
             */
            if($this->atts['padding_top']){
                $padding[] = 'padding-top: '.$this->atts['padding_top'].';';
            }
            if($this->atts['padding_right']){
                $padding[] = 'padding-right: '.$this->atts['padding_right'].';';
            }
            if($this->atts['padding_bottom']){
                $padding[] = 'padding-bottom: '.$this->atts['padding_bottom'].';';
            }
            if($this->atts['padding_left']){
                $padding[] = 'padding-left: '.$this->atts['padding_left'].';';
            }

            /**
             * Margin for the columns
             */
            if($this->atts['margin_top']){
                $margin[] = 'margin-top: '.$this->atts['margin_top'].';';
            }
            else{
                $margin[] = 'margin-top: 10px;';
            }
            if($this->atts['margin_right']){
                $margin[] = 'margin-right: '.$this->atts['margin_right'].';';
            }
            else{
                $margin[] = 'margin-right: 10px;';
            }
            if($this->atts['margin_bottom']){
                $margin[] = 'margin-bottom: '.$this->atts['margin_bottom'].';';
            }
            else{
                $margin[] = 'margin-bottom: 10px;';
            }
            if($this->atts['margin_left']){
                $margin[] = 'margin-left: '.$this->atts['margin_left'].';';
            }
            else{
                $margin[] = 'margin-left: 10px;';
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

            /**
             * Margin Content
             */
            if($this->atts['content_margin_top']){
                $content_margin[] = 'margin-top: '.$this->atts['content_margin_top'].';';
            }
            if($this->atts['content_margin_right']){
                $content_margin[] = 'margin-right: '.$this->atts['content_margin_right'].';';
            }
            if($this->atts['content_margin_bottom']){
                $content_margin[] = 'margin-bottom: '.$this->atts['content_margin_bottom'].';';
            }
            if($this->atts['content_margin_left']){
                $content_margin[] = 'margin-left: '.$this->atts['content_margin_left'].';';
            }

            /**
             * Padding Content
             */
            if($this->atts['content_padding_top']){
                $content_padding[] = 'padding-top: '.$this->atts['content_padding_top'].';';
            }
            if($this->atts['content_padding_right']){
                $content_padding[] = 'padding-right: '.$this->atts['content_padding_right'].';';
            }
            if($this->atts['content_padding_bottom']){
                $content_padding[] = 'padding-bottom: '.$this->atts['content_padding_bottom'].';';
            }
            if($this->atts['content_padding_left']){
                $content_padding[] = 'padding-left: '.$this->atts['content_padding_left'].';';
            }


            //BORDER RADIUS IMAGE
            if($this->atts['border-radius-image_top'] || $this->atts['border-radius-image_right'] || $this->atts['border-radius-image_bottom'] || $this->atts['border-radius-image_left']){
                $border_radius_image[] = 'border-radius: ';
                if($this->atts['border-radius-image_top']){
                    $border_radius_image[] = $this->atts['border-radius-image_top'];
                }else{
                    $border_radius_image[] = '0';
                }
                if($this->atts['border-radius-image_right']){
                    $border_radius_image[] = $this->atts['border-radius-image_right'];
                }else{
                    $border_radius_image[] = '0';
                }
                if($this->atts['border-radius-image_bottom']){
                    $border_radius_image[] = $this->atts['border-radius-image_bottom'];
                }else{
                    $border_radius_image[] = '0';
                }
                if($this->atts['border-radius-image_left']){
                    $border_radius_image[] = $this->atts['border-radius-image_left'];
                }else{
                    $border_radius_image[] = '0';
                }
                $border_radius_image[] = ';';
            }

            /**
            * Post Card Style
            */
            if($this->atts['content_alignment']){
                $post_card_style[] = 'text-align: '.$this->atts['content_alignment'].';';
            }
            if($this->atts['post_card_background_color']){
                $post_card_style[] = 'background-color: '.$this->atts['post_card_background_color'].';';
            }


            /**
             * Css Condition and generation
             * These are custom condition and change for each of element builder type
             */
            $this->css .= '.aio-post-card {display: flex; flex-wrap: wrap; flex-direction: row;}';

            //Css in case is using Large Template
            if($this->atts['template'] == 'large'){


                if($this->atts['width-image']){
                    $content_width_large = 100 - $this->atts['width-image'];
                    $content_width_large = 'max-width: '.$content_width_large.'%;';
                    $image_max_width = 'max-width: '.$this->atts['width-image'].'%;';
                }else{
                    $content_width_large = '';
                    $image_max_width = '';
                }

                $this->css .= '#aio-post-card-'.$this->i.' .aio-post-card-image-link {display: grid; '.$image_max_width.'}';

                $this->css .= '#aio-post-card-'.$this->i.' .aio-post-card-content {display: flex; flex-direction: column; margin: auto 0;'.$content_width_large.'}';
                
            }
            if($this->atts['template'] == 'grid'){

                if($this->atts['width-image']){
                    $image_max_width = 'max-width: '.$this->atts['width-image'].'%;';
                }else{
                    $image_max_width = '';
                }

                $this->css .= '#aio-post-card-'.$this->i.' .aio-post-card-image-preview {display: grid; '.$image_max_width.'}';
            }

            /**
             * Design Tab Css
             */
            $this->css .= '#aio-post-card-'.$this->i.' .item .aio-single-post-card-content{'; 
                if(!empty($margin)){
                    $this->css .= implode(" ", $margin);
                }
                if(!empty($padding)){
                    $this->css .= implode(" ", $padding);
                }
                if(!empty($post_card_style)){
                    $this->css .= implode(" ", $post_card_style);
                }
            $this->css .= '}';

            /**
             * Title Tab Css
             */
            $this->css .= '#aio-post-card-'.$this->i.' .aio-post-card-title h'.$this->atts['title_tag'].'{'; 
                $this->css .= Fusion_Builder_Element_Helper::get_font_styling( $this->atts, 'title' );
                $this->css .= implode(" ", $title_style);
                if(!empty($title_padding)){
                    $this->css .= implode(" ", $title_padding);
                }
            $this->css .= '}';

            $this->css .= '#aio-post-card-'.$this->i.' .aio-post-card-title {'; 
                if(!empty($title_margin)){
                    $this->css .= implode(" ", $title_margin);
                }
            $this->css .= '}';
            

            /**
             * Image Style
             */
            if(!empty($border_radius_image)){
                $this->css .= '.aio-post-card-image-preview img{'.implode(" ",$border_radius_image).'}';
            }

            /**
             * Content Tab Css
             */
            $this->css .= '#aio-post-card-'.$this->i.' .aio-post-card-excerpt{'; 
                $this->css .= Fusion_Builder_Element_Helper::get_font_styling( $this->atts, 'content' );
                $this->css .= implode(" ", $content_style);
                if(!empty($content_margin)){
                    $this->css .= implode(" ", $content_margin);
                }
                if(!empty($content_padding)){
                    $this->css .= implode(" ", $content_padding);
                }
            $this->css .= '}';

            /**
             * Button Tab Css
             */
            $this->css .= '#aio-post-card-'.$this->i.' .aio-post-card-main-button a {';
                $this->css .= Fusion_Builder_Element_Helper::get_font_styling( $this->atts, 'button' );
                $this->css .= implode(" ", $button_style);
            $this->css .= '}';

            $this->css .= '#aio-post-card-'.$this->i.' .aio-post-card-main-button {';
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
            
            if($this->atts['large_alternate']=='yes' && $this->atts['template']=='large'){
                $this->css .= '#aio-post-card-'.$this->i.' .item:nth-child(even) .aio-single-post-card-content .aio-post-card-image-link{';
                    $this->css .= 'order: 2;';
                $this->css .= '}';
            }

            /**
            * Pagination style
            */
            switch($this->atts['pagination_align']){
                case 'left':
                    $pagination_align = '';
                    break;
                case 'center':
                    $pagination_align = 'margin: 0 auto; max-width: max-content;';
                    break;
                case 'right':
                    $pagination_align = 'margin: 0 0 0 auto; max-width: max-content;';
                    break;
            }
            if($this->atts['pagination']=='yes' || $this->atts['pagination_medium']=='yes' || $this->atts['pagination_small']=='yes'){
                $this->css .= $this->atts['id'].' .aio-post-card-pagination {width: 100%;}';
                $this->css .= $this->atts['id'].' .page-numbers {display: flex; flex-direction: row; padding-left: 0; '.$pagination_align.'}';
                $this->css .= $this->atts['id'].' .page-numbers li {list-style: none; width: max-content;}';
                $this->css .= $this->atts['id'].' .page-numbers li .prev, '.$this->atts['id'].' .page-numbers li .next {display: table; padding: 0 15px;}';
                $this->css .= $this->atts['id'].' a.page-numbers:not(.current, .prev, .next) {display: none;}';
            }

            
            /**
             * Responsive Elements - Large Size
             */
            $this->css .= '@media (min-width: '.$this->aio_avada['aio-medium-brackpoint'].'px) {';

            if($this->atts['template']=='grid'){
            
                switch($this->atts['columns']){

                    case 1:
                        $this->css .= '.aio-post-card-grid .aio-col-lg-1 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-lg-1 {max-width: 100%; flex: 100%; display: flex;}';
                        break;
        
                    case 2:
                        $this->css .= '.aio-post-card-grid .aio-col-lg-2 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-lg-2 {max-width: 50%; flex: 50%; display: flex;}';
                        break;

                    case 3:
                        $this->css .= '.aio-post-card-grid .aio-col-lg-3 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-lg-3 {max-width: 33.33%; flex: 33.33%; display: flex;}';
                        break;
        
                    case 4:
                        $this->css .= '.aio-post-card-grid .aio-col-lg-4 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-lg-4 {max-width: 25%; flex: 25%; display: flex;}';
                        break;

                    case 5:
                        $this->css .= '.aio-post-card-grid .aio-col-lg-5 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-lg-5 {max-width: 20%; flex: 20%; display: flex;}';
                        break;

                    case 6:
                        $this->css .= '.aio-post-card-grid .aio-col-lg-6 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-lg-6 {max-width: 16.66%; flex: 16.66%; display: flex;}';
                        break;
                }
            
            }

            if($this->atts['template']=='large'){
            
                switch($this->atts['columns']){

                    case 1:
                        $this->css .= '.aio-post-card-large .aio-col-lg-1 {max-width: 100%; '.$this->display_col_type.' flex: 100%;}';
                        $this->css .= '.aio-post-card-large .aio-col-lg-1 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;
        
                    case 2:
                        $this->css .= '.aio-post-card-large .aio-col-lg-2 {max-width: 50%; '.$this->display_col_type.' flex: 50%;}';
                        $this->css .= '.aio-post-card-large .aio-col-lg-2 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;

                    case 3:
                        $this->css .= '.aio-post-card-large .aio-col-lg-3 {max-width: 33.33%; '.$this->display_col_type.' flex: 33.33%;}';
                        $this->css .= '.aio-post-card-large .aio-col-lg-3 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;
        
                    case 4:
                        $this->css .= '.aio-post-card-large .aio-col-lg-4 {max-width: 25%; '.$this->display_col_type.' flex: 25%;}';
                        $this->css .= '.aio-post-card-large .aio-col-lg-4 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;

                    case 5:
                        $this->css .= '.aio-post-card-large .aio-col-lg-5 {max-width: 20%; '.$this->display_col_type.' flex: 20%;}';
                        $this->css .= '.aio-post-card-large .aio-col-lg-5 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;

                    case 6:
                        $this->css .= '.aio-post-card-large .aio-col-lg-6 {max-width: 16.66%; '.$this->display_col_type.' flex: 16.66%;}';
                        $this->css .= '.aio-post-card-large .aio-col-lg-6 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;
                }
            
            }

            $this->css .= '}';

            /**
             * Responsive Elements - Medium Size
             */
            $this->css .= '@media (min-width: '.$this->aio_avada['aio-small-brackpoint'].'px) and (max-width: '.$this->aio_avada['aio-medium-brackpoint'].'px) {';

            if($this->atts['template']=='grid'){

                switch($this->atts['columns_medium']){

                    case 1:
                        $this->css .= '.aio-post-card-grid .aio-col-md-1 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-md-1 {max-width: 100%; flex: 100%; display: flex;}';
                        break;
        
                    case 2:
                        $this->css .= '.aio-post-card-grid .aio-col-md-2 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-md-2 {max-width: 50%; flex: 50%; display: flex;}';
                        break;

                    case 3:
                        $this->css .= '.aio-post-card-grid .aio-col-md-3 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-md-3 {max-width: 33.33%; flex: 33.33%; display: flex;}';
                        break;
        
                    case 4:
                        $this->css .= '.aio-post-card-grid .aio-col-md-4 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-md-4 {max-width: 25%; flex: 25%; display: flex;}';
                        break;

                    case 5:
                        $this->css .= '.aio-post-card-grid .aio-col-md-5 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-md-5 {max-width: 20%; flex: 20%; display: flex;}';
                        break;

                    case 6:
                        $this->css .= '.aio-post-card-grid .aio-col-md-6 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                        $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                        $this->css .= '.aio-post-card-grid .aio-col-md-6 {max-width: 16.66%; flex: 16.66%; display: flex;}';
                        break;
                }
            
            }

            if($this->atts['template']=='large'){

                switch($this->atts['columns_medium']){

                    case 1:
                        $this->css .= '.aio-post-card-large .aio-col-md-1 {max-width: 100%; '.$this->display_col_type.' flex: 100%;}';
                        $this->css .= '.aio-post-card-large .aio-col-md-1 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;
        
                    case 2:
                        $this->css .= '.aio-post-card-large .aio-col-md-2 {max-width: 50%; '.$this->display_col_type.' flex: 50%;}';
                        $this->css .= '.aio-post-card-large .aio-col-md-2 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;

                    case 3:
                        $this->css .= '.aio-post-card-large .aio-col-md-3 {max-width: 33.33%; '.$this->display_col_type.' flex: 33.33%;}';
                        $this->css .= '.aio-post-card-large .aio-col-md-3 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;
        
                    case 4:
                        $this->css .= '.aio-post-card-large .aio-col-md-4 {max-width: 25%; '.$this->display_col_type.' flex: 25%;}';
                        $this->css .= '.aio-post-card-large .aio-col-md-4 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;

                    case 5:
                        $this->css .= '.aio-post-card-large .aio-col-md-5 {max-width: 20%; '.$this->display_col_type.' flex: 20%;}';
                        $this->css .= '.aio-post-card-large .aio-col-md-5 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;

                    case 6:
                        $this->css .= '.aio-post-card-large .aio-col-md-6 {max-width: 16.66%; '.$this->display_col_type.' flex: 16.66%;}';
                        $this->css .= '.aio-post-card-large .aio-col-md-6 .aio-single-post-card-content {'.$this->display_col_type.'}';
                        break;
    
                }
            
            }

            $this->css .= '}';

            /**
             * Responsive Elements - Small Size
             */
            $this->css .= '@media (max-width: '.$this->aio_avada['aio-small-brackpoint'].'px) {';

                if($this->atts['template']=='grid'){

                    switch($this->atts['columns_small']){

                        case 1:
                            $this->css .= '.aio-post-card-grid .aio-col-sm-1 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                            $this->css .= '.aio-post-card-grid .aio-col-sm-1 {max-width: 100%; flex: 100%; display: flex;}';
                            break;
            
                        case 2:
                            $this->css .= '.aio-post-card-grid .aio-col-sm-2 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                            $this->css .= '.aio-post-card-grid .aio-col-sm-2 {max-width: 50%; flex: 50%; display: flex;}';
                            break;
    
                        case 3:
                            $this->css .= '.aio-post-card-grid .aio-col-sm-3 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                            $this->css .= '.aio-post-card-grid .aio-col-sm-3 {max-width: 33.33%; flex: 33.33%; display: flex;}';
                            break;
            
                        case 4:
                            $this->css .= '.aio-post-card-grid .aio-col-sm-4 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                            $this->css .= '.aio-post-card-grid .aio-col-sm-4 {max-width: 25%; flex: 25%; display: flex;}';
                            break;
    
                        case 5:
                            $this->css .= '.aio-post-card-grid .aio-col-sm-5 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                            $this->css .= '.aio-post-card-grid .aio-col-sm-5 {max-width: 20%; flex: 20%; display: flex;}';
                            break;
    
                        case 6:
                            $this->css .= '.aio-post-card-grid .aio-col-sm-6 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-content {display:grid; height:100%;}';
                            $this->css .= '.aio-post-card-grid .aio-post-card-main-button {align-items: flex-end; display: grid; align-content: end;}';
                            $this->css .= '.aio-post-card-grid .aio-col-sm-6 {max-width: 16.66%; flex: 16.66%; display: flex;}';
                            break;
                    }

                }
                if($this->atts['template']=='large'){
                    
                    switch($this->atts['columns_small']){

                        case 1:
                            $this->css .= '.aio-post-card-large .aio-col-sm-1 {max-width: 100%; '.$this->display_col_type.' flex: 100%;}';
                            $this->css .= '.aio-post-card-large .aio-col-sm-1 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            break;
            
                        case 2:
                            $this->css .= '.aio-post-card-large .aio-col-sm-2 {max-width: 50%; '.$this->display_col_type.' flex: 50%;}';
                            $this->css .= '.aio-post-card-large .aio-col-sm-2 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            break;
    
                        case 3:
                            $this->css .= '.aio-post-card-large .aio-col-sm-3 {max-width: 33.33%; '.$this->display_col_type.' flex: 33.33%;}';
                            $this->css .= '.aio-post-card-large .aio-col-sm-3 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            break;
            
                        case 4:
                            $this->css .= '.aio-post-card-large .aio-col-sm-4 {max-width: 25%; '.$this->display_col_type.' flex: 25%;}';
                            $this->css .= '.aio-post-card-large .aio-col-sm-4 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            break;
    
                        case 5:
                            $this->css .= '.aio-post-card-large .aio-col-sm-5 {max-width: 20%; '.$this->display_col_type.' flex: 20%;}';
                            $this->css .= '.aio-post-card-large .aio-col-sm-5 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            break;
    
                        case 6:
                            $this->css .= '.aio-post-card-large .aio-col-sm-6 {max-width: 16.66%; '.$this->display_col_type.' flex: 16.66%;}';
                            $this->css .= '.aio-post-card-large .aio-col-sm-6 .aio-single-post-card-content {'.$this->display_col_type.'}';
                            break;
        
                    }

                }
                
            $this->css .= '}';

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
             * $output_css is the variable who contain the final css to write
             * Don't change it.
             */
            echo '<style>'.$this->css.'</style>';

        }

    }
}
$aio_post_card_class = new aio_post_card_class($aio_avada);

