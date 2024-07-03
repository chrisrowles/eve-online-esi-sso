@section('additional_styles')
    @parent
@endsection

<div class="row mt-4">
    <div class="col-12 d-flex align-items-center justify-content-between">
        <h2>Inbox</h2>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card p-2 bg-white shadow border-0">
            <div class="card-body">
                <table id="inbox" class="table table-sm table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ESI ID</th>
                        <th scope="col">From</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Date</th>
                        <th scope="col">Read</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($emails['received'] as $mail)
                        <tr onclick="window.location = '{{ route('corporation.mailbox.view', ['id' => $mail->mail_id]) }}'">
                            <td>{{ $mail->mail_id }}</td>
                            <td>{{ $mail->from }}</td>
                            <td>{{ $mail->subject }}</td>
                            <td>{{ date('jS M H:i:s', strtotime($mail->timestamp)) }}</td>
                            <td>{{ $mail->is_read ? 'Yes' : 'No' }}</td>
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
        document.addEventListener('DOMContentLoaded', () => {
            window.dataTable('#inbox');
        });
    </script>
@endsection
