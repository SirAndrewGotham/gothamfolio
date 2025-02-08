<?php

return [
    'frontend' => [
        'theme' => env('FRONT_THEME', 'legacy'),
        'resume' => env('RESUME', 'on'),
        'works' => env('WORKS', 'on'),
        'galleries' => env('GALLERIES', 'on'),
        'blog' => env('BLOG', 'on'),
        'contacts' => env('CONTACTS', 'on'),
        'languages' => env('LANGUAGES', 'on'),
        'socials' => env('SOCIALS', 'on'),
        'footer' => env('FOOTER', 'on'),
    ],

    'backend' => [
        'theme' => env('BACK_THEME', 'legacy'),
    ],
];
