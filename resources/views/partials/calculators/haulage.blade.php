<div id="haulage-calculator">
    <div class="row pb-3">
        <div class="col-12">
            <i class="text-warning fas fa-exclamation-circle"></i> <small>Cargo size limited to 200,000m<sub>3</sub>, Collateral value limited to 2 billion ISK</small>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <label for="collateral">Collateral</label>
            <input type="text" id="collateral" class="form-control" tabindex="1" placeholder="Collateral">
        </div>
        <div class="col">
            <label for="reward">Cost</label>
            <input type="text" id="reward" class="form-control" tabindex="-1" readonly>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="jumps">Jumps</label>
            <input type="text" id="jumps" class="form-control" tabindex="2" placeholder="# of Jumps">
        </div>
        <div class="col">
            <label for="reward_ipj">Cost per Jump</label>
            <input type="text" id="reward_ipj" class="form-control" tabindex="-1" readonly>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col-12 d-flex align-items-center">
            <div class="col-6">
                <div class="form-row">
                    <div class="col">
                        <input type="checkbox" tabindex="3" id="rush">
                        <label for="rush">Rush Delivery</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input type="checkbox" tabindex="4" id="lowsec">
                        <label for="lowsec">Through Lowsec</label>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <button class="btn btn-outline-light" id="calculate" type="button">Calculate</button>
                <a class="ml-2 text-light" href="{{ route('haulage') }}"><i class="fas fa-question-circle"></i> Instructions</a>
            </div>
        </div>
    </div>
</div>

@section('additional_scripts')
@parent()
<script>
$(document).ready(function(){
    let clipboard_copy = "";

    $('#collateral').keyup(function(event) {
        if(event.which >= 37 && event.which <= 40) return;
        $(this).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });


    $('#jumps').keyup(function(event) {
        if(event.which >= 37 && event.which <= 40) return;
        $(this).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });

    $('#calculate').click(function() {
        calculate();
    });

    function calculate()
    {
        let collateral = $('#collateral').val();
        collateral = collateral.replace(/[^\d\.\-\ ]/g, '');

        let jumps = $('#jumps').val();
        jumps = jumps.replace(/[^\d\.\-\ ]/g, '');

        let baseColPercentage = 0.005;
        let pickupFee = 0;
        let pricePerJump = 300000;
        let incPerJump = 1.002;
        let pickupReward = 0;
        let reward = 0;
        let baseRate = 0;

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        baseRate = pricePerJump * jumps;

        for (i = 1; i < jumps; i++) {
            baseColPercentage += 0.001;
            if (baseColPercentage >= 0.01) { break; }
        }

        pickupFee = collateral * baseColPercentage;
        pickupReward = pickupFee * incPerJump^jumps;
        reward = baseRate + pickupReward;

        if ((collateral * 0.001 * jumps) > reward) {
            reward = collateral * 0.001 * jumps;
        }

        if (reward >= (collateral * 0.5)) {
            reward = collateral * 0.3;
        }

        reward = Math.round(reward / 1000) * 1000;

        if ($('#rush').prop('checked')) {
            reward = reward * 2;
        }

        if ($('#lowsec').prop('checked')) {
            reward = reward * 2;
        }

        if (reward > 0) {
            $('#reward_label').addClass('active');
            $('#reward_ipj_label').addClass('active');
            $('#reward').val(numberWithCommas(reward.toFixed(2)));

            let ipj = reward / jumps;
            ipj = ipj.toFixed(2);

            $('#reward_ipj').val(numberWithCommas(ipj));

            clipboard_copy = reward;
        }
    }
});
</script>
@endsection
