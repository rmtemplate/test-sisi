<div class="table-responsive my-4">

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#cutiModal">
            <i class="fas fa-plus"></i> Tambah Cuti
        </button>
    </div>

    <table class="table table-bordered" id="tableCuti" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawan->cuti as $item)
            <tr id="tr-karyawan-cuti-{{$item->id}}">
                <td>{{$item->start}}</td>
                <td>{{$item->end}}</td>
                <td>{{$item->keterangan}}</td>
                <td>
                    <button type="button" onclick="confirmDeleteCuti('{{$item->id}}')" class="btn btn-danger btn-sm"><i
                            class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" id="cutiModal" tabindex="-1" aria-labelledby="cutiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cutiModalLabel">Tambah Cuti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('karyawan.storeCuti')}}" method="post">
                @csrf
                <input type="hidden" name="id_absensi" id="inp-ID_ABSENSI">
                <input type="hidden" name="id_karyawan" id="inp-ID_KARYAWAN" value="{{$karyawan->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggal Mulai</label>
                        <input type="date" name="start" value="{{old('start')}}" id="inp-START" class="form-control form-control-sm"
                            placeholder="Masukan Tanggal...">
                    </div>

                    <div class="form-group">
                        <label for="">Tanggal Selesai</label>
                        <input type="date" name="end" value="{{old('end')}}" id="inp-END" class="form-control form-control-sm"
                            placeholder="Masukan Tanggal...">
                    </div>

                     <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="" cols="30" rows="4"></textarea>
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