@extends('admin.layouts.admin')

@section('title')
    edit roles
@endsection

@section('content')

 <!-- Content Row -->
 <div class="row">
    <div class="col-xl-12 col-md-12 mb-4 bg-white">
        <div class="mb-4">
            <h5 class="font-weight-bold mt-4">ویرایش نقش</h5>
        </div>
        <hr>
        @include('admin.sections.errors')
        <form action="{{ route('admin.roles.update' , ['role' =>$role]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row mb-0">
            <div class="form-group col-md-3">
                <label for="name">نام</label>
                <input class="form-control" id="name" name="name" type="text" value="{{ $role->name}}">
            </div>

            <div class="form-group col-md-3">
                <label for="text">نام نمایشی</label>
                <input class="form-control" id="display_name" name="display_name" type="text" value="{{ $role->display_name}}">
            </div>
            <div class="accordion col-md-12 mt-3 mb-4" id="accordionPermission">
                <div class="card">
                    <div class="card-header p-1" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-right" type="button" data-toggle="collapse"
                                data-target="#collapsePermission" aria-expanded="true" aria-controls="collapseOne">
                                مجوز های دسترسی
                            </button>
                        </h2>
                    </div>

                    <div id="collapsePermission" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionPermission">
                        <div class="card-body row">
                            @foreach ($permissions as $permission)
                                <div class="form-group form-check col-md-3">
                                    <input type="checkbox" class="form-check-input"
                                        id="permission_{{ $permission->id }}" name="{{ $permission->name }}"
                                        value="{{ $permission->name }}"
                                        {{in_array($permission->id , $role->permissions->pluck('id')->toArray()) ? 'checked' : ''}}>
                                    <label class="form-check-label mr-3"
                                        for="permission_{{ $permission->id }}">{{ $permission->display_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-outline-primary mt-0 mb-2 mr-3" type="submit">ثبت</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-dark mt-0 mb-2 mr-3">بازگشت</a>

        </form>
    </div>
 </div>
@endsection
