@extends('layouts.app')

@section('additional_styles')
<style>
.scrollable-timeline {
    display: flex;
    overflow-x: auto;
    padding: 1rem 0;
}
.timeline-item {
    flex: 0 0 auto;
    width: 300px;
    margin-right: 1rem;
}
</style>
@endsection

@section('content')
<div id="route-planner" class="eve-bg">
	<div class="container mt-5">
        <div class="row">
            <!-- Origin System Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Origin</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-2">
							<a href="#">{{ $route['origin']->name }}</a>
						</h5>
                        <p class="card-text mb-0"><strong>Security Class:</strong> {{ $route['origin']->security_class }}</p>
                        <p class="card-text mb-0"><strong>Security Status:</strong>
							{{ round(floatval($route['origin']->security_status), 2) }}
						</p>
                        <p class="card-text mb-0"><strong>Constellation:</strong>
							<a href="#">{{ $route['origin']->constellation->name }}</a>
						</p>
                        <p class="card-text mb-0"><strong>Region:</strong>
							<a href="#">{{ $route['origin']->constellation->region->name }}</a>
						</p>
                        {{-- <p class="card-text small">{{ $route['origin']->constellation->region->description }}</p> --}}
                    </div>
                </div>
            </div>

            <!-- Destination System Card -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Destination</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-2">
							<a href="#">{{ $route['destination']->name }}</a>
						</h5>
                        <p class="card-text mb-0"><strong>Security Class:</strong> {{ $route['destination']->security_class }}</p>
                        <p class="card-text mb-0"><strong>Security Status:</strong>
							{{ round(floatval($route['destination']->security_status), 2) }}
						</p>
						<p class="card-text mb-0"><strong>Constellation:</strong>
							<a href="#">{{ $route['destination']->constellation->name }}</a>
						</p>
                        <p class="card-text mb-0"><strong>Region:</strong>
							<a href="#">{{ $route['destination']->constellation->region->name }}</a>
						</p>
                        {{-- <p class="card-text small">{{ $route['destination']->constellation->region->description }}</p> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Route Timeline -->
        <div class="row">
            <div class="col-12">
                <div class="scrollable-timeline">
                    @foreach ($route['route'] as $system)
                        <div class="card timeline-item">
                            <div class="card-body">
                                <h5 class="card-title mb-2">
									<a href="#">{{ $system->name }}</a>
								</h5>
                                <p class="card-text mb-0"><strong>Security Class:</strong> {{ $system->security_class }}</p>
                                <p class="card-text mb-0"><strong>Security Status:</strong> {{ round(floatval($system->security_status), 2) }}</p>
                                <p class="card-text mb-0"><strong>Constellation:</strong>
									<a href="#">{{ $system->constellation->name }}</a>
								</p>
                                <p class="card-text mb-0"><strong>Region:</strong>
									<a href="#">{{ $system->constellation->region->name }}</a>
								</p>
                                {{-- <p class="card-text">{{ $system->region->description }}</p> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('additional_scripts')
@endsection
