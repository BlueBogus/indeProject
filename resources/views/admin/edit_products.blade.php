@extends('layouts.app')
@section('content')
    <section class="centered-body">
        <div class="edit-container">
            <h2 class="standard-title">Edit Current product:</h2>
            @include('partials.form', $form)
        </div>
    </section>
@endsection
