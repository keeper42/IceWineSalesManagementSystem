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
  <!-- Status bar -->
  <div id="wrapper">
    <nav>
      <ul class="list-group" id="nav-list">
        <li class="person-info">
          <a href="#"><img src="<?php echo $user->avatar ?>" alt="" id="avatar" class="img-circle" width="100" height="100"></a>
          <p class="lead" style="margin-bottom: 0px;"><a href="#"><?php echo $user->name ?></a></p>
          <a class="btn btn-danger" id="logout" href="/index.php/home/logout">logout</a>
        </li>
        <li class="list">
          <a href="/index.php/manager" data-target="products">
            <i class="fa fa-group"></i>
            <span style="font-size: 16px">员工管理</span>
          </a>
        </li>
        <li class="list menu-focus">
          <a href="/index.php/financeManage" data-target="finance">
            <i class="fa fa-money" aria-hidden="true"></i>
            <span style="font-size: 16px">财务管理</span>
          </a>
        </li>
        <!--统计图表-->
        <li class="list">
          <a href="/index.php/statistics" data-target="statistics">
            <i class="fa fa-bar-chart-o" aria-hidden="true"></i>
            <span style="font-size: 16px">统计图表</span>
          </a>
        </li>
        <li class="list">
          <a href="/index.php/managerPersonal" data-target="personal">
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

      <div id="finances" class="" style="margin-top: 20px">
        <h3 style="font-weight: bold; margin-left: 10px;margin-bottom: 20px;">财务管理</h3>
        <div>
          <table class="table table-striped table-hover" id="finance-list">
            <thead>
              <tr>
                <th>订单编号</th>
                <th>经手人</th>
                <th>处理时间</th>
                <th> 金额 </th>
                <th width="150">利润</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div style="float: right">
          <button type="button" onclick="method1('finance-list')" class="btn btn-primary" style="margin-right: 60px"><i class="fa fa-bar-chart-o"></i>&nbsp;流水报表&nbsp;</button>
        </div>
        <br>
        <!-- Load the contents of the tbody -->
        <div class="pagination-wrapper">
          <ul class="pagination" id="finances-pagination" data-list-url="/index.php/financeManage/getFinance" data-table="#finance-list" data-pages="0" data-num-url="/index.php/financeManage/getFinanceNum" data-current-page="0" data-single-num="10" data-render="renderFinance(data[i])"></ul>
        </div>
      </div>

      <!-- finance -->
      <div id="finance" class="clearfix hidden">
      <h3 style="font-weight: bold; margin-left: 10px;margin-bottom: 20px;">订单信息</h3>
        <form action="/index.php/product/addProduct" method="post" role="form" class="form-horizontal" id="product-data">
          <input type="number" name="pid" id="pid" value="" class="hidden">
          <div class="form-group">
            <label for="name" class="col-sm-1 control-label">订单编号:</label>
            <div class="col-sm-11">
              <input type="text" name="name" id="name" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="img" class="col-sm-1 control-label">经手人:</label>
            <div class="col-sm-11">
              <input type="text" name="img" id="img" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="price" class="col-sm-1 control-label">处理时间:</label>
            <div class="col-sm-11">
              <input type="number" name="price" id="price" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="stock" class="col-sm-1 control-label">金额:</label>
            <div class="col-sm-11">
              <input type="number" name="stock" id="stock" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="stock" class="col-sm-1 control-label">收入/支出:</label>
            <div class="col-sm-11">
              <input type="number" name="stock" id="stock" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="stock" class="col-sm-1 control-label">备注:</label>
            <div class="col-sm-11">
              <input type="number" name="stock" id="stock" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group" style="margin-right: 80px">
            <button type="button" data-loading-text="Svaing..." onclick="save(this)" class="btn btn-primary pull-right save">保存</button>
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

<script src="/js/financeManage.js"></script>
</html>