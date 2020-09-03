@extends('layouts.app')

@section('title')
    Accueil
@endsection

@section('content')
    <post-list :posts="{{ $posts }}"></post-list>
@endsection
