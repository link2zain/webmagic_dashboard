@extends('dashboard::core.adminlte_base')

@section('title', $title)

@section('body_class', 'sidebar-mini layout-fixed layout-navbar-fixed ')

@section('base_content')
    <div class="wrapper">
        <!-- Header Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" role="navigation">
            <!-- Sidebar toggle button-->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-sm-inline-block">
                    <a href="/dashboard" class="nav-link">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @section('header_nav')
                    {!! $header_nav !!}
                @show
            </ul>
        </nav>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
{{--        <a href="" class="brand-link">--}}
{{--           --}}{{-- <img src="/logo.png" alt="Logo" class="brand-image img-circle elevation-3">--}}
{{--            <span class="brand-text font-weight-light">AdminLTE</span>--}}
{{--        </a>--}}
        @section('header_logo')
            {!! $header_logo !!}
        @show
        <div class="sidebar js_show-scroll">
            @section('main_sidebar')
                {!! $main_sidebar !!}
            @show
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper p-lg-2">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @section('content_header')
                {!! $content_header !!}
            @show
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <!-- Notification area -->
            @section('notification_area')
                {!! $notification_area !!}
            @show
            <!-- /.notification -->

            @section('content')
                {!! $data !!}
            @show
        </section>
        <!-- /.content -->
        <a id="back-to-top" href="#" class="btn btn-primary back-to-top js_scroll-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer text-sm">
        @section('footer')
            {!! $footer !!}
            <p class="text-right mr-6">Dashboard version - <strong>{{$webmagicDashboardVersion}}</strong></p>
        @show
    </footer>
    </div>
@endsection
