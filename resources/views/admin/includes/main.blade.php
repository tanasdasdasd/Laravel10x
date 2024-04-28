<?php
    $asideLists = [
        [
            'name' => 'Danh Mục',
            'link' => 'category',
            'icon' => 'format-line-weight',
            'color' => 'cyan'
        ],
        [
            'name' => 'Bài Viết',
            'link' => 'post',
            'icon' => 'pencil',
            'color' => 'warning'
        ],
        [
            'name' => 'Thành Viên',
            'link' => 'user',
            'icon' => 'account-plus',
            'color' => 'danger'
        ]
    ];
?>

<div class="container-fluid">
    <div class="row">
        @foreach ($asideLists as $aside)
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <a href="/admin/{{ $aside['link'] }}">
                <div class="card card-hover">
                    <div class="box bg-{{ $aside['color'] }} text-center">
                        <h1 class="font-light text-white">
                        <i class="mdi mdi-{{ $aside['icon'] }}"></i>
                        </h1>
                        <h6 class="text-white">{{ $aside['name'] }}</h6>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>