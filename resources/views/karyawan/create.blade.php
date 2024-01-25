@extends('layout.main')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Pegawai</h1>
                    <div class="card mb-4">

                        <div class="card-header">
                            Form Pegawai
                        </div>
                        <div class="card-body">
                            <form action="/dashboard/karyawan/create" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <select class="form-control" name="jabatan" id="jabatan">
                                        <option value="Staff Produksi">Staff Produksi</option>
                                        <option value="Kepala Tukang">Kepala Tukang</option>
                                        <option value="Admin Produksi">Admin Produksi</option>
                                        <option value="Kepala Produksi">Kepala Produksi</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_produksi" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
