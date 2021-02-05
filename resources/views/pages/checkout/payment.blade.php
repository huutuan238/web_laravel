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


			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
				<div class="table-responsive cart_info">
				<?php
					$content = Cart::content();
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{ URL::to('public/uploads/product/'.$v_content->options->image) }}" width="100px" height="100px" alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $v_content->name }}</a></h4>
								<p>Mã ID: {{ $v_content->id }}</p>
							</td>
							<td class="cart_price">
								<p>{{ number_format($v_content->price).' '.'VND'  }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $v_content->qty }}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
									$subtotal = $v_content->price * $v_content->qty;
									echo number_format($subtotal).' '.'VND';
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)  }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach	
					</tbody>
				</table>
			</div>
			</div>
			<h4 style="margin: 50px 0;font-size: 20px;">Chọn phương thức thanh toán</h4>
			<form method="POST" action="{{ URL::to('order-place') }}">
				@csrf
				<div class="payment-options">
						<span>
							<label><input name="payment_options" value="1" type="checkbox"> Trả bằng ATM</label>
						</span>
						<span>
							<label><input name="payment_options" value="2" type="checkbox"> Trả bằng tiền mặt</label>
						</span>
						{{-- <span>
							<label><input type="checkbox"> Paypal</label>
						</span> --}}
						<input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm send_order">
				</div>
			</form>
		</div>
	</section> <!--/#cart_items-->

@endsection