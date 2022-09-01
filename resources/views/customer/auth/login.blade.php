@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('public/uploads/'.$g_setting->banner_login) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ CUSTOMER_LOGIN }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ CUSTOMER_LOGIN }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="reg-login-form">
                        <div class="inner">
                            <form action="{{ route('customer.login.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">{{ EMAIL_ADDRESS }}</label>
                                    <input type="text" class="form-control" name="customer_email">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ PASSWORD }}</label>
                                    <input type="password" class="form-control" name="customer_password">
                                </div>

                                @if($g_setting->google_recaptcha_status == 'Show')
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ $g_setting->google_recaptcha_site_key }}"></div>
                                </div>
                                @endif

                                <button type="submit" class="btn btn-primary btn-arf">{{ LOGIN }}</button>
                                <a href="{{ route('customer.forget_password') }}" class="btn btn-warning">{{ FORGET_PASSWORD }}</a>
                                <div class="new-user">
                                    <a href="{{ route('customer.registration') }}">{{ NEW_USER_MAKE_REGISTRATION }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
