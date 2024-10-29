<?php

if (!function_exists('adv_query_woo_products')){
    function adv_query_woo_products($atts){
        STATIC $i = 0;
        global $i;
        global $show_details_button;
        global $show_cart_button;
        global $hide_star_rating;
        $i ++;
        
        $atts = shortcode_atts(array (
            'layout'                        => '',  // DONE ------------------------------------------------------
            'limit'                         => '',  // DONE ------------------------------------------------------
            'paginate'                      => '',  // DONE ------------------------------------------------------
            'order'                         => '',  // DONE ------------------------------------------------------
            'orderby'                       => '',  // DONE ------------------------------------------------------
            'ids'                           => '',  // DONE ------------------------------------------------------
            'category'                      => '',  // DONE ------------------------------------------------------
            'class'                         =>'',   // DONE ------------------------------------------------------
            'columns'                       => '',  // DONE ------------------------------------------------------
            'tag'                           => '',  // DONE ------------------------------------------------------
            'on-sale'                       => '',  // DONE ------------------------------------------------------
            'best-selling'                  => '',  // DONE ------------------------------------------------------
            'top_rated'                     => '',  // DONE ------------------------------------------------------
            'padding-bewteen-columns'       => '',  // DONE ------------------------------------------------------

            //CAROUSEL
            'carousel'                      => 'yes',

            //COLUMNS DESIGN GROUP
            'col-overflow'                  => '',  // DONE ------------------------------------------------------
            'background-color'              => '',  // DONE ------------------------------------------------------
            'padding_top'                   => '',  // DONE ------------------------------------------------------
            'padding_right'                 => '',  // DONE ------------------------------------------------------
            'padding_bottom'                => '',  // DONE ------------------------------------------------------
            'padding_left'                  => '',  // DONE ------------------------------------------------------
            'col-margin-top'                => '',  // DONE ------------------------------------------------------
            'col-margin-right'              => '',  // DONE ------------------------------------------------------
            'col-margin-bottom'             => '',  // DONE ------------------------------------------------------
            'col-margin-left'               => '',  // DONE ------------------------------------------------------
            'col-border-top-right-radius'   => '',  // DONE ------------------------------------------------------
            'col-border-bottom-right-radius'=> '',  // DONE ------------------------------------------------------
            'col-border-top-left-radius'    => '',  // DONE ------------------------------------------------------
            'col-border-bottom-left-radius' => '',  // DONE ------------------------------------------------------
            'col-border'                    => '',  // DONE ------------------------------------------------------
            'col-border-top'                => '',  // DONE ------------------------------------------------------
            'col-border-right'              => '',  // DONE ------------------------------------------------------
            'col-border-left'               => '',  // DONE ------------------------------------------------------
            'col-border-bottom'             => '',  // DONE ------------------------------------------------------
            'col-border-color'              => '',  // DONE ------------------------------------------------------           
            'content-text-align'            => '',  // DONE ------------------------------------------------------
            
            //TITLE DESIGN GORUP
            'show-title'                => '',  // DONE ------------------------------------------------------
            'title'                     => '',  // DONE ------------------------------------------------------
            'fusion_font_family_title'  => '',  // DONE ------------------------------------------------------
            'fusion_font_variant_title' => '',  // DONE ------------------------------------------------------
            'title-background'          => '',  // DONE ------------------------------------------------------
            'title-font-size'           => '',  // DONE ------------------------------------------------------
            'title-color'               => '',  // DONE ------------------------------------------------------
            'title-color-hover'         => '',  // DONE ------------------------------------------------------
            'title-line-height'         => '',  // DONE ------------------------------------------------------
            'title-padding-top'         => '',  // DONE ------------------------------------------------------
            'title-padding-right'       => '',  // DONE ------------------------------------------------------
            'title-padding-bottom'      => '',  // DONE ------------------------------------------------------
            'title-padding-left'        => '',  // DONE ------------------------------------------------------
            'title-margin-top'          => '',  // DONE ------------------------------------------------------
            'title-margin-right'        => '',  // DONE ------------------------------------------------------
            'title-margin-bottom'       => '',  // DONE ------------------------------------------------------
            'title-margin-left'         => '',  // DONE ------------------------------------------------------
            'title-min-height'          => '',  // DONE ------------------------------------------------------

            //TERMS DESIGN GROUP
            'show-terms'                => '',  // DONE ------------------------------------------------------
            'terms'                     => '',  // DONE ------------------------------------------------------
            'fusion_font_family_terms'  => '',  // DONE ------------------------------------------------------
            'fusion_font_variant_terms' => '',  // DONE ------------------------------------------------------
            'terms-background'          => '',  // DONE ------------------------------------------------------
            'terms-font-size'           => '',  // DONE ------------------------------------------------------
            'terms-color'               => '',  // DONE ------------------------------------------------------
            'terms-color-hover'         => '',  // DONE ------------------------------------------------------
            'terms-line-height'         => '',  // DONE ------------------------------------------------------
            'terms-padding-top'         => '',  // DONE ------------------------------------------------------
            'terms-padding-right'       => '',  // DONE ------------------------------------------------------
            'terms-padding-bottom'      => '',  // DONE ------------------------------------------------------
            'terms-padding-left'        => '',  // DONE ------------------------------------------------------
            'terms-margin-top'          => '',  // DONE ------------------------------------------------------
            'terms-margin-right'        => '',  // DONE ------------------------------------------------------
            'terms-margin-bottom'       => '',  // DONE ------------------------------------------------------
            'terms-margin-left'         => '',  // DONE ------------------------------------------------------
            'terms-min-height'          => '',  // DONE ------------------------------------------------------

            //RATING DESIGN GROUP
            'hide_star_rating'          => '',  // DONE ------------------------------------------------------
            'rating-background-color'   => '',  // DONE ------------------------------------------------------
            'rating-border-color'       => '',  // DONE ------------------------------------------------------
            'rating-full-color'         => '',  // DONE ------------------------------------------------------
            'rating-star-size'          => '',  // DONE ------------------------------------------------------
            'rating-padding-top'        => '',  // DONE ------------------------------------------------------
            'rating-padding-right'      => '',  // DONE ------------------------------------------------------
            'rating-padding-bottom'     => '',  // DONE ------------------------------------------------------
            'rating-padding-left'       => '',  // DONE ------------------------------------------------------
            'rating-margin-top'         => '',  // DONE ------------------------------------------------------
            'rating-margin-right'       => '',  // DONE ------------------------------------------------------
            'rating-margin-bottom'      => '',  // DONE ------------------------------------------------------
            'rating-margin-left'        => '',  // DONE ------------------------------------------------------
            'rating-text-color'         => '',
            'rating-text-size'          => '',

            //PRICE DESIGN GORUP
            'show-price'                => '',  // DONE ------------------------------------------------------
            'price'                     => '',  // DONE ------------------------------------------------------
            'fusion_font_family_price'  => '',  // DONE ------------------------------------------------------
            'fusion_font_variant_price' => '',  // DONE ------------------------------------------------------
            'price-background'          => '',  // DONE ------------------------------------------------------
            'price-font-size'           => '',  // DONE ------------------------------------------------------
            'price-color'               => '',  // DONE ------------------------------------------------------
            'price-line-height'         => '',  // DONE ------------------------------------------------------
            'price-padding-top'         => '',  // DONE ------------------------------------------------------
            'price-padding-right'       => '',  // DONE ------------------------------------------------------
            'price-padding-bottom'      => '',  // DONE ------------------------------------------------------
            'price-padding-left'        => '',  // DONE ------------------------------------------------------
            'price-margin-top'          => '',  // DONE ------------------------------------------------------
            'price-margin-right'        => '',  // DONE ------------------------------------------------------
            'price-margin-bottom'       => '',  // DONE ------------------------------------------------------
            'price-margin-left'         => '',  // DONE ------------------------------------------------------
            'price-min-height'          => '',  // DONE ------------------------------------------------------
            //ORIGINAL PRICE WITHOUT DISCOUNT
            'full-price-background'     => '',  // DONE ------------------------------------------------------ 
            'full-price-font-size'      => '',  // DONE ------------------------------------------------------
            'full-price-color'          => '',  // DONE ------------------------------------------------------
            'full-price-line-height'    => '',  // DONE ------------------------------------------------------
            'full-price-padding-top'    => '',  // DONE ------------------------------------------------------
            'full-price-padding-right'  => '',  // DONE ------------------------------------------------------
            'full-price-padding-bottom' => '',  // DONE ------------------------------------------------------
            'full-price-padding-left'   => '',  // DONE ------------------------------------------------------

            //BUTTON DESIGN
            'show_cart_button'                  => '',  // DONE ------------------------------------------------------
            'show_details_button'               => '',  // DONE ------------------------------------------------------            
            'button'                            => '',  // DONE ------------------------------------------------------
            'fusion_font_family_button'         => '',  // DONE ------------------------------------------------------
            'fusion_font_variant_button'        => '',  // DONE ------------------------------------------------------
            'button-color-bg'                   => '',  // DONE ------------------------------------------------------
            'button-font-color'                 => '',  // DONE ------------------------------------------------------
            'button-color-bg-hover'             => '',  // DONE ------------------------------------------------------
            'button-font-color-hover'           => '',  // DONE ------------------------------------------------------
            'button-padding-top'                => '',  // DONE ------------------------------------------------------
            'button-padding-right'              => '',  // DONE ------------------------------------------------------
            'button-padding-bottom'             => '',  // DONE ------------------------------------------------------
            'button-padding-left'               => '',  // DONE ------------------------------------------------------
            'font-size-button'                  => '',  // DONE ------------------------------------------------------
            'button-margin-top'                 => '',  // DONE ------------------------------------------------------
            'button-margin-right'               => '',  // DONE ------------------------------------------------------
            'button-margin-bottom'              => '',  // DONE ------------------------------------------------------
            'button-margin-left'                => '',  // DONE ------------------------------------------------------
            'button-border-top-right-radius'    => '',  // DONE ------------------------------------------------------
            'button-border-bottom-right-radius' => '',  // DONE ------------------------------------------------------
            'button-border-top-left-radius'     => '',  // DONE ------------------------------------------------------
            'button-border-bottom-left-radius'  => '',  // DONE ------------------------------------------------------
        ), $atts, 'adv_products_template');    

        global $layout;
        $layout = $atts['layout'];
        $show_details_button = $atts['show_details_button'];
        $show_cart_button = $atts['show_cart_button'];
        $hide_star_rating = $atts['hide_star_rating'];








        $atts_products_shortcode = $atts;

        //GENERAL SETTING
            if($atts['padding-bewteen-columns']){$padding_bewteen_columns = 'padding: '.$atts['padding-bewteen-columns'].';';}
        
        //COLUMN SETTING
            if($atts['background-color']){$background_color = 'background-color:'.$atts['background-color'].';';}
            if($atts['padding_top']){$padding_top='padding-top: '.$atts['padding_top'].';';}
            if($atts['padding_right']){$padding_right='padding-right: '.$atts['padding_right'].';';}
            if($atts['padding_bottom']){$padding_bottom='padding-bottom: '.$atts['padding_bottom'].';';}
            if($atts['padding_left']){$padding_left='padding-left: '.$atts['padding_left'].';';}
            if($atts['col-border-top-right-radius']){$col_border_top_right_radius = 'border-top-right-radius:'.$atts['col-border-top-right-radius'].';';}        
            if($atts['col-border-bottom-right-radius']){$col_border_bottom_right_radius = 'border-bottom-right-radius:'.$atts['col-border-bottom-right-radius'].';';}   
            if($atts['col-border-top-left-radius']){$col_border_top_left_radius = 'border-top-left-radius:'.$atts['col-border-top-left-radius'].';';}
            if($atts['col-border-bottom-left-radius']){$col_border_bottom_left_radius = 'border-bottom-left-radius:'.$atts['col-border-bottom-left-radius'].';';}
            if($atts['col-overflow']){$col_overflow ='overflow: '.$atts['col-overflow'].';';}  
            if($atts['col-margin-top']){$col_margin_top = 'margin-top:'.$atts['col-margin-top'].';';}        
            if($atts['col-margin-right']){$col_margin_right = 'margin-right:'.$atts['col-margin-right'].';';}   
            if($atts['col-margin-bottom']){$col_margin_bottom = 'margin-bottom:'.$atts['col-margin-bottom'].';';}
            if($atts['col-margin-left']){$col_margin_left = 'margin-left:'.$atts['col-margin-left'].';';}
                    //CONTENT TEXT ALIGN
                    if($atts['content-text-align']=='center'){$text_align_content='text-align:center;';}
                    elseif($atts['content-text-align']=='right'){$text_align_content='text-align:right;';}
                    else{$text_align_content='text-align=left;';}

            if($atts['col-border-top']){$col_border_top = 'border-top:'.$atts['col-border-top'].' solid '.$atts['col-border-color'].';';}
            if($atts['col-border-right']){$col_border_right = 'border-right:'.$atts['col-border-right'].' solid '.$atts['col-border-color'].';';}
            if($atts['col-border-bottom']){$col_border_bottom = 'border-bottom:'.$atts['col-border-bottom']. ' solid '.$atts['col-border-color'].';';}
            if($atts['col-border-left']){$col_border_left = 'border-left:'.$atts['col-border-left']. ' solid '.$atts['col-border-color'].'';}
        
        //TITLE STYLE SETTING
            $title_font = Fusion_Builder_Element_Helper::get_font_styling($atts['fusion_font_family_title'], 'title' );
            if($atts['fusion_font_family_title']){$font_family_title = 'font-family: '.$atts['fusion_font_family_title'].';';}
            if($atts['fusion_font_variant_title']){$font_variant_title = 'font-weight: '.$atts['fusion_font_variant_title'].';';}
            if($atts['show-title']=='no'){$show_title = 'display: none;';}
            if($atts['title-background']){$title_background = 'background-color:'.$atts['title-background'].';';}
            if($atts['title-font-size']){$title_font_size = 'font-size:'.$atts['title-font-size'].';';}
            if($atts['title-color']){$title_color = 'color:'.$atts['title-color'].';';}
            if($atts['title-color-hover']){$title_color_hover = 'color:'.$atts['title-color-hover'].';';}
            if($atts['title-line-height']){$title_line_height = 'line-height:'.$atts['title-line-height'].';';}
            if($atts['title-padding-top']){$title_padding_top = 'padding-top:'.$atts['title-padding-top'].';';}
            if($atts['title-padding-right']){$title_padding_right = 'padding-right:'.$atts['title-padding-right'].';';}
            if($atts['title-padding-bottom']){$title_padding_bottom = 'padding-bottom:'.$atts['title-padding-bottom'].';';}       
            if($atts['title-padding-left']){$title_padding_left = 'padding-left:'.$atts['title-padding-left'].';';} 
            if($atts['title-margin-top']){$title_margin_top = 'margin-top:'.$atts['title-margin-top'].';';}
            if($atts['title-margin-right']){$title_margin_right = 'margin-right:'.$atts['title-margin-right'].';';}
            if($atts['title-margin-bottom']){$title_margin_bottom = 'margin-bottom:'.$atts['title-margin-bottom'].';';}
            if($atts['title-margin-left']){$title_margin_left = 'margin-left:'.$atts['title-margin-left'].';';}        
            if($atts['title-min-height']){$title_min_height = 'min-height:'.$atts['title-min-height'].';';}

        //TERMS STYLE SETTING
            if($atts['show-terms']=='no'){$show_terms = 'display:none;';}
            $title_font = Fusion_Builder_Element_Helper::get_font_styling($atts['fusion_font_family_terms'], 'terms' );
            if($atts['fusion_font_family_terms']){$font_family_terms = 'font-family: '.$atts['fusion_font_family_terms'].';';}
            if($atts['fusion_font_variant_terms']){$font_variant_terms = 'font-weight: '.$atts['fusion_font_variant_terms'].';';}
            if($atts['terms-background']){$terms_background = 'background-color:'.$atts['terms-background'].';';}
            if($atts['terms-font-size']){$terms_font_size = 'font-size:'.$atts['terms-font-size'].';';}
            if($atts['terms-color']){$terms_color = 'color:'.$atts['terms-color'].';';}
            if($atts['terms-color-hover']){$terms_color_hover = 'color:'.$atts['terms-color-hover'].';';}
            if($atts['terms-line-height']){$terms_line_height = 'line-height:'.$atts['terms-line-height'].';';}
            if($atts['terms-padding-top']){$terms_padding_top = 'padding-top:'.$atts['terms-padding-top'].';';}
            if($atts['terms-padding-right']){$terms_padding_right = 'padding-right:'.$atts['terms-padding-right'].';';}
            if($atts['terms-padding-bottom']){$terms_padding_bottom = 'padding-bottom:'.$atts['terms-padding-bottom'].';';}       
            if($atts['terms-padding-left']){$terms_padding_left = 'padding-left:'.$atts['terms-padding-left'].';';} 
            if($atts['terms-margin-top']){$terms_margin_top = 'margin-top:'.$atts['terms-margin-top'].';';}
            if($atts['terms-margin-right']){$terms_margin_right = 'margin-right:'.$atts['terms-margin-right'].';';}
            if($atts['terms-margin-bottom']){$terms_margin_bottom = 'margin-bottom:'.$atts['terms-margin-bottom'].';';}
            if($atts['terms-margin-left']){$terms_margin_left = 'margin-left:'.$atts['terms-margin-left'].';';}        
            if($atts['terms-min-height']){$terms_min_height = 'min-height:'.$atts['terms-min-height'].';';}

        //RATING STYLE SETTING
            if($atts['hide_star_rating']=='yes'){$hide_star_rating = 'display: none;';}
            if($atts['rating-background-color']){$rating_bacground_color = 'background-color: '.$atts['rating-background-color'].';';}
            if($atts['rating-border-color']){$rating_border_color = 'color: '.$atts['rating-border-color'].';';}
            if($atts['rating-full-color']){$rating_full_color = 'color: '.$atts['rating-full-color'].';';}
            if($atts['rating-star-size']){$rating_star_size = 'font-size: '.$atts['rating-star-size'].';';}
            if($atts['rating-padding-top']){$rating_padding_top = 'padding-top:'.$atts['rating-padding-top'].';';}
            if($atts['rating-padding-right']){$rating_padding_right = 'padding-right:'.$atts['rating-padding-right'].';';}
            if($atts['rating-padding-bottom']){$rating_padding_bottom = 'padding-bottom:'.$atts['rating-padding-bottom'].';';}       
            if($atts['rating-padding-left']){$rating_padding_left = 'padding-left:'.$atts['rating-padding-left'].';';} 
            if($atts['rating-margin-top']){$rating_margin_top = 'margin-top:'.$atts['rating-margin-top'].';';}
            if($atts['rating-margin-right']){$rating_margin_right = 'margin-right:'.$atts['rating-margin-right'].';';}
            if($atts['rating-margin-bottom']){$rating_margin_bottom = 'margin-bottom:'.$atts['rating-margin-bottom'].';';}
            if($atts['rating-margin-left']){$rating_margin_left = 'margin-left:'.$atts['rating-margin-left'].';';}
            if($atts['rating-text-color']){$rating_text_color = 'color:'.$atts['rating-text-color'].';';} 
            if($atts['rating-text-size']){$rating_text_size = 'font-size:'.$atts['rating-text-size'].';';}

        //PRICE SETTING
            if($atts['show-price']=='no'){$show_price = 'display: none;';}
            $price_font = Fusion_Builder_Element_Helper::get_font_styling($atts['fusion_font_family_price'], 'price' );
            if($atts['fusion_font_family_price']){$font_family_price = 'font-family: '.$atts['fusion_font_family_price'].';';}
            if($atts['fusion_font_variant_price']){$font_variant_price = 'font-weight: '.$atts['fusion_font_variant_price'].';';}
            if($atts['price-background']){$price_background = 'background-color:'.$atts['price-background'].';';}
            if($atts['price-font-size']){$price_font_size = 'font-size:'.$atts['price-font-size'].';';}
            if($atts['price-color']){$price_color = 'color:'.$atts['price-color'].';';}
            if($atts['price-line-height']){$price_line_height = 'line-height:'.$atts['price-line-height'].';';}
            if($atts['price-padding-top']){$price_padding_top = 'padding-top:'.$atts['price-padding-top'].';';}
            if($atts['price-padding-right']){$price_padding_right = 'padding-right:'.$atts['price-padding-right'].';';}
            if($atts['price-padding-bottom']){$price_padding_bottom = 'padding-bottom:'.$atts['price-padding-bottom'].';';}       
            if($atts['price-padding-left']){$price_padding_left = 'padding-left:'.$atts['price-padding-left'].';';} 
            if($atts['price-margin-top']){$price_margin_top = 'margin-top:'.$atts['price-margin-top'].';';}
            if($atts['price-margin-right']){$price_margin_right = 'margin-right:'.$atts['price-margin-right'].';';}
            if($atts['price-margin-bottom']){$price_margin_bottom = 'margin-bottom:'.$atts['price-margin-bottom'].';';}
            if($atts['price-margin-left']){$price_margin_left = 'margin-left:'.$atts['price-margin-left'].';';}        
            if($atts['price-min-height']){$price_min_height = 'min-height:'.$atts['price-min-height'].';';}
        //ORIGINAL PRICE WITHOUT DISCOUNT
            if($atts['full-price-background']){$full_price_background = 'background-color:'.$atts['full-price-background'].';';}
            if($atts['full-price-font-size']){$full_price_font_size = 'font-size:'.$atts['full-price-font-size'].';';}
            if($atts['full-price-color']){$full_price_color = 'color:'.$atts['full-price-color'].';';}
            if($atts['full-price-line-height']){$full_price_line_height = 'line-height:'.$atts['full-price-line-height'].';';}
            if($atts['full-price-padding-top']){$full_price_padding_top = 'padding-top:'.$atts['full-price-padding-top'].';';}
            if($atts['full-price-padding-right']){$full_price_padding_right = 'padding-right:'.$atts['full-price-padding-right'].';';}
            if($atts['full-price-padding-bottom']){$full_price_padding_bottom = 'padding-bottom:'.$atts['full-price-padding-bottom'].';';}       
            if($atts['full-price-padding-left']){$full_price_padding_left = 'padding-left:'.$atts['full-price-padding-left'].';';} 

        
        //BUTTON STYLE
            if($atts['show_cart_button']=='no'){$show_cart_button = 'display: none;';}
            if($atts['show_details_button']=='no'){$show_details_button = 'display: none;';}
            $button_font = Fusion_Builder_Element_Helper::get_font_styling($atts['fusion_font_family_button'], 'button' );
            if($atts['fusion_font_family_button']){$font_family_button = 'font-family: '.$atts['fusion_font_family_button'].';';}
            if($atts['fusion_font_variant_button']){$font_variant_button = 'font-weight: '.$atts['fusion_font_variant_button'].';';}
            if($atts['font-size-button']){$font_size_button = 'font-size: '.$atts['font-size-button'].';';}
            if($atts['button-color-bg']){$button_color_bg = 'background-color:'.$atts['button-color-bg'].';';}
            if($atts['button-color-bg-hover']){$button_color_bg_hover = 'background-color:'.$atts['button-color-bg-hover'].';';}
            if($atts['button-padding-top']){$button_padding_top = 'padding-top:'.$atts['button-padding-top'].';';}
            if($atts['button-padding-right']){$button_padding_right = 'padding-right:'.$atts['button-padding-right'].';';}
            if($atts['button-padding-bottom']){$button_padding_bottom = 'padding-bottom:'.$atts['button-padding-bottom'].';';}       
            if($atts['button-padding-left']){$button_padding_left = 'padding-left:'.$atts['button-padding-left'].';';} 
            if($atts['button-margin-top']){$button_margin_top = 'margin-top:'.$atts['button-margin-top'].';';}
            if($atts['button-margin-right']){$button_margin_right = 'margin-right:'.$atts['button-margin-right'].';';}
            if($atts['button-margin-bottom']){$button_margin_bottom = 'margin-bottom:'.$atts['button-margin-bottom'].';';}       
            if($atts['button-margin-left']){$button_margin_left = 'margin-left:'.$atts['button-margin-left'].';';} 
            if($atts['button-border-top-right-radius']){$button_border_top_right_radius = 'border-top-right-radius:'.$atts['button-border-top-right-radius'].';';}        
            if($atts['button-border-bottom-right-radius']){$button_border_bottom_right_radius = 'border-bottom-right-radius:'.$atts['button-border-bottom-right-radius'].';';}   
            if($atts['button-border-top-left-radius']){$button_border_top_left_radius = 'border-top-left-radius:'.$atts['button-border-top-left-radius'].';';}        
            if($atts['button-border-bottom-left-radius']){$button_border_bottom_left_radius = 'border-bottom-left-radius:'.$atts['button-border-bottom-left-radius'].';';}         
            if($atts['button-font-color']){$button_font_color = 'color:'.$atts['button-font-color'].';';}
            if($atts['button-font-color-hover']){$button_font_color_hover = 'color:'.$atts['button-font-color-hover'].';';}

        
        
        $output='<style>
            .AIO-products-'.$i.' .products li .fusion-product-wrapper {'.$background_color.''.$padding_top.''.$padding_right.''.$padding_bottom.''.$padding_left.''.$col_margin_top.''.$col_margin_right.''.$col_margin_bottom.''.$col_margin_left.''.$col_border_top_right_radius.''.$col_border_bottom_right_radius.''.$col_border_top_left_radius.''.$col_border_bottom_left_radius.''.$col_overflow.'}
            .AIO-products-'.$i.' .products li {'.$padding_bewteen_columns.'}
            .AIO-products-'.$i.' .products .fusion-product-wrapper {'.$col_border_top.''.$col_border_right.''.$col_border_bottom.''.$col_border_left.'}

            .AIO-products-'.$i.' .product-title {'.$show_title.''.$font_family_title.''.$font_variant_title.''.$title_background.''.$title_font_size.''.$title_line_height.''.$title_padding_top.''.$title_padding_right.''.$title_padding_bottom.''.$title_padding_left.''.$title_margin_top.''.$title_margin_right.''.$title_margin_bottom.''.$title_margin_left.''.$title_min_height.''.$text_align_content.'}
            .AIO-products-'.$i.' .product-title a {'.$title_color.'}
            .AIO-products-'.$i.' .product-title a:hover {'.$title_color_hover.'}

            .AIO-products-'.$i.' .AIO-product-terms {width: 100%;'.$show_terms.''.$font_family_terms.''.$font_variant_terms.''.$terms_background.''.$terms_font_size.''.$terms_line_height.''.$terms_padding_top.''.$terms_padding_right.''.$terms_padding_bottom.''.$terms_padding_left.''.$terms_margin_top.''.$terms_margin_right.''.$terms_margin_bottom.''.$terms_margin_left.''.$terms_min_height.''.$text_align_content.'}
            .AIO-products-'.$i.' .AIO-product-terms a {'.$terms_color.'}
            .AIO-products-'.$i.' .AIO-product-terms a:hover {'.$terms_color_hover.'}
            .AIO-products-'.$i.' span.AIO-product-terms-separator {'.$terms_color.''.$terms_font_size.''.$font_family_terms.''.$font_variant_terms.'}
            .AIO-products-'.$i.' span.AIO-product-terms-separator:last-child {display: none;}
            .AIO-products-'.$i.' .AIO-product-terms {order: 0;}

            .AIO-products-'.$i.' .product-details-container .fusion-price-rating .star-rating {order: 1;}
            .AIO-products-'.$i.' .product-details-container .fusion-price-rating .price {order: 2; '.$font_family_price.''.$price_color.''.$font_variant_price.''.$price_background.''.$price_font_size.''.$price_line_height.''.$price_padding_top.''.$price_padding_right.''.$price_padding_bottom.''.$price_padding_left.''.$price_margin_top.''.$price_margin_right.''.$price_margin_bottom.''.$price_margin_left.''.$price_min_height.'}
            .AIO-products-'.$i.' .price ins .amount {'.$price_color.'}
            .AIO-products-'.$i.' .price del {'.$price_color.''.$full_price_color.''.$full_price_background.''.$full_price_font_size.''.$full_price_line_height.''.$full_price_padding_top.''.$full_price_padding_right.''.$full_price_padding_bottom.''.$full_price_padding_left.'}
            .AIO-products-'.$i.' span.price {width: 100%;'.$show_price.''.$text_align_content.'}

            .AIO-products-'.$i.' .star-rating {width: 100%;'.$text_align_content.''.$hide_star_rating.''.$rating_bacground_color.''.$rating_star_size.''.$rating_padding_top.''.$rating_padding_right.''.$rating_padding_bottom.''.$rating_padding_left.''.$rating_margin_top.''.$rating_margin_right.''.$rating_margin_bottom.''.$rating_margin_left.'}
            .AIO-products-'.$i.' .star-rating:before {width: 100%;'.$rating_border_color.'}
            .AIO-products-'.$i.' .star-rating span:before {width: 100%;'.$rating_full_color.'}
            .AIO-products-'.$i.' .star-rating span {width: 100%;'.$rating_text_color.'}

            .AIO-products-'.$i.' .adv-button a, .AIO-products-'.$i.' a.adv-button {display: block; '.$show_cart_button.''.$text_align_content.''.$font_family_button.''.$button_color_bg.''.$button_font_color.''.$button_padding_top.''.$button_padding_right.''.$button_padding_bottom.''.$button_padding_left.''.$button_margin_top.''.$button_margin_right.''.$button_margin_bottom.''.$button_margin_left.''.$font_size_button.''.$button_border_top_right_radius.''.$button_border_bottom_right_radius.''.$button_border_bottom_left_radius.''.$button_border_top_left_radius.'}
            .AIO-products-'.$i.' .adv-button a:hover, .AIO-products-'.$i.' a.adv-button:hover {'.$button_color_bg_hover.''.$button_font_color.'}
            .AIO-products-'.$i.' .fusion-product-content {padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; }
            </style>';        
            

            

            if(is_archive()){
                $arch_prod_cat = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
                $atts['category'] = $arch_prod_cat->slug;
                
                $output .= do_shortcode('[products
                    limit =         "'.$atts['limit'].'"
                    columns =       "'.$atts['columns'].'"
                    paginate =      "'.$atts['paginate'].'"
                    orderby =       "'.$atts['orderby'].'"
                    category =      "'.$atts['category'].'"
                    order =         "'.$atts['order'].'"
                    class =         "AIO-products-'.$i.' AIO-'.$atts['layout'].'-layout '.$atts['class'].' AIO-products-archive-page"
                    on_sale =       "'.$atts['on-sale'].'"
                    best_selling =  "'.$atts['best-selling'].'"
                    top_rated =     "'.$atts['top_rated'].'"
                ]');
                return $output; 
            } 
            else{
                $output .= do_shortcode('[products
                    limit =         "'.$atts['limit'].'"
                    columns =       "'.$atts['columns'].'"
                    paginate =      "'.$atts['paginate'].'"
                    orderby =       "'.$atts['orderby'].'"
                    ids=            "'.$atts['ids'].'"
                    skus =          ""
                    category =      "'.$atts['category'].'"
                    tag =           "'.$atts['tag'].'"
                    order =         "'.$atts['order'].'"
                    class =         "AIO-products-'.$i.' AIO-'.$atts['layout'].'-layout '.$atts['class'].'"
                    on_sale =       "'.$atts['on-sale'].'"
                    best_selling =  "'.$atts['best-selling'].'"
                    top_rated =     "'.$atts['top_rated'].'"
                ]');
                return $output;     
            }

    }
    add_shortcode ('adv_products_template','adv_query_woo_products');
    add_shortcode ('adv_products_template_archive','adv_query_woo_products');



}


