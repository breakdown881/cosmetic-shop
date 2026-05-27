@extends('admin.layout.app')
@section('title', 'Roles')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">@lang('translate.management')</a>
                </li>
                <li class="breadcrumb-item active">@lang('translate.listRole')</li>
            </ol>
            <div class="action-bar">
                <a href="{{ route('admin.role.create') }}" class="btn btn-primary btn-sm">@lang('translate.add')</a>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="300">@lang('translate.name')</th>
                                    <th class="text-center" width="140">@lang('translate.createdAt')</th>
                                    <th class="text-center" width="140">@lang('translate.updatedAt')</th>
                                    <th class="no-sort text-center" width="120">@lang('translate.management')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles ?? [] as $role)
                                    <tr>
                                        <td class="text-center">{{ $role->name }}</td>
                                        <td class="text-center">{{ $role->created_at }}</td>
                                        <td class="text-center">{{ $role->updated_at }}</td>
                                        <td class="text-center row">
                                            <div class="col-md-6">
                                                <a href="{{ route('admin.role.edit', ['role' => $role->id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <form action="{{ route('admin.role.destroy', ['role' => $role->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
