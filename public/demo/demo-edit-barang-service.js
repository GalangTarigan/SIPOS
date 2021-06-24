var token = $('meta[name="csrf-token"]').attr('content')
$( document ).ready(function() {

	//validate
    $('#validate-form #submit').on('click', function () {
        $('#validate-form').parsley().validate();
    });

	//Focus input if its has value
	$('.input100').each(function () {
		if ($(this).val().trim() != "") {
			$(this).addClass('has-val');
		}else {
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


    //untuk select select
    $('select').parsley({
        successClass: "select2-success",
        errorClass: "select2-error",
        classHandler: function (el) {
            return el.$element.parent().find('.select2-container')
        }
    })

    $("#select2_lokasi_barang").select2({
        width: '100%',
        placeholder: "Pilih Lokasi Barang",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });

    $("#select2_status_barang").select2({
        width: '100%',
        // placeholder: "Pilih Status Service",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });

    $("#select2_status_pembayaran").select2({
        width: '100%',
        placeholder: "Pilih Status Pembayaran",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });

    // pilihan untuk lokasi
    $("#select2_lokasi_barang").append('<option value="Toko" > Toko </option>')
    $("#select2_lokasi_barang").append('<option value="Gudang"> Gudang </option>')
    
    
});


// untuk lihat gambar
function imagesNewTab(dokumentasi) {
    window.open('/dokumentasi/barang_service/get-foto/' + dokumentasi)
}

//untuk hide and show lokasi barang
function showLokasi(){
    document.getElementById('input_lokasi').style.display = 'block';
    document.getElementById('label_lokasi').style.display = 'block';
    document.getElementById('bat_button').style.display = 'block';
    document.getElementById('ed_button').style.display = 'none';
}

function hideLokasi(){
    document.getElementById('input_lokasi').style.display = 'none';
    document.getElementById('label_lokasi').style.display = 'none';
    document.getElementById('bat_button').style.display = 'none';
    document.getElementById('ed_button').style.display = 'block';
    $('#select2_lokasi_barang').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit
}



// ketika tombol ubah status barang service ditekan
function showStatusBaru(){
    //akan menampilkan kolom isian data ubah status barang service beserta select
    document.getElementById('input_status').style.display = 'block';
    document.getElementById('label_status').style.display = 'block';
    document.getElementById('bat_button2').style.display = 'block';
    document.getElementById('ed_button2').style.display = 'none';

    // definisikan baru select2, supaya datanya ga tertimpa
    const select = document.getElementById("select2_status_barang");
    const len = select.options.length;
    for (let i = 0; i< len; i++) {
        select.remove(i);
    }

    //ketika status sebelumnya belum selesai maka akan menampilkan 3 pilihan 
    if( x == "Belum Selesai"){
        const select = document.getElementById("select2_status_barang");
        const tidakDapatDiperbaiki = document.createElement("option");
        tidakDapatDiperbaiki.value = 'Tidak dapat diperbaiki'
        tidakDapatDiperbaiki.text = 'Tidak dapat diperbaiki'
        select.add(tidakDapatDiperbaiki, null);

        const selesaiBelumDiambil = document.createElement("option");
        selesaiBelumDiambil.value = 'Selesai, Belum diambil'
        selesaiBelumDiambil.text = 'Selesai, Belum diambil'
        select.add(selesaiBelumDiambil, null);
        
        const selesai = document.createElement("option");
        selesai.value = 'Selesai'
        selesai.text = 'Selesai'
        select.add(selesai, null);
        select.selectedIndex = -1;
        $('div#s2id_select2_status_barang .select2-chosen').text('Pilih Status Service')
    }
    // ketika status barang sebelumya selesai tetapi belum diambil maka akan menampilkan 1 pilihan saja
    else if( x == "Selesai, Belum diambil"){
        const select = document.getElementById("select2_status_barang");
        const selesai = document.createElement("option");
        selesai.value = 'Selesai'
        selesai.text = 'Selesai'
        select.add(selesai, null);
        select.selectedIndex = -1;
        $('div#s2id_select2_status_barang .select2-chosen').text('Pilih Status Service')
    } 
}

function checkPlihanUser(){
    var val = document.getElementById('select2_status_barang').value;
    
    if(val == "Selesai, Belum diambil" ){
        $('#label_total_biaya').remove();
        $('#input_biaya_service').remove();
        $('#label_modal_service').remove();
        $('#input_modal_service').remove();
        $('#label_status_bayar').remove();
        $('#input_pembayaran').remove();
        $('#note_label').remove();
        $('#note_input').remove();

        $('#ubah_status').append(`<label class="col-sm-3 control-label" style="padding-top: 22px !important;" id="label_total_biaya"> Total Biaya Service &nbsp;&nbsp;&nbsp;&nbsp; : </label>`)
        $('#ubah_status').append(`<div class="col-sm-7" style="padding-top: 11px !important;" id="input_biaya_service">  <div class="wrap-input100" data-validate="Inputan tidak valid"> <input class="input100" required id="input_total_biaya" type="number" name="total_biaya_service" autocomplete="off" placeholder="0" > <span class="focus-input100"></span> </div> </div>`)
        $('#ubah_status').append(`<label class="col-sm-3 control-label" style="padding-top: 22px !important;" id="label_modal_service"> Modal Pengerjaan Service &nbsp;&nbsp;&nbsp;&nbsp; : </label>`)
        $('#ubah_status').append(`<div class="col-sm-7" style="padding-top: 11px !important;" id="input_modal_service">  <div class="wrap-input100" data-validate="Inputan tidak valid""> <input class="input100" required id="input_moda_service" type="number" name="modal_biaya_service" autocomplete="off" placeholder="0" > <span class="focus-input100"></span> </div> </div>`)

        //Focus input if its has value
        $('.input100').each(function () {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }else {
                $(this).removeClass('has-val');
            }
        })

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

    }else if( val == "Selesai"){
        console.log(data.total_biaya_service)
        $('#label_total_biaya').remove();
        $('#input_biaya_service').remove();
        $('#label_modal_service').remove();
        $('#input_modal_service').remove();
        $('#label_status_bayar').remove();
        $('#input_pembayaran').remove();
        $('#note_label').remove();
        $('#note_input').remove();

        $('#ubah_status').append(`<label class="col-sm-3 control-label" style="padding-top: 22px !important;" id="label_total_biaya"> Total Biaya Service &nbsp;&nbsp;&nbsp;&nbsp; : </label>`)
        $('#ubah_status').append(`<div class="col-sm-7" style="padding-top: 11px !important;" id="input_biaya_service">  <div class="wrap-input100" data-validate="Inputan tidak valid"> <input class="input100" required id="input_total_biaya" type="number" name="total_biaya_service" autocomplete="off" placeholder="0" value="${ data.total_biaya_service }"> <span class="focus-input100"></span> </div> </div>`)
        $('#ubah_status').append(`<label class="col-sm-3 control-label" style="padding-top: 22px !important;" id="label_modal_service"> Modal Pengerjaan Service &nbsp;&nbsp;&nbsp;&nbsp; : </label>`)
        $('#ubah_status').append(`<div class="col-sm-7" style="padding-top: 11px !important;" id="input_modal_service">  <div class="wrap-input100" data-validate="Inputan tidak valid""> <input class="input100" required id="input_moda_service" type="number" name="modal_biaya_service" autocomplete="off" placeholder="0" value="${ data.modal_biaya_service }"> <span class="focus-input100"></span> </div> </div>`)
        $('#ubah_status').append(`<label class="col-sm-3 control-label" style="padding-top: 22px !important;" id="label_status_bayar"> Status Pembayaran &nbsp;&nbsp;&nbsp;&nbsp; : </label>`)
        $('#ubah_status').append(`<div class="col-sm-7" style="padding-top: 11px !important;" id="input_pembayaran"><select required id="select2_status_pembayaran" name="status_pembayaran"><option></option></select></div>`)
    
        //pilihan untuk status pembayaran
        $("#select2_status_pembayaran").select2({
            width: '100%',
            placeholder: "Pilih Status Pembayaran",
            containerCssClass: 'tpx-select2-container select2-container',
            dropdownCssClass: 'tpx-select2-drop',
        });

        $("#select2_status_pembayaran").append('<option value="Lunas" > Telah dibayar </option>')
        
        //Focus input if its has value
        $('.input100').each(function () {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }else {
                $(this).removeClass('has-val');
            }
        })

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


        //parsley untuk select 2
        $('select').each(function () {
            $(this).on('change', function () {
                if ($(this).hasClass('is-invalid') && $(this).val() != "") {
                    if ($(this).next().is('span')) $(this).next().remove()
                } else {
                    $(this).parsley().validate()
                }
            })
        })
        
        //untuk select select
        $('select').parsley({
            successClass: "select2-success",
            errorClass: "select2-error",
            classHandler: function (el) {
                return el.$element.parent().find('.select2-container')
            }
        })

    }
    else if ( val == "Tidak dapat diperbaiki"){
        $('#label_total_biaya').remove();
        $('#input_biaya_service').remove();
        $('#label_modal_service').remove();
        $('#input_modal_service').remove();
        $('#label_status_bayar').remove();
        $('#input_pembayaran').remove();
        $('#note_label').remove();
        $('#note_input').remove();
        
        $('#ubah_status').append(`<label class="col-sm-3 control-label" style="padding-top: 22px !important;" id="note_label"> Alasan Tidak Dapat Diperbaiki &nbsp;&nbsp;&nbsp;&nbsp; : </label>`)
        $('#ubah_status').append(`<div class="col-sm-7" style="padding-top: 11px !important;" id="note_input">  <div class="wrap-input100" data-validate="Inputan tidak valid"> <input class="input100" required id="note" type="text" name="note" autocomplete="off" placeholder="Ketik alasan barang tidak dapat diservice....."> <span class="focus-input100"></span> </div> </div>`)

        //Focus input if its has value
        $('.input100').each(function () {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }else {
                $(this).removeClass('has-val');
            }
        })

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
    }
}

    // untuk cek kalau statusnya uda gabisa diperbaiki tombol edit jangan dimunculin
    let x = document.getElementById("status_lama").value;
    if (x == "Tidak dapat diperbaiki"){
        document.getElementById('ed_button2').style.display = 'none';
    }
 
    $('#batal_button2').on("click", function(e) {
        e.preventDefault();
        // alert('halo')
        //hide ubah status barang
        document.getElementById('input_status').style.display = 'none';
        document.getElementById('label_status').style.display = 'none';
        document.getElementById('bat_button2').style.display = 'none';
        document.getElementById('ed_button2').style.display = 'block';

        //untuk menghapus isi option
        document.getElementById('select2_status_barang').value = ''; // untuk buat null value ketika kita pilih batal edit
        document.getElementById('select2_status_barang').selectedIndex = -1; // untuk buat null value ketika kita pilih batal edit
        const select = document.getElementById("select2_status_barang");
        const len = select.options.length;
        for (let i = 0; i< len; i++) {
            select.remove(i);
        }        
        
        //menghapus append
        $('#label_total_biaya').remove();
        $('#input_biaya_service').remove();
        $('#label_modal_service').remove();
        $('#input_modal_service').remove();
        $('#label_status_bayar').remove();
        $('#input_pembayaran').remove();
        $('#note_label').remove();
        $('#note_input').remove();
        
    })


    // untk tombol reset
    function hideAll(){
        if (x == "Tidak dapat diperbaiki"){
            document.getElementById('ed_button2').style.display = 'none';
        }else{
            document.getElementById('ed_button2').style.display = 'block';
        }
        document.getElementById('input_lokasi').style.display = 'none';
        document.getElementById('label_lokasi').style.display = 'none';
        document.getElementById('bat_button').style.display = 'none';
        document.getElementById('ed_button').style.display = 'block';
        

        document.getElementById('input_status').style.display = 'none';
        document.getElementById('label_status').style.display = 'none';
        document.getElementById('bat_button2').style.display = 'none';
        

        // untuk slect nilainya kosong
        $('#select2_lokasi_barang').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit
        // $('#select2_status_pembayaran').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit
        $('#label_total_biaya').remove();
        $('#input_biaya_service').remove();
        $('#label_modal_service').remove();
        $('#input_modal_service').remove();
        $('#label_status_bayar').remove();
        $('#input_pembayaran').remove();
        $('#note_label').remove();
        $('#note_input').remove();
        
    }

    