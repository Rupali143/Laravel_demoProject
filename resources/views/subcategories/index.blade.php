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

                            </h3>
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('subcategory.create') }}">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="kt-section">
                        <div class="kt-section__content">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allSubcategories as $all)
                                    <tr>
                                        <td>{{ $all->name }}</td>
                                        <td> {{ $all->cat->name }}</td>
                                        <td>
                                            <form action="{{ route('subcategory.destroy',$all->id) }}" method="POST">
                                                <a class="btn btn-info" href="{{ route('subcategory.show', $all->id) }}">View</a>
                                                <a class="btn btn-primary" href="{{ route('subcategory.edit', $all->id) }}">Edit</a>
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
                </div>
                <!--end::Portlet-->
        </div>
    </div>
@endsection