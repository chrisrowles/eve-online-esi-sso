<form method="post" action="{{ route('route.planner.submit') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="origin">Pickup System</label>
        <div class="dropdown">
            <input type="text" class="form-control dropdown-toggle" id="originInput" data-bs-toggle="dropdown" aria-expanded="false" placeholder="Search for Pickup System">
            <ul class="dropdown-menu" aria-labelledby="originInput">
                <li><a class="dropdown-item" href="#" data-value="false">-- Please Select --</a></li>
                @foreach($systems as $system)
                    <li><a class="dropdown-item" href="#" data-value="{{ $system->system_id }}">{{ $system->name }}</a></li>
                @endforeach
            </ul>
            <input type="hidden" id="origin" name="origin" value="false">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="destination">Destination System</label>
        <div class="dropdown">
            <input type="text" class="form-control dropdown-toggle" id="destinationInput" data-bs-toggle="dropdown" aria-expanded="false" placeholder="Search for Destination System">
            <ul class="dropdown-menu" aria-labelledby="destinationInput">
                <li><a class="dropdown-item" href="#" data-value="false">-- Please Select --</a></li>
                @foreach($systems as $system)
                    <li><a class="dropdown-item" href="#" data-value="{{ $system->system_id }}">{{ $system->name }}</a></li>
                @endforeach
            </ul>
            <input type="hidden" id="destination" name="destination" value="false">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>