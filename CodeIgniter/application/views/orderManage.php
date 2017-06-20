<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>后台管理系统</title>
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
      <ul class="list-group" id="nav-list">
        <li class="person-info">
          <a href="#"><img src="<?php echo $user->avatar ?>" alt="" id="avatar" class="img-circle" width="100" height="100"></a>
          <p class="lead" style="margin-bottom: 0px;"><a href="#"><?php echo $user->name ?></a></p>
          <a class="btn btn-danger" id="logout" href="/index.php/home/logout">logout</a>
        </li>
        <li class="list">
          <a href="/index.php/employee" data-target="products">
            <i class="fa fa-database"></i>
            <span style="font-size: 16px">产品管理</span>
          </a>
        </li>
        <li class="list menu-focus">
          <a href="/index.php/orderManage" data-target="order">
            <i class="fa fa-reorder" aria-hidden="true"></i>
            <span style="font-size: 16px">订单管理</span>
          </a>
        </li>
        <li class="list">
          <a href="employeePersonal" data-target="personal">
            <i class="fa fa-user"></i>
            <span style="font-size: 16px">个人中心</span>
          </a>
        </li>
      </ul>
    </nav>
    
    <!-- container -->
    <div class="container">
      <div id="hints"></div>
      <div id="home" class="hidden"></div>
      <div id="order" class="" style="margin-top: 20px;" >
      <h3 style="font-weight: bold; margin-left: 10px;margin-bottom: 20px;">订单管理</h3>
        <div>
          <table class="table table-striped table-hover" id="order-list">
            <thead>
              <tr>
                <th>订单编号</th>
                <th>收件人</th>
                <th>收货地址</th>
                <th>联系电话</th>
                <!-- <th>订单总价</th> -->
                <th>付款方式</th>
                <th width="150">状态</th>
              </tr>
            </thead>
            <tbody >
            <tr>
              <td><a href="#" data-pid="1" onclick="javascript:void(0)">201706160101</a></td>
              <td><span>customer</span></td>
              <td><span>广东省深圳市南山区深圳大学</span></td>
              <td><span>135123555</span></td>
              <td><span>货到付款</span></td>
              <td><span>未发货</span></td>
            </tr>
            <tr>
              <td><a href="#" data-pid="1" onclick="javascript:void(0)">201706160201</a></td>
              <td><span>customer2</span></td>
              <td><span>广东省深圳市南山区深圳大学</span></td>
              <td><span>135123555</span></td>
              <td><span>网上支付</span></td>
              <td><span>待确定收货</span></td>
            </tr>
            </tbody>
          </table>
        </div>
        <div style="float: right">
          <button type="button" onclick="alert('录入成功')" class="btn btn-primary" style="margin-right: 60px"class="btn btn-primary"><i class="fa fa-arrow-right"></i>&nbsp;录入订单</button>
        </div>
        <br>
        <div class="pagination-wrapper">
          <ul class="pagination" id="products-pagination" data-list-url="/index.php/product/getProduct" data-table="#product-list" data-pages="0" data-num-url="/index.php/product/productNum" data-current-page="0" data-single-num="10" data-render="renderProduct(data[i])">
          <li class="disabled"><a href="javascript:void(0)" data-page="0" onclick="changePage(this)">«</a></li><li class="active"><a href="javascript:void(0)" data-page="0" onclick="changePage(this)">1</a></li><li class="disabled"><a href="javascript:void(0)" data-page="0" onclick="changePage(this)">»</a></li></ul>
        </div>
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