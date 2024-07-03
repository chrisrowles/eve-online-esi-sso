@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="finances">
        <div class="container py-2">
            <div class="row mt-3">
                <div class="col-12">
                    <h1 class="mb-0">{{ config('app.name') }}</h1>
                    <small class="text-muted">Financial Management</small>
                </div>
            </div>
            <hr>
            @include('partials.corporation.balances')
            @include('partials.corporation.journal')
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection

