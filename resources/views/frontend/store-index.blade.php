@extends('layouts.app')

@section('title', 'store')

@section('styles')
    <!-- Custom CSS -->
    <link href="/css/1-col-portfolio.css" rel="stylesheet">
    <style type="text/css">
    h3 {margin-top: 0px;}
    </style>
@endsection

@section('intro')

@endsection

@section('content')
 <!-- Page Heading -->
        <div class="row {{ count($genres) }}">
            <div class="col-lg-12">
                <h1 class="page-header">Music Genders
                    <small>Check out our new releases</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        @foreach($genres as $genre)
        <div class="row">
        	 
            <div class="col-md-7">
                <a href="#">
                    <img class="img-responsive" src="{{ asset('images/'.$genre->image) }}" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h3>{{ ucfirst($genre->name) }}</h3>
                <!--<h4>Subheading</h4>-->
                <p>{{ $genre->description }}</p>
                <a class="btn btn-primary" href="{{ action('StoreController@browse').'?genre='.$genre->name }}">View Albums <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
            
        </div>
        <!-- /.row -->
        <hr>
        @endforeach

        
@endsection