
@extends('layouts.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@section('main-content')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Products </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->
    <div class="kt-portlet__body">
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
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">

                                </h3>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('product.create') }}">Add New</a>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet">
                                <!--begin::Form-->
                                <form class="kt-form" action="{{ route('product.index') }}" method="">
                                    @csrf
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="row">
                                            <div class="form-group col-md-3">
                                                <label></label>
                                                <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{$request->name}}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{--<label></label>--}}
                                                {{--<input type="text" class="form-control" placeholder="Enter Category" name="category">--}}
                                                <select class="form-control" name="category_id" style="margin-top: 6px;">
                                                    <option value="">Select</option>
                                                    @foreach($category as $c)
                                                        {{--<option value="{{ $c->id }}">{{ $c->name }}</option>--}}
                                                        {{--<option value="{{ $c->id }} " >{{ $c->name }}</option>--}}
                                                        {{--<option value="{{ $c->id }}"{{ 'selected="selected"'}}>{{ $c->name }}</option>--}}
                                                        {{--                                                        <option value="1" {{$category->status == 1 ? 'selected="selected"' : ''}}>Active</option>--}}
                                                        <option value="{{ $c->id }}" {{ $c->id == $request->category_id ? 'selected="selected"' : ''}}>{{ $c->name }}</option>
                                                        {{--<option value="{{ $c->id }}" {{ old('designation') == $c->id ? 'selected' : ''}}>{{ $c->name }}</option>--}}
                                                    @endforeach
                                                </select>
                                            </div>
                                                <div class="form-group col-md-3">
                                                    <select class="form-control" name="status" style="margin-top: 6px;">
                                                        <option value="">Select</option>
                                                        <option value="1" {{ '1' == $request->status ? 'selected="selected"' : ''}}>Active</option>
                                                        <option value="0" {{ '0' == $request->status ? 'selected="selected"' : ''}}>Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="kt-form__actions col-md-3" style="margin-top: 6px;">
                                                    <input type="submit" class="btn btn-success" value="Filter">
                                                    {{--<i class="fa fa-filter"></i>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!--end::Form-->
                            </div>

                            <!--begin::Section-->
                            <div class="kt-section">
                                <div class="kt-section__content">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            {{--<th>No.</th>--}}
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <?php $checked = ($product->status == 1) ? 'Active' : 'Inactive'; ?>
                                            <tr>
                                                {{--<td> {{ ++$i }}</td>--}}
                                                <td>{{ $product->name }}</td>
                                                <td> {{$product->cat ? $product->cat->name : '-'}}</td>
                                                <td>
{{--                                                    {{ $checked }}--}}

                                                    <input data-id="{{$product->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $product->status ? 'checked' : '' }}>
                                                    {{--<input type="button" data-id="{{ $product->id }}" data-toggle="toggle" {{ $product->status ? 'checked' : '' }}>--}}
                                               </td>
                                                <td>
                                                    <form action="{{ route('product.destroy',$product->id) }}" method="POST">

                                                        <a class="btn btn-info" href="{{ route('product.show', $product->id) }}">View</a>

                                                        <a class="btn btn-primary" href="{{ route('product.edit', $product->id) }}">Edit</a>

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"  onclick="return confirm('Do you want to deleted product?')" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!--end::Section-->
                        </div>

                        <!--end::Form-->
                    </div>

                    <!--end::Portlet-->

                {{--</div>--}}
            {{--</div>--}}

            {!! $products->links() !!}

        </div>
        <!--end:: Tab Content-->
    {{--</div>--}}
{{--</div>--}}
{{--</div>--}}
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function(){
        $.noConflict();
        $(".toggle-class").change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ url('changeStatus') }}",
                data: {'status': status, 'id': id},
                success: function(data){
//                    alert(data.success)
                }
            });
        });

    });
    </script>
<script>
    setTimeout(function() {
        $('#alert').fadeOut('fast');
    }, 1500);
</script>
