@extends('layouts.app')

@section('title')
    Modifier un article
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Modifier un article</h1>
                <post-form :post="{{ $post }}" api-token="{{ $apiToken }}"></post-form>
            </div>
        </div>
    </div>
@endsection
