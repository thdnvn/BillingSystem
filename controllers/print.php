<?php
	session_start();
	if(!isset($_SESSION['uname']))
		header("location:/views/login.php");
?>
<html>
<body style='font-size:10px'>
<style type=text/css>
	td
	{
		width:50px;
		height:1px;
		text-align:center;
	}
</style>
	<div style='border:3px black solid;'>
		<div style='font-size:12px;text-align:center'>ENGINEERING COLLEGE COOPERATIVE STORE,R-51</div>
		<div style='font-size:10px;text-align:center'>GOVT. ENGINEERING COLLEGE,THRISSUR-9,
		Ph:0487-2334637,Email:gect_society@yahoo.com</div><br>
		<?php
			$date=date('d-m-y');
			echo "Invoice Number:$_GET[billNo]<br>Date:$date<br>"
		?>

		<table style='font-size:9px' cellpadding=0px>
		<tr>
			<th>Sl no</th>
			<th>Code</th>
			<th>Item</th>
			<th>Rate<br>of Tax</th>
			<th>Unit<br>Price</th>
			<th>Qty</th>
			<th>Gross<br>Value</th>
			<th>MRP</th>
			<th>Net<br>Value</th>
			<th>Tax<br>Amount</th>
			<th>Total</th>
		</tr>
<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$con=new database;
	$reply=$con->query("SELECT DISTINCT billto FROM invoices WHERE billNo='$_GET[billNo]'");
	$row=mysql_fetch_assoc($reply);
	if($row!=0)
	{
		echo "Name:$row[billto]<br>";
	}
	$reply=$con->query("SELECT * FROM invoices WHERE billNo='$_GET[billNo]'");
	$totalUP=0;
	$totalQty=0;
	$totalGross=0;
	$totalTax=0;
	$totalMrp=0;
	$total=0;
	$user='';
	if($reply!=0)
	{
		while($row=mysql_fetch_assoc($reply))
		{
			$gross=$row['unitPrice']*$row['qty'];
			$item=substr($row['name'],0,15);
			echo "
			<tr>
				<td>$row[slNo]</td>
				<td>$row[code]</td>
				<td>$item</td>
				<td>$row[rateOfTax]</td>
				<td>$row[unitPrice]</td>
				<td>$row[qty]</td>
				<td>$gross</td>
				<td>$row[mrp]</td>
				<td>$gross</td>
				<td>$row[taxAmt]</td>
				<td>$row[total]</td>
			</tr>
			";
			$totalGross+=$gross;
			$totalUP+=$row['unitPrice'];
			$totalQty+=$row['qty'];
			$totalTax+=$row['taxAmt'];
			$totalMrp+=$row['mrp']*$row['qty'];
			$user=$row['user'];
			$billto=$row['billto'];
		}
		$total=round($totalGross+$totalTax,0);
		echo "
		<tr>
			<th></th>
			<th>TOTAL</th>
			<th></th>
			<th></th>
			<th>$totalUP</th>
			<th>$totalQty</th>
			<th>$totalGross</th>
			<th></th>
			<th></th>
			<th>$totalTax</th>
			<th>$total</th>
		</tr>
		</table>
		";
		$totalMrp=$totalMrp-$total;
	echo "<hr><h5 align=right >BILL AMOUNT:$total</h5><hr>";
	echo "You saved Rs.$totalMrp!!<br>Billed by $user<br><hr>";
	echo "<div style=font-size:8>DEVELOPED BY CSE 2010-14 GEC Thrissur</div>";
	}

?>
	</div>
	<script language=javascript>
		window.print();
	</script>
</body>
</html>
