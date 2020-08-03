@extends('layouts.app')
@section('content')
    <section class="centered-body">
        <div class="table-container">
            <h2 class="standard-title">Current product list:</h2>
            @table([
                'table_id' => 'product-list',
                'thead' => [
                    'Name',
                    'Price',
                    'ID',
                    'Actions',
                    ''
                ],
                'tbody' => $data
            ])
        </div>
    </section>
@endsection
