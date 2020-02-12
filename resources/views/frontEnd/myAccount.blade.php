<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <div class="alert-text"><strong>
                    {!! session()->get('success') !!} !!
                </strong>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
            <div class="login-form"><!--login form-->
                <h2>Login to your account</h2>
                <form action="{{ url('login') }}" method="post">
                    @csrf
                    <input type="hidden" value="customer" name="customer">
                    <input type="email" placeholder="Email Address" name="email" required/>
                    <input type="password" placeholder="Password" name="password" required/>
                    <input type="submit" class="btn btn-primary" value="Login">
                </form>
            </div><!--/login form-->
        </div>
        <div class="col-sm-1">
            <h2 class="or">OR</h2>
        </div>
        <div class="col-sm-4">
            <div class="signup-form"><!--sign up form-->
                <h2>New User Signup!</h2>
                <form action="{{ url('userRegister' )}}" method="post">
                    @csrf
                    <input type="text" placeholder="Name" name="name" required/>
                    <input type="email" placeholder="Email Address" name="email" required/>
                    <input type="password" placeholder="Password" name="password" id="password" required/>
                    <input type="password" placeholder="Confirm Password" name="confirm_password"  id="confirm_password" required/>
                    <div id="display_error" style="color: #ff0000;"></div>
                    <input type="submit" class="btn btn-primary" value="Signup" onclick="return Validate()">
                </form>
            </div><!--/sign up form-->
        </div>
    </div>
</div>