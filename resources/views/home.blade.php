@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <section class="intro-section">
        <video autoplay muted loop>
            <source src="{{ asset('images/eve2.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="intro-overlay filter d-flex flex-column">
            <h1>Sakagami Incorporated.</h1>
            <strong>New Eden's Premier Corporation</strong>
            @include('partials.calculators.haulage')
        </div>
    </section>

    {{-- <main class="content-section container">
        <div class="row">
            <div class="col-md-4">
                <h2>Column 1</h2>
                <p>Placeholder content for the first column.</p>
            </div>
            <div class="col-md-4">
                <h2>Column 2</h2>
                <p>Placeholder content for the second column.</p>
            </div>
            <div class="col-md-4">
                <h2>Column 3</h2>
                <p>Placeholder content for the third column.</p>
            </div>
        </div>
    </main> --}}
@endsection

@section('additional_scripts')
@endsection
