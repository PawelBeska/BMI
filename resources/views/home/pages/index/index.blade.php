@extends('layouts.app')


@section('nav')
    @include('home.global.nav.nav')
@endsection()

@section('body')
    @include('home.components.index.index')
@endsection()
