@extends('layouts.app')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/Datatables/dataTables.bootstrap4.min.css') }}">

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List Artikel') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <div class="card-body">
                       <a class="btn btn-primary mb-3" id="add-new">Add New Artikel</a>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="datatable datatable-primary">
                                    <div class="table-responsive">
                                        <table id="list-datatables" class="table table-condensed table-bordered table-hover" style="width:100%">
                                            <thead class="text-capitalize">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Judul</th>
                                                    <th>Kategori</th>
                                                    <th>Deskripsi</th>
                                                    <th width="15%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@include('artikel.modal.add-new-modal')
@include('artikel.modal.edit')
@endsection

@push('js')

<script src="{{ asset('vendor/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
        $(document).on('click','#add-new', function(){
            $('#modal-add').modal('show');
        })
      
        var table = $('#list-datatables').DataTable({
            "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
            }],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('artikel.dashboard') }}",
            },
            order: [[ 0, 'desc']],
            responsive: true,
            columns: [
            {
                    data: null,
                    name: null,
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
            },
            { data: 'judul', name: 'judul' },
            { data: 'kategori', name: 'kategori'},
            { data: 'deskripsi', name: 'deskripsi' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ]    
        });

        $(document).on('click','#add-new', function(){
            $('#modal-add').modal('show');
        })
        $('#submit-add').click(function(){
            $.ajax({
                url: "{{ route('artikel.store') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#form-create-artikel').serialize(),
                success: function(response) {
                    if (response.status !== 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Perhatikan Inputan anda!'
                        })
                    } else {
                        Swal.fire(
                            'Successfully!',
                            response.message,
                            'success'
                        )
                        $('#modal-add').modal('hide')
                        $('#list-datatables').DataTable().ajax.reload();
                        $("#form-create-artikel").trigger("reset");
                       
                    }
                }
            })
        })
        //edit
        $(document).on('click','#edit-artikel', function(e){
            e.preventDefault()
            let id = $(this).data('id');
            let route  = "{{ route('artikel.edit', ':id') }}";
		    route  = route.replace(':id', id);
            $.get(route, function(data){
                $('#modal-edit').modal('show');
                $('#id-artikel').val(data.id);
                $('#judul-edit').val(data.judul);
                $('#kategori-edit').val(data.kategori);
                $('#deskripsi-edit').val(data.deskripsi);
            })
        })
        //update
        $('#submit-edit').click(function(){
            let id = document.getElementById('id-artikel').value;
            let route = "{{ route('artikel.update', ':id') }}";
            route  = route.replace(':id', id);
            $.ajax({
                url: route,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#form-edit-artikel').serialize(),
                success: function(response) {
                    if (response.status !== 1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi kesalahan pada sistem!'
                        })
                    } else {
                        Swal.fire(
                            'Successfully!',
                            response.message,
                            'success'
                        )
                        $('#modal-edit').modal('hide')
                        $('#list-datatables').DataTable().ajax.reload();
                       
                    }
                }
            })
        })
        //delete
        $(document).on('click','#delete-artikel', function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Yakin?',
                text: "menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).
            then((willDeleted) => {
                let id = $(this).data('id');
                let route = "{{ route('artikel.destroy', ':id') }}";
                route  = route.replace(':id', id);
                if (willDeleted.value) {
                    $.ajax({
                        url: route,
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            '_method': 'DELETE'
                        },
                        success: function(data) {
                            if (data.status != 1) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'terjadi kesalahan sistem!'
                                });
                            } else {
                                Swal.fire(
                                    'Succesfully!',
                                    data.message,
                                    'success'
                                ).then(function() {
                                    $('#list-datatables').DataTable().ajax.reload();
                                });
                            }
                        }
                    })
                } else {
                    console.log(`data Artikel dismissed by ${willPosted.dismiss}`);
                }
            })

        })



</script>

@endpush
