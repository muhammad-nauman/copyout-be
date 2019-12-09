<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rider;
use App\Order;
use App\OrderDetail;
use App\Vendor;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_role', request('type'))->get();

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->except('vendor_data'));
        if(request('user_role') === User::VENDOR) {
            $user->vendor()->save(new Vendor($request->vendor_data));
            for($i = 0; $i < 3; $i++) {
                $newUser = factory(User::class)->create([
                    'user_role' => 2,
                ]);
                $user->vendor->riders()->save((factory(Rider::class)->make([
                    'user_id' => $newUser->id, 
                ])));
            }
            $newCustomers = factory(User::class, 10)->create([
                'user_role' => 3,
            ]);
            $newCustomers->map(function($single) use ($user) {
                $orders = $single->orders()->saveMany(factory(Order::class, rand(5, 15))->make([
                    'vendor_id' => $user->vendor->id,
                ]));
                $orders->map(function($order) {
                    $order->order_details()->saveMany(factory(OrderDetail::class, rand(1, 5))->make());
                });
            });
        }
        return response()->json([
            'success' => true,
            'data' => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->body());
        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'success' => true,
        ], 200);
    }
}
