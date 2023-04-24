<header class="mb-3">
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                </ul>
                <div class="dropdown">
                    <div class="user-menu d-flex">
                        <div class="user-name text-end me-3">
                            <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                            <p class="mb-0 text-sm text-gray-600">
                                @if(auth()->user()->role === 'admin')
                                    Admin
                                @elseif(auth()->user()->role === 'pimpinan')
                                    Pimpinan
                                @elseif(auth()->user()->role === 'customer_service')
                                    Customer Service
                                @elseif(auth()->user()->role === 'kadiv_offset')
                                    Kepala Divisi offset
                                @elseif(auth()->user()->role === 'kadiv_produksi')
                                    Kepala Divisi Produksi
                                @elseif(auth()->user()->role === 'kadiv_finishing')
                                    Kepala Divisi Finishing
                                @endif
                            </p>
                        </div>
                        <div class="user-img d-flex align-items-center">
                            <div class="avatar avatar-md">
                                @if(auth()->user()->role === 'admin')
                                    <img src="{{ asset('assets/images/faces/2.jpg') }}">
                                @elseif(auth()->user()->role === 'pimpinan')
                                    <img src="{{ asset('assets/images/faces/3.jpg') }}">
                                @elseif(auth()->user()->role === 'customer_service')
                                    <img src="{{ asset('assets/images/faces/5.jpg') }}">
                                @elseif(auth()->user()->role === 'kadiv_offset')
                                    <img src="{{ asset('assets/images/faces/7.jpg') }}">
                                @elseif(auth()->user()->role === 'kadiv_produksi')
                                    <img src="{{ asset('assets/images/faces/7.jpg') }}">
                                @elseif(auth()->user()->role === 'kadiv_finishing')
                                    <img src="{{ asset('assets/images/faces/7.jpg') }}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
