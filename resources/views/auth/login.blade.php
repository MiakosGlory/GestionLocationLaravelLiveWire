@extends('layouts.auth')

@section('login_form')

    <div class="login-box" style="width: 500px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center" style="margin-bottom: 20px;">
                <a href="../../index2.html" class="h1"><b>Authentification</b></a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" @error('email') is-invalid @enderror 
                        name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                   {{$errors->first('email')}}
                                </div>
                            @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" @error('password') is-invalid @enderror 
                        name="password" autocomplete="current-password">
                             @error('password')
                                <div class="invalid-feedback">
                                    {{$errors->first('password')}}
                                </div>
                            @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