//LAYOUT OPTION-----------------------------------------------------------------------------------------------------------------
    //GRID CLASSIC-----------------------------------------------------------------------------------------------------------------
    function adv_get_layout_grid_classic_terms(){
        global $layout;
        global $product;
        global $hide_star_rating;

        if($layout=='grid-classic'){

            $terms = get_the_terms( get_the_ID(), 'product_cat' );
            
            echo '<div class="AIO-product-terms">';
            foreach ($terms as $term){
                $terms_number = count($terms);
                echo '<a href="'.get_term_link($term).'" class="AIO-product-terms-link">'.$term->name.'</a>';
                if($terms>1){
                    echo '<span class="AIO-product-terms-separator"> | </span>';
                }
            }
            echo'</div>';

            //GET AVERAGE
            if($hide_star_rating=='no'){
                if($average = $product->get_average_rating()){
                    echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
                }
            }
        }
    }
    add_action ('woocommerce_after_shop_loop_item_title', 'adv_get_layout_grid_classic_terms');
//GRID MODERN-----------------------------------------------------------------------------------------------------------------
    function adv_get_layout_grid_modern_terms(){
        global $layout;
        global $product;
        global $hide_star_rating;

        if($layout=='grid-modern'){
            $terms = get_the_terms( get_the_ID(), 'product_cat' );
            
            echo '<div class="AIO-product-terms">';
            foreach ($terms as $term){
                $terms_number = count($terms);
                echo '<a href="'.get_term_link($term).'" class="AIO-product-terms-link">'.$term->name.'</a>';
                if($terms>1){
                    echo '<span class="AIO-product-terms-separator"> | </span>';
                }
            }
            echo'</div>';

            echo '<h3 class="product-title fusion-responsive-typography-calculated">
                <a href="'.get_permalink().'">'.get_the_title().'</a>
            </h3>';

            //GET AVERAGE
            if($hide_star_rating=='no'){
                if($average = $product->get_average_rating()){
                    echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
                }
            }
        }
    }
    add_action ('woocommerce_before_shop_loop_item', 'adv_get_layout_grid_modern_terms');  
    
    function adv_get_layout_grid_modern_cart(){
        global $layout;
        global $i;
        global $show_details_button;
        global $show_cart_button;

        echo '<style>
        .AIO-products-'.$i.' span.price {width: max-content; text-align: center;}
        .AIO-products-'.$i.' .product-details-container .fusion-price-rating .price {order: 0;}
        .AIO-products-'.$i.' .adv-add-to-cart-grid-modern {order: 10;}
        .AIO-products-'.$i.' .adv_woo_grid_modern_after_cart_loop {order: 20;}
        </style>';

        if($layout=='grid-modern'){

        do_action ('adv_woo_grid_modern_before_cart_loop');
            if($show_cart_button){
                echo '<div class="adv-button adv-add-to-cart-grid-modern">';
                    woocommerce_template_loop_add_to_cart();
                echo '</div>';
            }

            if($show_details_button=='yes'){
                echo '<div class="adv-details-grid-modern">';
                    echo '<a href="'.get_permalink().'" class="adv-button show_details_button"><i class="fas fa-bars"></i></a>';
                echo '</div>';
            }
        echo '<div class="adv_woo_grid_modern_after_cart_loop">';
            do_action ('adv_woo_grid_modern_after_cart_loop');
        echo '</div>';

        echo '<div class="adv_woo_grid_modern_after_cart_loop2">';
            do_action ('adv_woo_grid_modern_after_cart_loop2');
        echo '</div>';
        }
    }
    add_action ('woocommerce_after_shop_loop_item_title', 'adv_get_layout_grid_modern_cart');
