<?php
/**
 * @package Plugin-from-scratch
 */


class WpPluginFromScratchActivate {
    
    public static function activate() {
        flush_rewrite_rules();
    }

}