@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <post :data-post="{{ $post }}"></post>
@endsection