//SPECIAL OFFER-----------------------------------------------------------------------------------------------------------------
    function adv_get_layout_special_offer_terms(){
        global $layout;

        if($layout=='special-offer'){
            $terms = get_the_terms( get_the_ID(), 'product_cat' );

            echo '<div class="AIO-product-terms">';
            foreach ($terms as $term){
                $terms_number = count($terms);
                echo '<a href="'.get_term_link($term).'" class="AIO-product-terms-link">'.$term->name.'</a>';
                if($terms>1){
                    echo '<span class="AIO-product-terms-separator"> | </span>';
                }
            }
            echo'</div>';
        }
    }
    add_action ('woocommerce_after_shop_loop_item_title', 'adv_get_layout_special_offer_terms'); 


    function adv_get_layout_special_offer_cart(){
        global $layout;
        global $i;
        global $show_details_button;
        global $show_cart_button;
        global $product;
        global $hide_star_rating;

        if($layout=='special-offer'){
        echo '<style>
        .AIO-products-'.$i.' span.price {width: max-content; text-align: center;}
        .AIO-products-'.$i.' .product-details-container .fusion-price-rating .price {order: 0;}
        .AIO-products-'.$i.' .adv-add-to-cart-special-offer {order: 10;}
        .AIO-products-'.$i.' .product-details-container .fusion-price-rating .star-rating {order: 10;}
        .AIO-products-'.$i.' .adv_woo_special_offer_after_cart_loop {order: 20;}
        .AIO-products-'.$i.' .adv_woo_special_offer_count_down .fusion-countdown-counter-wrapper {font-size: 15px;}
        .AIO-products-'.$i.' .adv_woo_special_offer_count_down .fusion-dash-title {font-size: 10px;}
        .AIO-products-'.$i.' .adv_woo_special_offer_count_down .fusion-countdown {padding: 12px 0px;}
        .AIO-products-'.$i.' .adv_woo_special_offer_count_down {width: 100%;}
        .AIO-products-'.$i.' .adv_woo_special_offer_count_down .fusion-dash {padding: 5px 0px;}
        .AIO-products-'.$i.' .adv_woo_special_offer_count_down .fusion-dash-wrapper {padding: 2px;}
        </style>';
        }

        if($layout=='special-offer'){
        do_action ('adv_woo_special_offer_before_cart_loop');
            if($show_cart_button){
                echo '<div class="adv-button adv-add-to-cart-special-offer">';
                    woocommerce_template_loop_add_to_cart();
                echo '</div>';
            }

            if($show_details_button=='yes'){
                echo '<div class="adv-details-grid-modern">';
                    echo '<a href="'.get_permalink().'" class="show_details_button"><i class="fas fa-bars"></i></a>';
                echo '</div>';
            }
        echo '<div class="adv_woo_special_offer_after_cart_loop">';
            do_action ('adv_woo_grid_modern_after_cart_loop');
        echo '</div>';

        //GET AVERAGE
        if($hide_star_rating=='no'){
            if($average = $product->get_average_rating()){
                echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
            }
        }
        echo '<div class="adv_woo_special_offer_count_down">';
            do_action ('adv_woo_special_offer_count_down');
        echo '</div>';
        }
    }
    add_action ('woocommerce_after_shop_loop_item_title', 'adv_get_layout_special_offer_cart');

    function adv_add_countdown_sale_in_loop(){
        global $product;
        
        $sales_price_to   = get_post_meta( $product->id, '_sale_price_dates_to', true );
        $sales_price_date_to   = date( "Y-m-d H:i:s", $sales_price_to );
        
        $countdouwn = '[fusion_countdown countdown_end="'.$sales_price_date_to.'" timezone="" layout="stacked" show_weeks="" label_position="bottom" border_radius="" heading_text=" Offer ends in" subheading_text="" link_url="" link_text="" link_target="default" hide_on_mobile="small-visibility,medium-visibility,large-visibility" class="adv-count-down-on-sale" id="" background_color="#fed700" background_image="" background_position="" background_repeat="" counter_box_spacing="" counter_box_color="#ffffff" counter_border_size="" counter_border_color="" counter_border_radius="" counter_padding_top="" counter_padding_right="" counter_padding_bottom="" counter_padding_left="" counter_font_size="" counter_text_color="#333e48" label_font_size="" label_color="#333e48" heading_font_size="" heading_text_color="#ffffff" subheading_font_size="" subheading_text_color="#ffffff" link_text_color="" /]';
        echo do_shortcode($countdouwn);
    }
    
    add_action( 'adv_woo_special_offer_count_down', 'adv_add_countdown_sale_in_loop', 10 );

    function adv_rating(){
     }    
    add_action( 'woocommerce_before_shop_loop_item', 'adv_rating', 10 );








