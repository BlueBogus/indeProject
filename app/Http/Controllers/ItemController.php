<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\Product;
use App\Requests\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
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
        $sum = 0;
        foreach (Item::all() as $item) {
            if ($item->user_id == Auth::user()->id) {
                $product = Product::findOrFail($item->product_id);
                $sum += $product->price;
                $cart_items[$item->id] = [
                    'name' => $product->name,
                    'price' => $product->price . ' €',
                    'delete' => view('partials/form', [
                        'attr' => [
                            'action' => route('item.destroy', $item->id),
                            'id' => 'delete-button'
                        ],
                        'fields' => [
                            '_method' => [
                                'type' => 'hidden',
                                'value' => 'DELETE'
                            ],
                        ],
                        'buttons' => [
                            'action' => [
                                'title' => 'Remove',
                                'extra' => [
                                    'attr' => [
                                        'class' => 'delete-btn',
                                    ]
                                ]
                            ],
                        ]
                    ])
                ];
            }
        }
        return view('cart', [
            'list' => $cart_items ?? [],
            'sum' => $sum,
            'action' => view('partials/form', [
                'attr' => [
                    'action' => route('order.store'),
                    'id' => 'order-form'
                ],
                'fields' => [
                    '_method' => [
                        'type' => 'hidden',
                        'value' => 'POST'
                    ],
                    'user_id' => [
                        'type' => 'hidden',
                        'value' => Auth::user()->id
                    ],
                    'total_price' => [
                        'type' => 'hidden',
                        'value' => $sum
                    ],
                    'status' => [
                        'type' => 'hidden',
                        'value' => Order::STATUS_SUBMITTED
                    ],
                    'order_date' => [
                        'type' => 'hidden',
                        'value' => date("Y-m-d H:i:s")
                    ],
                ],
                'buttons' => [
                    'action' => [
                        'title' => 'Place order'
                    ]
                ]
            ])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ItemRequest $request)
    {
        $item = new Item($request->validated());
        $item->save();
        $item->user()->attach($request->validated()['user_id']);
        return redirect(\route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->destroy($id);

        return redirect()->route('item.index');
    }
}
