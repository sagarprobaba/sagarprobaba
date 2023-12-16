@extends('admin.layout.master')
@section('contentright')
<section id="main-content">
<section class="wrapper">

	<section class="top-bredcumb">

		<div class="row">

			<div class="col-lg-3">

				<h4>Categories Manager</h4>

			</div>

			<div class="col-lg-6">				

				<ul class="breadcrumb">

				  <li><a href="#">Dashboard</a></li>

				  <li>Categories Manager</li>

				</ul>

			</div>

			<div class="col-lg-3 text-right">

				<a href="createuser.php" class="btn btn-round btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>

				<button type="button" class="btn btn-round btn-warning filterBtn"><i class="fa fa-refresh" aria-hidden="true"></i> Filter</button>

			</div>

		</div>

	</section>

	
	
    <section class="panel">

        <div class="panel-body">

			<div class="row filterDiv">

				<div class="col-lg-7">

					<p class="text-muted">

						Here you can manage the admin or  for regular maintenance of the application. Administrator can add, update and delete the Car categories Page.

					</p>

				</div>

				<div class="col-lg-5">

					<form class="form-inline pull-right" role="form" name="frm_search" id="frm_search" action="#" method="GET">

						<div class="form-group">

							<label class="sr-only" for="inlinesearch">Search:</label>

							<input value="" type="text" class="form-control" name="keyword" id="inlinesearch" placeholder="Enter search text here">

						</div>

						<button type="submit" class="btn btn-success">Search</button>

					</form>

				</div>

			</div>

            <div class="adv-table">

                <table class="table table-striped table-hover table-bordered" id="editable-sample">

                    <thead>

                        <tr>

                            <th class="text-center">No.</th>

                            <th class="text-center">Name</th>

							<th class="text-center">Parent</th>

							<th class="text-center">Status</th>

							<th class="text-center">Created on</th>

                            <th class="text-center" style="width:210px">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        
                            
                            
                                <tr>

                                    <td class="text-center">1</td>

									<td>More Details</td>

									<td>T-Shirts</td>

									<td class="text-center">

										<span class="label label-info label-mini">Active</span>
									</td>

									<td class="text-center">2018-01-25 15:31:12</td>

                                    <td class="text-center">

										<a class="btn btn-primary btn-xs" href="#"><i class="fa fa-pencil"> Edit </i></a>

										<a class="btn btn-danger btn-xs deleteRow" href="javascript:void(0);" data-id="14" data-url="#" data-posttitle="More Details" data-title="delete" title="delete"><i class="fa fa-trash-o"> Delete </i></a>

										<a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="14" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="More Details" title="Active">

                                              Active
										</a>

                                    </td>

                                </tr>

                            
                                <tr>

                                    <td class="text-center">2</td>

									<td>Girls Clothing</td>

									<td>Kids</td>

									<td class="text-center">

										<span class="label label-info label-mini">Active</span>
									</td>

									<td class="text-center">2018-01-25 12:57:56</td>

                                    <td class="text-center">

										<a class="btn btn-primary btn-xs" href="#"><i class="fa fa-pencil"> Edit </i></a>

										<a class="btn btn-danger btn-xs deleteRow" href="javascript:void(0);" data-id="13" data-url="#" data-posttitle="Girls Clothing" data-title="delete" title="delete"><i class="fa fa-trash-o"> Delete </i></a>

										<a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="13" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="Girls Clothing" title="Active">

                                              Active
										</a>

                                    </td>

                                </tr>

                            
                                <tr>

                                    <td class="text-center">3</td>

									<td>GROOMING</td>

									<td>Women</td>

									<td class="text-center">

										<span class="label label-info label-mini">Active</span>
									</td>

									<td class="text-center">2018-01-22 16:01:07</td>

                                    <td class="text-center">

										<a class="btn btn-primary btn-xs" href="#"><i class="fa fa-pencil"> Edit </i></a>

										<a class="btn btn-danger btn-xs deleteRow" href="javascript:void(0);" data-id="12" data-url="#" data-posttitle="GROOMING" data-title="delete" title="delete"><i class="fa fa-trash-o"> Delete </i></a>

										<a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="12" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="GROOMING" title="Active">

                                              Active
										</a>

                                    </td>

                                </tr>

                            
                                <tr>

                                    <td class="text-center">4</td>

									<td>Jewellery</td>

									<td>Women</td>

									<td class="text-center">

										<span class="label label-info label-mini">Active</span>
									</td>

									<td class="text-center">2018-01-22 16:00:21</td>

                                    <td class="text-center">

										<a class="btn btn-primary btn-xs" href="#"><i class="fa fa-pencil"> Edit </i></a>

										<a class="btn btn-danger btn-xs deleteRow" href="javascript:void(0);" data-id="11" data-url="#" data-posttitle="Jewellery" data-title="delete" title="delete"><i class="fa fa-trash-o"> Delete </i></a>

										<a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="11" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="Jewellery" title="Active">

                                              Active
										</a>

                                    </td>

                                </tr>

                            
                                <tr>

                                    <td class="text-center">5</td>

									<td>Women</td>

									<td></td>

									<td class="text-center">

										<span class="label label-info label-mini">Active</span>
									</td>

									<td class="text-center">2018-01-22 15:58:46</td>

                                    <td class="text-center">

										<a class="btn btn-primary btn-xs" href="#"><i class="fa fa-pencil"> Edit </i></a>

										<a class="btn btn-danger btn-xs deleteRow" href="javascript:void(0);" data-id="10" data-url="#" data-posttitle="Women" data-title="delete" title="delete"><i class="fa fa-trash-o"> Delete </i></a>

										<a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="10" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="Women" title="Active">

                                              Active
										</a>

                                    </td>

                                </tr>

                            
                                <tr>

                                    <td class="text-center">6</td>

									<td>Bags</td>

									<td>Men</td>

									<td class="text-center">

										<span class="label label-info label-mini">Active</span>
									</td>

									<td class="text-center">2018-01-22 15:53:05</td>

                                    <td class="text-center">

										<a class="btn btn-primary btn-xs" href=""><i class="fa fa-pencil"> Edit </i></a>

										<a class="btn btn-danger btn-xs deleteRow" href="javascript:void(0);" data-id="9" data-url="#" data-posttitle="Bags" data-title="delete" title="delete"><i class="fa fa-trash-o"> Delete </i></a>

										<a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="9" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="Bags" title="Active">

                                              Active
										</a>

                                    </td>

                                </tr>

                            
                                <tr>

                                    <td class="text-center">7</td>

									<td>Shoes</td>

									<td>Men</td>

									<td class="text-center">

										<span class="label label-info label-mini">Active</span>
									</td>

									<td class="text-center">2018-01-22 15:51:43</td>

                                    <td class="text-center">

										<a class="btn btn-primary btn-xs" href="#"><i class="fa fa-pencil"> Edit </i></a>

										<a class="btn btn-danger btn-xs deleteRow" href="javascript:void(0);" data-id="8" data-url="#" data-posttitle="Shoes" data-title="delete" title="delete"><i class="fa fa-trash-o"> Delete </i></a>

										<a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="8" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="Shoes" title="Active">

                                              Active
										</a>

                                    </td>

                                </tr>

                            
                                <tr>

                                    <td class="text-center">8</td>

									<td>Watches</td>

									<td>Men</td>

									<td class="text-center">

										<span class="label label-info label-mini">Active</span>
									</td>

									<td class="text-center">2018-01-22 15:50:49</td>

                                    <td class="text-center">

										<a class="btn btn-primary btn-xs" href="#"><i class="fa fa-pencil"> Edit </i></a>

										<a class="btn btn-danger btn-xs deleteRow" href="javascript:void(0);" data-id="7" data-url="#" data-posttitle="Watches" data-title="delete" title="delete"><i class="fa fa-trash-o"> Delete </i></a>

										<a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="7" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="Watches" title="Active">

                                              Active
										</a>

                                    </td>

                                </tr>

                            
                                <tr>

                                    <td class="text-center">9</td>

									<td>Clothing</td>

									<td>Men</td>

									<td class="text-center">

										<span class="label label-info label-mini">Active</span>
									</td>

									<td class="text-center">2018-01-22 15:49:20</td>

                                    <td class="text-center">

										<a class="btn btn-primary btn-xs" href="#"><i class="fa fa-pencil"> Edit </i></a>

										<a class="btn btn-danger btn-xs deleteRow" href="javascript:void(0);" data-id="6" data-url="#" data-posttitle="Clothing" data-title="delete" title="delete"><i class="fa fa-trash-o"> Delete </i></a>

										<a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="6" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="Clothing" title="Active">

                                              Active
										</a>

                                    </td>

                                </tr>

                            
                                <tr>

                                    <td class="text-center">10</td>

									<td>New Arrivels</td>

									<td></td>

									<td class="text-center">

										<span class="label label-info label-mini">Active</span>
									</td>

									<td class="text-center">2018-01-15 12:30:06</td>

                                    <td class="text-center">

										<a class="btn btn-primary btn-xs" href="#"><i class="fa fa-pencil"> Edit </i></a>

										<a class="btn btn-danger btn-xs deleteRow" href="javascript:void(0);" data-id="5" data-url="#" data-posttitle="New Arrivels" data-title="delete" title="delete"><i class="fa fa-trash-o"> Delete </i></a>

										<a class="row_status btn btn-success btn-xs fa fa-unlock" data-id="5" data-url="#" data-toggle="tooltip" data-title="Deactive" data-posttitle="New Arrivels" title="Active">

                                              Active
										</a>

                                    </td>

                                </tr>

                            
                                                        

                    </tbody>

                </table>

                
                    <div class="row">

                        <div class="col-lg-6">

                            <span class="record_info">

								Showing 10 of 14
							</span>

                        </div>

                        <div class="col-lg-6">

                            <div class="dataTables_paginate paging_bootstrap pagination">

                                <ul><li><a href="#" class="pageActive">1</a></li><li><a href="#" data-ci-pagination-page="2">2</a></li><li><a href="#" data-ci-pagination-page="2" rel="next">Next &gt;&gt; </a></li></ul>
                            </div>
                        </div>
                    </div>
            </div>

        </div>

    </section>

</section>


</section>
@stop