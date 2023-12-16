@extends('admin.layout.master')

@section('page_title','Cast')

@section('page_heading','Cast')

@section('add_link',url('/admin/genres/create'))

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

{!! Form::model($item,['route' => ['genres.update', $item->gid],'method' => 'patch', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data',]) !!}

<section class="top-bredcumb">
    <div class="row">
        <div class="col-lg-3">
            <h4>Cast edit</h4>
        </div>
        <div class="col-lg-6">              
            <ul class="breadcrumb">
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Cast Manager</a></li>
              <li>Create</li>
          </ul>
      </div>
      <div class="col-lg-3 text-right">
        <button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button type="button" class="btn btn-round btn-warning reset-btn"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
        <button type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>
    </div>
</div>

</section>

<div class="row">
    <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading">Cast Details</header>
            <div class="panel-body">

                @include('admin.genres._form_htlm')

            </div>
        </section>
    </div>
    <input type ="hidden" name="submit" value="submit">
</div>
{!! Form::close() !!}


@endsection

{{-- add prosenall js --}}
@section('javascript')

@endsection