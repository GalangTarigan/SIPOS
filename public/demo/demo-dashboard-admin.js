//bar chart
$( document ).ready(function() {
    var token = $('meta[name="csrf-token"]').attr('content')
    $.ajax({
        url: '/admin/bar-stats-tahun',
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
                $('#msg-info').html('<span>Belum ada transaksi penjualan tahun ini</span>');                
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






