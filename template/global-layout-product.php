<?php

if (!function_exists('avada_addons_layout_product_1')){
    function avada_addons_layout_product_1($products_to_display, $atts){
                if(!empty($products_to_display)){
                    
        $output_carousel.='[fusion_images picture_size="'.$atts["picture_size"].'" hover_type="'.$atts["hover_type"].'" autoplay="'.$atts["autoplay"].'" columns="'.$atts["columns"].'" column_spacing="'.$atts["column_spacing"].'" scroll_items="'.$atts["scroll_items"].'" show_nav="'.$atts["show_nav"].'" mouse_scroll="'.$atts["mouse_scroll"].'" border="'.$atts["border"].'" lightbox="'.$atts["lightbox"].'" hide_on_mobile="'.$atts["hide_on_mobile"].'" class="'.$atts["class"].'" id="'.$atts["id"].'"]';

        foreach($products_to_display as $products_to_display){
            $single_product = wc_get_product($products_to_display->ID);
            $image = get_the_post_thumbnail($products_to_display->ID);
           
            if ( $single_product ){

                if (function_exists('avada_addons_layout_product_1')){

                            $output_carousel.='<li class="fusion-carousel-item">
                <div class="fusion-classic-product-image-wrapper">
                    <div class="fusion-carousel-item-wrapper" style="visibility: inherit;">';

                    if ($atts["hide_image"]=="no"){
                        $output_carousel.='<div class="fusion-image-wrapper" aria-haspopup="true">';

                        if ($single_product->is_on_sale()){
                            $output_carousel.='<span class="onsale">'.__("In offerta!", "avada_addons").'</span>
                            ';
                        }
                                $output_carousel.= $image;
                                $output_carousel.='<div class="fusion-rollover">
                                    <div class="fusion-rollover-content">

                                        <div class="cart-loading">
                                            <a href="carrello">
                                                <i class="fusion-icon-spinner" aria-hidden="true"></i>
                                                    <div class="view-cart">'.__("Visualizza carrello", "avada_addons").'</div>
                                            </a>
                                        </div>

                                        <div class="fusion-product-buttons">
                                            <a href="?add-to-cart=86" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="86" data-product_sku="" aria-label="Aggiungi '.$products_to_display->post_title.' al tuo carrello" rel="nofollow">'.__("Aggiungi", "avada_addons").'</a>
                                                <span class="fusion-rollover-linebreak"></span>
                                            <a href="'.get_permalink($products_to_display->ID).'" class="show_details_button">'.__("Dettagli", "avada_addons").'</a>
                                        </div>
                                            <a class="fusion-link-wrapper" href="'.get_permalink($products_to_display->ID).'" aria-label="'.$products_to_display->post_title.'"></a>
                                    </div>
                                </div>';

                        $output_carousel.='</div>';
                        }

                        if($atts["hide_title"]=="no"){
                            $output_carousel.='<h4 class="fusion-carousel-title product-title fusion-responsive-typography-calculated" data-fontsize="18" data-lineheight="24.48px" style="--fontSize:18; line-height: 1.36; --minFontSize:18;">
                                <a href="'.get_permalink($products_to_display->ID).'" target="_self">'.$products_to_display->post_title.'</a>
                            </h4>';
                        }	

                        $output_carousel.='<div class="fusion-carousel-meta">';

                        $termini=get_the_terms($products_to_display->ID, 'product_cat');

                        if($atts["hide_category"]=="no"){
                            if($termini){
                                foreach ($termini as $termine){
                                    $link = get_term_link($termine->term_id);
                                    $output_carousel.='<div class="cat-prod-arch"><a href="'.$link.'">'.$termine->name.'</a></div>'; 
                                }
                            }
                        }

                        if($atts["hide_star_rating"]=="no"){
                            do_action( 'wishlist' );

                            $product = wc_get_product( $single_product );
                            $average  = $product->get_average_rating();

                            $output_carousel.= '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'avada_addons' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'avada_addons' ).'</span></div>';

                            if($atts["number_of_rating"]=="no"){
                            //NUMBER OF PEOPLE WHO LEFT REVIEWS
                            $rating_cnt = array_sum($product->get_rating_counts());
                            $output_carousel.= '<span class="adv-number-reviews">(' . $rating_cnt . ')</span>' ;
                            }

                        }

                        if($atts["hide_price"]=="no"){
                            $output_carousel.='<div class="fusion-carousel-price">';

                                $output_carousel.='<span class="price">'.$single_product->get_price_html().'</span>';

                                $output_carousel.='</div>';
                            }							

                        $output_carousel.='</div>
                    </div>
                </div>
            </li>';

                }
        }

        }

        $output_carousel.='[/fusion_images]';
        }		


    return do_shortcode($output_carousel);
            }

    add_shortcode ('product-carousel-template1', 'avada_addons_layout_product_1');
}