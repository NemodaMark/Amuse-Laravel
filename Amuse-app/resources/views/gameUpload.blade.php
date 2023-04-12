@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload your game') }}</div>
                {{ __('Here you can upload your own game, and put in sale, for the other users') }}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="Title">Title</label>
                            <input type="text" class="form-control" id="Title" aria-describedby="Title" placeholder="Enter Title">
                            <small id="Title" class="form-text text-muted">This is your games title</small>
                        </div>
                    
                        <div class="form-group">
                        <div class="form-outline">
                            <label class="form-label" for="price">Price</label>
                            <input id="price" value="€" type="text" id="price" class="form-control" />
                            <small id="Title" class="form-text text-muted">Our take is 20% (example: 10€ game, you will get 8€)</small>
                        </div>
                        </div>

                       

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Genre</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option value="" class="disable selected">Choose a genre</option>
                                @foreach ($genres as $item)
                                    <option value="{{ $item->id }}">{{ $item->Genre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">About this game:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="input-group">

                                <input type="file" class="form-control" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload</button>
                </form>

                </div>
            </div>            
        </div> 
    </div>
</div>
@endsection
