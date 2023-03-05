<!-- menggunakan kerangka dari halaman master.blade.php --> 
@extends('layouts.app')
 
<!-- membuat komponen title sebagai judul halaman -->
{{-- @section('title', 'Blog Niaga')
 
@section('header')
  
@endsection --}}
@section('header')
<center>
    <h2>Simple Blog</h2>
    {{-- <a href=""><button class="btn btn-success">Tambah Artikel</button></a> --}}
</center>
<p class="menu-label">Categories</p>
	<ul class="menu-list">
		{{-- @foreach($categories as $category) --}}
        <li>
            <a href="{{ route('artikel.dashboardshow') }}">All
              <sup><a href="#" class="badge badge-success">{{ $data->count() }}</a></sup>
            </a>
		</li>
		<li>
			<a href="{{ route('artikel.free') }}"> Free
                <sup><a href="#" class="badge badge-success">{{ $free }}</a></sup>
			</a>
		</li>
        <li>
			<a href="{{ route('artikel.berbayar') }}"> Berbayar
                <sup><a href="#" class="badge badge-success">{{ $berbayar }}</a></sup>
			</a>
		</li>
	</ul>
@endsection

<!-- membuat komponen main yang berisi form untuk mengisi judul dan isi artikel -->
@section('main')
@foreach ($data as $article)
<div class="col-md-4 col-sm-12 mt-4">
    @php
    $model = new \App\Order();
    $cekPaid = $model->checkOrderExists(Auth::user()->name, $article->id, 'Paid');
    @endphp
    <div class="card">
        <img src="{{ asset('img/image-dummy.jpg') }}" class="card-img-top" alt="gambar" >
        <div class="card-body">
            <div class="small text-muted">
               {{ $article->kategori }}
            </div>
            <h5 class="card-title">{{ $article->judul }}</h5>
            @if($article->kategori == 'Free')
            <a href="{{ route('artikel.detail', $article->id) }}" class="btn btn-primary">Baca Artikel</a>
            @else
             @if($cekPaid->isNotEmpty())
             <a href="{{ route('artikel.detail', $article->id) }}" class="btn btn-primary">Baca Artikel</a>

             @else
             <a href="{{ route('order.index', $article->id) }}" class="btn btn-danger">Buy</a>
             @endif
             
            @endif

        </div>
    </div>
</div>
@endforeach
@endsection