<div id="haulage-calculator">
    <div class="row pb-3">
        <div class="col-12">
            <i class="text-warning fas fa-exclamation-circle"></i> <small>Cargo size limited to 200,000m<sub>3</sub>, Collateral value limited to 2 billion ISK</small>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="collateral">Collateral</label>
            <input type="text" id="collateral" class="form-control" tabindex="1" placeholder="Collateral">
        </div>
        <div class="col">
            <label for="cost">Cost</label>
            <input type="text" id="cost" class="form-control" tabindex="-1" readonly>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <label for="jumps">Jumps</label>
            <input type="text" id="jumps" class="form-control" tabindex="2" placeholder="# of Jumps">
        </div>
        <div class="col">
            <label for="cost_per_jump">Cost per Jump</label>
            <input type="text" id="cost_per_jump" class="form-control" tabindex="-1" readonly>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 d-flex align-items-center">
            <div class="col-4">
                <input class="form-checkbox" type="checkbox" tabindex="3" id="rush">
                <label class="small ms-1" for="rush">Rush Delivery</label>
            </div>
            <div class="col-4">
                <input class="form-checkbox" type="checkbox" tabindex="4" id="lowsec">
                <label class="small ms-1" for="rush">Through Lowsec</label>
            </div>
            <div class="col-4">
                <button class="btn btn-outline-light" id="calculate" type="button">Calculate</button>
            </div>
        </div>
    </div>
</div>

@section('additional_scripts')
@parent()
<script>
document.addEventListener('DOMContentLoaded', () => {
    const collateralField = document.querySelector('#collateral');
    const jumpsField = document.querySelector('#jumps');
    const calculateButton = document.querySelector('#calculate');

    collateralField.addEventListener('keyup', (event) => {
        if (event.which >= 37 && event.which <= 40) return;
        collateralField.value = collateralField.value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });

    jumpsField.addEventListener('keyup', (event) => {
        if (event.which >= 37 && event.which <= 40) return;
        jumpsField.value = jumpsField.value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });

    calculateButton.addEventListener('click', () => calculate());

    function calculate()
    {
        const collateral = collateralField.value.replace(/[^\d\.\-\ ]/g, '');
        const jumps = jumpsField.value.replace(/[^\d\.\-\ ]/g, '');

        let baseColPercentage = 0.005;
        let pickupFee = 0;
        let pricePerJump = 500000;
        let incPerJump = 1.002;
        let pickupCost = 0;
        let cost = 0;
        let baseRate = 0;

        function formatNumber(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        baseRate = pricePerJump * jumps;

        for (i = 1; i < jumps; i++) {
            baseColPercentage += 0.001;
            if (baseColPercentage >= 0.01) { break; }
        }

        pickupFee = collateral * baseColPercentage;
        pickupCost = pickupFee * incPerJump^jumps;
        cost = baseRate + pickupCost;

        if ((collateral * 0.001 * jumps) > cost) {
            cost = collateral * 0.001 * jumps;
        }

        if (cost >= (collateral * 0.5)) {
            cost = collateral * 0.3;
        }

        cost = Math.round(cost / 1000) * 1000;

        if (document.querySelector('#rush').checked) {
            cost = cost * 2;
        }

        if (document.querySelector('#lowsec').checked) {
            cost = cost * 2;
        }

        if (cost > 0) {
            document.querySelector('#cost').value = formatNumber(cost.toFixed(2));
            document.querySelector('#cost_per_jump').value = formatNumber((cost / jumps).toFixed(2));
        }
    }
});
</script>
@endsection
