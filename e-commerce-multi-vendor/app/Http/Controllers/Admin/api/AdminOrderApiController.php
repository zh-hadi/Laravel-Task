<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\api\OrderAdminApiRequest;
use App\Models\Order;
use App\Models\OrderInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$orders = Order::all();
        $orders = DB::table('orders')
                        ->join('order_invoice','orders.order_invoice_id','=','order_invoice.id')
                        ->select('orders.*','order_invoice.*')
                        ->get();

        if($orders){
            return response()->json($orders);
        }
        else{
            $msg = ['error'=>'No Vendor Found'];
            return response()->json($msg);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderAdminApiRequest $request)
    {
        
        $vendor_id = DB::table('products')
                        ->where('id', $request->product_id)
                        ->pluck('user_id')->first();
        //return Auth::user()->id;
        $order_invoice_attributes = [
            'phone'=> $request->phone,
            'address'=> $request->address,
            'user_id'=> $request->user_id,//Auth::user()->id,
            'vendor_id' => $vendor_id
        ];

        $order_invoice = OrderInvoice::create($order_invoice_attributes);

        $order_attributes = [
            'user_id'=> $request->user_id,
            'vendor_id' => $vendor_id,
            'product_id' => $request->product_id,
            'order_invoice_id' => $order_invoice->id
        ];

        $order = Order::create($order_attributes);

        if($order){
            return response()->json($order);
        }
        else{
            $msg = ['error'=>'No Order Done'];
            return response()->json($msg);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
