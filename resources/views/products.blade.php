@extends('layouts.app')
@section('content')
    <section class="centered-body">
        <div class="shoe-table container">
            @foreach ($data ?? [] as $catalog_item)
                <div class="shoe-outer">
                    <div class="shoe-container">
                        <img src="{{ $catalog_item->image }}">
                        <p class="shoe-name">{{ $catalog_item->name }}</p>
                        <p class="price">{{ $catalog_item->price }}€</p>
                        @if (\Illuminate\Support\Facades\Auth::user())
                            {{ $catalog_item->cart_form }}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
