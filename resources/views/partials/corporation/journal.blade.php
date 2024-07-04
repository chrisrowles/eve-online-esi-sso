@section('additional_styles')
    @parent
    <style>
        select#finance-division-filter {
            width: 160px;
            display: inline-block;
        }
    </style>
@endsection

<div class="row mt-4">
    <div class="col-12 d-flex align-items-center justify-content-between">
        <h2>Transactions Journal</h2>
        <small class="text-muted">(Outstanding: {{ 1 }})</small>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card p-2 shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 pb-4 d-flex align-items-center justify-content-between">
                        <form action="{{ route('corporation.finances.update') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success text-white" type="submit" id="update_finances"
                                    title="Refresh wallet transactions from the ESI">
                                <i class="fas fa-redo-alt"></i>
                                <span class="ms-1 small">Fetch transactions from ESI</span>
                            </button>
                        </form>
                    </div>
                </div>
                <table id="journal" class="table table-sm table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ESI ID</th>
                        <th scope="col">Division</th>
                        <th scope="col">Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Balance</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($finances['journal'] as $row)
                        <tr>
                            <td>{{ $row->journal_id }}</td>
                            <td>{{ $row->division->division_name }}</td>
                            <td>
                                                <span class="tool" data-tip="{{ $row->description }}">
                                                    {{ ucwords(str_replace("_", " ", $row->ref_type)) }}
                                                </span>
                            </td>
                            <td>{{ date('jS M H:i:s', strtotime($row->created_at)) }}</td>
                            <td class="alert-{{ $row->amount > 0 ? 'success' : 'danger' }}">
                                {{ number_format($row->amount, 2) }} ISK
                            </td>
                            <td>{{ number_format($row->balance, 2) }} ISK</td>
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
            window.dataTable('#journal');
        });
    </script>
@endsection
