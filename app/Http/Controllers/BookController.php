<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $header = "Books";

    public function index(Request $request)
    {
        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home","Books","List"];
        return view("books.list",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home","Books","Create"];
        return view("books.create",$data);
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
        //
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
