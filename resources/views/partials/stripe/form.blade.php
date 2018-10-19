<!-- Here we create the form that will go to the route to process the subscription -->
<form action="{{ route('subscriptions.process_subscription') }}" method="POST">
  <!-- Here we use the csrf directive to send the token in the petition. -->
    @csrf
    <!-- Next we create an imput for the user to write a coupon code -->
    <input
        class="form-control"
        name="coupon"
        placeholder="{{ ("Do you have a coupon?") }}"
    />

    <!-- Next we create another imput to show the product type -->
    <input type="hidden" name="type" value="{{ $product['type'] }}" />
    <hr />

    <!-- Finally we add here the stripe form -->
    <stripe-form
        stripe_key="{{ config('app.test_variable') }}"
        name="{{ $product['name'] }}"
        amount="{{ $product['amount'] }}"
        description="{{ $product['description'] }}"
    ></stripe-form>
</form>
