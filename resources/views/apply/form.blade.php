@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="application" class="eve-bg h-100">
        <div class="container py-4">
            <div class="row mt-3">
                <div class="col-md-12">
                    <h1>Come fly with us!</h1>
                </div>
            </div>
        </div>
        <div class="container pb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('apply.submit') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="length_playing">How long have you been playing EVE for?</label>
                                    <textarea class="form-control" id="length_playing" name="length_playing"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="favourite_activities">What are your favourite activities in EVE?</label>
                                    <textarea class="form-control" id="favourite_activities" name="favourite_activities"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="reason_joining">Why do you want to join Allsides?</label>
                                    <textarea class="form-control" id="reason_joining" name="reason_joining"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="real_life">Share a bit about yourself, such as what you do for a living, hobbies etc. (optional)</label>
                                    <textarea class="form-control" id="real_life" name="real_life"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="haiku">Write a haiku</label>
                                    <textarea class="form-control" id="haiku" name="haiku"></textarea>
                                </div>

                                <button class="btn btn-success">Submit Application</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    @parent
@endsection
