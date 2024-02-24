@extends('master')
@section('content')
    <div class="container custom-login">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p style="color:red;">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
            <div class="col-sm-4 col-sm-offset-4">
                <form action="login" method="POST">
                    <div class="form-group">
                        @csrf
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                @if (Session::has('success'))
                    <p style="color:green;">{{ Session::get('success') }}</p>
                @endif
            </div>

        </div>
        <p style="margin-left:320px;margin-top:20px"> Create a account <a href="register">
                Register</a></p>

    </div>

@endsection
