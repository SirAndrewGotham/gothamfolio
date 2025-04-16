<?php

return [

    'by'               => 'By',
    'name'             => 'Name',
    'email'            => 'Email',
    'password'         => 'Password',
    'password-confirm' => 'Confirm Password',
    'message'          => 'Message',
    'information'      => 'Information',
    'phone'            => 'Phone',
    'btn-submit'       => 'Submit',
    'btn-read-more'    => 'Read more',
    'all'              => 'All',
    'Andrew Gotham'    => 'Andrew Gotham',
    'hello'            => 'Hello',

    'menu' => [
        'home'    => 'Home',
        'resume'  => 'Resume',
        'works'   => 'Works',
        'blog'    => 'Blog',
        'contact' => 'Contact',
    ],

    'auth' => [
        'login-page-title'     => 'Sign In!',
        'login-title'          => 'Sign in to start your session',
        'remember-me'          => 'Remember me',
        'btn-sign-in'          => 'Sign In',
        'forgot-password'      => 'I forgot my password!',
        'profile'              => 'Profile',
        'welcome'              => 'Welcome, :user_name!',
        'reset-password-title' => 'Reset your Password now',
    ],

    'emails' => [
        'contact'  => [
            'contact-message'    => 'Contact Message',
            'contact-heading'    => 'Hello Master,',
            'contact-info-text'  => 'A Contact form has been filled on the website <a href=":website_url">:website_url</a>!',
            'here-are-the-infos' => 'Here are the informations:',
            'bottom-message'     => 'Sincerely,<br>BB8',
        ],
        'password' => [
            'password-reset'    => 'Password Reset',
            'password-heading'  => 'Hello sir,',
            'password-content1' => "You asked for a password reset, and because I am kind, I'll give you one new!",
            'password-content2' => 'Here is the link to create a new password: :reset_url',
            'bottom-message'    => 'Sincerely,<br>BB8',
        ],
    ],

    'errors' => [
        '404'        => 'Four Oh Four!',
        '503'        => 'Be right back.',
        'formErrors' => [
            'heading'      => '<strong>Whoops!</strong> Houston, we have a problem!',
            'fix-mistakes' => 'Please fix those mistakes:',
        ],
    ],

    'backend' => [

    ],

    'frontend' => [
        'contact' => [
            'page-title'       => 'Get in Touch!',
            'breadcrumb-title' => 'Contact',
            'form-heading'     => "Let's get in touch!",
            "name"             => "Your name",
            'form-text'        => "Feel free to use this form and get in touch with me. I'll try to answer as fast as I can.",
            'confirmMailSent'  => "<strong>Your message sent!</strong><p>Your request has been successfully processed. I will try to answer you as soon as possible.<br>Thank you</p>",
            'feedback-form'    => "Feedback form",
            'feedback-mailer'  => "Feedback from the " . config('app.name') . " Web site",
            'we-ve-got-request' => "We have got a request from you via Feedback form on our site.",
            'your-request'     => "Submitted request",
            'we-will-answer'   => "I will try to answer to your request as fast as reasonably possible.",
            'sincerely'        => 'Sincerely',
        ],
        'home'    => [
            'status'        => 'Status',
            'looking'       => 'Looking for a job',
            'carousel'      => [
                'slides' => '3',
                1 => [
                    'title'   => 'Passionate & Caring',
                    'content' => "I must say, I am in love with my job! Indeed, I always wanted to work on computers and started to learn how to code back in mid-1980es, and moved to Web development when it was born. Since then I always tried to absorb and adapt to the new technologies and new techniques all the time...",
                    'link'    => 'Please check my Resume for more',
                    'background' => 'bg1.png',
                ],
                2 => [
                    'title'   => 'Laravel is the way to go',
                    'content' => "Laravel came to the scene and changed everything!<br>All of a sudden, we don't have to think in terms of 'how to do this' or 'how to do that' anymore. Instead, we just concentrate on WHAT we are actually constructing, and coding just slips in naturally and intuitively. That's how powerful this flexible PHP Framework is.",
                    'link'    => 'Check out my Portfolio to find out more',
                    'background' => 'bg2.jpg',
                ],
                3 => [
                    'title'   => 'Developing & Mentoring',
                    'content' => "Modern programmers do not work alone. There are always fellow programmers involved. Keeping one's knowledge to thyself is harmful to both project and individual. Sharing knowledge and experience is not only natural, but crucial as well.",
                    'link'    => 'You could check my Web development community on the Telegram',
                    'background' => 'bg3.jpg',
                ],
            ],
            'three-reasons' => [
                1 => [
                    'title'   => 'Code is my life',
                    'content' => "I just love it. Coding is all I want to do, and I can do it straight all day long. It's like creating new Worlds and discovering Universes. You can never get tired of it!<br />Envisioning, planning, constructing and developing Web sites,- what can be more interesting or engaging?<br />I am happy doing it.",
                ],
                2 => [
                    'title'   => 'Never stop learning',
                    'content' => "Technologies develop at a steady and very fast pace. Something new comes up every day. Compliance, ISO-9000, Scrum, Agile, Git, Tailwind, Frontend, Backend, API, you name it...<br />It's so interesting and engaging! Studying something new has long become my daily routine.",
                ],
                3 => [
                    'title'   => 'Photography is my second name',
                    'content' => "I've always been shooting. My early childhood pictures often depict me playing around with cameras and - in those days - film. Then, i've been a school photographer at school. Then it went on and on. And I still shoot, now on a pro level.<br />Please have a look at my galleries, it would be great if you will find something for yourself there.",
                ],
            ],
            'about-me'      => [
                'title' => 'About Me',
                'link'  => 'Need to know more? Check out My Resume',
                1       => [
                    'title'   => 'Raise the PHP Flag!',
                    'content' => "<p>Since I'm a child (well, actually I started nerd stuff when I was 14...) I develop applications in PHP.</p>
                                  <p>That being said, I could see the evolution of this language since PHP4. At this time (and because I was a novice), nothing was really structured. You didn't have the Framework echosystem and I have to admit that it was really painful...</p>
                                  <p>Nowadays, with tools like Laravel, Carbon, PHPUnit and others, it's becoming something big and you no longer hear \"No big website runs with PHP. It's a fact. Period. (insert Trollface here)\"</p>",
                ],
                2       => [
                    'title'   => 'Brace yourself. Laravel is coming!',
                    'content' => '<p>Recently (well, for two years now), I discovered the Laravel Framework and I felt in love! Indeed, this Framework based on Symfony and other useful libraries is meant to be "easy" and allows you to develop and deploy projects really quickly!</p>
                                  <p>If you check my <a href=":blog_url">Blog</a>, you\'ll be able to find tips, ideas and other stuff linked to Laravel... Don\'t hesitate to check them and leave me some feedback ;)</p>',
                ],
                3       => [
                    'title'   => 'Code is not everything... Get a life bro!',
                    'content' => "<p>Well, now come the cool part, at least I hope it is. As you can imagine, I'm not a robot and I don't have only nerdy activities in my life!</p>
                                  <p>Indeed, I love hanging out with friends (well, I live in Paris, the best city in the world! Isn't it? :)), play Rugby (because I feel like a Beast there...), I watch a lot of TV shows and other cool stuff!</p>",
                ],
            ],
            'recent-work'   => [
                'title'         => 'Recent Work',
                'no-work-found' => 'There are no current Works in the database.',
            ],
            'customers'     => [
                'title'             => 'Customers',
                'no-customer-found' => 'There are no Customer to display.',
            ],
        ],
        'resume'  => [
            'page-title'       => 'My Resume',
            'breadcrumb-title' => 'Resume',
            'work-experience'  => [
                'title' => 'Work Experience',
                1       => [
                    'job-title' => 'Software Engineer @ <strong>OOO "Taris"</strong>',
                    'dates'     => '2022 - April 1, 2025',
                    'details'   => '<ul class="list-arrow-color no-margin">
                                        <li>Development, architecture design, practical construction of the back-ends for the commercial services in Laravel</li>
                                        <li>Development, design, construction of front-ends with Angular (at the initial stage of work)</li>
                                        <li>Development, design, construction of the databases for the company\'s Web projects (PostgreSQL, MySQL, SQLite).</li>
                                        <li>Projects\' technical documentation for developers: API with Swagger.</li>
                                        <li>Automated testing (Pest, Unit), API testing via Postman, Insomnia.</li>
                                        <li>Access and authorization systems development for the API, including automated data collection systems (robots/drones).</li>
                                    </ul>
                                    <br />
                                    <ul class="list-arrow-color no-margin">
                                        <li>Organization, configuration, administration of the remote (cloud) servers</li>
                                        <li>DevOps (Ubuntu - Nginx - Postgres)</li>
                                        <li>Github: development of the policies and rules for the team, code review, approval of commits, etc.</li>
                                        <li>Development of the internal corporate rules, procedures, regulations for the Web development</li>
                                        <li>Development planning: setting goals - control - execution of tasks</li>
                                    </ul>',
                ],
                2       => [
                    'job-title' => 'PHP Web Developer @ <strong>Freelance</strong>',
                    'dates'     => '2011 - 2022',
                    'details'   => '<ul class="list-arrow-color no-margin">
                                        <li>Website development "from scratch", from idea to implementation (project structure, architecture, database design, admin area, RESTfull API, frontend based on ready-made templates.</li>
                                        <li>Web sites development over ready-made layout/current sites (clones) - full backend + templating</li>
                                        <li>Bringing other programmers\' code (like third-party CMSs) into working condition, launching, setting up.</li>
                                        <li>Porting Web sites from one framework to another</li>
                                        <li>Bug fixes, corrections of other programmers\' code, finalizing existing functionality and developing new one, upgrading components and frameworks to current versions, working (and upgrading) with Legacy Code</li>
                                        <li>High-quality localization, internationalization of php scripts, from almost any language (for example, Discuz from Chinese)</li>
                                        <li>VPNs: purchase, installation, setup</li>
                                        <li>Uploading projects to production servers, setup</li>
                                        <li>Maintenance of the production sites</li>
                                    </ul>',
                ],
//                3       => [
//                    'job-title' => 'Previous position 2 @ <strong>Company</strong>',
//                    'dates'     => 'Start date - End date',
//                    'details'   => '<ul class="list-arrow-color no-margin">
//                                        <li>Developed the company\'s Website backend.</li>
//                                        <li>Developed the company\'s Website frontend.</li>
//                                        <li>Developed the company\'s Mobile App.</li>
//                                    </ul>',
//                ],
//                4       => [
//                    'job-title' => 'Previous position 3 @ <strong>Company</strong>',
//                    'dates'     => 'Start date - End date',
//                    'details'   => '<ul class="list-arrow-color no-margin">
//                                        <li>Website Backend development.</li>
//                                        <li>Website Frontend development.</li>
//                                        <li>Website API development.</li>
//                                        <li>Software automated testing.</li>
//                                    </ul>',
//                ],
//                5       => [
//                    'job-title' => 'Previous position 4 @ <strong>Company</strong>',
//                    'dates'     => 'Start date - End date',
//                    'details'   => '<ul class="list-arrow-color no-margin">
//                                        <li>Developed Websites of the Company.</li>
//                                        <li>Created some tools and technics for SEO and SEM.</li>
//                                    </ul>',
//                ],
                'notes' => 'Note: Full resume covering the entire period of employment (40 years) is available upon request.',
            ],
            'education'        => [
                'title' => 'Education',
                1       => [
                    'title' => 'Fullstack Web Developer @ <strong>GBOU DPO "Center Professional"</strong>',
                    'dates' => '2022',
                ],
                2       => [
                    'title' => 'Mining engineer, D.Sc. @ <strong>Moscow Mining Institue</strong>',
                    'dates' => '1988 - 1990',
                ],
                3       => [
                    'title' => 'Mining engineer, bachelor, master @ <strong>Moscow Mining Institute</strong>',
                    'dates' => '1980 - 1985',
                ],
            ],
            'skills'           => [
                'title' => 'Technical Skills',
                1       => [
                    'label' => 'PHP',
                    'level' => 'Expert',
                ],
                2       => [
                    'label' => 'Laravel',
                    'level' => 'Expert',
                ],
                3       => [
                    'label' => 'Laravel, Livewire, Folio, Volt, Blade, Blade components',
                    'level' => 'Expert',
                ],
                4       => [
                    'label' => 'HTML &amp; CSS (Bootstrap, Tailwind :: Flexboxes & Grids)',
                    'level' => 'Expert',
                ],
                5       => [
                    'label' => 'Frameworks & CMSs: Laravel,  Yii2, CodeIgniter, PHP-based CMSs (PHPNuke, Discuz, EcShop, WP, и etc.)',
                    'level' => 'Expert',
                ],
                6       => [
                    'label' => 'Databases: MySQL/MariaDB, PostgreSQL, SQLite',
                    'level' => 'Expert',
                ],
                7       => [
                    'label' => 'Versioning (Git) and Agile',
                    'level' => "Professional",
                ],
                8       => [
                    'label' => 'Postman, Insomnia',
                    'level' => "Professional",
                ],
                9       => [
                    'label' => 'Project Team Work: Trello, Slack, Telegram',
                    'level' => "Professional",
                ],
                10       => [
                    'label' => 'Frontend Design',
                    'level' => 'Technical',
                ],
            ],
        ],
        'blog'    => [
            'index' => [
                'page-title'       => 'Blog',
                'breadcrumb-title' => 'Blog',
                'no-post-found'    => 'No Posts yet.',
            ],
            'show'  => [
                'page-title'       => 'Blog',
                'breadcrumb-title' => 'Blog',
            ],
            'tag'   => [
                'page-title'       => 'Blog - All Posts with tag ":tag_name"',
                'breadcrumb-title' => 'Blog',
                'no-post-found'    => 'No Posts found matching this tag.',
            ],
        ],
        'works'   => [
            'index' => [
                'page-title'       => 'My Works',
                'breadcrumb-title' => 'Works',
                'no-work-found'    => 'No Works here yet...',
            ],
            'show'  => [
                'page-title'       => 'My Works',
                'breadcrumb-title' => 'Works',
                'recent-work'      => 'Recent Work',
            ],
            'tag'   => [
                'page-title'       => 'My Works - All works with tag ":tag_name"',
                'breadcrumb-title' => 'Works',
                'no-work-found'    => 'No Works here yet...',
            ],
        ],
    ],
    'blocks'   => [
        'blog'   => [
            'sidebar'    => [
                'title' => 'Coding Alchemy',
                'text'  => "In this blog, I will share my personal views on coding kitchen and share some cool ideas, tools and techniques I learned. It might happen, content won't repeat itself between languages, so please use some translation tools build into modern browsers if you find a thing or two that might interest you.<br />P.S. I will not forget photography too :)",
            ],
            'last-posts' => [
                'title'         => 'Latest Posts',
                'no-post-found' => 'No Posts yet.',
            ],
            'tags'       => [
                'title' => 'Tags',
            ],
        ],
        'common' => [
            'about'      => [
                'title' => 'About Me',
                'text'  => "My name is Andrew, I am a software engineer for the last 3 decades specializing in Web Development: full-stack, backend and api. My main tools today are Nginx, Laravel, MySQL/PostgreSQL, Tailwind, Livewire, Alpinejs, Swagger, Postman, Git, PhpStorm.",
                'link'  => 'Please click here for more info',
            ],
            'contact'    => [
                'title' => 'Get in touch!',
                'permit' => 'Work permit',
                'country' => 'Russia',
                'city' => 'Moscow',
                'AndrewGotham' => 'AndrewGotham',
                'phone' => '+7 (775) 556-92-44',
                'whatsapp' => 'WhatsApp (in writing please)',
                'telegram' => 'Telegram',
                'github' => 'Github',

            ],
            'copyright'  => 'Copyright &copy; :this_year <strong>Sir. Andrew Gotham</strong>. All rights reserved.',
            'last-posts' => [
                'title'         => 'From the Blog',
                'no-post-found' => 'No Posts yet.',
            ],
            'social'     => [
                'title' => 'Social Networks',
            ],
            'no-posts' => 'Blog is waiting for the posts to be presented.',
        ],
    ],

];
