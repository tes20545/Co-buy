<?php

function block_categories_all($categories, $post)
{
    $eb_category = array(
        'slug' => 'essential-blocks',
        'title' => __('Essential Blocks', 'essential-blocks'),
    );
    $modifiedCategory[0] = $eb_category;
    $modifiedCategory = array_merge($modifiedCategory, $categories);
    return $modifiedCategory;
}
add_filter('block_categories_all', 'block_categories_all', 10, 2);
