<!-- menggunakan kerangka dari halaman master.blade.php --> 
@extends('layouts.app')
 
<!-- membuat komponen title sebagai judul halaman -->
{{-- @section('title', 'Blog Niaga')
 
@section('header')
  
@endsection --}}

<!-- membuat komponen main yang berisi form untuk mengisi judul dan isi artikel -->
@section('main')

<div class="col-md-4 col-sm-12 mt-4">
    <div class="card">
        <img src="{{ asset('img/image-dummy.jpg') }}" class="card-img-top" alt="gambar" >
        <div class="card-body">
            <div class="small text-muted">
                <table class="table table-borderless">
                    <tr>
                        <td>Nama Artikel</td>
                        <td>:</td>
                        <td>{{ $data->judul }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                </table>
            </div>
            <form action="{{ route('order.bayar') }}" method="post">
            @csrf
            @method('POST')
            <input type="hidden" value="{{ $data->id }}" name="id">
            <button type="submit" class="btn btn-primary">Bayar & CheckOut</button>
            </form>
        </div>
    </div>
</div>

@endsection