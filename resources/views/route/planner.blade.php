@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="route-planner" class="eve-bg">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card filter">
                        <div class="card-body">
                            <form method="post" action"{{ route('route.planner.plan')}}">
                                <div class="form-group">
                                    <label for="origin">Pickup System</label>
                                    <select class="form-control" id="origin" name="origin">
                                        <option value="false">-- Please Select --</option>
                                        @foreach($systems as $system)
                                            <option value="{{ $system->system_id }}"> {{ $system->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="destination">Destination System</label>
                                    <select class="form-control" id="destination" name="destination">
                                        <option value="false">-- Please Select --</option>
                                        @foreach($systems as $system)
                                            <option value="{{ $system->system_id }}"> {{ $system->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection
