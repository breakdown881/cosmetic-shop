<div class="form-group row">
    <label class="col-md-12 control-label" for="name">
        @lang('translate.name')<span class="required">*</span>
    </label>
    <div class="col-md-9 col-lg-6">
        <input name="name" id="name" type="text" value="{{ old('name', $staff?->name) }}" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-12 control-label" for="email">
        @lang('translate.email')<span class="required">*</span>
    </label>
    <div class="col-md-9 col-lg-6">
        <input name="email" id="email" type="email" value="{{ old('email', $staff?->email) }}" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-12 control-label" for="password">
        @lang('translate.password'){{ $staff ? '' : '*' }}
    </label>
    <div class="col-md-9 col-lg-6">
        <input name="password" id="password" type="password" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-12 control-label" for="password_confirmation">
        Confirm password{{ $staff ? '' : '*' }}
    </label>
    <div class="col-md-9 col-lg-6">
        <input name="password_confirmation" id="password_confirmation" type="password" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-12 control-label" for="phone_number">Phone</label>
    <div class="col-md-9 col-lg-6">
        <input name="phone_number" id="phone_number" type="text" value="{{ old('phone_number', $staff?->phone_number) }}" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-12 control-label" for="address">Address</label>
    <div class="col-md-9 col-lg-6">
        <input name="address" id="address" type="text" value="{{ old('address', $staff?->address) }}" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-12 control-label" for="role">Role<span class="required">*</span></label>
    <div class="col-md-9 col-lg-6">
        <select name="role" id="role" class="form-control">
            @foreach ($roles as $label => $role)
                <option value="{{ $role }}" @selected(old('role', $staff?->role) === $role)>{{ $role }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-12 control-label" for="is_active">
        @lang('translate.status')<span class="required">*</span>
    </label>
    <div class="col-md-9 col-lg-6">
        <select name="is_active" id="is_active" class="form-control">
            <option value="0" @selected((string) old('is_active', (int) ($staff?->is_active ?? true)) === '0')>@lang('translate.inactive')</option>
            <option value="1" @selected((string) old('is_active', (int) ($staff?->is_active ?? true)) === '1')>@lang('translate.active')</option>
        </select>
    </div>
</div>
<div class="form-action row">
    <div class="col-md-9 col-lg-6 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary btn-md mr-2">@lang('translate.save')</button>
        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary btn-md">@lang('translate.back')</a>
    </div>
</div>
