<?php

namespace App\Http\Controllers;

use App\Models\Roti;
use Illuminate\Http\Request;

class RotiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return Roti::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'nama' => 'required',
        'deskripsi' => 'required',
        'harga' => 'required|numeric',
    ]);
    return Roti::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Roti $roti)
    {
          return $roti;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roti $roti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roti $roti)
    {
        $roti->update($request->all());
        return $roti;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(Roti $roti)
    {
        $roti->delete();
    return response()->json(['message' => 'Deleted']);
    }
}
