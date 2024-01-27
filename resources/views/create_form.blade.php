@extends('layouts.app')
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                <h4 class="display-10" style="margin-left:10px">Create Data</h4><br>
                <form action="{{ route('store-personal-details') }}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{$personalDetails ? $personalDetails['id'] : ''}}">
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="first_name">First Name :</label>
                            <input type="text" id="first_name" class="form-control" name="first_name" value="{{$personalDetails ? $personalDetails['first_name'] : ''}}" placeholder="Enter First Name">
                            @if($errors->has('first_name'))
                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif<br>
                        </div>
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="last_name">Last Name :</label>
                            <input type="text" id="last_name" class="form-control" name="last_name" value="{{$personalDetails ? $personalDetails['last_name'] : ''}}" placeholder="Enter Last Name">
                            @if($errors->has('last_name'))
                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif<br>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="control-group col-8 text-center">
                            <button id="btn-submit" class="btn btn-primary">
                                Save
                            </button>
                            <a href="{{ route('personal-details')}}" style="margin-left:1%" class="btn btn-primary">Back</a>
                            <br><br>
                            @if(session()->has('message'))
                                <div class="alert alert-success" style="width:30%; margin-left:35%">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
                    <table width="80%"  cellpadding="8">
                        <tr>
                            <th>
                                First Name
                            </th>
                            <th>
                                Last Name
                            </th>
                            <th>
                                Execution Time
                            </th>
                            <th>
                                Edit
                            </th>
                            <th>
                                Delete
                            </th>
                        </tr>
                        <br>
                        <br>
                        @foreach($personalDetailList as $personalDetail)
                        <tr>
                            <td>
                                {{$personalDetail->first_name}}
                            </td>
                            <td>
                                {{$personalDetail->last_name}}
                            </td>
                            <td>
                                {{$personalDetail->execution_time}} sec
                            </td>
                            <td>
                                <a href="{{ route('personal-details', ['id' => $personalDetail->id]) }}" class="{{ (Request::is('personal-details')) ? 'active' : '' }}"><i class="fas fa-edit"></i></a>
                            </td>
                            <td>
                            <form action="{{ route('delete-personal-details.deletePersonalDetails', ['id' => $personalDetail->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none;"><i class="fas fa-trash text-danger"></i></button>
                            </form>
                                <!-- <a href="{{ route('delete-personal-details.deletePersonalDetails', ['id' => $personalDetail->id]) }}" class="{{ (Request::is('personal-details')) ? 'active' : '' }}"><i class="fas fa-trash text-danger"></i></a> -->
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @if(session()->has('delete-message'))
                        <div class="alert alert-danger" style="width:30%; margin-left:25%">
                            {{ session()->get('delete-message') }}
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>

@endsection