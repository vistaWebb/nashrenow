@extends('admin.layouts.admin')

@section('title')
    users index
@endsection

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
        <div class="d-flex flex-column text-center flex-md-row justify-content-between mb-4">
            <h5 class="font-weight-bold mt-4">لیست کاربران ({{$users->total()}})</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>شماره تلفن</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key=>$user)
                        <tr>
                            <th>
                                {{ $users->firstItem() + $key }}
                            </th>
                            <th>
                                    {{ $user->name }}
                            </th>
                            <th>
                                    {{ $user->email }}
                            </th>
                            <th>
                                    {{ $user->cellphone }}
                            </th>

                            <th>

                                <a class="btn btn-sm btn-outline-info mr-3" href="{{ route('admin.users.edit', ['user' => $user->id])  }}"> ویرایش </a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$users->render()}}
        </div>
    </div>
</div>
@endsection
