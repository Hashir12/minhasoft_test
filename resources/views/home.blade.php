@extends('layouts.app')
{{--@dd(\Illuminate\Support\Facades\Auth::check())--}}
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <div class="row mb-4">
                    <div class="col-md-10"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1">
                        <button class="btn btn-primary" id="submit_records" type="button">Submit</button>
                        <a download="consignment.pdf" class="mt-5 pt-5"
                           href="{{\Illuminate\Support\Facades\Storage::url('pdf/'.(isset($_COOKIE['file_name']) ? $_COOKIE['file_name'] : ''))}}"
                           style="display: none"
                           id="download-file">download</a>
                    </div>
                </div>
                <table class="table" id="data-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Address line 1</th>
                        <th>Address line 2</th>
                        <th>Address line 3</th>
                        <th>City</th>
                        <th>Country</th>
                        {{--                        <th>Action</th>--}}
                    </tr>


                    </thead>
                    @foreach($consignments as $consignment)
                        <tr>
                            <td><input name="checker[]" value="{{$consignment->id}}" type="checkbox" class="cons-check">
                            </td>
                            <td>{{$consignment->company_name}}</td>
                            <td>{{$consignment->contact}}</td>
                            <td>{{$consignment->address_line1}}</td>
                            <td>{{$consignment->address_line2}}</td>
                            <td>{{$consignment->address_line3}}</td>
                            <td>{{$consignment->city}}</td>
                            <td>{{$consignment->country}}</td>
                            {{--                            <td><a href="{{url('pdf-convert',$consignment->id)}}">submit</a></td>--}}
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {



            /* LARAVEL META CSRF REQUIREMENT */
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var selected = [];
            $("#submit_records").click(function (event) {
                event.preventDefault();
                var myTableArray = [];
                head_array = [];
                $("#data-table thead tr th").each(function (index, item) {
                    if (index != 0) {
                        head_array.push($(this).text());
                    }
                });

                $("#data-table input[name='checker[]']:checked").map(function () {
                    var tableData = $(this).parents(':eq(1)').find('td');
                    if (tableData.length > 0) {
                        var arrayOfThisRow = Array();
                        tableData.each(function (index, item) {
                            if (index != 0) {
                                arrayOfThisRow.push($(this).text());
                            }
                        });
                        myTableArray.push(arrayOfThisRow);
                    }
                });

                $.ajax({
                    url: "{{ url('pdf-convert') }}",
                    method: "POST",
                    cache: false,
                    data: {
                        head_array: head_array,
                        input_array: myTableArray,
                        user_email: "{{ encrypt(\Illuminate\Support\Facades\Auth::user()->email) }}",
                    },
                    success: function (data) {
                        document.cookie = "file_name=" + data.file_name
                        $("#download-file").removeAttr('style')
                    },
                    error: function (error) {
                        console.log(error.error);
                    }
                })
            })
        });


    </script>
@endsection
