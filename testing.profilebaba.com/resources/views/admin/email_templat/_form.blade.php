<div class="col-md-9">

	<div class="form-group">
		{{ Form::label('email_type', 'Email type') }}

		{{ Form::text('email_type',null, ['class' => 'form-control', 'id' => 'email_type', 'placeholder' => 'Enter Email type']) }}

		@if ($errors->has('email_type'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('email_type') }}</small>
		</label>
		@endif

	</div>

	<div class="form-group">
		{{ Form::label('email_subject', 'Email subject') }}

		{{ Form::text('email_subject',null, ['class' => 'form-control', 'id' => 'email_subject', 'placeholder' => 'Enter Email subject']) }}

		@if ($errors->has('email_subject'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('email_subject') }}</small>
		</label>
		@endif

	</div>

	<div class="form-group">
		{{ Form::label('email_body', 'Email body') }}

		{{ Form::textarea('email_body',null, ['class' => 'form-control', 'id' => 'email_body', 'placeholder' => 'Enter Email body']) }}

		@if ($errors->has('email_body'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('email_body') }}</small>
		</label>
		@endif

	</div>
	
</div>
