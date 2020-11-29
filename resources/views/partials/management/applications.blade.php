@section('additional_styles')
    @parent
@endsection

<div class="row mt-4">
    <div class="col-12 d-flex align-items-center justify-content-between">
        <h2>Applications Received</h2>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card p-2 bg-white shadow border-0">
            <div class="card-body">
                <table id="corporate_applications" class="table table-sm table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Current Corporation</th>
                        <th scope="col">Submitted On</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $application)
                        <tr onclick="window.location = '{{ route('corporate.applications.view', ['applicant' => $application]) }}'">
                            <td>{{ $application->id }}</td>
                            <td>{{ $application->character_name }}</td>
                            <td>{{ $application->character_corporation }}</td>
                            <td>{{ $application->created_at }}</td>
                            <td>{{ $application->updated_at }}</td>
                            <td>{{ $application->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('additional_scripts')
    @parent
    <script>
        $(document).ready(() => {
            $('#corporate_applications').DataTable({
                order: [[ 4, "desc" ]]
            });
        })
    </script>
@endsection