//----------------------------------------------------------------------------->>>START FUSION BUILDER INTEGRATION
if (!function_exists('adv_products_template_builder')){
    function adv_products_template_builder() {
    fusion_builder_map( 	
                fusion_builder_frontend_data(
                'FusionProductsTemplate',
                [
                    'name'            => esc_attr__( 'WooCommerce Product AIO', 'avada_addons' ),
                    'shortcode'       => 'adv_products_template',
                    'icon'          => 'fusiona-tag',
                    'inline_editor' => true,
                    'params'        => [
// GENERAL SECTION ---------------------------------------------------------------------------------------------------------------------------------
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Layout', 'avada_addons' ),
                            'description' => esc_attr__( 'Select the layout you would to use', 'avada_addons' ),
                            'param_name'  => 'layout',
                            'value'       => [
                                'grid-classic'          => esc_attr__( 'Grid Classic', 'avada_addons' ),
                                'grid-modern'           => esc_attr__( 'Grid Modern', 'avada_addons' ),
                                'special-offer'         => esc_attr__( 'Special Offer', 'avada_addons' ),
                            ],
                            'default'     => 'grid-classic',
                        ],
                        [
                            'type'        => 'range',
                            'heading'     => esc_attr__( 'Number of Products to display', 'avada_addons' ),
                            'description' => esc_attr__( 'The number of products to display. Defaults to and -1 (display all)  when listing products, and -1 (display all) for categories.', 'avada_addons' ),
                            'param_name'  => 'limit',
                            'value'       => '4',
                            'min'         => '-1',
                            'max'         => '200',
                            'step'        => '1',
                        ],
                        [
                            'type'        => 'range',
                            'heading'     => esc_attr__( 'Columns', 'avada_addons' ),
                            'description' => esc_attr__( 'The number of columns to display. Defaults to 4', 'avada_addons' ),
                            'param_name'  => 'columns',
                            'value'       => '4',
                            'min'         => '1',
                            'max'         => '6',
                            'step'        => '1',
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Space Between Columns', 'avada_addons' ),
                            'description' => esc_attr__( 'Space between each columns. ex 10px.', 'avada_addons' ),
                            'param_name'  => 'padding-bewteen-columns',
                            'value'       => '',
                        ],
                        [
							'type'        => 'radio_button_set',
							'heading'     => esc_attr__( 'Pagination', 'avada_addons' ),
							'description' => esc_attr__( 'Toggles pagination on. Use in conjunction with Number of Products to display', 'avada_addons' ),
							'param_name'  =>  'paginate',
							'default'     => 'false',
							'value'       => [
								'true' => esc_attr__( 'Yes', 'avada_addons' ),
								'false'  => esc_attr__( 'No', 'avada_addons' ),
							],
                        ],
                        [
                            'type'        => 'multiple_select',
                            'heading'     => esc_attr__( 'Order By', 'avada_addons' ),
                            'description' => esc_attr__( 'Sorts the products displayed by the entered option. One or more options can be passed by adding both slugs with a space between them. Defaults is Title', 'avada_addons' ),
                            'param_name'  => 'orderby',
                            'value'       => [
                                'date'          => esc_attr__( 'Date', 'avada_addons' ),
                                'id'            => esc_attr__( 'Id', 'avada_addons' ),
                                'menu_order'    => esc_attr__( 'Menu Order', 'avada_addons' ),
                                'popularity'    => esc_attr__( 'Popularity', 'avada_addons' ),
                                'rand'          => esc_attr__( 'Random', 'avada_addons' ),
                                'rating'        => esc_attr__( 'Rating', 'avada_addons' ),
                                'title'         => esc_attr__( 'Title', 'avada_addons' ),
                            ],
                        ], 
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Category', 'avada_addons' ),
                            'description' => esc_attr__( 'Comma-separated list of category slugs.', 'avada_addons' ),
                            'param_name'  => 'category',
                            'value'       => '',
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Ids', 'avada_addons' ),
                            'description' => esc_attr__( 'Will display products based on a comma-separated list of Post IDs.', 'avada_addons' ),
                            'param_name'  => 'ids',
                            'value'       => '',
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Tag', 'avada_addons' ),
                            'description' => esc_attr__( 'Comma-separated list of tag slugs.', 'avada_addons' ),
                            'param_name'  => 'tag',
                            'value'       => '',
                        ],                    
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Order', 'avada_addons' ),
                            'description' => esc_attr__( 'States whether the product order is ascending (ASC) or descending (DESC), using the method set in orderby. Defaults to ASC.', 'avada_addons' ),
                            'param_name'  => 'order',
                            'default'     => 'DESC',
                            'value'       => [
                                'DESC' => esc_attr__( 'Descending', 'avada_addons' ),
                                'ASC'  => esc_attr__( 'Ascending', 'avada_addons' ),
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
                            'description' => esc_attr__( 'Adds an HTML wrapper class so you can modify the specific output with custom CSS.', 'avada_addons' ),
                            'param_name'  => 'class',
                            'value'       => '',
                        ],
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Overflow', 'avada_addons' ),
                            'description' => esc_attr__( 'Select the overflow attribute for the columns', 'avada_addons' ),
                            'param_name'  => 'col-overflow',
                            'default'     => 'visible',
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                            'value'       => [
                                'visible'       => esc_attr__( 'Visible', 'avada_addons' ),
                                'hidden'        => esc_attr__( 'Hidden', 'avada_addons' ),
                                'scroll'        => esc_attr__( 'Scroll', 'avada_addons' ),
                                'auto'          => esc_attr__( 'Auto', 'avada_addons' ),
                                'initial'       => esc_attr__( 'Initial', 'avada_addons' ),
                                'inherit'       => esc_attr__( 'Inherit', 'avada_addons' ),
                                
                            ],
                            'callback'    => [
                                'function' => 'fusion_ajax',
                                'action'   => 'get_fusion_blog',
                                'ajax'     => true,
                            ],
                        ],
                        [
							'type'        => 'radio_button_set',
							'heading'     => esc_attr__( 'On sale', 'avada_addons' ),
							'description' => esc_attr__( 'Retrieve on sale products. Not to be used in conjunction with best sellingor top rated.', 'avada_addons' ),
							'param_name'  =>  'on-sale',
							'default'     => 'false',
							'value'       => [
								'true' => esc_attr__( 'Yes', 'avada_addons' ),
								'false'  => esc_attr__( 'No', 'avada_addons' ),
							],
                        ],
                        [
							'type'        => 'radio_button_set',
							'heading'     => esc_attr__( 'Best Selling', 'avada_addons' ),
							'description' => esc_attr__( 'Retrieve the best selling products. Not to be used in conjunction with on sale or top rated.', 'avada_addons' ),
							'param_name'  =>  'best-selling',
							'default'     => 'false',
							'value'       => [
								'true' => esc_attr__( 'Yes', 'avada_addons' ),
								'false'  => esc_attr__( 'No', 'avada_addons' ),
							],
                        ],
                        [
							'type'        => 'radio_button_set',
							'heading'     => esc_attr__( 'Top Rated', 'avada_addons' ),
							'description' => esc_attr__( 'Retrieve top-rated products. Not to be used in conjunction with on sale or best selling.', 'avada_addons' ),
							'param_name'  =>  'top-rated',
							'default'     => 'false',
							'value'       => [
								'true' => esc_attr__( 'Yes', 'avada_addons' ),
								'false'  => esc_attr__( 'No', 'avada_addons' ),
							],
                        ],
// GLOBAL SETTING SECTION --------------------------------------------------------------------------------------------------------------------------
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'background-color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Text Align', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the alignment of the content.', 'avada_addons' ),
                            'param_name'  => 'content-text-align',
                            'default'     => 'center',
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                            'value'       => [
                                'center'        => esc_attr__( 'Center', 'avada_addons' ),
                                'left'          => esc_attr__( 'Left', 'avada_addons' ),
                                'right'         => esc_attr__( 'Right', 'avada_addons' ),                                
                            ],
                            'callback'    => [
                                'function' => 'fusion_ajax',
                                'action'   => 'get_fusion_blog',
                                'ajax'     => true,
                            ],
                        ],
                        [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the padding size of the columns element.', 'avada_addons' ),
						'param_name'  => 'padding_columns',
						'value'       => [
							'padding_top'    => '',
							'padding_right'  => '',
							'padding_bottom' => '',
							'padding_left'   => '',
						],
						'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
					    ],
                        [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the margin size of the columns element.', 'avada_addons' ),
						'param_name'  => 'margin_columns',
						'value'       => [
							'col-margin-top'    => '',
							'col-margin-right'  => '',
							'col-margin-bottom' => '',
							'col-margin-left'   => '',
						],
						'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'dimension',
                            'heading'     => esc_attr__( 'Border Size', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the border size of the columns element.', 'avada_addons' ),
                            'param_name'  => 'col-border',
                            'value'       => [
                                'col-border-top'    => '',
                                'col-border-right'  => '',
                                'col-border-left'   => '',
                                'col-border-bottom' => '',
                            ],
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                        ],                        
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Border Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'col-border-color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                        ],
                        [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Border Radius', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the margin size of the columns element.', 'avada_addons' ),
						'param_name'  => 'col-border-radius',
						'value'       => [
							'col-border-top-right-radius'    => '',
							'col-border-bottom-right-radius'  => '',
							'col-border-bottom-left-radius' => '',
							'col-border-top-left-radius'   => '',
						],
						'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
					    ],
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Overflow', 'avada_addons' ),
                            'description' => esc_attr__( 'Select the overflow attribute for the columns', 'avada_addons' ),
                            'param_name'  => 'col-overflow',
                            'default'     => 'visible',
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                            'value'       => [
                                'visible'       => esc_attr__( 'Visible', 'avada_addons' ),
                                'hidden'        => esc_attr__( 'Hidden', 'avada_addons' ),
                                'scroll'        => esc_attr__( 'Scroll', 'avada_addons' ),
                                'auto'          => esc_attr__( 'Auto', 'avada_addons' ),
                                'initial'       => esc_attr__( 'Initial', 'avada_addons' ),
                                'inherit'       => esc_attr__( 'Inherit', 'avada_addons' ),
                                
                            ],
                            'callback'    => [
                                'function' => 'fusion_ajax',
                                'action'   => 'get_fusion_blog',
                                'ajax'     => true,
                            ],
                        ],
// TITLE SECTION ------------------------------------------------------------------------------------------------------------------------------------
                        [
							'type'        => 'radio_button_set',
							'heading'     => esc_attr__( 'Show Title', 'avada_addons' ),
							'description' => esc_attr__( 'Select Yes if you would to show the title.', 'avada_addons' ),
							'param_name'  =>  'show-title',
							'default'     => 'yes',
							'value'       => [
								'yes' => esc_attr__( 'Yes', 'avada_addons' ),
								'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'group'            => esc_attr__( 'Title', 'avada_addons' ),
						],
                        [
                            'type'             => 'font_family',
                            'remove_from_atts' => true,
                            'heading'          => esc_attr__( 'Font Family', 'fusion-builder' ),
                            /* translators: URL for the link. */
                            'description'      => sprintf( esc_html__( 'Controls the font family of the title text.  Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'fusion-builder' ) ),
                            'param_name'       => 'title',
                            'group'            => esc_attr__( 'Title', 'avada_addons' ),
                            'default'          => [
                                'font-family'  => '',
                                'font-variant' => '400',
                            ],
                        ],
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'title-background',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Font Size', 'avada_addons' ),
                            /* translators: URL for the link. */
                            'description' => esc_attr__( 'Controls the font size of the title. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                            'param_name'  => 'title-font-size',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],
                       ],
                       [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Line Height', 'avada_addons' ),
                            /* translators: URL for the link. */
                            'description' => esc_attr__( 'Controls the line height of the title. Enter value including any valid CSS unit, ex: 28px.', 'avada_addons' ),
                            'param_name'  => 'title-line-height',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],                           
                        ],
                       [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Font Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the color of the title, ex: #000.', 'avada_addons' ),
                            'param_name'  => 'title-color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],                            
                        ],
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Hover Font Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the color of the title on hover, ex: #000.', 'avada_addons' ),
                            'param_name'  => 'title-color-hover',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],                            
                        ],                         
                       [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the padding size of the title.', 'avada_addons' ),
						'param_name'  => 'title-padding',
						'value'       => [
							'title-padding-top'    => '',
							'title-padding-right'  => '',
							'title-padding-bottom' => '',
							'title-padding-left'   => '',
						],
                        'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-title',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
					    ], 
                        [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the margin size of the title.', 'avada_addons' ),
						'param_name'  => 'title-margin',
						'value'       => [
							'title-margin-top'    => '',
							'title-margin-right'  => '',
							'title-margin-bottom' => '',
							'title-margin-left'   => '',
						],
                        'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-title',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
					    ], 
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Min Height', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the minimum height of the title. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                            'param_name'  => 'title-min-height',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],
                       ],
