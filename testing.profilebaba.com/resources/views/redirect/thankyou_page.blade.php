@extends('layout.master')
@section('page_title','Lila')
@section('page_heading','Lila')

@section('head')

@endsection

@section('container')
<section class="blog-list" style="background: #f7f7f7; text-align: center;height: 400px;display: flex;align-items: center;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="service-text">
					<h2>{{ $massage }}</h2>
					<p>
						{{ $content }}
					</p>
					<a href="{{ $url }}" class="btn btn-primary">{{ $button }}</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection