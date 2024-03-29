@extends('admin.layout.master')

@section('page_title','Hobby')

@section('page_heading','Hobby')

@section('add_link',url('/admin/services/create'))

@section('top')
@include('admin.layout.top')
@endsection

@section('container')

@if(Session::has('message'))
<div class="alert alert-success">
    {{ Session::get('message') }}
</div>
@endif

@if (Session::has('errors'))
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    {{ $error }}<br/>
    @endforeach
</div>
@endif

<div class="adv-table">
    <table class="table table-striped table-hover table-bordered" id="editable-sample">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Hobby Name</th>
                <th class="text-center">Created on</th>
                <th class="text-center" >Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 0; ?>
            @foreach($items as $item)
            <?php $i++; ?>
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{$item->stitle}}</td>
                <td class="text-center">{{$item->created_at }}</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-xs" href="{{url('/admin/services/'.$item->serid.'/edit')}}">
                        <i class="fa fa-pencil"> Edit </i>
                    </a>
                    <form action="{{url('/admin/services/'.$item->serid)}}" method="post" style="display:inline-block">
                        <input type="hidden" name="_method" value="DELETE" />
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs  " type="submit" name="submit" ><i class="fa fa-trash-o"> Delete</i></button >
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div class="row">
        <div class="col-lg-6">
            <span class="record_info">
                Showing 10 of 14
            </span>
        </div>
        <div class="col-lg-6">
            <div class="dataTables_paginate paging_bootstrap pagination">
                <ul><li><a href="#" class="pageActive">1</a></li><li><a href="#" data-ci-pagination-page="2">2</a></li><li><a href="#" data-ci-pagination-page="2" rel="next">Next &gt;&gt; </a></li></ul>
            </div>
        </div>
    </div> --}}
</div>  
@endsection