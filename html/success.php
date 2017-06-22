<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>交易成功</title>
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
  <link href="/fonts/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" /> 
	<link href="/css/demo.css" rel="stylesheet" type="text/css" />
	<link href="/css/sustyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!--顶部导航条 -->
<div class="row navbar-default navbar-fixed-top" role="navigation"">
      <div class="col-sm-12 col-md-6 col-md-offset-3">
        <div class="header_nav">
            <li>
            <?php if (isset($_SESSION['user'])) {
              $user = $_SESSION['user'];?>
                <img src="<?php echo $user->avatar ?>" class="img-circle" width=32 height=32 alt="avatar">
                <?php echo $user->name ?>
                <a href="/index.php/home/logout">[退出]</a>
            <?php } else { ?>
                <a href="/index.php/home/login" class="login">亲，请登录</a>
            <?php } ?></li>
            <div class="space"></div>
            <li><a href="/"><font size="4">商城首页</font></a></li>
            <li><a href="/index.php/shopping"><font size="4"> 购物车</font></a></li>
            <li><a href="/index.php/personal"><font size="4">个人中心</font></a></li>
        </div>
    </div>
</div>

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
      <li><a href="/index.php/shopping">购物车</a></li>
      <li><a href="/index.php/personal">个人中心</a></li>
    </div>
  </div>

<!-- 付款成功 -->
<div align="center">
  <div class="take-delivery">
   <div class="status">
     <div class="successInfo">
       <ul>
         <li font-size="14px">您已成功付款~</li>
         <!-- <li>付款金额<em>¥2680.00</em></li> -->
         <div class="user-info">
           <p>收货人：customer</p>
           <p>联系电话：13745678910</p>
           <p>收货地址：广东省 深圳市 南山区 深圳大学</p>
         </div>
               请认真核对您的收货信息，如有错误请联系客服           
       </ul>
       <div class="option">
         <span class="info">您可以</span>
          <a href="/person/order.html" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
          <a href="/person/orderinfo.html" class="J_MakePoint"><span>交易详情</span></a>
       </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>