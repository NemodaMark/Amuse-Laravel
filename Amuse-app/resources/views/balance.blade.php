@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{ __('Balance') }}</div>
                {{ __('Here you can upload cash to your account') }}
                {{__('Your balance is now:  :balance€', ['balance' => $userBalance])}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('pay') }}">
                        @csrf
                    <select class="form-select" aria-label="Default select example" name="amount">
                    <option selected disable>Please select the amount of cash</option>
                        <option value="1">1€</option>
                        <option value="5">5€</option>
                        <option value="10">10€</option>
                        <option value="50">50€</option>
                        <option value="100">100€</option>
                    </select>
                    </div>  
                        <button type="submit" class="btn btn-success">Pay</button>
                    </div>
                </form>
                </div>
            </div>            
        </div> 
    </div>
</div>

@if (session('success_message'))
    <script>
        toastr.success("{{ session('success_message') }}", "Wallet")
    </script>
@endif

@endsection



