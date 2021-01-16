@extends('layout')
@section('content')
@foreach($details_product as $key=>$product)
<div class="product-details"><!--product-details-->
	<div class="col-sm-5">
		<div class="view-product">
			<img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" />
			<h3>ZOOM</h3>
		</div>
		<div id="similar-product" class="carousel slide" data-ride="carousel">
			
			  <!-- Wrapper for slides -->
			    <div class="carousel-inner">
					<div class="item active">
					  <a href=""><img src="{{ URL::to('public/frontend/images/product-details/similar1.jpg') }}" alt=""></a>
					  <a href=""><img src="{{ URL::to('public/frontend/images/product-details/similar2.jpg') }}" alt=""></a>
					  <a href=""><img src="{{ URL::to('public/frontend/images/product-details/similar3.jpg') }}" alt=""></a>
					</div>
					<div class="item">
					  <a href=""><img src="{{ URL::to('public/frontend/images/product-details/similar1.jpg') }}" alt=""></a>
					  <a href=""><img src="{{ URL::to('public/frontend/images/product-details/similar2.jpg') }}" alt=""></a>
					  <a href=""><img src="{{ URL::to('public/frontend/images/product-details/similar3.jpg') }}" alt=""></a>
					</div>
					<div class="item">
					  <a href=""><img src="{{ URL::to('public/frontend/images/product-details/similar1.jpg') }}" alt=""></a>
					  <a href=""><img src="{{ URL::to('public/frontend/images/product-details/similar2.jpg') }}" alt=""></a>
					  <a href=""><img src="{{ URL::to('public/frontend/images/product-details/similar3.jpg') }}" alt=""></a>
					</div>
					
				</div>

			  <!-- Controls -->
			  <a class="left item-control" href="#similar-product" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			  </a>
			  <a class="right item-control" href="#similar-product" data-slide="next">
				<i class="fa fa-angle-right"></i>
			  </a>
		</div>

	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<h2>{{ $product->product_name }}</h2>
			<p>Mã ID: {{ $product->product_id }}</p>
			<img src="{{ URL::to('public/frontend/images/product-details/rating.png')}}" alt="" /><br></br>
			<form action="{{ URL::to('/save-cart') }}" method="POST">
				@csrf
				<span>
					<span>{{ number_format($product->product_price).' '.'VND' }}</span><br></br>
					<label>Số lượng:</label>
					<input name="qty"type="number" min='1' value="1" />
					<input type="hidden" name="productid_hidden" value="{{ $product->product_id }}">
					<button type="submit" class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Add to cart
					</button>
				</span>
			</form>
			<p><b>Tình trạng:</b> Còn hàng</p>
			<p><b>Điều kiện:</b> Mới 100%</p>
			<p><b>Danh mục: </b>{{ $product->category_name }}</p>
			<p><b>Thương hiệu: </b>{{ $product->brand_name }}</p>
			<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
			<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
			<li><a href="#reviews" data-toggle="tab">Reviews</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade active in" id="details" >
			<p>{{ $product->product_desc }}</p>
		</div>
		<div class="tab-pane fade" id="companyprofile" >
			<p>{{ $product->product_content }}</p>
		</div>
		<div class="tab-pane fade" id="reviews" >
			<div class="col-sm-12">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
				</ul>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				<p><b>Write Your Review</b></p>
				
				<form action="#">
					<span>
						<input type="text" placeholder="Your Name"/>
						<input type="email" placeholder="Email Address"/>
					</span>
					<textarea name="" ></textarea>
					<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
					<button type="button" class="btn btn-default pull-right">
						Submit
					</button>
				</form>
			</div>
		</div>	
	</div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">Sản phẩm gợi ý</h2>
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">	
				@foreach($related_product as $key=>$related)
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="{{ URL::to('public/uploads/product/'.$related->product_image) }}" alt="">
								<h2>{{ number_format($related->product_price).' '.'VND' }}</h2>
								<p>{{ $related->product_name }}</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>			
	</div>
</div><!--/recommended_items-->
@endsection