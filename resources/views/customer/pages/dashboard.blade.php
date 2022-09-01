@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('public/uploads/'.$g_setting->banner_customer_panel) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ CUSTOMER_DASHBOARD }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ CUSTOMER_DASHBOARD }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">

                <div class="col-md-3">				
                    <div class="user-sidebar">
                        @include('layouts.sidebar_customer')
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row dashboard-stat">
                        <div class="col-md-6 dashboard-stat-item">
                            <div class="bg-info p_20 pt_30 pb_30 text-center text-white">
                                <div class="text">{{ COMPLETED_ORDERS }}</div>
                                <div class="total">
                                    @php
                                        $total_completed_orders = DB::table('orders')->where('customer_id', session()->get('customer_id'))->where('payment_status', 'Completed')->count();
                                    @endphp
                                    {{ $total_completed_orders }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 dashboard-stat-item">
                            <div class="bg-info p_20 pt_30 pb_30 text-center text-white">
                                <div class="text">{{ PENDING_ORDERS }}</div>
                                <div class="total">
                                    @php
                                        $total_pending_orders = DB::table('orders')->where('customer_id', session()->get('customer_id'))->where('payment_status', 'Pending')->count();
                                    @endphp
                                    {{ $total_pending_orders }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
