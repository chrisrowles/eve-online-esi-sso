<form method="post" action"{{ route('route.planner.submit')}}">
    <div class="mb-3">
        <label class="form-label" for="origin">Pickup System</label>
        <select class="form-control" id="origin" name="origin">
            <option value="false">-- Please Select --</option>
            @foreach($systems as $system)
                <option value="{{ $system->system_id }}"> {{ $system->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="destination">Destination System</label>
        <select class="form-control" id="destination" name="destination">
            <option value="false">-- Please Select --</option>
            @foreach($systems as $system)
                <option value="{{ $system->system_id }}"> {{ $system->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>