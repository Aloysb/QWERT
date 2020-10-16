<script>
  var stripe = Stripe('pk_live_51HCWUzFkUJgkN5qoYYqvCpKirPu8yMD0gruy1PZM3xQs8SjFPdW7JduugrdUyqzQaneun6J9ko5Xy9cU2vwMHeO000c5VwCLcB');
  let session = <?= $data['session']['session'] ?>;

  //3 months free.
  const CHECKOUT_SESSION_ID = session.id;

    stripe.redirectToCheckout({
      // Make the id field from the Checkout Session creation API response
      // available to this file, so you can provide it as argument here
      // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
      sessionId: CHECKOUT_SESSION_ID
    }).then(function(result) {
      // If `redirectToCheckout` fails due to a browser or network
      // error, display the localized error message to your customer
      // using `result.error.message`.
    });

</script>