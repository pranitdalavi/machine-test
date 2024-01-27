@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                <form action="{{ route('store-records-in-excel') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="control-group col-8" style="margin-left:10px">
                            <h2>Click the button to get excel sheet</h2>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="control-group col-8 text-center">
                            <button id="btn-submit" class="btn btn-primary">
                                Generate Excel Sheet
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection