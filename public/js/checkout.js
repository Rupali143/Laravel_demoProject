
var stripe = Stripe('pk_test_umCCVM2is5bywwiN4BRvPTGe00HC3kP7ia');
var elements = stripe.elements();

//alert(stripe);
//Stripe.setPublishableKey('pk_test_umCCVM2is5bywwiN4BRvPTGe00HC3kP7ia');

var $form =$('#checkout-form');

$form.submit(function(event)
{
  //  alert($('#cardNumber').val());
    $('#charge-error').addClass('hidden');
    $form.find('button').prop('disable',true);
    stripe.card.createToken({
        number: $('#cardNumber').val(),
        cvc: $('#cardCvc').val(),
        exp_month: $('#expiryMonth').val(),
        exp_year: $('#expiryYear').val(),
        name: $('#fullName').val()

    }, stripeResponseHandler());
    return false;
});

function stripeResponseHandler(status,response){
  if(response.error){
      $('#charge-error').removeClass();
      $('#charge-error').text(response.error.message);
      $form.find('buttton').prop('disabled',false);
  }else{
      var token = response.id;
      alert(token);
      $form.append($('<input type="hidden" name="stripeToken"/>').val(token));
      $form.get(0).submit();
  }
}