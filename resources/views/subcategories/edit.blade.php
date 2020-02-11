@extends('layouts.master')

@section('main-content')

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>

    @endif

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
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
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Edit SubCategory
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="{{ route('subcategory.update',$subcategory->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" required="required" class="form-control">
                                <option value="">--Select Category--</option>
                                @foreach($category as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected="selected"' : '' }}> {{ $category->name }} </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>SubCategory</label>
                            <input type="text" class="form-control" name="name" value="{{ $subcategory->name }}" required>
                        </div>

                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <input type="submit" class="btn btn-primary" value="Submit"/>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
@endsection