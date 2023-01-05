@extends('layouts.app', ['title' => 'Daftar Kerjaan'])

@section('content')
  
<?php setlocale(LC_ALL, 'id-ID', 'id_ID'); ?>

<div class="container-fluid">
    <!-- Page Heading -->


    <!-- Page Heading -->

    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-tasks"></i>
              PEKERJAAN
            </h6>
          </div>

          <div class="card-body">
            <form action="#" method="GET">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <a href="{{ route('admin.task.create') }}" class="btn btn-primary btn-sm pt-2">
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
                  <tr style="background-color: #4e73de; color: #fff;">
                    <th scope="col" style="text-align: center;">NO</th>
                    <th scope="col">NAMA KERJAAN</th> 
                    <th scope="col">NAMA PJ</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">PROGRESS</th>
                    <th scope="col">PELAKSANA</th>
                    <th scope="col">DEADLINE</th>
                    <th scope="col">METODE TRANSAKSI</th>
                    <th scope="col">JUMLAH DP</th>
                    <th scope="col">LUNAS</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">NO NOTA</th>
                    <th scope="col" style="text-align: center;">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tasks as $no => $task)
                  <tr>
                    <th style="text-align: center;">
                      {{ ++$no + ($tasks->currentPage() - 1) * $tasks->perPage() }}
                    </th>
                    <td>{{ $task->title }}
                      <br>
                      CS <b>{{ $task->customer->name }}</b>
                    </td>
                    <td>{{ $task->user->name }}</td>
                    <td>{{ $task->quantity }}</td>
                    <td>
                      <b> Design </b>
                      @if ($task->progress->design == 1)
                        <?php echo '<i class="fas fa-check-square icon-cog" style="color: green" ></i>' ?>
                      @else
                        <?php echo '<i class="fas fa-minus-square icon-cog" style="color: green" ></i>' ?>
                      @endif
                      <br>
                      <b> Cetak </b> 
                      @if ($task->progress->print == 1)
                        <?php echo '<i class="fas fa-check-square icon-cog" style="color: green" ></i>' ?>
                      @else
                        <?php echo '<i class="fas fa-minus-square icon-cog" style="color: green" ></i>' ?>
                      @endif
                    </td>
                    <td>{{ $task->executor }}</td>
                    <td>{{ strftime('%A, %d %B %Y %H:%M:%S', strtotime($task->deadline) ) }}</td>
                    <td>{{ $task->payment->payment_method }}</td>
                    <td>{{ $task->payment->down_payment }}</td>
                    <td>{{ $task->payment->paid_amount }}</td>
                    <td>{{ $task->payment->total }}</td>
                    <td>{{ $task->invoice_number }}</td>
                    <td>
                      <a href="{{ route('admin.task.edit', $task->id)  }}" class="btn btn-sm btn-block btn-success">
                        <i class="fas fa-pencil-alt"></i>
                        Edit
                      </a>
                      <button onclick="Delete(this.id)" class="btn btn-sm btn-block btn-danger" id="{{ $task->id }}">
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
          url: '/admin/task/' + id,
          data: {
            'id': id,
            '_token': token
          },
          type: 'DELETE',
          success: function (response) {
            if (response.status == 'success') {
              swal.fire({
                  title: 'BERHASIL!',
                  text: 'DATA BERHASIL DIHAPUS!',
                  icon: 'success',
                  timer: 1000,
                  showConfirmButton: false,
                  showCancelButton: false,
                  buttons: false,
                }).then(function () {
                  location.reload();
                });
              } else {
                swal.fire({
                  title: 'GAGAL!',
                  text: 'DATA GAGAL DIHAPUS!',
                  icon: 'error',
                  timer: 1000,
                  showConfirmButton: false,
                  showCancelButton: false,
                  buttons: false,
                }).then(function () {
                  location.reload();
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