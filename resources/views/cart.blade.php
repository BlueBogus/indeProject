@extends('layouts.app')
@section('content')
    <section class="centered-body">
        <div class="table-container">
            <h2 class="standard-title">Items in Cart:</h2>
            @table([
                'table_id' => 'cart-list',
                'thead' => [
                    'Name',
                    'Price',
                    ''
                ],
                'tbody' => $list
            ])
            <div class="cart-util">
                @if($list != [])
                    <h2 class="secondary-title">Total price: {{ $sum }} €</h2>
                    {!! $action !!}
                @endif
            </div>
        </div>
    </section>
@endsection
