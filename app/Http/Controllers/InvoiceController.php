<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class InvoiceController extends Controller
{
  // Here we create the function admin()
  public function admin() {
    $invoices = new Collection; // Here we use a new Collection and we assign it to the variable $invoices.
    if (auth()->user()->stripe_id) { // Next we check if the user has been subscribed to any plan..
      $invoices = auth()->user()->invoices(); // Then $invoices is = to invoices().
    }
    // Next we return the view invoices/admin. Then using the function compact we pass the invoices.
    return view('invoices.admin', compact('invoices'));
  }

  // Next we create the function download()
  public function download($id) {
    // Then, we do a return using the function downloadInvoice() were we pass in the $id
    // and other parameters inside an array like vendor and product.
    return request()->user()->downloadInvoice($id, [
      "vendor" => "Learn Web Code",
      "product" => ("Subscription to the platform")
    ]);
  }
}
