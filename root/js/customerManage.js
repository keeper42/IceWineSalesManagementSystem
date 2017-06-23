var customerEditor;

var control = ["home", "customers", "customer"];

// 调用函数，加载页面
window.onload = function(){
	$("#menu-control").click(function(){
		$("#nav-list li").toggleClass("min");
		$(".container").toggleClass("max");
		$("nav").toggleClass("min-nav");
		$(this).blur();
	});

	customerEditor = initEditor('content');
	renderPagination(false, "#customers-pagination");

	$(".list a").click(function(){
		$(this).parent().parent().find('.list').removeClass('menu-focus');
		$(this).parent().addClass('menu-focus');
		var current = $(this).data('target');
		for (var i = 0; i < control.length; i++) {
			if (control[i] !== current) {
				$("#" + control[i]).addClass("hidden");
			} else if($("#" + current).hasClass("hidden")) {
				$("#" + current).removeClass("hidden");
				if (current == "customers"){
					renderPagination(false, "#customers-pagination");
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
	// console.log($pagination.data('num-url'));
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
	$.ajax({
		type: "POST",
		dataType: "html",
		url: "/index.php/customerManage/updateCustomer",
		data: $('#customer-data').serialize(),
		success: function(data){
			$button.button('reset');
			if(data < 0){
				addDangerInfo("error:" + data);
				return;
			}			
			$dom = addSuccessInfo("Save customer successfully~~");
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
 * 从服务器获取客户等的数据
 */
 function renderList(paginationId) {
 	$pagination = $(paginationId);
 	console.log("page=" + $pagination.data('current-page'));
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
 * 生成一行customer信息
 * @param  {json} data 单个customer信息
 * @return {[dom]}      customer的tr节点
 */
function renderCustomer(data) {
	return $('<tr><td><a href="#" data-cid=' + data.id + ' onclick="editCustomer(this)">' + data.id +
		     '</a></td><td><a href="#" data-cid=' + data.id + ' onclick="editCustomer(this)">' +  data.name 
		     + '</a></td><td><span>' + data.email + '</span></td><td><span>' + data.phone + '</span></td><td><span>'
		     + data.address + '</span></td><td><span>' + data.category + '</span></td></tr>');    
}
/**
 * 切换到编辑员工视图
 * @param  {dom} e 触发编辑员工的按钮
 */
function editCustomer(e){
	cid = $(e).data('cid');
	publishCustomer();
	$("#func-name").html("");
	$dom = addInfoInfo("正在获取客户信息");
	$.ajax({
	  type: "GET",
	  dataType: "html",
	  url: '/index.php/customerManage/getCustomerById',
	  data: "cid=" + cid,
	  success: function (data) {
	  	$dom.hide(1000, function() {
	  		$dom.remove();
	  	});
	  	data = $.parseJSON(data);
	  	$("#cid").val(data.id);
	  	$("#name").val(data.name);
	  	$("#category").val(data.category);
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
function publishCustomer() {
	$("#customers").addClass("hidden");
	$("#customer").removeClass("hidden");
	$("#func-name").html("");
	$("#cid").val("");
	$("#name").val("");
	$("#category").val("");
}

function updateCustomer() {
	$dom = addSuccessInfo("Update customer successfully~~");
	$dom.delay(1000).hide(1000, function() {
		$(this).remove();
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
