<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookIssue;
use App\Models\CardHolder;
use Illuminate\Http\Request;
use App\Traits\WithResponse;
use DataTables;

use Illuminate\Support\Facades\Validator;


class BookIssueController extends Controller
{
    use WithResponse;
    public $header = "BookIsuue";
    public $rules = [
        "to_date" => "required",
        "from_date" => "required",
        "total" => "required",
        "paid" => "required",
        "due" => "required",
        "card_holder_id"=>"required",
        "book_ids" => "required"
        
    ];
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home", "Book Issue", "List"];

        $data["rows"] = [];
        if(\request()->ajax()){
            $data = BookIssue::select("*");
            
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = view("components.book_issue.action-buttons",["row" => $row])->render();
                    return $actionBtn;
                })
                ->addColumn('books', function($row){
                    $actionBtn = view("components.book_issue.books",["row" => $row])->render();
                    return $actionBtn;
                   
                })
              
                ->filterColumn('name', function ($query, $keyword) {
                        $query->where('name',"LIKE","%".$keyword."%");
                })
                ->rawColumns(['action'])
                ->toJson();
               
        }

       
        return view("booksIssue.list", $data);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["header"] = $this->header;
        $data["breadcrums"] = ["Home", "BookIssue", "Create"];
        $data["books"]= Book::with("bookHasPrices")->with("bookHasCopies")->get();
        $data["users"]= CardHolder::all();
        return view("booksIssue.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated = Validator::make($request->all(), $this->rules);
    
       if ($validated->fails()) {
           if ($request->ajax()) {
               return $this->responseFailed("Data could not be validated!", $validated->errors());
           }
   
           return redirect()->back()
               ->withErrors($validated->errors())
               ->withInput()
               ->with("message", "Data could not be validated!");
       }
   
       try {
 
           $validatedData = $validated->validated();
           $bookIds = $validatedData['book_ids']; 
           unset($validatedData['book_ids']);
           
           $validatedData["status"] = 1;
   
            foreach ($bookIds as $key => $id) {
                $book = Book::find($id);
                $count = $book->bookHasCopies()->where("status",1)->count();
                if($count == 0)
                {
                    if ($request->ajax()) {
                        return $this->responseFailed($book->name." is not available");
                    }
                    return redirect()->back()
                        ->withInput()
                        ->with("message", $book->name." is not available");
                }
               
            }
           $createdData = BookIssue::create($validatedData);
   
           $createdData->bookIssueHasCopies()->createMany(
            array_map(function ($bookId) {
                $copy = Book::find($bookId)->bookHasCopies()->where("status",1)->first();
                $copy->status = 0;
                $copy->save();
                return ['book_copy_id' => $copy->id]; 
            }, $bookIds)
           );
   
           if ($request->ajax()) {
               return $this->responseSuccess($createdData->name . " inserted successfully", $createdData);
           }
   
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
        $data["breadcrums"] = ["Home", "BookIsue", "Edit"];
        $data["book"] = $book;
        return view("booksIssue.edit", $data);
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
    public function destroy(Request $request,string $id)
    {
         try {
            $bookIssue = BookIssue::find($id);
            if ($bookIssue && $bookIssue->delete()) {
                return redirect()->back()
                    ->with("message", "Issued Book deleted successfully");
            }
            else {
                if($request->ajax())
                   return $this->responseFailed("Data could not be Deleted!");

                return redirect()->back()
                ->with("message", "Issued book could not be deleted");
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
