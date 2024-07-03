@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="applicant">
        <div class="container py-2">
            <div class="row mt-3">
                <div class="col-12">
                    <h1>{{ $applicant->character_name }}'s Application</h1>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-6">
                    <div class="card shadow bg-white">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="character_name">Name</label>
                                    <input type="text" class="form-control" id="character_name" disabled readonly
                                           value="{{ $applicant->character_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="character_corp">Corporation</label>
                                    <input type="text" class="form-control" id="character_corp" disabled readonly
                                           value="{{ $applicant->character_corporation }}">
                                </div>
                                <div class="form-group">
                                    <label for="time_playing">Time spent playing</label>
                                    <textarea class="form-control"
                                              name="time_playing"
                                              id="time_playing"
                                              disabled readonly>{{ trim($applicant->length_playing) }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="favourite_activities">Favourite activities</label>
                                    <textarea class="form-control"
                                              name="favourite_activities"
                                              id="favourite_activities"
                                              disabled readonly>{{ trim($applicant->favourite_activities) }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="real_life">Real life</label>
                                    <textarea class="form-control"
                                              name="real_life"
                                              id="real_life"
                                              disabled readonly>{{ trim($applicant->real_life) }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="haiku">Haiku</label>
                                    <textarea class="form-control"
                                              name="haiku"
                                              id="haiku"
                                              disabled readonly>{{ $applicant->haiku ? trim($applicant->haiku) : '' }}
                                    </textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card shadow bg-white">
                        <div class="card-header bg-white">
                            <h2>Corporation History</h2>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach($applicant->character_raw_data->corporation_history as $corp => $record)
                                    <li>{{ $corp }} <small class="text-muted">(since {{ date('jS F Y', strtotime($record->since)) }})</small></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <form action="{{ route('corporation.applications.update', ['applicant' => $applicant]) }}" method="POST">
                        <div class="form-group mt-4 d-flex justify-content-center">
                            <input type="hidden" name="_method" value="PUT">
                            @csrf
                            <label for="reject" class="sr-only">Reject</label>
                            <input type="submit" name="status" id="reject" class="btn w-25 btn-danger" value="Reject">
                            <label for="approve" class="sr-only">Approve</label>
                            <input type="submit" name="status" id="approve" class="btn w-25 ms-3 btn-success" value="Approve">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection
