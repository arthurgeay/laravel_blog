@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <post :post="{{ $post }}" :data-comments="{{ $comments }}"></post>
@endsection
