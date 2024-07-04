@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="confirmation">
        <div class="container py-4">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Application Received</h2>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection
