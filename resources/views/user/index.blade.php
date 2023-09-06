@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <span id="card_title">
                        {{-- <h4 class="card-title">{{ 'List ' . $pageTitle }}</h4> --}}
                    </span>
                    <div class="float-right">
                        <a href="{{ route('user.create') }}"
                            class="btn btn-primary btn-sm float-right font-weight-bolder mr-1 font-small-2"><i
                                data-feather='plus-circle' class="font-small-2"></i> Tambah Data</a>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="DataTable" class="table table-striped table-bordered table-hover w-100">
                            <thead class="thead">
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Email</th>
                                    <th width="1%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_depan }}</td>
                                        <td>{{ $data->nama_belakang }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning btn-sm" href="{{ route('user.edit', $data->id) }}" title="edit"><i
                                                    class="font-small-2" data-feather='menu'>edit</i></a>
                                            <a class="btn btn-primary btn-sm" href="{{ route('user.show', $data->id) }}" title="show"><i
                                                    class="font-small-2" data-feather='menu'>show</i></a>
                                            <form action="{{ route('user.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="delete"><i data-feather='trash-2' class="font-small-2"></i>delete</button>
                                            </form>
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
@endsection
