// This is sample.
(function( $ ) {

  $( '.ntsfoodcouponform' ).on( 'submit', function( e ) {
      e.preventDefault();

      var msg = $("#employee_id").val();
      var nonce = $("#requeest_coupon_msg").val();


      jQuery.post( ntsfood_endpoints.foodcoupon_endpoint, { message: msg, nonce: nonce }, function(response){
        console.log(response);
      });
  })

})( jQuery );