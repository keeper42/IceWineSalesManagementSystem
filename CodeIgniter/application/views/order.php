<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>订单确认</title>
	<!-- 引入 Bootstrap -->
	<link href="/css/tether.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/home.css">
	<!-- HTML5 Shim 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
	<!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
	<!--[if lt IE 9]>
	 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	 <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<link href="/css/demo.css" rel="stylesheet" type="text/css" />
	<link href="/css/cartstyle.css" rel="stylesheet" type="text/css" />
	<link href="/css/jsstyle.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="/css/order.css" />
	<link href="/fonts/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />	
</head>
<body>

<!--顶部导航条 -->
<div class="col-sm-12 col-md-6 col-md-offset-3">
    <div class="header_nav  ">
        <li>
        <?php if (isset($_SESSION['user'])) {
        	$user = $_SESSION['user'];?>
            <img src="<?php echo $user->avatar ?>" class="img-circle" width=32 height=32 alt="avatar">
            <?php echo $user->name ?>
            <a href="/index.php/home/logout">[退出]</a>
        <?php } else { ?>
            <a href="/index.php/home/login" class="login">亲，请登录，免费注册 </a>
        <?php } ?></li>
        <div class="space"></div>
        <li><a href="/">商城首页</a></li>
        <li><i class=""></i><a href="/index.php/shopping"> 购物车</a></li>
        <li><i class=""></i><a href="/index.php/personal"> 个人中心</a></li>
    </div>
</div>
<!--地址 -->
<div class="paycont">
	<div class="address">
		<div class="clear"></div>
		<ul>
			<div class="per-border"></div>
			<h3>确认收货地址 </h3><br/><br/><br/>
			<li class="user-addresslist defaultAddr">
				<div class="address-left">
					<div class="user DefaultAddr">

						<span class="buy-address-detail">   
	<span class="buy-user"><?php echo $user->name ?> </span>
						<span class="buy-phone">15871145629</span>
						</span>
					</div>
					<div class="default-address DefaultAddr">
						<span class="buy-line-title buy-line-title-type">收货地址：</span>
						<span class="buy--address-detail">
					   		<span class="province">广东</span>省
							<span class="city">深圳</span>市
							<span class="dist">南山</span>区
							<span class="street">南海大道3688号(深圳大学)</span>
						</span>
					</div>
					<ins class="deftip">默认地址</ins>
				</div>
				<div class="address-right">
					<a href="../person/address.html">
						<span class="am-icon-angle-right am-icon-lg"></span></a>
				</div>
				<div class="clear"></div>

				<div class="new-addr-btn">
					<a href="#" class="hidden">设为默认</a>
					<span class="new-addr-bar hidden">|</span>
					<a href="#">编辑</a>
					<span class="new-addr-bar">|</span>
					<a href="javascript:void(0);" onclick="delClick(this);">删除</a>
				</div>

			</li>
		</ul>
	<div class="clear"></div>
	</div>
	
	<!--支付方式-->
	<br/>
	<div class="logistics">
		<h3>选择支付方式</h3>
		<ul class="pay-list">
			<li class="pay card"><img src="/images/wangyin.jpg" />银联<span></span></li>
			<li class="pay qq"><img src="/images/weizhifu.jpg" />微信<span></span></li>
			<li class="pay taobao"><img src="/images/zhifubao.jpg" />支付宝<span></span></li>
		</ul>
	</div>
	<div class="clear"></div>
	<br/>
</div>

