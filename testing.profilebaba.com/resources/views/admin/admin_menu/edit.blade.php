@extends('admin.layout.master')

@section('page_title','Admin Menu')

@section('page_heading','Admin Menu')

@section('add_link',url('/admin/admin_menu/create'))

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
<form action="{{url('/admin/admin_menu/'.$item->id)}}" name="frm_add_menu" id="frm_add_menu" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
	{{ method_field('PUT')}} 
    <section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Edit Menu</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Admin Menu</a></li>

					<li>Edit</li>

				</ul>

			</div>

			<div class="col-lg-3 text-right">

				<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

				<button onclick="window.history.go(-1); return false;" type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>

			</div>

		</div>

	</section>

	<div class="row">
		
		<div class="col-lg-9">

			<section class="panel">

				<header class="panel-heading">Menu Details</header>

				<div class="panel-body">
                <div class="form-group">
                            <label for="text">Name</label>
                             <input type="text" required="" value="{{$item->name}}" class="form-control item-menu" name="name" id="name" placeholder="Title">
                        </div>

                        <div class="form-group">
                            <label for="text">Parent</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">Select Parent</option>
                                <?php 
                                $menu=\App\AdminMenu::where('parent_id',0)->get();
                                ?> 
                                @foreach($menu as $val)
                                <option value="{{$val->id}}" {{$item->parent_id == $val->id ? 'selected' : ''}}>{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="text">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" {{$item->status == '1' ? 'selected' : ''}}>Active</option>
                                <option value="0" {{$item->status == '0' ? 'selected' : ''}}>Block</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="text">URL</label>
                            <div class="input-group">
                                <span class="input-group-addon">{{ url('/admin') }}/</span>
                                <input type="text" class="form-control item-menu ffffffff" value="{{$item->url}}" id="url" name="url" placeholder="Enter URL">
                            </div>
                        </div>
                </div>
            </section>
        </div>
       

    </div>
</form>
@endsection
