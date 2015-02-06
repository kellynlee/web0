//iframe自适应高度
function iframeHeight(){
	var ifm= document.getElementById("mainFrame");

        var subWeb = document.frames ? document.frames["mainFrame"].document :ifm.contentDocument;

            if(ifm != null && subWeb != null) {

            ifm.height = subWeb.body.scrollHeight;
        }
}