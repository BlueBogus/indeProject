@extends('layouts.app')

@section('content')
    <section class="bg-shoe">
        <div class="container title-center">
            <h1 class="text-white home-title">Best shoe store in the world or something</h1>
            <h4 class="text-white"><a class="title-link" href="{{route('products.index')}}">See our products</a></h4>
        </div>
    </section>
@endsection
