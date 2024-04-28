<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $nameTable = 'users';

    function index(Request $request) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){

            // lấy dữ liệu từ db
            $tables = DB::table($this->nameTable)
            ->select()
            ->orderBy('id', 'desc')
            ->get();

            $main = 'admin.user.main';
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
            $main = 'admin.user.form';
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

    function process(Request $request) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){
            $id = $request->input('id');
            $email = $request->input('email');

            // check email có tồn tại trong db hay
            $rowEmail = DB::table($this->nameTable)->where('email', $email)->get();
            
            if(count($rowEmail)!=0){
                return response()->json([
                    'msg' => 'nok',
                    'error' => 'Email đã tồn tại',
                    'id' => $id
                ]);
            }

            if($id == ''){
                // add
                $name = $request->input('name');
                $password = $request->input('password');

                $module = new User;
 
                $module->name = $name;
                $module->email = $email;
                $module->password = $password;
        
                $module->save();

                return response()->json([
                    'msg' => 'ok',
                    'error' => '',
                    'id' => $id
                ]);
            }
            else{
                // edit
                $name = $request->input('name');
                $email = $request->input('email');

                DB::table($this->nameTable)
                ->where('id', $id)
                ->update(['name' => $name, 'email' => $email]);

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

    function edit(Request $request, string $id) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){

            // lấy dữ liệu từ db
            $row = DB::table($this->nameTable)
            ->select()
            ->where('id', $id)
            ->orderBy('id', 'desc')
            ->get();

            $main = 'admin.user.form';
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

    function login(){
        return view('admin.login');
    }

    function processLogin(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        // check email
        $user = DB::table($this->nameTable)->where('email', $email)->get();

        if (count($user)!=0 && Hash::check($password, $user[0]->password)) {
            // echo 'Đăng nhập thành công!';
            $request->session()->put('loginSession', [
                'id' => $user[0]->id,
                'email' => $user[0]->email
            ]);
            // tự chuyển qua bên trang /admin/dashboard
            return redirect('/admin/dashboard');
        }
        else{
            return redirect('/login');
        }
    }

    function logout(Request $request) {
        $request->session()->forget('loginSession');
        return redirect('/login');
    }

    function createSession(Request $request) {
        $request->session()->put('loginSession', 'Hello');
        echo 'Đã tạo Session';
    }

    function getSession(Request $request) {
        $value = $request->session()->get('loginSession');
        echo 'Giá trị session đã tạo ' . $value;
    }

    function deleteSession(Request $request) {
        $request->session()->forget('loginSession');
        echo 'Đã xóa session';
    }
}
