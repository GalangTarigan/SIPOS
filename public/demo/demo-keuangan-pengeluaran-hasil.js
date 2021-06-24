$( document ).ready(function() {

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
        console.log('mulai dong', mulai)
        $.ajax({
            url: "/admin/keuangan/daftar-laporan-pengeluaran/?tanggal=" + mulai + "&sampai=" + selesai, 
            type: 'get',
            data: {
                "_token" : token,              
            },
            dataType: 'json',
            success: function (data) {
                $('#spinner').fadeOut(290)
                console.log(data)
                table = $('#table').DataTable({
                    "language": {
                        "lengthMenu": "_MENU_"
                    },
                    serverSide: false,
                    data: data,
                    columns: [
                        { data: null},
                        { data: 'nama_sales' },
                        { data: 'tanggal_faktur' },
                        { data: 'jatuh_tempo' },
                        { data: 'status_pembayaran' },
                        { data: 'tanggal_dibayar' },
                        { data: 'metode_pembayaran' },
                        { data: 'jumlah_tagihan' },
                        
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
                        "targets": [2,3, 5]
                    },
                    {
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "targets" : 0,
                        "width": "1%",
                    }
                ]                
                })
                $('#table').fadeIn(300)
            }
            
        });
    })
    
    
    
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
    
    //daterangepicker
        $('#date-rangepicker-tanggal-mulai').css('cursor', 'pointer')
        $('#date-rangepicker-tanggal-mulai').daterangepicker({
            autoUpdateInput: true,
            maxDate: moment(),
            locale: {
                format: 'DD/MM/YYYY'
            }
    
        });
        $('#date-rangepicker-tanggal-mulai').on('apply.daterangepicker', function (ev, picker) {
            //Apply changes to input field waktu mulai training
            $('input[name="tanggalMulai"]').val(picker.startDate.format(picker.locale.format))
            $('input[name="tanggalMulai"]').addClass('has-val')
            $('input[name="tanggalMulai"]').parsley().validate()
    
            //Apply changes to input field waktu selesai training
            $('input[name="sampaiTanggal"]').val(picker.endDate.format(picker.locale.format))
            $('input[name="sampaiTanggal"]').addClass('has-val')
            $('input[name="sampaiTanggal"]').parsley().validate()
        });
    
        //field mask
        $('.mask').inputmask()
        $('input[name="tanggalMulai"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" })
        $('input[name="sampaiTanggal"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" })
        
    
     
    
        console.log(mulai)
        console.log(selesai)
        // + "?sampai="+  selesai,
        $('#cetakLaporan').on('click', function (e) {
            var table1 = $('#table').DataTable();
          
            if ( ! table1.data().any() ) {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Tidak ditemukan data, silahkan pilih Tanggal lainnya!!',
                    width: '400px',
                    type: 'info',
                    backdrop: `rgba(0,0,123,0.4)`
                  })
            }else{            
                window.open('/print/laporan-pengeluaran/?tanggal=' + mulai + "&sampai=" + selesai, 'print', 'scrollbars=yes,status=no,menubar=no,width=800,height=400')
            }
           
        
        })
    
        
    
        $('#submit').on('click', function (e) {
    
            if ($("input[name='tanggalMulai']").val() == "") {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Harap pilih Tanggal terlebih dahulu',
                    width: '400px',
                    type: 'error',
                    backdrop: `rgba(0,0,123,0.4)`
                  })
           }
       })
    })