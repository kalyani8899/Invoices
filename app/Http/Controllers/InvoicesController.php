<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Invoice;
use App\InvoicesItem;
use App\CustomersField;
class InvoicesController extends Controller
{
    public function create(Request $request)
    {
        $customer=Customer::find($request->customer_id);
        $tax=20;
        $products=Product::all();
        return view('invoices.create',compact('customer','products','tax'));
    }
    public function store(Request $request)
    {
        // $customer= Customer::create($request->customer);
        $invoice = Invoice::create($request->invoice);
        for ($i=0; $i < count($request->product); $i++) {
            if (isset($request->qty[$i]) && isset($request->price[$i])) {
                InvoicesItem::create([
                    'invoice_id' => $invoice->id,
                    'name' => $request->product[$i],
                    'quantity' => $request->qty[$i],
                    'price' => $request->price[$i]
                ]);
            }
        }

        return redirect()->route('home');
        // for($i=0; $i<count($request->customer_fields);$i++)
        // {
        //     if (isset($request->customer_fields[$i]['field_key']) && isset($request->customer_fields[$i]['field_value']))
        //     {
        //         CustomersField::create([
        //             'customer_id'=> $customer->id,
        //             'field_key'=>$request->customer_fields[$i]['field_key'],
        //             'field_value'=>$request->customer_fields[$i]['field_value'],
        //         ]);
        //     }
        // }
        return 'to be continued';
    }
    public function show($invoice_id)
    {
        $invoice=Invoice::find($invoice_id);
        return view('invoices.show',compact('invoice'));
    }
    public function download($invoice_id)
    {
        $invoice=Invoice::find($invoice_id);
        $pdf     = \PDF::loadView('invoices.pdf', compact('invoice'));

        return $pdf->stream('invoice.pdf');
    }
}
