@extends('layouts.app')
@section('content')
    <section class="centered-body">
        <div class="table-container">
            <h2 class="standard-title">Current Order:</h2>
            @table([
            'table_id' => 'cart-list',
            'thead' => [
            'ID',
            'User (Email)',
            'Total Sum',
            'Order Date'
            ],
            'tbody' => $data
            ])
            <div class="cart-util">
                <h2 class="secondary-title">Status:</h2>
                {!! $form !!}
            </div>
        </div>
    </section>
@endsection