// TERMS SECTION --------------------------------------------------------------------------------------------------------------------------
                       [
                        'type'        => 'radio_button_set',
                        'heading'     => esc_attr__( 'Show Terms', 'avada_addons' ),
                        'description' => esc_attr__( 'Select Yes if you would to show the terms.', 'avada_addons' ),
                        'param_name'  =>  'show-terms',
                        'default'     => 'yes',
                        'value'       => [
                            'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                            'no'  => esc_attr__( 'No', 'avada_addons' ),
                        ],
                        'group'            => esc_attr__( 'Terms', 'avada_addons' ),
                    ],
                    [
                        'type'             => 'font_family',
                        'remove_from_atts' => true,
                        'heading'          => esc_attr__( 'Font Family', 'fusion-builder' ),
                        /* translators: URL for the link. */
                        'description'      => sprintf( esc_html__( 'Controls the font family of the terms text.  Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'fusion-builder' ) ),
                        'param_name'       => 'terms',
                        'group'            => esc_attr__( 'Terms', 'avada_addons' ),
                        'default'          => [
                            'font-family'  => '',
                            'font-variant' => '400',
                        ],
                    ],
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                        'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                        'param_name'  => 'terms-background',
                        'value'       => '',
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                    ],
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Font Size', 'avada_addons' ),
                        /* translators: URL for the link. */
                        'description' => esc_attr__( 'Controls the font size of the terms. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                        'param_name'  => 'terms-font-size',
                        'value'       => '',
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                   ],
                   [
                    'type'        => 'textfield',
                    'heading'     => esc_attr__( 'Line Height', 'avada_addons' ),
                    /* translators: URL for the link. */
                    'description' => esc_attr__( 'Controls the line height of the terms. Enter value including any valid CSS unit, ex: 28px.', 'avada_addons' ),
                    'param_name'  => 'terms-line-height',
                    'value'       => '',
                    'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-terms',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],                           
               ],
                   [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Font Color', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the color of the terms, ex: #000.', 'avada_addons' ),
                        'param_name'  => 'terms-color',
                        'value'       => '',
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],                            
                    ], 
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Hover Font Color', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the color of the terms on hover, ex: #000.', 'avada_addons' ),
                        'param_name'  => 'terms-color-hover',
                        'value'       => '',
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],                            
                    ],                        
                    [
                    'type'        => 'dimension',
                    'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the margin size of the terms.', 'avada_addons' ),
                    'param_name'  => 'terms-margin',
                    'value'       => [
                        'terms-margin-top'    => '',
                        'terms-margin-right'  => '',
                        'terms-margin-bottom' => '',
                        'terms-margin-left'   => '',
                    ],
                    'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-terms',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],
                    ], 
                    [
                        'type'        => 'dimension',
                        'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the padding size of the terms.', 'avada_addons' ),
                        'param_name'  => 'terms-padding',
                        'value'       => [
                            'terms-padding-top'    => '',
                            'terms-padding-right'  => '',
                            'terms-padding-bottom' => '',
                            'terms-padding-left'   => '',
                        ],
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                        ], 
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Min Height', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the minimum height of the terms. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                        'param_name'  => 'terms-min-height',
                        'value'       => '',
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                   ],
// RATING SECTION ----------------------------------------------------------------------------------------------------------------------------------------------------
                   [
                        'type'        => 'radio_button_set',
                        'heading'     => esc_attr__( 'Hide Star Rating', 'avada_addons' ),
                        'description' => esc_attr__( 'Select if you would to show review stars.', 'avada_addons' ),
                        'param_name'  => 'hide_star_rating',
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'value'       => [
                            'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                            'no'  => esc_attr__( 'No', 'avada_addons' ),
                        ],
                    'default'     => 'no',
                    ],
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                        'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                        'param_name'  => 'rating-background-color',
                        'value'       => '',
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'hide_star_rating',
                                'value'    => 'no',
                                'operator' => '==',
                            ],
                        ],                            
                    ], 
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Rating Border Stars Color', 'avada_addons' ),
                        'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                        'param_name'  => 'rating-border-color',
                        'value'       => '',
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'hide_star_rating',
                                'value'    => 'no',
                                'operator' => '==',
                            ],
                        ],                            
                    ], 
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Rating Full Stars Color', 'avada_addons' ),
                        'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                        'param_name'  => 'rating-full-color',
                        'value'       => '',
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'hide_star_rating',
                                'value'    => 'no',
                                'operator' => '==',
                            ],
                        ],                            
                    ], 
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Stars Size', 'avada_addons' ),
                        /* translators: URL for the link. */
                        'description' => esc_attr__( 'Controls the stars size. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                        'param_name'  => 'rating-star-size',
                        'value'       => '',
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'hide_star_rating',
                                'value'    => 'no',
                                'operator' => '==',
                            ],
                        ],
                   ],
                [
                    'type'        => 'colorpicker',
                    'heading'     => esc_attr__( 'Rating Text Color', 'avada_addons' ),
                    'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                    'param_name'  => 'rating-text-color',
                    'value'       => '',
                    'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'hide_star_rating',
                            'value'    => 'no',
                            'operator' => '==',
                        ],
                    ],                            
                ],
                   [
                    'type'        => 'dimension',
                    'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the margin size of the rating.', 'avada_addons' ),
                    'param_name'  => 'rating-margin',
                    'value'       => [
                        'rating-margin-top'    => '',
                        'rating-margin-right'  => '',
                        'rating-margin-bottom' => '',
                        'rating-margin-left'   => '',
                    ],
                    'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'hide_star_rating',
                            'value'    => 'no',
                            'operator' => '==',
                        ],
                    ],
                    ], 
                    [
                        'type'        => 'dimension',
                        'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the padding size of the rating.', 'avada_addons' ),
                        'param_name'  => 'rating-padding',
                        'value'       => [
                            'rating-padding-top'    => '',
                            'rating-padding-right'  => '',
                            'rating-padding-bottom' => '',
                            'rating-padding-left'   => '',
                        ],
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'hide_star_rating',
                                'value'    => 'no',
                                'operator' => '==',
                            ],
                        ],
                    ],
