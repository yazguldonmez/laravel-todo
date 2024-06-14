@extends('layouts.auth')
@section('title', 'Register')
@section('content')
    <section class="register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <h1>Register</h1>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email"
                                value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </form>
                    <p class="mt-3 text-center">Have an account already? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </div>

        </div>
    </section>
@endsection
