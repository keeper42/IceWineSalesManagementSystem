<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Title</title>
	<!-- 引入 Bootstrap -->
	<link href="/css/tether.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
  <!-- HTML5 Shim 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
  <!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
  <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="/css/admin.css">
  <link href="/fonts/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- 编辑器 -->
  <link rel="stylesheet" href="/css/wangEditor.min.css">
</head>
<body>
	<div id="wrapper">
		<nav>
			<a href="#" class="btn" id="menu-control">
				<i class="fa fa-bars"></i>
			</a>
			<ul class="list-group" id="nav-list">
				<li class="person-info">
					<a href="#"><img src="<?php echo $user->avatar ?>" alt="" id="avatar" class="img-circle" width="100" height="100"></a>
					<p class="lead" style="margin-bottom: 0px;"><a href="#"><?php echo $user->name ?></a></p>
					<a class="btn btn-danger" id="logout" href="/index.php/admin/logout">logout</a>
				</li>
				<li class="list">
					<a href="#" data-target="home">
						<i class="fa fa-home"></i>
						<span>Home</span>
					</a>
				</li>
				<li class="list menu-focus">
					<a href="#" data-target="products">
						<i class="fa fa-database" aria-hidden="true"></i>
						<span>Product</span>
					</a>
				</li>
			</ul>
		</nav>
		<div class="container">
			<div id="hints"></div>
			<div id="home" class="hidden"></div>
			<div id="products" class="">
				<h3>Product</h3>
				<button type="button" onclick="publishProduct()" class="btn btn-primary"><i class="fa fa-plus"></i> add product</button>
				<div>
					<table class="table table-striped table-hover" id="product-list">
						<thead>
							<tr>
								<th>Product</th>
								<th width="100">In Stock</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="pagination-wrapper">
					<ul class="pagination" id="products-pagination" data-list-url="/index.php/product/getProduct" data-table="#product-list" data-pages=0 data-num-url="/index.php/product/productNum" data-current-page=0 data-single-num=10 data-render="renderProduct(data[i])">
					</ul>
				</div>
			</div>
			<div id="product" class="clearfix hidden">
				<h3 id="func-name">Publish product</h3>
				<form action="/index.php/product/addProduct" method="post" role="form" class="form-horizontal" id="product-data">
					<input type="number" name="pid" id="pid" value="" class="hidden">
					<div class="form-group">
						<label for="name" class="col-sm-1 control-label">Name:</label>
						<div class="col-sm-11">
							<input type="text" name="name" id="name" class="form-control" required="required">
						</div>
					</div>
					<div class="form-group">
						<label for="img" class="col-sm-1 control-label">Img:</label>
						<div class="col-sm-11">
							<input type="text" name="img" id="img" class="form-control" required="required">
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-sm-1 control-label">Price:</label>
						<div class="col-sm-11">
							<input type="number" name="price" id="price" class="form-control" required="required">
						</div>
					</div>
					<div class="form-group">
						<label for="stock" class="col-sm-1 control-label">Stock:</label>
						<div class="col-sm-11">
							<input type="number" name="stock" id="stock" class="form-control" required="required">
						</div>
					</div>
					<div class="form-group">
						<label for="content" class="col-sm-1 control-label">Description:</label>
						<div class="col-sm-11 pull-right">
							<textarea name="content" id="content" class="form-control" cols="30" rows="10" required="required"></textarea>
						</div>
					</div>
					<div class="form-group">
						<button type="button" data-loading-text="Svaing..." onclick="save(this)" class="btn btn-primary pull-right save">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
<script src="/js/jquery.min.js"></script>
<!-- 包括所有已编译的插件 -->
<script src="/js/bootstrap.min.js"></script>
<!-- 编辑器 -->
<script src="/js/wangEditor.min.js"></script>

<script src="/js/admin.js"></script>
</html>