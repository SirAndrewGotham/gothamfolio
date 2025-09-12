<?php

return [
    'frontend' => [
        'theme' => env('FRONT_THEME', 'legacy'),
        'resume' => env('RESUME', 'on'),
        'works' => env('WORKS', 'on'),
        'customers' => env('CUSTOMERS', 'on'),
        'galleries' => env('GALLERIES', 'on'),
        'blog' => env('BLOG', 'on'),
        'contacts' => env('CONTACTS', 'on'),
        'languages' => env('LANGUAGES', 'on'),
        'socials' => env('SOCIALS', 'on'),
        'footer' => env('FOOTER', 'on'),
        'status' => env('STATUS', 'off'),
        'registration' => env('REGISTRATION', 'off'),
        'feedback-to-db' => env('FEEDBACK_TO_DB', 'on'),
        'feedback-to-requester' => env('FEEDBACK_TO_REQUESTER', 'off'),
        'feedback-to-admin' => env('FEEDBACK_TO_ADMIN', 'on'),
        'galleries_per_page' => env('GALLERIES_PER_PAGE', 9),
    ],

    'backend' => [
        'theme' => env('BACK_THEME', 'legacy'),
    ],

    'multilingual' => [
        /*
         * Set whether or not the multilingual is supported by the BREAD input.
         */
        'enabled' => true,

        /*
         * Select default language
         */
        'default' => env('APP_LOCALE', 'ru'),

        /*
         * Select languages that are supported.
         */
        'locales' => [
            'en',
            'eo',
            'ru',
        ],
    ],
];
