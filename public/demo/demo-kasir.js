
$(function () {
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
        url: "/admin/transaksi-penjualan/list-barang",
        type: 'post',
        data: {
            "_token": token,
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
                    { data: null },
                    { data: 'nama_kategori' },
                    { data: 'nama_merk' },
                    { data: 'tipe_barang' },
                    { data: 'jual' },
                    { data: 'jumlah' },                    
                    { data: null }
                ],
                // "lengthChange": false,
                "columnDefs": [
                    {
                        "render": function (data, type, row) {
                            let button = "<span type='button' id='pilihBarang' class='btn btn-primary-alt'>Pilih</span>";
                            return button;
                        },
                        "targets": -1
                    },                    
                    {
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        
                        "targets": 0
                    }
                ]
            })
            $('#table').fadeIn(300)
        }

    });

    function capital_letter(str) {
        str = str.toLowerCase()
        str = str.split(" ");
    
        for (let i = 0, x = str.length; i < x; i++) {
            str[i] = str[i][0].toUpperCase() + str[i].substr(1);
        }
    
        return str.join(" ");
    }

    // modal cari barang
    let jual;
    let modalBarang;
    $('#table tbody').on('click', '#pilihBarang', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        let id_barang = table.row($(this).parents('tbody tr')).data().id_barang;
        let nama_kategori = table.row($(this).parents('tbody tr')).data().nama_kategori;
        let merk = table.row($(this).parents('tbody tr')).data().nama_merk;
        let tipe_barang = table.row($(this).parents('tbody tr')).data().tipe_barang;
        jual = table.row($(this).parents('tbody tr')).data().jual;
        let jumlah = table.row($(this).parents('tbody tr')).data().jumlah;
        modalBarang = table.row($(this).parents('tbody tr')).data().modal;
        console.log(id_barang, merk, tipe_barang, jual, jumlah, 'ini modal',modalBarang)

        // attach value
        $("input[name='kategori_barang']").val(nama_kategori);
        $("input[name='id_barang']").val(id_barang);
        $("input[name='merk_barang']").val(merk);
        $("input[name='tipe_barang']").val(tipe_barang);
        $("input[name='harga_barang']").val(jual);
        $("input[name='jumlah_barang']").val(1);
        $("input[name='total_barang']").val(jumlah);
        $("input[name='total_harga']").val(jual);
        $("input[name='total_modal']").val(modalBarang);
        maxx = jumlah
        $("input").trigger("touchspin.updatesettings", { max: maxx });
        $('#cariBarangModal').modal('hide');

            //Focus input if its has value
            $('.input100').each(function () {
                if ($(this).val().trim() != "") {
                    $(this).addClass('has-val');
                }else {
                    $(this).removeClass('has-val');
                }
            })


    });

    // kalkulasi total harga 
    $("input[name='jumlah_barang']").change(function () {
        let number = $("input[name='jumlah_barang']").val();
        let totalHarga = number * jual;
        let totalModal = number * modalBarang;
        $("input[name='total_harga']").val(totalHarga);
        $("input[name='total_modal']").val(totalModal);
    });


    let currentTransaction = {
        idUserKasir: $("input[name='id_barang']").val(),
        orders: []
    };
    function refreshTable() {
        console.log('transact', currentTransaction.orders);
        $("#transactionTable tbody tr").remove();

        if (currentTransaction.orders.length === 0) {
            $('#transactionTable tbody').append(
                `<tr><td colspan="7">Silahkan Pilih Barang</td></tr>`
            );
        } else {
            currentTransaction.orders.forEach(row => {
                $('#transactionTable tbody').append(
                    `<tr id="${row.itemId}"><td>${row.kategori_barang}</td><td>${row.merk}</td><td>${row.tipe}</td><td>${row.harga}</td><td>${row.jumlah}</td><td>${row.totalHarga}</td><td><button type='button' id='delete${row.itemId}' class='btn btn-danger-alt'>Delete</button></td></tr>`
                );
    
                $(`#delete${row.itemId}`).on('click', function (e) {
                    currentTransaction.orders = currentTransaction.orders.filter(order => {
    
                        if (order.itemId === row.itemId)
    
                            return false;
                        return true;
    
    
                    })
                    refreshTable();
                    calculateTotalSemua();
                    calculateModalSemua();
                });
            })
        }
    }
    function calculateTotalSemua() {
        let totalhargaSemua = 0;
        currentTransaction.orders.forEach(function (order) {
            totalhargaSemua += order.totalHarga;
        })
        $("input[name='total_pembelian']").val(totalhargaSemua)
    }

    function calculateModalSemua(){
        let totalModalSemua = 0;
        currentTransaction.orders.forEach(function (order) {
            totalModalSemua += order.totalModal;
        })
        $("input[name='total_modal_semua']").val(totalModalSemua)
    }

    $('#addBarang').on('click', function (e) {
        // console.log(modal)
        if ($("input[name='merk_barang']").val() == "") {
            Swal.fire(
                'Info!',
                'Harap pilih barang terlebih dahulu',
                'info'
            )
        } else {
            const newOrder = {
                kategori_barang: $("input[name='kategori_barang']").val(),
                itemId: $("input[name='id_barang']").val(),
                merk: $("input[name='merk_barang']").val(),
                tipe: $("input[name='tipe_barang']").val(),
                harga: parseInt($("input[name='harga_barang']").val()),
                jumlah: parseInt($("input[name='jumlah_barang']").val()),
                totalHarga: parseInt($("input[name='total_harga']").val()),
                totalModal: parseInt($("input[name='total_modal']").val()),
                modal : modalBarang
            };

            let orderExists = false;
            let oldOrder;
            currentTransaction.orders.forEach(order => {
                if (newOrder.itemId === order.itemId) {
                    orderExists = true;
                    oldOrder = order;
                }
            });

            if (orderExists === true) {
                // Logic cek total barang kelebihan atau ga, kalau ga, tambahin di yg lama.
                if (parseInt($("input[name='total_barang']").val()) < (newOrder.jumlah + oldOrder.jumlah)) {
                    //error
                } else {
                    oldOrder.jumlah += newOrder.jumlah;
                    oldOrder.totalHarga += newOrder.totalHarga;
                    oldOrder.totalModal += newOrder.totalModal;
                }
            } else {
                currentTransaction.orders.push(newOrder)
            }

            calculateTotalSemua();
            calculateModalSemua();
            refreshTable();

        } //
    })



    $('#submitAbc').on('click', function (e) {
        // Ke json JSON.stringify(inputObject);
        // ke object JSON.parse(input);
        
        if (currentTransaction.orders == "" || $("input[name='tanggal_beli']").val() == "" 
        || $("input[name='nama_pelanggan']").val() == "" || $("input[name='alamat_pelanggan']").val() == "" 
        || $("input[name='no_telepon']").val() == "") {
            Swal.fire({
                title: 'Oops...',
                text: 'Harap disii dengan benar!',
                type: 'warning',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Kembali',
                backdrop: `rgba(0,0,123,0.4)`
            })
        } else {
            $.ajax({
                type: 'post',
                url: '/admin/kasir',

                data: {

                    //....
                    'no_invoice' : $("input[name='no_invoice']").val(),
                    'tanggal_beli': $("input[name='tanggal_beli']").val(),
                    'nama_pelanggan': capital_letter($("input[name='nama_pelanggan']").val()),
                    'alamat' : capital_letter($("input[name='alamat_pelanggan']").val()),
                    'no_telepon' : $("input[name='no_telepon']").val(),
                    'total_pembelian' : $("input[name='total_pembelian']").val(),
                    'total_modal_semua' : $("input[name='total_modal_semua']").val(),
                    'orders': currentTransaction.orders
                },
                success: function (data) {
                    console.log(data);
                    window.location.href ='/admin/transaksi-penjualan/daftar-transaksi-success';
                }
            })
        }
    })


    $('#resetAbc').on('click', function (e) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus semua data transaksi!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, jangan hapus',
            confirmButtonText: 'Yes, hapus',

            width: '400px'
        }).then((result) => {
            if (result.value) {
                document.getElementById('no_invoice').value = ''
                document.getElementById('tanggal').value = ''
                document.getElementById('nama_pelanggan').value = ''
                document.getElementById('alamat').value = ''
                document.getElementById('no_telepon').value = ''
                document.getElementById('merk_barang').value = ''
                document.getElementById('kategori_barang').value = ''
                document.getElementById('tipe_barang').value = ''
                document.getElementById('harga_barang').value = ''
                document.getElementById('jumlah_barang').value = ''
                document.getElementById('total_harga').value = ''
                document.getElementById('total_pembelian').value = '0'
                document.getElementById('total_modal').value = ''
                document.getElementById('total_modal_semua').value = '0'

                // delete currentTransaction.orders[0]
                var i = currentTransaction.orders.length
                while (i--) {
                    currentTransaction.orders.splice(i, 1);
                }

                refreshTable();
            }
        });

    });

    // touchspin jumlah barang
    let maxx;
    $("input[name='jumlah_barang']").TouchSpin({
        min: 1,
        max: maxx,
        stepinterval: 1,
        maxboostedstep: maxx,
    });


    // modal
    $(document).ready(function () {
        // Attach Button click event listener 
        $("#add_button").click(function () {
            // show Modal
            $('#cariBarangModal').modal('show');
        });
    });




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
            if ($(this).parent().next()) {
                $(this).parent().next().remove()
            }
        })
    })

    //Initialize datetime mask
    $('input[name="tanggal_beli"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" }, { showMaskOnHover: false })

    //daterangepicker
    $('#date-rangepicker-tanggal-beli').daterangepicker({
        autoUpdateInput: true,
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY',
            cancelLabel: 'Clear'
        }

    });

    $('#date-rangepicker-tanggal-beli').on('apply.daterangepicker', function (ev, picker) {

        $('input[name="tanggal_beli"]').val(picker.startDate.format(picker.locale.format));
        $('input[name="tanggal_beli"]').addClass('has-val');
        if ($('input[name="tanggal_beli"]').parent().next()) {
            $(this).parent().next().remove()
        }


        //$('input[name="waktuLapor"]').parsley().validate();
    });

})
