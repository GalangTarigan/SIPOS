var dataKeluhan;
var table;
$(function () {
    var token = $('meta[name="csrf-token"]').attr('content')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('#spinner').fadeIn()
    $("#table").css("cursor", "pointer")

    $.ajax({
        // daftar keluhan proyek
        url: "/admin/postKeluhan",
        type: 'post',
        data: {
            "_token": token,
        },
        dataType: 'json',
        success: function (data) {
            console.log(data)
            dataKeluhan = data['data'];
            $('#spinner').fadeOut(200)
            table = $('#table').DataTable({
                "language": {
                    "lengthMenu": "_MENU_"
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'My button',
                        action: function (e, dt, node, config) {
                            alert('Button activated');
                        }
                    }
                ],
                "oLanguage": {
                    "sEmptyTable": "Tidak ada data untuk ditampilkan"
                },
                serverSide: false,
                data: data,
                columns: [
                    { data: null },
                    { data: 'nama_instansi' },
                    { data: 'daftar_subjek' },
                    { data: 'waktu_lapor_keluhan' },
                    { data: 'waktu_selesai_penanganan' },
                ],
                "lengthChange": false,
                "columnDefs": [
                    {
                        "render": function (data, type, row) {
                            var date = moment(data, 'YYYY-MM-DD HH:mm', 'id').format("dddd, D MMMM YYYY ~ HH:mm") + ' WIB';
                            return date
                        },
                        "targets": [3, 4]
                    }, {
                        "render": function (data, type, row) {
                            var result = ''
                            $.each(data, function (key, val) {
                                if (data.length == 1) result = val.subjek_keluhan.nama_subjek
                                else if (key == data.length - 1) {
                                    result += val.subjek_keluhan.nama_subjek
                                } else {
                                    result += val.subjek_keluhan.nama_subjek + ' , '
                                }
                            })
                            return result
                        },
                        "targets": 2
                    },
                    {
                        "render": function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "targets": 0

                    }

                ]
            })
            $('#table').fadeIn(300)
            console.log(data)
        },
        error: function (err) {
            console.log(err)
            $('#spinner').fadeOut(200)
            $('<span >Data tidak dapat dimuat, harap refresh ulang halaman</span>').appendTo($('.text-center'))
            $('#errorLoading').fadeIn(209)
        }
    });
    $('#table').on('click', 'tbody tr', function () {
        let keluhan = table.row(this).data().uuid;
        window.location.href = '/admin/keluhan/detail-keluhan?keluhan=' + keluhan;
    });
})




$(function () {
    var token = $('meta[name="csrf-token"]').attr('content')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('#myspinner').fadeIn()
    $("#mytable").css("cursor", "pointer")
    var table

    $.ajax({
        // Daftar Keluhan Proyek Instansi Per Tahun
        url: "/admin/keluhan-per-tahun",
        type: 'post',
        data: {
            "_token": token,
        },
        dataType: 'json',
        success: function (data) {
            $('#myspinner').fadeOut(200)
            table = $('#mytable').DataTable({
                "language": {
                    "lengthMenu": "_MENU_"
                },
                serverSide: false,
                data: data,
                columns: [
                    { data : null},
                    { data: 'nama_instansi' },
                    { data: 'waktu_lapor_keluhan' },
                    { data: 'jumlah_keluhan' },
                ],
                // "lengthChange": false,
                "columnDefs": [
                    {
                        "render": function (data, type, row) {
                            var date = moment(data, 'YYYY', 'id').format("YYYY");
                            return date
                        },
                        "targets": 2
                    },
                    {
                        "render": function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        "targets": 0

                    }

                ]
            })
            $('#mytable').fadeIn(300)
            console.log(data)
        },
        error: function (err) {
            console.log(err)
            $('#myspinner').fadeOut(200)
            $('<span >Data tidak dapat dimuat, harap refresh ulang halaman</span>').appendTo($('.text-center'))
            $('#errorLoading').fadeIn(209)
        }
    });
    $('#mytable').on('click', 'tbody tr', function () {
        let instansi_id = table.row(this).data().instansi_id;
        let waktu_lapor_keluhan = table.row(this).data().waktu_lapor_keluhan.substr(0, 4);
        // console.log(nama_instansi)
        console.log(waktu_lapor_keluhan)
         window.location.href = '/admin/keluhan/detail-keluhan-per-tahun?instansi=' + instansi_id + '&tahun=' + waktu_lapor_keluhan;
    });
})

$(function () {
    let token = $('meta[name="csrf-token"]').attr('content')
    $('#daterangepicker_daftarProyek').daterangepicker({
        ranges: {
            'Tahun Ini': [moment().subtract(0, 'year'), moment()],
            '1 tahun lalu': [moment().subtract(1, 'year'), moment()],
            '2 tahun lalu': [moment().subtract(2, 'year'), moment()],
            '3 tahun lalu': [moment().subtract(3, 'year'), moment()],
        },
        locale: {
            "customRangeLabel": "Tahun",
        },
    });

    $('#daterangepicker_daftarProyek').on('apply.daterangepicker', function (ev, picker) {
        $('#daterangepicker_daftarProyek span').html(picker.startDate.locale('id').format('YYYY'));
        $('input[name="date_start"]').val(picker.startDate.format('YYYY'))
        $('#msg-info').html('')
        $('#spinner').fadeIn()
        $.ajax({
            url: '/admin/postKeluhan',
            type: 'post',
            data: {
                _token: token,
                date_start: $('input[name="date_start"]').val(),
                q_status: "fin"
            },
            dataType: 'json',
            success: function (data) {
                console.log(data)
                table.clear().draw();
                dataKeluhan = data;
                // console.log(data.data)
                // console.log($('input[name="date_start"]').val())
                $('#spinner').hide()
                if (data.length == 0) {
                    if (table != null) table.clear().draw()
                    $('#msg-info').html('<span>Tidak ada data</span>')
                } else {
                    table.clear().draw();
                    table.rows.add(data); // Add new data
                    table.columns.adjust().draw();
                }
            },
            error: function (err) {
                $('#spinner').hide()
                $('#msg-info').html('<span >Data tidak dapat dimuat, harap refresh ulang halaman</span>')
            }
        })
    })
})