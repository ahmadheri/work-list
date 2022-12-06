@extends('layouts.app', ['title' => 'Daftar Customer'])

@section('content')
  
<div class="container-fluid">
    <!-- Page Heading -->


    <!-- Page Heading -->

    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-users"></i>
              CUSTOMERS
            </h6>
          </div>

          <div class="card-body">
            <form action="#" method="GET">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <a href="{{ route('admin.customer.create') }}" class="btn btn-primary btn-sm pt-2">
                      <i class="fa fa-plus-circle"></i> TAMBAH
                    </a>
                  </div>
                  <input type="text" class="form-control" name="q" 
                    placeholder="Cari Berdasarkan ....">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                    CARI
                  </button>
                  </div>

                  </div>
              </div>
            </form>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col" style="text-align: center;">NO</th>
                    <th scope="col">NAMA </th>
                    <th scope="col">NO HP</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col" style="text-align: center;">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($customers as $no => $customer)
                  <tr>
                      <th style="text-align: center;">
                        {{ ++$no + ($customers->currentPage() - 1) * $customers->perPage() }}
                      </th>
                      <td>{{ $customer->name }}</td>
                      <td>{{ $customer->phone }}</td>
                      <td>{{ $customer->email }}</td>
                      <td style="text-align: center;"> 
                        <a href="{{ route('admin.customer.edit', $customer->id) }}"
                          class="btn btn-success btn-sm">
                          <i class="fas fa-pencil-alt"></i>
                          Edit
                        </a>
                        <button onclick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $customer->id }}">
                          <i class="fas fa-trash"></i>
                          Delete
                        </button>                    
                      </td>
                      
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
        
    </div>

</div>

<script>

  function Delete(id) {

    var id = id
    var token = $("meta[name='csrf-token']").attr("content")

    Swal.fire({
      title: 'Apakah Anda yakin',
      text: 'ingin menghapus data ini ?',
      icon: 'warning',
      showConfirmButton: true,
      showCancelButton: true,
      focusCancel: true,
    }).then((result) => {
      if (result.isConfirmed) {
        
        jQuery.ajax({
          url: '/admin/customer/' + id,
          data: {
            'id' : id,
            '_token': token
          },
          type: 'DELETE',
          success: function (response) {
            if (response.status == 'success') {
              Swal.fire({
                title: 'BERHASIL!',
                text: 'DATA BERHASIL DIHAPUS!',
                icon: 'success',
                timer: 1000,
                showConfirmButton: false,
                showCancelButton: false,
              }).then(function () {
                location.reload();
              });
            } else {
              Swal.fire({
                title: 'GAGAL!',
                text: 'DATA GAGAL DIHAPUS!',
                icon: 'error',
                timer: 1000,
                showConfirmButton: false,
                showCancelButton: false,
              }).then(function () {
                location.reload()
              });
            }
          }
        })
      } else {
        return true
      }
    })

  }

</script>

@endsection