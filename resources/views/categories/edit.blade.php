@extends('layouts.master')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<style>
    #page_list li
    {
        padding:16px;
        background-color:#f9f9f9;
        border:1px dotted #ccc;
        cursor:move;
        margin-top:12px;
    }
    #page_list li.ui-state-highlight
    {
        padding:24px;
        background-color:#ffffcc;
        border:1px dotted #ccc;
        cursor:move;
        margin-top:12px;
    }
</style>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                   Edit Categories </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>

                </div>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->
    <div class="kt-portlet__body">
        <div class="tab-content  kt-margin-t-20">
            <!--Begin:: Tab Content-->
            @if (session()->has('success'))
                <div class="alert alert-success fade show" role="alert">
                    <div class="alert-text"><strong>
                            {!! session()->get('success') !!} !!
                        </strong></div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                <div class="row">
                    <div class="col-xl-6">
                        <!--begin::Portlet-->
                        <div class="kt-portlet">
                            <div class="kt-portlet__body">
                                {{--<div class="row">--}}
                                <form class="kt-form kt-form--label-right" action="{{ route('category.update',$category->id) }}" method="post">
                                    @csrf
                                    {{--@method('PUT')--}}
                                    <div class="kt-form__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="form-group col-md-6">
                                                    <label class="col-xl-4 col-lg-3 col-form-label">Category</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" type="text" name="name" value="{{ $category->name }}" placeholder="Enter Category Name" required data-parsley-pattern="/^[a-zA-Z]*$/" data-parsley-required-message="Category is required" data-parsley-trigger="keyup">
                                                    </div><br>
                                                    <div class="col-lg-9 col-xl-6">
                                                    <?php $checked = ($category->status == 1) ? 'Active' : 'Inactive'; ?>
                                                    <select class="form-control" id="" name="status">
                                                        <option value="1" {{$category->status == 1 ? 'selected="selected"' : ''}}>Active</option>
                                                        <option value="0" {{$category->status == 0 ? 'selected="selected"' : ''}}>Inactive</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <input type="submit" class="btn btn-brand btn-bold pull-right" value="Save" style="margin-left: 20px;">
                                                    {{--                                                    <a href="{{ route('category.index') }}" type="button" class="btn btn-brand btn-bold pull-right">Back</a>--}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </form>

                            </div>
                        {{--</div>--}}



                        <!--end::Form-->
                        </div>

                        <!--end::Portlet-->

                    </div>
                </div>

            </div>
            <!--end:: Tab Content-->
        </div>
    </div>
</div>

@extends('layouts.footer')