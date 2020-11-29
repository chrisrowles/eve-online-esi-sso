@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="contracts">
        <div class="container py-2">
            <div class="row mt-3">
                <div class="col-12">
                    <h1>{{ config('app.name') }} Contract Management</h1>
                </div>
            </div>
            <hr>
            @include('partials.management.contracts')
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection
