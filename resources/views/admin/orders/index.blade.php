@extends('admin.layouts.admin')

@section('title')
    orders index
@endsection

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
        <div class=" d-flex flex-column text-center flex-md-row justify-content-between mb-4">
            <h5 class="font-weight-bold mt-4">لیست سفارشات  ({{$orders->total()}})</h5>

        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>وضعیت</th>
                        <th>مبلغ</th>
                        <th>نوع پرداخت</th>
                        <th>وضعیت پرداخت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key=>$order)
                        <tr>
                            <th>
                                {{ $orders->firstItem() + $key }}
                            </th>
                            <th>
                                {{ $order->user->name == null ? 'کاربر گرامی' : $order->user->name}}
                            </th>
                            <th>
                                {{ $order->status }}
                            </th>
                            <th>
                                {{ number_format($order->paying_amount) }}
                            </th>
                            <th>
                                {{ $order->payment_type }}
                            </th>
                            <th>
                                {{ $order->payment_status }}
                            </th>
                            <th>
                                <a class="btn btn-sm btn-outline-success" href="{{ route('admin.orders.show', ['order' => $order->id])  }}"> نمایش </a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$orders->render()}}
        </div>
    </div>
</div>
@endsection
