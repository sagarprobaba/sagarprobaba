<div class="col-md-6">					
	<div class="form-group">
		{{ Form::text('odName',null, ['class' => 'form-control', 'id' => 'odName', 'placeholder' => 'Designation']) }}

		@if ($errors->has('odName'))
		<label id="odName-error" class="error text-danger" for="odName">
			<small>{{ $errors->first('odName') }}</small>
		</label>
		@endif

	</div>
</div>
