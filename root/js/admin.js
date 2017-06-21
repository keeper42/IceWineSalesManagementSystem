var productEditor;

var control = ["home", "products", "product", "delete_product"];

window.onload = function() {
	$("#menu-control").click(function() {
		$("#nav-list li").toggleClass("min");
		$(".container").toggleClass("max");
		$("nav").toggleClass("min-nav");
		$(this).blur();
	});

	productEditor = initEditor('content');
	renderPagination(false, "#products-pagination");

	// 添加切换页面事件
	$(".list a").click(function () {
		$(this).parent().parent().find('.list').removeClass('menu-focus');
		$(this).parent().addClass('menu-focus');
		var current = $(this).data("target");
		for (var i = 0; i < control.length; i++) {
			if (control[i] !== current) {
				$("#" + control[i]).addClass("hidden");
			} else if($("#" + current).hasClass("hidden")) {
				$("#" + current).removeClass("hidden");
				if (current == "products") {
					renderPagination(false, "#products-pagination");
				}
			}
		}
		$(this).blur();
	});
}

///////////////////////////////////Pagination Begin///////////////////////////
/**
 * 获取商品或购物车等的数量
 * @param {string} paginationId 分页组件的id
 * @param  {function} callback 回调函数 当执行成功后会调用该函数。
 */
function updateArticleNum(paginationId, callback) {
	$pagination = $(paginationId);
	$.ajax({
	  type: "GET",
	  dataType: "html",
	  url: $pagination.data('num-url'),
	  data: '',
	  success: function (data) {
	  	if (data != "-1") {
	  		tmpNum = parseInt(data);
	  		pages = parseInt(tmpNum / $pagination.data('single-num')) + (tmpNum % 10 > 0?1:0);
	  		currentPage = $pagination.data('current-page');
	  		while (currentPage > pages - 1 && currentPage > 0) {currentPage--;}
				$(paginationId).data('pages', pages);
				$(paginationId).data('current-page', currentPage);
	  		callback(true, paginationId);
	  	} else {
	  		addDangerInfo("获取数量失败~");
	  	}
	  },
	  error: function(data) {
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
		editor = new wangEditor(id);
		editor.config.uploadImgUrl = "/index.php/upload";
		editor.config.uploadImgFileName = 'uploadImgFile';
		editor.config.emotions = {
	    // 支持多组表情

	    // 第一组，id叫做 'default' 
	    'default': {
        title: '默认',  // 组名称
        data: '../emotions.data'  // 服务器的一个json文件url，例如官网这里配置的是 http://www.wangeditor.com/wangEditor/test/emotions.data
	    },
		};
		// 普通的自定义菜单
	  editor.config.menus = [
	    'source',
	    '|',
	    'bold',
	    'underline',
	    'italic',
	    'strikethrough',
	    'eraser',
	    'forecolor',
	    'bgcolor',
	    '|',
	    'quote',
	    'fontfamily',
	    'fontsize',
	    'head',
	    'unorderlist',
	    'orderlist',
	    'alignleft',
	    'aligncenter',
	    'alignright',
	    '|',
	    'link',
	    'unlink',
	    'table',
	    'emotion',
	    '|',
	    'img',
	    'video',
	    'location',
	    'insertcode',
	    '|',
	    'undo',
	    'redo',
	    'fullscreen'
	  ];
		editor.create();
		return editor;
}

/**
 * 保存商品
 * @param  {dom} e 执行保存操作的按钮
 */
function save(e) {
	$button = $(e);
	$button.button('loading');
	  $.ajax({
	    type: "POST",
	    dataType: "html",
	    url: '/index.php/product/addProduct',
	    data: $('#product-data').serialize(),
	    success: function (data) {
	    	$button.button('reset');
	    	if (data < 0) {
	    		addDangerInfo("error:" + data);
	    		return ;
	    	}
	  		$("#pid").val(data);
	  		$dom = addSuccessInfo("Save product successfully~~");
	  		$dom.delay(1000).hide(1000, function() {
	  			$(this).remove();
	  		});
	    },
	    error: function(data) {
	    	$button.button('reset');
	    	addDangerInfo("error:" + data.responseText);
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
 * @param {string} info 要显示的消息
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
 * 从服务器获取商品或购物车等的数据
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
 * 生成一行product信息
 * @param  {json} data 单个produuct信息
 * @return {[dom]}      product的tr节点
 */
function renderProduct(data) {
	return $('<tr><td><a href="#" data-pid=' + data.id + ' onclick="editProduct(this)">' 
		+ data.id + '</a></td><td><a href="#" data-pid=' + data.id + ' onclick="editProduct(this)">' 
		+ data.name + '</a></td><td><span>' + data.instock + '</span></td></tr>');
}
/**
 * 切换到编辑商品视图
 * @param  {dom} e 触发编辑商品的按钮
 */
function editProduct(e) {
	pid = $(e).data('pid');
	publishProduct(); // 初始化编辑商品页面内容
	$("#func-name").html("");

	$dom = addInfoInfo("正在获取商品信息");
	$.ajax({
	  type: "GET",
	  dataType: "html",
	  url: '/index.php/product/getProductById',
	  data: "pid=" + pid,
	  success: function (data) {
	  	$dom.hide(1000, function() {
	  		$dom.remove();
	  	});
	  	data = $.parseJSON(data);
	  	$("#pid").val(data.id);
	  	$("#name").val(data.name);
	  	$("#img").val(data.img);
	  	$("#price").val(data.price);
	  	$("#stock").val(data.instock);
  		productEditor.$txt.html(data.description);
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
 * 切换到添加产品视图
 * 初始化内容
 */
function publishProduct() {
	$("#products").addClass("hidden");
	$("#product").removeClass("hidden");
	$("#delete_product").addClass("hidden");
	$("#func-name").html("");
	$("#pid").val("");
	$("#name").val("");
	$("#img").val("");
	$("#price").val("");
	$("#stock").val("");
	productEditor.$txt.html("");
}
/**
 * 切换到删除产品视图
 * 初始化内容
 */
function deleteProduct() {
	$("#products").addClass("hidden");
	$("#product").addClass("hidden");
	$("#delete_product").removeClass("hidden");
	$("#func-name").html("");
	$("#gid").val("");
}
/**
 * 删除产品
 * @param  {dom} e 执行删除操作的按钮
 */
function confirmDelete(e){
	$button = $(e);
	$button.button('loading');
	console.log($('#delete-product-data').serialize());
	$.ajax({
		type: "POST",
		dataType: "html",
		url: "/index.php/product/deleteProduct",
		data: $('#delete-product-data').serialize(),
		success: function(data){
			console.log(data);
			$button.button('reset');
			if(data < 0){
				addDangerInfo("error:" + data);
				return;
			}
			// $("#pid").val(data);
			$dom = addSuccessInfo("Delete product !!!");
	  		$dom.delay(1000).hide(1000, function() {
	  			$(this).remove();
	  		});
		},
		error: function(data) {
			$button.button('reset');
			addDangerInfo("error:" + data.responseText);
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
