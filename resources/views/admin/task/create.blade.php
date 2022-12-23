@extends('layouts.app', ['title' => 'Tambah Kerjaan'])

@section('content')
  
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow mb-4">
          <div class="card-header">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-tasks"></i>
              TAMBAH KERJAAN <?php echo(auth()->user()->id )  ?>
            </h6>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.task.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label>Nama Kerjaan</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                  name="title" value="{{ old('title') }}" placeholder="Isi nama pekerjaan" autofocus>
                @error('title')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Nama Pemesan</label>
                <div class="input-group">
                  <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                    name="customer_name" id="customerName" value="{{ old('customer_name') }}" placeholder="Isi nama pemesan">
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#searchCustomerModal">
                      CARI
                    </button>
                  </div>
                </div>
                @error('customer_name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Nama PJ</label>
                <div class="input-group">
                  <input type="text" class="form-control @error('pic_name') is-invalid @enderror" 
                    name="pic_name" id="picName" value="{{ old('pic_name') }}" placeholder="Isi nama penanggung jawab">
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#searchPICModal">
                      CARI
                    </button>
                  </div>
                </div>
                @error('pic_name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                  name="quantity" min="0" value="{{ old('quantity') }}" placeholder="Isi jumlah berapa pcs/lembar/box">
                @error('quantity')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Deadline</label>
                <input type="datetime-local" class="form-control @error('deadline') is-invalid @enderror" 
                  name="deadline" value="{{ old('deadline') }}" placeholder="isi waktu deadline pekerjaan">
                @error('deadline')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Metode Pembayaran</label>
                <div class="form-check">
                  <input type="radio" class="form-check-input @error('payment_method') is-invalid @enderror" 
                    name="payment_method" id="cash" value="cash" {{ old('payment_method') == 'cash' ? 'checked' : '' }}>
                  <label for="cash" class="form-check-label">
                    Cash
                  </label>
                </div>
                <div class="form-check">
                  <input type="radio" class="form-check-input @error('payment_method') is-invalid @enderror" 
                    name="payment_method" id="transfer" value="transfer" {{ old('payment_method') == 'transfer' ? 'checked' : '' }}>
                  <label for="transfer" class="form-check-label">
                    Transfer
                  </label>
                </div>
                @error('payment_method')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Jumlah DP</label>
                <input type="number" class="form-control @error('down_payment') is-invalid @enderror" 
                  name="down_payment" min="0" value="{{ old('down_payment') }}" placeholder="Isi jumlah uang DP yang dibayar">
                @error('down_payment')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Lunas</label>
                <input type="number" class="form-control @error('paid_amount') is-invalid @enderror" 
                  name="paid_amount" min="0" value="{{ old('paid_amount') }}" placeholder="Isi jika customer membayar lunas">
                @error('paid_amount')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>No Nota</label>
                <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" 
                  name="invoice_number" value="{{ old('invoice_number') }}" placeholder="Isi nomor Nota pembeli">
                @error('invoice_number')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-paper-plane"></i> SIMPAN 
              </button>
              <button type="reset" class="btn btn-warning btn-sm">
                <i class="fa fa-redo"></i> RESET
              </button>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Modal Customer -->
  <div class="modal fade" id="searchCustomerModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title"><b>CARI CUSTOMER</b> </h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <input type="text" class="form-control" name="" id="searchCustomerName" placeholder="Cari customer" autofocus>
          <h6 style="margin-top: 20px;">LIST CUSTOMER</h6>
          <table class="table table-bordered" id="showCustomerName"></table>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal Person In Charge / PIC -->
  <div class="modal fade" id="searchPICModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title"><b>CARI PJ</b> </h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <input type="text" class="form-control" name="" id="searchPICName" placeholder="Cari PJ" autofocus>
          <h6 style="margin-top: 20px;">LIST PJ</h6>
          <table class="table table-bordered" id="showPICName"></table>
        </div>

      </div>
    </div>
  </div>

  <script>

    // Cari customer berdasarkan nama or email
    $('#searchCustomerName').keyup(function () {

      $value = $(this).val()

      $.ajax({
        type: 'GET',
        url: '{{ route("admin.task.search-customer") }}',
        data: {
          'search' : $value
        },

        success: function(data)
        {
          // console.log(data)
          $('#showCustomerName').html(data)
        }
      })

    })

    // search ID Customer to show a name in input field customer
    function searchCustomerID(id) {

      var id = id

      $.ajax({
        type: 'GET',
        url: '/admin/task/search-customer/' + id,
        data: {
          'id': id
        },

        success: function(data) {
          $('#customerName').val(data.name)
        }
      })

    }

    // Cari PIC berdasarkan nama or email
    $('#searchPICName').keyup( function() {

      $value = $(this).val()

      $.ajax({
        type: 'GET',
        url: '{{ route("admin.task.search-pic") }}',
        data: {
          'search': $value
        },

        success: function(data) {
          // console.log(data)
          $('#showPICName').html(data)
        }

      })

    })

    function searchPICID(id) {

      var id = id

      $.ajax({

        type: 'GET',
        url: '/admin/task/search-pic/' + id,
        data: {
          'id' : id
        },

        success: function(data) {
          console.log(data)
          $('#picName').val(data.name)
        }

      })

    }

  </script>

@endsection