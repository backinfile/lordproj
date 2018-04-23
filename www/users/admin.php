<?php
	if (!(isset($_GET['pwd']) and $_GET['pwd'] == '123456')) {
		header("location:../index.html");
	}
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
		<link rel="stylesheet" href="../lib/weui/lib/weui.min.css">
		<link rel="stylesheet" href="../lib/weui/css/jquery-weui.css">
		<script src="../lib/weui/lib/jquery.js"></script>
		<script src="../lib/weui/lib/fastclick.js"></script>
		<script src="../lib/weui/js/jquery-weui.js"></script>
		<script src="./js/function.js"></script>
	</head>
	<body ontouchstart>
	<br/>
	<div class="weui-cells">
	  <a class="weui-cell weui-cell_access" href="../interface/download_users.php">
		<div class="weui-cell__bd">
		  <p>下载用户表</p>
		</div>
		<div class="weui-cell__ft">
		</div>
	  </a>
	  <a class="weui-cell weui-cell_access" href="../interface/download_orders.php">
		<div class="weui-cell__bd">
		  <p>下载账单表</p>
		</div>
		<div class="weui-cell__ft">
		</div>
	  </a>
	  <a class="weui-cell weui-cell_access" onclick="modify()">
		<div class="weui-cell__bd">
		  <p>添加账单</p>
		</div>
		<div class="weui-cell__ft">
		</div>
	  </a>
	</div>
	<div class="weui-cells weui-cells_form">
	  <div class="weui-cell weui-cell_vcode">
		<div class="weui-cell__hd">
		  <label class="weui-label">账单id</label>
		</div>
		<div class="weui-cell__bd">
		  <input class="weui-input" type="number" placeholder="请输入账单id" id='id'>
		</div>
		<div class="weui-cell__ft">
		  <button class="weui-vcode-btn" onclick="modify2()">修改账单</button>
		</div>
	  </div>
	</div>
	<div id="order" class="weui-popup__container">
	  <div class="weui-popup__overlay"></div>
	  <div class="weui-popup__modal">
		<div class="weui-cells weui-cells_form">
		  <br/>
		  
		  <div class="weui-cell">
			<div class="weui-cell__hd">
			  <label class="weui-label">金额</label>
			</div>
			<div class="weui-cell__bd">
			  <input class="weui-input" id="value" placeholder="(选填)">
			</div>
		  </div>
		  
		  <div class="weui-cell ">
			<div class="weui-cell__hd">
			  <label class="weui-label">手机号</label>
			</div>
			<div class="weui-cell_bd">
			  <input class="weui-input" type="number" id="phone" placeholder="(必填)" >
			</div>
		  </div>
		  
		  <div class="weui-cell">
			<div class="weui-cell__hd">
			  <label class="weui-label">产品种类</label>
			</div>
			<div class="weui-cell__bd">
			  <input class="weui-input" id="service" placeholder="(必填)">
			</div>
		  </div>
		  
		  <div class="weui-cell weui-cell_select weui-cell_select-after">
			<div class="weui-cell__hd">
			  <label class="weui-label">账单状态</label>
			</div>
			<div class="weui-cell__bd">
			  <select class="weui-select" name="select2" id='state'>
				<option value="0">正在受理</option>
				<option value="1">成功受理</option>
				<option value="2">失败</option>
			  </select>
			</div>
		  </div>
		  
		  
		  <div class="weui-cell">
			<div class="weui-cell__hd">
			  <label class="weui-label">返利金额</label>
			</div>
			<div class="weui-cell__bd">
			  <input class="weui-input" id="reward" placeholder="(选填)">
			</div>
		  </div>
		  
		  <div class="weui-cell weui-cell_select weui-cell_select-after">
			<div class="weui-cell__hd">
			  <label class="weui-label">是否已经返利</label>
			</div>
			<div class="weui-cell__bd">
			  <select class="weui-select" name="select2" id='is_rewarded'>
				<option value="0">未返利</option>
				<option value="1">已返利</option>
			  </select>
			</div>
		  </div>
		  
		  <div class="weui-cell">
			<div class="weui-cell__hd">
			  <label class="weui-label">备注</label>
			</div>
			<div class="weui-cell__bd">
			  <input class="weui-input" id="note" placeholder="(选填)">
			</div>
		  </div>
			
		  </div>
		  
		<div class="weui-btn-area">
		  <a class="weui-btn weui-btn_primary" onclick="submit()">提交</a>
		  <a href="javascript:;" class="weui-btn weui-btn_primary close-popup">取消</a>
		</div>
	  </div>
	</div>
	<div class="weui-footer weui-footer_fixed-bottom" style="background-color:white">
	  <p class="weui-footer__links">
		<a href="../interface/init_db.php" class="weui-footer__link">清空数据库</a>
	  </p>
	  <p class="weui-footer__text">Copyright © 2008-2016 weui.io</p>
	</div>
	<script>
		var m = 1;
		function modify() {
			m = 1;
			$("#order").popup();
		}
		function modify2() {
			var id = $('#id').val();
			console.log(id);
			$.hideLoading();
			$.showLoading();
			$.ajax({
				type: 'POST',
				url: '../interface/request.php',
				data: {'request':'queryorder3','id':id},
				dataType: 'json'
			}).success(function(data){
				if (data['state'] && data['data'].length) {
					data = data['data'][0];
					$('#phone').val(data['phone']);
					$('#state').val(data['state']);
					$('#service').val(data['service']);
					$('#reward').val(data['reward']);
					$('#is_rewarded').val(data['is_rewarded']);
					$('#value').val(data['value']);
					$('#note').val(data['note']);
					$.hideLoading();
					m = 2;
					$("#order").popup();
				} else {
					$.hideLoading();
					$.toptip("账单id不正确");
				}
			}).error(function(err){
				$.hideLoading();
				$.toptip("服务器错误");
			});
		}
		function submit() {
			var data = {'state':$('#state').val()};
			data['service'] = $('#service').val();
			data['phone'] = $('#phone').val();
			data['is_rewarded'] = $('#is_rewarded').val();
			data['reward'] = $('#reward').val();
			data['value'] = $('#value').val();
			data['note'] = $('#note').val();
			if (m == 1) {
				$.showLoading();
				data['request'] = 'insertorder';
				console.log(data);
				$.ajax({
					type: 'POST',
					url: '../interface/request.php',
					'data': data,
					dataType: 'json'
				}).success(function(data){
					console.log(data);
					$.hideLoading();
					$.toptip('提交成功', 'success');
					setTimeout(function(){location.reload();}, 1000);
				}).error(function(err){
					console.log(err);
					$.hideLoading();
					$.toptip("服务器错误");
				});
			} else if (m == 2) {
				$.showLoading();
				data['request'] = 'updateorder';
				data['id'] = $('#id').val();
				$.ajax({
					type: 'POST',
					url: '../interface/request.php',
					'data': data,
					dataType: 'json'
				}).success(function(data){
					console.log(data);
					$.hideLoading();
					$.toptip("修改成功","success");
					setTimeout(function(){location.reload();}, 1000);
				}).error(function(err){
					console.log(err);
					$.hideLoading();
					$.toptip("服务器错误");
				});
			}
		}
	</script>
	</body>
</html>