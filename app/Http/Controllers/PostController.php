<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\View\View;

use App\Models\Post;

use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    private $nameTable = 'posts';

    function index(Request $request) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){
            // lấy dữ liệu từ db
            $tables = DB::table($this->nameTable)
            ->select()
            ->orderBy('id', 'desc')
            ->get();

            $main = 'admin.post.main';
            return view('admin.index', [
                'main' => $main,
                'tables' => $this->tableHtml($tables, $request->segment(2)),
                'nameModule' => $request->segment(2),
                'nameVi' => $this->changeNameModule($request->segment(2)),
                'ssId' => $ss['id'],
                'h1' => '<h1>Xin chào</h1>'
            ]);
        }
        else{
            return view('admin.error403');
        }
    }

    function add(Request $request) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){
            // lấy dữ liệu từ db
            $categories = DB::table('categories')
            ->select()
            ->orderBy('id', 'desc')
            ->get();

            $main = 'admin.post.form';
            return view('admin.index', [
                'main' => $main,
                'nameModule' => $request->segment(2),
                'nameVi' => $this->changeNameModule($request->segment(2)),
                'ssId' => $ss['id'],
                'categories' => $categories
            ]);
        }
        else{
            return view('admin.error403');
        }
    }

    function edit(Request $request, string $id) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){
            // lấy dữ liệu từ db
            $row = DB::table($this->nameTable)
            ->select()
            ->where('id', $id)
            ->orderBy('id', 'desc')
            ->get();

            $categories = DB::table('categories')
            ->select()
            ->orderBy('id', 'desc')
            ->get();

            $main = 'admin.post.form';
            return view('admin.index', [
                'main' => $main,
                'row' => $row[0], // [{}]
                'nameModule' => $request->segment(2),
                'nameVi' => $this->changeNameModule($request->segment(2)),
                'ssId' => $ss['id'],
                'categories' => $categories
            ]);
        }
        else{
            return view('admin.error403');
        }
    }

    function process(Request $request) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){
            $id = $request->input('id');
            $name = $request->input('name');
            $slug = $request->input('slug');
            $description = $request->input('description');
            $content = $request->input('content');
            $category_id = $request->input('category_id');

            if($id == ''){
                // check name có tồn tại trong db hay
                $rowName = DB::table($this->nameTable)->where('name', $name)->get();

                if(count($rowName)!=0){
                    return response()->json([
                        'msg' => 'nok',
                        'error' => 'Tên đã tồn tại',
                        'id' => $id
                    ]);
                }

                $module = new Post;
 
                $module->name = $name;
                $module->slug = $slug;
                $module->description = $description;
                $module->content = $content;
                $module->user_id = $ss['id'];
                $module->category_id = $category_id;
                
                $module->save();

                return response()->json([
                    'msg' => 'ok',
                    'error' => '',
                    'id' => $id
                ]);
            }
            else{
                // edit

                DB::table($this->nameTable)
                ->where('id', $id)
                ->update([
                    'name' => $name, 
                    'slug' => $slug, 
                    'description' => $description,  
                    'content' => $content,
                    'category_id' => $category_id,
                ]);

                return response()->json([
                    'msg' => 'ok',
                    'error' => '',
                    'id' => $id
                ]);
            }
        }
        else{
            return view('admin.error403');
        }
    }

    function delete(Request $request) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){

            $id = $request->input('idDel');

            $deleted = DB::table($this->nameTable)->where('id', $id)->delete();

            return response()->json([
                'msg' => $deleted,
            ]);
        }
        else{
            return view('admin.error403');
        }
    }

    function tableHtml($variable = [], $nameModule='') {
        $str='<table class="table">
        <thead>
        <tr>
            <th scope="col">Tên</th>
            <th scope="col">Danh Mục</th>
            <th scope="col">Người Tạo</th>
            <th scope="col" width="20%">
                Chức Năng    
            </th>
        </tr>
        </thead>
        <tbody>';
        foreach ($variable as $key => $value) {
            $id = $value->id;
            $name = $value->name;
            $href = '/admin/'.$nameModule.'/edit/'.$id;
            $category_id = $value->category_id;
            $user_id = $value->user_id;

            $row = DB::table('categories')
            ->select()
            ->where('id', $category_id)
            ->get();

            $name_category = $row[0]->name;

            $rowUser = DB::table('users')
            ->select()
            ->where('id', $user_id)
            ->get();

            $name_user = $rowUser[0]->name;

            $str .= '
                <tr>
                <td>'.$name.'</td>
                <td><span class="badge bg-primary">'.$name_category.'</span></td>
                <td><span class="badge bg-success">'.$name_user.'</span></td>
                <td>
                    <a href="'.$href.'" class="btn btn-outline-info">
                        <i class="mdi mdi-pencil"></i>
                        Sửa
                    </a>
                    <button type="button" 
                        class="btn btn-outline-danger" 
                        onclick="getID('.$id.', '.$name.')"
                        data-bs-toggle="modal" 
                        data-bs-target="#myModal">
                    <i class="mdi mdi-delete"></i>
                    Xóa
                    </button>
                </td>
            </tr>';
        }
        $str.='</tbody>
        </table>';
        return $str;
    }
}
