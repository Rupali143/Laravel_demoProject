@extends('layouts.master')
@section('main-content')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    {{--<style type="text/css">--}}

        {{--input[type=file]{--}}

            {{--display: inline;--}}

        {{--}--}}

        {{--#image_preview{--}}

            {{--border: 1px solid black;--}}

            {{--padding: 10px;--}}

        {{--}--}}

        {{--#image_preview img{--}}

            {{--width: 200px;--}}

            {{--padding: 5px;--}}

        {{--}--}}

    {{--</style>--}}
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
<div class="kt-portlet__body">
    <div class="tab-content  kt-margin-t-20">

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
                                    {{--<input class="form-control" type="text" name="category" placeholder="Enter Product Category" required data-parsley-pattern="/^[a-zA-Z]*$/" data-parsley-required-message="Category is required" data-parsley-trigger="keyup">--}}
                                    <select class="form-control" name="category_id" required>
                                        <option>--Select--</option>
                                        @foreach($category as $c)
                                          <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
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
                                <label class="col-xl-3 col-lg-3 col-form-label">Image</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control" type="file" name="images[]"  id="images" multiple="">
                                </div>
                            </div>
                            <div class="row" id="image_preview">
                            <div class="form-group col-8">
                                <input type="submit" class="btn btn-brand btn-bold pull-right" value="Save Changes" style="margin-left: 20px;">
                                <a href="{{ route('product.index') }}" type="button" class="btn btn-brand btn-bold pull-right">Back</a>

                            </div>
                      </div>
                    </div>

                </div>

            </form>
    </div>
   </div>
</div>
@endsection

<script type="text/javascript">

    $("#images").change(function(){
        $('#image_preview').html("");
//        var total_file=document.getElementById("images").files.length;
        var total_file = 4;
        for(var i=0;i<total_file;i++)
        {
            $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
        }
    });
    $('form').ajaxForm(function()
    {
        alert("Uploaded SuccessFully");

    });

</script>

{{--<script>--}}
{{--$(document).ready(function(){--}}
{{--$('#images').on('change', function(){--}}
{{--if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser--}}
{{--{--}}

{{--var data = $(this)[0].files; //this file data--}}
{{--var i=5;--}}
{{--$.each(data, function(index, file){ //loop though each file--}}
{{--if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type--}}
{{--var fRead = new FileReader(); //new filereader--}}
{{--fRead.onload = (function(file){ //trigger function on successful read--}}
{{--return function(e) {--}}
{{--var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element--}}
{{--$('#preview_img').append(img); //append image to output element--}}
{{--};--}}
{{--})(file);--}}
{{--fRead.readAsDataURL(file); //URL representing the file's data.--}}
{{--}--}}
{{--});--}}

{{--}else{--}}
{{--alert("Your browser doesn't support File API!"); //if File API is absent--}}
{{--}--}}
{{--});--}}
{{--});--}}

{{--</script>--}}