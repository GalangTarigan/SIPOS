$(function(){
    var token = $('meta[name="csrf-token"]').attr('content')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('#spinner').fadeIn()
    $("#table").css("cursor", "pointer")
    var table
    $.ajax({
		url: "/admin/manajemen/teknisi/showUser",
		type: 'post',
		data: {
            "_token" : token,              
		},
		dataType: 'json',
		success: function (data) {
            console.log(data)
            $('#spinner').fadeOut(290)
            table = $('#table').DataTable({
                "language": {
                    "lengthMenu": "_MENU_"
                },
                serverSide: false,
                data: data,
                columns: [
                    { data: 'nama_lengkap' },
                    { data: 'email' },
                    { data: 'no_telepon' },
                    { data: null }
                ], 
                "lengthChange": false,
                "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": ""
                },
                {
                    "render": function(data, type, row){
                        //let buttonName = 'delete[' + data['email'] + ']';
                        let button = "<span class='btn btn-danger-alt delete' id='delete'>Hapus User</span>"; 
                        return button;                        
                    },
                  "targets": -1
                }
            ]                
            })
            $('#table').fadeIn(300)
		}
    });
    $('#table').on( 'click', '#delete', function () {
        var data = table.row( $(this).parents('tbody tr') ).data();
        console.log( table.row( $(this).parents('tbody tr') ).data().id);
        let id = table.row( $(this).parents('tbody tr') ).data().id;
        json = table.row( $(this).parents('tbody tr') ).data();
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            width: '400px'
          }).then((result) => {
            if (result.value) {
                window.location.href = '/admin/manajemen/teknisi/deleteUser/?user=' + id;
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
          })
            

        
    } );
}) 



