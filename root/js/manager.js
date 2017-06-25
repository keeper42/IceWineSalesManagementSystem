// Created by LJF on 2017/06/19
var employeeEditor;

var control = ["home", "employees", "employee"];

// 调用函数，加载页面
window.onload = function(){
	$("#menu-control").click(function(){
		$("#nav-list li").toggleClass("min");
		$(".container").toggleClass("max");
		$("nav").toggleClass("min-nav");
		$(this).blur();
	});

	employeeEditor = initEditor('content');
	renderPagination(false, "#employees-pagination");

	$(".list a").click(function(){
		$(this).parent().parent().find('.list').removeClass('menu-focus');
		$(this).parent().addClass('menu-focus');
		var current = $(this).data('target');
		for (var i = 0; i < control.length; i++) {
			if (control[i] !== current) {
				$("#" + control[i]).addClass("hidden");
			} else if($("#" + current).hasClass("hidden")) {
				$("#" + current).removeClass("hidden");
				if (current == "employees"){
					renderPagination(false, "#employees-pagination");
				}
			}
		}
		$(this).blur();
	});
}

///////////////////////////////////Pagination Begin///////////////////////////
/**
 * 获取员工等的数量
 * @param {string} paginationId 分页组件的id
 * @param  {function} callback 回调函数 当执行成功后会调用该函数。
 */
function updateArticleNum(paginationId, callback){
	$pagination = $(paginationId);
	$.ajax({
		type: "GET",
		dataType: "html",
		url: $pagination.data('num-url'),
		data: '',
		success: function(data){
			// console.log(data);
			if(data != "-1"){
				tmpNum = parseInt(data);
				pages = parseInt(tmpNum / $pagination.data('single-num')) + (tmpNum % 10 > 0?1:0);
				currentPage = $pagination.data('current-page');
				while(currentPage > pages - 1 && currentPage > 0){
					currentPage--;
				}
				$(paginationId).data('pages', pages);
				$(paginationId).data('current-page', currentPage);
				callback(true, paginationId);
			} else{
				addDangerInfo("获取数量失败~");
			}
		},error: function(data){
			addDangerInfo("获取数量失败~");
		}
	});
}
/**
 * 更新分页状态，当前为第一页时将第一个设置为disabled, 当前为最后一页时将最后一个设置为disabled;
 * @param {string} id 分页控件Id
 * @param {int} currentPage 当前页面
 */
function updatePaginationState(id) {
	$pagination = $(id);
	currentPage = $pagination.data('current-page');
	pages = $pagination.data('pages');
	if (currentPage == 0) {
		$pagination.find(":first").addClass("disabled");
	} else {
		$pagination.find(":first").removeClass("disabled");
	}
	if (currentPage == pages - 1) {
		$pagination.children(":last").addClass("disabled");
	} else {
		$pagination.children(":last").removeClass("disabled");
	}
}
/**
 * 渲染分页组件
 * @param  {Boolean} flag    标志是否被回调
 * @param {string} paginationId 需要渲染分页组件的ID
 */
function renderPagination(flag=false, paginationId=null) {
	if (!flag) {
		updateArticleNum(paginationId, renderPagination);
		return ;
	}
	$pagination = $(paginationId);
	$pagination.children().remove();
	renderList(paginationId);
	if (pages == 0) {return ;}
	$pagination.append($('<li><a href="javascript:void(0)" data-page=0 onclick="changePage(this)">&laquo</a></li>'));
	for (var i = 1; i <= pages; i++) {
		$dom = $('<li><a href="javascript:void(0)" data-page=' + (i - 1) + ' onclick="changePage(this)">' + i + '</a></li>');
		$pagination.append($dom);
		if (i == $pagination.data('current-page') + 1) {
			$dom.addClass("active");
		}
	}
	$pagination.append($('<li><a href="javascript:void(0)" data-page=' + ($pagination.data('pages') - 1) + ' onclick="changePage(this)">&raquo</a></li>'));

	updatePaginationState(paginationId);
}
/**
 * 换页
 */
function changePage(e) {
	$li = $(e).parent();
	if ($li.hasClass("active") || $li.hasClass("disabled")) {return ;}
	currentPage = $(e).data("page");
	$pagination = $li.parent();
	$pagination.find(".active").removeClass("active");
	$pagination.find("a[data-page='" + currentPage + "']").parent().addClass("active");
	renderList($pagination.attr('id'));

	updatePaginationState($pagination.attr('id'));
}
///////////////////////////////////Pagination End///////////////////////////


/**
 * 初始化编辑器
 */
function initEditor(id) {
	// 阻止输出log
	wangEditor.config.printLog = false;
}

/**
 * 保存员工
 * @param  {dom} e 执行保存操作的按钮
 */
