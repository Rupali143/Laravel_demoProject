@extends('layouts.master')

@section('main-content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
            <!--begin:: Widgets/Inbound Bandwidth-->
            <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder kt-portlet--height-fluid-half">
                <div class="kt-portlet__head kt-portlet__space-x">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Total Products
                        </h3>
                    </div>
                    <div class="kt-widget20 col-md-6">
                        <div class="kt-widget20__content kt-portlet__space-x">
                            <span class="kt-widget20__number kt-font-brand pull-right">{{$productCount}}</span>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget20">
                        <div class="kt-widget20__content kt-portlet__space-x">
                            {{--<span class="kt-widget20__number kt-font-brand">{{$productCount}}</span>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Inbound Bandwidth-->
            <div class="kt-space-20"></div>
        </div>
    </div>
</div>
@endsection