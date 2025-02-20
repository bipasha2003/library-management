<?php

namespace App\Http\Controllers;

use App\Models\CardHolder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $header = "Users";
    public function index(Request $request)
    {
        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home","Users","List"];
        return view("users.list",$data); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home","Users","Create"];
        return view("users.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cardHolder = CardHolder::find($id);
        if(empty($cardHolder))
        abort(404);

        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home","Users","Edit"];
        return view("users.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
