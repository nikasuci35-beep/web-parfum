<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResiController extends Controller
{
    public function index() 
    {
        return view('user.cekresi');
    }

    public function check(Request $request)
    {
        $request->validate([
            'awb' => 'required',
            'courier' => 'required'
        ]);

        $apiKey = env('BINDERBYTE_API_KEY');

        $params = [
            'api_key' => $apiKey,
            'courier' => $request->courier,
            'awb' => $request->awb
        ];

        if ($request->filled('phone')){
            $params['history'] = $request->phone;
        }

        $response = Http::get("https://api.binderbyte.com/v1/track", $params);
        $data = $response->json();

        return redirect()->route('user.cekresi.index')->with('result', $data);
    }
}
