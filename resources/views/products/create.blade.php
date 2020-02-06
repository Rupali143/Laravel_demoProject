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
                                <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
                                <div class="col-lg-9 col-xl-6">
                                    <select class="form-control" name="status" required>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                    </select>
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
                                <div id="filediv" class="row"><input name="file[]" type="file"  id="file"/></div><br>
                                <input type="button" id="add_more" class="btn btn-primary" value="Add More Files"/><br>
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

                            {{--<div id="file_count"></div>--}}
                            {{--<input type="file" id="uploadFile" name="FileUpload" multiple="multiple"/>--}}
                            {{--<div id="upload_prev"></div>--}}
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
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
{{--<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>--}}
<script src="{{ asset('js/multipleImg3.2.1.min.js' )}}"></script>
<script>
    var abc = 0;
    var count = 0;
    $btn = $('input[type="button"]')
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
        if(count == 4) {
            alert("Maximum 5 selection");
            return !$btn.attr('disabled','disabled');
        }
    });
    $('body').on('change', '#file', function ()
    {
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
            $(this)
                    .hide();
            $("#abcd" + abc).append($("<img/>",{
                id: 'img',
                src: 'x.png',
                alt: 'delete'
            }) .click(function ()
            {
                $(this)
                        .parent()
                        .parent()
                        .remove();
            }));
        }
    });
    //image preview
    function imageIsLoaded(e)
    {
        $('#previewimg' + abc)
                .attr('src', e.target.result);
    };
</script>


    {{--<script>--}}
    {{--$(document).ready(function() {--}}

        {{--if (window.File && window.FileList && window.FileReader) {--}}

            {{--$("#files").on("change", function(e) {--}}
                {{--var files = e.target.files,--}}
                        {{--filesLength = files.length;--}}
                {{--if(filesLength > 5){--}}
                    {{--filesLength = event.target.value = '';--}}
                    {{--alert("Maximum selection is 5");--}}
                {{--}else {--}}
{{--//                    alert("else");--}}
                    {{--$('#abc').val(filesLength);--}}
                    {{--for (var i = 0; i < filesLength; i++) {--}}
                        {{--var f = files[i];--}}
{{--//                        console.log(f);--}}
                        {{--var fileReader = new FileReader();--}}
                        {{--fileReader.onload = (function (e) {--}}
{{--//                            console.log(e);--}}
                            {{--var file = e.target;--}}
{{--//                           alert(filesLength);--}}
                            {{--$("<span class=\"pip\">" +--}}
                            {{--"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +--}}
                            {{--"<br/><span class=\"remove\">Remove image</span>" +--}}
                            {{--"</span>").insertAfter("#files");--}}
                        {{--});--}}
                        {{--fileReader.readAsDataURL(f);--}}
                    {{--}--}}
                    {{--$(document).on('click', '.remove', function() {--}}
{{--//                        console.log(fileReader);--}}
                        {{--$(this).parent(".pip").remove();--}}
                        {{--filesLength = filesLength - 1;--}}
                        {{--alert(filesLength);--}}
{{--//                        $('#files').val(filesLength);--}}
                        {{--$('#abc').val(filesLength);--}}
                    {{--});--}}
                {{--}--}}
            {{--});--}}
{{--//            $(".remove").click(function () { alert("dfgdfg");--}}
{{--//                                $(this).parent(".pip").remove();--}}
{{--//                                filesLength -= 1;--}}
{{--////                                ("#files").filesLength;--}}
{{--//                                alert("hhh");--}}
{{--//                                alert(filesLength);--}}
{{--//                            });--}}

        {{--} else {--}}
            {{--alert("Your browser doesn't support to File API")--}}
        {{--}--}}
    {{--});--}}
    {{--</script>--}}
@endsection
{{--<script>--}}
    {{--var fileCount = 0;--}}
    {{--var showFileCount = function() {--}}
        {{--$('#file_count').text('# Files selected: ' + fileCount);--}}
    {{--};--}}

    {{--showFileCount();--}}

    {{--$(document).on('click', '.close', function() {--}}
        {{--$(this).parents('span').remove();--}}
        {{--fileCount -= 1;--}}
        {{--showFileCount();--}}
    {{--})--}}

    {{--$('#uploadFile').on('change', function() {--}}

        {{--var filename = this.value;--}}
        {{--var lastIndex = filename.lastIndexOf("\\");--}}
        {{--if (lastIndex >= 0) {--}}
            {{--filename = filename.substring(lastIndex + 1);--}}
        {{--}--}}
        {{--var files = $('#uploadFile')[0].files;--}}
        {{--for (var i = 0; i < files.length; i++) {--}}
            {{--$("#upload_prev").append('<span>' + '<div class="filenameupload">' + files[i].name + '</div>' + '<p class="close" >X</p></span>');--}}
        {{--}--}}
        {{--fileCount += files.length;--}}
        {{--showFileCount();--}}
    {{--});--}}
{{--</script>--}}
{{--<script>--}}
    {{--var fileCount = 0;--}}
    {{--var showFileCount = function() {--}}
        {{--$('#file_count').text('# Files selected: ' + fileCount);--}}
    {{--};--}}
    {{--showFileCount();--}}
    {{--$(document).on('click', '.close', function() {--}}
        {{--$(this).parents('span').remove();--}}
        {{--fileCount -= 1;--}}
        {{--showFileCount();--}}
    {{--})--}}

    {{--$('#uploadFile').on('change', function() {--}}

        {{--var filename = this.value;--}}
        {{--var lastIndex = filename.lastIndexOf("\\");--}}
        {{--if (lastIndex >= 0) {--}}
            {{--filename = filename.substring(lastIndex + 1);--}}
        {{--}--}}
        {{--var files = $('#uploadFile')[0].files;--}}
        {{--for (var i = 0; i < files.length; i++) {--}}
            {{--$("#upload_prev").append('<span>' + '<div class="filenameupload">' + files[i].name + ' abc</div>' + '<p class="close" >X</p></span>');--}}
        {{--}--}}
        {{--fileCount += files.length;--}}
        {{--showFileCount();--}}
    {{--});--}}
    {{--</script>--}}