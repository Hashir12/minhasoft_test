@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    @for($i=0; $i < sizeof($records); $i++)
                        <tr>
                            <td>{{$records[$i]['Name']}}</td>
                            <td>
                                <a href="{{url('pdf')}}">Download</a>
                            </td>
                        </tr>
                    @endfor
                </table>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
