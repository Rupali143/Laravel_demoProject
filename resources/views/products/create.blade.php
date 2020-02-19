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
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Products </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Add product </a>
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
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="kt-portlet__body">
    {{--<div class="tab-content  kt-margin-t-20">--}}

        <!--Begin:: Tab Content-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Add Products
                    </h3>
                </div>
            </div><br>
        {{--<div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">--}}

            <form class="kt-form kt-form--label-right" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="kt-form__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="text" name="name" placeholder="Enter Product name" required data-parsley-pattern="/^[a-zA-Z]*$/" data-parsley-required-message="Product Name is required" data-parsley-trigger="keyup">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Category</label>
                                <div class="col-lg-9 col-xl-6">
                                    <select name="category_id" required="required" class="form-control">
                                        <option value="">--Select Category--</option>
                                        @foreach($category as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">SubCategory:</label>
                                <div class="col-lg-9 col-xl-6">
                                <select name="subcategory_id" class="form-control" required="required">
                                    <option value="">--Select SubCategory--</option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
                                <div class="col-lg-9 col-xl-6">
                                    <select class="form-control" name="status" required>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Price</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="text" name="price" placeholder="Enter Product Price" required>
                                </div>
                            </div>

                            {{--<div class="form-group row">--}}
                                {{--<label class="col-xl-3 col-lg-3 col-form-label">Image</label>--}}
                                {{--<div class="col-lg-9 col-xl-6">--}}
                                    {{--<input class="form-control countFile" type="file" name="files[]"  id="files" multiple="">--}}
                                    {{--<input type="text" id="abc">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Image</label>
                                <div class="col-lg-9 col-xl-6">
                                <div id="filediv" class="row filediv"><input name="file[]" type="file"  id="file" style="display: none;"/></div><br>
                                <input type="button" id="add_more" class="btn btn-primary" value="Add More Files" style="display: none;"/><br>
                                </div>
                            </div>
                                {{--<input type="file" id="files" name="files[]" multiple />--}}
                            {{--<div class="row" id="image_preview">--}}
                                {{--<div id="file_count"></div>--}}
                                {{--<input type="file" id="uploadFile" name="FileUpload" multiple="multiple" />--}}
                                {{--<div id="upload_prev"></div>--}}
                            <div class="form-group col-8">
                                <input type="submit" class="btn btn-brand btn-bold pull-right" value="Save Changes" style="margin-left: 20px;">
                                <a href="{{ route('product.index') }}" type="button" class="btn btn-brand btn-bold pull-right">Back</a>
                            </div>
                      </div>
                    </div>

                </div>
                {{--</div>--}}
            </form>
    </div>
   {{--</div>--}}
</div>
        </div>
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
    var count = 0;

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

        count++;
        $(this).before($("<div/>",{id: 'filediv'}).fadeIn('slow').append($("<input/>",
                {
                    name: 'file[]',
                    type: 'file',
                    id: 'file'
                }),
                $("<br/><br/>")
        ));
        if(count == 5) {
            alert("Maximum 5 selection");
            return !$btn.attr('disabled','disabled');
        }
    });


    $('body').on('change', '#file', function ()
    {
//        $fileCount = this.files.length;
//       alert($fileCount);

        if (this.files && this.files[0])
        {
            abc += 1;
            var z = abc - 1;
            var x = $(this)
                    .parent()
                    .find('#previewimg' + z).remove();
            $(this).before("<div id='abcd" + abc + "' class='abcd row'><img id='previewimg" + abc + "' src='' width='80px'; height='80px';/></div>");
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
            $(this).hide();
            $("#abcd" + abc).append($("<img/>",{
                id: 'img',
                src: 'x.png',
                alt: 'delete'
            }) .click(function ()
            {
//                if(count < 5) { alert(count);
//                    $("#add_more").show();
//                    $("#filediv").show();
////                    return !$btn.attr('disabled','disabled');
//                }
                $(this).parent().parent().remove();
            }));
        }
    });
    //image preview
    function imageIsLoaded(e)
    {
        $('#previewimg' + abc).attr('src', e.target.result);
    };
</script>

@endsection