function save(e) {
	$button = $(e);
	$button.button('loading');
	var dateString = $('#entry_time').val();
	if(!isDate(dateString)) {
		$button.button('reset');
		addDangerInfo("error:" + data);
		$dom.delay(1000).hide(1000, function() {
	  			$(this).remove();
	  		});
		return;
	}
	console.log($('#employee-data').serialize());
	$.ajax({
		type: "POST",
		dataType: "html",
		url: "/index.php/employee/addEmployee",
		data: $('#employee-data').serialize(),
		success: function(data){
			$button.button('reset');
			if(data < 0){
				addDangerInfo("error:" + data);
				return;
			}
			// $("#pid").val(data);
			
			$dom = addSuccessInfo("Save employee successfully~~");
	  		$dom.delay(1000).hide(1000, function() {
	  			$(this).remove();
	  		});
		},
		error: function(data) {
			$button.button('reset');
			addDangerInfo("error:" + data.responseText);
			$dom.delay(1000).hide(1000, function() {
	  			$(this).remove();
	  		});
		}
	});
}
	
/**
 * 判断是否传入的字符串为日期
 * @param  {[type]}  dateString [description]
 * @return {Boolean}            [description]
 */
function isDate(dateString){
	if(dateString.trim() == "") { 
		return true;
	} 
	var reg = dateString.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/); 
	if(reg == null) {
	    alert("请输入格式正确的日期 !\n\r日期格式：yyyy-mm-dd, 例  如：2017-01-01\n\r");
		return false;
	}
	var date = new Date(reg[1], reg[3]-1, reg[4]);
	var num = (date.getFullYear() == reg[1] && (date.getMonth() + 1) == reg[3] && date.getDate() == reg[4]);
	if(num == 0) {
	    alert("请输入格式正确的日期 !\n\r日期格式：yyyy-mm-dd, 例  如：2017-01-01\n\r");
	}
	return (num != 0);
} 

////////////////////////////////////////Show a infomation Begin//////////////////////////////
/**
 * @param {string} info 要显示的消息
 */
