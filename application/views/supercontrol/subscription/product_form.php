<?php
//print_r($price);die();
require 'vendor/autoload.php';
require_once APPPATH."third_party/stripe/init.php";
// \Stripe\Stripe::setApiKey('sk_test_51PMX1GK1Euj0OQwTx1jdmG0dBNTBDThgrYFeWI1kQ7WUx2Hdv41hDbY1NRGoGTERB2Yv9ZmIcyWXh7Sch12UX2c500DDt3DUdI');

\Stripe\Stripe::setApiKey('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');

$checkout_session = \Stripe\Checkout\Session::create([
    'mode' => 'subscription',
    'success_url' => base_url('supercontrol/subscription/thank_you/{CHECKOUT_SESSION_ID}'),
    'cancel_url' => base_url('subscription'),
    'line_items' => [[
        'price' => $amount,
        'quantity' => 1,
        'description' => $productName,
    ]],
    'subscription_data' => [
      'trial_settings' => ['end_behavior' => ['missing_payment_method' => 'cancel']],
      //'trial_period_days' => 15,
    ],
    'payment_method_collection' => 'always',
    'phone_number_collection' => [
        'enabled' => true,
    ],
    'billing_address_collection' => 'required',
    // 'subscription_data' => [
    //     'trial_end' => strtotime('+16 days'), // Set trial period (e.g., 14 days)
    // ],
]);

$session = \Stripe\Checkout\Session::retrieve($checkout_session['id']);
?>
<head>
<title>Stripe Subscription Checkout</title>
<script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<script type="text/javascript">
    // var stripe = Stripe('pk_test_51PMX1GK1Euj0OQwTPMwFSOsDxWdbkJI1NknWJGhXnOcy4sngvtAUhJUH61F7DZck4K7rdXCdMFRdDCXt1YmTLveV00v8XRNCjp');
    var stripe = Stripe('pk_live_51PMX1GK1Euj0OQwTi6l4lsGEJBhgM2I0aHyQ71fy1ngZY7tQoNnE4eb10bPXahVXqZ8UtrEDeGwwachzGlaMYsOH00pt6qNH4h');
    var session = "<?php echo $checkout_session['id']; ?>";
    stripe.redirectToCheckout({ sessionId: session }).then(function(result) {
    // If `redirectToCheckout` fails due to a browser or network
    // error, you should display the localized error message to your
    // customer using `error.message`.
        //alert(result);
        if (result.error) {
            alert(result.error.message);
        }
    })
    .catch(function(error) {
        console.error('Error:', error);
    });
</script>
</body>
