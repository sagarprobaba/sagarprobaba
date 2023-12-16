@include('auth.register_form')

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="" for="status">Status :</label>
            {{ Form::select('status', StaticArray::status2(), NULL, ['class' => 'form-control', 'id' => 'experience']) }}
            @if ($errors->has('status'))
            <label id="status-error" class="error text-danger" for="status">
                <small>{{ $errors->first('status') }}</small>
            </label>
            @endif

        </div>
    </div>
</div>