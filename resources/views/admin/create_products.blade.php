@extends('layouts.app')
@section('content')
    <section class="centered-body">
        <div class="create-container">
            <h2 class="standard-title">Create a new product:</h2>
            @include('partials.form', $form)
        </div>
    </section>
@endsection
