<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">
                        <a href="/admin/{{$nameModule}}/add" class="btn btn-outline-info">
                        <i class="mdi mdi-plus"></i>
                        Thêm Dữ Liệu
                        </a>
                    </h5>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col" width="20%">
                            Chức Năng    
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($tables as $table)
                        <tr>
                            <td>{{ $table->name }}</td>
                            <td>{{ $table->email }}</td>
                            <td>
                                <a href="/admin/{{$nameModule}}/edit/{{ $table->id }}" class="btn btn-outline-info">
                                <i class="mdi mdi-pencil"></i>
                                Sửa
                                </a>
                                <button type="button" 
                                    class="btn btn-outline-danger" 
                                    onclick="getID({{ $table->id }}, '{{ $table->name }}')"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#myModal">
                                <i class="mdi mdi-delete"></i>
                                Xóa
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>