@extends('layout.master')


@section('page_title','404 Not Found')

@section('head')
<style type="text/css">
	.error-template {padding: 40px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
</style>

@endsection


@section('container')

 <section class="inter-bnr">
 	<div class="inter-bnr-img">
 	    <br>
 		<div class="inter-absolute">
 			<div class="container">
 				<div class="row">
 					<div class="col-md-12">
 						<div class="inter-baner-link">
 							<ul class="breadcrumb">
 								<li><a href="{{ route("home") }}">Home</a></li>
 								<li>404 Not Found</li>
 							</ul>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    Sorry, an error has occured, Requested page not found!
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection




