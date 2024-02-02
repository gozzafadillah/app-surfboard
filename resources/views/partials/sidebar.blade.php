<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="/">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>
            @if (Auth::user()->role == '1' || Auth::user()->role == '0' || Auth::user()->role == '2')
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduk"
                    aria-expanded="false" aria-controls="collapseProduk">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Produksi
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
            @endif
            <div class="collapse" id="collapseProduk" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/dashboard/estimasi">Estimasi Produksi</a>
                    <a class="nav-link" href="/dashboard/produksi">Produksi</a>
                </nav>
            </div>
            @if (Auth::user()->role == '3' || Auth::user()->role == '4' || Auth::user()->role == '0')
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseKaryawan" aria-expanded="false" aria-controls="collapseKaryawan">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Pegawai
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
            @endif
            <div class="collapse" id="collapseKaryawan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/dashboard/pegawai">List Pegawai</a>
                </nav>
            </div>
            @if (Auth::user()->role == '3' || Auth::user()->role == '0' || Auth::user()->role == '4')
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLaporan"
                    aria-expanded="false" aria-controls="collapseLaporan">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Laporan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
            @endif
            <div class="collapse" id="collapseLaporan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/dashboard/laporan-produksi">Laporan Produksi</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->nama }}
    </div>
</nav>
