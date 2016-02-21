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
        <p>Introduce the visitor to the business using clear, informative text. Use well-targeted keywords within your sentences to make sure search engines can find the business.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et molestiae similique eligendi reiciendis sunt distinctio odit? Quia, neque, ipsa, adipisci quisquam ullam deserunt accusantium illo iste exercitationem nemo voluptates asperiores.</p>
        <p>
            <a class="btn btn-default btn-lg" href="#">Call to Action &raquo;</a>
        </p>
    </div>
    <div class="col-sm-4">
        <h2>Contact Us</h2>
        <address>
            <strong>Start Bootstrap</strong>
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