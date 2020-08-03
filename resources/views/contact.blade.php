@extends('layouts.app')
@section('content')
    <section class="centered-body">
        <div class="contact-container">
            <h2 class="standard-title">Ways you can reach us:</h2>
            <div class="contact-info">
                <span class="contact-text">Phone: {{ $contact_info['phone_number'] }}</span>
                <span class="contact-text">Email: {{ $contact_info['email'] }}</span>
                <span class="contact-text">Address: {{ $contact_info['address'] }}</span>
            </div>
            <div class="map-container">
                <div id="gmapdisplay">
                    <iframe class="islewalk-iframe" frameborder="0" src="{{ $map_embed['source'] }}">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
