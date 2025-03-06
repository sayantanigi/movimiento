<section class="py-5 border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow paymentbox">
                    <div class="card-body">
                        <h3 class="text-center">Payment</h3>
                        <div class="payemtn-amn mb-3 mt-2 shadow">
                            <h2 class="mb-2 text-white">$<?php echo number_format(@$course->price,2); ?></h2>
                            <!-- <p class="mb-0">Pay To CCRC</p> -->
                            <div class="text-center stripelogo">
                                <img src="<?= base_url() ?>user_assets/images/square-card.png">
                            </div>
                        </div>
                        <h4 class="h5 font-weight-bold">Card Info</h4>
                        <div id="error-message" class="invalid-feedback"></div> 
                        <form action="<?php echo base_url('home/payment/' . @$course_id) ?>" method="post" id="payment-form" enctype="multipart/form-data" onSubmit="return validate();">
                            <input type="hidden" name="course_price" id="course_price" value="<?php echo @$course->price; ?>">
                            <input type="hidden" name="course_id" id="course_id" value="<?php echo @$course_id; ?>">
                            <div class="mb-2">
                                <label>Name on card</label>
                                <input type="text" class="form-control demoInputBox" placeholder="CCRC" readonly id="card-holder-name" value="<?php echo @$usr->fname." ".@$usr->lname; ?>">
                            </div>
                            <!-- <div class="mb-2">
                                <label>Card Number</label>
                                <input type="text" class="form-control demoInputBox"  id="card-number">
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <label>Exp. Month</label>
                                            <input type="text" class="form-control demoInputBox" placeholder="MM" maxlength="5" id="expiry_month">
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <label>Exp. Year</label>
                                            <input type="text" class="form-control demoInputBox" placeholder="YYYY" maxlength="5" id="expiry_year">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-2">
                                    <label>CVV</label>
                                    <input type="text" class="form-control demoInputBox" placeholder="123" maxlength="3" id="cvv">
                                </div>

                            </div> -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- <label>Card Number</label> -->
                                    <div id="card-container"></div>
                                </div>
                            </div>
                            <div class="mb-2 mt-3">
                                <button class="btn btn-success w-100 shadow" type="submit" name="submit" id="card-button" value="Pay Now">Pay Now</button>
                            </div>
                        </form>
                        <div id="payment-status-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <link href="<?php echo base_url('css/app.css') ?>" rel="stylesheet" /> -->
<script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
  <script>
    const appId = 'sandbox-sq0idb-Fgx7cug9TXitRw6CXbiCHg';
    const locationId = 'LEAJYQFQ6V9QQ';

    async function initializeCard(payments) {
      const card = await payments.card();
      await card.attach('#card-container');

      return card;
    }

    async function createPayment(token) {
      var course_id = $("#course_id").val();
      var course_price = $("#course_price").val();

      const body = JSON.stringify({
        locationId,
        sourceId: token,
        course_id: course_id,
        course_price: course_price,
      });

      const paymentResponse = await fetch('<?= base_url('Payment/createPayment') ?>', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body,
      });

      if (paymentResponse.ok) {
        window.setTimeout(function(){
            window.location.href = "<?= base_url('Payment/paymentStatus') ?>";
        }, 1000);
        
        return paymentResponse.json();
      }

      const errorBody = await paymentResponse.text();
      throw new Error(errorBody);
    }

    async function tokenize(paymentMethod) {
      const tokenResult = await paymentMethod.tokenize();
      if (tokenResult.status === 'OK') {
        return tokenResult.token;
      } else {
        let errorMessage = `Tokenization failed with status: ${tokenResult.status}`;
        if (tokenResult.errors) {
          errorMessage += ` and errors: ${JSON.stringify(
            tokenResult.errors
          )}`;
        }

        throw new Error(errorMessage);
      }
    }

    // status is either SUCCESS or FAILURE;
    function displayPaymentResults(status) {
      const statusContainer = document.getElementById(
        'payment-status-container'
      );

      if (status === 'SUCCESS') {
        statusContainer.classList.remove('is-failure');
        statusContainer.classList.add('is-success');

      } else {
        statusContainer.classList.remove('is-success');
        statusContainer.classList.add('is-failure');
      }

      statusContainer.style.visibility = 'visible';
    }

    document.addEventListener('DOMContentLoaded', async function () {
      if (!window.Square) {
        throw new Error('Square.js failed to load properly');
      }

      let payments;
      try {
        payments = window.Square.payments(appId, locationId);
      } catch {
        const statusContainer = document.getElementById(
          'payment-status-container'
        );
        statusContainer.className = 'missing-credentials';
        statusContainer.style.visibility = 'visible';
        return;
      }

      let card;
      try {
        card = await initializeCard(payments);
      } catch (e) {
        console.error('Initializing Card failed', e);
        return;
      }

      // Checkpoint 2.
      async function handlePaymentMethodSubmission(event, paymentMethod) {
        event.preventDefault();

        try {
          // disable the submit button as we await tokenization and make a payment request.
          cardButton.disabled = true;
          const token = await tokenize(paymentMethod);
          const paymentResults = await createPayment(token);
          displayPaymentResults('SUCCESS');

          console.debug('Payment Success', paymentResults);
        } catch (e) {
          cardButton.disabled = false;
          displayPaymentResults('FAILURE');
          console.error(e.message);
        }
      }

      const cardButton = document.getElementById('card-button');
      cardButton.addEventListener('click', async function (event) {
        await handlePaymentMethodSubmission(event, card);
      });
    });
  </script>