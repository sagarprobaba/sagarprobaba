@extends('layout.master')
@section('head')
@endsection
@section('container')

<section class="cliat-sec">
	<div class="container">
		<div class="row">

            @foreach ($categories as $category)
            <div class="col-md-3">
				<div class="clist2">
					<h4><a href="{{ route('vendor_filter_type', $category->slug) }}">{{ $category->title }}</a></h4>
					<ul>
                        @foreach ($category->child()->take(10)->get() as $category_sab)
						<li><a href="{{ route('vendor_filter_type', $category_sab->slug) }}">{{ $category_sab->title }}</a></li>
                        @endforeach
					</ul>
					<a class="redmore" href="{{ route('vendor_filter_type', $category->slug) }}">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div>
			</div>
			<?php $iter = $loop->iteration; ?> 
    		@if($iter == 4 || $iter == 8 || $iter == 12 || $iter == 16 || $iter == 20 || $iter == 24 || $iter == 28 || $iter == 32 || $iter == 36 || $iter == 40 || $iter == 44 || $iter == 48 || $iter == 52 || $iter == 56 || $iter == 60)
    		</div>
    		<div class="row">
    		@endif
			
            @endforeach
	
		</div>
	</div>
</section>

@endsection