// PRICE SECTION ---------------------------------------------------------------------------------------------------------------------------       
                    [
                        'type'        => 'radio_button_set',
                        'heading'     => esc_attr__( 'Show Price', 'avada_addons' ),
                        'description' => esc_attr__( 'Select Yes if you would to show the price.', 'avada_addons' ),
                        'param_name'  =>  'show-price',
                        'default'     => 'yes',
                        'value'       => [
                            'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                            'no'  => esc_attr__( 'No', 'avada_addons' ),
                        ],
                        'group'            => esc_attr__( 'Price', 'avada_addons' ),
                    ],
                    [
                        'type'             => 'font_family',
                        'remove_from_atts' => true,
                        'heading'          => esc_attr__( 'Font Family', 'fusion-builder' ),
                        /* translators: URL for the link. */
                        'description'      => sprintf( esc_html__( 'Controls the font family of the price text.  Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'fusion-builder' ) ),
                        'param_name'       => 'price',
                        'group'            => esc_attr__( 'Price', 'avada_addons' ),
                        'default'          => [
                            'font-family'  => '',
                            'font-variant' => '400',
                        ],
                    ],
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                        'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                        'param_name'  => 'price-background',
                        'value'       => '',
                        'group'       => esc_attr__( 'Price', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-price',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                    ],
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Font Size', 'avada_addons' ),
                        /* translators: URL for the link. */
                        'description' => esc_attr__( 'Controls the font size of the price. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                        'param_name'  => 'price-font-size',
                        'value'       => '',
                        'group'       => esc_attr__( 'Price', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-price',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                   ],
                   [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Font Color', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the color of the price, ex: #000.', 'avada_addons' ),
                        'param_name'  => 'price-color',
                        'value'       => '',
                        'group'       => esc_attr__( 'Price', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-price',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],                            
                    ],                        
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Line Height', 'avada_addons' ),
                        /* translators: URL for the link. */
                        'description' => esc_attr__( 'Controls the line height of the price. Enter value including any valid CSS unit, ex: 28px.', 'avada_addons' ),
                        'param_name'  => 'price-line-height',
                        'value'       => '',
                        'group'       => esc_attr__( 'Price', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-price',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],                           
                   ],
                   [
                    'type'        => 'dimension',
                    'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the padding size of the price.', 'avada_addons' ),
                    'param_name'  => 'price-padding',
                    'value'       => [
                        'price-padding-top'    => '',
                        'price-padding-right'  => '',
                        'price-padding-bottom' => '',
                        'price-padding-left'   => '',
                    ],
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],
                    ], 
                    [
                    'type'        => 'dimension',
                    'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the margin size of the price.', 'avada_addons' ),
                    'param_name'  => 'price-margin',
                    'value'       => [
                        'price-margin-top'    => '',
                        'price-margin-right'  => '',
                        'price-margin-bottom' => '',
                        'price-margin-left'   => '',
                    ],
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],
                    ], 
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Min Height', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the minimum height of the price. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                        'param_name'  => 'price-min-height',
                        'value'       => '',
                        'group'       => esc_attr__( 'Price', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-price',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                   ],
                [
                    'type'        => 'colorpicker',
                    'heading'     => esc_attr__( 'Full Price Background Color', 'avada_addons' ),
                    'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                    'param_name'  => 'full-price-background',
                    'value'       => '',
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],
                ],
                [
                    'type'        => 'textfield',
                    'heading'     => esc_attr__( 'Full Price Font Size', 'avada_addons' ),
                    /* translators: URL for the link. */
                    'description' => esc_attr__( 'Controls the font size of the price. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                    'param_name'  => 'full-price-font-size',
                    'value'       => '',
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],
               ],
               [
                    'type'        => 'colorpicker',
                    'heading'     => esc_attr__( 'Full Price Font Color', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the color of the price, ex: #000.', 'avada_addons' ),
                    'param_name'  => 'full-price-color',
                    'value'       => '',
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],                            
                ],                        
                [
                    'type'        => 'textfield',
                    'heading'     => esc_attr__( 'Full Price Line Height', 'avada_addons' ),
                    /* translators: URL for the link. */
                    'description' => esc_attr__( 'Controls the line height of the price. Enter value including any valid CSS unit, ex: 28px.', 'avada_addons' ),
                    'param_name'  => 'full-price-line-height',
                    'value'       => '',
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],                           
               ],
               [
                'type'        => 'dimension',
                'heading'     => esc_attr__( 'Full Price Padding', 'avada_addons' ),
                'description' => esc_attr__( 'Controls the padding size of the price.', 'avada_addons' ),
                'param_name'  => 'full-price-padding',
                'value'       => [
                    'full-price-padding-top'    => '',
                    'full-price-padding-right'  => '',
                    'full-price-padding-bottom' => '',
                    'full-price-padding-left'   => '',
                ],
                'group'       => esc_attr__( 'Price', 'avada_addons' ),
                'dependency'  => [
                    [
                        'element'  => 'show-price',
                        'value'    => 'yes',
                        'operator' => '==',
                    ],
                ],
                ], 
// BUTTON SECTION --------------------------------------------------------------------------------------------------------------------------
                       [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Show Cart Button', 'avada_addons' ),
                            'description' => esc_attr__( 'Select if you would to show the button.', 'avada_addons' ),
                            'param_name'  => 'show_cart_button',
                            'value'       => [
                                'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                                'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                            'default'     => 'yes',
                        ],
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Show Details Button', 'avada_addons' ),
                            'description' => esc_attr__( 'Select if you would to show the button.', 'avada_addons' ),
                            'param_name'  => 'show_details_button',
                            'value'       => [
                                'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                                'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                            'default'     => 'no',
                        ],
                        [
                            'type'             => 'font_family',
                            'remove_from_atts' => true,
                            'heading'          => esc_attr__( 'Font Family', 'fusion-builder' ),
                            /* translators: URL for the link. */
                            'description'      => sprintf( esc_html__( 'Controls the font family of the button text.  Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'fusion-builder' ) ),
                            'param_name'       => 'button',
                            'group'            => esc_attr__( 'Button', 'avada_addons' ),
                            'default'          => [
                                'font-family'  => '',
                                'font-variant' => '400',
                            ],
                        ], 
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'button-color-bg',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                       [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Font Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the font color of the content, ex: #000.', 'avada_addons' ),
                            'param_name'  => 'button-font-color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Hover Background Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'button-color-bg-hover',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                       [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Hover Font Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the font color of the content, ex: #000.', 'avada_addons' ),
                            'param_name'  => 'button-font-color-hover',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Font Size', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the font size of the Button. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                            'param_name'  => 'font-size-button',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
					   ],      
                       [
                            'type'        => 'dimension',
                            'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the padding size of the button.', 'avada_addons' ),
                            'param_name'  => 'button-padding',
                            'value'       => [
                                'button-padding-top'    => '',
                                'button-padding-right'  => '',
                                'button-padding-bottom' => '',
                                'button-padding-left'   => '',
                            ],
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
					    ], 
                       [
                            'type'        => 'dimension',
                            'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the margin size of the button.', 'avada_addons' ),
                            'param_name'  => 'button-margin',
                            'value'       => [
                                'button-margin-top'    => '',
                                'button-margin-right'  => '',
                                'button-margin-bottom' => '',
                                'button-margin-left'   => '',
                            ],
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
					    ], 
                        [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Border Radius', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the border radius of the button.', 'avada_addons' ),
						'param_name'  => 'button-border-radius',
						'value'       => [
							'button-border-top-right-radius'    => '',
							'button-border-bottom-right-radius'  => '',
							'button-border-bottom-left-radius' => '',
							'button-border-top-left-radius'   => '',
						],
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],

                    ],
                ]
    )
);
    }
    add_action( 'fusion_builder_before_init', 'adv_products_template_builder' );
}










































































