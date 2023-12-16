<div class="Timeblock">
<input value="{{$vendor ?? ''}}" name="vendor_id" type="hidden" class="form-control">
    <div class="hours_opr">
      
            <h4 class="bsheading mr0">Hours of Operation</h4>
      
        <p>
            {{ Form::radio('display_time', 'display', null, ["class" => 'cmn']) }} Display hours of operation
            {{ Form::radio('display_time', 'dont display', null, ["class" => 'cmn']) }} Do not display hours of operation
        </p>
        <div class="week">
            
            <div class="form-group">
                <span>Monday :</span>
                {{ Form::select('Monday_form', StaticArray::hour(), $data->Monday_form ?? '10:00 AM') }}
                <span class="to">To</span>
                {{ Form::select('Monday_to', StaticArray::hour(), $data->Monday_to ?? '08:00 PM') }}
                <span class="clos">{{ Form::checkbox('Monday_closed', 'closed', null) }} Closed</span>
            </div>
            
            <div class="form-group">
                <span>Tuesday :</span>
                {{ Form::select('Tuesday_form', StaticArray::hour(), $data->Tuesday_form ?? '10:00 AM') }}
                <span class="to">To</span>
                {{ Form::select('Tuesday_to', StaticArray::hour(), $data->Tuesday_to ?? '08:00 PM') }}
                <span class="clos">{{ Form::checkbox('Tuesday_closed', 'closed', null) }} Closed</span>
            </div>
            
            <div class="form-group">
                <span>Wednesday :</span>
                {{ Form::select('Wednesday_form', StaticArray::hour(), $data->Wednesday_form ?? '10:00 AM') }}
                <span class="to">To</span>
                {{ Form::select('Wednesday_to', StaticArray::hour(), $data->Wednesday_to ?? '08:00 PM') }}
                <span class="clos">{{ Form::checkbox('Wednesday_closed', 'closed', null) }} Closed</span>
            </div>
            
            <div class="form-group">
                <span>Thursday :</span>
                {{ Form::select('Thursday_form', StaticArray::hour(), $data->Thursday_form ?? '10:00 AM') }}
                <span class="to">To</span>
                {{ Form::select('Thursday_to', StaticArray::hour(), $data->Thursday_to ?? '08:00 PM') }}
                <span class="clos">{{ Form::checkbox('Thursday_closed', 'closed', null) }} Closed</span>
            </div>
            
            <div class="form-group">
                <span>Friday :</span>
                {{ Form::select('Friday_form', StaticArray::hour(), $data->Friday_form ?? '10:00 AM') }}
                <span class="to">To</span>
                {{ Form::select('Friday_to', StaticArray::hour(), $data->Friday_to ?? '08:00 PM') }}
                <span class="clos">{{ Form::checkbox('Friday_closed', 'closed', null) }} Closed</span>
            </div>
            
            <div class="form-group">
                <span>Saturday :</span>
                {{ Form::select('Saturday_form', StaticArray::hour(), $data->Saturday_form ?? '10:00 AM') }}
                <span class="to">To</span>
                {{ Form::select('Saturday_to', StaticArray::hour(), $data->Saturday_to ?? '08:00 PM') }}
                <span class="clos">{{ Form::checkbox('Saturday_closed', 'closed', null) }} Closed</span>
            </div>
            
            <div class="form-group">
                <span>Sunday :</span>
                {{ Form::select('Sunday_form', StaticArray::hour(), $data->Sunday_form ?? '10:00 AM') }}
                <span class="to">To</span>
                {{ Form::select('Sunday_to', StaticArray::hour(), $data->Sunday_to ?? '08:00 PM') }}
                <span class="clos">{{ Form::checkbox('Sunday_closed', 'closed', $data->Sunday_closed ?? true) }} Closed</span>
            </div>

        </div>
    </div>
    <div class="payment_mode">
        <h4 class="bsheading mr0">Payment Modes Accepted By You</h4>
        <ul class="clearfix">
            @foreach (StaticArray::payment_modes() as $payment_mode)
            <li>
                {{ Form::checkbox('payment_mode[]', $payment_mode, null, ["class" => 'cmn']) }}
                <span>{{ $payment_mode }}</span>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="profile-data2 clearfix" >
        <div class="form-group sbtn5" style="float: left;text-align: center;">
            <button type="submit" class="btn btn-shape-round form__submit">SAVE & CONTINUE</button>
        </div>
    </div>
</div>
