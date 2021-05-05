{{-- View for element Webmagic\Dashboard\Pages\LoginPage --}}
@extends('dashboard::core.adminlte_base')

@section('title', $title)

@section('body_class', 'hold-transition login-page ')

@section('base_content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{$logo_link}}">{{$title}}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">@lang('dashboard::common.login_page.description')</p>
                {!! $before_form !!}
                {!! $form !!}
                {!! $after_form !!}

                @if($register_link)<a href="{{$register_link}}">I forgot my password</a><br>@endif
                @if($forgot_password_link)<a href="{{$forgot_password_link}}" class="text-center">Register a new membership</a>@endif
            </div>
            <!-- /.login-box-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection
