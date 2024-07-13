@extends('admin.layouts.master')
@section('title','Data Pengguna')
@section('judul','Data Pengguna')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Pengguna') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
            
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>id_status</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    @php $no=1; @endphp
                        @foreach ($pengguna as $row)
                            <tr>
                                <td >{{ $no++ }}</td>
                                <td >{{ $row->id_status }}</td>
                                <td >{{ $row->name }}</td>
                                <td >{{ $row->username }}</td>
                                <td >{{ $row->email }}</td>
                                <td >{{ $row->roles->name }}</td>
                                <td >
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-user" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahUserModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->name }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Tambah Mapel -->
<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.pengguna.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_status">ID Status</label>
                            <input type="number" class="form-control" name="id_status" id="id_status" required />
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" required />
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required />
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required />
                        </div>
                        <div class="form-group">
                        <label for="roles_id">Roles</label>
                            <select name="roles_id" id="roles_id" class="form-control">
                            <option value="">Pilih Roles</option>
                            @foreach($roles as $rl)
                            <option value="{{$rl->id}}">{{$rl->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        </div>
                        
                <div class="modal-footer">
              
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


     <!-- Ubah Tingkatan -->
     <div class="modal fade" id="ubahUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.pengguna.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit-id_status">ID Status</label>
                            <input type="number" class="form-control" name="id_status" id="edit-id_status" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-name">Nama</label>
                            <input type="text" class="form-control" name="name" id="edit-name" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-username">Username</label>
                            <input type="text" class="form-control" name="username" id="edit-username" required />
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit-email">Email</label>
                            <input type="text" class="form-control" name="email" id="edit-email" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-password">Password</label>
                            <input type="password" class="form-control" name="password" id="edit-password" required />
                        </div>
                        <div class="form-group">
                        <label for="edit-roles_id">Roles</label>
                            <select name="roles_id" id="edit-roles_id" class="form-control">
                            <option value="">Pilih Roles</option>
                            @foreach($roles as $rl)
                            <option value="{{$rl->id}}">{{$rl->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        </div>
                        </div>
                        
                        

                <div class="modal-footer">
              
                <input type="hidden" name="id" id="edit-id" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
 
    @stop
   

    @section('js')
    <script>
        //EDIT
        $(function() {
            $(document).on('click', '#btn-edit-user', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataUser') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-id_status').val(res.id_status);
                        $('#edit-name').val(res.name);
                        $('#edit-username').val(res.username);
                        $('#edit-email').val(res.email);
                        $('#edit-password').val(res.password);
                        $('#edit-roles_id').val(res.roles_id);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        function deleteConfirmation(npm, judul) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data buku dengan nama " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "data_user/delete/" + npm,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
  
        </script>
    @stop