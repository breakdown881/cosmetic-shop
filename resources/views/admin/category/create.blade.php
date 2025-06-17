@extends('admin.layout.app')
@section('title', 'Categories')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">@lang('translate.management')</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.category.index') }}">@lang('translate.categories')</a>
                </li>
                @if (!empty($isChild))
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.category.list', ['id' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item active">
                    @lang('translate.add')
                </li>
            </ol>
            <!-- /form -->
            @php
                if (empty($isChild)) {
                    $url        = route('admin.category.store');
                    $urlBack    = route('admin.category.index');
                } else {
                    $url        = route('admin.category.store.child', ['id' => $category->id]);
                    $urlBack    = route('admin.category.list', ['id' => $category->id]);
                }
            @endphp
            <form method="post" action="{{ $url }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">
                        @lang('translate.name')<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="name" id="name" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="status">
                        @lang('translate.status')<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-lg-6">
                        <select name="status" id="status" class="form-control">
                            <option value="0">@lang('translate.inactive')</option>
                            <option value="1">@lang('translate.active')</option>
                        </select>
                    </div>
                </div>
                <div class="form-action row">
                    <div class="col-md-9 col-lg-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-md mr-2">@lang('translate.save')</button>
                        <a href="{{ $urlBack }}" class="btn btn-secondary btn-md">@lang('translate.back')</a>
                    </div>
                </div>
            </form>
            <!-- /form -->
        </div>
    </div>
@endsection
