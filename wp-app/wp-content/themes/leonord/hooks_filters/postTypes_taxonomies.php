<?php
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Глобальные настройки',
        'menu_title' => 'Глобальные настройки',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

function create_taxonomy()
{
    register_taxonomy('product-category', ['products'], [
        'label' => __('product category'),
        'rewrite' => ['slug' => 'product-category'],
        'labels' => [
            'name' => 'Категория продукта',
            'singular_name' => 'Категории продуктов',
            'search_items' => 'Найти продукт',
            'all_items' => 'Все категории продуктов',
            'view_item ' => 'Просмотреть категорию продукта',
            'parent_item' => 'Родительская категория продукта',
            'parent_item_colon' => 'Родительская категория продукта:',
            'edit_item' => 'Редактировать категорию продукта',
            'update_item' => 'Обновить категорию продукта',
            'add_new_item' => 'Добавить новую категорию продукта',
            'new_item_name' => 'Новое название категории продукта',
            'menu_name' => 'Категории продуктов',
        ],
        'public' => true,
        'hierarchical' => true,
        'capabilities' => [],
        'meta_box_cb' => null,
        'show_admin_column' => false,
        'show_in_rest' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
    ]);

    register_taxonomy('product-material', ['products'], [
        'label' => __('product material'),
        'rewrite' => ['slug' => 'product-material'],
        'labels' => [
            'name' => 'Материал',
            'singular_name' => 'Материалы',
            'search_items' => 'Найти материал',
            'all_items' => 'Все материалы',
            'view_item ' => 'Просмотреть материал',
            'parent_item' => 'Родительский материал',
            'parent_item_colon' => 'Родительский материал:',
            'edit_item' => 'Редактировать материал',
            'update_item' => 'Обновить материал',
            'add_new_item' => 'Добавить новый материал',
            'new_item_name' => 'Новое название материала',
            'menu_name' => 'Материалы',
        ],
        'public' => true,
        'hierarchical' => true,
        'capabilities' => [],
        'meta_box_cb' => null,
        'show_admin_column' => false,
        'show_in_rest' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
    ]);

    register_taxonomy('news-category', ['news'], [
        'label' => __('product category'),
        'rewrite' => ['slug' => 'news'],
        'labels' => [
            'name' => 'Категория',
            'singular_name' => 'Категории',
            'search_items' => 'Найти',
            'all_items' => 'Все категории',
            'view_item ' => 'Просмотреть категорию',
            'parent_item' => 'Родительская категория',
            'parent_item_colon' => 'Родительская категория:',
            'edit_item' => 'Редактировать категорию',
            'update_item' => 'Обновить категорию',
            'add_new_item' => 'Добавить новую категорию',
            'new_item_name' => 'Новое название категории',
            'menu_name' => 'Категории',
        ],
        'public' => true,
        'hierarchical' => true,
        'capabilities' => [],
        'meta_box_cb' => null,
        'show_admin_column' => false,
        'show_in_rest' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
    ]);
}

add_action('init', 'create_taxonomy');

function custom_register_post_types()
{
    $post_types = [
        [
            "post_type_name" => "products",
            "name" => "Продукты",
            "name_plural" => "Продукты",
            "name_lowercase" => "Продукты",
            "name_lowercase_plural" => "Продукты",
            'menu_icon' => 'dashicons-products',
            "supports" => ['title', 'editor'],
            "has_archive" => false,
        ],
        [
            "post_type_name" => "videos",
            "name" => "Видео",
            "name_plural" => "Видео",
            "name_lowercase" => "Видео",
            "name_lowercase_plural" => "Видео",
            'menu_icon' => 'dashicons-format-video',
            "supports" => ['title', 'editor'],
            "has_archive" => false,
        ],
        [
            "post_type_name" => "news",
            "name" => "Новости",
            "name_plural" => "Новости",
            "name_lowercase" => "Новости",
            "name_lowercase_plural" => "Новости",
            'menu_icon' => 'dashicons-welcome-write-blog',
            "supports" => ['title', 'editor'],
            'rewrite' => [
                'slug' => 'blog'
            ],
            "has_archive" => false,
        ],
        [
            "post_type_name" => "review",
            "name" => "Отзывы",
            "name_plural" => "Отзывы",
            "name_lowercase" => "Отзывы",
            "name_lowercase_plural" => "Отзывы",
            'menu_icon' => 'dashicons-admin-comments',
            "supports" => ['title', 'editor'],
            "has_archive" => false,
        ],
    ];

    foreach ($post_types as $post_type) {
        $post_type_args = [
            'labels' => [
                'name' => __($post_type["name_plural"]),
                'singular_name' => __($post_type["name"]),
                'add_new' => __('Добавить ' . $post_type["name"]),
                'add_new_item' => __('Добавить ' . $post_type["name"]),
                'edit_item' => __('Редактировать ' . $post_type["name"]),
                'new_item' => __('Добавить ' . $post_type["name"]),
                'view_item' => __('Посмотреть ' . $post_type["name"]),
                'view_items' => __('Посмотреть ' . $post_type["name_plural"]),
                'search_items' => __('Найти ' . $post_type["name_plural"]),
                'not_found' => __('Нет ' . $post_type["name_lowercase_plural"] . ' found'),
                'not_found_in_trash' => __('Нет ' . $post_type["name_lowercase_plural"] . ' found in Trash'),
                'all_items' => __('Все ' . $post_type["name_plural"]),
                'archives' => __($post_type["name"] . ' Archives'),
                'attributes' => __($post_type["name"] . ' Attributes'),
                'insert_into_item' => __('Insert into ' . $post_type["name_lowercase"]),
                'uploaded_to_this_item' => __('Uploaded to this ' . $post_type["name_lowercase"]),
                'item_published ' => __($post_type["name"] . ' published.'),
                'item_published_privately' => __($post_type["name"] . ' published privately.'),
                'item_reverted_to_draft' => __($post_type["name"] . ' reverted to draft.'),
                'item_scheduled' => __($post_type["name"] . ' scheduled.'),
                'item_updated' => __($post_type["name"] . ' updated.'),
            ],
            'menu_icon' => $post_type['menu_icon'],
            'public' => true,
            'has_archive' => $post_type["has_archive"],
            'menu_position' => 5,
            'show_in_rest' => true,
            'supports' => $post_type["supports"],
            'taxonomies' => $post_type["taxonomies"] ?? [],
            'rewrite' => $post_type['rewrite'] ?? []
        ];
        register_post_type($post_type["post_type_name"], $post_type_args);
    }
}

add_action('init', 'custom_register_post_types');