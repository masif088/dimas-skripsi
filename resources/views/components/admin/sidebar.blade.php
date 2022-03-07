<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="#">
                <img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt="">
                <img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="">
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"></i></div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="#">
                <img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt="">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="#">
                            <img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt="">
                        </a>
                        <div class="mobile-back text-end"><span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                            <p>Dashboards,widgets & layout.</p>
                        </div>
                    </li>
                    @if(auth()->user()->role==1)
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i><span> Dashboard</span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->role==1 or auth()->user()->role==2 or auth()->user()->role==4)
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav"
                               href="{{ route('admin.transaction.index') }}">
                                <i class="fas fa-cash-register"></i><span> Kasir</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav"
                               href="{{ route('admin.transaction.active') }}">
                                <i class="fas fa-wallet"></i><span> Aktif</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav"
                               href="{{ route('admin.transaction.history-detail','today') }}">
                                <i class="fas fa-wallet"></i><span> Hari ini</span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->role==1)
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav"
                               href="{{ route('admin.transaction.history') }}">
                                <i class="fas fa-history"></i><span> Riwayat harian</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav"
                               href="{{ route('admin.transaction.history') }}">
                                <i class="fas fa-history"></i><span> Riwayat Bulanan</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav"
                               href="{{ route('admin.product-type.index') }}">
                                <i class="fa fa-product-hunt"></i><span> Jenis Produk</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav"
                               href="{{ route('admin.product-company.index') }}">
                                <i class="fa fa-product-hunt"></i><span> Produk Usaha</span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->role==1 or auth()->user()->role==2)
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.product.index') }}">
                                <i class="fa fa-product-hunt"></i><span> Produk</span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->role==1 or auth()->user()->role==3)
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.stock.index') }}">
                                <i class="fa fa-product-hunt"></i><span> Stok</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.supplier.index') }}">
                                <i class="fa fa-product-hunt"></i><span> Supplier</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
