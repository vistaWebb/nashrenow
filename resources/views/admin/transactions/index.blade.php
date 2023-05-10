@extends('admin.layouts.admin')

@section('title')
    transactions index
@endsection

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
        <div class=" d-flex flex-column text-center flex-md-row justify-content-between mb-4">
            <h5 class="font-weight-bold mt-4">لیست تراکنش ها  ({{$transactions->total()}})</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>شماره سفارش</th>
                        <th>مبلغ</th>
                        <th> ref_id</th>
                        <th>نام درگاه پرداخت</th>
                        <th>وضعیت </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $key=>$transaction)
                        <tr>
                            <th>
                                {{ $transactions->firstItem() + $key }}
                            </th>
                            <th>
                                {{ $transaction->user->name == null ? 'کاربر گرامی' : $transaction->user->name}}
                            </th>
                            <th>
                                {{ $transaction->order_id }}
                            </th>
                            <th>
                                {{ number_format($transaction->amount) }}
                            </th>
                            <th>
                                {{ $transaction->ref_id }}
                            </th>
                            <th>
                                {{ $transaction->gateway_name }}
                            </th>
                            <th>
                                {{ $transaction->status }}
                            </th>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$transactions->render()}}
        </div>
    </div>
</div>
@endsection
