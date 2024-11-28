$(document).ready( function () {
    var url = $("#bookList").data("url")
    $('#bookList').DataTable({
        responsive: true,
        ajax: url,
        processing: true,
        serverSide: true,
        columns: [
            { data: 'id' , name: "Id", searchable:false  },
            { data: 'name' ,name: "Name" , searchable: true },
            { data: 'author' , name: "Author" },
            { data: 'publisher',name: "Publisher" },
            { data: 'price',name: "Price", searchable:false  },
            { data: 'no_copies',name: "No. of Copies", searchable:false },
            { data: 'default_borrow_price',name: "Default Rent Price", searchable:false  },
            { data: 'rent_prices',name: "Rent Price as Per Day", searchable:false  },
            { data: 'action', name: "Action", searchable:false, }
        ],
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
          }]
    });

    var url = $("#userList").data("url")
    $('#userList').DataTable({
        responsive: true,
        ajax: url,
        processing: true,
        serverSide: true,
        columns: [
            { data: 'id' , name: "Id", searchable:false  },
            { data: 'name' ,name: "Name" , searchable: true },
            { data: 'age' , name: "Age" },
            { data: 'email',name: "Email" },
            { data: 'contact',name: "Contact", searchable:false  },
            { data: 'address',name: "Address", searchable:true },
            { data: 'action', name: "Action", searchable:false, }
        ],
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
          }]
    });
    
    var url = $("#bookIssue").data("url")
   var table = $('#bookIssue').DataTable({
        responsive: true,
        ajax: url,
        processing: true,
        serverSide: true,
        columns: [
            { data: 'id' , name: "Id", searchable:false  },
            { data: 'books' , name: "Book", searchable:false  },
            { data: 'card_holder.name' , name: "Card Holder", searchable:true  },
            { data: 'from_date',name: "From Date" },
            { data: 'to_date',name: "To Date", searchable:false  },
            { data: 'total',name: "Total Amount", searchable:true },
            { data: 'paid',name: "Total Paid", searchable:false },
            { data: 'due',name: "Due", searchable:false},
            { data: 'action', name: "Action", searchable:false, }
        ],

        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
          }]
    });

    function printTableData() {
        var data = table.rows().data().toArray(); // Get all rows data
        console.log(data);  // Print to console
        console.log(JSON.stringify(data, null, "data")); // Alert with formatted JSON
    }
    
    // Example: Call the function to print data after the table is drawn
    $('#bookIssue').on('draw.dt', function() {
        printTableData();
    });
})
