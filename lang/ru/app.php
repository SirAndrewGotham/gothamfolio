<?php

return [

    'by'               => 'Автор',
    'name'             => 'Имя',
    'email'            => 'Email',
    'password'         => 'Пароль',
    'password-confirm' => 'Еще раз пароль для проверки',
    'message'          => 'Сообщение',
    'information'      => 'Информация',
    'phone'            => 'Телефон',
    'btn-submit'       => 'Сохранить',
    'btn-read-more'    => 'Еще...',
    'all'              => 'Все',
    'Andrew Gotham'    => 'Эндрю Готэм',
    'hello'            => 'Здравствуйте',

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
            'bottom-message'     => 'Sincerely,<br>Andrew',
        ],
        'password' => [
            'password-reset'    => 'Смена праоля',
            'password-heading'  => 'Здравствуйте,',
            'password-content1' => "Вы оставили запрос на смену пароля.",
            'password-content2' => 'Пожалуйста, перейдите по следующей ссылке: :reset_url',
            'bottom-message'    => 'С уважением,<br>Эндрю',
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
            'page-title'       => 'Форма обратной связи',
            'breadcrumb-title' => 'Контакты',
            'form-heading'     => "Мне можно написать",
            "name"             => "Ваше имя",
            'form-text'        => "Через эту форму можно отправить мне сообщение. Я постараюсь ответить как можно скорее",
            'confirmMailSent'  => "<strong>Ваше сообщение отправлено.</strong><br />Я постараюсь ответить вам как можно скорее.<br />Спасибо!</p>",
            'feedback-form'    => "Форма обратной связи сайта ".config('app.name'),
            'feedback-mailer'  => "Сообщение через форму обратной связи сайта ".config('app.name'),
            'we-ve-got-request' => "Мне поступил запрос через форму обратной связи моего сайта.",
            'your-request'     => "Содержание отправленного запроса",
            'we-will-answer'   => "Я постараюсь ответить на ваш запрос как можно скорее.",
            'sincerely'        => 'С уважением',
        ],
        'home'    => [
            'carousel'      => [
                'slides' => '3',
                1 => [
                    'title'   => 'Любовь и забота',
                    'content' => "Должен сказать, я люблю то, что делаю. Я всегда интересовался компьютерами, и занимался ими, и уже в середине 1980-х начал программировать, перейдя к Веб-разработкам, когда родился Интернет. И с тех пор я постоянно впитываю и применяю на практике новые технологии и способы их использования.",
                    'link'    => 'Подробнее - в моем резюме',
                    'background' => 'bg1.png',
                ],
                2 => [
                    'title'   => 'Laravel - мой выбор',
                    'content' => "Laravel стремительно вошел в мир Веб-разработок, и все изменилось!<br>Внезапно, мы получили возможность думать не о том <strong>КАК</strong> что-то сделать, а сосредоточиться на том, <strong>ЧТО</strong> именно мы хотим получить. А весь код ложится на бумагу естественно и непринужденно. Настолько мощным и гибким получился этот фреймворк.",
                    'link'    => 'Подробнее - в моем протфолио',
                    'background' => 'bg2.jpg',
                ],
                3 => [
                    'title'   => 'Работаем, учимся, и делимся опытом',
                    'content' => "Современные разработки редко осуществляются в одиночку. Обычно, над кодом работают команды программистов. И попытки спрятать от мира накопленный опыт и добытые в процессе работы приемы разработки отрицательно сказываются как на проектах, так и на участвующих в работе людях. Делиться знаниями и опытом не только естественно, но и жизненно необходимо.",
                    'link'    => 'В Телеграме у меня есть отдельная группа (на Эсперанто), посвященная Веб-разработкам',
                    'background' => 'bg3.jpg',
                ],
            ],
            'three-reasons' => [
                1 => [
                    'title'   => 'Код - моя жизнь',
                    'content' => "Я просто обожаю кодить. Писать программный код - это все, что я хочу, и я могу заниматься этим сутки напролет. Этот процесс сродни созданию новых миров и открытию неизведанных планет и целых вселенных. Я никогда не устаю от этого!<br />Воображение, планирование, строительство и разработка Веб-сайтов, что может быть интереснее и увлекательнее?<br />Я счастлив, что занимаюсь любимым делом.",
                ],
                2 => [
                    'title'   => 'Никогда не перестаю учиться',
                    'content' => "Technologies develop at a steady and very fast pace. Something new comes up every day. Compliance, ISO-9000, Scrum, Agile, Git, Tailwind, Frontend, Backend, API, you name it...<br />It's so interesting and engaging! Studying something new has long become my daily routine.",
                ],
                3 => [
                    'title'   => 'Фотография - мое второе имя',
                    'content' => "I've always been shooting. My early childhood pictures often depict me playing around with cameras and - in those days - film. Then, i've been a school photographer at school. Then it went on and on. And I still shoot, now on a pro level.<br />Please have a look at my galleries, it would be great if you will find something for yourself there.",
                ],
            ],
            'about-me'      => [
                'title' => 'Обо мне',
                'link'  => 'Хотите узнать больше? Посмотрите мое резюме',
                1       => [
                    'title'   => 'Выше знамя PHP!',
                    'content' => "<p>С незапамятных времен (ну, практически с того момента, когда родился Интернет) я разрабатываю Веб-сайты на PHP.</p>
                                  <p>Учитывая сказанное, нетрудно понять, что передо мной прошла вся история языка, начиная с версий, предшествовавших PHP3. В те далекие времена со структурой была одна сплошная проблема. Фреймворки отсутсовали напрочь, и все было достаточно замороченно...</p>
                                  <p>Сегодня, имея в своем арсенале такие инструменты, как Laravel, Folio, Livewire, Volt, Carbon, PHPUnit и другие, картина радикально изменилась, и уже не редкость услышать, как кто-то говорит: \"Большие сайты не делают на PHP. Это - факт. И точка. (здесь можете вставить фото любимого тролля)\"</p>",
                ],
                2       => [
                    'title'   => 'Держитесь, Laravel идет!',
                    'content' => '<p>На определенном этапе (на самом деле, это произошло уже больше 10 лет назад), я нашел для себя Laravel, и влюбился! Опираясь на Symfony и другие чрезвычайно эффективные библиотеки, обеспечивает "простоту", и позволяют писать приложения быстро и качественно!</p>
                                  <p>У меня есть сайт <a href="https://laranotes.ru">LaraNotes</a> (в настоящее время, на период поиска работы, там представлена копия настоящего сайта), на котором я публикую "узелки на пямыть", заметки о практической разработке на Laravel. А еще, я планирую больше заметок о программировании публиковать в своем <a href=":blog_url">Блоге</a>, на этом сайте. Приглашаю вас посмотреть и оставить свои комментарии.</p>',
                ],
                3       => [
                    'title'   => 'Код - это еще не все... У тебя есть жизнь, бро!',
                    'content' => "<p>Вот и пришло время для чего-то крутого. По крайней мере, я надеюсь на это. Надеюсь, можно представить себе, что я не бот, и не какой-то там ботан, и кодинг - не все, что меня интересует в жизни!</p>
                                  <p>Я люблю встречаться с друзьями (в последнее время - все больше виртуально :(, еще и потому, что друзья мои живут на разных континентах в Чехии, Бразилии, Иатлии, Франции, США, Голландии, и других странах), играть на электрогитаре, и фотографировать (чем я занимаюсь уже почти 60 лет). Немного моих фото я размещаю в галереях на этом сайте, а мое сообщество фотографов в Телеграме (на языке Эсперанто) можно увидеть по адресу <a href=\"https://t.me/FotoEsperanta\" target='_blank'>https://t.me/FotoEsperanta</a></p>",
                ],
            ],
            'recent-work'   => [
                'title'         => 'Недавние работы',
                'no-work-found' => 'Пока не указаны.',
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
                    'dates'     => '2022 - 1 апреля 2025',
                    'details'   => '<ul class="list-arrow-color no-margin">
                                        <li>Разработка, проектирование архитектуры, практическое построение бэк-эндов коммерческих сервисов на Laravel</li>
                                        <li>Разработка, проектирование, построение фронт-эндов на Angular (на первоначальном этапе работы)</li>
                                        <li>Разработка, проектирование, построение баз данных для Веб-проектов компании (PostgreSQL, MySQL, SQLite).</li>
                                        <li>Разработка и написание технической документации по проектам для разработчиков: API на Swagger.</li>
                                        <li>Автоматизированное тестирование приложений (Pest, Unit), тестирование API через Postman, Insomnia.</li>
                                        <li>Разработка систем доступа и авторизации по API, в т.ч. автоматизированных систем сбора данных (роботов/дронов).</li>
                                    </ul>
                                    <br />
                                    <ul class="list-arrow-color no-margin">
                                        <li>Организация, настройка, администрирование удаленных серверов</li>
                                        <li>DevOps (Ubuntu - Nginx - Postgres)</li>
                                        <li>Github: разработка политик и правил работы команды, код-ревью, утверждение коммитов, и т.д.</li>
                                        <li>Разработка внутренних правил, процедур, регламентов работы Веб-разработки</li>
                                        <li>Планирование разработок: постановка - контроль - выполнение задач</li>
                                    </ul>',
                ],
                2       => [
                    'job-title' => 'Веб-разработчик на PHP @ <strong>Freelance</strong>',
                    'dates'     => '2011 - 2022',
                    'details'   => '<ul class="list-arrow-color no-margin">
                                        <li>Разработка сайтов "с нуля", от идеи до реализации (структура проекта, архитектура, проектирование базы данных, административный раздел, RESTfull API, "морда" с использованием готовых шаблонов).</li>
                                        <li>Разработка системы по готовому макету/действующему сайту - полный бэкэнд+шаблонизация дизайна</li>
                                        <li>Приведение чужого кода (вроде сторонних CMS) в работопригодное состояние, запуск, настройка.</li>
                                        <li>Перенос сайта с одного фрэймворка на другой</li>
                                        <li>Баг-фиксы, исправления чужого кода, доработка функционала и разработка нового, апгрейд компонент и фрэймворка до актуальных версий, работа (и апгрейд) с Legacy Code</li>
                                        <li>Качественная локализация, интернационализация любого скрипта, практически с любого языка (например, Discuz с китайского; русский и английский - родные)</li>
                                        <li>Покупка, установка, настройка VPN</li>
                                        <li>Выгрузка проектов на рабочие серверы, настройка</li>
                                        <li>Сопровождение действующих сайтов</li>
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
                    'notes' => 'Примечание: полное резюме за весь период трудовой деятельности (40 лет) предоставляется по запросу.',
            ],
            'education'        => [
                'title' => 'Образование',
                1       => [
                    'title' => 'Инженер-программист полного цикла (Fullstack Web Developer) @ <strong>ГБОУ ДПО "Центр Профессионал"</strong>',
                    'dates' => '2022',
                ],
                2       => [
                    'title' => 'Горный инженер-физик, ктн (D.Sc.) @ <strong>Московский горный институт</strong>',
                    'dates' => '1988 - 1990',
                ],
                3       => [
                    'title' => 'Горный инженер-физик, бакалавр, магистр @ <strong>Московский горный институт</strong>',
                    'dates' => '1980 - 1985',
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
                    'label' => 'Laravel, Livewire, Folio, Volt, Blade, Blade components',
                    'level' => 'эксперт',
                ],
                4       => [
                    'label' => 'HTML &amp; CSS (Bootstrap, Tailwind :: Flexboxes & Grids)',
                    'level' => 'эксперт',
                ],
                5       => [
                    'label' => 'Фремворки и CMS: Laravel,  Yii2, CodeIgniter, CMS на базе PHP (PHPNuke, Discuz, EcShop, WP и т.д. и т.п.)',
                    'level' => 'эксперт',
                ],
                6       => [
                    'label' => 'Базы данных: MySQL/MariaDB, PostgreSQL, SQLite',
                    'level' => 'эксперт',
                ],
                7       => [
                    'label' => 'Versioning (Git) and Agile',
                    'level' => "профессионал",
                ],
                8       => [
                    'label' => 'Postman, Insomnia',
                    'level' => "профессионал",
                ],
                9       => [
                    'label' => 'Командная работа над проектами: Trello, Slack, Telegram',
                    'level' => "профессионал",
                ],
                10       => [
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
                'text'  => "В этом блоге публикуются статьи по практике работы с кодом и раскрываются секреты постоения Веб-систем на Laravel, а также различных инструментов, используемых программистами в своей работе.<br />Контент представлен на различных языках, и по большей части опубликованные материалы не пересекаются. Если вы заинтересованы в их изучении, рекомендую использовать средства перевода, встроенные в современные браузеры.<br />P.S. И о фотографии я не забуду :)<br />Для удоства, опубликованные материалы классифицируются по тегам.",
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
                'link'  => 'По ссылке - больше информации',
            ],
            'contact'    => [
                'title' => 'На связи!',
                'permit' => 'Work permit',
                'country' => 'Россия',
                'city' => 'Москва',
                'AndrewGotham' => 'AndrewGotham',
                'phone' => '+7 (775) 556-92-44',
                'whatsapp' => 'WhatsApp (для сообщений)',
                'telegram' => 'Telegram',
                'github' => 'Github',

            ],
            'copyright'  => 'Copyright &copy; :this_year <strong>Sir. Andrew Gotham</strong>. Все права на контент ээтого сайта охраняются законом.',
            'last-posts' => [
                'title'         => 'Последние статьи',
                'no-post-found' => 'Статьи еще не написаны.',
            ],
            'social'     => [
                'title' => 'Социальные сети',
            ],
            'no-posts' => 'Статьи пока не готовы к публикации',
        ],
    ],

];
