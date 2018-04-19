
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
function html_load_more(msg) {
	var m = msg || "暂无数据";
	return '<div class="weui-loadmore weui-loadmore_line">'
			+'<span class="weui-loadmore__tips">'+m+'</span></div>';
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