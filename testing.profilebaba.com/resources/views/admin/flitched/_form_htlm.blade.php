<div class="col-md-6">					
	<div class="form-group">
		{{ Form::text('title',null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter title']) }}

		@if ($errors->has('title'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('title') }}</small>
		</label>
		@endif

	</div>
</div>

<div class="col-md-6">					
	<div class="form-group">
		{{ Form::text('slug',null, ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'Enter slug']) }}

		@if ($errors->has('slug'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('slug') }}</small>
		</label>
		@endif

	</div>
</div>

<div class="col-md-6">					
	<div class="form-group">
		{{-- <label for="state_name">Photo :</label> --}}
		{{ Form::file('image') }}

		@if ($errors->has('image'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('image') }}</small>
		</label>
		@endif

		@if (isset($flitched))
			@if($flitched->image!='')
			<img class="media-object img-responsive" style="width: 200px;" src="{{url('uploads/category/'.$flitched->image)}}">
			@endif
		@endif

	</div>
</div>

<div class="col-md-6">					
	<div class="form-group">
		{{-- <label for="state_name">Photo :</label> --}}
		 {{ Form::select('flitchedType_id', $courttypes, NULL, ['class' => 'form-control flitchedType_id', 'id' => 'flitchedType_id']) }}

		@if ($errors->has('flitchedType_id'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('flitchedType_id') }}</small>
		</label>
		@endif

	</div>
</div>

<div class="col-md-12">
	<div class="form-group">
		{{ Form::textarea('body',null, ['class' => 'form-control ckeditor', 'id' => 'body', 'placeholder' => 'body']) }}
		@if ($errors->has('body'))
		<label id="body-error" class="error text-danger" for="body">
			<small>{{ $errors->first('body') }}</small>
		</label>
		@endif
	</div>
	
</div>				