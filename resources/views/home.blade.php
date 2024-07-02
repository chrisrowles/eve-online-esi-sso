@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="introduction" class="eve-bg">
        <div class="container-fluid text-light">
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron bg-none">
                        <h1>
                            Sakagami Incorporated.
                        </h1>
                        <div class="ml-2">
                            <p class="font-big">
                                We're a logistics corporation operating throughout New Eden and Anoikis.
                            </p>
                            <div class="row mt-5">
                                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                    <div class="card filter" style="height: initial;">
                                        <div class="card-body">
                                            <h2 class="text-success">{{ $contracts }}</h2>
                                            <small>Contracts completed this week.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-2 mt-3 mt-sm-0">
                                    <div class="card filter" style="height: initial;">
                                        <div class="card-body">
                                            <h2 class="text-success">26</h2>
                                            <small>Happy customers this week</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-4">
                                <div class="col-12 col-md-8 col-lg-4">
                                    <div class="card filter">
                                        <div class="card-body">
                                        @include('partials.calculators.haulage')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4">
        <div class="row text-center mt-2">
            <div class="col-md-4">
                <h2>
                    Contract our services
                </h2>
                <p>
                    We'll safely haul your stuff all the way across empire space for a very low price. Simply use our calculator
                    to determine how much you need to pay and follow the instructions on the page. Capsuleers currently
                    get <strong>50%</strong> off for a limited period!
                </p>
                <p>
                    <a class="btn btn-outline-dark" href="{{ route('haulage') }}">Get a quote »</a>
                </p>
            </div>
            <div class="col-md-4">
                <h2>
                    Build relations with us
                </h2>
                <p>
                    We're looking to build diplomatic relations and would be more than happy to discuss alliances and agreements. If
                    you represent a corporation and would like to build a relationship, please contact <strong>Solomon Kaldari</strong>
                    directly in-game.
                </p>
                <p>
                    <a class="btn btn-outline-dark" href="{{ route('apply') }}">Get in touch »</a>
                </p>
            </div>
            <div class="col-md-4">
                <h2>
                    Come fly with us
                </h2>
                <p>
                    Are you interested in a career in space-trucking? Then look no further. Join Allsides today for endless opportunities to make
                    friends and ISK, please find details on our page and contact <strong>Biff Eto</strong> in-game
                    if you have any questions.
                </p>
                <p>
                    <a class="btn btn-outline-dark" href="{{ route('apply') }}">Apply to join »</a>
                </p>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection
