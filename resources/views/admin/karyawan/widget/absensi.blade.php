<div class="table-responsive my-4">

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#headingMenuModal">
            <i class="fas fa-plus"></i> Tambah Absensi
        </button>
    </div>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawan->absensi as $item)
            <tr id="tr-karyawan-absen-{{$item->id}}">
                <td>{{$item->tanggal}}</td>
                <td>{{$item->keterangan}}</td>
                <td>
                    <button type="button" onclick="confirmDeleteAbsen('{{$item->id}}')" class="btn btn-danger btn-sm"><i
                            class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" id="headingMenuModal" tabindex="-1" aria-labelledby="headingMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="headingMenuModalLabel">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('karyawan.storeAbsen')}}" method="post">
                @csrf
                <input type="hidden" name="id_absensi" id="inp-ID_ABSENSI">
                <input type="hidden" name="id_karyawan" id="inp-ID_KARYAWAN" value="{{$karyawan->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="date" value="{{old('date')}}" id="inp-DATE" class="form-control form-control-sm"
                            placeholder="Masukan Tanggal...">
                    </div>

                     <div class="form-group">
                        <label for="">Keterangan</label>
                        <select name="keterangan" id="inp-KETERANGAN" class="form-control form-control-sm">
                                <option value="" selected disabled>-- Pilih Keterangan --</option>
                                <option value="Alfa">Alfa</option>
                                <option value="Izin">Izin</option>
                                <option value="Masuk">Masuk</option>
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