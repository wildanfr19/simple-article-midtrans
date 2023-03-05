@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <strong>Detail Pesanan</strong>
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
                        </table>
                        <button class="btn btn-primary" id="pay-button">Bayar sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  @endsection
  @push('js')
  <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          alert("payment success!"); 
          var id = "{{ $order->id }}";
          var route = "{{ route('order.invoice',':id') }}";
          route = route.replace(':id', id);
          window.location.href = route;
          console.log(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
  </script>
  @endpush