<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $code_verifier = "some_random_string";

        $encoded = base64_encode(hash('sha256', $code_verifier, true));

        $codeChallenge = strtr(rtrim($encoded, '='), '+/', '-_');

        dd($encoded, $codeChallenge);
    }
}
