<?php

namespace Modules\SalesReturn\Http\Controllers;

use Modules\SalesReturn\DataTables\SaleReturnsDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\SalesReturn\Entities\SaleReturn;
use Modules\SalesReturn\Entities\SaleReturnDetail;
use Modules\SalesReturn\Entities\SaleReturnPayment;
use Gloudemans\Shoppingcart\Facades\Cart;
// Import the correct modular entities
use Modules\People\Entities\Customer;
use Modules\Product\Entities\Product;

class SalesReturnController extends Controller
{
    public function index(SaleReturnsDataTable $dataTable) {
        return $dataTable->render('salesreturn::index');
    }

    public function create() {
        Cart::instance('sale_return')->destroy();

        return view('salesreturn::create');
    }

    public function store(Request $request) {
        DB::transaction(function () use ($request) {
            $due_amount = $request->total_amount - $request->paid_amount;

            if ($due_amount == $request->total_amount) {
                $payment_status = 'Unpaid';
            } elseif ($due_amount > 0) {
                $payment_status = 'Partial';
            } else {
                $payment_status = 'Paid';
            }

            $reference = 'SLRN-' . sprintf('%05d', (SaleReturn::max('id') + 1));

            // Fetch customer from the People Module
            $customer = Customer::findOrFail($request->customer_id);

            $sale_return = SaleReturn::create([
                'date' => $request->date,
                'customer_id' => $request->customer_id,
                'customer_name' => $customer->customer_name,
                'tax_percentage' => $request->tax_percentage,
                'discount_percentage' => $request->discount_percentage,
                'shipping_amount' => (int) round($request->shipping_amount * 100),
                'paid_amount' => (int) round($request->paid_amount * 100),
                'total_amount' => (int) round($request->total_amount * 100),
                'due_amount' => (int) round($due_amount * 100),
                'status' => $request->status,
                'payment_status' => $payment_status,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
                'tax_amount' => (int) round(Cart::instance('sale_return')->tax() * 100),
                'discount_amount' => (int) round(Cart::instance('sale_return')->discount() * 100),
                'reference' => $reference,
            ]);

            foreach (Cart::instance('sale_return')->content() as $cart_item) {
                SaleReturnDetail::create([
                    'sale_return_id' => $sale_return->id,
                    'product_id' => $cart_item->id,
                    'product_name' => $cart_item->name,
                    'product_code' => $cart_item->options->code,
                    'quantity' => $cart_item->qty,
                    // Fixes SQL Server "nvarchar to int" conversion error
                    'price' => (int) round($cart_item->price * 100),
                    'unit_price' => (int) round($cart_item->options->unit_price * 100),
                    'sub_total' => (int) round($cart_item->options->sub_total * 100),
                    'product_discount_amount' => (int) round($cart_item->options->product_discount * 100),
                    'product_discount_type' => $cart_item->options->product_discount_type,
                    'product_tax_amount' => (int) round($cart_item->options->product_tax * 100),
                ]);

                if ($request->status == 'Completed') {
                    $product = Product::findOrFail($cart_item->id);
                    $product->update([
                        'product_quantity' => $product->product_quantity + $cart_item->qty
                    ]);
                }
            }

            if ($sale_return->paid_amount > 0) {
                SaleReturnPayment::create([
                    'date' => $request->date,
                    'reference' => 'INV/' . $sale_return->reference,
                    'amount' => $sale_return->paid_amount,
                    'sale_return_id' => $sale_return->id,
                    'payment_method' => $request->payment_method
                ]);
            }

            Cart::instance('sale_return')->destroy();
        });

        return redirect()->route('sale-returns.index');
    }
}