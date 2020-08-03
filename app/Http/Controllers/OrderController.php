<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderStatusRequest;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        foreach (Order::all() as $order) {
            switch ($order->status) {
                case Order::STATUS_SUBMITTED:
                    $status_string = 'Submitted';
                    break;
                case Order::STATUS_SHIPPED:
                    $status_string = 'Shipped';
                    break;
                case Order::STATUS_DELIVERED:
                    $status_string = 'Delivered';
                    break;
                case Order::STATUS_CANCELLED:
                    $status_string = 'Cancelled';
                    break;
            }

            $orders[$order->id] = [
                'id' => $order->id,
                'user' => User::findOrFail($order->user_id)->email,
                'total_price' => $order->total_price. ' €',
                'status' => $status_string,
                'order_date' => $order->order_date,
                'view' => view('components.misc.link', [
                    'class' => 'view-alink',
                    'link' => route('order.edit', ['order' => $order->id]),
                    'content' => 'View'
                ]),
            ];
        }
        return view('./admin/orders', ['list' => $orders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(OrderRequest $request)
    {
        $order = new Order($request->validated());
        $order->save();
        return redirect(\route('products.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $order_info[] = [
            'id' => $order->id,
            'user' => User::findOrFail($order->user_id)->email,
            'total_price' => $order->total_price. ' €',
            'order_date' => $order->order_date,
        ];

        return view('./admin/order_view', [
            'data' => $order_info,
            'form' => view('partials/form', [
                'attr' => [
                    'action' => \route('order.update', $id),
                    'method' => 'POST',
                    'class' => 'products-form',
                    'id' => 'order-form',
                ],
                'fields' => [
                    '_method' => [
                        'type' => 'hidden',
                        'value' => 'PUT'
                    ],
                    'status' => [
                        'type' => 'select',
                        'value' => $order->status,
                        'options' => [
                            Order::STATUS_SUBMITTED => 'Submitted',
                            Order::STATUS_SHIPPED => 'Shipped',
                            Order::STATUS_DELIVERED => 'Delivered',
                            Order::STATUS_CANCELLED => 'Cancelled',
                        ]
                    ]
                ],
                'buttons' => [
                    'action' => [
                        'title' => 'Confirm changes',
                        'extra' => [
                            'attr' => [
                                'class' => 'standard-button'
                            ]
                        ]
                    ]
                ]
            ])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(OrderStatusRequest $request, $id)
    {
        $order = Order::find($id);
        $order->update([
            'status' => $request->get('status'),
        ]);

        $order->save();
        return redirect(\route('order.index'));
    }
}
