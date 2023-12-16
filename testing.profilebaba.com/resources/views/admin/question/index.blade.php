@extends('admin.layout.master')

@section('page_title','Pages')

@section('page_heading','Pages')

@section('add_link', route('question.create') )

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

<form action="" method="get">
    <div class="adv-table">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php $request = \Request::all(); ?>
                    <select name="status" id="isActive" class="form-control">

                        <option {{ (isset($request['status'])?$request['status']:"")=='all'?'selected':"" }} value="all">All</option>

                        <option {{ (isset($request['status'])?$request['status']:"")=='2'?'selected':"" }} value="2">Active</option>

                        <option {{ (isset($request['status'])?$request['status']:"")=='1'?'selected':"" }} value="1">Deactive</option>

                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Search</button>

                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</form>
<div class="adv-table">

    <table class="table table-striped table-hover table-bordered" id="editable-sample">

        <thead>

            <tr>

                <th class="text-center" style="width: 30px;">No.</th>
                <th class="text-center" style="width: 140px;">phone</th>
                <th class="text-center" style="width: 140px;">email</th>
                <th class="text-center" style="width: 280px;">Practice Area / Sub Area</th>
                <th class="text-center" style="width: 180px;">question</th>
                <th class="text-center">answers</th>
                {{-- <th class="text-center" style="width: 50px;">views</th> --}}
                <th class="text-center" style="width: 50px;">Status</th>
                <th class="text-center">Created on</th>
                <th class="text-center" style="width:120px">Action</th>

            </tr>

        </thead>
        <tbody>
            @foreach ($questions as $element)
            <tr>
                <th class="text-center">{{ $loop->iteration }}</th>
                <th class="text-center">
                    {{ $element->phone }}
                </th>
                <th class="text-center">
                    {{ $element->email }}
                </th>
                <th class="text-center">
                    {{$element->stitle}} <hr style="margin: 5px;">
                    {{$element->issuename}} 
                </th>
                <th class="text-center">
                    <a href="{{ url('question_view/'.$element->slug) }}">{{ str_limit($element->question, 50," 𝕟𝕖𝕩𝕥...") }}</a>
                </th>
                <th class="text-center">
                    {{ str_limit(strip_tags($element->answers),50," 𝕟𝕖𝕩𝕥...") }}
                </th>

                <th class="text-center">
                    {{ $element->status == '2'?'Active':"Deactive" }}
                </th>
                <th class="text-center">
                    {{ $element->created_at  }}
                </th>
                <th class="text-center" style="width:120px">
                    <a class="btn btn-primary btn-xs" href="{{ route('question.edit',$element->id) }}">
                        <i class="fa fa-pencil"> Edit </i>
                    </a>

                    <form action="{{ route('question.destroy',$element->id) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE" />
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs  " type="submit" name="submit" ><i class="fa fa-trash-o"> Delete</i></button >
                    </form>

                </th>
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


            <div class="justify-content-center row">
                <div class="text-center"> {{$questions->links()}} </div>
            </div>
        </div>
    </div> --}}
</div>  


@endsection


