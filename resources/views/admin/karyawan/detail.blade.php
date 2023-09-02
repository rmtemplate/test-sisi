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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail {{$karyawan->name}}</h6>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Absensi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Cuti</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Gaji</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @include('admin.karyawan.widget.absensi')
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @include('admin.karyawan.widget.cuti')
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            @include('admin.karyawan.widget.gaji')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>

<script>
    $('#tableCuti').DataTable();
    $('#tableGaji').DataTable();
    // $('#MenuModal').on('shown.bs.modal', function () {
    //     // $('#myInput').trigger('focus')
    // })



    function openModalUpdate(id, name, idJabatan) {
        $('#headingMenuModal').modal('show')

        $('#inp-ID_KARYAWAN').val(id);
        $('#inp-NAME').val(name);
        $('#inp-ID_JABATAN').val(idJabatan);
    }

    function confirmDeleteAbsen(id) {

        if (confirm("Apakah anda yakin?")) {
            $('#inp-div-messages').html('');
            $.ajax({
                'url': '{{route('karyawan.destroyAbsen')}}',
                'method': 'POST',
                'data': {
                    "_token": "{{csrf_token()}}",
                    "id": id,
                },
                success: function (resp) {
                    $('#tr-karyawan-absen-' + id).fadeOut('150', function () {
                        $('#tr-karyawan-absen-' + id).remove();
                        $('#inp-div-messages').html(`
                            <div class="alert alert-success">
                                Selamat!, Anda berhasil menghapus absen
                            </div>
                        `);

                    });
                }
            });
        }
    }

    function confirmDeleteCuti(id) {

        if (confirm("Apakah anda yakin?")) {
            $('#inp-div-messages').html('');
            $.ajax({
                'url': '{{route('karyawan.destroyCuti')}}',
                'method': 'POST',
                'data': {
                    "_token": "{{csrf_token()}}",
                    "id": id,
                },
                success: function (resp) {
                    $('#tr-karyawan-cuti-' + id).fadeOut('150', function () {
                        $('#tr-karyawan-cuti-' + id).remove();
                        $('#inp-div-messages').html(`
                            <div class="alert alert-success">
                                Selamat!, Anda berhasil menghapus cuti
                            </div>
                        `);

                    });
                }
            });
        }
    }

</script>
@endpush
