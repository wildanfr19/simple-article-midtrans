@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <strong>Invoice Pesanan</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <table class="table table-borderless">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $order->name }}</td>
                            </tr>
                            <tr>
                                <td>Nama Artikel</td>
                                <td>:</td>
                                <td>{{ $judul }}</td>
                            </tr>
                            <tr>
                                <td>Total Price</td>
                                <td>:</td>
                                <td>{{ $order->total_price }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><span class="badge badge-success">{{ $order->status }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  @endsection
