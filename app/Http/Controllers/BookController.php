<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Traits\WithResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    use WithResponse;
    /**
     * Display a listing of the resource.
     */
    public $header = "Books";

    public $rules = [
        "name" => "required|min:3",
        "author" => "required|min:3",
        "publisher" => "required|min:3",
        "price" => "required"
    ];

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
        

        try {
            $validated = Validator::make($request->all(), $this->rules);

            if ($validated->fails()) {

                if($request->ajax())
                return $this->responseFailed("Data could not be validated!",$validated->errors());

                return redirect()->back()
                    ->withErrors($validated->errors())
                    ->withInput()
                    ->with("message", "Data could not be validated!");
            }
            /**
             * Create a new book
             */
            $createdData = Book::create($validated->validated());

            /**
             * Create Book Copies
             */
            if(isset($request->no_copies) && !empty(intval($request->no_copies)))
            for($x = 0 ; $x < intval($request->no_copies); $x++)
            {
                $createdData->bookHasCopies()->create(["default_borrow_price" => $request->default_borrow_price]);
            }

            /**
             * Create Prices
             */
            if(isset($request->rent_prices) && !empty($request->rent_prices))
                $createdData->bookHasPrices()->createMany($request->rent_prices);
            


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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);

        if (empty($book)) {
            abort(404);
        }

        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home", "Books", "Edit"];
        $data["book"] = $book;
        return view("books.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = Validator::make($request->all(), $this->rules);

            if ($validated->fails()) {

                if($request->ajax())
                return $this->responseFailed("Data could not be validated!",$validated->errors());

                return redirect()->back()
                    ->withErrors($validated->errors())
                    ->withInput()
                    ->with("message", "Data could not be validated!");
            }
            
            /**
             * Update a  book
             */
            $createdData = Book::find($id);
            $createdData->update($validated->validated());

            /**
             * Update Prices
             */
            if(isset($request->rent_prices) && !empty($request->rent_prices))
            {
                $createdData->bookHasPrices()->delete();
                $createdData->bookHasPrices()->createMany($request->rent_prices);
            }
               
            


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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
