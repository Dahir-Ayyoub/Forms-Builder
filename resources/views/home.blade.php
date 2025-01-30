@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="custom-card">
                <div class="custom-card-header">{{ __('Dashboard') }}</div>

                <div class="custom-card-body">
                    @if (session('status'))
                        <div class="custom-alert custom-alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(auth()->user()->hasRole('admin'))
                        <p>Hi mr admin</p>
                    @endif

                    <p class="dashboard-message"> {{ __('You are logged in!') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .custom-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin: 20px;
        padding: 20px;
    }

    .custom-card-header {
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
         font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0;
    }


    .custom-card-body {
        padding-top: 15px;
    }

     .dashboard-message {
        font-size: 1.1rem;
        margin-top: 15px;
        line-height: 1.6;
        color: #333;
    }

    .custom-alert {
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }
    .custom-alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }


</style>



{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
