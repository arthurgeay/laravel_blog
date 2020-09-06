@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <dashboard :posts="{{ $posts }}"></dashboard>
@endsection
