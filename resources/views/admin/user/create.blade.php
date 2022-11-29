@extends('layouts.app', ['title' => 'Tambah User Baru'])

@section('content')
  
<div class="container-fluid">
    <!-- Page Heading -->


    <!-- Page Heading -->

    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-user"></i>
              TAMBAH USER 
            </h6>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.user.store') }}" method="POST">
              @csrf

              <div class="form-group" enctype="multipart/form-data">
                <label for="">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                name="name" value="{{ old('name') }}" placeholder="Isi Nama Lengkap" autofocus>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">No HP</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                name="phone" value="{{ old('phone') }}" placeholder="Isi no hape">
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Role</label>
                <div class="form-check">
                  <input class="form-check-input @error('role') is-invalid @enderror" type="radio" 
                  name="role" id="admin" value="Admin" {{ old('role') == 'Admin' ? 'checked' : '' }}>
                  <label class="form-check-label" for="admin" style="font-weight: normal;">
                    Admin
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input @error('role') is-invalid @enderror" type="radio" 
                  name="role" id="karyawan" value="Karyawan" {{ old('role') == 'Karyawan' ? 'checked' : '' }}>
                  <label class="form-check-label" for="karyawan" style="font-weight: normal;">
                    Karyawan
                  </label>
                  @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email') }}" placeholder="Isi email">
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror

              </div>
              <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                name="password" placeholder="Isi password">
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Konfirmasi Password</label>
                <input type="password" class="form-control" 
                name="password_confirmation" placeholder="Konfirmasi ulang password Anda">
              </div>

              <button type="submit" class="btn btn-primary btn-sm">Submit</button>
              <button type="reset" class="btn btn-danger btn-sm">Reset</button>

            </form>
          </div>
        </div>
      </div>
        

    </div>


</div>

@endsection