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
})
