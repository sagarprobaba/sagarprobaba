@extends('admin.layout.master')

@section('page_title','Pages')

@section('page_heading','Pages')

@section('add_link', route('blog.create') )

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

                <th class="text-center" style="width: 30px;">No.</th>
                <th class="text-center" style="width: 180px;">Title</th>
                <th class="text-center" style="width: 180px;">Paragraph</th>
                <th class="text-center">Description</th>
                <th class="text-center" style="width: 80px;">Image</th>
                <th class="text-center" style="width: 50px;">View</th>
                <th class="text-center" style="width: 120px;">Home show</th>
                <th class="text-center" style="width: 50px;">Status</th>
                <th class="text-center" style="width: 50px;">Created on</th>
                <th class="text-center" style="width:120px">Action</th>

            </tr>

        </thead>

        <tbody>
            @foreach ($blogs as $element)
            <tr>
                <th class="text-center">{{ $loop->iteration }}</th>
                <th class="text-center">
                    <a href="{{ url('blog_view/'.$element->slug) }}">{{ str_limit($element->title, 50," 𝕟𝕖𝕩𝕥...") }}</a>
                </th>
                <th class="text-center">
                    {{ str_limit($element->paragraph, 70," 𝕟𝕖𝕩𝕥...") }}
                </th>
                <th class="text-center">
                    <iframe style="border: none;width: 100%; height: 80px;" srcdoc="{!! str_limit($element->body, 300," 𝕟𝕖𝕩𝕥...") !!}"></iframe>
                </th>
                <th class="text-center">
                    @if ($element->image)
                    <img style="width: 50px;" src="{{asset('public/images/blogimage/'.$element->image)}}" alt="">
                    @endif
                </th>
                <th class="text-center">
                    {{ $element->view }}
                </th>
                <th class="text-center">
                    {{ $element->is_ficher == '1'?'yes':"no" }}
                </th>
                <th class="text-center">
                    {{ $element->status == '1'?'Active':"Deactive" }}
                </th>
                <th class="text-center">
                    {{ $element->created_at  }}
                </th>
                <th class="text-center" style="width:120px">
                    <a class="btn btn-primary btn-xs" href="{{ route('blog.edit',$element->id) }}">
                        <i class="fa fa-pencil"> Edit </i>
                    </a>
                    
                    <form action="{{ route('blog.destroy',$element->id) }}" method="post">
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
                <div class="text-center"> {{$blogs->links()}} </div>
            </div>
        </div>
    </div> --}}
</div>  


@endsection


