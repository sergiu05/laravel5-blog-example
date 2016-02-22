@extends('layouts.app')

@section('title', 'home page')

@section('styles')
    <!-- Custom CSS -->
    <link href="css/business-frontpage.css" rel="stylesheet">

@endsection

@section('intro')

	@parent

@endsection

@section('content')
<hr>

<div class="row">
    <div class="col-sm-8">
        <h2>What We Do</h2>
        <p>Online shopping from a great selection at CDs &amp; Vinyl Store.</p>
        <p>Get the latest CDs and exclusive music offers at BestBuy.com. Shop for music CDs, vinyl records, Blu-ray discs and music DVDs from the best new artists.</p>
        <p>
            <a class="btn btn-default btn-lg" href="{{ action('StoreController@index') }}">See our collection &raquo;</a>
        </p>
    </div>
    <div class="col-sm-4">
        <h2>Contact Us</h2>
        <address>
            <strong>CD Music</strong>
            <br>3481 Melrose Place
            <br>Beverly Hills, CA 90210
            <br>
        </address>
        <address>
            <abbr title="Phone">P:</abbr>(123) 456-7890
            <br>
            <abbr title="Email">E:</abbr> <a href="mailto:#">name@example.com</a>
        </address>
    </div>
</div>
<!-- /.row -->
@endsection