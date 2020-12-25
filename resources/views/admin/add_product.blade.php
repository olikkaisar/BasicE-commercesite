@extends ('admin_layout')
@section('admin_content')


			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add product</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header" data-original-title>
					<h2><i class="halflings-icon edit"></i><span class="break"></span>Add product</h2>
					<div class="box-icon">
						<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
						<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
					</div>
				</div>

				<p class="alert-success">

				<?php
                $messege=Session::get('messege');
                  if($messege){
                      echo $messege;
                      Session::put('messege',null);
                  }
                ?>

                </p>

				<div class="box-content">
					                      
                 <form class="form-horizontal" action="{{url('/save-product')}}" method="post" enctype="multipart/form-data"> 
                   {{ csrf_field() }}
                   
				  <fieldset>
					
					<div class="control-group">
					  <label class="control-label" for="date01">Product name</label>
					  <div class="controls">
						<input type="text" class="input-xlarge" name="product_name" required="" >
					  </div>
					</div>

                    <div class="control-group">
					<label class="control-label" for="selectError3">Product category</label>
						<div class="controls">

						  <select id="selectError3" name="category_id">
						  	<option>Select category</option>
						  	<?php 
								$all_published_category=DB::table('tbl_category')
													->where('publication_status',1)
													->get();
							foreach ($all_published_category as $v_category) { ?>
							<option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option>
							<?php } ?>

    						</select>
						</div>
					</div>

					<div class="control-group">
					<label class="control-label" for="selectError3">Brand name</label>
						<div class="controls">
						  <select id="selectError3" name="brand_id">
							<option>Select brand</option>
							<?php 
								$all_published_brand=DB::table('tbl_brands')
													->where('publication_status',1)
													->get();
							foreach ($all_published_brand as $v_brand) { ?>
							<option value="{{$v_brand->brand_id}}">{{$v_brand->brand_name}}</option>
							<?php } ?>
						  </select>
						</div>
					</div>
					          
					<div class="control-group hidden-phone">
					  <label class="control-label" for="textarea2">Product short description</label>
					  <div class="controls">
						<textarea class="cleditor" name="product_short_description" rows="3" required=""></textarea>
					  </div>
					</div>

					<div class="control-group hidden-phone">
					  <label class="control-label" for="textarea2">Product long description</label>
					  <div class="controls">
						<textarea class="cleditor" name="product_long_description" rows="3" required=""></textarea>
					  </div>
					</div>

					<div class="control-group">
					  <label class="control-label" for="date01">Product price</label>
					  <div class="controls">
						<input type="text" class="input-xlarge" name="product_price" required="" >
					  </div>
					</div>

					<div class="control-group">
					  <label class="control-label" for="fileInput">image</label>
					  <div class="controls">
						<input class="input-file uniform_on" name="product_image" id="fileInput" type="file">
					  </div>
					</div>

					<div class="control-group">
					  <label class="control-label" for="date01">Product size</label>
					  <div class="controls">
						<input type="text" class="input-xlarge" name="product_size" required="" >
					  </div>
					</div>

					<div class="control-group">
					  <label class="control-label" for="date01">Product color</label>
					  <div class="controls">
						<input type="text" class="input-xlarge" name="product_color" required="" >
					  </div>
					</div>

					<div class="control-group hidden-phone">
					  <label class="control-label" for="textarea2">Publication status</label>
					  <div class="controls">
						<input type="checkbox" name="publication_status" value="1" >
					  </div>
					</div>
					<div class="form-actions">
					  <button type="submit" class="btn btn-primary">Add Product</button>
					  <button type="reset" class="btn">Cancel</button>
					</div>
				  </fieldset>
				</form>   

			</div>
		</div><!--/span-->

	</div><!--/row-->

@endsection