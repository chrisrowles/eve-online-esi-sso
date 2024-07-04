@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <section class="intro-section">
        <video autoplay muted loop>
            <source src="{{ asset('images/eve2.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="intro-overlay d-flex flex-column">
            <h1>Sakagami Incorporated.</h1>
            <strong>New Eden's Premier Corporation</strong>
            <div class="my-5">@include('partials.calculators.haulage')</div>
        </div>
    </section>
@endsection

@section('additional_scripts')
@endsection
