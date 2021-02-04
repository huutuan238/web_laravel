@extends('layout')
@section('content')

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="register-req">
				<p>Đăng nhập để xem lại lịch sử</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-20 clearfix">
						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
								<form action="{{ URL::to('save-checkout-customer') }}" method="POST">
									@csrf
									<input type="text" name="shipping_name" placeholder="Họ và tên">
									<input type="text" name="shipping_email" placeholder="Email">
									<input type="text" name="shipping_phone" placeholder="Số điện thoại">
									<input type="text" name="shipping_address"placeholder="Địa chỉ">
									<textarea name="shipping_note"  placeholder="Ghi chú đơn hàng của bạn" rows="16"></textarea>
									<input type="submit" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
								</form>
							</div>
						</div>
					</div>					
				</div>
			</div>
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>

			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->

@endsection