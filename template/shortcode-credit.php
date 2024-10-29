<?php

global $aio_avada;

if(!class_exists('aio_credit_class')){

    class aio_credit_class{

        public $aio_avada, $atts, $css, $output_css, $counter;
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
            add_shortcode('aio_credit', array($this, 'aio_credit_shortcode_generator'));
            
        }

        public function aio_credit_shortcode_generator($atts){
            
            /**
             * Generation shortcode atts
             * These are custom condition and change for each of element builder type
             */
            $this->atts = shortcode_atts (
                array(
                    'max_width'                     => '',
                    'align-credit-image'            => '',
                    'align-credit-image_medium'     => '',
                    'align-credit-image_small'      => '',
                ), $atts, 'aio_credit'
            );
            
            return $this->aio_credit_render_html();
    
        }

        public function aio_credit_render_html(){

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

            ob_start();
            /**
             * Html to renderize in frontend
             * This is a custom condition and change for each of element builder type
             */
            $html .= '<div id="aio-credit-image-'.$this->i.'" class="aio-credit-image"><a href="'.$this->aio_avada["aio-credit-link"].'"><img src="'.$this->aio_avada["aio-credit-logo"]["url"].'"></a></div>';

            echo $html;

            $this->aio_credit_css_generator($this->atts, $this->i);

            return ob_get_clean();

        }

        public function aio_credit_css_generator($atts, $counter){

            $this->css = null;
            /**
             * Element Counter Implementation
             * Don't change it.
             */
            $this->i = $counter;

            /**
             * Css Condition and generation
             * These are custom condition and change for each of element builder type
             */
            if($this->atts['max_width']){
                $this->css .= '#aio-credit-image-'.$this->i.' img {max-width: '.$this->atts['max_width'].'}';
            }
            
            /**
             * Responsive Elements - Large Size
             */
            $this->css .= '@media (min-width: '.$this->aio_avada['aio-medium-brackpoint'].'px) {';

                if($this->atts['align-credit-image']){
                    $this->css .= '#aio-credit-image-'.$this->i.' {text-align: '.$this->atts['align-credit-image'].'}';
                }

            $this->css .= '}';
    
            /**
             * Responsive Elements - Medium Size
             */
            $this->css .= '@media (min-width: '.$this->aio_avada['aio-small-brackpoint'].'px) and (max-width: '.$this->aio_avada['aio-medium-brackpoint'].'px) {';

                if($this->atts['align-credit-image_medium']){
                    $this->css .= '#aio-credit-image-'.$this->i.' {text-align: '.$this->atts['align-credit-image_medium'].'}';
                }

            $this->css .= '}';
    
            /**
             * Responsive Elements - Small Size
             */
            $this->css .= '@media (max-width: '.$this->aio_avada['aio-small-brackpoint'].'px) {';

                if($this->atts['align-credit-image_small']){
                    $this->css .= '#aio-credit-image-'.$this->i.' {text-align: '.$this->atts['align-credit-image_small'].'}';
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
$aio_credit_class = new aio_credit_class($aio_avada);

