@extends('layout.main')
@section('content')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('partials.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Profile</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="/dashboard/estimasi/create" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input class="form-control" type="text" name="nama" id="nama"
                                        value="{{ $userLoginNow->nama }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" placeholder="0" class="form-control" id="email" name="email"
                                        value="{{ $userLoginNow->email }}">
                                    <input type="hidden" name="rasio" id="rasio">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-danger">Forget Password</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
