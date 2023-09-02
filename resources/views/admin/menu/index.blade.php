@extends('layouts.app')

@section('title', 'Manage Menu')
@section('header', 'Manage Menu')

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
            <i class="fas fa-plus"></i> Tambah Heading Menu
        </button>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($headingMenu as $hm)
            <div class="card shadow mb-3" id="C-Card-{{$hm->id}}">
                <!-- Card Header - Accordion -->
                <a href="#headingMenu-{{$hm->id}}" data-id="{{$hm->id}}" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="headingMenu-{{$hm->id}}">
                    <div class="d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary my-auto">{{$hm->name}}</h6>
                        <div>
                            <button type="button" class="btn btn-primary btn-sm mb-2"
                            onclick="openModalMenu('{{$hm->id}}')">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm mb-2"
                            onclick="deleteHeadingMenu('{{$hm->id}}')">
                            <i class="fas fa-trash"></i>
                        </button>
                        </div>
                    </div>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="headingMenu-{{$hm->id}}" style="">
                    <div class="card-body">
                        <ul style="list-style: none">
                            @foreach ($hm->menu->where('parent_id', NULL) as $menu)
                            <li>
                                <i class="{{$menu->icon}}"></i> {{$menu->name}}  
                                <button type="button" class="btn btn-link btn-sm" onclick="openModalMenuEdit('{{$hm->id}}', '{{$menu->id}}', '{{$menu->id_role}}', '{{$menu->name}}', '{{$menu->icon}}' ,'{{$menu->parent_id}}')"><i class="fas fa-edit"></i></button> 
                                <button class="btn btn-link btn-sm" onclick="deleteMenu('{{$menu->id}}')"><i class="fas fa-trash"></i></button>

                                @if ($menu->subMenu->count() > 0)
                                <ul>

                                    @foreach ($menu->subMenu as $subMenu)
                                    <li>
                                        <i class="{{$subMenu->icon}}"></i> {{$subMenu->name}}
                                         <button type="button" class="btn btn-link btn-sm" onclick="openModalMenuEdit('{{$hm->id}}', '{{$subMenu->id}}', '{{$subMenu->id_role}}', '{{$subMenu->name}}', '{{$subMenu->icon}}' ,'{{$subMenu->parent_id}}')"><i class="fas fa-edit"></i></button> 
                                        <button class="btn btn-link btn-sm" onclick="deleteMenu('{{$subMenu->id}}')"><i class="fas fa-trash"></i></button>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif

                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Modal Heading --}}
<div class="modal fade" id="headingMenuModal" tabindex="-1" aria-labelledby="headingMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="headingMenuModalLabel">Tambah Heading Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('headingMenu.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control form-control-sm"
                            placeholder="Masukan Heading Menu...">
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

{{-- Modal Create Menu --}}
<div class="modal fade" id="MenuModal" tabindex="-1" aria-labelledby="MenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MenuModalLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('menu.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_heading_menu" id="inp-ID_HEADING_MENU">
                    <input type="hidden" name="id_menu" id="inp-ID_MENU">
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="id_role" class="form-control form-control-sm" id="inp-ID_ROLE">
                            <option value="" selected disabled>-- Pilih Role --</option>
                            @foreach ($role as $item)
                            <option value="{{$item->id}}" {{old('id_role') == $item->id ? 'selected' : ''}}>
                                {{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="inp-MENU_NAME" class="form-control form-control-sm" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="">Icon</label>
                        <input type="text" name="icon" id="inp-ICON" class="form-control form-control-sm" value="{{old('icon')}}">
                    </div>

                    <div class="form-group">
                        <label for="">Parent Menu</label>
                        <select name="parent_id" class="form-control form-control-sm" id="inp-PARENT_ID">
                            <option value="" selected >-- Pilih Menu --</option>
                            @foreach ($getMenu as $item)
                            <option value="{{$item->id}}" {{old('parent_id') == $item->id ? 'selected' : ''}}>
                                {{$item->name}}</option>
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
{{-- End Modal Create Menu --}}
@endsection

@push('js')
<script>
    // $('#MenuModal').on('shown.bs.modal', function () {
    //     // $('#myInput').trigger('focus')
    // })

    function openModalMenu(idHeadingMenu) {
        $('#MenuModal').modal('show')

        $('#inp-ID_HEADING_MENU').val(idHeadingMenu);
    }


    function openModalMenuEdit(idHeadingMenu,menuId,idRole,name,icon,parent_id) {
        $('#MenuModal').modal('show')

        $('#inp-ID_HEADING_MENU').val(idHeadingMenu);
        $('#inp-ID_MENU').val(menuId);
        $('#inp-ID_ROLE').val(idRole);
        $('#inp-MENU_NAME').val(name);
        $('#inp-ICON').val(icon);
        $('#inp-PARENT_ID').val(parent_id);
    }

    function deleteHeadingMenu(id) {

        if(confirm("Apakah anda yakin?")) {
            $('#inp-div-messages').html('');
            $.ajax({
                'url': '{{route('headingMenu.destroy')}}',
                'method': 'POST',
                'data' : {
                    "_token" : "{{csrf_token()}}",
                    "id" : id,
                },
                success: function(resp) {
                    $('#C-Card-' + id).fadeOut('150', function() {
                        $('#C-Card-' + id).remove();
                        $('#inp-div-messages').html(`
                            <div class="alert alert-success">
                                Selamat!, Anda berhasil menghapus heading menu
                            </div>
                        `);

                    });
                }
            });
        }
    }

    function deleteMenu(id) {

        if(confirm("Apakah anda yakin?")) {
            $('#inp-div-messages').html('');
            $.ajax({
                'url': '{{route('menu.destroy')}}',
                'method': 'POST',
                'data' : {
                    "_token" : "{{csrf_token()}}",
                    "id" : id,
                },
                success: function(resp) {
                    location.reload();
                }
            });
        }
    }

</script>
@endpush
