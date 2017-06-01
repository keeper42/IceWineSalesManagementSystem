function adda(e)
{
	var txt = parseInt(document.getElementById('addGoods').value);
	if (isNaN(txt)) {
		$("#addGoods").val(1);
		return ;
	}
	var current = e.value;
	var res = '';
	if(current == '-')
	{
		if(txt > 1)
		{
			res = txt - 1;
		}else
		{
			res = txt;
		}
	}
	else if(current == '+')
	{
		var max = parseInt(STOCK);
		if (txt > max - 1) {
			res = txt;
		} else {
			res = txt + 1;			
		}
	}
	document.getElementById('addGoods').value = res;	
}

function checkNumber(e) {
	var number = $(e).val();
	if (number > STOCK) {
		$(e).val(STOCK);
	}
	if (number < 1) {
		$(e).val(1);
	}
}

function addToShopCar(e) {
	$pid = $(e).data('pid');
	$number = $("#addGoods").val();
	if ($number == 0) {
		alert("商品数量不能为0!");
		return ;
	}
	$.ajax({
	  type: "POST",
	  dataType: "html",
	  url: '/index.php/shopping/addToShopping',
	  data: 'pid=' + $pid + "&number=" + $number + '&ajax=true',
	  success: function (data) {
	  	sn = parseInt(data);
	  	if (isNaN(sn)) {
	  		alert("添加失败！" + data);
	  	} else {
	  		$("#shopNum").html(sn);
	  		alert("添加成功!");
	  	}
	  },
	  error: function(data) {
			addDangerInfo("获取数量失败~");
	  }
	});
}