<?php

return [

    'by'               => 'Автор',
    'name'             => 'НИК',
    'email'            => 'Email',
    'password'         => 'Пароль',
    'password-confirm' => 'Еще раз пароль для проверки',
    'message'          => 'Сообщение',
    'information'      => 'Информация',
    'phone'            => 'Телефон',
    'btn-submit'       => 'Сохранить',
    'btn-read-more'    => 'Еще...',
    'all'              => 'Все',

    'menu' => [
        'home'    => 'Главная',
        'resume'  => 'Резюме',
        'works'   => 'Портфолио',
        'blog'    => 'Блог',
        'contact' => 'Контакты',
    ],

    'auth' => [
        'login-page-title'     => 'Вход',
        'login-title'          => 'Авторизуйтесь пожалуйста',
        'remember-me'          => 'Запомнить',
        'btn-sign-in'          => 'Войти',
        'forgot-password'      => 'Я забыл свой пароль!',
        'profile'              => 'Профиль',
        'welcome'              => 'Добро пожаловать, :user_name!',
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
        '503'        => 'Упс, на сервере ошибка.',
        'formErrors' => [
            'heading'      => '<strong>Опана!</strong> Хьюстон, у нас проблема!',
            'fix-mistakes' => 'Пожалуйста, исправьте:',
        ],
    ],

    'backend' => [

    ],

    'frontend' => [
        'contact' => [
            'page-title'       => 'Get in Touch!',
            'breadcrumb-title' => 'Contact',
            'form-heading'     => "Let's get in touch!",
            'form-text'        => "Feel free to use this form and get in touch with me. I'll try to answer as fast as I can.",
            'confirmMailSent'  => "<strong>Contact Form received!</strong><p>Your request has been successfully processed. I'll try to answer you as soon as possible!<br>Thank you ;)</p>",
        ],
        'home'    => [
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
                'title' => 'Обо мне',
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
                'title'             => 'Клиенты',
                'no-customer-found' => 'В настоящий момент ничего показать не можем.',
            ],
        ],
        'resume'  => [
            'page-title'       => 'Моё резюме',
            'breadcrumb-title' => 'Резюме',
            'work-experience'  => [
                'title' => 'Опыт работы',
                1       => [
                    'job-title' => 'Инженер-программист @ <strong>ООО "Тарис"</strong>',
                    'dates'     => '2022 - наст. время',
                    'details'   => '<ul class="list-arrow-color no-margin">
                                        <li>Developed Web Applications on Laravel.</li>
                                        <li>Created and maintained Open Source packages.</li>
                                    </ul>',
                ],
                2       => [
                    'job-title' => 'Previous position 1 @ <strong>Company</strong>',
                    'dates'     => 'Start date - End date',
                    'details'   => '<ul class="list-arrow-color no-margin">
                                        <li>Developed Web Applications based on Laravel backend.</li>
                                        <li>Passed the following certifications :
                                            <ul class="list-arrow-color no-margin">
                                                <li>First certification (AKA Name)</li>
                                                <li>Second certification</li>
                                                <li>Third certification</li>
                                            </ul>
                                        </li>
                                        <li>Deployed projects for customers.</li>
                                        <li>Search & Development based on solutions related to the position.</li>
                                    </ul>',
                ],
                3       => [
                    'job-title' => 'Previous position 2 @ <strong>Company</strong>',
                    'dates'     => 'Start date - End date',
                    'details'   => '<ul class="list-arrow-color no-margin">
                                        <li>Developed the company\'s Website backend.</li>
                                        <li>Developed the company\'s Website frontend.</li>
                                        <li>Developed the company\'s Mobile App.</li>
                                    </ul>',
                ],
                4       => [
                    'job-title' => 'Previous position 3 @ <strong>Company</strong>',
                    'dates'     => 'Start date - End date',
                    'details'   => '<ul class="list-arrow-color no-margin">
                                        <li>Website Backend development.</li>
                                        <li>Website Frontend development.</li>
                                        <li>Website API development.</li>
                                        <li>Software automated testing.</li>
                                    </ul>',
                ],
                5       => [
                    'job-title' => 'Previous position 4 @ <strong>Company</strong>',
                    'dates'     => 'Start date - End date',
                    'details'   => '<ul class="list-arrow-color no-margin">
                                        <li>Developed Websites of the Company.</li>
                                        <li>Created some tools and technics for SEO and SEM.</li>
                                    </ul>',
                ],
            ],
            'education'        => [
                'title' => 'Образование',
                1       => [
                    'title' => 'Master Web & e-Business @ <strong>University</strong>',
                    'dates' => 'Start date - End date',
                ],
                2       => [
                    'title' => 'Bachelor Web & Mobile @ <strong>University</strong>',
                    'dates' => 'Start date - End date',
                ],
                3       => [
                    'title' => 'BTS Sys Admin @ <strong>University</strong>',
                    'dates' => 'Start date - End date',
                ],
            ],
            'skills'           => [
                'title' => 'Навыки',
                1       => [
                    'label' => 'PHP',
                    'level' => 'Эксперт',
                ],
                2       => [
                    'label' => 'Laravel',
                    'level' => 'Эксперт',
                ],
                3       => [
                    'label' => 'Symfony 2',
                    'level' => 'Average',
                ],
                4       => [
                    'label' => 'Mobile (iOS &amp; Android)',
                    'level' => 'Initial',
                ],
                5       => [
                    'label' => 'HTML &amp; CSS (Bootstrap, Tailwind :: Flexboxes & Grids)',
                    'level' => 'Expert',
                ],
                6       => [
                    'label' => 'Versioning (Git) and Agile',
                    'level' => "Used daily",
                ],
                7       => [
                    'label' => 'Frontend Design',
                    'level' => 'Technical',
                ],
            ],
        ],
        'blog'    => [
            'index' => [
                'page-title'       => 'Блог',
                'breadcrumb-title' => 'Блог',
                'no-post-found'    => 'Еще пишу.',
            ],
            'show'  => [
                'page-title'       => 'Блог',
                'breadcrumb-title' => 'Блог',
            ],
            'tag'   => [
                'page-title'       => 'Блог - все статьи с тегом ":tag_name"',
                'breadcrumb-title' => 'Блог',
                'no-post-found'    => 'Статьей с таким тегом не найдено.',
            ],
        ],
        'works'   => [
            'index' => [
                'page-title'       => 'Моё портфолио',
                'breadcrumb-title' => 'Портфолио',
                'no-work-found'    => 'Пока не заполнено.',
            ],
            'show'  => [
                'page-title'       => 'Мои работы',
                'breadcrumb-title' => 'Работы',
                'recent-work'      => 'Последние работы',
            ],
            'tag'   => [
                'page-title'       => 'Мои работы - все работы с тегом ":tag_name"',
                'breadcrumb-title' => 'Работы',
                'no-work-found'    => 'Работ с таким тегом не найдено.',
            ],
        ],
    ],
    'blocks'   => [
        'blog'   => [
            'sidebar'    => [
                'title' => 'Академия кодопроизводства',
                'text'  => "In this blog, I will share my personal views on coding kitchen and share some cool ideas, tools and techniques I learned. It might happen, content won't repeat itself between languages, so please use some translation tools build into modern browsers if you find a thing or two that might interest you.<br />P.S. I will not forget photography too :)",
            ],
            'last-posts' => [
                'title'         => 'Последний статьи',
                'no-post-found' => 'Статьи пока не написаны.',
            ],
            'tags'       => [
                'title' => 'Теги',
            ],
        ],
        'common' => [
            'about'      => [
                'title' => 'Обо мне',
                'text'  => "Меня зовут Эндрю, последние тридцать лет я - инженер-программист, специализирующийся на Веб-разработках: полного цикла (full-stack), бэк-ендов и апи. Сегодня мои основные инструменты, это Nginx, Laravel, MySQL/PostgreSQL, Tailwind, Livewire, Alpinejs, Swagger, Postman, Git, PhpStorm.",
                'link'  => 'По ссылке можно найти больше сведений',
            ],
            'contact'    => [
                'title' => 'Get in touch!',
                'country' => 'Россия',
                'city' => 'Москва',
                'AndrewGotham' => 'AndrewGotham',
                'phone' => '+7 (775) 556-92-44',
                'whatsapp' => 'WhatsApp',
                'telegram' => 'Telegram',
                'github' => 'Github',

            ],
            'copyright'  => 'Copyright &copy; :this_year <strong>Sir. Andrew Gotham</strong>. Права охраняются законом.',
            'last-posts' => [
                'title'         => 'Из опубликованных статей',
                'no-post-found' => 'Статьи еще не написаны.',
            ],
            'social'     => [
                'title' => 'Социальные сети',
            ],
        ],
    ],

];