//----------------------------------------------------------------------------->>>START FUSION BUILDER INTEGRATION
if (!function_exists('adv_products_template_builder_archive')){
    function adv_products_template_builder_archive() {

        global $term_archive_product;

    fusion_builder_map( 	
                fusion_builder_frontend_data(
                'FusionProductsTemplateArchive',
                [
                    'name'              => esc_attr__( 'WooCommerce Archive Product AIO', 'avada_addons' ),
                    'shortcode'         => 'adv_products_template_archive',
                    'icon'              => 'fusiona-tag',
                    'component'         => true,
                    'templates'         => [ 'content' ],
                    'params'            => [
// GENERAL SECTION ---------------------------------------------------------------------------------------------------------------------------------
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Layout', 'avada_addons' ),
                            'description' => esc_attr__( 'Select the layout you would to use', 'avada_addons' ),
                            'param_name'  => 'layout',
                            'value'       => [
                                'grid-classic'          => esc_attr__( 'Grid Classic', 'avada_addons' ),
                                'grid-modern'           => esc_attr__( 'Grid Modern', 'avada_addons' ),
                                'special-offer'         => esc_attr__( 'Special Offer', 'avada_addons' ),
                            ],
                            'default'     => 'grid-classic',
                        ], 
                        [
                            'type'        => 'range',
                            'heading'     => esc_attr__( 'Number of Products to display', 'avada_addons' ),
                            'description' => esc_attr__( 'The number of products to display. Defaults to and -1 (display all)  when listing products, and -1 (display all) for categories.', 'avada_addons' ),
                            'param_name'  => 'limit',
                            'value'       => '4',
                            'min'         => '-1',
                            'max'         => '200',
                            'step'        => '1',
                        ],
                        [
                            'type'        => 'range',
                            'heading'     => esc_attr__( 'Columns', 'avada_addons' ),
                            'description' => esc_attr__( 'The number of columns to display. Defaults to 4', 'avada_addons' ),
                            'param_name'  => 'columns',
                            'value'       => '4',
                            'min'         => '1',
                            'max'         => '6',
                            'step'        => '1',
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Space Between Columns', 'avada_addons' ),
                            'description' => esc_attr__( 'Space between each columns. ex 10px.', 'avada_addons' ),
                            'param_name'  => 'padding-bewteen-columns',
                            'value'       => '',
                        ],
                        [
							'type'        => 'radio_button_set',
							'heading'     => esc_attr__( 'Pagination', 'avada_addons' ),
							'description' => esc_attr__( 'Toggles pagination on. Use in conjunction with Number of Products to display', 'avada_addons' ),
							'param_name'  =>  'paginate',
							'default'     => 'false',
							'value'       => [
								'true' => esc_attr__( 'Yes', 'avada_addons' ),
								'false'  => esc_attr__( 'No', 'avada_addons' ),
							],
                        ],
                        [
                            'type'        => 'multiple_select',
                            'heading'     => esc_attr__( 'Order By', 'avada_addons' ),
                            'description' => esc_attr__( 'Sorts the products displayed by the entered option. One or more options can be passed by adding both slugs with a space between them. Defaults is Title', 'avada_addons' ),
                            'param_name'  => 'orderby',
                            'value'       => [
                                'date'          => esc_attr__( 'Date', 'avada_addons' ),
                                'id'            => esc_attr__( 'Id', 'avada_addons' ),
                                'menu_order'    => esc_attr__( 'Menu Order', 'avada_addons' ),
                                'popularity'    => esc_attr__( 'Popularity', 'avada_addons' ),
                                'rand'          => esc_attr__( 'Random', 'avada_addons' ),
                                'rating'        => esc_attr__( 'Rating', 'avada_addons' ),
                                'title'         => esc_attr__( 'Title', 'avada_addons' ),
                            ],
                        ], 
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Order', 'avada_addons' ),
                            'description' => esc_attr__( 'States whether the product order is ascending (ASC) or descending (DESC), using the method set in orderby. Defaults to ASC.', 'avada_addons' ),
                            'param_name'  => 'order',
                            'default'     => 'DESC',
                            'value'       => [
                                'DESC' => esc_attr__( 'Descending', 'avada_addons' ),
                                'ASC'  => esc_attr__( 'Ascending', 'avada_addons' ),
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
                            'description' => esc_attr__( 'Adds an HTML wrapper class so you can modify the specific output with custom CSS.', 'avada_addons' ),
                            'param_name'  => 'class',
                            'value'       => '',
                        ],
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Overflow', 'avada_addons' ),
                            'description' => esc_attr__( 'Select the overflow attribute for the columns', 'avada_addons' ),
                            'param_name'  => 'col-overflow',
                            'default'     => 'visible',
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                            'value'       => [
                                'visible'       => esc_attr__( 'Visible', 'avada_addons' ),
                                'hidden'        => esc_attr__( 'Hidden', 'avada_addons' ),
                                'scroll'        => esc_attr__( 'Scroll', 'avada_addons' ),
                                'auto'          => esc_attr__( 'Auto', 'avada_addons' ),
                                'initial'       => esc_attr__( 'Initial', 'avada_addons' ),
                                'inherit'       => esc_attr__( 'Inherit', 'avada_addons' ),
                                
                            ],
                            'callback'    => [
                                'function' => 'fusion_ajax',
                                'action'   => 'get_fusion_blog',
                                'ajax'     => true,
                            ],
                        ],
                        [
							'type'        => 'radio_button_set',
							'heading'     => esc_attr__( 'On sale', 'avada_addons' ),
							'description' => esc_attr__( 'Retrieve on sale products. Not to be used in conjunction with best sellingor top rated.', 'avada_addons' ),
							'param_name'  =>  'on-sale',
							'default'     => 'false',
							'value'       => [
								'true' => esc_attr__( 'Yes', 'avada_addons' ),
								'false'  => esc_attr__( 'No', 'avada_addons' ),
							],
                        ],
                        [
							'type'        => 'radio_button_set',
							'heading'     => esc_attr__( 'Best Selling', 'avada_addons' ),
							'description' => esc_attr__( 'Retrieve the best selling products. Not to be used in conjunction with on sale or top rated.', 'avada_addons' ),
							'param_name'  =>  'best-selling',
							'default'     => 'false',
							'value'       => [
								'true' => esc_attr__( 'Yes', 'avada_addons' ),
								'false'  => esc_attr__( 'No', 'avada_addons' ),
							],
                        ],
                        [
							'type'        => 'radio_button_set',
							'heading'     => esc_attr__( 'Top Rated', 'avada_addons' ),
							'description' => esc_attr__( 'Retrieve top-rated products. Not to be used in conjunction with on sale or best selling.', 'avada_addons' ),
							'param_name'  =>  'top-rated',
							'default'     => 'false',
							'value'       => [
								'true' => esc_attr__( 'Yes', 'avada_addons' ),
								'false'  => esc_attr__( 'No', 'avada_addons' ),
							],
                        ],
// GLOBAL SETTING SECTION --------------------------------------------------------------------------------------------------------------------------
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'background-color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Text Align', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the alignment of the content.', 'avada_addons' ),
                            'param_name'  => 'content-text-align',
                            'default'     => 'center',
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                            'value'       => [
                                'center'        => esc_attr__( 'Center', 'avada_addons' ),
                                'left'          => esc_attr__( 'Left', 'avada_addons' ),
                                'right'         => esc_attr__( 'Right', 'avada_addons' ),                                
                            ],
                            'callback'    => [
                                'function' => 'fusion_ajax',
                                'action'   => 'get_fusion_blog',
                                'ajax'     => true,
                            ],
                        ],
                        [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the padding size of the columns element.', 'avada_addons' ),
						'param_name'  => 'padding_columns',
						'value'       => [
							'padding_top'    => '',
							'padding_right'  => '',
							'padding_bottom' => '',
							'padding_left'   => '',
						],
						'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
					    ],
                        [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the margin size of the columns element.', 'avada_addons' ),
						'param_name'  => 'margin_columns',
						'value'       => [
							'col-margin-top'    => '',
							'col-margin-right'  => '',
							'col-margin-bottom' => '',
							'col-margin-left'   => '',
						],
						'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'dimension',
                            'heading'     => esc_attr__( 'Border Size', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the border size of the columns element.', 'avada_addons' ),
                            'param_name'  => 'col-border',
                            'value'       => [
                                'col-border-top'    => '',
                                'col-border-right'  => '',
                                'col-border-left'   => '',
                                'col-border-bottom' => '',
                            ],
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                        ],                        
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Border Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'col-border-color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                        ],
                        [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Border Radius', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the margin size of the columns element.', 'avada_addons' ),
						'param_name'  => 'col-border-radius',
						'value'       => [
							'col-border-top-right-radius'    => '',
							'col-border-bottom-right-radius'  => '',
							'col-border-bottom-left-radius' => '',
							'col-border-top-left-radius'   => '',
						],
						'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
					    ],
                        [
                            'type'        => 'select',
                            'heading'     => esc_attr__( 'Overflow', 'avada_addons' ),
                            'description' => esc_attr__( 'Select the overflow attribute for the columns', 'avada_addons' ),
                            'param_name'  => 'col-overflow',
                            'default'     => 'visible',
                            'group'       => esc_attr__( 'Global Design', 'avada_addons' ),
                            'value'       => [
                                'visible'       => esc_attr__( 'Visible', 'avada_addons' ),
                                'hidden'        => esc_attr__( 'Hidden', 'avada_addons' ),
                                'scroll'        => esc_attr__( 'Scroll', 'avada_addons' ),
                                'auto'          => esc_attr__( 'Auto', 'avada_addons' ),
                                'initial'       => esc_attr__( 'Initial', 'avada_addons' ),
                                'inherit'       => esc_attr__( 'Inherit', 'avada_addons' ),
                                
                            ],
                            'callback'    => [
                                'function' => 'fusion_ajax',
                                'action'   => 'get_fusion_blog',
                                'ajax'     => true,
                            ],
                        ],
// TITLE SECTION ------------------------------------------------------------------------------------------------------------------------------------
                        [
							'type'        => 'radio_button_set',
							'heading'     => esc_attr__( 'Show Title', 'avada_addons' ),
							'description' => esc_attr__( 'Select Yes if you would to show the title.', 'avada_addons' ),
							'param_name'  =>  'show-title',
							'default'     => 'yes',
							'value'       => [
								'yes' => esc_attr__( 'Yes', 'avada_addons' ),
								'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'group'            => esc_attr__( 'Title', 'avada_addons' ),
						],
                        [
                            'type'             => 'font_family',
                            'remove_from_atts' => true,
                            'heading'          => esc_attr__( 'Font Family', 'fusion-builder' ),
                            'description'      => sprintf( esc_html__( 'Controls the font family of the title text.  Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'fusion-builder' ) ),
                            'param_name'       => 'title',
                            'group'            => esc_attr__( 'Title', 'avada_addons' ),
                            'default'          => [
                                'font-family'  => '',
                                'font-variant' => '400',
                            ],
                        ],
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'title-background',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Font Size', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the font size of the title. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                            'param_name'  => 'title-font-size',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],
                       ],
                       [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Line Height', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the line height of the title. Enter value including any valid CSS unit, ex: 28px.', 'avada_addons' ),
                            'param_name'  => 'title-line-height',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],                           
                        ],
                       [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Font Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the color of the title, ex: #000.', 'avada_addons' ),
                            'param_name'  => 'title-color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],                            
                        ],
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Hover Font Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the color of the title on hover, ex: #000.', 'avada_addons' ),
                            'param_name'  => 'title-color-hover',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],                            
                        ],                         
                       [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the padding size of the title.', 'avada_addons' ),
						'param_name'  => 'title-padding',
						'value'       => [
							'title-padding-top'    => '',
							'title-padding-right'  => '',
							'title-padding-bottom' => '',
							'title-padding-left'   => '',
						],
                        'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-title',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
					    ], 
                        [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the margin size of the title.', 'avada_addons' ),
						'param_name'  => 'title-margin',
						'value'       => [
							'title-margin-top'    => '',
							'title-margin-right'  => '',
							'title-margin-bottom' => '',
							'title-margin-left'   => '',
						],
                        'group'       => esc_attr__( 'Title', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-title',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
					    ], 
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Min Height', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the minimum height of the title. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                            'param_name'  => 'title-min-height',
                            'value'       => '',
                            'group'       => esc_attr__( 'Title', 'avada_addons' ),
                            'dependency'  => [
                                [
                                    'element'  => 'show-title',
                                    'value'    => 'yes',
                                    'operator' => '==',
                                ],
                            ],
                       ],
// TERMS SECTION --------------------------------------------------------------------------------------------------------------------------
                       [
                        'type'        => 'radio_button_set',
                        'heading'     => esc_attr__( 'Show Terms', 'avada_addons' ),
                        'description' => esc_attr__( 'Select Yes if you would to show the terms.', 'avada_addons' ),
                        'param_name'  =>  'show-terms',
                        'default'     => 'yes',
                        'value'       => [
                            'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                            'no'  => esc_attr__( 'No', 'avada_addons' ),
                        ],
                        'group'            => esc_attr__( 'Terms', 'avada_addons' ),
                    ],
                    [
                        'type'             => 'font_family',
                        'remove_from_atts' => true,
                        'heading'          => esc_attr__( 'Font Family', 'fusion-builder' ),
                        'description'      => sprintf( esc_html__( 'Controls the font family of the terms text.  Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'fusion-builder' ) ),
                        'param_name'       => 'terms',
                        'group'            => esc_attr__( 'Terms', 'avada_addons' ),
                        'default'          => [
                            'font-family'  => '',
                            'font-variant' => '400',
                        ],
                    ],
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                        'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                        'param_name'  => 'terms-background',
                        'value'       => '',
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                    ],
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Font Size', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the font size of the terms. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                        'param_name'  => 'terms-font-size',
                        'value'       => '',
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                   ],
                   [
                    'type'        => 'textfield',
                    'heading'     => esc_attr__( 'Line Height', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the line height of the terms. Enter value including any valid CSS unit, ex: 28px.', 'avada_addons' ),
                    'param_name'  => 'terms-line-height',
                    'value'       => '',
                    'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-terms',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],                           
               ],
                   [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Font Color', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the color of the terms, ex: #000.', 'avada_addons' ),
                        'param_name'  => 'terms-color',
                        'value'       => '',
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],                            
                    ], 
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Hover Font Color', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the color of the terms on hover, ex: #000.', 'avada_addons' ),
                        'param_name'  => 'terms-color-hover',
                        'value'       => '',
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],                            
                    ],                        
                    [
                    'type'        => 'dimension',
                    'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the margin size of the terms.', 'avada_addons' ),
                    'param_name'  => 'terms-margin',
                    'value'       => [
                        'terms-margin-top'    => '',
                        'terms-margin-right'  => '',
                        'terms-margin-bottom' => '',
                        'terms-margin-left'   => '',
                    ],
                    'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-terms',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],
                    ], 
                    [
                        'type'        => 'dimension',
                        'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the padding size of the terms.', 'avada_addons' ),
                        'param_name'  => 'terms-padding',
                        'value'       => [
                            'terms-padding-top'    => '',
                            'terms-padding-right'  => '',
                            'terms-padding-bottom' => '',
                            'terms-padding-left'   => '',
                        ],
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                        ], 
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Min Height', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the minimum height of the terms. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                        'param_name'  => 'terms-min-height',
                        'value'       => '',
                        'group'       => esc_attr__( 'Terms', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-terms',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                   ],
// RATING SECTION ----------------------------------------------------------------------------------------------------------------------------------------------------
                   [
                        'type'        => 'radio_button_set',
                        'heading'     => esc_attr__( 'Hide Star Rating', 'avada_addons' ),
                        'description' => esc_attr__( 'Select if you would to show review stars.', 'avada_addons' ),
                        'param_name'  => 'hide_star_rating',
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'value'       => [
                            'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                            'no'  => esc_attr__( 'No', 'avada_addons' ),
                        ],
                    'default'     => 'no',
                    ],
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                        'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                        'param_name'  => 'rating-background-color',
                        'value'       => '',
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'hide_star_rating',
                                'value'    => 'no',
                                'operator' => '==',
                            ],
                        ],                            
                    ], 
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Rating Border Stars Color', 'avada_addons' ),
                        'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                        'param_name'  => 'rating-border-color',
                        'value'       => '',
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'hide_star_rating',
                                'value'    => 'no',
                                'operator' => '==',
                            ],
                        ],                            
                    ], 
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Rating Full Stars Color', 'avada_addons' ),
                        'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                        'param_name'  => 'rating-full-color',
                        'value'       => '',
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'hide_star_rating',
                                'value'    => 'no',
                                'operator' => '==',
                            ],
                        ],                            
                    ], 
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Stars Size', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the stars size. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                        'param_name'  => 'rating-star-size',
                        'value'       => '',
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'hide_star_rating',
                                'value'    => 'no',
                                'operator' => '==',
                            ],
                        ],
                   ],
                [
                    'type'        => 'colorpicker',
                    'heading'     => esc_attr__( 'Rating Text Color', 'avada_addons' ),
                    'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                    'param_name'  => 'rating-text-color',
                    'value'       => '',
                    'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'hide_star_rating',
                            'value'    => 'no',
                            'operator' => '==',
                        ],
                    ],                            
                ],
                   [
                    'type'        => 'dimension',
                    'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the margin size of the rating.', 'avada_addons' ),
                    'param_name'  => 'rating-margin',
                    'value'       => [
                        'rating-margin-top'    => '',
                        'rating-margin-right'  => '',
                        'rating-margin-bottom' => '',
                        'rating-margin-left'   => '',
                    ],
                    'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'hide_star_rating',
                            'value'    => 'no',
                            'operator' => '==',
                        ],
                    ],
                    ], 
                    [
                        'type'        => 'dimension',
                        'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the padding size of the rating.', 'avada_addons' ),
                        'param_name'  => 'rating-padding',
                        'value'       => [
                            'rating-padding-top'    => '',
                            'rating-padding-right'  => '',
                            'rating-padding-bottom' => '',
                            'rating-padding-left'   => '',
                        ],
                        'group'       => esc_attr__( 'Rating', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'hide_star_rating',
                                'value'    => 'no',
                                'operator' => '==',
                            ],
                        ],
                    ],
