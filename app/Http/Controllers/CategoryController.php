<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

use App\Models\Category;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $nameTable = 'categories';

    function index(Request $request) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){
            // lấy dữ liệu từ db
            $tables = DB::table($this->nameTable)
            ->select()
            ->orderBy('id', 'desc')
            ->get();

            $main = 'admin.category.main';
            return view('admin.index', [
                'main' => $main,
                'tables' => $tables,
                'nameModule' => $request->segment(2),
                'nameVi' => $this->changeNameModule($request->segment(2)),
                'ssId' => $ss['id']
            ]);
        }
        else{
            return view('admin.error403');
        }
    }

    function add(Request $request) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){
            $main = 'admin.category.form';
            return view('admin.index', [
                'main' => $main,
                'nameModule' => $request->segment(2),
                'nameVi' => $this->changeNameModule($request->segment(2)),
                'ssId' => $ss['id']
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

            $main = 'admin.category.form';
            return view('admin.index', [
                'main' => $main,
                'row' => $row[0], // [{}]
                'nameModule' => $request->segment(2),
                'nameVi' => $this->changeNameModule($request->segment(2)),
                'ssId' => $ss['id']
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

            // check name có tồn tại trong db hay
            $rowName = DB::table($this->nameTable)->where('name', $name)->get();
            
            if(count($rowName)!=0){
                return response()->json([
                    'msg' => 'nok',
                    'error' => 'Tên đã tồn tại',
                    'id' => $id
                ]);
            }

            if($id == ''){
                $module = new Category;
 
                $module->name = $name;
                $module->slug = $slug;
                $module->description = $description;
                $module->content = $content;
                $module->user_id = $ss['id'];
        
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
}
