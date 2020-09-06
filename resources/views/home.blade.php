@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <dashboard :data-posts="{{ $posts }}" api-url="{{ $apiUrl }}" api-token="{{ $apiToken }}"></dashboard>
@endsection
