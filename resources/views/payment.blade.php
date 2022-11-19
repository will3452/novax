<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <script src="/js/app.js" defer></script>
    <title>Select Payment</title>
    <script>
         async function submit() {
            try {
                console.log('hello world')
                let { data } = await window.axios.post('/pay', { amount: {{$booking->amount_payable}}, description: 'Bus Payment', customername: `{{auth()->user()->name}}`, customeremail: `{{auth()->user()->email}}`, customermobile: {{auth()->user()->mobile}}}) // TODO payment success url
                let { checkouturl, request_id } = data.data

                // create transactions
                let payload = {
                    model_id: {{$booking->id}},
                    model_type: `\App\Models\Booking`,
                    hash: request_id,
                }

                await window.axios.post('/api/transaction', payload)

                window.open(checkouturl, '_blank')
            } catch (err) {
                console.log(err)
            } finally {
                this.gcashButtonLoading = false
            }
        }
    </script>
</head>
<body>
    <h1 class="text-3xl font-bold my-4 text-center uppercase">Select payment</h1>
    <div class="flex justify-center">
        <div class="w-full md:w-1/2">
            <h1 class="text-center text-2xl font-bold bg-green-200 p-4 uppercase">Total Payable : {{ number_format($booking->amount_payable, 2) }} php </h1>
            <a href="#" class="w-full bg-blue-900 text-white p-3 block my-4 text-center font-bold  rounded-full" onclick="submit()">
                Pay with GCASH
            </a>
            <div id="paypal-button-container" ></div>
        </div>
    </div>


    <script src="https://www.paypal.com/sdk/js?client-id=ARv4l18z2mbrbhTZSXSBYkwm-FB6B_JsqnxjLPx4YucjAWXJyTYiZ0piB1Tst7HfDtMtowx5zajuOatI&components=buttons&currency=PHP"></script>
    <script>
        paypal.Buttons({
        style: {
            layout: 'vertical',
            color:  'blue',
            shape:  'pill',
            label:  'pay'
        },
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                    value: {{$booking->amount_payable}}
                    }
                }]
            })
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
                window.location.href = '/paypal/{{$booking->id}}?hashed={{bcrypt($booking->created_at)}}&value={{$booking->created_at}}'
            });
        }
        }).render('#paypal-button-container');
    </script>

</body>
</html>
