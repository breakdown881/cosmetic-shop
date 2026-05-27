@extends('admin.layout.app')
@section('title', 'Staffs')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">@lang('translate.management')</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.staff.index') }}">@lang('translate.staffs')</a>
                </li>
                <li class="breadcrumb-item active">{{ $staff->name }}</li>
            </ol>
            <form method="post" action="{{ route('admin.staff.update', ['staff' => $staff->id]) }}">
                @csrf
                @method('PATCH')
                @include('admin.staff.form', ['staff' => $staff])
            </form>
        </div>
    </div>
@endsection
