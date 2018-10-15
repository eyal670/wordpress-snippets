<?php 
namespace Elementor;

function divine_elementor_init(){
    Plugin::instance()->elements_manager->add_category(
        'divine-addon',
        [
            'title'  => 'Divine Addon',
            'icon' => 'eicon-hypster'
        ],
        1
    );
}
add_action('elementor/init','Elementor\divine_elementor_init');