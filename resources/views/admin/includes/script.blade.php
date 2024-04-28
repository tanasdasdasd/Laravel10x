<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- <script src="/dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->
<script src="/assets/libs/flot/excanvas.js"></script>
<script src="/assets/libs/flot/jquery.flot.js"></script>
<script src="/assets/libs/flot/jquery.flot.pie.js"></script>
<script src="/assets/libs/flot/jquery.flot.time.js"></script>
<script src="/assets/libs/flot/jquery.flot.stack.js"></script>
<script src="/assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="/dist/js/pages/chart/chart-page-init.js"></script>

<!-- ckeditor -->
<script src="/assets/ckeditor/ckeditor.js"></script>
<script>CKEDITOR.replace('content');</script>

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

    <form id="nowDel">
        @csrf
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Thông báo !!!</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            Bạn có muốn xóa <span class="text-danger" id="nameDel"></span> không ???
            <input type="hidden" id="idDel" name="idDel">
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="submit" class="btn btn-info">Xóa Ngay</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Thoát</button>
        </div>
    </form>

    </div>
  </div>
</div>

<div class="modal" id="changePassModal">
  <div class="modal-dialog">
    <div class="modal-content">

    <form id="changePassForm">
        @csrf
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Đổi Mật Khẩu !!!</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-group">
                <label for="oldPass">Mật Khẩu Cũ</label>
                <input type="password" id="oldPass" name="oldPass"class="form-control">
            </div>
            <div class="form-group">
                <label for="newPass">Mật Khẩu Mới</label>
                <input type="password" id="newPass" name="newPass"class="form-control">
            </div>
            <div class="form-group">
                <label for="renewPass">Nhập Lại Mật Khẩu Mới</label>
                <input type="password" id="renewPass" name="renewPass"class="form-control">
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="submit" class="btn btn-info">Đổi Ngay</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Thoát</button>
        </div>
    </form>

    </div>
  </div>
</div>

<script>

    function getID(id, name) {
        // alert(name)
        // truyền id, name lên model
        $('#nameDel').text(name);
        $('#idDel').val(id);
    }

    $(document).ready(function(){
        $('#nowDel').on('submit', function(e){
            // chặn load form
            e.preventDefault();
        
            $.ajax({
                url: '/admin/{{ $nameModule }}/delete',
                type: 'POST',
                data: $(this).serialize(),
                success: function(results){
                    // console.log(results);
                    if(results.msg == 1){
                        alert('Đã xóa !!!')
                        // tự động chuyển trang
                        window.location.href = '/admin/{{ $nameModule }}';
                    }
                }
            });

            return false;
        })

        $('#FormData').on('submit', function(e){
            // chặn load form
            e.preventDefault();

            const nameModule = '{{ $nameModule }}';
            let content = '';

            if(nameModule == 'user'){
                const password = $('#password').val();
                const cfpassword = $('#cfpassword').val();

                // kiểm tra dữ liệu
                if(password != cfpassword){
                    alert('Xác nhận mật khẩu không đúng');
                    return false;
                }
            }
            else if(
                nameModule == 'category'
                ||
                nameModule == 'post'
            ){
                content = CKEDITOR.instances['content'].getData();
            }

            // gửi ajax
            $.ajax({
                url: '/admin/{{ $nameModule }}/process',
                type: 'POST',
                data: $(this).serialize() + content,
                success: function(results){
                    // console.log(results);
                    // return
                    if(results.msg == 'ok'){
                        if(results.id == null){
                            alert('Thêm thành công !!!')
                            // tự động chuyển trang
                            window.location.href = '/admin/{{ $nameModule }}';
                        }
                        else{
                            // load page
                            window.location.href = '/admin/{{ $nameModule }}/edit/'+results.id;
                        }
                    }else{
                        alert(results.error);
                    }
                }
            });

            return false;
        })
    })
    function ChangeToSlug()
    {
        var title, slug;
    
        //Lấy text từ thẻ input title 
        title = document.getElementById("name").value;
    
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
    
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('slug').value = slug;
    }
</script>