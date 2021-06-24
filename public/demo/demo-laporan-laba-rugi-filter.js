
var token = $('meta[name="csrf-token"]').attr('content')
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

$('#submit').on('click', function (e) {

    if ($("input[name='tanggalMulai']").val() == "") {
       Swal.fire({
           title: 'Oops...',
           text: 'Harap pilih Bulan terlebih dahulu',
           width: '400px',
           type: 'error',
           backdrop: `rgba(0,0,123,0.4)`
         })
   }
})

$('#daterangepicker_tanggal_mulai').daterangepicker({
            ranges: {
                'Bulan Ini': [moment().subtract(0, 'month'), moment()],
                '1 bulan lalu': [moment().subtract(1, 'month'), moment()],
                '2 bulan lalu': [moment().subtract(2, 'month'), moment()],
                '3 bulan lalu': [moment().subtract(3, 'month'), moment()],
                '4 bulan lalu': [moment().subtract(4, 'month'), moment()],
                '5 bulan lalu': [moment().subtract(5, 'month'), moment()],
                 },
                "showCustomRangeLabel": false,
              
        });

$('#daterangepicker_tanggal_mulai').on('apply.daterangepicker', function (ev, picker) {
    $('input[name="tanggalMulai"]').val(picker.startDate.format('MMMM - YYYY'))
    $('input[name="tanggalMulai"]').addClass('has-val')
    $('input[name="tanggalMulai"]').parsley().validate()
    $('input[name="date_start"]').val(picker.startDate.format('MM'))
    $('input[name="year_start"]').val(picker.startDate.format('YYYY'))

});