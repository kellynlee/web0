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
	oDiv.innerHTML='<input type="button" onclick="Popout();" value="cancel" id="sBtn"></input>';
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
	if(body.firstChild.id!='ooDiv'){
    var oDiv =window.top.document.createElement('div');
    oDiv.id='ooDiv';
    oDiv.className='tooltip';
    body.insertBefore(oDiv, body.firstChild); 
    }
}
function rmtooltip(){
	alert("gosh");
	var body=window.top.document.getElementsByTagName('body')[0];
	var x =event.clientX;
	var y = event.clientY;
	var oDiv= body.firstChild;
	var divx1 = oDiv.offsetLeft; 
    var divy1 = oDiv.offsetTop; 
    var divx2 = oDiv.offsetLeft + div.offsetWidth; 
    var divy2 = oDiv.offsetTop + div.offsetHeight; 
    if( x < divx1 || x > divx2 || y < divy1 || y > divy2){  
    	alert("mmd");
	body.removeChild(body.firstChild);
    }
    
}