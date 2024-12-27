<?php

namespace App\Http\Controllers;

class LinkController extends Controller
{
    public function encoder()
    {
        return view('encode-link');
    }

    public function decoder()
    {
        return view('decode-link');
    }
}