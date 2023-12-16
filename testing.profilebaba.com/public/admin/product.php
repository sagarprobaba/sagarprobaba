<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href="<?php echo base_url(); ?>assets/img/favicon.ico" />
    <title>Title</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/960.css" type="text/css" media="screen">
    <link rel="stylesheet" href="assets/css/screen.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" type="text/css" />
    <link href="assets/css/bootstrap-reset.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/nestable/jquery.nestable.css" />
    <!--external css-->
    <link href="assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/owl.carousel.css" type="text/css" rel="stylesheet">
    <!--right slidebar-->
    <link href="assets/css/slidebars.css" rel="stylesheet">	
    <!--Form Wizard-->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.steps.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet" />
	<link href="assets/js/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link href="assets/css/gallery.css" rel="stylesheet" type="text/css" />
	<link href="assets/dropzone/css/dropzone.css" rel="stylesheet"/>
	<link href="assets/css/tasks.css" rel="stylesheet">
	<script src="assets/js/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
	<link href="assets/css/jquery.fileuploader.css" media="all" rel="stylesheet">
	<link href="assets/css/jquery.fileuploader-theme-thumbnails.css" media="all" rel="stylesheet">	
	<script src="assets/js/jquery.fileuploader.min.js" type="text/javascript"></script>		

</head>
<body>

    <section id="container">
        <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
			<a href="#" class="logo">Squirehood</a>
            <!--logo end-->
			<div class="nav notify-row" id="top_menu">
                <!-- notification start -->
                <ul class="nav top-menu">
                    <li class="dropdown tooltips" data-placement="bottom" data-toggle="tooltip" data-original-title="Total Comments">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <i class="fa fa-comments-o"></i>
                            <span class="badge bg-success">54</span>

                        </a>

                    </li>

                    <li id="header_inbox_bar" class="dropdown tooltips" data-placement="bottom" data-toggle="tooltip" data-original-title="Total Contacts">

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">

                            <i class="fa fa-envelope-o"></i>

                            <span class="badge bg-important">45</span>

                        </a>

                    </li>

                </ul>
                <!-- notification end -->
            </div>

        </header>
		<!--Side Bar -->
		<aside>
			<div id="sidebar"  class="nav-collapse">		
			<!--- End Side Bar -->
			<?php include('siderbar.php'); ?>
			</div>
		</aside>

<section class="wrapper">

	<section class="top-bredcumb">

		<div class="row">
			<div class="col-lg-2">
				<h4>Add Product</h4>
			</div>

			<div class="col-lg-7">				
				<ul class="breadcrumb">
				  <li><a href="#">Dashboard</a></li>
				  <li><a href="#">Product Manager</a></li>
				  <li>Add Product</li>
				</ul>
			</div>

			<div class="col-lg-3 text-right">
				<button type="button" class="btn btn-round btn-success save-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
				<button type="button" class="btn btn-round btn-warning reset-btn"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
				<button type="button" class="btn btn-round btn-danger back-btn"><i class="fa fa-undo" aria-hidden="true"></i> Back</button>
			</div>
		</div>

	</section>
	<div class="row">
			<form class="productform" action="" method="post">
			<div class="col-lg-9">
				<section class="panel">
					<header class="panel-heading">Product Details</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="sr-only" for="prod_name">Product Name:</label>
							<input type="text" name="prod_name" id="prod_name" class="form-control" placeholder="Product Name">
						</div>
						<div class="form-group">
							<label class="sr-only" for="prod_short_desc">Short Description:</label>
							<textarea name="prod_short_desc" id="prod_short_desc" class="form-control" placeholder="Short Description"></textarea>
						</div>
						<div class="form-group">
							<label class="sr-only" for="meta_title">Meta Title:</label>
							<input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Meta Title">
						</div>

						<div class="form-group">
							<label class="sr-only" for="meta_keyword">Meta Keyword:</label>
							<input type="text" name="meta_keyword" id="meta_keyword" class="form-control" placeholder="Meta Keyword">
						</div>

						<div class="form-group">
							<label class="sr-only" for="meta_desc">Meta Description:</label>
							<textarea name="meta_desc" id="meta_desc" class="form-control" placeholder="Meta Description"></textarea>

						</div>
					</div>
				</section>
			</div>

			<div class="col-lg-3 removePaddingLeft">
				<section class="panel">

					<header class="panel-heading">Additional Info</header>

					<div class="panel-body">

						<div class="form-group">
							<label for="cat">Select Category:</label>
							<div id="multiselect">								
								<select id="cat" name="cat" class="multiselect-ui form-control" multiple="multiple">						
									<option value="1">Men</option>
									<option value="2">Owmen</option>											
									<option value="3">Kids</option>											
									<option value="4">Sports</option>												
								</select>				
							</div>							
						</div>
						<div class="form-group">
							<label for="color">Select Colors:</label>
							<div id="multiselect">								
								<select id="color" name="color" class="multiselect-ui form-control" multiple="multiple">						
									<option value="1">Red</option>
									<option value="2">Yellow</option>											
									<option value="3">Purple</option>											
									<option value="4">Violet</option>												
								</select>				
							</div>							
						</div>
						<div class="form-group">
							<label for="size">Select Size:</label>
							<div id="multiselect">								
								<select id="color" name="size" class="multiselect-ui form-control" multiple="multiple">						
									<option value="1">S</option>
									<option value="2">M</option>											
									<option value="3">XL</option>											
									<option value="4">XXL</option>												
								</select>				
							</div>							
						</div>						
						<div class="form-group">
							<label class="sr-only" for="prod_offer">Offers:</label>
							<select name="prod_offer" id="prod_offer" class="form-control" placeholder="Offers">
								<option value="">Select Offers</option>
								<option value="1">Flat 100 Rs Off</option>
								<option value="2">Flat 200 Rs Off</option>
								<option value="3">Flat 20% Rs Off</option>
								<option value="4">Flat 50% Rs Off</option>
							</select>

						</div>

						<div class="form-group">
							<label class="sr-only" for="prod_price">Regular Price:</label>
							<input type="text" name="prod_price" id="prod_price" class="form-control" placeholder="Regular Price">
						</div>
						<div class="form-group">
							<label class="sr-only" for="prod_price">Sale Price:</label>
							<input type="text" name="sale_price" id="sale_price" class="form-control" placeholder="Sale Price">
						</div>						

						<div class="form-group last">
							<label class="sr-only" for="files">Images:</label>
							<div class="upld-image">
								<input type="file" name="files" multiple>
							</div>
						</div>
					</div>
				</section>
			</div>

		</form>
	</div>
