var token = $('meta[name="csrf-token"]').attr('content')
$( document ).ready(function() {

    //select2 kategori barnag
    //Initialize select2 kategori barang
    $("#select2_no_invoice").select2({
        width: '100%',
        placeholder: "Pilih No. Invoice",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        allowClear: true
    });

     //Initializing options value select2 kategori barang
	 $.ajax({
        url: '/kasir/get-all-invoice/',
        type: 'post',
        data: {
            _token: token
        },
        dataType: 'json',
        success: function (data) {
            console.log(data)
            $.each(data['data'], function (key, val) {
                $("#select2_no_invoice").append('<option>' + val.no_invoice + '</option>')
            })
            $("#loadingIcon4").hide()
            if((typeof oldValS !== 'undefined')){
                $("#select2_no_invoice").val(oldValS).trigger('change')
            }
        },
        error: function (request, status, error) {
            $('<span class="text-danger"><div class="parsley-required">Data tidak dapat dimuat, harap refresh halaman</div></span>').insertAfter('#select2_kategori_barang');
        }
    });

	$("#select2_no_invoice").on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != "") {
            if($("#select2_no_invoice").next().is('span')) $("#select2_no_invoice").next().remove()
        }
    })

    $('#submit').on('click', function (e) {

        if ($("#select2_no_invoice").val() == "") {
            Swal.fire({
                title: 'Oops...',
                text: 'kolom tidak boleh kosong!',
                width: '400px',
                type: 'error',
                backdrop: `rgba(0,0,123,0.4)`
              })
       }
   })

});
