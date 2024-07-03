<div class="row mt-3">
    <div class="col-12 d-flex align-items-center justify-content-between">
        <small class="text-muted">(Total Balance: <strong>{{ number_format($finances['total'], 2) }} ISK)</strong></small>
    </div>
</div>
<div class="row text-light">
    @if(!empty($finances['ledger']))
        @foreach($finances['ledger'] as $division)
            <div class="col-12 col-sm-6 col-md-4 mt-3">
                <div class="card p-2 bg-dark filter shadow">
                    <div class="card-body">
                        <h5 class="text-white">{{ $division->name }}</h5>
                        <span class="{{ $division->balance > 25000000 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($division->balance, 0) }} ISK
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
