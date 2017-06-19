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
        <li class="list menu-focus">
          <a href="/index.php/manager" data-target="products">
            <i class="fa fa-group" aria-hidden="true"></i>
            <span style="font-size: 16px">员工管理</span>
          </a>
        </li>
        <li class="list">
          <a href="/index.php/financeManage" data-target="finance">
            <i class="fa fa-money"></i>
            <span style="font-size: 16px">财务管理</span>
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
      <div id="employee" class="" style="margin-top: 20px;" >
      <h3 style="font-weight: bold; margin-left: 10px;margin-bottom: 20px;">员工管理</h3>
        <div>
          <table class="table table-striped table-hover" id="product-list">
            <thead>
              <tr>
                <th>员工编号</th>
                <th>姓名</th>
                <th>性别</th>
                <th>职位 </th>
                <th>工资</th>
                <th>入职时间</th>
                <th>合同时间</th>
              </tr>
            </thead>
            <tbody>
             <!--  <tr>
                <td>
                  <a href="#" data-pid="1" onclick="javascript:void(0)">20170001</a>
                </td>
                <td><span>employee</span></td>
                <td><span>男</span></td>
                <td><span>普通员工</span></td>
                <td><span>10000/月</span></td>
                <td><span>2017-06/16</span></td>
                <td><span>2年</span></td>
              </tr>
              <tr>
                <td>
                  <a href="#" data-pid="1" onclick="javascript:void(0)">20170002</a>
                </td>
                <td><span>employee2</span></td>
                <td><span>男</span></td>
                <td><span>普通员工</span></td>
                <td><span>10000/月</span></td>
                <td><span>2017-06/16</span></td>
                <td><span>2年</span></td>
              </tr> -->
            </tbody>
          </table>
        </div>
        <div style="float: right; margin-right: 50px">
            <button type="button" onclick="" class="btn btn-primary"><i class="fa fa-minus"></i>&nbsp;&nbsp;解雇员工</button>
        </div>
        <div style="float: right; margin-right: 50px">
            <button type="button" onclick="publishEmployee()" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加员工</button>
        </div>
        <br>
        <div class="pagination-wrapper">
          <ul class="pagination" id="products-pagination" data-list-url="/index.php/employee/getEmployee" data-table="#product-list" data-pages="0" data-num-url="/index.php/employee/getEmployeeNum" data-current-page="0" data-single-num="10" data-render="renderEmployee(data[i])">
          <li class="disabled"><a href="javascript:void(0)" data-page="0" onclick="changePage(this)">«</a></li><li class="active"><a href="javascript:void(0)" data-page="0" onclick="changePage(this)">1</a></li><li class="disabled"><a href="javascript:void(0)" data-page="0" onclick="changePage(this)">»</a></li></ul>
        </div>
      </div>

      <!-- Add employee -->
      <div id="product" class="clearfix hidden">
      <h3 style="font-weight: bold; margin-left: 10px;margin-bottom: 20px;">员工信息</h3>
        <form action="http://127.0.0.1/index.php/product/addProduct" method="post" role="form" class="form-horizontal" id="product-data">
          <input type="number" name="pid" id="pid" value="" class="hidden">
          <div class="form-group">
            <label for="name" class="col-sm-1 control-label">员工编号:</label>
            <div class="col-sm-11">
              <input type="text" name="name" id="name" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-1 control-label">姓名:</label>
            <div class="col-sm-11">
              <input type="text" name="name" id="name" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="img" class="col-sm-1 control-label">性别:</label>
            <div class="col-sm-11">
              <input type="text" name="img" id="img" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="price" class="col-sm-1 control-label">职位:</label>
            <div class="col-sm-11">
              <input type="number" name="price" id="price" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="stock" class="col-sm-1 control-label">薪水:</label>
            <div class="col-sm-11">
              <input type="number" name="stock" id="stock" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="stock" class="col-sm-1 control-label">入职时间:</label>
            <div class="col-sm-11">
              <input type="number" name="stock" id="stock" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="stock" class="col-sm-1 control-label">合同时间:</label>
            <div class="col-sm-11">
              <input type="number" name="stock" id="stock" class="form-control" required="required">
            </div>
          </div>
          <div class="form-group" style="margin-right: 80px">
            <button type="button" data-loading-text="Svaing..." onclick="save(this)" class="btn btn-primary pull-right save">&nbsp;保存&nbsp;</button>
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

<script src="/js/manager.js"></script>
</html>