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
                                <a href="{{ URL::to('admin/addAdminUser') }}" class="btn green"> Add New Admin User <i
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
                            @foreach($users as $user)
                                <tr class="">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                    <td><a class="edit"
                                           href="{{ URL::to('admin/editAdminUser/'. $user->id) }}">Edit</a>
                                    </td>
                                    <td><a class="delete"
                                           onclick="return confirm('Are you sure you want to delete this record?')"
                                           href="{{ URL::to('admin/deleteAdminUser/'.$user->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="dataTables_paginate paging_bootstrap pagination">
                            <ul>
                                {{ $users->links() }}
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

