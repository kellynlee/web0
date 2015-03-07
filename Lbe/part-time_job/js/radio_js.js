var rad_type = document.getElementById('rtype');
var rad_time = document.getElementById('rtime');
function check_radio()
{  
	for(i = 0;i<rad_time.length;i++)
  {	
  	if (rad_time[i].checked == true)
  	{
  		var chosed_time = rad_time[i];
  	}else
  	return false;
    }
   for (a = 0;a<rad_type.length;a++)
   {
   	if (rad_type[a].checked ==true)
   		var chosed_type = rad_type;
   }else
   return false;
 
   function load()
   {
   	var a = chosed_type;
   	var b = chosed_time;
   	rad_type.onclick = 
   }
  }