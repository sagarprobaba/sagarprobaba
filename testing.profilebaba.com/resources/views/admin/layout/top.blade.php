<section class="top-bredcumb">

	<div class="row">

		<div class="col-lg-2">

			<h4>@yield('page_heading')</h4>

		</div>

		<div class="col-lg-7">				

			<ul class="breadcrumb">

				<li><a href="#">Dashboard</a></li>

				<li>@yield('page_heading')</li>

			</ul>

		</div>

		<div class="col-lg-3 text-right">

			<a href="@yield('add_link')" class="btn btn-round btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>

			<button type="button" class="btn btn-round btn-warning filterBtn"><i class="fa fa-refresh" aria-hidden="true"></i> Filter</button>

		</div>

	</div>

</section>