<x-app-layout>
    <x-core.page-header :header=$header :breadcrums=$breadcrums />

    <h2 class="h3 pl-3">Book Issue Details</h2>
    <div class="container">
        <div class="card shadow mb-2">
            <div class="card-body">
                <h1 class="h5 pb-3" >User Details <i class="fa fa-user" ></i> </h1>
                @foreach($users as $user)
                <div value="{{ $user->id }}" @if($book_Issue->card_holder_id == $user->id) selected @endif>
                    <div class="p-3 text-dark border-bottom" >
                    <p> <strong class="pr-4" >Name:</strong>   {{ $user->name }} </p>
                    </div>
                    <div class="p-3 text-dark border-bottom" >
                    <p> <strong class="pr-4" >Email:</strong>   {{ $user->email }}</p>
                    </div>
                    <div class="p-3 text-dark border-bottom" >
                    <p> <strong class="pr-4" >Contact:</strong>   {{ $user->contact }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card shadow mb-2">
            <div class="card-body ">
            <h1 class="h5 pb-3" >Book Details <i class="fa fa-list" ></i> </h1>
                <div class="card-body border" >
                                <table id="bookIssue" class="table" data-url="{{route('get-book_Issue-api')}}" >
                                    <thead>
                                        <tr>
                                          <th>Book Name</th>
                                          <th>Book Author</th>
                                          <th>Book Publisher</th>
                                          <th>Book Price</th>
                                          <th>Default Rent</th>
                                          <th>Number of day </th>
                                          <th> Rate applied </th>
                                          <th>Total Amount</th>
                                          
                                        </tr>
                                        @foreach($books as $book)
                                        <tr>
                                            <td>{{ $book->name }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->publisher }}</td>
                                            <td>{{ $book->price }} rs.</td>
                                            <td>{{ $book->default_borrow_price }} rs.</td>
                                            
                                            <td>{{$diffInDays}}</td>
                                            <td>{{$book->rate_applied}} rs.</td>
                                            <td>{{ $book->sub_total }} rs.</td>
                                            
                                         
                                        </tr>
                                        @endforeach 
                                    </thead>
                                     <tfoot>
                                        <tr>
                                            <td class="text-right"  colspan="7">
                                                Total
                                            </td>
                                            <td>
                                                {{$books->sum("sub_total")}} RS.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right text-success"  colspan="7">
                                             (-)   Paid
                                            </td>
                                            <td class="text-success" >
                                                {{$book_Issue->paid}} RS.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right text-danger"  colspan="7">
                                              <strong>Amount to Pay</strong>  
                                            </td>
                                            <td class="text-danger" >
                                            <strong> {{$book_Issue->due}} RS. </strong>
                                            </td>
                                        </tr>
                                        
                                                      
                                    </tfoot>
                                </table>

                </div>
                
            </div>
        </div>

        
   
    <div class="card shadow mb-3">
    <div class="card-body mb-2">
    <h1 class="h5 pb-3" >Confirm Details <i class="fa fa-emnhhbvhj" ></i> </h1>
    <form method="POST" id="bookIssueReturnForm" action="{{ route('book_issue.issuedReturn', ['id' => $book_Issue->id]) }}" enctype="multipart/form-data" class="form p-3">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-6">
                <label for="">From Date</label>
                <input type="date" class="form-control date" name="issued_at" id="issued_at" value="{{ $book_Issue->from_date }}" required disabled>
                <p class="text-danger" id="from_error"></p>
                @error('issued_at')
                <small for="" class="text-danger p-1">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-xl-6">
                <label for="">To Date</label>
                <input type="date" class="form-control date" name="to_date" id="to_date" value="{{ $book_Issue->to_date }}" required disabled>
                <p class="text-danger" id="to_error"></p>


            </div>


            <div class="col-xl-6">
                <label for="">Return Date</label>
                <input type="date" class="form-control date" name="return_at" id="return_at" value="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}" min="{{date('Y-m-d',strtotime($book_Issue->from_date))}}" required>
                <p class="text-danger" id="to_error"></p>
                @error('return_at')
                <small for="" class="text-danger p-1">{{ $message }}</small>
                @enderror

            </div>


            <div class="col-md-6 mb-3">
                <label for="validationDefault03">Final Amount to pay</label>
                <input type="text" class="form-control" disabled name="due" id="due" value="" required>

            </div>
            <div class=" pl-3= pb-3 ">
                <button class="btn btn-primary btn-block  " type="submit">Submit</button>

            </div>
    </form>
    </div>
    </div>


    </div>
    </div>


<script>

</script>

</x-app-layout>