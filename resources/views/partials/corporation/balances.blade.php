<div class="row mt-3">
    <div class="col-12 d-flex align-items-center justify-content-between">
        <small class="text-muted">(Total Balance: <strong>{{ number_format($finances['total'], 2) }} ISK)</strong></small>
    </div>
</div>
<div class="row">
    @if(!empty($finances['balances']))
        @foreach($finances['balances'] as $division)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3">
                <div class="card p-0 bg-transparent border-0">
                    <div class="card-body">
                        <h5>{{ $division->name }}</h5>
                        <span class="{{ $division->balance > 25000000 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($division->balance, 0) }} ISK
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
