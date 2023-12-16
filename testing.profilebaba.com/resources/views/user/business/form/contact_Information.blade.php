<h4 class="bsheading">Contact Details</h4>
<input value="{{$vendor??''}}" name="vendor_id" type="hidden" class="form-control">
<input value="{{$data->id??''}}" name="id" type="hidden" class="form-control">
<div class="form-group ph">
    <label>Landline No:</label>
    <span>+91-</span>
    <input value="{{ old('landline_number',  $data->landline_number ?? "") }}" name="landline_number" type="text" class="form-control">
</div>
<div class="form-group ph">
    <label>Mobile No:</label>
    <span>+91-</span>
    <input value="{{ old('mobile_number',  $data->mobile_number ?? "") }}" name="mobile_number" type="text" class="form-control">
</div>
<div class="form-group ph">
    <label>Alternate No:</label>
    <span>+91-</span>
    <input value="{{ old('alternate_number',  $data->alternate_number ?? "") }}" name="alternate_number" type="text" class="form-control">
</div>
<div class="form-group ph">
    <label>Whatsapp No.:</label>
    <span>+91-</span>
    <input value="{{ old('whatsapp_number',  $data->whatsapp_number ?? "") }}" name="whatsapp_number" type="text" class="form-control">
</div>
<div class="form-group">
    <label>Email:</label>
    <input value="{{ old('email',  $data->email ?? "") }}" name="email" type="email" class="form-control">
</div>
<div class="form-group">
    <label>Website:</label>
    <input value="{{ old('website',  $data->website ?? "") }}" name="website" type="text" class="form-control">
</div>



<div class="form-group" style="display: block;width: 100%;padding: 0;margin: 0;">
    <h4 class="bsheading">Location Details</h4>
</div>
<div class="form-group">
    <label>Country:</label>
    <select name="country" id="country" class="form-control select_country">
        <?php
        $country = \App\Country::get();
        ?>
        @foreach ($country as $item)
            <option value="{{ $item->id }}" {{@$data->country == $item->id ? 'selected' : ''}}>{{ $item->title }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>State:</label>
    <select name="state" select_val="{{ old('state',  $data->state ?? 10) }}" id="state" class="form-control select_state">
        <option value="">Select State</option>
        <?php
        $state = \App\State::where('country_id',1)->get();
        ?>
        @foreach ($state as $item)
            <option value="{{ $item->id }}" {{@$data->state == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>City:</label>
    <select name="city" select_val="{{@ old('city',  $data->city ?? "") }}" id="district" class="form-control select_city">
        <option value="">Select City</option>
    </select>
</div>
<div class="form-group">
    <label>Area:</label>
    <input value="{{ old('area',  $data->area ?? "") }}" name="area" type="text" class="form-control">
</div>
<div class="form-group">
    <label>Landmark:</label>
    <input value="{{ old('landmark',  $data->landmark ?? "") }}" name="landmark" type="text" class="form-control">
</div>
<div class="form-group">
    <label>Pincode:</label>
    <input value="{{ old('pincode',  $data->pincode ?? "") }}" name="pincode" type="text" class="form-control">
</div>
<div class="form-group">
    <label>Google Location Url:</label>
    <textarea class="form-control" name="google_location" rows="5" placeholder="https://www.google.com/maps/place/Delhi/@28.6471948,76.9531794,11z/data=!3m1!4b1!4m5!3m4!1s0x390cfd5b347eb62d:0x37205b715389640!8m2!3d28.7040592!4d77.1024902" style="height: auto;">{{ old('google_location',  $data->google_location ?? "") }}</textarea>
</div>
<div class="form-group">
    <label>Address:</label>
    <textarea class="form-control" name="address" rows="5" placeholder="Address" style="height: auto;">{{ old('address',  $data->address ?? "") }}</textarea>
</div>


<div class="form-group" style="display: block;width: 100%;padding: 0;margin: 0;">
    <h4 class="bsheading">Social Media Details</h4>
</div>

<div class="form-group">
    <label>Facebook:</label>
    <input value="{{ old('facebook',  $data->facebook ?? "") }}" name="facebook" type="text" class="form-control">
</div>
<div class="form-group">
    <label>Twitter:</label>
    <input value="{{ old('twitter',  $data->twitter ?? "") }}" name="twitter" type="text" class="form-control">
</div>
<div class="form-group">
    <label>Instagram:</label>
    <input value="{{ old('instagram',  $data->instagram ?? "") }}" name="instagram" type="text" class="form-control">
</div>
<div class="form-group">
    <label>Youtube:</label>
    <input value="{{ old('youtube',  $data->youtube ?? "") }}" name="youtube" type="text" class="form-control">
</div>
<div class="form-group" style="display: none;">
    <label>Others:</label>
    <input value="{{ old('others',  $data->others ?? "") }}" name="others" type="text" class="form-control">
</div>

<div class="form-group sbtn5" style="float: left;text-align: center;">
    <button type="submit" class="btn btn-shape-round form__submit">SAVE & CONTINUE</button>
</div>
