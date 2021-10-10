@extends('layouts.app')


@section('nav')
    @include('home.global.nav.nav')
@endsection()

@section('content')
    @include('home.components.history.history')
@endsection()
