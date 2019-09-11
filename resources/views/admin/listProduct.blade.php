@extends('admin.layout')

@section('style')
@endsection

@section('content')
    <div class="tableListing">
        @include('partials.adminMenu')
        @include('partials.success')
        <div class="row-fluid">
            <div class="span12">
                <div class="portlet box blue">
                    <div class="portlet-body">
                        <div class="clearfix">
                            <div class="btn-group">
                                <a href="{{ URL::to('admin/addProduct') }}" class="btn green"> Add New Product <i
                                            class="icon-plus"></i></a>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr class="">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td><a class="edit"
                                           href="{{ URL::to('admin/editProduct/'. $product->id) }}">Edit</a>
                                    </td>
                                    <td><a class="delete"
                                           onclick="return confirm('Are you sure you want to delete this record?')"
                                           href="{{ URL::to('admin/deleteProduct/'.$product->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="dataTables_paginate paging_bootstrap pagination">
                            <ul>
                                {{ $products->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

