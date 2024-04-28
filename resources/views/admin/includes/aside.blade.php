<?php
    $asideLists = [
        [
            'name' => 'Bảng Điều Khiển',
            'link' => 'dashboard',
            'icon' => 'view-dashboard'
        ],
        [
            'name' => 'Danh Mục',
            'link' => 'category',
            'icon' => 'format-line-weight'
        ],
        [
            'name' => 'Bài Viết',
            'link' => 'post',
            'icon' => 'pencil'
        ],
        [
            'name' => 'Thành Viên',
            'link' => 'user',
            'icon' => 'account-plus'
        ]
    ];
?>
<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                @foreach ($asideLists as $aside)
                    <li class="sidebar-item {{ $aside['link'] == $nameModule ? 'selected':''; }}">
                        <a
                            class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="/admin/{{ $aside['link'] }}"
                            aria-expanded="false"
                            ><i class="mdi mdi-{{ $aside['icon'] }}"></i
                            ><span class="hide-menu">{{ $aside['name'] }}</span></a
                        >
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</aside>