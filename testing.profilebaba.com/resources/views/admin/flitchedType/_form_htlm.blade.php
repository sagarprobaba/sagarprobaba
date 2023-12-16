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
