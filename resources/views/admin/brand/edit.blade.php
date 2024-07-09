@extends('admin.layout.app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">@lang('translate.management')</a>
                </li>
                <li class="breadcrumb-item active">@lang('translate.brands')</li>
            </ol>
            <!-- /form -->
            <form method="post" action="{{ route('admin.brand.update', ['id' => $brand->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">@lang('translate.name')<span
                            class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <input name="name" id="name" type="text" value="{{$brand->name}}" class="form-control">
                    </div>
                </div>
                <div class="form-action row">
                    <div class="col-md-9 col-lg-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-md mr-2">@lang('translate.save')</button>
                        <a href="{{ route('admin.brand.index') }}" class="btn btn-secondary btn-md">@lang('translate.back')</a>
                    </div>
                </div>
            </form>
            <!-- /form -->
        </div>
    </div>
@endsection
