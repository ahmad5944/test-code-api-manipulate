@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ 'Tambah ' . $pageTitle }}</h4>
            </div>
            <hr>
            <form method="POST" action="{{ route('user.store') }}" role="form" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    @if ($errors->count() > 0)
                        {{-- @dd($errors) --}}
                        <div class="alert alert-danger p-2" role="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br />
                            @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="mb-1">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" class="form-control @error('nama_depan') is-invalid @enderror" placeholder="Nama Depan" name="nama_depan">
                                @error('nama_depan')
                                    <small class="text-danger"><b>{{ $message }}</b></small>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" placeholder="Nama Belakang" name="nama_belakang">
                                @error('nama_belakang')
                                    <small class="text-danger"><b>{{ $message }}</b></small>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label class="form-label">email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="test@gmail.com" name="email"
                                    value="{{ Request::old('email') }}">
                                @error('email')
                                    <small class="text-danger"><b>{{ $message }}</b></small>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="******" autocomplete="current-password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit"
                            class="btn btn-dark me-1 waves-effect waves-float waves-light btn-sm font-small-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
