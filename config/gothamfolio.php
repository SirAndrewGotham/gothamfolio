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
        'feedback-to-db' => env('FEEDBACK_TO_DB', 'on'),
        'feedback-to-requester' => env('FEEDBACK_TO_REQUESTER', 'off'),
        'feedback-to-admin' => env('FEEDBACK_TO_ADMIN', 'on'),
    ],

    'backend' => [
        'theme' => env('BACK_THEME', 'legacy'),
    ],
];
