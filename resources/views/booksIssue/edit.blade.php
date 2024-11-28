<x-app-layout>
    <x-core.page-header :header=$header :breadcrums=$breadcrums />
    <div class="container form-container">
        @if (Session::has('message'))
        <div class="alert alert-primary">
            <small>
                {{ session()->get('message') }}
            </small>
        </div>

        @endif
        <div>
        Edit Issued book<a href="{{ route('book_Issue.index') }}" class="btn btn-primary btn-sm text-right">Go to List </a>
        </div>
        <form method="POST" id="bookIssueEditForm" action="{{ route('book_Issue.update', ['book_Issue' => $book_Issue->id]) }}" enctype="multipart/form-data" class="form p-3">    
        @csrf
        @method('PUT') 

            <div class="form-row mb-2">
            <div><label for="user " class="pl-2 ml-1" > Card Holder </label></div>
                <div class="col-md-12 d-flex align-items-center books_col m-1">
                   
                <select class="form-control select" name="user" id="user" >
                        <option selected>Select Card Holder</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($book_Issue->card_holder_id == $user->id) selected @endif >{{ $user->name }}</option>
                        @endforeach
                        <option value=""></option>
                    </select>

                </div>
            </div>
            <div class="form-row">
                @foreach($book_Issue->books() as $book)
                <div class="col-md-12 d-flex align-items-center books_col m-1">
                    <select class="form-control book" name="book" disabled>
                        <option selected value="0">Open this select Books</option>
                        @foreach($books as $bk)
                        <option value="{{ $book->id }}" @if($book->id == $bk->id) selected @endif>{{ $book->name }}</option>
                        @endforeach
                    </select>
                    <h4 class="book_details text-success ml-3"></h4>
                </div>
                @endforeach
            </div>


            <div class="row">
                <div class="col-xl-6">
                    <label for="">From Date</label>
                    <input type="date" class="form-control date" name="from_date" id="from_date" value="{{ $book_Issue->from_date }}" required >
                    <p class="text-danger" id="from_error"></p>
                    @error('from_date')
                    <small for="" class="text-danger p-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-xl-6">
                    <label for="">To Date</label>
                    <input type="date" class="form-control date" name="to_date" id="to_date" value="{{ $book_Issue->to_date }}"  required>
                    <p class="text-danger" id="to_error"></p>
                     @error('to_date')
                    <small for="" class="text-danger p-1">{{ $message }}</small>
                    @enderror

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Total Amount</label>
                    <input type="text" class="form-control" name="total" id="total" value="{{ $book_Issue->total }}" required disabled>
                    @error('total')
                    <small for="" class="text-danger p-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Total Paid</label>
                    <input type="text" class="form-control" name="paid" id="paid" value="{{ $book_Issue->paid }}" required>
                    @error('paid')
                    <small for="" class="text-danger p-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Due</label>
                    <input type="text" class="form-control" disabled name="due" id="due" value="{{ $book_Issue->due }}" required>
                    @error('due')
                    <small for="" class="text-danger p-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class=" pl-3 pb-3 ">
                    <button class="btn btn-primary btn-block ml-3 " type="submit">Submit</button>

                </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {

           
            var books = @json($books->toArray());
            const calculateTotal = () => {

                if ($(".book").val() == 0)
                    return

                date1 = new Date($("#from_date").val())
                date2 = new Date($("#to_date").val())

                const differenceInMilliseconds = date2 - date1;
                const differenceInDays = differenceInMilliseconds / (1000 * 60 * 60 * 24);

                if (!differenceInDays)
                    return;

                let rates = [];

                $.find("select.book").forEach(function(elem) {

                    var bookId = $(elem).val()
                    var bookDetails = books.find(book => book.id == bookId)
                    var prices = []
                    if (bookDetails.book_has_prices.length > 0) {
                        bookDetails.book_has_prices.forEach(function(price) {
                            var diff = differenceInDays - Number(price.no_of_days_minimum)
                            if (diff >= 0)
                                prices[diff] = price.rate_per_day
                        })
                        prices = prices.filter(x => x != undefined)

                    }
                    if (prices.length == 0)
                        prices[0] = bookDetails.default_borrow_price

                    rates.push(prices[0] * differenceInDays)

                })

                let price = rates.reduce((a, b) => a + b)

                if (price < 0) {
                    price = 0;
                }
                $('#total').val(price).trigger("change");
            }

            $("#calculate").on("click", function() {
                calculateTotal();
            });

            $(".date").on("change",function(){
                calculateTotal();
            })


            $(".form-container").on("click", ".add_row", function() {
                let new_row = $(this).closest(".books_col").clone()
                $(new_row).find(".book_details").html("")
                $(new_row).find(".add_row").replaceWith(`<button class="btn btn-default btn-danger ms-2 remove_row " >-</button>`)
                $(this).closest(".form-row").append(new_row)

            })
            $(".form-container").on("click", ".remove_row", function() {
                $(this).closest(".books_col").remove();
            })

            $(".form-container").on("change", ".book", function() {
                let selectedId = $(this).val()

                if($(".book").map(function(){
                    return $(this).val()
                }).get().filter(elem => elem == selectedId).length > 1)
                {
                    alert("This book is already selected")
                    $(this).val(0)
                    return 0;
                }


                if(books.find(elem => elem.id == $(this).val()).book_has_copies.filter(copy => copy.status == 1).length == 0)
                {
                    alert("This book is not available")
                    $(this).val(0)
                    return 0;
                }
                
                let selectedBook = books.find(book => book.id == selectedId)

                $(this).closest(".books_col").find(".book_details").html("")
                $(this).closest(".books_col").find(".book_details").append(selectedBook.book_has_copies.filter(book => book.status == 1).length + ` Books available`)

                $(this).closest(".books_col").find(".book_details").append(`<span class="badge bg-danger text-white ml-2 shadow-sm" > rs. <span>${selectedBook.default_borrow_price}</span> / day </span>`)

                selectedBook.book_has_prices.forEach((price) => {
                    $(this).closest(".books_col").find(".book_details").append(`<span class="badge bg-danger text-white ml-2 shadow-sm" ><span>${price.no_of_days_minimum }</span> days - rs. <span id="rent_per_day">${price.rate_per_day} / day</span> </span>`)
                })

                calculateTotal();

            })

             const calculateDue = () => {
                const total = parseInt($('#total').val()) 
                const paid = parseInt($('#paid').val())  
                const due = total - paid;
                $('#due').val(due > 0 ? due : 0);    
              };
    
    
           $('#paid').on('change', calculateDue);
    
         
           $('#total').on('change', calculateDue);



            let bookIds = []

            $("#bookIssueEditForm").on("submit", function(e) {
                e.preventDefault();


                $(this).validate({
                    rules: {
                        from_date: {
                            required: true,
                            
                        },
                        to_date: {
                            required: true,
                           
                        },
                        total: {
                            required: true,
                          
                        },
                        paid: {
                            required: true,
                           
                        },
                        due: {
                            required: true,
                            
                        }

                    },
                
                })

                let payload = {
                    card_holder_id:  $("#user").val(),
                    from_date:  $("#from_date").val(),
                    to_date:  $("#to_date").val(),
                    total:  $("#total").val(),
                    paid:  $("#paid").val(),
                    due:  $("#due").val()                   
                }

                $.ajax({
                    url: $(this).prop("action"),
                    method: "PUT",
                    data: {
                        _token: $("input[name='_token']").val(),
                       ...payload
                    },
                    success: function(data) {
                        alert(data.message)
                    },
                    error: function(request, status, error) {

                        let errors = request.responseJSON

                        if (request.status == 400) {
                            let errorInputs = Object.keys(errors.data)
                            errorInputs.forEach(elem => {
                                $("#" + elem).closest("div").find("small").remove();
                                $("#" + elem).after(`<small class="text-danger" >${errors.data[elem][0]}</small>`)
                            })
                        }

                        if (request.status == 500) {
                            alert(request.responseJSON.message)
                        }

                    }
                })




            });
        })
    </script>

</x-app-layout>