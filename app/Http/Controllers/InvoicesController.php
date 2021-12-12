<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoicesController extends Controller
{
    public function generate() {
        $customer = new Buyer([
            'name'          => Auth::user()->name,
            'custom_fields' => [
                'email' => Auth::user()->email,
            ],
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item);

        return $invoice->stream();
    }
}
