//bar chart
console.log('tnaggak brto',dataStatsHari);
$( document ).ready(function() {
    var token = $('meta[name="csrf-token"]').attr('content')
    $('#daterangepicker_daftarPenjualan span').html(mulai);
    $.ajax({
        url: '/kasir/bar-stats-tahun',
        type: 'post',
        data: {
            _token: token,
            date_start: mulai,
            q_status: "fin"
        },
        dataType: 'json',
        success: function (result) {
            const labaArray = generateLabaArray(result);
            const totalPembelianArray = generateTotalPembelianArray(result);
            console.log('laba', labaArray);
            console.log('totalPembelian', totalPembelianArray);
            $('#spinner').hide()
            if (totalPembelianArray[0] == 0 && totalPembelianArray[1] == 0 && totalPembelianArray[2] == 0 && totalPembelianArray[3] == 0
                && totalPembelianArray[4] == 0 && totalPembelianArray[5] == 0 && totalPembelianArray[6] == 0 && totalPembelianArray[7] == 0
                && totalPembelianArray[8] == 0 && totalPembelianArray[9] == 0 && totalPembelianArray[10] == 0 && totalPembelianArray[11] == 0) {
                if (myChart != null) myChart.destroy();
                $('#msg-info').html('<span>Belum ada transaksi penjualan tahun - </span>');                
            } else {
                if (myChart != null) myChart.destroy();
                renderChart(totalPembelianArray, labaArray);                
             }
        },
        error: function (err) {
            $('#spinner').hide()
            $('#msg-info').html('<span >Data tidak dapat dimuat, harap refresh ulang halaman</span>')
        }
    })
// end ajax untuk tahun

//start hari
$('#daterangepicker_dashboard span').html('Hari ini, tanggal '+ dataStatsHari );
$.ajax({
    url: "/kasir/bar-stats-hari",
    type: 'post',
    data: {
        _token: token,
        date_start: dataStatsHari,
        date_end: dataStatsHari,
    },
    dataType: 'json',
    success: function (result) {
        $('#spinner_hari').hide()
        if (result.total_harga.length === 0 && result.total_laba.length === 0 && result.subjek.length === 0) {
                if (myChartHari != null) myChartHari.destroy();
                $('#msg-info_hari').html('<span>Belum ada transaksi penjualan hari ini</span>');                 
            } else {        
                if (myChartHari != null) myChartHari.destroy();
        // console.log(result)               
        console.log(result)
        renderChartHari(result.total_harga, result.subjek, result.total_laba);
        }
    },
    error: function (err) {
        $('#spinner_hari').hide()
        $('#msg-info_hari').html('<span >Data tidak dapat dimuat, harap refresh ulang halaman</span>')
    }
})

})

var myChart;
function renderChart(totalDapat, laba) {
    let ctx = document.getElementById('bar-chart');
    myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei',
        'Juni','Juli','Agustus','September','Oktober','November','Desember'],
        datasets: [
                {
            label: 'Total Pendapatan',
            data : totalDapat,
            backgroundColor: bgColor(totalDapat),
        },
        {
            label: 'Total Laba',
            data: laba,
            backgroundColor: bgColor(laba),
        }
    ]
},
    options: {
        responsive: 'true',
        scales: {
            yAxes: [{
                    // barThickness: 75, //lebar barnya
                ticks: {
                    beginAtZero: true,
                    fontSize: 13,
                },
                scaleLabel: { 
                    fontStyle: 'bold',
                    fontSize: 15,
                    display: true,
                    labelString: 'Jumlah didapat'
                }
            }],
            xAxes: [{
                    // barThickness: 75,                    
                ticks:{
                    fontSize: 13,

                },
                scaleLabel: { 
                    fontStyle: 'bold',
                    fontSize: 15,
                    display: true,
                    labelString: 'Bulan'
                }

            }]
        },
        legend: {
            display: false
            }
        }
    });
}

