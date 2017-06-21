<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>冰酒销售管理系统</title>
	<!-- 引入 Bootstrap -->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- HTML5 Shim 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
    <!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
    <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="/css/home.css">
</head>

<body>
	<!-- 顶部导航栏 -->
	<div class="header">
		<div class="header_nav">
			<li>
				<?php if (isset($_SESSION['user'])) {
					$user = $_SESSION['user'];?>
				    <img src="<?php echo $user->avatar ?>" class="img-circle" width=32 height=32 alt="avatar">
				    <?php echo $user->name ?>
				    <a href="/index.php/home/logout">[退出]</a>
				<?php } else { ?>
				    <a href="/index.php/home/login" class="login">亲，请登录</a>
				<?php } ?>
			</li>
			<div class="space"></div>
			<li><a href="/">商城首页</a></li>
			<li><a href="/index.php/shopping"> 购物车</a></li>
			<li><a href="/index.php/personal">个人中心</a></li>
		</div>
	</div>
	
	<div class="mainproduct">
		<div id="myCarousel" class="carousel slide">
		    <!-- 轮播（Carousel）指标 -->
		    <ol class="carousel-indicators">
		        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		        <li data-target="#myCarousel" data-slide-to="1"></li>
		        <li data-target="#myCarousel" data-slide-to="2"></li>
		    </ol>   
		    <!-- 轮播（Carousel）项目 -->
		    <div class="carousel-inner">
		        <div class="item active">
		           <a href="#"><img src="/images/wine1.jpg" alt="First slide"></a>
		        </div>
		        <div class="item">
		        	<a href="#"> <img src="/images/wine2.jpg" alt="Second slide"></a>
		        </div>
		        <div class="item">
		        	<a href="#"> <img src="/images/wine3.jpg" alt="Third slide"></a>
		        </div>
		    </div>
		    <!-- 轮播（Carousel）导航 -->
		    <a class="carousel-control left" href="#myCarousel" 
		       data-slide="prev">&lsaquo;</a>
		    <a class="carousel-control right" href="#myCarousel" 
		       data-slide="next">&rsaquo;</a>
		</div> 
	</div>
	<div class="shortcut">
		<div class="shortcut1">
			<a href="/index.php/product/index/6"><img src="/images/shortcut1.jpg" alt=""></a>
		</div>
		<div class="shortcut2">
				<a href="/index.php/product/index/5"><img src="/images/shortcut2.jpg" alt=""></a>
		</div>
		<div class="shortcut3">
				<a href="/index.php/product/index/9"><img src="/images/shortcut3.jpg" alt=""></a>
		</div>
	</div>

	<div class="product_list">
		<h1>新品速递</h1>
		<?php foreach ($products as $product) { ?>
			<div class="tcard">
				<a href="/index.php/product/index/<?php echo $product->id ?>"><img src="<?php echo $product->img ?>" alt=""></a>
				<h2><?php echo $product->name?></h2>
				<h3><a href="#" class="span"> 新品</a> 热销中</h3>
				<p>天赋祁连，地道冰酒</p>
			</div>
		<?php }?>
	</div>
	
	<div class="bottom">
		<ul>
			<li><a href="#">购物指南</a></li>
			<li><a href="#">购物流程</a></li>
			<li><a href="#">常见问题</a></li>
		</ul>
		<ul>
			<li><a href="#">配送方式</a></li>
			<li><a href="#">快递配送</a></li>
			<li><a href="#">检查验收</a></li>
		</ul>
		<ul>
			<li><a href="#">支付方式</a></li>
			<li><a href="#">代金券</a></li>
			<li><a href="#">申请退款</a></li>
		</ul>
		<ul>
			<li><a href="#">售后服务</a></li>
			<li><a href="#">退款说明</a></li>
			<li><a href="#">联系客服</a></li>
		</ul>
		<p>备案信息：Copyright © 2010-2017 ebuy.com All Rights Reserved 粤ICP备16005678号-1 京公网安备1101001010   客服电话：400-400-400</p>
	</div>
</body>

<!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
<script src="/js/jquery.min.js"></script>
<!-- 包括所有已编译的插件 -->
<script src="/js/bootstrap.min.js"></script>

</html>
