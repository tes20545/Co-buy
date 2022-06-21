<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class EssentialAdmin
{
    private $plugin_name;
    private $default_blocks;

    public function __construct($name, $version)
    {
        $this->plugin_name = $name;
        $this->default_blocks =  self::get_default_blocks();
        $this->migration_options_db();
        add_action('admin_menu', array($this, 'add_menu_page'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_save_eb_admin_options', [$this, 'eb_save_blocks']);
        register_activation_hook(ESSENTIAL_BLOCKS_FILE, array($this, 'activate'));
    }

    public function migration_options_db()
    {
        $opt_db_migration = get_option('eb_opt_migration', false);
        if (version_compare(ESSENTIAL_BLOCKS_VERSION, '1.3.1', '==') && $opt_db_migration === false) {
            update_option('eb_opt_migration', true);
            $all_blocks = get_option('essential_all_blocks', []);
            $blocks = [];
            if (!empty($all_blocks)) {
                foreach ($all_blocks as $block) {
                    $blocks[$block['value']] = $block;
                }
            }
            update_option('essential_all_blocks', $blocks);
        }
    }

    public function add_menu_page()
    {
        add_menu_page(
            __('Essential Blocks', 'essential-blocks'),
            __('Essential Blocks', 'essential-blocks'),
            'delete_user',
            'essential-blocks',
            array($this, 'menu_page_display'),
            ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/images/eb-icon-21x21.svg',
            100
        );
    }

    public function menu_page_display()
    {
        include ESSENTIAL_BLOCKS_DIR_PATH . 'includes/menu-page-display.php';
    }

    public function enqueue_styles()
    {
        wp_enqueue_style(
            $this->plugin_name,
            ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/css/admin.css',
            array(),
            ESSENTIAL_BLOCKS_VERSION,
            'all'
        );
        wp_enqueue_style(
            $this->plugin_name . '-admin',
            ESSENTIAL_BLOCKS_ADMIN_URL . 'admin/style.css',
            array(),
            ESSENTIAL_BLOCKS_VERSION,
            'all'
        );

        /**
         * Only for Admin Add/Edit Pages
         */
        if ($this->eb_is_edit_page()) {

            $dir = dirname(__FILE__);

            $editor_css = '../admin/editor-css/style.css';
            wp_enqueue_style(
                $this->plugin_name . '-editor-css',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'admin/editor-css/style.css',
                array(),
                // ESSENTIAL_BLOCKS_VERSION, // I've commented it cause the change on backend css don't get affected because it caches the file :)
                filemtime("$dir/$editor_css"),
                'all'
            );

            wp_enqueue_style(
                'eb-fontawesome-admin',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/css/font-awesome5.css',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                'all'
            );

            wp_enqueue_style(
                'fontpicker-default-theme',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/css/fonticonpicker.base-theme.react.css',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                'all'
            );

            wp_enqueue_style(
                'fontpicker-material-theme',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/css/fonticonpicker.material-theme.react.css',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                'all'
            );

            wp_enqueue_style(
                'essential-blocks-hover-css',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/css/hover-min.css',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                'all'
            );

            wp_enqueue_style(
                'hover-effects-style',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/css/hover-effects.css',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                'all'
            );

            wp_enqueue_style(
                'twenty-twenty-style-image-comparison',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/css/twentytwenty.css',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                'all'
            );

            wp_enqueue_style(
                'fslightbox-style',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/css/fslightbox.min.css',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                'all'
            );

            wp_enqueue_style(
                'slick-style',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/css/slick.css',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                'all'
            );
        }
    }

    public function enqueue_scripts($hook)
    {
        if ($hook === 'toplevel_page_essential-blocks') {
            wp_enqueue_script(
                $this->plugin_name . '-admin',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/essential-blocks.js',
                array('jquery', $this->plugin_name . '-swal'),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_enqueue_script(
                $this->plugin_name . '-swal',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/sweetalert.min.js',
                array('jquery'),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_enqueue_script(
                $this->plugin_name . '-admin-blocks',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'admin/index.js',
                array('wp-i18n', 'wp-element', 'wp-hooks', 'wp-util', 'wp-components'),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_enqueue_script(
                'essential-blocks-category-icon',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'lib/update-category-icon/index.js',
                array('wp-blocks'),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_localize_script($this->plugin_name . '-admin-blocks', 'EssentialBlocksAdmin', array(
                'all_blocks' => $this->get_blocks(),
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('eb-save-admin-options'),
            ));
        }

        /**
         * Only for Admin Add/Edit Pages
         */
        if ($this->eb_is_edit_page()) {
            wp_enqueue_script(
                'essential-blocks-twenty-move',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/jquery.event.move.js',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_enqueue_script(
                'essential-blocks-image-loaded',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/images-loaded.min.js',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_enqueue_script(
                'essential-blocks-isotope',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/isotope.pkgd.min.js',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_enqueue_script(
                'essential-blocks-twenty-twenty',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/jquery.twentytwenty.js',
                array(),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_enqueue_script(
                'fslightbox-js',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/fslightbox.min.js',
                array('jquery'),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_enqueue_script(
                'essential-blocks-masonry',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/masonry.min.js',
                array('jquery'),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_enqueue_script(
                'essential-blocks-typedjs',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/typed.min.js',
                array('jquery'),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_enqueue_script(
                'essential-blocks-slickjs',
                ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/slick.min.js',
                array('jquery'),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );

            wp_register_script(
                "essential-blocks-controls-util",
                ESSENTIAL_BLOCKS_ADMIN_URL . 'admin/block-controls/index.js',
                array(
                    'wp-i18n',
                    'wp-element',
                    'wp-hooks',
                    'wp-util',
                    'wp-components',
                    'wp-blocks',
                    'wp-editor',
                    'wp-block-editor',
                    $this->plugin_name . '-blocks-localize',
                ),
                ESSENTIAL_BLOCKS_VERSION,
                true
            );
        }

        wp_localize_script('essential-blocks-js', 'EssentialBlocks', array(
            'nonce' => $this->disabling_nonce(),
            'ajax_url' => admin_url('admin-ajax.php'),
            'export_nonce'  => wp_create_nonce('eb-template-export-nonce-action'),
            'enabled_blocks' => $this->enabled_blocks(),
            'current_page_id' => get_the_ID()
        ));
    }

    public function filter_blocks($block)
    {
        return isset($block['visibility']) ? $block['visibility'] : false;
    }

    public function enabled_blocks()
    {
        $blocks = $this->get_blocks();
        $enabled_blocks = array_keys(array_filter($blocks, array($this, 'filter_blocks')));
        return $enabled_blocks;
    }

    public static function get_default_blocks()
    {
        $default_blocks = [
            'accordion' => [
                'label' => __('Accordion', 'essential-blocks'),
                'value' => 'accordion',
                'visibility' => 'true',
            ],
            'button' => [
                'label' => __('Button', 'essential-blocks'),
                'value' => 'button',
                'visibility' => 'true',
            ],
            'call_to_action' => [
                'label' => __('Call To Action', 'essential-blocks'),
                'value' => 'call_to_action',
                'visibility' => 'true',
            ],
            'countdown' => [
                'label' => __('Countdown', 'essential-blocks'),
                'value' => 'countdown',
                'visibility' => 'true',
            ],
            'dual_button' => [
                'label' => __('Dual Button', 'essential-blocks'),
                'value' => 'dual_button',
                'visibility' => 'true',
            ],
            'flipbox' => [
                'label' => __('Flipbox', 'essential-blocks'),
                'value' => 'flipbox',
                'visibility' => 'true',
            ],
            'advanced_heading' => [
                'label' => __('Advanced Heading', 'essential-blocks'),
                'value' => 'advanced_heading',
                'visibility' => 'true',
            ],
            'image_comparison' => [
                'label' => __('Image Comparison', 'essential-blocks'),
                'value' => 'image_comparison',
                'visibility' => 'true',
            ],
            'image_gallery' => [
                'label' => __('Image Gallery', 'essential-blocks'),
                'value' => 'image_gallery',
                'visibility' => 'true',
            ],
            'infobox' => [
                'label' => __('Infobox', 'essential-blocks'),
                'value' => 'infobox',
                'visibility' => 'true',
            ],
            'instagram_feed' => [
                'label' => __('Instagram Feed', 'essential-blocks'),
                'value' => 'instagram_feed',
                'visibility' => 'true',
            ],
            'interactive_promo' => [
                'label' => __('Interactive Promo', 'essential-blocks'),
                'value' => 'interactive_promo',
                'visibility' => 'true',
            ],
            'notice' => [
                'label' => __('Notice', 'essential-blocks'),
                'value' => 'notice',
                'visibility' => 'true',
            ],
            'parallax_slider' => [
                'label' => __('Parallax Slider', 'essential-blocks'),
                'value' => 'parallax_slider',
                'visibility' => 'true',
            ],
            'pricing_table' => [
                'label' => __('Pricing Table', 'essential-blocks'),
                'value' => 'pricing_table',
                'visibility' => 'true',
            ],
            'progress_bar' => [
                'label' => __('Progress Bar', 'essential-blocks'),
                'value' => 'progress_bar',
                'visibility' => 'true',
            ],
            'slider' => [
                'label' => __('Slider', 'essential-blocks'),
                'value' => 'slider',
                'visibility' => 'true',
            ],
            'social' => [
                'label' => __('Social Icons', 'essential-blocks'),
                'value' => 'social',
                'visibility' => 'true',
            ],
            'team_member' => [
                'label' => __('Team Member', 'essential-blocks'),
                'value' => 'team_member',
                'visibility' => 'true',
            ],
            'testimonial' => [
                'label' => __('Testimonial', 'essential-blocks'),
                'value' => 'testimonial',
                'visibility' => 'true',
            ],
            'toggle_content' => [
                'label' => __('Toggle Content', 'essential-blocks'),
                'value' => 'toggle_content',
                'visibility' => 'true',
            ],
            'typing_text' => [
                'label' => __('Typing Text', 'essential-blocks'),
                'value' => 'typing_text',
                'visibility' => 'true',
            ],
            'wrapper' => [
                'label' => __('Wrapper', 'essential-blocks'),
                'value' => 'wrapper',
                'visibility' => 'true',
            ],
            'number_counter' => [
                'label' => __('Number Counter', 'essential-blocks'),
                'value' => 'number_counter',
                'visibility' => 'true',
            ],
            'post_grid' => [
                'label' => __('Post Grid', 'essential-blocks'),
                'value' => 'post_grid',
                'visibility' => 'true',
            ],
            'feature_list' => [
                'label' => __('Feature List', 'essential-blocks'),
                'value' => 'feature_list',
                'visibility' => 'true',
            ],
            'row' => [
                'label' => __('Row', 'essential-blocks'),
                'value' => 'row',
                'visibility' => 'true',
            ],
            'table_of_contents' => [
                'label' => __('Table Of Contents', 'essential-blocks'),
                'value' => 'table_of_contents',
                'visibility' => 'true',
            ],
        ];

        $pro_blocks = apply_filters('essential_pro_blocks', []);
        $merged_blocks = array_merge($default_blocks, $pro_blocks);
        return $merged_blocks;
    }

    public function activate()
    {
        update_option('essential_all_blocks', $this->default_blocks);
    }

    public function eb_save_blocks()
    {
        if (!wp_verify_nonce($_POST['_wpnonce'], 'eb-save-admin-options')) {
            die('Security check');
        } else {
            update_option('essential_all_blocks', $_POST['all_blocks']);
        }
        die();
    }

    public function get_blocks()
    {
        $all_blocks = get_option('essential_all_blocks');
        if (empty($all_blocks)) {
            return $this->default_blocks;
        }

        if (count($this->default_blocks) > count($all_blocks)) {
            return array_merge($this->default_blocks, $all_blocks);
        }

        return $all_blocks;
    }

    public function disabling_nonce()
    {
        return wp_create_nonce('essential_disabling_nonce');
    }

    /**
     * eb_is_edit_page
     * function to check if the current page is a post edit page
     *
     * @author Ohad Raz <admin@bainternet.info>
     *
     * @param  string  $new_edit what page to check for accepts new - new post page ,edit - edit post page, null for either
     * @return boolean
     */
    public function eb_is_edit_page($new_edit = null)
    {
        global $pagenow;
        //make sure we are on the backend
        if (!is_admin()) return false;


        if ($new_edit == "edit")
            return in_array($pagenow, array('post.php',));
        elseif ($new_edit == "new") //check for new post page
            return in_array($pagenow, array('post-new.php'));
        else //check for either new or edit
            return in_array($pagenow, array('post.php', 'post-new.php'));
    }
}
