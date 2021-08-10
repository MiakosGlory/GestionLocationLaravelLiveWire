    @extends("layout.master")

    @section('content')

        <div class="row">
            <div class="col-12 p-4">
                <div class="jumbotron">
                    <h1 class="display-3">Bienvenue {{auth()->user()->nom}} {{auth()->user()->prenom}}</h1>
                    @foreach (auth()->user()->roles as $role)
                        <p>{{$role->nom}}</p>
                    @endforeach
                </div>
            </div>
        </div>

    @endsection


{{--@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>--}}