<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Card extends Widget_Base {
    public function get_name() {
        return 'name 123';
    }
    public function get_title() {
        return 'title 123';
    }
    public function get_icon() {
        return 'eicon-hypster';
    }

    protected function _register_controls(){}
    protected function render( ) {}
    protected function content_template() {}
}