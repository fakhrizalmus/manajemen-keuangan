<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2" id="navbar">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-symbols-rounded">account_circle</i>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <li class="mb-2">
                                <button type="submit"
                                    class="dropdown-item border-radius-md d-flex align-items-center text-danger fw-bold">
                                    Log Out
                                </button>
                                {{-- <a class="dropdown-item border-radius-md d-flex align-items-center text-danger fw-bold">
                                    <i class="material-symbols-rounded me-2">logout</i>
                                    <span>Log Out</span>
                                </a> --}}
                            </li>
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
