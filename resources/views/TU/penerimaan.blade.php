@extends('TU.layouts.master')

@section('title', 'Data Penerimaan Siswa')
@section('judul', 'Data Penerimaan Siswa')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Penerimaan Siswa') }}</div>
            <div class="card-body">
                <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                        <th>NO</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NO HP</th>
                            <th>Status</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($penerimaan as $row)
                            <tr>
                            <td>{{ $no++ }}</td>
                                <td>{{ $row->NISN}}</td>
                                <td>{{ $row->nama}}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->no_hp }}</td>
                                <td>@if ($row->status_pendaftaran == 1)
                                    <span>Diterima</span>
                                    @elseif ($row->status_pendaftaran == 2)
                                    <span>Ditolak</span>
                                    @elseif ($row->status_pendaftaran == 0)
                                    <span>Belum diverifikasi</span>
                                    @endif
                                </td>
                                
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    @if ($row->status_pendaftaran == 0)
                                            <a class="btn  btn-success" href="penerimaan/terima/{{$row->id}}"><i class="fa fa-check"></i></a>
                                            <button class="btn btn-xs"></button>
                                            <a class="btn  btn-danger" href="penerimaan/tolak/{{$row->id}}"><i class="fa fa-times"></i></a>
                                            <button class="btn btn-xs"></button>
                                            @else
                                            @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @stop
@section('js')
<script>
     @if(session('status'))
            Swal.fire({
                title: 'Congratulations!',
                text: "{{ session('status') }}",
                icon: 'Success',
                timer: 3000
            })
        @endif
        @if($errors->any())
            @php
                $message = '';
                foreach($errors->all() as $error)
                {
                    $message .= $error."<br/>";
                }
            @endphp
            Swal.fire({
                title: 'Error',
                html: "{!! $message !!}",
                icon: 'error',
            })
        @endif
</script>
@stop