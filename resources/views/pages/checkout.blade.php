@extends('layout')
@section('content')
	<section id="cart_items">
		<div class="container">


			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-8 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form action="{{URL::to('/save_shipping_details')}}" method="post">
									{{ csrf_field() }}
									<input type="text" name="shipping_email" placeholder="Email*" required="">
									<input type="text" name="shipping_first_name" placeholder="First Name *" required="">
									<input type="text" name="shipping_last_name" placeholder="Last Name *" required="">
									<input type="text" name="shipping_address" placeholder="Address *" required="">
									<input type="text" name="shipping_mobile_number" placeholder="Mobile number *" required="">
									<input type="text" name="shipping_city" placeholder="City" required="">
									<input type="submit" class="btn btn-warning" value="done" style="color: green">
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
						</div>	
					</div>					
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->

	@endsection