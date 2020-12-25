@extends('admin_layout')
@section('admin_content')

			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>

			
					<p class="alert-success">

					<?php
                    $messege=Session::get('messege');
                      if($messege){
                          echo $messege;
                          Session::put('messege',null);
                      }
                    ?>

                    </p>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>

						
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Product ID</th>
								  <th>Product Name</th>
								  <th>Product image</th>
								  <th>Product price</th>
								  <th>Category name</th>
								  <th>Brand name</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   

						@foreach($all_product_info as $v_product)

						  <tbody>
							<tr>
								<td>{{$v_product -> product_id}}</td>
								<td class="center">{{$v_product -> product_name}}</td>
								<td class="center"><img src="{{url($v_product->product_image)}}" style="
								height: 50px; width: 50px" alt=""></td>
								<td class="center">{{$v_product -> product_price}}</td>
								<td class="center">{{$v_product -> category_name}}</td>
								<td class="center">{{$v_product -> brand_name}}</td>
								<td class="center">
							        @if($v_product -> publication_status==1)
									<span class="label label-success"><!-- {{$v_product -> publication_status}} -->Active</span>
									@else

									<span class="label label-danger"><!-- {{$v_product -> publication_status}} -->Inactive</span>

									@endif
								</td>
								<td class="center">

									@if($v_product -> publication_status==1)

									<a class="btn btn-danger" href="{{url('/inactive_product/'.$v_product->product_id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
									@else
									<a class="btn btn-success" href="{{url('/active_product/'.$v_product->product_id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
									@endif
									<a class="btn btn-info" href="{{url('/edit_product/'.$v_product->product_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{url('/delete_product/'.$v_product->product_id)}}">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>

						  </tbody>
					    @endforeach

					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

@endsection