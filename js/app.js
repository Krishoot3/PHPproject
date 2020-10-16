//Delete Modal Function
$(window).on( "load",function (){
  
    $('.deleteBtn').on('click', function() {
        $('#deleteModal').modal('show');

        $tr = $(this).closest('tr');

        let data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        $('#id_delete').val(data[0]);

});


    });