function generateTotalPembelianArray(dbReturn) {
    console.log('test', !!dbReturn['February'])
    return [
        dbReturn['January']  ?  dbReturn['January'].total_pembelian : 0,
        dbReturn['February']  ? dbReturn['February'].total_pembelian : 0,
        dbReturn['March']  ? dbReturn['March'].total_pembelian : 0,
        dbReturn['April']  ? dbReturn['April'].total_pembelian : 0,
        dbReturn['May']  ? dbReturn['May'].total_pembelian : 0,
        dbReturn['June']  ? dbReturn['June'].total_pembelian : 0,
        dbReturn['July']  ? dbReturn['July'].total_pembelian : 0,
        dbReturn['August']  ? dbReturn['August'].total_pembelian : 0,
        dbReturn['September']  ? dbReturn['September'].total_pembelian : 0,
        dbReturn['October']  ? dbReturn['October'].total_pembelian : 0,
        dbReturn['November']  ? dbReturn['November'].total_pembelian : 0,
        dbReturn['December']  ? dbReturn['December'].total_pembelian : 0,
    ]
}

function generateLabaArray(dbReturn) {
    return [
        dbReturn['January']  ? dbReturn['January'].laba : 0,
        dbReturn['February']  ? dbReturn['February'].laba : 0,
        dbReturn['March']  ? dbReturn['March'].laba : 0,
        dbReturn['April']  ? dbReturn['April'].laba : 0,
        dbReturn['May']  ? dbReturn['May'].laba : 0,
        dbReturn['June']  ? dbReturn['June'].laba : 0,
        dbReturn['July']  ? dbReturn['July'].laba : 0,
        dbReturn['August']  ? dbReturn['August'].laba : 0,
        dbReturn['September']  ? dbReturn['September'].laba : 0,
        dbReturn['October']  ? dbReturn['October'].laba : 0,
        dbReturn['November']  ? dbReturn['November'].laba : 0,
        dbReturn['December']  ? dbReturn['December'].laba : 0,
    ]
}

$(function () {
    let token = $('meta[name="csrf-token"]').attr('content')
    $('#daterangepicker_daftarPenjualan').daterangepicker({
        ranges: {
            'Tahun Ini': [moment().subtract(0, 'year'), moment()],
            '1 tahun lalu': [moment().subtract(1, 'year'), moment()],
            '2 tahun lalu': [moment().subtract(2, 'year'), moment()],
            '3 tahun lalu': [moment().subtract(3, 'year'), moment()],
            '4 tahun lalu': [moment().subtract(4, 'year'), moment()],
            '5 tahun lalu': [moment().subtract(5, 'year'), moment()],
             },
            "showCustomRangeLabel": false,
          
    });

    $('#daterangepicker_daftarPenjualan').on('apply.daterangepicker', function (ev, picker) {
         $('#daterangepicker_daftarPenjualan span').html(picker.startDate.locale('id').format('YYYY') );
        $('input[name="date_start"]').val(picker.startDate.format('YYYY'))
        $('#msg-info').html('')
        $('#spinner').fadeIn()
        console.log($('input[name="date_start"]').val())
        $.ajax({
            url: '/kasir/bar-stats-tahun',
            type: 'post',
            data: {
                _token: token,
                date_start: $('input[name="date_start"]').val(),
                q_status: "fin"
            },
            dataType: 'json',
            success: function (result) {
                const labaArray = generateLabaArray(result);
                const totalPembelianArray = generateTotalPembelianArray(result);
                console.log('laba', labaArray);
                console.log('totalPembelian', totalPembelianArray);
                $('#spinner').hide()
                if (totalPembelianArray[0] == 0 && totalPembelianArray[1] == 0 && totalPembelianArray[2] == 0 && totalPembelianArray[3] == 0
                    && totalPembelianArray[4] == 0 && totalPembelianArray[5] == 0 && totalPembelianArray[6] == 0 && totalPembelianArray[7] == 0
                    && totalPembelianArray[8] == 0 && totalPembelianArray[9] == 0 && totalPembelianArray[10] == 0 && totalPembelianArray[11] == 0) {
                    if (myChart != null) myChart.destroy();
                    $('#msg-info').html('<span>Belum ada transaksi penjualan tahun ini</span>');                
                    document.getElementById("judulTahun").innerHTML = "Statistik Penjualan Tahun - " + $('input[name="date_start"]').val();
                } else {
                    if (myChart != null) myChart.destroy();
                    renderChart(totalPembelianArray, labaArray);
                    document.getElementById("judulTahun").innerHTML = "Statistik Penjualan Tahun - " + $('input[name="date_start"]').val();
                 }
            },
            error: function (err) {
                $('#spinner').hide()
                $('#msg-info').html('<span >Data tidak dapat dimuat, harap refresh ulang halaman</span>')
            }
        })
    })
})

