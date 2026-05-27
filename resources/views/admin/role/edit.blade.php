@extends('admin.layout.app')
@section('title', 'Roles')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">@lang('translate.management')</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.role.index') }}">@lang('translate.listRole')</a>
                </li>
                <li class="breadcrumb-item active">{{ $role->name }}</li>
            </ol>
            <form method="post" action="{{ route('admin.role.update', ['role' => $role->id]) }}">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">
                        @lang('translate.name')<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-lg-6">
                        <select name="name" id="name" class="form-control">
                            @foreach ($roleNames as $roleName)
                                <option value="{{ $roleName }}" @selected(old('name', $role->name) === $roleName)>{{ $roleName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-action row">
                    <div class="col-md-9 col-lg-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-md mr-2">@lang('translate.save')</button>
                        <a href="{{ route('admin.role.index') }}" class="btn btn-secondary btn-md">@lang('translate.back')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
