<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class EssentialAdminBlocksLocalize
{
    private $plugin_name;

    public function __construct($name)
    {
        $this->plugin_name = $name;
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts()
    {

        wp_enqueue_script(
            $this->plugin_name . '-blocks-localize',
            ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/eb-blocks-localize.js',
            array(),
            ESSENTIAL_BLOCKS_VERSION,
            true
        );

        wp_localize_script($this->plugin_name . '-blocks-localize', 'EssentialBlocksLocalize', array(
            'eb_plugins_url' => ESSENTIAL_BLOCKS_URL
        ));
    }
}
