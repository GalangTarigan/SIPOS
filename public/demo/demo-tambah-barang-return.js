var token = $('meta[name="csrf-token"]').attr('content')
$( document ).ready(function() {

    
    /*Form validate ================================================================*/
    //[ Focus input ]
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
            if ($(this).parent().next()) {
                $(this).parent().next().remove()
            }
        })
    })
    $('select').each(function(){
		$(this).on('change', function () {
			if ($(this).hasClass('is-invalid') && $(this).val() != "") {
				if($(this).next().is('span')) $(this).next().remove()
			}else{
				$(this).parsley().validate()
			}
		})
    })

    //field mask
    $('.mask').inputmask();

    //validate
    $('#validate-form #submit').on('click', function () {
        $('#validate-form').parsley().validate();
    });
    
    $('select').parsley({
		successClass: "select2-success",
		errorClass: "select2-error",
		classHandler: function (el) {
			return el.$element.parent().find('.select2-container')
		}
	})

    /*Form validate ================================================================*/

    // touchspin jumlah barang
    var maxx;
    $("input[name='jumlah_barang']").TouchSpin({
        min: 1,
        max: maxx,
        stepinterval: 1,
        maxboostedstep: maxx,
    });

    $("#select2_merk_barang").on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != "") {
            if($("#select2_merk_barang").next().is('span')) $("#select2_merk_barang").next().remove()
        }
    })
    $("#select2_tipe_barang").on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != "") {
            if($("#select2_tipe_barang").next().is('span')) $("#select2_tipe_barang").next().remove()
        }
    })


    //select2 initialize
    //Initialize select2 merk barang
    $("#select2_merk_barang").select2({
        width: '100%',
        placeholder: "Pilih Merk Barang",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });


    //Initialize select2 kategori barang
    $("#select2_tipe_barang").select2({
        width: '100%',
        placeholder: "Pilih Tipe Barang",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        allowClear: true
    });

    //Initialize select2 kategori barang
    $("#select2_kategori_barang").select2({
        width: '100%',
        placeholder: "Pilih Kategori",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });

    //Initializing options value select2 merk barang
    $.ajax({
        url: '/admin/barang-return/getKategori/',
        type: 'post',
        data: {
            _token: token
        },
        dataType: 'json',
        success: function (data) {
            $.each(data['data'], function (key, val) {
                $("#select2_kategori_barang").append('<option value="' + val.id_kategori + '">' + val.nama_kategori + '</option>')
            })
            $("#loadingIcon1").hide()
            if ((typeof oldValKat !== 'undefined')) {
                $("#select2_kategori_barang").val(oldValKat).trigger('change')
            }
        },
        error: function (request, status, error) {
            $('<span class="text-danger"><div class="parsley-required">Data tidak dapat dimuat, harap refresh halaman</div></span>').insertAfter('#select2_kategori_barang');
        }
    });

    //untuk kategori
    $("#select2_kategori_barang").on('change', function () {
        $("#loadingIcon3").show()
        var id_kategori = $(this).val()
        if (id_kategori == "") {
            $("#select2_merk_barang").html('<option></option>')
            $("#loadingIcon3").hide()
        } else {
            $.ajax({
                url: '/admin/barang-return/getDaftarMerk',
                type: 'post',
                data: {
                    _token: token,
                    id_kategori: id_kategori
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    $('#select2_merk_barang').val(null).trigger('change'); // untuk buat null value ketika kita ganti pilihan pada nama perusahan
                    $('#select2_tipe_barang').val(null).trigger('change'); // untuk buat null value ketika kita ganti pilihan pada nama perusahan
                    document.getElementById('nama_sales').value = ''
                    $("#select2_merk_barang").html('<option></option>')
                    $.each(data['data'], function (key, val) {
                        $("#select2_merk_barang").append('<option value="' + val.id_merk + '">' + val.nama_merk + '</option>')  
                        
                    })
                    $("#loadingIcon2").hide()
                    //set value to select2 option if its has old value
                    if ((typeof oldValS !== 'undefined')) {
                        $("#select2_merk_barang").val(oldValS).trigger('change')
                    }
                },
                error: function (request, status, error) {
                    $('<span class="text-danger"><div class="parsley-required">Data tidak dapat dimuat, harap refresh halaman</div></span>').insertAfter('#select2_merk_barang');
                }
            });
        }
    })



    //Initializing options value select2 pic when select2 on change events occur
    $("#select2_merk_barang").on('change', function () {
        $("#loadingIcon3").show()
        var id_merk = $(this).val()
        if (id_merk == "") {
            $("#select2_tipe_barang").html('<option></option>')
            $("#loadingIcon6").hide()
        } else {
            $.ajax({
                url: '/admin/barang-return/getTipeBarang',
                type: 'post',
                data: {
                    _token: token,
                    merk: id_merk
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    $('#select2_tipe_barang').val(null).trigger('change'); // untuk buat null value ketika kita ganti pilihan pada nama perusahan
                    $("#select2_tipe_barang").html('<option></option>')
                    $.each(data['data'], function (key, val) {
                        $("#select2_tipe_barang").append('<option value="' + val.id_barang + '">' + val.tipe_barang + '</option>')
                    })
                    $("#loadingIcon3").hide()
                    //set value to select2 option if its has old value
                    if ((typeof oldValS !== 'undefined')) {
                        $("#select2_tipe_barang").val(oldValS).trigger('change')
                    }
                },
                error: function (request, status, error) {
                    $('<span class="text-danger"><div class="parsley-required">Data tidak dapat dimuat, harap refresh halaman</div></span>').insertAfter('#select2_tipe_barang');
                }
            });
        }
    })


    $("#select2_tipe_barang").on('change', function () {
        var id_barang = $(this).val()
        console.log(id_barang)
        $.ajax({
            url: '/admin/barang-return/getMaxBarang',
            type: 'post',
            data: {
                _token: token,
                id_barang: id_barang
            },
            dataType: 'json',
            success: function (data) {
                console.log(data)
                $.each(data['data'], function (key, val) {                   
                    // $("input[name='nama_sales']").val(val.nama_sales);
                    document.getElementById('nama_sales').value = val.nama_sales
                    document.getElementById("jumlah_barang").value = 1;
                    var maxx = val.jumlah                    
                    $("input").trigger("touchspin.updatesettings", { max: maxx });

                    //check nama sales ada val
                    $('.input100').each(function () {
						if ($(this).val().trim() != "") {
							$(this).addClass('has-val');
						}else {
							$(this).removeClass('has-val');
						}
					})


                })

            },
        });

        if ($(this).hasClass('is-invalid') && $(this).val() != "") {
            if ($("#select2_tipe_barang").next().is('span')) $("#select2_tipe_barang").next().remove()

        }
    })

    //Initialize datetime mask
    $('input[name="tanggal_barang_return"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" }, { showMaskOnHover: false })

    //daterangepicker
    $('#date-rangepicker-barang-return').daterangepicker({
        autoUpdateInput: true,
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY',
            cancelLabel: 'Clear'
        }

    });

    $('#date-rangepicker-barang-return').on('apply.daterangepicker', function (ev, picker) {
        $('input[name="tanggal_barang_return"]').val(picker.startDate.format(picker.locale.format));
        $('input[name="tanggal_barang_return"]').addClass('has-val');
        if ($('input[name="tanggal_barang_return"]').parent().next()) {
            $(this).parent().next().remove()
        }
    });
});

    //hide and show tanggal ambil
    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('div1').style.display = 'block';
        }
        else document.getElementById('div1').style.display = 'none';

    }

