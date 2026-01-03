@extends('layouts.account')

@section('title')
Dashboard - KASKU
@stop

@section('content')

<script>

</script>

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>SEMUA SALDO </h4>
                        </div>
                        <div class="card-body"
                             style="font-size: 20px">
                            {{ rupiah($saldo_selama_ini) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>SALDO BULAN INI</h4>
                        </div>
                        <div class="card-body"
                             style="font-size: 20px">
                            {{ rupiah($saldo_bulan_ini) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>SALDO BULAN LALU</h4>
                        </div>
                        <div class="card-body"
                             style="font-size: 20px">
                            {{ rupiah($saldo_bulan_lalu) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>
                            <i class="fas fa-chart-column"></i>
                            STATISTIK KEUANGAN MAHASISWA 1 TAHUN ({{ $year }})
                        </h4>
                    </div>
                    <div class="card-body">
                        <div id="container"></div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistik Keuangan Siswa'
    },
    subtitle: {
        text: 'Periode 1 Tahun'
    },
    xAxis: {
        categories: [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nominal (Rp)'
        }
    },
    tooltip: {
        shared: true,
        valuePrefix: 'Rp '
    },
    series: [
        {
            name: 'Pemasukan',
            data: @json($debitData)
        },
        {
            name: 'Pengeluaran',
            data: @json($creditData)
        }
    ]
});
</script>
@stop
