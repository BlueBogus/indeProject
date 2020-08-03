<?php

namespace App\Http\Controllers;

use App\Item;
use App\Product;
use App\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth')->except('index');
        $this->middleware('role:admin', ['only' => ['admin_list', 'create', 'edit']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->cart_form = view('partials/form', [
                'attr' => [
                    'method' => 'POST',
                    'id' => 'cart-form',
                    'action' => \route('item.store'),
                ],
                'fields' => [
                    'product_id' => [
                        'type' => 'hidden',
                        'value' => $product->id
                    ],
                    'user_id' => [
                        'type' => 'hidden',
                        'value' => Auth::user()->id ?? null
                    ],
                    'status' => [
                        'type' => 'hidden',
                        'value' => Item::STATUS_IN_CART
                    ]
                ],
                'buttons' => [
                    'to_cart' => [
                        'value' => 'to_cart',
                        'title' => 'Add to cart',
                        'extra' => [
                            'attr' => [
                                'class' => 'cart-btn'
                            ]
                        ]
                    ],
                ]
            ]);
        }
        return view('products', ['data' => $products]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin_list()
    {
        $products = Product::all();
        $tbody = [];
        foreach ($products ?? [] as $catalog_item) {
            $tbody[$catalog_item->id] = [
                'name' => $catalog_item->name,
                'price' => $catalog_item->price . ' €',
                'id' => $catalog_item->id,
                'edit' => view('components.misc.link', [
                    'class' => 'edit-alink',
                    'link' => route('products.edit', ['product' => $catalog_item->id]),
                    'content' => 'Edit'
                ]),
                'delete' => view('partials/form', [
                    'attr' => [
                        'action' => route('products.destroy', $catalog_item->id),
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
                            'title' => 'Delete',
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
        return view('./admin/product_list', ['data' => $tbody]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('./admin/create_products', ['form' => [
            'attr' => [
                'action' => \route('products.store'),
                'method' => 'POST',
                'class' => 'products-form',
                'id' => 'create-form',
            ],
            'fields' => [
                'name' => [
                    'label' => 'Name:',
                    'type' => 'text',
                    'extra' => [
                        'attr' => [
                            'class' => 'standard-field'
                        ]
                    ]
                ],
                'image' => [
                    'label' => 'Image URL:',
                    'type' => 'text',
                    'extra' => [
                        'attr' => [
                            'class' => 'standard-field'
                        ]
                    ]
                ],
                'price' => [
                    'label' => 'Price:',
                    'type' => 'number',
                    'extra' => [
                        'attr' => [
                            'class' => 'standard-field'
                        ]
                    ]
                ]
            ],
            'buttons' => [
                'submit' => [
                    'value' => 'submit',
                    'title' => 'Create',
                    'extra' => [
                        'attr' => [
                            'class' => 'standard-button',
                        ]
                    ]
                ]
            ]
        ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ProductRequest $request)
    {
        $product = new Product($request->validated());
        $product->save();
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
        $product = Product::findOrFail($id);
        return view('./admin/edit_products', ['form' => [
            'attr' => [
                'action' => \route('products.update', $id),
                'method' => 'POST',
                'class' => 'products-form',
                'id' => 'edit-form',
            ],
            'fields' => [
                '_method' => [
                    'type' => 'hidden',
                    'value' => 'PUT'
                ],
                'name' => [
                    'label' => 'Name:',
                    'type' => 'text',
                    'value' => $product->name,
                    'extra' => [
                        'attr' => [
                            'class' => 'standard-field'
                        ]
                    ]
                ],
                'image' => [
                    'label' => 'Image URL:',
                    'type' => 'text',
                    'value' => $product->image,
                    'extra' => [
                        'attr' => [
                            'class' => 'standard-field'
                        ]
                    ]
                ],
                'price' => [
                    'label' => 'Price:',
                    'type' => 'number',
                    'value' => $product->price,
                    'extra' => [
                        'attr' => [
                            'class' => 'standard-field'
                        ]
                    ]
                ]
            ],
            'buttons' => [
                'submit' => [
                    'value' => 'submit',
                    'title' => 'Save changes',
                    'extra' => [
                        'attr' => [
                            'class' => 'standard-button',
                        ]
                    ]
                ]
            ]
        ]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update([
            'name' => $request->input('name'),
            'image' => $request->input('image'),
            'price' => $request->input('price'),
        ]);

        $product->save();
        return redirect(\route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     * NOT YET WORKING!
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->destroy($id);

        return redirect()->route('products.index');
    }
}
