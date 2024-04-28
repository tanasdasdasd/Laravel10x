<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card">
               <form id="FormData">
                  @csrf
                  <div class="card-body">
                     <input type="hidden" id="id" name="id" value="{{ isset($row) ? $row->id : ''; }}"/>
                     <div class="form-group">
                        <label for="name">Tên</label>
                        <input
                           type="text"
                           id="name"
                           name="name"
                           value="{{ isset($row) ? $row->name : ''; }}"
                           class="form-control"/>
                     </div>
                     <div class="form-group">
                        <label for="email"
                           >Email</label
                           >
                        <input
                           type="email"
                           id="email"
                           name="email"
                           value="{{ isset($row) ? $row->email : ''; }}"
                           class="form-control"/>
                     </div>
                     @empty($row)
                     <div class="form-group">
                        <label for="password">Mật Khẩu</label>
                        <input
                           type="password"
                           id="password"
                           name="password"
                           class="form-control"/>
                     </div>
                     <div class="form-group">
                        <label for="cfpassword">Xác Nhận Mật Khẩu</label>
                        <input
                           type="password"
                           id="cfpassword"
                           name="cfpassword"
                           class="form-control"/>
                     </div>
                     @endempty
                  </div>
                  <div class="border-top">
                     <div class="card-body">
                        <button type="submit" class="btn btn-success text-white">
                        Lưu Lại
                        </button>
                        @isset($row)
                        <button 
                        type="button" 
                        class="btn btn-info text-white"
                        data-bs-toggle="modal" 
                        data-bs-target="#changePassModal">
                        Đổi Mật Khẩu
                        </button>
                        @endisset
                        <a href="/admin/{{$nameModule}}" class="btn btn-danger text-white">
                        Thoát
                        </a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>