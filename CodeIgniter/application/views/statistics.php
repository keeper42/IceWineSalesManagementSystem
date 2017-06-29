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
  <link rel="stylesheet" href="/css/statistics.css">
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
          <a href="/index.php/manager" data-target="employees">
            <i class="fa fa-group"></i>
            <span style="font-size: 16px">员工管理</span>
          </a>
        </li>
        <li class="list">
          <a href="/index.php/financeManage" data-target="finance">
            <i class="fa fa-money"></i>
            <span style="font-size: 16px">财务管理</span>
          </a>
        </li>
        <!--统计图表-->
        <li class="list menu-focus">
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

	<div style="width: 70%; margin-left: 300px; margin-top: 20px;">
		<ul class="nav nav-pills" style="background-color: #F0F0F0">
			<li class="active"><a href="#" id="userAnalysis">用户分析</a></li>
			<li><a href="#" id="listAnalysis">订单分析</a></li>
		</ul><br/>
		
		<!--用户分析-->
		<div id="userAnalysisDiv">
			<table class="table">
				<thead style="background-color: #F0F0F0;">
					<tr><th>顾客流通</th></tr>
				</thead>
				<tbody>
					<tr><td><div style="text-align: center;">
						<canvas id="customerChart" height="600" width="800"></canvas>
						<p>顾客流通信息</p>
					</div></td></tr>
				</tbody>
			</table>
			
			<div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>时间</th>
							<th>顾客注册人数</th>
							<th>顾客登陆人次</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>2017-06-22</td>
							<td>5</td>
							<td>15</td>
						</tr>
						<tr>
							<td>2017-06-21</td>
							<td>5</td>
							<td>15</td>
						</tr>
						<tr>
							<td>2017-06-20</td>
							<td>5</td>
							<td>15</td>
						</tr>
						<tr>
							<td>2017-06-19</td>
							<td>5</td>
							<td>15</td>
						</tr>
						<tr>
							<td>2017-06-18</td>
							<td>5</td>
							<td>15</td>
						</tr>
					</tbody>
				</table>
				<ul class="pagination center">
					<li><a href="#">&laquo;</a></li>
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul>
			</div>
		</div>
		
		<!--订单分析-->
		<div hidden="hidden" id="listAnalysisDiv">
			<div style="text-align: center;">
				<table class="table">
					<thead style="background-color: #F0F0F0;">
						<tr>
							<th>订单分析</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<canvas id="favouriteList" width="400" height="300"></canvas>
								<p>商品销售比例</p>
							</td>
							<td>
								<canvas id="valuableList" width="400" height="325"></canvas>
								<p>商品盈利比例</p>
							</td>
						</tr>
					</tbody>
				</table>
				
				<div>
					<table class="table table-striped">
						<thead>
							<tr class="mytr">
								<th>商品名称</th>
								<th>商品编号</th>
								<th>单价</th>
								<th>总库存</th>
								<th>月度销售量</th>
								<th>月度销售额</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>冰酒1</td>
								<td>1</td>
								<td>2</td>
								<td>100</td>
								<td>1</td>
								<td>2</td>
							</tr>
							<tr>
								<td>冰酒2</td>
								<td>12</td>
								<td>3</td>
								<td>300</td>
								<td>11</td>
								<td>22</td>
							</tr>
							<tr>
								<td>冰酒2</td>
								<td>12</td>
								<td>3</td>
								<td>300</td>
								<td>11</td>
								<td>22</td>
							</tr>
							<tr>
								<td>冰酒2</td>
								<td>12</td>
								<td>3</td>
								<td>300</td>
								<td>11</td>
								<td>22</td>
							</tr>
							<tr>
								<td>冰酒2</td>
								<td>12</td>
								<td>3</td>
								<td>300</td>
								<td>11</td>
								<td>22</td>
							</tr>
						</tbody>
					</table>
					<ul class="pagination center">
						<li><a href="#">&laquo;</a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">&raquo;</a></li>
					</ul>
				</div>
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

<script src="/js/manager.js"></script>
<!--绘图-->
<script src="https://cdn.bootcss.com/Chart.js/2.6.0/Chart.js"></script>

<!-- 统计 -->
<script src="/js/Chart.bundle.js"></script>
<script src="/js/utils.js"></script>
<script>
    var color = Chart.helpers.color;
	var customerData = {
		labels : ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		datasets : [
			{
				label : "注册人数",
				backgroundColor : color(window.chartColors.red).alpha(0.5).rgbString(),
				data : [65, 4657, 789, 456, 789, 8, 75, 764, 123, 89, 545, 469]
			},
			{
				label : "登录人次",
				backgroundColor : color(window.chartColors.blue).alpha(0.5).rgbString(),
				data : [652, 4673, 781, 4562, 7893, 81, 275, 764, 1223, 891, 5425, 4269]
			}
		]
	};
	
	var listData1 = {
		datasets : [{
			backgroundColor : [
			    window.chartColors.red,
                window.chartColors.green,
                window.chartColors.yellow,
                window.chartColors.orange,
                window.chartColors.blue,
                window.chartColors.purple,
                window.chartColors.grey
            ],
			data : [10, 20, 30, 40, 50, 60, 70]
		}],
		labels : ['冰酒1', '冰酒2', '冰酒3', '冰酒4', '冰酒5', '冰酒6', '冰酒7']
	}
	
	var listData2 = {
		datasets : [{
            backgroundColor : [
                window.chartColors.red,
                window.chartColors.green,
                window.chartColors.yellow,
                window.chartColors.orange,
                window.chartColors.blue,
                window.chartColors.purple,
                window.chartColors.grey
            ],
			data : [70, 60, 50, 40, 30, 20, 10]
		}],
        labels : ['冰酒1', '冰酒2', '冰酒3', '冰酒4', '冰酒5', '冰酒6', '冰酒7']
	}
	
	$(function() {
		var ctx0 = $("#customerChart").get(0).getContext("2d");
		var ctx1 = $("#favouriteList").get(0).getContext("2d");
		var ctx2 = $("#valuableList").get(0).getContext("2d");
		var $userAnalysisParent = $("#userAnalysis").parent();
		var $listAnalysisParent = $("#listAnalysis").parent();
		var $userAnalysisDiv = $("#userAnalysisDiv");
		var $listAnalysisDiv = $("#listAnalysisDiv");
		new Chart(ctx0, {
			type : 'bar',
			data : customerData
		});
		
		$("#userAnalysis").click(function() {
			if($(this).parent().hasClass("active") == false) {
				$listAnalysisParent.removeClass("active");
				$(this).parent().addClass("active");
				$userAnalysisDiv.show();
				$listAnalysisDiv.hide();
				new Chart(ctx0, {
					type : 'bar',
					data : customerData
				});
			}
		});
		
		$("#listAnalysis").click(function() {
			if($(this).parent().hasClass("active") == false) {
				$userAnalysisParent.removeClass("active");
				$(this).parent().addClass("active");
				$userAnalysisDiv.hide();
				$listAnalysisDiv.show();
				new Chart(ctx1, {
					type : 'doughnut',
					data : listData1
				});
				new Chart(ctx2, {
					type : 'doughnut',
					data : listData2
				});
			}
		})
		
	});
</script>
</html>