@extends('layouts.app')

@section('Title', 'Browse albums')

@section('styles')
    <!-- Custom CSS -->
    <link href="/css/thumbnail-gallery.css" rel="stylesheet">
@endsection

@section('intro')

@endsection

@section('content')

<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">{{ ucfirst($genre->name) }} Albums</h1>
    </div>

    @foreach($genre->albums as $album)

    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
        <a class="thumbnail" href="{{ action('StoreController@show', ['id' => $album->id]) }}">
            <img class="img-responsive" src=" {{ asset('images/'.$album->image) }} " alt="">
        </a>
    </div>

    @endforeach

    
</div>

@endsection