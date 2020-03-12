<!DOCTYPE html>
<html>
<head>
    <title>Order Failed Mail</title>
</head>
<body>

        <div class="alert alert-danger">
            <ul>
                
            </ul>
        </div>

<div class="solid">
<p class="default"><b>Oh no, Your payment is failed.Please try again.!! </b></p>
<p>{{ $body }}</p>
<p>@foreach($errors->all() as $error)
                    <li> {{$error}} </li>
                @endforeach </p>
</div>
</body>
</html>
