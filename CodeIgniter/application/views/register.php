<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>注册</title>

	<link href="/css/tether.min.css" rel="stylesheet">
  <link href="/fonts/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
  <div class="container ">  
        <div class="form row">  
            <form class="form-horizontal col-sm-offset-3 col-md-offset-3" id="login_form" action="/index.php/account/check" method="post">
                <h3 class="form-title">&nbsp;&nbsp;&nbsp;&nbsp;免费注册</h3>  
                <h5 class="error-hint" style="color: red;">
                <?php if (isset($_SESSION['error'])) {
                  echo $_SESSION['error'];
                  unset($_SESSION['error']);
                } ?>
                </h5>
                <div class="col-sm-9 col-md-9">  
                    <div class="form-group">  
                        <i class="fa fa-user fa-lg"></i>  
                        <input class="form-control required" type="text" placeholder="username" name="username" autofocus="autofocus" maxlength="20" required="required" />  
                    </div>  
                    <div class="form-group">  
                            <i class="fa fa-lock fa-lg"></i> 
                            <input class="form-control required" type="password" placeholder="password" name="password" maxlength="8" required="required"/>  
                    </div>
                    <div class="form-group">  
                            <i class="fa fa-lock fa-lg"></i> 
                            <input class="form-control required" type="repassword" placeholder="    confirm " name="confirm password" maxlength="8" required="required"/>  
                    </div>
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group"> 
                            <button type="button" class="btn btn-default btn-success" id="submit">注册</button>
                            <input type="submit" id="real_submit" value="submit" style="display: none;">
                        </div>
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