<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
  public function __construct() {
  $this->middleware(function($request, $next) {
    if ( auth()->user()->subscribed('LearnToCode') ) { // First we check if the user is subscribed to the plan.
      // Next we send a message using the flash(9 function.)
      flash()->warning('Warning - You are currently subscribed to another plan!');
      return redirect('/home'); // Then we redirect to the root.
    }
    return $next($request); // Otherwise we let the user to enter and access the plan and processSubscription functions.
  })
  // We do that here with the function only().
  ->only(['plans', 'processSubscription']);
}

// Here we create the function plans() for the different plans in the platform.
public function plans() {
  return view('subscriptions.plans'); // Here we return the view subscriptions.plans
  }

  // Next we create the function that will process the subscription processSubscription().
  public function processSubscription() {
    // First we place a variable (stripeToken) this will come via Request
    // and we will assign it to the $token variable. Stripe will send this details.
    $token = request('stripeToken');
    // Next we place all the action inside a try catch
    try {
    if ( \request()->has('coupon')) { // Here we check if the request has a coupon....
      // it there is a coupon, then using the object request we access to the user and add
      // a new subscription inside the group 'LearnToCode' and with the type of type.
      \request()->user()->newSubscription('LearnToCode', \request('type'))
        // Next we use the function withCoupon() and we pass the request 'coupon' Then
        // with the function create() we create the subscription passing the token from stripe.
        ->withCoupon(\request('coupon'))->create($token);
    } else { // Otherwise we do the same as above but this time withouth the function withCoupon().
      \request()->user()->newSubscription('LearnToCode', \request('type'))
                ->create($token);
    }
      // If the subscription has been create we send a success message using the flash() function.
      flash()->success('Success! - Your subscription has been created!');
      return redirect(route('subscriptions.admin')); // Finally we return the view subscriptions/admin.

    } catch (\Exception $exception) { // In case of error we send the message with the error message.
      flash()->error('Error - That coupon does not exist...');
      return back(); // Finally we return back to the page.
    }
  }

  // Next we create the function admin().
  public function admin() {
  $subscriptions = auth()->user()->subscriptions;// Here we can access to the user subscriptions.
  // Then we return the view subscriptions/admin
  return view('subscriptions.admin', compact('subscriptions'));
  }

  //Here we will define the resume() method to resume the subscription.
  public function resume() {
  $subscription = \request()->user()->subscription(\request('plan'));
  if ($subscription->cancelled() && $subscription->onGracePeriod()) {
    \request()->user()->subscription(\request('plan'))->resume();

    // Then we show a message informing that the subscription plan has been resumed.
    flash()->success('Success! - You have resumed your subscription!');
    // Finally we return back.
    return back();
  }
  return back();
  }

  //Here we will define the cancel() method to cancel the subscription.
  public function cancel() {
  auth()->user()->subscription(\request('plan'))->cancel();

    // Then we show a message informing that the subscription plan has been cancelled.
    flash()->success('Success! - Your subscription has been canceled!');
    // Finally we return back to the place where we started.
    return back();
  }
}
