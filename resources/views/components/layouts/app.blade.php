@props(['title' => ''])
@extends('adminlte::page')
@section('title', $title)
@section('content_header')
    <h1>{{ $title }}</h1>
@endsection
@section('content')
    <div class="container-fluid p-3">
        {{ $slot }}
    </div>
@endsection