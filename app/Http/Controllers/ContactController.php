<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact', [
            'contact_info' => [
                'phone_number' => 1948403238,
                'email' => 'shoeBois@gSpot.com',
                'address' => '47 Swamp st., Wakanda'
            ],
            'map_embed' => [
                'source' => 'https://www.google.com/maps/embed/v1/place?q=Čigonų+g.&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8'
            ]
        ]);
    }
}
