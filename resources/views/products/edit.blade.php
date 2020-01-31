
@extends('layouts.master')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Products </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Edit product </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>

    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <li> {{session('success')}}</li>
        </div>
    @endif
    <div class="kt-portlet__body">
        <div class="tab-content  kt-margin-t-20">

            <!--Begin:: Tab Content-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Edit Products
                        </h3>
                    </div>
                </div><br>
                {{--<div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">--}}

                <form class="kt-form kt-form--label-right" action="{{ route('product.update',$product->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="kt-form__body">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input class="form-control" type="text" name="name"  value="{{ $product->name }}" placeholder="Enter Product name" required data-parsley-pattern="/^[a-zA-Z]*$/" data-parsley-required-message="Product Name is required" data-parsley-trigger="keyup">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Category</label>
                                    <div class="col-lg-9 col-xl-6">
                                            <select class="form-control" id="" name="category_id">
                                                @foreach($category as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $product->id ? 'selected="selected"' : '' }}> {{ $category->name }} </option>
                                                    {{--<option value="{{ $category['name'] }}"  {{ $category['id'] == $product['id'] ? 'selected="selected"' : '' }}>{{ $category['name'] }}</option>--}}
                                                @endforeach
                                            </select>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <?php $checked = ($product->status == 1) ? 'Active' : 'Inactive'; ?>
                                        <select class="form-control" id="" name="status">
                                                <option value="1" {{$product->status == 1 ? 'selected="selected"' : ''}}>Active</option>
                                                <option value="0" {{$product->status == 0 ? 'selected="selected"' : ''}}>Inactive</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group col-8">
                                    <input type="submit" class="btn btn-brand btn-bold pull-right" value="Save Changes" style="margin-left: 20px;">
                                    <a href="{{ route('product.index') }}" type="button" class="btn btn-brand btn-bold pull-right">Back</a>

                                </div>
                            </div>
                        </div>

                    </div>

                </form>
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
<!--End:: Tab Content-->





