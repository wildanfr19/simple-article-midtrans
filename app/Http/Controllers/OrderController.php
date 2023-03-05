<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Auth;
class OrderController extends Controller
{
    public function orderCheckout($id)
    {
        $data = \DB::table('artikel')->where('id', $id)->first();
        return view('artikel.guestdash.orders.index', compact('data'));
    }
    public function bayar(Request $request)
    {
        // $request->request->add([
        //     'name'=> Auth::user()->name,
        //     'artikel_id'=>$request->id,
        //     'total_price' => 30000, 'status'=> 'Unpaid'
        // ]);
        $order = DB::table('orders')->insert([
            'name'=> Auth::user()->name,
            'artikel_id'=>$request->id_artikel,
            'total_price' => 30000, 
            'status'=> 'Unpaid'
        ]);
        // ])
        $artikel = \DB::table('artikel')->where('id', $request->id)->first();
        $judul = $artikel->judul;
        
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' =>  $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('artikel.guestdash.orders.checkout',compact('snapToken','order','judul'));
    }

    public function callback(Request $request)
    {
        // dd($request->order_id);
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", 
            $request->order_id.$request->status_code.$request->gross_amount.$serverKey
        );
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $order = Order::find($request->order_id);
                $order->update([
                    'status'=> 'Paid'
                ]);
            }
        }
    }
    public function invoice($id)
    {
        $order = Order::find($id);
        return view('artikel.guestdash.orders.invoice', compact('order'));
    }
}
