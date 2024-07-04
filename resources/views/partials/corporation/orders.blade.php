@section('additional_styles')
    <style>
        select#order-division-filter {
            width: 160px;
            display: inline-block;
        }
    </style>
@endsection

<div class="row mt-4">
    <div class="col-12 d-flex align-items-center justify-content-between">
        <h2>Order History</h2>
        <small class="text-muted">(Total: {{ 173 }})</small>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card p-2 shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 pb-4 d-flex align-items-center justify-content-between">
                        <form action="{{ route('corporation.orders.update') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-secondary" type="submit" id="update_orders">Update History</button>
                        </form>
                    </div>
                </div>
                <table id="orders" class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">ESI ID</th>
                        <th scope="col">Division</th>
                        <th scope="col">Buy/Sell</th>
                        <th scope="col">Item</th>
                        <th scope="col">Price</th>
                        <th scope="col">Volume</th>
                        <th scope="col">Created On</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($finances['orders'] as $row)
                        <tr>
                            <td>{{ $row->order_id }}</td>
                            <td>{{ $row->division->division_name ?? 'N/A' }}</td>
                            <td>{{ $row->is_buy_order === 1 ? 'Buy' : 'Sell' }}</td>
                            <td>{{ $row->type_id }}</td>
                            <td>{{ number_format($row->price, 2) }} ISK</td>
                            <td>{{ $row->volume_total }}</td>
                            <td>{{ date('jS M H:i:s', strtotime($row->created_at)) }}</td>
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
            window.dataTable('#orders');
        });
    </script>
@endsection
