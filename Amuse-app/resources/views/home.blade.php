@extends('layouts.app')

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

                    {{ __('You are logged in! 
                        Now you can donwload the Amuse launcher or if you want you can upload cash in to your wallet, or upload your own game! Good luck and have fun!') }}
                </div>
                <button type="button" class="btn btn-success">Donwload Now</button>
            </div>            
        </div> 
    </div>
</div>
@endsection
