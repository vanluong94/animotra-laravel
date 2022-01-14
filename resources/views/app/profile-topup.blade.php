@section('pageTitle', 'Profile | Comments' )

@push('headerScripts')
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=USD"></script>
@endpush

<x-profile :user="$user">
    <section>

        <h1 class="h4 text-uppercase fw-bold mb-4">Purchase tokens</h1>

        <x-alert-errors></x-alert-errors>
        <x-alert-success></x-alert-success>

        <form action="{{ route('profile.topup') }}" method="POST" id="topupForm">

            <div class="input-group my-5">

                <span class="input-group-text">Enter tokens amount</span>
                <input type="number" min="1000" class="form-control" id="tokensAmount" name="token_amount" required>
                <span class="input-group-text" style="min-width: 70px">$<span id="priceAmount" class="ms-1">0</span></span>

                <input type="hidden" name="paypal_token" id="paypalToken">

                @csrf

            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-12">
                    <div id="paypal-button-container"></div>
                </div>
            </div>

        </form>

        <script>

            const rate         = {{ config('animotra.token_rate') }}
            const topupForm    = document.getElementById('topupForm');
            const tokensAmount = document.getElementById('tokensAmount');
            const priceAmount  = document.getElementById('priceAmount');
            const paypalToken = document.getElementById('paypalToken');

            tokensAmount.onkeyup = function(){
                let val = parseInt(tokensAmount.value);
                if (val) {
                    priceAmount.innerText = val * rate; 
                } else {
                    priceAmount.innerText = 0;
                }
            }

            paypal.Buttons({
                onInit:  function(data, actions) {
                    actions.disable();
                    actionStatus = actions;
                },
                onClick :  function(){
                    if(!topupForm.checkValidity()){
                        tokensAmount.focus(); 
                        topupForm.reportValidity();
                        actionStatus.disable();
                    }else {
                        actionStatus.enable();
                        console.log('go ahead')
                    }
                },
                createOrder: (data, actions) => {
                    // Set up the transaction
                    return actions.order.create({
                        purchase_units: [
                            {
                                amount: {
                                    value: parseFloat(priceAmount.innerText),
                                },
                            },
                        ],
                        application_context: {
                            shipping_preference: "NO_SHIPPING",
                        },
                    });
                },
                onApprove: (data, actions) => {
                    return actions.order.capture().then((paypalOrder) => {
                        paypalToken.value = paypalOrder.id;
                        topupForm.submit();
                    });
                },
                onCancel: () => {
                    console.log('cancel');
                },
                onError: (err) => {
                    console.log(err);
                },
            }).render('#paypal-button-container');

        </script>
    </section>
</x-profile>