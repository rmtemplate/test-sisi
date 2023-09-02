<div class="table-responsive my-4">

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#gajiModal">
            <i class="fas fa-plus"></i> Tambah Gaji
        </button>
    </div>

    <table class="table table-bordered" id="tableGaji" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tanggal Gaji</th>
                <th>Potongan BPJS</th>
                <th>Potongan Lainnya</th>
                <th>Gaji Bersih</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawan->gaji as $item)
            <tr id="tr-karyawan-gaji-{{$item->id}}">
                <td>{{$item->tanggal_gaji}}</td>
                <td>{{number_format($item->potongan_bpjs,0,",",".")}}</td>
                <td>{{number_format($item->potongan_lainnya,0,",",".")}}</td>
                <td>{{number_format($item->gaji_bersih,0,",",".")}}</td>
                <td>
                    <button type="button" onclick="confirmDeleteGaji('{{$item->id}}')" class="btn btn-danger btn-sm"><i
                            class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" id="gajiModal" tabindex="-1" aria-labelledby="gajiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gajiModalLabel">Tambah Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('karyawan.storeGaji')}}" method="post">
                @csrf
                <input type="hidden" name="id_gaji" id="inp-ID_GAJI">
                <input type="hidden" name="id_karyawan" id="inp-ID_KARYAWAN" value="{{$karyawan->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggal Gaji</label>
                        <input type="date" name="tanggal_gaji" value="{{old('tanggal_gaji')}}" id="inp-TANGGAL_GAJI" class="form-control form-control-sm"
                            placeholder="Masukan Tanggal...">
                    </div>

                    <div class="form-group">
                        <label for="">Potongan BPJS</label>
                        <input type="number" name="potongan_bpjs" value="{{old('potongan_bpjs')}}" id="inp-POTONGAN_BPJS" class="form-control form-control-sm"
                            placeholder="Masukan Potongan BPJS...">
                    </div>

                    <div class="form-group">
                        <label for="">Potongan Lainnya</label>
                        <input type="number" name="potongan_lainnya" value="{{old('potongan_lainnya')}}" id="inp-POTONGAN_LAINNYA" class="form-control form-control-sm"
                            placeholder="Masukan Potongan Lainnya...">
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