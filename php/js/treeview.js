function display_block(ele)
{
	//alert(tid);
	var linode = ele.parentNode;
	var len = linode.childNodes.length;
	var tmp, id_index;
	for(var i=0;i<len;i++)
	{
		if(linode.childNodes[i].nodeName == 'UL')
		{
			id_index = i;
			break;
		}
	}

	var ulnode = linode.childNodes[id_index];
	var tid = $(ulnode).attr("id");
	
	tid = "#" + tid;
	//var imgele = ele.childNodes[0];
	var str = $(ele).attr("src");
	
	if(str == "images/plus.gif")
	{
		$(ele).attr("src","images/minus.gif");
		$(ele).attr("title","Collapse");
	}
	else
	{
		$(ele).attr("src","images/plus.gif");
		$(ele).attr("title","Expand");
	}
	$(tid).slideToggle(200);
}

function display_block_inside(ele)
{
	//alert(tid);
	var linode = ele.parentNode;
	var len = linode.childNodes.length;
	var tmp, id_index;
	for(var i=0;i<len;i++)
	{
		if(linode.childNodes[i].nodeName == 'UL')
		{
			id_index = i;
			break;
		}
	}

	var ulnode = linode.childNodes[id_index];
	var tid = $(ulnode).attr("id");
	
	tid = "#" + tid;
	//var imgele = ele.childNodes[0];
	var str = $(ele).attr("src");
	
	if(str == "../images/plus.gif")
	{
		$(ele).attr("src","../images/minus.gif");
		$(ele).attr("title","Collapse");
	}
	else
	{
		$(ele).attr("src","../images/plus.gif");
		$(ele).attr("title","Expand");
	}
	$(tid).slideToggle(200);
}
