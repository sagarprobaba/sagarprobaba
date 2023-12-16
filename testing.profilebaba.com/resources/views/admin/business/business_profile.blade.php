@extends('admin.layout.master')
@section('page_title','User')
@section('page_heading','User')
@section('add_link',url('/admin/user/'.$data[0]->user_id.'/business/location'))
@section('top')
@include('admin.layout.top')
@endsection
@section('container')

<style type="text/css" media="screen">
	.djgbnijb{
		padding-bottom: 12px;
		border-bottom: 1px solid #bec3c7;
	}
	.dataTables_paginate{
		padding: 0;
		margin-bottom: 0 !important;
	} 
	.dataTables_paginate .pagination{
		margin: 0;
	}
	.djgbnijb.form-inline .form-group {
        margin-bottom: 2px;
        margin-top: 2px;
    }
</style>
{!! Form::model(request()->all(),['route' => ['admin_user'],'method' => 'get', 'id' => 'filter', 'class' => 'djgbnijb form-inline']) !!}

	<div class="form-group">
		{{ Form::text('name',null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Full Name']) }}
	</div>

	<div class="form-group">
		{{ Form::text('email',null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
	</div>

	<div class="form-group">
		{{ Form::text('phone',null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) }}
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
	<br>
{!! Form::close() !!}

<div class="adv-table">
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th class="text-center">No.</th>
				<th class="text-center">Business name</th>
				<th class="text-center">About Me</th>							
				<th class="text-center">Category</th>								
				<th class="text-center">Created on</th>
				<th class="text-center" style="width:310px">Action</th>
			</tr>
		</thead>
		<tbody class="content" id="add_prodect_ajax">

        @foreach($data as $k=>$item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $item->business_name }}</td>
                <td>{{ $item->about_me }}</td>
                <td class="text-center">@foreach ($item->category()->get() as $cat)
												    {{ $cat->title.', ' }}
                                                @endforeach</td>								
                <td class="text-center">{{$item->created_at}}</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-xs" href="{{url('/admin/user/'.$item->user_id.'/business/location/'.$item->id)}}"><i class="fa fa-pencil"> Edit </i></a>
                    <form action="{{url('/admin/user/business/'.$item->id)}}" method="post" class="btnform">
                        <input type="hidden" name="_method" value="DELETE" />
                        {{csrf_field()}}
                        <button class="btn btn-danger btn-xs " type="submit" name="submit" ><i class="fa fa-trash-o"> Delete</i></button >
                    </form>
                </td>

            </tr>
        @endforeach

		</tbody>
	</table>
</div>   
@endsection