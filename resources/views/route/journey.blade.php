@extends('layouts.app')

@section('additional_styles')
<style>
.scrollable-timeline {
    display: flex;
    overflow-x: auto;
	scrollbar-width: thin;
    scrollbar-color: #3b4350 #212529;
}
.timeline-item {
    flex: 0 0 auto;
    width: 300px;
    margin-right: 1rem;
}
</style>
@endsection

@section('content')
<div id="route-planner">
	<div class="container py-2">
		<div class="row mt-3">
			<div class="col-12">
				<h1 class="mb-0">{{ config('app.name') }}</h1>
				<small class="text-muted">Route Planning</small>
			</div>
		</div>
		<hr>
        <div class="row">
            <!-- Origin System Card -->
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2">
							Origin: <a href="#">{{ $route['origin']->name }}</a>
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
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2">
							Destination: <a href="#">{{ $route['destination']->name }}</a>
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
		<hr>
        <!-- Route Timeline -->
		<div class="row">
			<div class="col-12">
				<h5 class="text-muted">Your route:</h5>
			</div>
		</div>
        <div class="row mt-2">
            <div class="col-12">
                <div class="scrollable-timeline pb-3">
                    @foreach ($route['route'] as $system)
                        <div @class([
							'card',
							'timeline-item',
							'bg-nullsec' => round(floatval($system->security_status), 2) < 0,
							'bg-lowsec' => round(floatval($system->security_status), 2) > 0
							    && round(floatval($system->security_status), 2) < 0.5,
							'bg-hisec' => round(floatval($system->security_status), 2) > 0.5
						])>
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

		<div class="row mt-3">
			<div class="col-12">
				<h5 class="text-muted">Plot another route:</h5>
			</div>
		</div>
		<div class="row mt-2">
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
</div>
@endsection

@section('additional_scripts')
@endsection
