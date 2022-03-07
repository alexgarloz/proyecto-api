<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturasController extends Controller
{
    public function create(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET', '')
            );

            /* then create your invoice item */
            $invoice_item = $stripe->invoiceItems->create([
                'customer' => Auth::user()->stripe_id,
                'price' => 'price_1JQWUfEQiIqX711dzBW1OyY9',
                'customer_address' => [
                    "city" => "ori",
                    "country" => "ES",
                    "line1" => "Calle prueba nueva",
                    "line2" => null,
                    "postal_code" => "04532",
                    "state" => "A"
                ]
            ]);

            /* create an invoice for the associated user */
            $invoice = $stripe->invoices->create([
                'customer' => Auth::user()->stripe_id
            ]);

            /* finalize your invoice */
            $i = $stripe->invoices->finalizeInvoice(
                $invoice->id,
                []
            );

            /* here is your invoice link */
            $link = $i->hosted_invoice_url;

            return response()->json([
                'success' => true,
                'link' => $link
            ], 200);
        } catch (\Exception $e) {
           // Log::error('PaymentController@createStripeInvoiceLink: ' . $e->getMessage());
            return response()->json(['state' => 'fail', 'error' => 'Something went wrong: ' . $e->getMessage()], 401);
        }
    }
}
