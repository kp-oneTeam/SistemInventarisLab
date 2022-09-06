@extends('admin.layouts.master')
@section('users','active')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Edit Users</h1>
  </div>
   <div class="row">
      <div class="col-12">
        <div class="card ">
          <div class="card-body p-0">
            <form action="{{ url('admin/users/'.$user->id) }}" method="post">
            @method('put')
            @csrf
            <div class="p-4">
                <div class="form-group col-md-6">
                    <label for="">Nama</label>
                    <input type="text" value="{{ $user->name }}" name="nama" id="" class="form-control @error('nama') is-invalid @enderror" name="text" value="{{ old('nama') }}" autofocus>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Email</label>
                    <input type="email" value="{{ $user->email }}" name="email" id="" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="">Password</label>
                    <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Role</label>
                    <select name="role_id" id="kostan" class="custom-select @error('role_id') is-invalid @enderror">
                        <option selected value="{{ $userRole->id }}">{{$userRole->name}}</option>
                        @foreach ($role as $item)
                        @if ($item->id != $userRole->id)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                        @endforeach
                    </select>
                     @error('role_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  <div class="section-body">
  </div>
</section>
@endsection