// PRICE SECTION ---------------------------------------------------------------------------------------------------------------------------       
                    [
                        'type'        => 'radio_button_set',
                        'heading'     => esc_attr__( 'Show Price', 'avada_addons' ),
                        'description' => esc_attr__( 'Select Yes if you would to show the price.', 'avada_addons' ),
                        'param_name'  =>  'show-price',
                        'default'     => 'yes',
                        'value'       => [
                            'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                            'no'  => esc_attr__( 'No', 'avada_addons' ),
                        ],
                        'group'            => esc_attr__( 'Price', 'avada_addons' ),
                    ],
                    [
                        'type'             => 'font_family',
                        'remove_from_atts' => true,
                        'heading'          => esc_attr__( 'Font Family', 'fusion-builder' ),
                        'description'      => sprintf( esc_html__( 'Controls the font family of the price text.  Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'fusion-builder' ) ),
                        'param_name'       => 'price',
                        'group'            => esc_attr__( 'Price', 'avada_addons' ),
                        'default'          => [
                            'font-family'  => '',
                            'font-variant' => '400',
                        ],
                    ],
                    [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                        'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                        'param_name'  => 'price-background',
                        'value'       => '',
                        'group'       => esc_attr__( 'Price', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-price',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                    ],
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Font Size', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the font size of the price. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                        'param_name'  => 'price-font-size',
                        'value'       => '',
                        'group'       => esc_attr__( 'Price', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-price',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                   ],
                   [
                        'type'        => 'colorpicker',
                        'heading'     => esc_attr__( 'Font Color', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the color of the price, ex: #000.', 'avada_addons' ),
                        'param_name'  => 'price-color',
                        'value'       => '',
                        'group'       => esc_attr__( 'Price', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-price',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],                            
                    ],                        
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Line Height', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the line height of the price. Enter value including any valid CSS unit, ex: 28px.', 'avada_addons' ),
                        'param_name'  => 'price-line-height',
                        'value'       => '',
                        'group'       => esc_attr__( 'Price', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-price',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],                           
                   ],
                   [
                    'type'        => 'dimension',
                    'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the padding size of the price.', 'avada_addons' ),
                    'param_name'  => 'price-padding',
                    'value'       => [
                        'price-padding-top'    => '',
                        'price-padding-right'  => '',
                        'price-padding-bottom' => '',
                        'price-padding-left'   => '',
                    ],
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],
                    ], 
                    [
                    'type'        => 'dimension',
                    'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the margin size of the price.', 'avada_addons' ),
                    'param_name'  => 'price-margin',
                    'value'       => [
                        'price-margin-top'    => '',
                        'price-margin-right'  => '',
                        'price-margin-bottom' => '',
                        'price-margin-left'   => '',
                    ],
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],
                    ], 
                    [
                        'type'        => 'textfield',
                        'heading'     => esc_attr__( 'Min Height', 'avada_addons' ),
                        'description' => esc_attr__( 'Controls the minimum height of the price. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                        'param_name'  => 'price-min-height',
                        'value'       => '',
                        'group'       => esc_attr__( 'Price', 'avada_addons' ),
                        'dependency'  => [
                            [
                                'element'  => 'show-price',
                                'value'    => 'yes',
                                'operator' => '==',
                            ],
                        ],
                   ],
                [
                    'type'        => 'colorpicker',
                    'heading'     => esc_attr__( 'Full Price Background Color', 'avada_addons' ),
                    'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                    'param_name'  => 'full-price-background',
                    'value'       => '',
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],
                ],
                [
                    'type'        => 'textfield',
                    'heading'     => esc_attr__( 'Full Price Font Size', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the font size of the price. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                    'param_name'  => 'full-price-font-size',
                    'value'       => '',
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],
               ],
               [
                    'type'        => 'colorpicker',
                    'heading'     => esc_attr__( 'Full Price Font Color', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the color of the price, ex: #000.', 'avada_addons' ),
                    'param_name'  => 'full-price-color',
                    'value'       => '',
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],                            
                ],                        
                [
                    'type'        => 'textfield',
                    'heading'     => esc_attr__( 'Full Price Line Height', 'avada_addons' ),
                    'description' => esc_attr__( 'Controls the line height of the price. Enter value including any valid CSS unit, ex: 28px.', 'avada_addons' ),
                    'param_name'  => 'full-price-line-height',
                    'value'       => '',
                    'group'       => esc_attr__( 'Price', 'avada_addons' ),
                    'dependency'  => [
                        [
                            'element'  => 'show-price',
                            'value'    => 'yes',
                            'operator' => '==',
                        ],
                    ],                           
               ],
               [
                'type'        => 'dimension',
                'heading'     => esc_attr__( 'Full Price Padding', 'avada_addons' ),
                'description' => esc_attr__( 'Controls the padding size of the price.', 'avada_addons' ),
                'param_name'  => 'full-price-padding',
                'value'       => [
                    'full-price-padding-top'    => '',
                    'full-price-padding-right'  => '',
                    'full-price-padding-bottom' => '',
                    'full-price-padding-left'   => '',
                ],
                'group'       => esc_attr__( 'Price', 'avada_addons' ),
                'dependency'  => [
                    [
                        'element'  => 'show-price',
                        'value'    => 'yes',
                        'operator' => '==',
                    ],
                ],
                ], 
// BUTTON SECTION --------------------------------------------------------------------------------------------------------------------------
                       [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Show Cart Button', 'avada_addons' ),
                            'description' => esc_attr__( 'Select if you would to show the button.', 'avada_addons' ),
                            'param_name'  => 'show_cart_button',
                            'value'       => [
                                'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                                'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                            'default'     => 'yes',
                        ],
                        [
                            'type'        => 'radio_button_set',
                            'heading'     => esc_attr__( 'Show Details Button', 'avada_addons' ),
                            'description' => esc_attr__( 'Select if you would to show the button.', 'avada_addons' ),
                            'param_name'  => 'show_details_button',
                            'value'       => [
                                'yes' => esc_attr__( 'Yes', 'avada_addons' ),
                                'no'  => esc_attr__( 'No', 'avada_addons' ),
                            ],
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                            'default'     => 'no',
                        ],
                        [
                            'type'             => 'font_family',
                            'remove_from_atts' => true,
                            'heading'          => esc_attr__( 'Font Family', 'fusion-builder' ),
                            'description'      => sprintf( esc_html__( 'Controls the font family of the button text.  Leave empty if the global font family for the corresponding heading size (h1-h6) should be used.', 'fusion-builder' ) ),
                            'param_name'       => 'button',
                            'group'            => esc_attr__( 'Button', 'avada_addons' ),
                            'default'          => [
                                'font-family'  => '',
                                'font-variant' => '400',
                            ],
                        ], 
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Background Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'button-color-bg',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                       [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Font Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the font color of the content, ex: #000.', 'avada_addons' ),
                            'param_name'  => 'button-font-color',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Hover Background Color', 'avada_addons' ),
                            'description' => esc_attr__( 'This field allows you to select the color with a hex value.', 'avada_addons' ),
                            'param_name'  => 'button-color-bg-hover',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                       [
                            'type'        => 'colorpicker',
                            'heading'     => esc_attr__( 'Hover Font Color', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the font color of the content, ex: #000.', 'avada_addons' ),
                            'param_name'  => 'button-font-color-hover',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],
                        [
                            'type'        => 'textfield',
                            'heading'     => esc_attr__( 'Font Size', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the font size of the Button. Enter value including any valid CSS unit, ex: 20px.', 'avada_addons' ),
                            'param_name'  => 'font-size-button',
                            'value'       => '',
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
					   ],      
                       [
                            'type'        => 'dimension',
                            'heading'     => esc_attr__( 'Padding', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the padding size of the button.', 'avada_addons' ),
                            'param_name'  => 'button-padding',
                            'value'       => [
                                'button-padding-top'    => '',
                                'button-padding-right'  => '',
                                'button-padding-bottom' => '',
                                'button-padding-left'   => '',
                            ],
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
					    ], 
                       [
                            'type'        => 'dimension',
                            'heading'     => esc_attr__( 'Margin', 'avada_addons' ),
                            'description' => esc_attr__( 'Controls the margin size of the button.', 'avada_addons' ),
                            'param_name'  => 'button-margin',
                            'value'       => [
                                'button-margin-top'    => '',
                                'button-margin-right'  => '',
                                'button-margin-bottom' => '',
                                'button-margin-left'   => '',
                            ],
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
					    ], 
                        [
						'type'        => 'dimension',
						'heading'     => esc_attr__( 'Border Radius', 'avada_addons' ),
						'description' => esc_attr__( 'Controls the border radius of the button.', 'avada_addons' ),
						'param_name'  => 'button-border-radius',
						'value'       => [
							'button-border-top-right-radius'    => '',
							'button-border-bottom-right-radius'  => '',
							'button-border-bottom-left-radius' => '',
							'button-border-top-left-radius'   => '',
						],
                            'group'       => esc_attr__( 'Button', 'avada_addons' ),
                        ],

                    ],
                ]
    )
);
    }
    add_action( 'fusion_builder_before_init', 'adv_products_template_builder_archive' );
}