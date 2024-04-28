@isset($nameVi)
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">{{ $nameVi }}</h4>
            <div class="ms-auto text-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Bảng Điều Khiển</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                {{ $nameVi }}
                </li>
                </ol>
            </nav>
            </div>
        </div>
    </div>
</div>
@endisset