@extends('walikelas.layouts.master')
@section('title','Dashboard')
@section('judul','Dashboard')

@section('content')
<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$siswa->count()}}</sup></h3>
                

                <h5>Siswa</h5>
              </div>
              <div class="icon">
                <i class="fa fa-file"></i>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$jadwal->count()}}</sup></h3>

                <h5>Jadwal</h5>
              </div>
              <div class="icon">
                <i class="fa fa-file"></i>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
      
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$tindakan->count()}}</h3>

                <h5>Tindakan Kelas</h5>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <!-- /.row (main row) -->
        <div class="col-lg-12 col-12">
        <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header"></div>
            <div class="card-body">
    <div id="container"></div>
    </div>
    </div>
    </div>
    </div>

   
       
<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
    var riwayat = <?php echo json_encode($riwayat)?>;

    Highcharts.chart('container', {
        title: {
            text: 'Grafik Riwayat Tindakan'
        },
        subtitle: {
            text: 'SMK PGRI 2 CIANJUR'
        },
        xAxis: {
            categories: ['2024', '2025', '2026', '2027', '2028', '2029', '2030', '2031', '2032',
                '2023', '2024', '2025'
            ]
        },
        yAxis: {
            title: {
                text: 'Nomor Tindakan Kelas'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Tindakan Kelas',
            data: riwayat
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });

</script>
      </div
      

@stop
