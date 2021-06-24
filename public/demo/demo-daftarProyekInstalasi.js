$(function(){
    var token = $('meta[name="csrf-token"]').attr('content')

    //alert if report created successfully
	if (typeof training_report_s !== 'undefined') {
		Swal.fire(
			'Berhasil!',
			training_report_s,
			'success'
		)
    }
    if (typeof installation_report_s !== 'undefined') {
		Swal.fire(
			'Berhasil!',
			installation_report_s,
			'success'
		)
	}

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('#spinner').fadeIn()
    $("#table").css("cursor", "pointer")
    var table
    
    $.ajax({
		url: "/laporan-instalasi/daftar-proyek-instalasi",
		type: 'post',
		data: {
            "_token" : token
		},
		dataType: 'json',
		success: function (data) {
            $('#spinner').fadeOut(200)
            table = $('#table').DataTable({
                "language": {
                    "lengthMenu": "_MENU_"
                },
                "oLanguage": {
                    "sEmptyTable": "Tidak ada data untuk ditampilkan"
                },
                serverSide: false,
                data: data['data'],
                columns: [
                    { data: null},
                    { data: 'nama_instansi' },
                    { data: 'alamat_instansi'},
                    { data: 'status' },
                    { data: 'waktu_mulai'},
                    { data: 'waktu_selesai'}
                ], 
                "lengthChange": false,
                "columnDefs": [
                {
                    "render": function(data, type, row){
                        if(data=="Selesai"){
                            return "<span class='label label-success'>"+data+"</span>"
                        }else if(data=="Dalam Training"){
                            return "<span class='label label-default'>"+data+"</span>"
                        }
                        else{
                            return "<span class='label label-primary'>"+data+"</span>"
                        }
                    },
                  "targets": 3
                },
                {
                    "render": function(data, type, row){
                        if(data !== null) {
                            var date = moment(data, 'YYYY-MM-DD HH:mm:ss', 'id').format("dddd, D MMMM YYYY - HH:mm")+' WIB';
                            return date
                        }else{
                            return '-'
                        }
                        
                    },
                    "targets": [4, 5]
                },
                {
                    "render": function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "targets": 0

                } ]
            })
            $('#table').fadeIn(300)
        },
        error : function(err){
            $('#spinner').fadeOut(200)
            $('<span >Data tidak dapat dimuat, harap refresh ulang halaman</span>').appendTo($('.text-center'))
            $('#errorLoading').fadeIn(209)
        }
    });
    

    
    $('#table').on( 'click', 'tbody tr', function () {
        var id = table.row( this ).data().uuid
        window.location.href = '/daftar-proyek-instalasi/detail-proyek?laporan='+id
    } );
})
