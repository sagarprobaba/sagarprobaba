@if(count($category_data)>0)
@foreach($category_data as $category)

@php
    $contact_information = $category->contact_information;
    $other_inormation = $category->other_inormation;
    $vendor_images = $category->vendor_images;
@endphp

@php
    $reviewg = 0;
   
@endphp

<div class="col-md-4 col-sm-12 col-xs-12">
    <div class="product-box">
        <div class="blog-imgblock">
            <a href="{{ route('vendor.details',$category->slug) }}" class="">
                <img class="img-responsive" src="{{ CustomValue::filecheck($category->logo ?? '','/uploads/users/')}}">
            </a>
        </div>
        <div class="profile_content_pad">
            <h5><div class="category_title category_title_ww">{{$category->business_name ?? $category->name}}</div></h5>
            <div class="rating">
                @for($i=1;$i<=5;$i++)
                <span class="fa fa-star {{ $i<=$reviewg ? 'checked' : '' }}"></span>
                @endfor
            </div>
            <p style="margin: 0;" class="category_title">Location: {{ $contact_information->area ?? '' }}</p>
            <p>Pin Code: {{ $contact_information->pincode ?? '' }}</p>
            <a href="{{ route('vendor.details',$category->slug) }}" class="profile-btn">View Profile</a>
        </div>
    </div>
</div>

@endforeach
@else
<h4>Sorry no record found for this selections !</h4>
@endif
