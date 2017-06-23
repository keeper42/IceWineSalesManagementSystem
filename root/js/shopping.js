/**
 * 从购物车中删除
 * @param  {dom} e 删除按钮dom
 */
function deleteShopping(e) {
    if (!confirm("确定从购物车从删除该商品?")) {
        return ;
    }
    $sid = $(e).data('sid');
    $.ajax({
      type: "POST",
      dataType: "html",
      url: '/index.php/shopping/deleteFromShopping',
      data: 'sid=' + $sid,
      success: function (data) {
        sn = parseInt(data);
        if (isNaN(sn)) {
            alert("删除失败！" + data);
        } else {
            alert("删除成功!");
            $(e).parent().parent().remove();
        }
      },
      error: function(data) {
         alert("删除失败!" + data.responseText);
      }
    });
}

/*
 * 去结算，在数据表中创建订单
 * @param  {dom} e 
 */
function createOrder() {
  	$inputs = $("#cartTable tbody input:checkbox");
  	$checked = [];
  	for (var i = 0; i < $inputs.length; i++) {
  		if ($inputs[i].checked) {
  			$checked.push($inputs[i]);
  		}
  	}
  	if ($checked.length == 0) {
  		return ;
  	}
  	var param = $checked[0].getAttribute('data-sid');
  	for (var i = 1; i < $checked.length; i++) {
  		param += '|' + $checked[i].getAttribute('data-sid');
  	}
  	window.location.href = "/index.php/order/createOrder?sid=" + param;
}

//