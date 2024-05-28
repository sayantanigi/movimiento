<?php
require 'vendor/autoload.php';
require_once APPPATH."third_party/stripe/init.php";
\Stripe\Stripe::setApiKey('sk_test_51NG6aKFoJzvzntq4UpLTpYCwazUyWiLjTDC2dett0Na0fAQjkqNPCasLo7nCTCisBX5BzRhIfmWO85ihAs4GsloW00PUsvhlau');

$checkout_session = \Stripe\Checkout\Session::create([
    'success_url' => base_url('success/{CHECKOUT_SESSION_ID}'),
    'cancel_url' => base_url('course-list'),
    'payment_method_types' => ['card'],
    'mode' => 'payment',
    'invoice_creation' => ['enabled' => true],
    'line_items' => [['price' => $price_key, 'quantity' => 1]],
]);

$session = \Stripe\Checkout\Session::retrieve($checkout_session['id']);
?>
<head>
<title>Stripe Subscription Checkout</title>
<script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<script type="text/javascript">
    var stripe = Stripe('pk_test_51NG6aKFoJzvzntq4fnZMuARcyeHr6o5DQ6emASeF7YXQnHu89ND6J4rPexrWZvlsHeRiIkGcSeNU29l73lMAch6L005cKBwxM3');
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
