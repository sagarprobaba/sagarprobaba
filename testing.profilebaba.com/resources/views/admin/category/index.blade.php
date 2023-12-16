@extends('admin.layout.master')

@section('page_title','Category')

@section('page_heading','Category')

@section('add_link',url('/admin/category/create'))

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

@php
$category = App\Category::where('status','1')->orderBy('title','ASC')->get();
@endphp
<div class="adv-table">

  <!-- <form class="form-inline form"  action="">
    <div class="form-group">
      <input type="text" name="title" class="form-control"  placeholder="Title" value="{{request('title')}}" />
    </div>
    <div class="form-group">
      <select class="form-control" name="parent">
        <option value="0">Select Parent Category</option>
        @foreach($category as $cat)
        <option value="{{$cat->id}}" {{$cat->id == request('parent') ? "selected" : ""}}>{{$cat->title}}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>  -->

  <br />


  <table class="table table-striped table-hover table-bordered" id="category_table">

    <thead>

      <tr>

        <th class="text-center">ID.</th>

        <th class="text-center">Name</th>

        <th class="text-center">Parent</th>
        <th class="text-center">Show in Mobile</th>

        <th class="text-center">Status</th>

        <th class="text-center">Created on</th>

        <th class="text-center" style="width:210px">Action</th>

      </tr>

    </thead>

    <tbody>



      @foreach($items as $item)

      <tr>

        <td class="text-center">{{ $loop->iteration }}</td>

        <td>{{$item->title}}</td>

        <td>@if($item->parent){{$item->parent->title}}@endif</td>
        <td>{{$item->show_in_mobile == '1' ? 'Yes' : 'No'}}</td>

        <td class="text-center">
        @if($item->status == 1)
          <span class="label label-info label-mini">Active</span>
        @else
        <span class="label label-danger label-mini">Block</span>
        @endif
        </td>

        <td class="text-center">{{$item->created_at}}</td>

        <td class="text-center">

          <a class="btn btn-primary btn-xs" href="{{url('/admin/category/'.$item->id.'/edit')}}"><i class="fa fa-pencil"> Edit </i></a>





          <form action="{{url('/admin/category/'.$item->id)}}" method="post" style="display: inline-block">
            <input type="hidden" name="_method" value="DELETE" />
            {{csrf_field()}}
            <button class="btn btn-danger btn-xs  " type="submit" name="submit" ><i class="fa fa-trash-o"> Delete</i></button >


          </form>





        </td>

      </tr>
      @endforeach





    </tbody>

  </table>


  <!-- <div class="row">


 
    <div class="col-lg-12">

      <div class="dataTables_paginate paging_bootstrap pagination">
        {{ $items->appends(request()->all())->links() }}
      </div>
    </div>
  </div> -->
</div>  
@endsection

@section('javascript')
<script>
  $('#category_table').DataTable();
</script>
@endsection