function addSuccessInfo(info) {
	$tmp = $('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + info + '</div>');
	$("#hints").prepend($tmp);
	return $tmp;
}
/**
 * @param {string} info 要显示的消息
 */
 function addInfoInfo(info) {
 	$tmp = $('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + info + '</div>');
 	$("#hints").prepend($tmp);
 	return $tmp;
 }
 /**
 * @param {string} info 要警告的消息
 */
function addWarningInfo(info) {
	$tmp = $('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + info + '</div>');
	$("#hints").prepend($tmp);
	return $tmp;
}
/**
 * @param {string} info 要显示的消息
 */
function addDangerInfo(info) {
	$tmp = $('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + info + '</div>');
	$("#hints").prepend($tmp);
	return $tmp;
}
////////////////////////////////////////Show a infomation End//////////////////////////////

/**
 * 从服务器获取员工等的数据
 */
 function renderList(paginationId) {
 	$pagination = $(paginationId);
 	$.ajax({
 	  type: "GET",
 	  dataType: "html",
 	  url: $pagination.data('list-url'),
 	  data: "page=" + $pagination.data('current-page'),
 	  success: function (data) {
 	  	if (data == -1) {addDangerInfo(data.responseText);}
 	  	data = $.parseJSON(data);
 	  	// console.log(data);
   		// 删除现有列表
   		$tbody = $($pagination.data('table')).find("tbody");
   		$tbody.find("tr").remove();
   		for (var i = 0; i < data.length; i++) {
   			// 插入获取的数据
   			$dom = eval($pagination.data('render'));
   			$tbody.append($dom);
   		}
 	  },
 	  error: function(data) {
 	  	addDangerInfo(data.responseText);
 	  }
 	});
 }
 /**
 * 生成一行employee信息
 * @param  {json} data 单个employee信息
 * @return {[dom]}      employee的tr节点
 */
function renderEmployee(data) {
	return $('<tr><td><a href="#" data-pid=' + data.id + ' onclick="editEmployee(this)">' + data.id +
		     '</a></td><td><a href="#" data-pid=' + data.id + ' onclick="editEmployee(this)">' +  data.name 
		     + '</a></td><td><span>' + data.sex + '</span></td><td><span>' + data.position + '</span></td><td><span>' + data.wage + 
		     '</span></td><td><span>' + data.entry_time + '</span></td><td><span>' + data.contract_time + '</span></td></tr>');    
}
/**
 * 切换到编辑员工视图
 * @param  {dom} e 触发编辑员工的按钮
 */
function editEmployee(e){
	pid = $(e).data('pid');
	publishEmployee();
	$("#func-name").html("");
	$dom = addInfoInfo("正在获取商品信息");
	$.ajax({
	  type: "GET",
	  dataType: "html",
	  url: '/index.php/employee/getEmployeeById',
	  data: "pid=" + pid,
	  success: function (data) {
	  	$dom.hide(1000, function() {
	  		$dom.remove();
	  	});
	  	data = $.parseJSON(data);
	  	$("#pid").val(data.id);
	  	$("#name").val(data.name);
	  	// $("#name").attr("disabled", true);
	  	$("#sex").val(data.sex);
	  	// $("#sex").attr("disabled", true);
	  	$("#position").val(data.position);
	  	$("#wage").val(data.wage);
	  	$("#entry_time").val(data.entry_time);
	  	// $("#entry_time").attr("disabled", true);
	  	$("#contract_time").val(data.contract_time);
	  },
	  error: function(data) {
	  	$dom.hide(1000, function() {
	  		$dom.remove();
	  	});
	  	addDangerInfo(data.responseText);
	  }
	});
}
/**
 * 切换到添加员工视图
 * 初始化内容
 */
function publishEmployee() {
	$("#employees").addClass("hidden");
	$("#employee").removeClass("hidden");
	$("#dismiss_employee").addClass("hidden");
	$("#func-name").html("");
	$("#pid").val("");
	$("#name").val("");
	$("#sex").val("");
	$("#position").val("");
	$("wage").val("");
	$("entry_time").val("");
	$("contract_time").val("");
}
/**
 * 切换到解雇员工视图
 * 初始化内容
 */
function dismissEmployee() {
	$("#employees").addClass("hidden");
	$("#employee").addClass("hidden");
	$("#dismiss_employee").removeClass("hidden");
	$("#func-name").html("");
	$("#pid").val("");
	$("#name").val("");
}
/**
 * 解雇员工
 * @param  {dom} e 执行解雇操作的按钮
 */
function dismiss(e){
	$button = $(e);
	$button.button('loading');
	var pid = $('#pid').val();
	var name = $('#name').val();
	// if(pid == "" || name == "") {
	// 	alert("编号或姓名不能为空! ");
	// }
	$.ajax({
		type: "POST",
		dataType: "html",
		url: "/index.php/employee/dismissEmployee",
		data: $('#dismiss-employee-data').serialize(),
		success: function(data){
			console.log(data);
			$button.button('reset');
			if(data < 0){
				addDangerInfo("error:" + data);
				$dom.delay(1000).hide(1000, function() {
		  			$(this).remove();
		  		});
				return;
			}
			$("#pid").val(data);
			
			$dom = addSuccessInfo("Dismiss employee !!!");
	  		$dom.delay(1000).hide(1000, function() {
	  			$(this).remove();
	  		});
		},
		error: function(data) {
			$button.button('reset');
			addDangerInfo("error:" + data.responseText);
			$dom.delay(1000).hide(1000, function() {
	  			$(this).remove();
	  		});
		}
	});
}

/**
 * 全选/全不选
 * @param  {dom} e 触发该事件的控件
 */
function markAll(e) {
	$tbody = $(e).parent().parent().parent().parent().find("tbody");
	if ($(e).is(":checked")) {
		$tbody.find("input:checkbox").not(":checked").prop("checked", true);
	} else {
		$tbody.find("input:checkbox:checked").prop("checked", false);
	}
}


/**
 * 导出流水报表
 */
var idTmr;
function  getExplorer() {
	var explorer = window.navigator.userAgent ;
	if (explorer.indexOf("MSIE") >= 0) {
	 	return 'ie';
	}
	else if (explorer.indexOf("Firefox") >= 0) {
	 	return 'Firefox';
	}
	else if(explorer.indexOf("Chrome") >= 0){
		 return 'Chrome';
	}
	else if(explorer.indexOf("Opera") >= 0){
	 	return 'Opera';
	}
	else if(explorer.indexOf("Safari") >= 0){
	 	return 'Safari';
	}
}

function method1(tableid) { //整个表格拷贝到EXCEL中
	if(getExplorer()=='ie'){
	     var curTbl = document.getElementById(tableid);
	     var oXL = new ActiveXObject("Excel.Application");
	      
	     //创建AX对象excel
	     var oWB = oXL.Workbooks.Add();
	     //获取workbook对象
	     var xlsheet = oWB.Worksheets(1);
	     //激活当前sheet
	     var sel = document.body.createTextRange();
	     sel.moveToElementText(curTbl);
	     //把表格中的内容移到TextRange中
	     sel.select();
	     //全选TextRange中内容
	     sel.execCommand("Copy");
	     //复制TextRange中内容 
	     xlsheet.Paste();
	     //粘贴到活动的EXCEL中      
	     oXL.Visible = true;
	     //设置excel可见属性

	     try {
	         var fname = oXL.Application.GetSaveAsFilename("Excel.xls", "Excel Spreadsheets (*.xls), *.xls");
	     } catch (e) {
	         print("Nested catch caught " + e);
	     } finally {
	         oWB.SaveAs(fname);

	         oWB.Close(savechanges = false);
	         //xls.visible = false;
	         oXL.Quit();
	         oXL = null;
	         //结束excel进程，退出完成
	         //window.setInterval("Cleanup();",1);
	         idTmr = window.setInterval("Cleanup();", 1);

	     }
 	}else{
	     tableToExcel(tableid);
	 }
}

function Cleanup() {
     window.clearInterval(idTmr);
     CollectGarbage();
}

var tableToExcel = (function() {
   var uri = 'data:application/vnd.ms-excel;base64,',
   template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="Content-Type" charset=utf-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
     base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))); },
     format = function(s, c) {
         return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) ;
     }
     return function(table, name) {
     	if (!table.nodeType) table = document.getElementById(table);
     	var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML };
     	window.location.href = uri + base64(format(template, ctx));
   }
 })();

