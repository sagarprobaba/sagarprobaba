@extends('admin.layout.master')

@section('page_title',ucfirst($type).'s')

@section('title','Edit '.ucfirst($type))

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
 

<a  class="btn  btn-secondary " href="{{url('/admin/'.$type)}}"><i class="fas fa-chevron-circle-left"></i> Back</a>

<br />
<br />

<form action="{{url('/admin/'.$type.'/'.$item->mid)}}"   method="post" enctype="multipart/form-data">
<input type="hidden" name="_method" value="PUT" />

{{csrf_field()}}
 <?php
	 $file_path=str_replace('base_url',url('/'),$item->file);
	 ?>
<table class="table table-striped table-hovered" width="405" height="226" border="0">
 
 
 <tr>
    <td>File Path</td>
    <td>
	<!--<input type="text" value="{{$item->file}}"  class="form-control" />-->
	<input type="text" value="{{$file_path}}"  class="form-control" />
	 </td>
  </tr>
  max-height:300px
  
  <tr>
    <td>Copy Image Tag</td>
    <td>
	<pre>{{'<img src="'.$item->file.'" alt="'.$item->alt_tag.'" title="'.$item->title_tag.'" />'}}</pre>
	 </td>
  </tr>
 
  
  <tr>
    <td>File </td>
    <td>
 	
	
	 <img src="{{url($file_path)}}" style="max-height:300px" />
	<br /><br />
	
	<input   type="file"  name="file" >  Upload new </td>
  </tr>
  
  
  
  
    <tr>
    <td>Alt Tag </td>
    <td>
		<input   type="text" class="form-control"  name="alt_tag"  value="{{$item->alt_tag}}"  >   </td>
  </tr>
  
   <tr>
    <td>Title Tag   </td>
    <td>
		<input   type="text"  class="form-control"  name="title_tag"   value="{{$item->title_tag}}">   </td>
  </tr>
   
  
  
  
   
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></td>
  </tr>
</table>




</form>






@endsection