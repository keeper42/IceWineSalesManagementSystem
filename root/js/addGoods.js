function add(e){
	$input = $(e).parent().find(":text:first");
	oid = $input.data('oid');
	pid = $input.data('pid');
	var txt = parseInt(document.getElementById('addGoods' + pid).value);
	var current = e.value;
	var res = '';
	if(current == '-'){
		if(txt > 1){
			$.ajax({
			  type: "POST",
			  dataType: "html",
			  url: '/index.php/order/minusAmount',
			  data: 'oid=' + oid + "&pid=" + pid,
			  success: function (data) {
			    sn = parseInt(data);
			    if (isNaN(sn)) {
			        alert("修改数量失败！" + data);
			    } else {
			        res = txt - 1;
			        document.getElementById('addGoods' + pid).value = res;
			        var single = parseInt($("#singlePrice").html());
			        var price1 = document.getElementById("price1");
			        price1.innerHTML = "<em>"+ parseFloat(res*single) +"</em>";
			        var express = parseInt(document.getElementById("express").innerHTML);
			        var price2 = document.getElementById("price2");
			        price2.innerHTML = "<em>"+ parseFloat(res*single+express) +"</em>";
			        var price3 = document.getElementById("price3");
			        price3.innerHTML = parseFloat(res*single+express);
			    }
			  },
			  error: function(data) {
			      alert("修改数量失败~" + data.responseText);
			  }
			});
			
		}
	}else if(current == '+'){
		$.ajax({
		  type: "POST",
		  dataType: "html",
		  url: '/index.php/order/addAmount',
		  data: 'oid=' + oid + "&pid=" + pid,
		  success: function (data) {
		    sn = parseInt(data);
		    if (isNaN(sn)) {
		        alert("修改数量失败！" + data);
		    } else {
		    		res = txt + 1;
		        document.getElementById('addGoods' + pid).value = res;
		        var single = parseInt($("#singlePrice").html());
		        var price1 = document.getElementById("price1");
		        price1.innerHTML = "<em>"+ parseFloat(res*single) +"</em>";
		        var express = parseInt(document.getElementById("express").innerHTML);
		        var price2 = document.getElementById("price2");
		        price2.innerHTML = "<em>"+ parseFloat(res*single+express) +"</em>";
		        var price3 = document.getElementById("price3");
		        price3.innerHTML = parseFloat(res*single+express);
		    }
		  },
		  error: function(data) {
		      alert("修改数量失败~" + data.responseText);
		  }
		});
	}
}