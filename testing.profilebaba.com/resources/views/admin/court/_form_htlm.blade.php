<div class="col-md-12">					
	<div class="form-group">
		{{ Form::text('courtName',null, ['class' => 'form-control', 'id' => 'courtName', 'placeholder' => 'Education Name']) }}

		@if ($errors->has('courtName'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('courtName') }}</small>
		</label>
		@endif

	</div>
</div>					
<div class="col-lg-12">
	<div class="form-group">
		{{ Form::textarea('courtDesc',null, ['class' => 'form-control', 'id' => 'courtDesc', 'placeholder' => 'Enter Description']) }}

		@if ($errors->has('courtDesc'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('courtDesc') }}</small>
		</label>
		@endif

	</div>			
</div>