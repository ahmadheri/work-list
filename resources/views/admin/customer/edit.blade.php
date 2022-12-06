@extends('layouts.app', ['title' => 'Edit Customer'])

@section('content')
  
<div class="container-fluid">
    <!-- Page Heading -->


    <!-- Page Heading -->

    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-users"></i>
              EDIT CUSTOMER 
            </h6>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.customer.update', $customer->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="form-group" enctype="multipart/form-data">
                <label>Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                name="name" value="{{ old('name', $customer->name) }}" placeholder="Isi Nama Lengkap" autofocus>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>No HP</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                name="phone" value="{{ old('phone', $customer->phone) }}" placeholder="Isi no hape">
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email', $customer->email) }}" placeholder="Isi email">
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-paper-plane"></i> UPDATE</button>
              <button type="reset" class="btn btn-warning btn-sm">
                <i class="fa fa-redo"></i> RESET</button>

            </form>
          </div>
        </div>
      </div>
        

    </div>


</div>

@endsection