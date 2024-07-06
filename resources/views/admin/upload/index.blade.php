@extends('admin.layout.app')
@section('content')
<div id="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="index.php">Quản lý</a>
         </li>
         <li class="breadcrumb-item active">Hình ảnh</li>
      </ol>
      <!-- DataTables Example -->
      <div class="action-bar">
         
         <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
      </div>
      <div class="card mb-3">
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th><input type="checkbox" onclick="checkAll(this)"></th>
                        <th>Hình ảnh</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><input type="checkbox"></td>
                        <td><img src="../../images/suaTamSandrasShowerGel.jpg"></td>
                        <td><input type="button" onclick="Delete('25');" value="Xóa" class="btn btn-danger btn-sm"></td>
                     </tr>
                     <tr>
                        <td><input type="checkbox"></td>
                        <td><img src="../../images/boKemTriMunSakura.jpg"></td>
                        <td><input type="button" onclick="Delete('25');" value="Xóa" class="btn btn-danger btn-sm"></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>

      </div>
      <form action="{{route('admin.image.upload')}}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-md-12">
               <label>Upload hình</label>
            </div>
         </div>
         
         <div class="row form-group">
            <div class="col-md-12">
               <input type="file" name="image" id="image" class="form-control">
            </div>
         </div>
         <div class="row form-group"> 
            <div class="col-md-12">
               <input type="submit" value="Upload" class="btn btn-primary btn-sm">
            </div>
         </div>
      </form>
   </div>
   <!-- /.container-fluid -->
   <!-- Sticky Footer -->
</div>
@endsection