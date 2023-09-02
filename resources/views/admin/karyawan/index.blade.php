@extends('layouts.app')

@section('title', 'Karyawan')
@section('header', 'Karyawan')

@push('css')
     <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div id="inp-div-messages">
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
    </div>
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">x</span>
        </button>
        <ul class="list-unstyled">
            @foreach($errors->all() as $error)
            <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>

    @endif
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#headingMenuModal">
            <i class="fas fa-plus"></i> Tambah Karyawan
        </button>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
               <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Karyawan</h6>
                        </div>
               <div class="card-body">
                 <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($karyawan as $item)
                                <tr id="tr-karyawan-{{$item->id}}">
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->jabatan->name}}</td>
                                    <td>
                                        <a href="{{route('karyawan.detail', $item->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        <button type="button" onclick="openModalUpdate('{{$item->id}}', '{{$item->name}}', '{{$item->id_jabatan}}' )" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                        <button type="button" onclick="confirmDelete('{{$item->id}}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
               </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Heading --}}
<div class="modal fade" id="headingMenuModal" tabindex="-1" aria-labelledby="headingMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="headingMenuModalLabel">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('karyawan.store')}}" method="post">
                @csrf
                <input type="hidden" name="id_karyawan" id="inp-ID_KARYAWAN">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{old('name')}}" id="inp-NAME" class="form-control form-control-sm"
                            placeholder="Masukan Nama Jabatan...">
                    </div>

                     <div class="form-group">
                        <label for="">Jabatan</label>
                        <select name="id_jabatan" id="inp-ID_JABATAN" class="form-control form-control-sm">
                                <option value="">-- Pilih Jabatan --</option>
                            @foreach ($jabatan as $j)
                                <option value="{{$j->id}}">{{$j->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal --}}

@endsection

@push('js')

<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<script>
    // $('#MenuModal').on('shown.bs.modal', function () {
    //     // $('#myInput').trigger('focus')
    // })

  

    function openModalUpdate(id, name,idJabatan) {
        $('#headingMenuModal').modal('show')

        $('#inp-ID_KARYAWAN').val(id);
        $('#inp-NAME').val(name);
        $('#inp-ID_JABATAN').val(idJabatan);
    }

    function confirmDelete(id) {

        if (confirm("Apakah anda yakin?")) {
            $('#inp-div-messages').html('');
            $.ajax({
                'url': '{{route('karyawan.destroy')}}',
                'method': 'POST',
                'data': {
                    "_token": "{{csrf_token()}}",
                    "id": id,
                },
                success: function (resp) {
                    $('#tr-karyawan-' + id).fadeOut('150', function () {
                        $('#tr-karyawan-' + id).remove();
                        $('#inp-div-messages').html(`
                            <div class="alert alert-success">
                                Selamat!, Anda berhasil menghapus karyawan
                            </div>
                        `);

                    });
                }
            });
        }
    }

</script>
@endpush
