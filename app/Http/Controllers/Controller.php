<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function changeNameModule($name) {
        $str='';
        switch ($name) {
            case 'category': $str='Danh Mục'; break;
            case 'post': $str='Bài Viết'; break;
            case 'user': $str='Thành Viên'; break;
            default: $str='Bảng Điều Khiển'; break;
        }
        return $str;
    }
}
