@extends('admin.layout.master')
@section('page_title','Work and service')
@section('page_heading','Work and service')
@section('add_link',url('/admin/issue/create'))
@section('container')


{!! Form::open(['route' => ['issue.store'],'method' => 'post', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data',]) !!}

<section class="top-bredcumb">
    <div class="row">
        <div class="col-lg-3">
            <h4>Work and service</h4>
        </div>
        <div class="col-lg-6">              
            <ul class="breadcrumb">
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Work and service Manager</a></li>
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
    <section class="panel">
        <div class="panel-body">
            <div class="col-lg-6">
                @include('admin.issue._form_htlm')

            </div>
        </div>
    </section>
    <input type ="hidden" name="submit" value="submit">
</div>
{!! Form::close() !!}
@endsection

{{-- add prosenall js --}}
@section('javascript')

@endsection