//bar perhari mulai dari sini
//bar chart
let myChartHari;
function renderChartHari(totalDapat, labels, laba) {
    let ctx = document.getElementById('bar-chart_hari'); 
    myChartHari = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
                {
            label: 'Total Pendapatan',
            data : totalDapat,
            backgroundColor: bgColor(totalDapat),
        },
        {
            label: 'Total Laba',
            data: laba,
            backgroundColor: bgColor(laba),
        }
    ]
},
    options: {
        responsive: 'true',
        scales: {
            yAxes: [{
                    // barThickness: 75, //lebar barnya
                ticks: {
                    beginAtZero: true,
                    fontSize: 13,
                },
                scaleLabel: { 
                    fontStyle: 'bold',
                    fontSize: 15,
                    display: true,
                    labelString: 'Jumlah didapat'
                }
            }],
            xAxes: [{
                    // barThickness: 75,                    
                ticks:{
                    fontSize: 13,

                },
                scaleLabel: { 
                    fontStyle: 'bold',
                    fontSize: 15,
                    display: true,
                    labelString: 'Bulan'
                }

            }]
        },
        legend: {
            display: false
            }
        }
    });
}


//define function to calculate time differences between now and given date
function diffDuration(date_start_hari, date_end_hari) {
    const startDate = moment(date_start_hari, 'YYYY-MM-DD HH:mm:ss')
    const endDate = moment(date_end_hari, 'YYYY-MM-DD HH:mm:ss')

    // get the difference between the moments
    const diff = endDate.diff(startDate, 'hours');

    // display
    return diff
}

$(function () {
    let token = $('meta[name="csrf-token"]').attr('content')
    $('#daterangepicker_dashboard').daterangepicker({
        ranges: {
            'Kemarin': [moment().subtract(1, 'days'), moment()],
            '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
            '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
            'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
            'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            "customRangeLabel": "Tanggal"
        },
    });
    $('#daterangepicker_dashboard').on('apply.daterangepicker', function (ev, picker) {
        $('#daterangepicker_dashboard span').html(picker.startDate.locale('id').format('D MMMM YYYY') + ' - ' + picker.endDate.locale('id').format('D MMMM YYYY'));
        $('input[name="date_start_hari"]').val(picker.startDate.format('DD/MM/YYYY HH:mm'))
        $('input[name="date_end_hari"]').val(picker.endDate.format('DD/MM/YYYY HH:mm'))
        $('#msg-info_hari').html('')
        $('#spinner_hari').fadeIn()
        
        //isis didisini

        $.ajax({
            url: "/kasir/bar-stats-hari",
            type: 'post',
            data: {
                _token: token,
                date_start: $('input[name="date_start_hari"]').val(),
                date_end: $('input[name="date_end_hari"]').val(),
            },
            dataType: 'json',
            success: function (result) {                
                $('#spinner_hari').hide()
                // myChartHari.destroy();
                if (result.total_harga.length == 0 && result.total_laba.length == 0) {
                    if (myChartHari != null)myChartHari.destroy();
                    $('#msg-info_hari').html('<span>Belum ada transaksi penjualan tahun ini</span>');                 
                    document.getElementById("judulHari").innerHTML = "Statistik Penjualan Tanggal " + result.judulMulai +" sampai "+ result.judulSelesai;
                } else {        
                    // console.log(result)               
                    console.log(result)
                    if (myChartHari != null)myChartHari.destroy();
                    renderChartHari(result.total_harga, result.subjek, result.total_laba);
                    document.getElementById("judulHari").innerHTML = "Statistik Penjualan Tanggal " + result.judulMulai +" sampai "+ result.judulSelesai;
                }
            },
            error: function (err) {
                $('#spinner_hari').hide()
                $('#msg-info_hari').html('<span >Data tidak dapat dimuat, harap refresh ulang halaman</span>')
            }
        })


    }) //daterange picker
})

//generate background color
function bgColor(data) {
    const color = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(113, 126, 111, 1)',
        'rgba(130, 157, 151, 1)',
        'rgba(108, 99, 107, 1)',
        'rgba(38, 46, 68, 1)'
    ]
    var bg = []
    let numBefore = Math.floor(Math.random() * (6 - 0 + 1) + 0)
    $.each(data, function (index, value) {
        let ran = randomNumber(6, 0, numBefore)
        bg.push(color[ran])
        numBefore = ran
    })
    return bg
}
//generating random number
function randomNumber(max, min, except) {
    let num = Math.floor(Math.random() * (max - min + 1)) + min;
    return (num === except) ? randomNumber(max, min, except) : num;
}






