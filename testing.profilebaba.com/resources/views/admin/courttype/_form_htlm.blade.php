<div class="form-group">
	{{ Form::label('title', 'Religion') }}

	{{ Form::text('title',null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Name']) }}

	@if ($errors->has('title'))
	<label id="title-error" class="error text-danger" for="title">
		<small>{{ $errors->first('title') }}</small>
	</label>
	@endif

</div> 

<div class="form-group">
	<label for="state_name">Photo</label>
	{{ Form::file('image') }}

	@if ($errors->has('image'))
	<label id="image-error" class="error text-danger" for="image">
		<small>{{ $errors->first('image') }}</small>
	</label>
	@endif
</div>

@if (isset($item->image))
<div class="fileupload-new thumbnail" style="width: 200px;">
	<img width="200" src="{{asset(media_FILE.$item->image)}}" alt="" />
</div>
@endif
