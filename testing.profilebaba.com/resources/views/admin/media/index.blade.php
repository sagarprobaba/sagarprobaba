@extends('admin.layout.master')
@section('page_title',ucfirst($type).'s')

@section('title',ucfirst($type).'s')

 
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
 
<br />
 <form action="{{url('/admin/'.$type)}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}

<table class="table table-striped table-hovered" width="405" height="226" border="0">
 
  
  <tr>
    <td>Upload File </td>
    <td><input   type="file" class="form-control" name="file" ></td>
  </tr>
  
  
    <tr>
    <td>Alt Tag </td>
    <td>
		<input   type="text" class="form-control"  name="alt_tag"   >   </td>
  </tr>
  
   <tr>
    <td>Title Tag   </td>
    <td>
		<input   type="text"  class="form-control"  name="title_tag"   >   </td>
  </tr>
  
   
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></td>
  </tr>
</table>




</form>  <br />
  
  <table width="100%" border="0" class="table  table-striped table-hover">
  <tr>
    <td>S/No</td>
    <td>Banner</td>
      <td>Alt Tag</td>
	   <td>Title Tag</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>
  

<?php $n=1; ?>
@foreach($items as $value)
	
	 <tr>
    <td>{{$n}}</td>
     <td>
	 <?php
	 $file_path=str_replace('base_url',url('/'),$value->file);
	 ?>
	 <img src="{{url($file_path)}}" style="max-height:80px" /></td>
	      <td>{{$value->alt_tag}}</td>
		     <td>{{$value->title_tag}}</td>

	  
    <td><a   href="{{url('/admin/'.$type.'/'.$value->mid.'/edit')}}"><i class="far fa-edit"></i></a></td>
    <td>
	
	
	
	
	
	<form action="{{url('/admin/'.$type.'/'.$value->mid)}}" method="post">
		<input type="hidden" name="_method" value="DELETE" />
		{{csrf_field()}}
		<input    type="hidden" name="submit" value="Delete" />
		<button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure want to delete this ?');return false;"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
		
	</form>
	
	
	
	
	</td>
	
	
	
	
	</td>
  </tr>
	
	<?php $n++; ?>
@endforeach

</table>


  
 
  

@endsection
