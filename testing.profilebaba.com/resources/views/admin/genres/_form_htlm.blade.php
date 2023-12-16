<div class="col-md-6">					
	<div class="form-group">

		{{ Form::select('courttypeid', $courttypes, NULL, ['class' => 'form-control', 'id' => 'courttypeidss']) }}
		@if (isset($errors) && $errors->has('courttypeid'))
		<label id="courttypeid-error" class="error text-danger" for="courttypeid">
			{{ $errors->first('courttypeid') }}
		</label>
		@endif
 
	</div> 
</div>
<div class="col-md-6">					
	<div class="form-group">
		{{ Form::text('gName',null, ['class' => 'form-control', 'id' => 'gName', 'placeholder' => ' Name']) }}

		@if ($errors->has('gName'))
		<label id="gName-error" class="error text-danger" for="gName">
			<small>{{ $errors->first('gName') }}</small>
		</label>
		@endif

	</div>
</div>
 