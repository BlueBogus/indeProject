@extends('layouts.app')
@section('content')
    <section class="centered-body">
        <div class="table-container">
            <h2 class="standard-title">All Orders:</h2>
            @table([
            'table_id' => 'cart-list',
            'thead' => [
            'ID',
            'User (Email)',
            'Total Sum',
            'Status',
            'Order Date',
            ''
            ],
            'tbody' => $list
            ])
        </div>
    </section>
@endsection
