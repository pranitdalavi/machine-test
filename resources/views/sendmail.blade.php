@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                <h4 class="display-10" style="margin-left:10px">Send E-mail</h4><br>

                <form action="{{ route('email') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="email">E-mail Address :</label>
                            <input type="text" id="email" class="form-control" name="email" placeholder="Enter E-mail Address">
                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif<br>
                        </div>
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="message">Message :</label>
                            <textarea type="text" id="message" class="form-control" name="message" rows="5" placeholder="Enter Message"></textarea>
                            @if($errors->has('message'))
                            <span class="text-danger">{{ $errors->first('message') }}</span>
                            @endif<br>
                        </div>
                    </div>
                    <div class="row mt-2">
                            @if(session()->has('message'))
                                <div class="alert alert-success" style="width:20%; margin-left:24%">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                        <div class="control-group col-8 text-center">
                            <button id="btn-submit" class="btn btn-primary">
                                Send E-mail
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection