<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\View\View;

use App\Models\Category;
use App\Models\Post;

use Illuminate\Support\Facades\DB;

class LayoutController extends Controller
{
    function index(Request $request) {

        $slug_cap1 = $request->segment(1);

        $main = 'includes.main';

        $cateLists = DB::table('categories')
                    ->select(['name', 'slug'])
                    ->orderBy('id', 'desc')
                    ->get();

        $postCategories = [];
        $rowCategory = [];

        $rowDetails = [];

        if($slug_cap1 != ''){
            $pos = strpos($slug_cap1, '.html');

            if($slug_cap1 == 'contact.html'){
                $main = "includes.contact";
            }
            else{
                if ($pos === false) {
                    $rowCategory = DB::table('categories')
                    ->select()
                    ->where('slug', $slug_cap1)
                    ->get();

                    if(count($rowCategory) != 0){
                        $category_id = $rowCategory[0]->id;

                        // lấy những bài tin tức theo danh mục
                        $postCategories = DB::table('posts')
                        ->select()
                        ->where('category_id', $category_id)
                        ->get();

                        $main = "includes.category";
                    }
                }else {
                    $rowDetails = DB::table('posts')
                    ->select()
                    ->where('slug', str_replace(".html","",$slug_cap1))
                    ->get();

                    if(count($rowDetails) != 0){
                        $main = "includes.post";
                    }
                }
            }
        }

        return view('index', [
            'main' => $main,
            'cateLists' => $cateLists,
            'postCategories' => $postCategories,
            'rowCategory' => $rowCategory,
            'slug_cap1' => $slug_cap1,
            'rowDetails' => $rowDetails
        ]);
    }
}
