<?php

namespace App\Http\Controllers;

use App\Models\CardHolder;
use App\Traits\WithResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\confirm;

class CardHolderController extends Controller
{
    use WithResponse;
    /**
     * Display a listing of the resource.
     */
    public $header = "Users";

    public $rules = [
        "name" => "required|min:3",
        "age" => "required|min:1|integer",
        "email" => "required|email",
        "address" => "required|min:10",
        "contact" => "required|min:10"
    ];

    public function index(Request $request)
    {
        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home", "Users", "List"];
        $data["rows"] = CardHolder::all();
        return view("users.list", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home", "Users", "Create"];
        return view("users.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), $this->rules);

        if ($validated->fails()) {

            if($request->ajax())
            return $this->responseFailed("Data could not be validated!",$validated->errors());

            return redirect()->back()
                ->withErrors($validated->errors())
                ->withInput()
                ->with("message", "Data could not be validated!");
        }

        try {
            $createdData = CardHolder::create($request->all());

            if($request->ajax())
            return $this->responseSuccess( $createdData->name . " inserted successfully",$createdData);

            return redirect()->back()
                ->with("message", $createdData->name . " inserted successfully")
                ->withInput();

        } catch (\Throwable $th) {

            if($request->ajax())
            return $this->responseError("Data could not be inserted!. ".$th->getMessage()   );

            return redirect()->back()
                ->with("message", "Data could not be inserted!")
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = CardHolder::find($id);
        return view("users.details", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cardHolder = CardHolder::find($id);

        if (empty($cardHolder)) {
            abort(404);
        }

        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home", "Users", "Edit"];
        $data["user"] = $cardHolder;
        return view("users.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), $this->rules);

        if ($validated->fails()) {
            
            if($request->ajax())
            return $this->responseFailed("Data could not be validated!",$validated->errors());

            return redirect()->back()
                ->withErrors($validated->errors())
                ->withInput()
                ->with("message", "Data couldn't be validated!");
        }

        try {
            $cardHolder = CardHolder::find($id);
            if (!$cardHolder) {
                abort(404);
            }

            $cardHolder->update($request->all());
            if($request->ajax())
            return $this->responseSuccess( $cardHolder->name . " inserted successfully");

            return redirect()->back()
                ->with("message", $cardHolder->name . " updated successfully")
                ->withInput();
        } catch (\Throwable $th) { 

            if ($request->ajax()) {
                return $this->responseError("Data could not be updated! " . $th->getMessage());
            }
    
            return redirect()->back()
                ->with("message", "Data could not be updated!")
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $cardHolder = CardHolder::find($id);
            if ($cardHolder && $cardHolder->delete()) {
                return redirect()->back()
                    ->with("message", "User deleted successfully");
            }
            else {
                if($request->ajax())
                   return $this->responseFailed("Data could not be Deleted!");

                return redirect()->back()
                ->with("message", "User could not be deleted");
            }

          
        } catch (\Throwable $th) {

            if ($request->ajax()) {
                return $this->responseError("Data could not be Deleted! " . $th->getMessage());
            }
            return redirect()->back()
                ->with("message", "Data could not be deleted! " . $th->getMessage());
        }
    }
}
