<html>
<script language=javascript>
function request(url,arg1,mode)
{
url=url+arg1;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		if(mode==1)
		{
			var reply=eval('(' + xmlhttp.responseText + ')');
			notify(reply);
		}
   	}
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function notify(json)
{
	if(json!=false)
	{
    	document.getElementById("iname").value=json.name;
    	document.getElementById("").value=json.name;
    	document.getElementById("iname").value=json.name;
    	document.getElementById("iname").value=json.name;
    	document.getElementById("iname").value=json.name;
    	document.getElementById("iname").value=json.name;
    	document.getElementById("iname").value=json.name;
	}
}
</script>


<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("Purchase",1);
	if(isset($_SESSION['message']))
	{
	echo "
		<script type=text/javascript>
			alert('$_SESSION[message]');
			return;
		</script>";
		unset($_SESSION['message']);
	}
?>

<form method=post action=/controllers/purchase.php>
	Item Code*
	<input style=left:200px;position:absolute; type=text id=code name=code onchange=request("/controllers/billComplete.php?code=",this.value,1)><br><br>

	Item Name*<input style=left:200px;position:absolute; type=text name=iname id=iname><br><br>
	Quantity*<input style=left:200px;position:absolute; type=text name=qty id=qty><br><br>
	MRP<input style=left:200px;position:absolute;  type=text name=mrp><br><br>
	Purchase Price(per unit)*<input style=left:200px;position:absolute;  type=text name=pp ><br><br>
	Profit*<input style=left:200px;position:absolute; type=text name=profit >
	<select name=profitmode style=left:373px;position:absolute >
			<option value=0>%</option>
			<option value=1>Rs.</option>
	</select><br><br>
	Rate of Tax
	<?php
		include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
		echo "<select name=rot style=left:200px;position:absolute >
				<option value=0>0%</option>
				<option value=1>$tax1%</option>
				<option value=2>$tax2%</option>
				</select>";

	?><br><br>
	Purchased from*<textarea style=left:200px;position:absolute; name=from></textarea><br><br>
	Purchase Date<input style=left:200px;position:absolute;background:yellow; tabindex=-1 type=text id=date readonly name=date>
	<input type=hidden name=write id=write value='1'>
	<input type=submit value='Add'>
</form>
</html>
