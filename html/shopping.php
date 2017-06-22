<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- 引入 Bootstrap -->
	<link href="/css/tether.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	  <!-- HTML5 Shim 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
	  <!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
	  <!--[if lt IE 9]>
	     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	     <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	  <![endif]-->
	<link href="/fonts/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="/css/cart.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="/css/product.css">
</head>

<body class="container">
    <div class="row ">
      <div class="col-sm-12 col-md-10 col-md-offset-1">	
        <div class="header_nav navbar ">
        	<li>
        		<img src="<?php echo $user->avatar ?>" class="img-circle" width=32 height=32 alt="avatar">
        		<?php echo $user->name ?>
        	</li>
        	<div class="space"></div>
        	<li><a href="/"><font color="black">商城首页</font></a></li>
        	<li><a href="/index.php/shopping"><font color="black"> 购物车</font><sup><span class="badge" style="background-color: #b94a48" id="shopNum"><?php echo isset($shopNum)?$shopNum:'' ?></span></sup></a></li>
        	<li><a href="/index.php/personal"><font color="black">个人中心</font></a></li>
      	</div>
  		</div>
  	</div>

    <div class="cart-wrap">
		<table id="cartTable" class="cart table table-condensed">
			<thead>
				<tr>
					<th class="t-checkbox"><label><input class="check-all check" type="checkbox" /></label></th>
					<th class="t-goods text-center"><label>产品型号</label></th>
					<th class="text-center">产品备注</th>
					<th class="t-selling-price text-center"><label>销售单价</label></th>
					<th class="t-qty text-center"><label>采购数量</label></th>
					<th class="t-subtotal text-center"><label>金额小计</label></th>
					<th class="t-action"><label>操作</label></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($shoppings as $shopping) { ?>
				<tr>
					<td><input type="checkbox" data-sid=<?php echo $shopping['shopping']->id ?> class="check-one check"/></td>
					<td class="goods text-center"><label> <?php echo $shopping['product']->name ?></label></td>
					<td class="text-center">618活动整箱特惠</td>
					<td class="selling-price number small-bold-red text-right"
								style="padding-top: 1.1rem;" data-bind="<?php echo $shopping['product']->price ?>"><?php echo $shopping['product']->price ?>
					</td>
					<td>
						<div class="input-group input-group-sm">
							<span class="input-group-addon minus">-</span>
							<input type="text" class="number form-control input-sm" value=<?php echo $shopping['shopping']->amount ?> data-sid=<?php echo $shopping['shopping']->id ?>/>
							<span class="input-group-addon plus">+</span>
						</div>
					</td>
					<td class="subtotal number small-bold-red text-right" style="padding-top: 1.1rem;"></td>
					<td class="action" style="padding-top: 1.1rem;"><span class="btn btn-xs btn-warning" data-sid=<?php echo $shopping['shopping']->id ?> onclick="deleteShopping(this)">删除</span></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12">
				<div class="cart-summary">
					<div style="margin-left: 2rem;" class="pull-right">
						<a href="#"
							id="btn_settlement" type="button" class="btn btn-primary" disabled onclick="createOrder()">去结算</a>
					</div>
					<div style="margin-left: 1rem; margin-top: 0.4rem;" class="pull-right total">
						<label>金额合计:<span id="priceTotal" class="price-total large-bold-red">0.00</span></label>
					</div>
					<div style="margin-top: 4px;" class="pull-right">
						<label>您选择了<span id="itemCount" class="large-bold-red" style="margin: 0 4px;"></span>种产品型号，共计<span id="qtyCount" class="large-bold-red" style="margin: 0 4px;"></span>件
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/etao.js"></script>
<script type="text/javascript" src="/js/cart.js"></script>
<script type="text/javascript" src="/js/shopping.js"></script>

</html>