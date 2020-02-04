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
<link href="{{asset('css/uppy.min.css')}}" rel="stylesheet">
<script src="{{asset('js/uppy.min.js')}}"></script>
<div id="drag-drop-area"></div>
<script>
    var uppy = Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area'
            })
</script>
@endsection
@section('scripts')
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