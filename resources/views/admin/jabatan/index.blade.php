@extends('layouts.app')

@section('title', 'Jabatan')
@section('header', 'Jabatan')

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
            <i class="fas fa-plus"></i> Tambah Jabatan
        </button>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
               <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Jabatan</h6>
                        </div>
               <div class="card-body">
                 <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gaji</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($jabatan as $item)
                                <tr id="tr-jabatan-{{$item->id}}">
                                    <td>{{$item->name}}</td>
                                    <td>{{number_format($item->sallary,0,",",".")}}</td>
                                    <td>
                                        <button type="button" onclick="openModalUpdate('{{$item->id}}', '{{$item->name}}', '{{$item->sallary}}')" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
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
                <h5 class="modal-title" id="headingMenuModalLabel">Tambah Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('jabatan.store')}}" method="post">
                @csrf
                <input type="hidden" name="id_jabatan" id="inp_ID-JABATAN">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{old('name')}}" id="inp-NAME" class="form-control form-control-sm"
                            placeholder="Masukan Nama Jabatan...">
                    </div>

                     <div class="form-group">
                        <label for="">Gaji</label>
                        <input type="text" name="gaji" value="{{old('gaji')}}" id="inp-GAJI" class="form-control form-control-sm"
                            placeholder="Masukan Gaji...">
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

  

    function openModalUpdate(id, name, gaji) {
        $('#headingMenuModal').modal('show')

        $('#inp_ID-JABATAN').val(id);
        $('#inp-NAME').val(name);
        $('#inp-GAJI').val(gaji);
    }

    function confirmDelete(id) {

        if (confirm("Apakah anda yakin?")) {
            $('#inp-div-messages').html('');
            $.ajax({
                'url': '{{route('jabatan.destroy')}}',
                'method': 'POST',
                'data': {
                    "_token": "{{csrf_token()}}",
                    "id": id,
                },
                success: function (resp) {
                    $('#tr-jabatan-' + id).fadeOut('150', function () {
                        $('#tr-jabatan-' + id).remove();
                        $('#inp-div-messages').html(`
                            <div class="alert alert-success">
                                Selamat!, Anda berhasil menghapus jabatan
                            </div>
                        `);

                    });
                }
            });
        }
    }

</script>
@endpush
