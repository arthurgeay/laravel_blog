@extends('layouts.app')

@section('title')
    Créer un article
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Créer un article</h1>
                <post-form api-url="{{ $apiUrl }}"></post-form>
            </div>
        </div>
    </div>
@endsection
