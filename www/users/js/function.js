


function check_phone(str){
	if (/^1\d{10}$/.test(str)) return true;
	return false;
}
function check_digit(str){
	if (/^\d{1,10}$/.test(str)) return true;
	return false;
}

function setCookie(cname,cvalue,exdays){
	var d = new Date();
	d.setTime(d.getTime()+(exdays*24*60*60*1000));
	var expires = "expires="+d.toGMTString();
	document.cookie = cname+"="+cvalue+"; "+expires;
}
function getCookie(cname){
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i].trim();
		if (c.indexOf(name)==0) { return c.substring(name.length,c.length); }
	}
	return "";
}
function delCookie(name) {
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval=getCookie(name);
	if(cval!=null)
	document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}
function getPar(par){
    var local_url = document.location.href; 
    var get = local_url.indexOf(par +"=");
    if(get == -1){
        return false;   
    }   
    var get_par = local_url.slice(par.length + get + 1);
    var nextPar = get_par.indexOf("&");
    if(nextPar != -1){
        get_par = get_par.slice(0, nextPar);
    }
    return get_par;
}
function html_load_more(msg) {
	var m = msg || "暂无数据";
	return '<div class="weui-loadmore weui-loadmore_line">'
			+'<span class="weui-loadmore__tips">'+m+'</span></div>';
}
function get_order_state(val) {
	var states = {'0':'正在受理','1':'成功受理','2':'失败'};
	return states[val] || null;
}
function html_order1(data) {
	var states = {'0':'正在受理','1':'成功受理','2':'失败'};
	var state = states[data['state']];
	if (!state) state = null;
	return '<div class="weui-form-preview">'+
		'<div class="weui-form-preview__hd">'+
		'<label class="weui-form-preview__label">付款金额</label>'+
		'<em class="weui-form-preview__value">'+(data['value']?data['value']:0)+'</em></div>'+
		'<div class="weui-form-preview__bd">'+
        '<div class="weui-form-preview__item">'+
          '<label class="weui-form-preview__label" >账单状态</label>'+
          '<b><span class="weui-form-preview__value" style="color:red;">'+state+'</span></b></div>'+
        '<div class="weui-form-preview__item">'+
          '<label class="weui-form-preview__label">账单id</label>'+
          '<span class="weui-form-preview__value">'+data['id']+'</span></div>'+
        '<div class="weui-form-preview__item">'+
          '<label class="weui-form-preview__label">产品种类</label>'+
          '<span class="weui-form-preview__value">'+data['service']+'</span></div>'+
        '<div class="weui-form-preview__item">'+
          '<label class="weui-form-preview__label">创建时间</label>'+
          '<span class="weui-form-preview__value">'+data['time']+'</span></div>'+
        '<div class="weui-form-preview__item">'+
          '<label class="weui-form-preview__label">修改时间</label>'+
          '<span class="weui-form-preview__value">'+data['last_time']+'</span></div>'+
        '<div class="weui-form-preview__item">'+
          '<label class="weui-form-preview__label">备注</label>'+
          '<span class="weui-form-preview__value">'+data['note']+'</span>'+
        '</div></div>'+
      '<div class="weui-form-preview__ft">'+
        //'<a class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:">操作</a>'+
      '</div></div>';
}
function html_user(phone,state) {
	return '<div class="weui-cells">'+
			'<div class="weui-cell" href="javascript:;">'+
			'<div class="weui-cell__bd">'+
			'<p>用户</p>'+
			'</div>'+
			'<div class="weui-cell__ft"  style="color:black">'+phone+'</div>'+
			'</div>'+
			'<div class="weui-cell">'+
			'<div class="weui-cell__bd ">'+
			'<p>最近订单的状态</p>'+
			'</div>'+
			'<div class="weui-cell__ft" style="color:red">'+state+'</div>'+
			'</div>'+
			'<a class="weui-cell weui-cell_access" href="./query.html">'+
			'<div class="weui-cell__bd">'+
			'<p>所有订单</p>'+
			'</div>'+
			'<div class="weui-cell__ft"></div>'+
			'</a>'+
			'</div>';
}
function html_loading() {
	return 	'<div class="weui-loadmore">'+
		  '<i class="weui-loading"></i>'+
		  '<span class="weui-loadmore__tips">正在加载</span>'+
			'</div>';
}

function html_reg() {
	return 	'<div class="weui-cells">'+
			'<div class="weui-cell" href="javascript:;">'+
			'<div class="weui-cell__bd">'+
			'<p>用户</p>'+
			'</div>'+
			'<div class="weui-cell__ft"  style="color:black">'+
			'	<a href="javascript:;" class="open-popup" data-target="#reg">'+
			'	注册/登录</a></div>'+
			'</div>'+
			'</div>';
}

function getPar(par){
	var local_url = document.location.href; 
	var get = local_url.indexOf(par +"=");
	if(get == -1){
		return false;   
	}   
	var get_par = local_url.slice(par.length + get + 1);   
	var nextPar = get_par.indexOf("&");
	if(nextPar != -1){
		get_par = get_par.slice(0, nextPar);
	}
	return get_par;
}

