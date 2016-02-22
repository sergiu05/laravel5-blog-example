@extends('layouts.app')

@section('title', 'Details page')

@section('styles')
    <!-- Custom CSS -->
    <link href="/css/shop-item.css" rel="stylesheet">
@endsection

@section('intro')

@endsection

@section('content')

<div class="row">

    <div class="col-md-3">
        <p class="lead">CDs Music</p>
        <div class="list-group">
            {{--  $genres is defined in ViewComposers/StoreComposer.php --}}
            @foreach($genres as $genre)
            <a href="#" class="list-group-item @if ($album->genre->id == $genre->id) active @endif">{{ $genre->name }}</a>
            @endforeach            
        </div>
    </div>

    <div class="col-md-5">

        <div class="thumbnail">
            <img class="img-responsive" src="{{ asset('images/'.$album->image) }}" alt="">
            <div class="caption-full">
                <h4 class="pull-right">${{ $album->price }}</h4>
                <h4><a href="{{ route("store::show", ['id' => $album->id ]) }}">{{ $album->title }}</a>
                </h4>                
                <p>{{ $album->description }}</p>
            </div>
            <div class="ratings">
                <p class="pull-right">3 reviews</p>
                <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    4.0 stars
                </p>
            </div>
        </div>

        <!--
        <div class="well">

            <div class="text-right">
                <a class="btn btn-success">Leave a Review</a>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    Anonymous
                    <span class="pull-right">10 days ago</span>
                    <p>This product was great in terms of quality. I would definitely buy another!</p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    Anonymous
                    <span class="pull-right">12 days ago</span>
                    <p>I've alredy ordered another one!</p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    Anonymous
                    <span class="pull-right">15 days ago</span>
                    <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                </div>
            </div>

        </div>-->

    </div>

</div>

@endsection