@extends('layouts.common')
@section('pageTitle','Maintanance')
@push('externalCssLoad')

@endpush
@push('internalCssLoad')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="middle-box text-center loginscreen  animated fadeInDown">
            <div>

            </div>
            <div class="col-lg-12">
                <h2>Page Not Found</h2>
                <p>Module is under Construction</p>
            </div>
            <a href="{{url('dashboard')}}"><h3>Click here to go Dashboard...</h3></a>
        </div>
    </div>
</div>
@endsection
@push('externalJsLoad')
@endpush
@push('internalJsLoad')
@endpush