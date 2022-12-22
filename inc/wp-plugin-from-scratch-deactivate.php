<?php
/**
 * @package Plugin-from-scratch
 */


class WpPluginFromScratchDeactivate {
    
    public static function deactivate() {
        flush_rewrite_rules();
    }
    
}