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
                           class="form-control"
                           onchange="ChangeToSlug()"
                           onkeyup="ChangeToSlug()"
                           />
                     </div>
                     <div class="form-group">
                        <label for="slug">Slug</label>
                        <input
                           type="text"
                           id="slug"
                           name="slug"
                           value="{{ isset($row) ? $row->slug : ''; }}"
                           class="form-control"/>
                     </div>
                     <div class="form-group">
                        <label for="description">Mô Tả</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{ isset($row) ? $row->description : ''; }}</textarea>
                     </div>
                     <div class="form-group">
                        <label for="content">Nội Dung</label>
                        <textarea name="content" class="form-control" id="content" cols="30" rows="3">{{ isset($row) ? $row->content : ''; }}</textarea>
                     </div>
                  </div>
                  <div class="border-top">
                     <div class="card-body">
                        <button type="submit" class="btn btn-success text-white">
                        Lưu Lại
                        </button>
                        <a href="/admin/{{ $nameModule }}" class="btn btn-danger text-white">
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