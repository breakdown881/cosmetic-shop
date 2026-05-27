@extends('admin.layout.app')
@section('title', 'Staffs')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">@lang('translate.management')</a>
                </li>
                <li class="breadcrumb-item active">@lang('translate.staffs')</li>
            </ol>
            <div class="action-bar">
                <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm">@lang('translate.add')</a>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">@lang('translate.name')</th>
                                    <th class="text-center">@lang('translate.email')</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">@lang('translate.status')</th>
                                    <th class="text-center">@lang('translate.createdAt')</th>
                                    <th class="no-sort text-center" width="120">@lang('translate.management')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs ?? [] as $staff)
                                    <tr>
                                        <td class="text-center">{{ $staff->name }}</td>
                                        <td class="text-center">{{ $staff->email }}</td>
                                        <td class="text-center">{{ $staff->role }}</td>
                                        <td class="text-center">
                                            {{ $staff->is_active ? __('translate.active') : __('translate.inactive') }}
                                        </td>
                                        <td class="text-center">{{ $staff->created_at }}</td>
                                        <td class="text-center row">
                                            <div class="col-md-6">
                                                <a href="{{ route('admin.staff.edit', ['staff' => $staff->id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <form action="{{ route('admin.staff.destroy', ['staff' => $staff->id]) }}"
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
