var token = $('meta[name="csrf-token"]').attr('content')
$( document ).ready(function() {
    $('#submit').on('click', function (e) {

        if ($("input[name='no_invoice']").val() == "") {
            Swal.fire({
                title: 'Oops...',
                text: 'kolom tidak boleh kosong!',
                width: '400px',
                type: 'error',
                backdrop: `rgba(255,0,0,0.4)`
              })
       }
   })
})