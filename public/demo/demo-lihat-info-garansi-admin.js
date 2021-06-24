var token = $('meta[name="csrf-token"]').attr('content')
$( document ).ready(function() {
    //Focus input if its has value
    $('.input100').each(function () {
        if ($(this).val().trim() != "") {
            $(this).addClass('has-val');
        }
        else {
            $(this).removeClass('has-val');
        }
    })
    /*Form==================================================================
    [ Focus input ]*/
    $('.input100').each(function () {
        $(this).on('blur', function () {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    
    })
    //Remove error message after server validation if input has changed
    $('.input100').each(function () {
        //If focused on particular input, then remove its parent next element
        $(this).on('focus', function () {
            $(this).parent().next().not('br').not('#progressBar-video').remove()
        })
    })
        console.log(no_invoice)        
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
            console.log('ini no invoice', no_invoice)
            console.log('ini nama', id)
            $.ajax({
                url: "/admin/table-garansi-admin/?id=" + id ,
                type: 'get',
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
                            { data: 'kategori_barang' },
                            { data: 'merk_barang_beli' },
                            { data: 'tipe_barang_beli' },                            
                            { data: 'jumlah_barang_beli' },
                            { data: 'batas_garansi' },
                            { data: 'status' },
                        ], 
                        // "lengthChange": false,
                        "columnDefs": [                                            
                            {
                                "render": function(data, type, row){
                                    if(data !== null) {
                                        var date = moment(data, 'YYYY-MM-DD', 'id').format("DD MMMM YYYY"); 
                                        return date
                                    }else{
                                        return '~'
                                    }
                                },
                                "width": "18%",
                                "targets": -2
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
    })