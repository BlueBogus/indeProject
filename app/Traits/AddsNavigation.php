<?php


namespace App\Traits;
use App\Item;
use App\UserRole;
use Illuminate\Support\Facades\Auth;

trait AddsNavigation
{
    public function addNavigation()
    {
        $this->middleware(function ($request, $next) {
            $nav = [
                'links' => [
                    'left' => [
                        route('products.index') => __('Products'),
                        route('contact') => __('Contact'),
                    ]
                ]
            ];

            if (Auth::user()) {
                $nav['dropdown'] = [
                    'title' => Auth::user()->name,
                    'links' => [
                        route('home') => __('Home'),
                        route('logout') => __('Log out')
                    ]
                ];

                $item_count = 0;
                foreach (Item::all() as $item) {
                    if ($item->user_id == Auth::user()->id) {
                        $item_count++;
                    }
                }

                $nav['links']['right'][route('item.index')] = __("Cart ({$item_count})");

                if (Auth::user()->role_id == UserRole::ROLE_ADMIN) {
                    $nav['dropdown']['links'][route('products.create')] = __('Create Products');
                    $nav['dropdown']['links'][route('products_list')] = __('Product List');
                    $nav['dropdown']['links'][route('order.index')] = __('Orders');
                }

            } else {
                $nav['links']['right'][route('register')] = __('Register');
                $nav['links']['right'][route('login')] = __('Log in');
            }

            \Illuminate\Support\Facades\View::share('nav', $nav);
            return $next($request);
        });
    }
}
