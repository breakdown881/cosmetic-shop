@extends('admin.layout.app')
@section('content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Quản lý</a>
                </li>
                <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
            <!-- /form -->
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">Tên </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="name" id="name" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="wholesale-price">Giá bán lẻ </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="wholesale-price" id="wholesale-price" type="text" value="" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="inventory-number">Lượng tồn</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="inventory-number" id="inventory-number" type="text" value="" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="category">Danh mục </label>
                    <div class="col-md-9 col-lg-6">
                        <select name="category" id="category" class="form-control">
                            <option value="Kem Chống Nắng">Kem Chống Nắng</option>
                            <option value="Kem Dưỡng Da">Kem Dưỡng Da</option>
                            <option value="Kem Trị Mụn">Kem Trị Mụn</option>
                            <option value="Kem Trị Thâm Nám">Kem Trị Thâm Nám</option>
                            <option value="Sữa Rửa Mặt">Sữa Rửa Mặt</option>
                            <option value="Sữa Tắm">Sữa Tắm</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label">Nổi bật</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="checkbox" value="1">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="image">Hình ảnh </label>
                    <div class="col-md-9 col-lg-6">
                        <input type="file" name="image" id="image">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="description">Mô tả</label>
                    <div class="col-md-12">
                        <textarea name="description" id="description" rows="10" cols="80"></textarea>
                    </div>

                </div>
                <div class="form-action">
                    <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
                </div>
            </form>
            <script type="text/javascript" src="../../vendor/ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('description');
            </script>
            <!-- /form -->
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
        </div>
    </div>
@endsection
