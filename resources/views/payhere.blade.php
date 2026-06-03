<form method="post"
action="https://sandbox.payhere.lk/pay/checkout">

<input type="hidden"
name="merchant_id"
value="{{ $merchant_id }}">

<input type="hidden"
name="return_url"
value="https://rental-production-4a15.up.railway.app/payment/success">

<input type="hidden"
name="cancel_url"
value="https://rental-production-4a15.up.railway.app/payment/cancel">

<input type="hidden"
name="notify_url"
value="https://rental-production-4a15.up.railway.app/payhere/notify">

<input hidden
name="order_id"
value="{{ $orderId }}">

<input hidden
name="items"
value="Vehicle Booking">

<input hidden
name="currency"
value="{{ $currency }}">

<input hidden
name="amount"
value="{{ $amount }}">

<input hidden
name="first_name"
value="{{ $request->customer_name }}">

<input hidden
name="email"
value="{{ $request->email }}">

<input hidden
name="phone"
value="{{ $request->phone }}">

<input hidden
name="hash"
value="{{ $hash }}">

</form>

<script>

document.forms[0].submit();

</script>