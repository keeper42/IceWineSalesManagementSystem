<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>home</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<script src='/js/jquery.min.js'></script>
	<script src="/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/css/home.css">
</head>
<body>
	<div class="header">
		<div class="header_nav">
			<li>
				<?php if (isset($_SESSION['user'])) {
					$user = $_SESSION['user'];?>
				    <img src="<?php echo $user->avatar ?>" class="img-circle" width=32 height=32 alt="avatar">
				    <?php echo $user->name ?>
				    <a href="/index.php/home/logout">[退出]</a>
				<?php } else { ?>
				    <a href="/index.php/home/login" class="login">亲，请登录，免费注册 </a>
				<?php } ?>
			</li>

			<div class="space"></div>
			<li><a href="/">商城首页</a></li>
			<li><a href="/index.php/shopping">购物车</a></li>
			<li><a href="#">收藏夹</a></li>
			<li><a href="#">个人中心</a></li>
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
           <a href="#"> <img src="/images/ad1.jpg" alt="First slide"></a>
        </div>
        <div class="item">
        <a href="#"> <img src="/images/ad2.jpg" alt="Second slide"></a>
        </div>
        <div class="item">
        <a href="#"> <img src="/images/ad3.jpg" alt="Third slide"></a>
        </div>
    </div>
    <!-- 轮播（Carousel）导航 -->
    <a class="carousel-control left" href="#myCarousel" 
       data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" 
       data-slide="next">&rsaquo;</a>
</div> 
		</div>
	</div>
	<div class="shortcut">
		<div class="shortcut1">
			<a href="#"><img src="/images/566.png" alt=""></a>
		</div>
		<div class="shortcut2">
				<a href="#"><img src="/images/tw2.jpg" alt=""></a>
		</div>
		<div class="shortcut3">
				<a href="#"><img src="/images/02.jpg" alt=""></a>
		</div>
		<div class="shortcut4">
				<a href="#"><img src="/images/activity2.jpg" alt=""></a>
		</div>
		<div class="shortcut5">
				<a href="#"><img src="/images/list1.jpg" alt=""></a>
		</div>
	</div>

	<div class="product_list">
		<h1>新品速递</h1>
		<?php foreach ($products as $product) { ?>
			<div class="tcard">
				<a href="/index.php/product/index/<?php echo $product->id ?>"><img src="<?php echo $product->img ?>" alt=""></a>
				<h2><?php echo $product->name ?></h2>
				<h3><a href="#" class="span"> 新品</a>   月销2320笔</h3>
				<p>"人好物也好，以后还来你家买!"</p>
			</div>
		<?php }?>
	</div>
	
	<div class="product_list">
		<h1>新品速递</h1>
		<?php foreach ($products as $product) {?>
		<div class="tcard">
			<a href="/index.php/product/index/<?php echo $product->id ?>"><img src="<?php echo $product->img ?>" alt=""></a>
			<h2><?php echo $product->name ?></h2>
			<h3><a href="#" class="span">新品</a>   月销2320笔</h3>
			<p>"人好物也好，以后还来你家买!"</p>
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
		<p>备案信息：Copyright © 2007-2016 OkBuy.com All Rights Reserved 津ICP备16005872号-1 京公网安备110105006859   客服电话：400-8610-400</p>
	</div>

</body>
	