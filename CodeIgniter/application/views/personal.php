<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>个人中心</title>
  <!-- 引入 Bootstrap -->
  <link href="/css/tether.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- HTML5 Shim 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
    <!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
    <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  <link href="/css/font-awesome.css" rel="stylesheet">
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
      <li><a href="/index.php/shopping">购物车</a></li>
      <li><a href="/index.php/personal">个人中心</a></li>
    </div>
  </div>
  
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
          <label class="col-sm-2 control-label">邮箱</label>
          <div class="col-sm-10" style="width: 50%;">
            <input type="text" class="form-control" placeholder="email" value="<?php echo $user->name ?>@email.com">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">手机</label>
          <div class="col-sm-10" style="width: 50%;">
            <input type="text" class="form-control" placeholder="phone" value="13087654321">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">送货地址</label>
          <div class="col-sm-10" style="width: 50%;">
            <input type="text" class="form-control" placeholder="address" value="广东省深圳市南山区深圳大学">
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

</body>
<!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
<script src="/js/jquery.min.js"></script>
<!-- 包括所有已编译的插件 -->
<script src="/js/bootstrap.min.js"></script>
</html>