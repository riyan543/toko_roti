<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Roti;
use Illuminate\Http\Request;

class RotiApiController extends Controller
{
     public function index()
    {
        $rotis = Roti::all();

     return response()->json($rotis);


        
    }
}
