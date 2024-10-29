<?php
global $aio_avada;

class aioSettingsFunction {
    
    function __construct($aio_avada){
        
        $this->unfiltered_upload($aio_avada);
    
    }
    
    public function unfiltered_upload($aio_avada){
        
        if($aio_avada["aio-unfiltered-upload"]==1){
            define( 'ALLOW_UNFILTERED_UPLOADS', true );
        }else{}
    }

}

new aioSettingsFunction($aio_avada);


/* function test(){

    $args = array(
        'name' => 'product',
    );
    $taxonomies = get_taxonomies( $args );

    echo '<pre>';
    var_dump(get_terms($taxonomies));
    echo'</pre>';

    foreach($taxonomies as $taxonomy){
        echo 'test';
        echo $taxonomy["name"];
    }

    //$wc_query = new WP_Query($args);
}
test();
 */

