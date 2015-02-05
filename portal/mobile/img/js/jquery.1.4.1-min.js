// JavaScript Document
<!--
function showtab(m,n,count){
	var strPic1;
	var strPic2;
	var tdcolor;
	if (m==1) {
//	strPic1='url(images/qh2.jpg)';
//	strPic2='#baec59 url(images/qh3.jpg)';
		for(var i=1;i<=count;i++){
		if (i==n){			
			getObject(m+'_'+i).style.background=strPic1;
//			getObject('td_'+m+'_'+i).style.background='#434343';
			getObject('tab_'+m+'_'+i).style.display='';
			}
		else {
			getObject(m+'_'+i).style.background=strPic2;
//			getObject('td_'+m+'_'+i).style.color='#fffff';
			getObject('tab_'+m+'_'+i).style.display='none';
			}
	}
}
	else {
		for(var i=1;i<=count;i++){
		if (i==n){			
			getObject('tab_'+m+'_'+i).style.display='';
			}
		else {
			getObject('tab_'+m+'_'+i).style.display='none';
			}
	}
}
}
function getObject(objectId) {
    if(document.getElementById && document.getElementById(objectId)) {
	// W3C DOM
	return document.getElementById(objectId);
    } else if (document.all && document.all(objectId)) {
	// MSIE 4 DOM
	return document.all(objectId);
    } else if (document.layers && document.layers[objectId]) {
	// NN 4 DOM.. note: this won't find nested layers
	return document.layers[objectId];
    } else {
	return false;
    }
} // getObject
//-->