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
        <li class="list">
          <a href="/index.php/orderManage" data-target="order">
            <i class="fa fa-reorder" ></i>
            <span style="font-size: 16px">订单管理</span>
          </a>
        </li>
        <li class="list menu-focus">
          <a href="/index.php/employeePersonal" data-target="employeePersonal">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span style="font-size: 16px">个人中心</span>
          </a>
        </li>
      </ul>
    </nav>
    
    <!-- container -->
    <div class="container">
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="page-header">个人信息</h2> 
        <form class="form-horizontal" method="post" action="" >
          <div class="form-group">
            <label class="col-sm-2 control-label">头像</label>
            <div class="col-sm-10" style="width: 50%;">
                <p>
                  <span class="pf-avatar-box">
                      <a class="pf-avatar"><img src="<?php echo $user->avatar ?>" width=72 height=72 alt="avatar"></a>
                  </span>
                </p>
                <a href="#" class="pf-edit-avatar">&nbsp;编辑头像</a>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">昵称</label>
            <div class="col-sm-10" style="width: 50%;">
              <input type="text" class="form-control" placeholder="name" value="<?php echo $user->name ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">职位</label>
            <div class="col-sm-10" style="width: 50%;">
              <input type="text" class="form-control" placeholder="address" value="普通员工">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10" style="width: 50%;">
              <input type="text" class="form-control" placeholder="email" value="<?php echo $user->name ?>@email.com">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">手机</label>
            <div class="col-sm-10" style="width: 50%;">
              <input type="text" class="form-control" placeholder="phone" value="13723493843">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-7 col-sm-1">
              <button type="submit" class="btn btn-default" onclick="alert('保存成功')">保存</button>
            </div>
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