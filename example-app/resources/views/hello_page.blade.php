@extends('layouts.app')

@section('title', $title)

@section('content')
    <h1>{{ $content }}</h1>

    <a href="{{ route('move_bye_page') }}">リンク</a>
@stop