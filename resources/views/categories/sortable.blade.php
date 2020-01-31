@extends('layouts.header')
@extends('layouts.sidebar')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    #page_list li
    {
        padding:16px;
        background-color:#f9f9f9;
        border:1px dotted #ccc;
        cursor:move;
        margin-top:12px;
    }
    #page_list li.ui-state-highlight
    {
        padding:24px;
        background-color:#ffffcc;
        border:1px dotted #ccc;
        cursor:move;
        margin-top:12px;
    }
</style>

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
    <div class="kt-portlet__body">
    <div class="search">
        <p>&nbsp;</p>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <ul class="" id="page_list">
                @foreach($category as $category)
                <li class="row1" data-id="{{ $category->id }}">
                    <div class="li-post-group">
                        <h5 class="li-post-title">{{ $category->name }}</h5>
                    </div>
                    <div class="pull-right" style="margin-top: -30px;">
                        <form action="{{ route('category.destroy',$category->id) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('category.show', $category->id) }}">View</a>

                            <a class="btn btn-primary" href="{{ route('category.edit', $category->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit"  onclick="return confirm('Do you want to deleted product?')" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </li>
                @endforeach
                </ul>

            </div>
        </div>
        <hr>
    </div>
        </div>
</div>

    {{--<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>--}}
    <script type="text/javascript">
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(function () {
            $( "#page_list" ).sortable({
                items: "li",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });
            function sendOrderToServer() {
                var order = [];
                $('li.row1').each(function(index,element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index+1
                    });
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{route('update.order')}}",
                    data: {
                         order:order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                      if (response.status == "success") {
                            alert(response);
                        } else {
                            alert(response);
                        }
                    }
                });

            }
        });
    </script>

