@extends('admin.layout.master')
@section('page_title','Designation')
@section('page_heading','Designation')
@section('add_link',url('/admin/otherdetails/create'))
@section('container')


{!! Form::open(['route' => ['otherdetails.store'],'method' => 'post', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data',]) !!}

 <section class="top-bredcumb">
        <div class="row">
            <div class="col-lg-3">
                <h4>Designation</h4>
            </div>
            <div class="col-lg-6">              
                <ul class="breadcrumb">
                  <li><a href="#">Dashboard</a></li>
                  <li><a href="#">Designation Manager</a></li>
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
        <div class="col-lg-10">
            <section class="panel">
                <div class="panel-body">

                    @include('admin.otherdetails._form_htlm')

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
