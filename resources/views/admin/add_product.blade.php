@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>
                <div class="panel-body">
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/save-product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên  sản phẩm</label>
                            <input type="text" class="form-control" name ="product_name" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" class="form-control" name ="product_price" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" name ="product_image" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea class="form-control"style='resize: none' rows="5" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dụng sản phẩm</label>
                            <textarea class="form-control"style='resize: none' rows="5" name="product_content" id="exampleInputPassword1" placeholder="Mô tả nội dung sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                             <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Danh mục sản phẩm</label>
                            <select class="form-control input-sm m-bot15" name="product_cate">
                                @foreach($cate_product as $key=>$cate)
                                    <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @endforeach
                             </select>
                        </div>
                        <div class="form-group">
                        	 <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Thương hiệu</label>
							<select class="form-control input-sm m-bot15" name="product_brand">
                                @foreach($brand_product as $key=>$brand)
                                    <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                   			 </select>
                        </div>
                        <div class="form-group">
                             <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="product_status">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                             </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection