<div class="col-md-9">

	<div class="form-group">
		{{ Form::label('title', 'Title') }}

		{{ Form::text('title',null, ['class' => 'form-control', 'id' => 'Title', 'placeholder' => 'Enter Title']) }}

		@if ($errors->has('title'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('title') }}</small>
		</label>
		@endif

	</div>

	<div class="form-group">
		{{ Form::label('body', 'body') }}

		{{ Form::textarea('body',null, ['class' => 'form-control', 'id' => 'body', 'placeholder' => 'Enter body']) }}

		@if ($errors->has('body'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('body') }}</small>
		</label>
		@endif

	</div>
	
</div>