<!--订单 -->
<div class="concent">
	<div id="payTable">
		<h3>确认订单信息</h3>
		<div class="cart-table-th">
			<div class="wp">
				<div class="th th-item">
					<div class="td-inner">商品信息</div>
				</div>
				<div class="th th-price">
					<div class="td-inner">单价</div>
				</div>
				<div class="th th-amount">
					<div class="td-inner">数量</div>
				</div>
				<div class="th th-sum">
					<div class="td-inner">金额</div>
				</div>
				<div class="th th-oplist">
					<div class="td-inner">配送方式</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
			<tr class="item-list">
				<div class="bundle  bundle-last">
					<div class="bundle-main">
						<?php foreach ($order as $single) { ?>
						<ul class="item-content clearfix">
							<div class="pay-phone">
								<li class="td td-item">
									<div class="item-pic">
										<a href="#" class="J_MakePoint">
											<img src="<?php echo $single['product']->img ?>" class="itempic J_ItemImg">
										</a>
									</div>
									<div class="item-info">
										<div class="item-basic-info">
											<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">
											<?php echo $single['product']->name ?></a>
										</div>
									</div>
								</li>
								<li class="td td-price">
									<div class="item-price price-promo-promo">
										<div class="price-content">
											<em class="J_Price price-now" id="singlePrice"><?php echo $single['product']->price ?></em>
										</div>
									</div>
								</li>
							</div>
							<li class="td td-amount">
								<div class="amount-wrapper ">
									<div class="item-amount ">
										<span class="phone-title">购买数量</span>
										<div class="sl" >
											<input class="min am-btn" name="" type="button" value="-" onclick="add(this)"/>
											<input readonly="true" class="text_box" id="addGoods<?php echo $single['product']->id ?>" data-pid=<?php echo $single['product']->id ?> data-oid=<?php echo $single['order']->id ?> name="" type="text" value=<?php echo $single['order']->amount ?> style="width:30px;" />
											<input class="add am-btn" name="" type="button" value="+" onclick="add(this)"/>
										</div>
									</div>
								</div>
							</li>
							<li class="td td-sum">
								<div class="td-inner" >
									<em class="J_ItemSum number" id="price1" tabindex="0"><?php echo $single['product']->price * $single['order']->amount ?></em>
								</div>
							</li>
							<li class="td td-oplist">
								<div class="td-inner">
									<span class="phone-title">配送方式</span>
									<div class="pay-logis">
										快递<b class="sys_item_freprice" id="express">10</b>元
									</div>
								</div>
							</li>
						</ul>
						<?php } ?>
						<div class="clear"></div>
			<!--含运费小计 -->
			<div class="buy-point-discharge ">
				<p class="price g_price ">
					合计（含运费） <span>¥</span><em class="pay-sum" id = "price2"><?php echo $single['product']->price * $single['order']->amount + 10 ?></em>
				</p>
			</div>

			<!--信息 -->
			<div class="order-go clearfix">
				<div class="pay-confirm clearfix">
					<div class="box">
						<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
							<span class="price g_price">
	                			<span>¥</span> 
	                         	<em class="style-large-bold-red" id="price3"><?php echo $single['product']->price * $single['order']->amount +10 ?></em>
							</span>
						</div>

						<div id="holyshit268" class="pay-address">

							<p class="buy-footer-address">
								<span class="buy-line-title buy-line-title-type">寄送至：</span>
								<span class="buy--address-detail">
				   <span class="province">广东</span>省
								<span class="city">深圳</span>市
								<span class="dist">南山</span>区
								<span class="street">南海大道3688号(深圳大学)</span>
								</span>
								</span>
							</p>
							<p class="buy-footer-address">
								<span class="buy-line-title">收货人：</span>
								<span class="buy-address-detail">   
	                     <span class="buy-user"><?php echo $user->name ?></span>
								<span class="buy-phone">12345678910</span>
								</span>
							</p>
						</div>
					</div>

			<div id="holyshit269" class="submitOrder">
				<div class="go-btn-wrap">
					<a id="J_Go" href="/index.php/order/success" class="btn-go" tabindex="0" title="点击此按钮，确定购买">确定购买</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
</div>
<div class="theme-popover-mask"></div>
<div class="clear"></div>

</body>
<!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
<script src="/js/jquery.min.js"></script>
<!-- 包括所有已编译的插件 -->
<script src="/js/bootstrap.min.js"></script>
<script src="/js/address.js"></script>
<script src="/js/addGoods.js"></script>
</html>