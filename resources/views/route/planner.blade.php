@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="route-planner" class="eve-bg">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card filter text-light">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="source_system">Pickup System</label>
                                    <select class="form-control" id="source_system" name="source_system">
                                        <option value="false">-- Please Select --</option>
                                        @foreach($systems as $system)
                                            <option value="{{ $system->system_id }}"> {{ $system->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="destination_system">Destination System</label>
                                    <select class="form-control" id="destination_system" name="destination_system">
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
