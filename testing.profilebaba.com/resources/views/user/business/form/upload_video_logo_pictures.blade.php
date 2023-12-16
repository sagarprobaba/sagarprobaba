<div class="form-group">
<input value="{{$vendor ?? ''}}" name="vendor_id" type="hidden" class="form-control">
    <input type="file" name="file" class="form-control">
    @if (isset($data) && !empty($data->file))
    <a href="{{ CustomValue::filecheck($data->file,'/uploads/users/')}}" target="_blank">view file</a>        
    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-shape-round form__submit">SAVE &
        View</button>
</div>