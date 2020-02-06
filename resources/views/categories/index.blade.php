@extends('layouts.master')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

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
@section('main-content')
    <div class="kt-portlet__body">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Categories </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

                </div>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->
    {{--<div class="kt-portlet__body">--}}
        {{--<div class="tab-content  kt-margin-t-20">--}}
            <!--Begin:: Tab Content-->
        <div class="alert alert-success" role="alert" id="deleteAlert" style="display: none;">
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    <div class="alert-text"><strong>
                            {!! session()->get('success') !!} !!
                        </strong></div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                </div>
            @endif
            {{--<div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-xl-6">--}}
                        <!--begin::Portlet-->
                        <div class="kt-portlet">
                            {{--<div class="kt-portlet__body">--}}
                                {{--<div class="row">--}}
                                <form class="kt-form kt-form--label-right" action="{{ route('category.store') }}" method="post">
                                    @csrf
                                    <div class="kt-form__body">
                                        <div class="kt-section kt-section--first">
                                            {{--<div class="kt-section__body">--}}
                                                <div class="form-group col-md-6">
                                                    {{--<label class="col-xl-3 col-lg-3 col-form-label">Category</label>--}}
                                                    <div class="">
                                                        <input class="form-control" type="text" name="name" placeholder="Enter Category Name" required data-parsley-pattern="/^[a-zA-Z]*$/" data-parsley-required-message="Category is required" data-parsley-trigger="keyup">
                                                    </div><br>
                                                    {{--<div class="col-lg-6 col-xl-6">--}}
                                                    {{--<select class="form-control" name="status" required>--}}
                                                        {{--<option value="1">Active</option>--}}
                                                        {{--<option value="0">Inactive</option>--}}
                                                    {{--</select>--}}
                                                        {{--</div>--}}
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <input type="submit" class="btn btn-brand btn-bold pull-right" value="Save" style="margin-left: 20px;">
                                                    {{--<a href="{{ route('category.index') }}" type="button" class="btn btn-brand btn-bold pull-right">Back</a>--}}
                                                </div>
                                            {{--</div>--}}
                                        </div>

                                    </div>

                                </form>
                                <div class="search">
                                    <p>&nbsp;</p>
                                    {{--<div class="row">--}}
                                        {{--<div class="col-lg-12">--}}
                                            <ul class="" id="page_list">
                                                @foreach($category as $category)
                                                    <li class="row1" data-id="{{ $category->id }}">
                                                        <div class="li-post-group">
                                                            <h5 class="li-post-title">{{ $category->name }}</h5>
                                                        </div>
                                                        <!--div class="li-post-group pull-right" style="margin-top: -30px;margin-left: 10px;">
                                                            <?php $checked = ($category->status == 1) ? 'Active' : 'Inactive'; ?>
                                                            <p><strong>{{ $checked }}</strong></p>
                                                        </div-->
                                                        <div class="pull-right" style="margin-top: -30px;">

                                                            <form action="{{ route('category.destroy',$category->id) }}" method="POST">

                                                                <a class="btn btn-info" href="{{ route('category.show', $category->id) }}">View</a>

                                                                <a class="btn btn-primary" href="{{ route('category.edit', $category->id) }}"><i class="fa fa-edit"></i>Edit</a>

                                                                @csrf
                                                                @method('DELETE')

                                                                {{--<button type="button" onclick="return confirm('Do you want to deleted product?')" class="btn btn-danger deletedBtn">Delete</button>--}}
                                                                <button type="button" onclick="return confirm('Do you want to deleted product?')" class="btn btn-danger deletedBtn" data-id="{{ $category->id }}">Delete</button>
                                                            </form>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <hr>
                                </div>

                                {{--</div>--}}
                            {{--</div>--}}



                            <!--end::Form-->
                        {{--</div>--}}

                        <!--end::Portlet-->

                    {{--</div>--}}
                </div>

            {{--</div>--}}
            <!--end:: Tab Content-->
        {{--</div>--}}
    {{--</div>--}}
</div>
@endsection

@section('scripts')
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
//            console.log(order);
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
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
$(document).ready(function(){
    $(".deletedBtn").click(function(){
        var deleteId =  $(this).attr("data-id");
                    var order = [];
                    $('li.row1').each(function() {
                        order.push($(this).attr('data-id'));
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{route('update.sort')}}",
                        data: {deleteId:deleteId, order:order, _token: '{{ csrf_token() }}'},
                        success: function(data) {
                            if(data.success == true){
//                                alert(data.message);
                                $("#deleteAlert").show();
                                $("#deleteAlert").text(data.message);
                                $("#deleteAlert").delay(2000).fadeOut("slow");
//                                window.location.reload();
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);
                            }else{
                                alert('Failed to deleted');
                            }
                        }
                    });
});
});
</script>
@endsection
{{--<script>--}}
    {{--setTimeout(function() {--}}
        {{--$('#alert').fadeOut('fast');--}}
    {{--}, 1500);--}}
{{--</script>--}}


