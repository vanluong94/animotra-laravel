<?php

return [
    'manga' => [
        'collections' => [
            'category' => [
                'label' => [
                    'singular' => 'Category',
                    'plural'   => 'Categories'
                ],
                'icon' => 'fas fa-archive'
            ],
            'tag' => [
                'label' => [
                    'singular' => 'Tag',
                    'plural'   => 'Tags'
                ],
                'icon' => 'fas fa-tags'
            ],
            'author' => [
                'label' => [
                    'singular' => 'Author',
                    'plural'   => 'Authors'
                ],
                'icon' => 'fas fa-pen-nib'
            ],
            'year' => [
                'label' => [
                    'singular' => 'Release Year',
                    'plural'   => 'Release Years'
                ],
                'icon' => 'fas fa-calendar-day'
            ],
        ]
    ],
    'user' => [
        'collections' => [
            'favorite', 'read_later', 'subscribe'
        ]
    ]
];