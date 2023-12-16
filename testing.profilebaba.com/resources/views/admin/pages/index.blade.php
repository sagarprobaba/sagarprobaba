@extends('admin.layout.master')

@section('page_title','Pages')

@section('page_heading','Pages')

@section('add_link',url('/admin/cmspages/create'))

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
                <th class="text-center">Title</th>

                <th class="text-center">Heading</th>

                <th class="text-center">Status</th>

                <th class="text-center">Created on</th>

                <th class="text-center" style="width:210px">Action</th>

            </tr>

        </thead>

        <tbody>

            <?php $n=1; ?>
            @foreach($items as $item)

            <tr>

                <td class="text-center">{{ $loop->iteration }}</td>

                <td>{{$item->title}}
                    <a  class="btn btn-primary btn-xs" target="_blank"  href="{{url('/'.$item->slug)}}"><i class="far fa-eye"></i></a>
                </td>

                <td>
                {{$item->heading}}
                </td>

                <td class="text-center">

                    <span class="label label-info label-mini">Active</span>
                </td>

                <td class="text-center">{{$item->created_at}}</td>

                <td class="text-center" style="display: flex;justify-content: space-evenly;">

                    <a class="btn btn-primary btn-xs" href="{{url('/admin/cmspages/'.$item->id.'/edit')}}"><i class="fa fa-pencil"> Edit </i></a>





                    <form action="{{url('/admin/cmspages/'.$item->id)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE" />
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs  " type="submit" name="submit" ><i class="fa fa-trash-o"> Delete</i></button >


                    </form>



                    <a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="14" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="More Details" title="Active">

                        Active
                    </a>

                </td>

            </tr>

            <?php $n++; ?>
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


