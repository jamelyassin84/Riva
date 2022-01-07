<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class FlagController extends Controller
{
    public function flag($iso)
    {

        $client = new Client();

        $country = strtolower($iso);

        $url = 'https://flagcdn.com/16x12/' . $country . '.png';

        $response = $client->get($url);

        return $response;
    }
}
