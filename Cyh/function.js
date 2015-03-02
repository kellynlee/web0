// window.onload=function(){
// 	var oBtn = document.getElementById('bt6');
// 	var sHeight=document.documentElement.scrollHeight;
// 	var sWidth = document.documentElement.scrollWidth;

// 	var oMask = document.createElement('div');
// 	oMask.id='mask';
// 	oMask.style.height=sHeight+'px';
// 	oMask.style.width=sWidth+'px';
// 	document.body.appendChild(oMask);
// }


//iframe自适应高度
function iframeHeight(){
	var ifm= document.getElementById("mainFrame");

        var subWeb = document.frames ? document.frames["mainFrame"].document :ifm.contentDocument;

            if(ifm != null && subWeb != null) {

            ifm.height = subWeb.body.scrollHeight;
        }
}

//弹出层效果
function Pop(){
	var body=window.top.document.getElementsByTagName('body')[0];
	var oDiv = window.top.document.createElement('div');
	oDiv.id='oDiv';
	oDiv.innerHTML='<input type="image" src="images/cancel.png" onclick="Popout();"  id="sBtn"></input>';
	oDiv.className="pop";
	body.insertBefore(oDiv,body.firstChild);
	var sHeight=body.scrollHeight;
	var sWidth = body.scrollWidth;
	var oMask = window.top.document.createElement('div');
	oMask.id='mask';
	oMask.className="mask";
	body.insertBefore(oMask,body.firstChild);
}
function Popout(){
	var body=window.top.document.getElementsByTagName('body')[0];
	body.removeChild(body.firstChild);
	body.removeChild(body.firstChild);
}
// 下拉层注册登录
function tooltip(){

	var body=window.top.document.getElementsByTagName('body')[0];
	var oDiv = window.top.document.createElement('div');
	oDiv.id='oDiv';
	oDiv.innerHTML='<input type="image" src="images/cancel.png" onclick="Popout();" id="sBtn" ></input><p id="title">登录</p><input type="textarea" id="accountname" placeholder="用户名/手机号"></input><input type="textarea" id="password" placeholder="密码"></input><input type="button" value="登 录" class="submit"></input><input type="checkbox" id="checkbox"></input><p id="readonly">下次自动登录</p>';
	oDiv.className="tooltip";
	body.insertBefore(oDiv,body.firstChild);
	var sHeight=body.scrollHeight;
	var sWidth = body.scrollWidth;
	var oMask = window.top.document.createElement('div');
	oMask.id='mask';
	oMask.className="mask";
	body.insertBefore(oMask,body.firstChild);
}
function rmtooltip(){
	var body=window.top.document.getElementsByTagName('body')[0];
	body.removeChild(body.firstChild);
	body.removeChild(body.firstChild);

    
}