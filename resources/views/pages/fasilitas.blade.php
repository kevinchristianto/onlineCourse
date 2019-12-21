@extends('layout.app')

@section('site-title', 'Fasilitas Kepesertaan')
@section('page-title', 'Kelola Fasilitas Kepesertaan')
@section('isFasilitas', 'active')

@section('custom-style-library')
	<link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('main-content')

<div class="row">
	<div class="col-12">
		
		<div class="card border-left-primary mb-5">
			<div class="card-body">
				<div class="row col justify-content-between mb-3">
					<h5 class="card-title text-primary font-weight-bold my-auto">Daftar Fasilitas Kepesertaan</h5>
					<button class="btn btn-outline-primary" data-toggle="modal" data-target="#add-fasilitas-modal">Tambah Fasilitas</button>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover datatables">
						<thead>
							<tr>
								<th>No.</th>
								<th>User ID</th>
								<th>Nama</th>
								<th>Materi</th>
								<th class="text-center">Opsi</th>
							</tr>
						</thead>
						<tbody>
						@php $no = 1 @endphp
						@foreach($users as $user)
							<tr>
								<td>{{ $no }}.</td>
								<td>{{ $user->user_id }}</td>
								<td>{{ $user->nama }}</td>
								<td>
									@foreach($user->materis as $materi)
										@if($loop->last)
											{{ $materi->judul_materi }}
										@else
											{{ $materi->judul_materi }},
										@endif
									@endforeach
								</td>
								<td class="d-flex align-items-center justify-content-center">
									<a href="{{ route('user.edit-fasilitas', $user->user_id) }}"><i class="fas fa-edit" title="Ubah Fasilitas" data-toggle="tooltip"></i></a>
								</td>
							</tr>
							@php $no++ @endphp
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('modal-content')

<div class="modal fade" id="add-fasilitas-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah User</h5>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('fasilitas.store') }}">
					@csrf
					<div class="form-group">
						<label class="control-label">User ID</label>
						<input type="text" name="user_id" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Nama</label>
						<input type="text" name="nama" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Alamat</label>
						<textarea class="form-control" name="alamat"></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">Kota</label>
						<input type="text" name="kota" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Tipe User</label>
						<select class="form-control" name="user_type" required>
							<option selected disabled>--- Pilih Tipe User ---</option>
							<option value="peserta">Peserta</option>
							<option value="admin">Admin</option>
						</select>
					</div>
					<div class="form-group">
						<button class="btn btn-primary float-right">Simpan</button>
						<a href="javascript:void(0)" data-dismiss="modal" class="btn btn-danger float-right mr-2">Batal</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('necessary-library')
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
@endsection