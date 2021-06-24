
$(function () {
    var data = [], data2 = []
    $.each(dataLaporan, function (key, val) {
        switch (key) {
            case 'user_nama': data['nama'] = '<tr><th>Nama Teknisi</th><td>' + val + '</td></tr>'
                break
            case 'waktu_mulai':
                let date_start = moment(val, 'YYYY-MM-DD HH:mm:ss', 'id').format("dddd, DD MMMM YYYY")
                let time_start = moment(val, 'YYYY-MM-DD HH:mm:ss', 'id').format("HH:mm") + " WIB"
                data['waktu_mulai'] = '<tr><th>Waktu Mulai Instalasi</th><td>' + date_start + ' - ' + time_start + '</td></tr>'
                break
            case 'waktu_selesai':
                let date_finished = moment(val, 'YYYY-MM-DD HH:mm:ss', 'id').format("dddd, DD MMMM YYYY")
                let time_finished = moment(val, 'YYYY-MM-DD HH:mm:ss', 'id').format("HH:mm") + " WIB"
                data['waktu_selesai'] = '<tr><th>Waktu Selesai Instalasi</th><td>' + date_finished + ' - ' + time_finished + '</td></tr>'
                break
        }
    })
    $.each(dataInstansi, function (key, val) {
        switch (key) {
            case 'nama_instansi': data['nama_instansi'] = '<tr><th>Nama Instansi</th><td>' + val + '</td></tr>'
                break
            case 'kategori': data['kategori'] = '<tr><th>Kategori</th><td>' + val + '</td></tr>'
                break
            case 'alamat_instansi': data['alamat'] = '<tr><th>Alamat</th><td>' + capital_letter(val) + '</td></tr>'
                break
            case 'provinsi': data['provinsi'] = '<tr><th>Provinsi</th><td>' + capital_letter(val) + '</td></tr>'
                break
            case 'kabupaten_kota': data['kabupaten'] = '<tr><th>Kabupaten / kota</th><td>' + capital_letter(val) + '</td></tr>'
                break
        }
    })
    data['pic'] = renderPic(dataPic)
    renderTb1(data)
    data2['berkala'] = renderLaporanBerkala(dataLaporanBerkala)
    renderTb2(data2)
    renderLaporanTraining(dataLaporanTraining)
})
function renderTb1(data) {
    $('.tb1').append(data.nama)
    $('.tb1').append(data.nama_instansi)
    $('.tb1').append(data.kategori)
    $('.tb1').append(data.alamat)
    $('.tb1').append(data.provinsi)
    $('.tb1').append(data.kabupaten)
    $('.tb1').append(data.waktu_mulai)
    $('.tb1').append(data.waktu_selesai)
    $('.tb1').append(data.pic)
}
function renderTb2(data){
    $('.tb2').append(data.berkala)
}
function renderPic(dataPic) {
    var result = ''
    $.each(dataPic, function (key, val) {
        if (key != dataPic.length - 1) {
            result += '<td>' + capital_letter(val.nama_pic) + '</td><td>' + val.kontak_pic + ' <i class="fas fa-fw fa-phone"></i></td>'
        } else {
            result += '<tr><td>' + val.nama_pic + '</td><td>' + val.kontak_pic + ' <i class="fas fa-fw fa-phone"></i></td></tr>'
        }
    })
    return '<tr><th rowspan="2">Daftar PIC</th>' + result + '</tr>'
}
function renderLaporanBerkala(dataBerkala) {
    var result = ''
    if (typeof dataBerkala == null) { return '<td> - </td>' }
    else {
        $.each(dataBerkala, function (key, val) {
                let date = moment(val.created_at, 'YYYY-MM-DD HH:mm:ss', 'id').format("dddd, DD MMMM YYYY - HH:mm") + " WIB"
                let content = val.isi_laporan.split(';+;')
                result += '<tr><th scope="row">'+(key+1)+'</th><td>'+capital_letter(val.subjek)+'</td><td>'+date+'</td><td>'+content[0]+'</td><td>'+content[1]+'</td></tr>'
        })
        return result
    }
}
function renderLaporanTraining(dataTraining){
    if (typeof dataTraining == null) { return '<td> - </td>' }
    else {
        let date_start_t = moment(dataTraining.waktu_mulai_t, 'YYYY-MM-DD HH:mm:ss', 'id').format("dddd, DD MMMM YYYY - HH:mm") + " WIB"
        let date_finished_t = moment(dataTraining.waktu_selesai_t, 'YYYY-MM-DD HH:mm:ss', 'id').format("dddd, DD MMMM YYYY - HH:mm") + " WIB"
        $('#waktu_mulai_t').html(date_start_t)
        $('#waktu_selesai_t').html(date_finished_t)
        $('#informasi_t').html(dataTraining.informasi_tambahan)
    }
}
function capital_letter(str) {
    str = str.toLowerCase()
    str = str.split(" ");

    for (let i = 0, x = str.length; i < x; i++) {
        str[i] = str[i][0].toUpperCase() + str[i].substr(1);
    }

    return str.join(" ");
}