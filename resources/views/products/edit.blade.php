@extends('layouts.master')

@section('main-content')
<style>
    input[type="file"] {
        display: block;
    }
    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }
    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }
    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
    }
    .remove:hover {
        background: white;
        color: black;
    }
</style>
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Products </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{route('product.index')}}" class="kt-subheader__breadcrumbs-link">
                        Products </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Edit product </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>

    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <li> {{session('success')}}</li>
        </div>
    @endif
    <div class="kt-portlet__body">
        {{--<div class="tab-content  kt-margin-t-20">--}}

            <!--Begin:: Tab Content-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Edit Products
                        </h3>
                    </div>
                </div><br>
                {{--<div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">--}}

                <form class="kt-form kt-form--label-right" action="{{ route('product.update',$product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="kt-form__body">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input class="form-control" type="text" name="name"  value="{{ $product->name }}" placeholder="Enter Product name" required data-parsley-pattern="/^[a-zA-Z]*$/" data-parsley-required-message="Product Name is required" data-parsley-trigger="keyup">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Category</label>
                                    <div class="col-lg-9 col-xl-6">
                                                <select name="category_id" required="required" class="form-control">
                                                    <option value="">--Select Category--</option>
                                                @foreach($category as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected="selected"' : '' }}> {{ $category->name }} </option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">SubCategory:</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <select name="subcategory_id" class="form-control" required="required">
                                            <option value="">--Select SubCategory--</option>
                                            @foreach($subcategory as $subcategory)
                                                <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected="selected"' : '' }}> {{ $subcategory->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                {{--<div class="btn-group show-on-hover">--}}
                                    {{--@foreach ($category as $category)--}}
                                        {{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">--}}
                                            {{--{{ $category->name }} <span class="caret"></span>--}}
                                        {{--</button>--}}

                                        {{--@foreach ($subcategory as $subcategory)--}}
                                            {{--<ul class="dropdown-menu" role="menu">--}}
                                                {{--@if ( $category->parent_id == $subcategory->id )--}}
                                                    {{--<li><a href="">{{ $subcategory->name }}</a></li>--}}
                                                {{--@endif--}}
                                            {{--</ul>--}}
                                        {{--@endforeach--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}


                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <?php $checked = ($product->status == 1) ? 'Active' : 'Inactive'; ?>
                                        <select class="form-control" id="" name="status">
                                                <option value="1" {{$product->status == 1 ? 'selected="selected"' : ''}}>Active</option>
                                                <option value="0" {{$product->status == 0 ? 'selected="selected"' : ''}}>Inactive</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Price</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input class="form-control" type="text" name="price"  value="{{ $product->price }}" placeholder="Enter Product Price" required>
                                    </div>
                                </div>
                                <div class="form-group row" id="displayImg">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Images</label>
                                    <div class="col-lg-9 col-xl-6">
                                        {{--<input class="form-control" type="file" name="files[]"  id="files" multiple="">--}}
                                        {{--<br>--}}
                                     {{--@foreach($productimage as $img)--}}
                                            {{--<img src="/uploads/products/{{$img['images']}}" height="100px" width="100px" style="margin:10px;"/><button type="button" class="button-close" data-id="{{$img->id}}"><i class="fa fa-close"></i> Delete </button>--}}
                                        {{--@endforeach--}}

                                        <div id="filediv" class="row"><input name="file[]" type="file"  id="file" style="display: none;"/></div><br>
                                        <input type="button" id="add_more" class="btn btn-primary add_more" value="Add More Files" style="display: none;"/><br>
                                        <input type="hidden" value="{{ count($product->image) }}" id="totalCount">
                                        @foreach ($product->image as $img)
                                            <img src="/uploads/products/{{ $img->images }}" height="100px" width="100px" style="margin:10px;"><button type="button" class="button-close" data-id="{{ $img->id }}"><i class="fa fa-close"></i> Delete </button>
                                        @endforeach

                                    </div>
                                </div>


                                <div class="form-group col-8">
                                    <input type="submit" class="btn btn-brand btn-bold pull-right" value="Save Changes" style="margin-left: 20px;">
                                    <a href="{{ route('product.index') }}" type="button" class="btn btn-brand btn-bold pull-right">Back</a>

                                </div>
                            </div>
                        </div>

                    </div>

                </form>
                {{--</div>--}}
            </div>
        </div>
    {{--</div>--}}
{{--</div>--}}
<!--End:: Tab Content-->
@endsection
@section('scripts')
    <script src="{{ asset('js/multipleImg3.2.1.min.js' )}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var catID = $(this).val();
                if(catID) {
                    $.ajax({
                        url: "{{ url('fetch_subCategory')}}/" + catID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="subcategory_id"]').empty();
                }
            });
        });
    </script>

    <script>
        var abc = 0;
        var fixCount = 4;
        var count = fixCount - $("#totalCount").val();

        $btn = $('input[type="button"]');

        if(count < 0) {
            $("#add_more").hide();
            $("#filediv").hide();
        }
        else{
            $("#add_more").show();
            $("#filediv").show();
        }
        $("#add_more").click(function ()
        {
            count--;
            $(this).before($("<div/>",{id: 'filediv'}).fadeIn('slow').append($("<input/>",
                    {
                        name: 'file[]',
                        type: 'file',
                        id: 'file'
                    }),
                    $("<br/><br/>")
            ));
            if(count < 0) {
                $("#add_more").hide();
                $("#filediv").hide();
                return !$btn.attr('disabled','disabled');
            }
//            else if(count == 0){
//                $("#filediv").attr('disabled','disabled');
//                return !$btn.attr('disabled','disabled');
//        }

        });
        $('body').on('change', '#file', function ()
        {
            if (this.files && this.files[0])
            {
                abc += 1;
                var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();

                $(this).before("<div id='abcd" + abc + "' class='abcd row'><img id='previewimg" + abc + "' src='' width='80px'; height='80px';/></div>");
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                $(this).hide();
                $("#abcd" + abc).append($("<img/>",{
                    id: 'img',
                    src: 'x.png', //the remove icon
                    alt: 'delete'
                }).click(function ()
                {
//                    alert(count);
//                    $("#filediv").show();
                    $("#add_more").show();
                    $("#filediv").prop("disabled",false);
//                    $("#filediv").prop("disabled", false);
                    $("#add_more").prop("disabled", false);
                    $(this).parent().parent().remove();
                }));
            }
        });
        //image preview
        function imageIsLoaded(e)
        {  console.log(e);
            $('#previewimg' + abc).attr('src', e.target.result);
        };
    </script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".button-close").click(function() {
        var response = confirm("Do you want to delete this Image?");
        if (response == true) {
        var closeId = $(this).attr("data-id");
        $.ajax({
            type: 'get',
            url: "{{url('delete_order')}}/" + closeId,
            data:{closeId:closeId ,_token: '{{ csrf_token() }}'},
            success: function (data) {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert("Failed");
                    window.location.reload();
                }
            }
        });
    }else{
         alert("Failed to delete Image");
        }
    });
</script>
@endsection