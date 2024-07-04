@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="route-planner">
        <div class="container py-4">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-body">
                            @include('partials.route-planner')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection
