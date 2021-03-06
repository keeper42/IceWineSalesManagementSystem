<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>商品页面</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/demo.css" rel="stylesheet" type="text/css"/>
    <link href="/css/optstyle.css" rel="stylesheet" type="text/css"/>
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/css/tether.min.css" rel="stylesheet">
    <link href="/css/cart.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/css/product.css" rel="stylesheet" type="text/css" />
    <link href="/fonts/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <div class="row ">
      <div class="col-sm-12 col-md-10 col-md-offset-1"> 
        <div class="header_nav navbar">
            <li>
                <img src="<?php echo $user->avatar ?>" class="img-circle" width=32 height=32 alt="avatar">
                <?php echo $user->name ?>
            </li>
            <div class="space"></div>
            <li><a href="/"><font size="4">商城首页</font></a></li>
            <li><i class=""></i><a href="/index.php/shopping"><font size="4"> 购物车</font><sup><span class="badge" style="background-color: #b94a48" id="shopNum"><?php echo isset($shopNum)?$shopNum:'' ?></span></sup></a></li>
            <li><i class=""></i><a href="/index.php/personal"><font size="4">个人中心</font></a></li>
        </div>
      </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>

<!--图片轮播-->

<div class="row">

  <div class="col-sm-12 col-md-6 col-md-offset-3">

    <div class="row">

        <div class="col-sm-12 col-md-6 col-lg-6" style="overflow: hidden;">
            <img class="img-rounded" style="width: 400px; height: 450px;" src="<?php echo $product->img ?>"/>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="tb-detail-hd">
                <h1><?php echo $product->name ?></h1>
            </div>
            <div class="tb-detail-list">
                <!--价格-->
                <div class="tb-detail-price">
                    <li class="price iteminfo_price">
                        <dt>促销价</dt>
                        <dd><em>¥</em><b class="sys_item_price"><?php echo $product->price ?></b>  </dd>
                    </li>
                </div>

                <div class="clear"></div>

                <!--各种规格-->
                <dl class="iteminfo_parameter sys_item_specpara">
                    <dt class="theme-login"><div class="cart-title">可选规格<span class="icon-angle-right"></span></div></dt>
                    <dd>
                        <!--操作页面-->
                        <div class="theme-popover-mask"></div>

                        <div class="theme-popover">
                            <div class="theme-span"></div>
                            <div class="theme-poptit">
                                <a href="javascript:;" title="关闭" class="close">×</a>
                            </div>
                            <div class="theme-popbod dform">
                                <form class="theme-signin" name="loginform" action="" method="post">
                                    <div class="theme-signin-left">
                                        <div class="theme-options">
                                            <div class="cart-title"><h4 class="text-danger"><strong>口味</strong></h4></div>
                                            <ul>
                                                <li class="sku-line selected">原味<i></i></li>
                                            </ul>
                                        </div>

                                        <div class="theme-options">
                                            <div class="cart-title"><h4 class="text-danger"><strong>包装</strong></h4></div>
                                            <ul>
                                                <li class="sku-line selected">礼盒装<i></i></li>
                                                <li class="sku-line">整箱装<i></i></li>
                                            </ul>
                                        </div>

                                        <div class="theme-options">
                                            <div class="cart-title number"><h4 class="text-danger"><strong>数量</strong></h4></div>
                                            <dd>
                                                <input id="min" class="am-btn am-btn-default" name="" type="button" value="-" onclick="adda(this)"/>
                                                <input type="tel" id="addGoods" name="number" min=0 max=<?php echo $product->instock ?> style="width: 30px;" onChange="checkNumber(this)" value=1>
                                                <input id="add" class="am-btn am-btn-default" name="" type="button" value="+" onclick="adda(this)" />
                                            </dd>
                                        </div>

                                        <h4><span id="Stock" class="tb-hidden">库存<span class="stock"><?php echo $product->instock ?></span>件</span></h4>
                                    </div>

                                    <div class="clear"></div>
                                    <div class="btn-op">
                                        <div class="btn btn btn-warning">确认</div>
                                        <div class="btn close btn am-btn-warning">取消</div>
                                    </div>

                                    <div class="theme-signin-right">
                                        <div class="img-info">
                                            <img src="../images/songzi.jpg" />
                                        </div>
                                        <div class="text-info">
                                            <span class="J_Price price-now">¥<?php echo $product->price ?></span>
                                            <span id="Stock" class="tb-hidden">库存<span class="stock"><?php echo $product->instock ?></span>件</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </dd>
                </dl>
                <div class="pay">
                    <div class="pay-opt">
                        <a href="home.html"><span class="icon-home icon-fw">首页</span></a>
                        <a><span class="icon-heart icon-fw">收藏</span></a>
                    </div>
                    <li>
                        <div class="clearfix tb-btn tb-btn-buy theme-login">
                            <a id="LikBuy" title="点此按钮到下一步确认购买信息" href="/index.php/shopping">立即购买</a>
                        </div>
                    </li>
                    <li>
                        <div class="clearfix tb-btn tb-btn-basket theme-login">
                            <?php if (isset($user)) {?>
                                <a id="LikBasket" title="加入购物车" href="#" data-pid=<?php echo $product->id ?> onclick="addToShopCar(this)">加入购物车</a>
                                
                            <?php } else { ?>
                                <a id="LikBasket" title="加入购物车" href="<?php echo "/index.php/product/login/".$product->id ?>">加入购物车</a>
                            <?php }?>
                    
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </div>
</div>

<br/>

<!-- 产品参数 -->
<div class="row">
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        <div class="introduceMain">
            <div class="tabs-bd">
                <div class="tab-panel fade in active">
                    <div class="J_Brand">
                        <div class="attr-list-hd tm-clear">
                            <h4>产品参数</h4>
                        </div>
                        <div class="clear">
                            <br/>
                            <?php echo $product->description ?>
                        </div>                           
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
         </div>
    </div>
</div>

</body>
<!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
<script src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/shopcar.js"></script>
<script type="text/javascript" src="/js/jquery.imagezoom.min.js"></script>
<script type="text/javascript" src="/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="/js/list.js"></script>
<!-- 包括所有已编译的插件 -->
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var STOCK = <?php echo $product->instock ?>;
</script>
</html>