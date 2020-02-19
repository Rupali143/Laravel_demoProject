@extends('frontEnd/layouts/master')
@section('main-sidebar')

    <div class="container">
        {{--@if (session()->has('success'))--}}
            {{--<div class="alert alert-success" role="alert">--}}
                {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
                {{--<div class="alert-text"><strong>--}}
                        {{--{!! session()->get('success') !!} !!--}}
                    {{--</strong>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}
        {{--<div class="row">--}}
                <div class="signup-form">
                    <h2>Edit Profile!</h2>
                    <form action="{{ url('updateProfile' )}}" method="post">
                        @csrf
                        <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                        <input type="text" placeholder="Name" name="name" required value="{{ Auth::user()->name }}"/>
                        <input type="email" placeholder="Email Address" name="email" value="{{ Auth::user()->email }}" readonly/>
                        <input type="submit" class="btn btn-primary" value="Update Profile" onclick="">
                    </form>
                </div>
        {{--</div>--}}
    </div>
    @endsection

<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        if (password != confirmPassword) {
            $("#display_error").text('Passwords do not match.');
//            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>