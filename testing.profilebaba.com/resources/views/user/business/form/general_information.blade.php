        <h4 class="bsheading">Business Detail</h4>
        <input value="{{$data->id??''}}" name="id" type="hidden" class="form-control">
        <div class="form-group">
        <label>Business Name:</label>
        <input value="{{$data->business_name??''}}" name="business_name" type="text" class="form-control">
        </div>

        <div class="form-group">
            <label>Logo:</label>
            <input type="file" name="file" class="form-control">
            @if (isset($data) && !empty($data->logo))
            <a href="{{ CustomValue::filecheck($data->logo,'/uploads/users/')}}" target="_blank">view logo</a>        
            @endif
        </div>

        <div class="form-group">
            <label>Category:</label>
            <div>
                @php
                    $cid = 0;
                    if (isset($data)) {
                        $cid = isset($data->category) ? $data->category->pluck('id')->first() : 0;
                    }
                    $category = \App\Category::where('parent_id', 0)->orderby('title','ASC')->get();
                @endphp
                <select name="category[]" id="all_category_prant" class="form-control">
                    <option value="">Select Category</option>
                    
                    @foreach ($category as $value)
                    <option value="{{ $value->id }}" {{$cid == $value->id ? 'selected' : ''}}>{{ $value->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Sub Category:</label>
            <div>
                @php 
                    $cid = 0;
                    if (isset($data)) {
                        $cid = isset($data->category) ? $data->category->pluck('id') : 0;
                    }
                @endphp
                <select name="category[]" id="all_category_child" multiple class="form-control" selected_id="@json($cid)">

                </select>
            </div>
        </div>

        <div class="form-group">
            <label>About Me:</label>
            <textarea class="form-control" name="about_me" rows="5" placeholder="Describe your self" style="height: auto;">{{$data->about_me??''}}</textarea>
        </div>


<div class="form-group sbtn5">
    <button type="submit" class="btn btn-shape-round form__submit">SAVE & CONTINUE</button>
</div>
