<div class="col-md-9">

	<div class="form-group">
		{{ Form::label('question', 'Question') }}

		{{ Form::text('question',null, ['class' => 'form-control', 'id' => 'question', 'placeholder' => 'Enter question']) }}

		@if ($errors->has('question'))
		<label id="question-error" class="error text-danger" for="question">
			<small>{{ $errors->first('question') }}</small>
		</label>
		@endif

	</div>

	<div class="form-group">
		{{ Form::label('answer', 'Answer') }}

		{{ Form::textarea('answer',null, ['class' => 'form-control', 'id' => 'answer', 'placeholder' => 'Enter answer']) }}

		@if ($errors->has('answer'))
		<label id="name-error" class="error text-danger" for="name">
			<small>{{ $errors->first('answer') }}</small>
		</label>
		@endif

	</div>
</div>
