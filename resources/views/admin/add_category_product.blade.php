@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Product
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
                        <form role="form" action="{{ URL::to('/save-category-product') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục sản phẩm</label>
                            <input type="text" class="form-control" name ="category_product_name" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea class="form-control"style='resize: none' rows="5" name="category_product_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                        	 <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Hiển thị</label>
							<select class="form-control input-sm m-bot15" name='category_product_status'>
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                   			 </select>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh muc</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection