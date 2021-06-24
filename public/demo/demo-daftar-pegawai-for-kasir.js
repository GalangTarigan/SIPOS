
//untuk menampilkan seluruh pegawai
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
		url: "/kasir/pegawai/list-pegawai",
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
                    { data: null},
                    { data: 'nama_lengkap' },
                    { data: 'email' },
                    { data: 'no_telepon' },
                    { data: 'alamat' },
                    { data: 'posisi'},                  
                ], 
                // "lengthChange": false,
                "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "",
                    "width" : 160,
                },
                
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "targets" : 0
                }
            ]                
            })
            $('#table').fadeIn(300)
		}
    });


}) 