</section>
<footer class="site-footer">
	<div class="text-center clearfix">
		<div class="col-lg-6 text-left">
			&copy;  | Powered by: <a href="#" target="_blank" style="color:#fff">Smanik</a>
		</div>
		<div class="col-lg-6 text-right">
			Admin System | 
			<a href="#" class="go-top text-center">
				<i class="fa fa-angle-up"></i>
			</a>
		</div>
    </div>
</footer>
<!--footer end-->
</section>
<div class="overlay">
	<img class="img-responsive center-block" src="<?php echo base_url(); ?>assets/img/loader.gif">
</div>
<link href="assets/css/tasks.css" rel="stylesheet">
<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript" ></script>
<script src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript" ></script>
<script src="assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript" ></script>
<script src="assets/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript" ></script>
<script src="assets/js/advanced-form-components.js" type="text/javascript" ></script>
<script src="assets/js/modernizr.custom.js"></script>
<script src="assets/js/toucheffects.js"></script>
<script src="assets/dropzone/dropzone.js"></script>
<script src="assets/js/jquery.steps.min.js"></script>
<script src="assets/js/multiselect.js"></script>
<script src="assets/js/respond.min.js" ></script>
<!--right slidebar-->
<script src="assets/js/slidebars.min.js"></script>
<!--common script for all pages-->
<script src="<?php echo base_url(); ?>assets/js/common-scripts.js"></script>
<script src="assets/jquery.fileuploader.min.js"></script>
<script src="assets/bootstrap-fileupload/bootstrap-fileupload.js" type="text/javascript"></script>
<script src="assets/js/jquery.stepy.js"></script>
<script src="assets/js/bootstrap-validator.min.js" type="text/javascript"></script>
<script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var windowURL = window.location.href;
    pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
    var x = $('a[href="'+pageURL+'"]');
		x.addClass('active');
        x.parent().addClass('active');
		x.parent().parent().prev('a').addClass('active');
    var y = $('a[href="'+windowURL+'"]');
		y.addClass('active');
        y.parent().addClass('active');
		y.parent().parent().prev('a').addClass('active');
</script>
<script>
//step wizard
	$(function() {
		$('#default').stepy({
			backLabel: 'Previous',
			block: true,
			nextLabel: 'Next',
			titleClick: true,
			titleTarget: '.stepy-tab'
		});
	});
</script>
<script>

	$(document).ready(function() {

		// enable fileuploader plugin

		$('input[name="files"]').fileuploader({

			extensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],

			changeInput: ' ',

			theme: 'thumbnails',

			enableApi: true,

			addMore: true,

			thumbnails: {

				box: '<div class="fileuploader-items">' +

						  '<ul class="fileuploader-items-list">' +

							  '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner">Browse</div></li>' +

						  '</ul>' +

					  '</div>',

				item: '<li class="fileuploader-item">' +

						   '<div class="fileuploader-item-inner">' +

							   '<div class="thumbnail-holder">${image}</div>' +

							   '<div class="actions-holder">' +

								   '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +

							   '</div>' +

							   '<div class="progress-holder">${progressBar}</div>' +

						   '</div>' +

					   '</li>',

				item2: '<li class="fileuploader-item">' +

						   '<div class="fileuploader-item-inner">' +

							   '<div class="thumbnail-holder">${image}</div>' +

							   '<div class="actions-holder">' +

								   '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +

							   '</div>' +

						   '</div>' +

					   '</li>',

				startImageRenderer: true,

				canvasImage: false,

				_selectors: {

					list: '.fileuploader-items-list',

					item: '.fileuploader-item',

					start: '.fileuploader-action-start',

					retry: '.fileuploader-action-retry',

					remove: '.fileuploader-action-remove'

				},

				onItemShow: function(item, listEl) {

					var plusInput = listEl.find('.fileuploader-thumbnails-input');					

					plusInput.insertAfter(item.html);					

					if(item.format == 'image') {

						item.html.find('.fileuploader-item-icon').hide();

					}

				}

			},

			afterRender: function(listEl, parentEl, newInputEl, inputEl) {

				var plusInput = listEl.find('.fileuploader-thumbnails-input'),

					api = $.fileuploader.getInstance(inputEl.get(0));			

				plusInput.on('click', function() {

					api.open();

				});

			},

		});

	});

</script>

</body>
</html>