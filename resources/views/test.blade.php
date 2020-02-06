@extends('layouts.master')

@section('main-content')
{{--<style>--}}
    {{--input[type="file"] {--}}

        {{--display:block;--}}
    {{--}--}}
    {{--.imageThumb {--}}
        {{--max-height: 75px;--}}
        {{--border: 2px solid;--}}
        {{--margin: 10px 10px 0 0;--}}
        {{--padding: 1px;--}}
    {{--}--}}
    {{--</style>--}}
    {{--<h2>preview multiple images before upload using jQuery</h2>--}}
    {{--<input type="file" id="files" name="files[]" multiple />--}}
{{--<style>--}}
    {{--.uppy-Dashboard-inner{--}}
        {{--width: 100px; height: 100px;--}}
    {{--}--}}
    {{--</style>--}}
{{--<link href="{{asset('css/uppy.min.css')}}" rel="stylesheet">--}}
{{--<script src="{{asset('js/uppy.min.js')}}"></script>--}}
{{--<div id="drag-drop-area">--}}

{{--</div>--}}

{{--<script>--}}
    {{--var uppy = Uppy.Core()--}}
            {{--.use(Uppy.Dashboard, {--}}
                {{--inline: true,--}}
                {{--target: '#drag-drop-area'--}}
            {{--})--}}
{{--</script>--}}
{{--<style>--}}
{{--.filenameupload {--}}
{{--width: 98%;--}}
{{--}--}}

{{--#upload_prev {--}}
{{--border: thin solid #000;--}}
{{--width: 65%;--}}
{{--padding: 0.5em 1em 1.5em 1em;--}}
{{--}--}}

{{--#upload_prev span {--}}
{{--display: flex;--}}
{{--padding: 0 5px;--}}
{{--font-size: 12px;--}}
{{--}--}}
{{--</style>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
{{--<div id="file_count"></div>--}}
{{--<input type="file" id="uploadFile" name="FileUpload" multiple="multiple"/>--}}
{{--<div id="upload_prev"></div>--}}
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
<style>
    #previewimg{
        width:50px;
        height:50px;
    }
    </style>

<div class="col-md-3 col-sm-3 col-xs-3">
    <div id="filediv"><input name="file[]" type="file"  id="file"/></div>
    <input type="button" id="add_more" class="btn btn-primary" value="Add More Files"/><br>
    {{--<button type="submit" class="btn btn-success">Submit</button>--}}
</div>

@endsection
@section('scripts')
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script>
        var abc = 0;
        var count = 0;
        $btn = $('input[type="button"]')
        $("#add_more").click(function ()
        {
            count++;
//            alert(count);
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
                abc += 1; //increementing global variable by 1
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
                    src: 'x.png', //the remove icon
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
    {{--<script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>--}}

    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function() {--}}

            {{--if(window.File && window.FileList && window.FileReader) {--}}
                {{--$("#files").on("change",function(e) {--}}
                    {{--var files = e.target.files ,--}}
                            {{--filesLength = files.length ;--}}
                    {{--for (var i = 0; i < filesLength ; i++) {--}}
                        {{--var f = files[i]--}}
                        {{--var fileReader = new FileReader();--}}
                        {{--fileReader.onload = (function(e) {--}}
                            {{--var file = e.target;--}}
                            {{--$("<img></img>",{--}}
                                {{--class : "imageThumb",--}}
                                {{--src : e.target.result,--}}
                                {{--title : file.name--}}
                            {{--}).insertAfter("#files");--}}
                        {{--});--}}
                        {{--fileReader.readAsDataURL(f);--}}
                    {{--}--}}
                {{--});--}}
            {{--} else { alert("Your browser doesn't support to File API") }--}}
        {{--});--}}


    {{--</script>--}}
    @endsection