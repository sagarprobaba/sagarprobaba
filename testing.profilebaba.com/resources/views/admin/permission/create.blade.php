@extends('admin.layout.master')

@section('page_title','Permission')

@section('page_heading','Permission')

@section('add_link',url('/admin/permission/create'))

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
<form action="{{url('/admin/permission/')}}" name="frm_add_menu" id="frm_add_menu" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}

    <section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Create Permission</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

					<li><a href="#;">Dashboard</a></li>

					<li><a href="#;">Permission</a></li>

					<li>Create</li>

				</ul>

			</div>

			<div class="col-lg-3 text-right">

				<button type="submit" class="btn btn-round btn-success save-btn" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>

				<button type="reset" class="btn btn-round btn-warning reset-btn"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>

				<button onclick="window.history.go(-1); return false;" type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>

			</div>

		</div>

	</section>

	<div class="row">
		
		<div class="col-lg-9">

			<section class="panel">

				<header class="panel-heading">Permission Details</header>

				<div class="panel-body">
						<div class="form-group">
                            <label for="text">Role</label>
                            <select class="form-control" name="role_id">
								<option value="">Select Role</option>
								@foreach(\App\Role::where("created_by",1)->get() as $data)
								<option value="{{$data->id}}">{{$data->name}}</option>
								@endforeach
							</select>
                        </div>

					@foreach(\App\AdminMenu::where('parent_id',0)->get() as $data)
					<div class="form-group">
						<h5>{{$data->name}}</h5>
						@foreach(\App\AdminMenu::where('parent_id',$data->id)->get() as $child)
                        <div>
                            <input type="checkbox" class="" value="{{$child->id}}" name="menu_id[]" id="name" placeholder="Role">
                            <label for="text">{{$child->name}}</label>
						</div>
						@endforeach
					</div>
					@endforeach
                </div>
            </section>
        </div>
       

    </div>
</form>
@endsection
