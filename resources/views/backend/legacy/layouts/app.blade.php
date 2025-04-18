<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('meta-title', 'Page Title') - GothamFolio Backend</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link href="{{ asset('assets/backend/legacy/css/backend.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('styles')
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- Mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>GF</b></span>
            <!-- Logo for regular state and mobile devices -->
            <span class="logo-lg"><b>GothamFolio</b></span>
        </a>
        <!-- /Logo -->

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="//www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?s=25" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="//www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?s=90" class="img-circle" alt="User Image">

                                <p>
                                    {{ auth()->user()->name }}
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('admin.users.show', auth()->id()) }}" class="btn btn-default btn-flat">{{ __('Profile') }}</a>
                                </div>
                                <div class="pull-right">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link class="btn btn-default btn-flat" :href="route('logout')"
                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- /Main Header -->

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="//www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?s=45" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ auth()->user()->name }}</p>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">Administration</li>
                <!-- Optionally, you can add icons to the links -->
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{ route('admin.posts.index') }}"><i class="fa fa-files-o"></i> <span>Posts</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-eye"></i> List Posts</a></li>
                        <li><a href="{{ route('admin.posts.create') }}"><i class="fa fa-plus"></i> Add a Post</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{ route('admin.works.index') }}"><i class="fa fa-files-o"></i> <span>Works</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.works.index') }}"><i class="fa fa-eye"></i> List Works</a></li>
                        <li><a href="{{ route('admin.works.create') }}"><i class="fa fa-plus"></i> Add a Work</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{ route('admin.tags.index') }}"><i class="fa fa-tags"></i> <span>Tags</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.tags.index') }}"><i class="fa fa-eye"></i> List Tags</a></li>
                        <li><a href="{{ route('admin.tags.create') }}"><i class="fa fa-plus"></i> Add a Tag</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{ route('admin.customers.index') }}"><i class="fa fa-files-o"></i> <span>Customers</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.customers.index') }}"><i class="fa fa-eye"></i> List Customers</a></li>
                        <li><a href="{{ route('admin.customers.create') }}"><i class="fa fa-plus"></i> Add a Cusotmer</a></li>

                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.languages.index') }}">
                        <i class='fa fa-language'></i>
                        <span>{{ __('Languages') }}</span>
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="{{ route('admin.feedback.index') }}">--}}
{{--                        <i class='fa fa-comments'></i>--}}
{{--                        <span>{{ __('Feedback') }}</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="treeview">
                    <a href="{{ route('admin.feedback.index') }}">
                        <i class="fa fa-comments"></i> <span>{{ __('Feedback') }}</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.feedback.index') }}"><i class="fa fa-comments-o"></i> {{ __('New Feedback') }}</a></li>
                        <li><a href="{{ route('admin.feedback.read') }}"><i class="fa fa-comments"></i> {{ __('Read Feedback') }}</a></li>

                    </ul>
                </li>
                <li class="treeview">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fa fa-users"></i>
                        <span>{{ __('Users') }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('admin.users.index') }}">
                                <i class="fa fa-eye"></i>
                                {{ __('List Users') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.create') }}">
                                <i class="fa fa-plus"></i> {{ __('Add a User') }}
                            </a>
                        </li>
                    </ul>
                </li>
                {{--                <li>--}}
{{--                    <a href="{{ route('admin.settings.edit') }}"><i class="fa fa-cogs"></i> <span>Settings</span></a>--}}
{{--                </li>--}}
            </ul>
        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@yield('page-title', 'Page Header')</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                <li class="active">@yield('breadcrumb-title', 'Dashboard')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
{{--            Powered by Laravel &amp; AdminLTE--}}
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date('Y') }} <a href="https://t.me/sirandrewgotham">Sir. Andrew Gotham</a>.</strong> All rights reserved.
    </footer>
</div>

<script src="{{ asset('assets/backend/legacy/js/backend.js') }}"></script>
@yield('scripts')
</body>
</html>
