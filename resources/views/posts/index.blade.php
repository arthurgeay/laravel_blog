@extends('layouts.app')

@section('title')
    Accueil
@endsection

@section('content')
    <post-list :data-posts="{{ $posts }}"></post-list>
@endsection
