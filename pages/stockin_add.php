<?php 
session_start();
include('../dist/includes/dbcon.php');
	$branch=$_SESSION['branch'];
	if (isset($_POST['prod_name']))
		$prod_name = $_POST['prod_name'];
	if (isset($_POST['prod_desc']))
		$prod_desc = $_POST['prod_desc'];
	if (isset($_POST['prod_cat']))
		$prod_cat = $_POST['prod_cat'];
	if (isset($_POST['supplier_id']))
		$supplier = $_POST['supplier_id'];
	if (isset($_POST['reorder']))
		$reorder = $_POST['reorder'];
	if (isset($_POST['qty']))
		$prod_qty = $_POST['qty'];
	if (isset($_POST['base_price']))
		$prod_price = $_POST['base_price'];
	if (isset($_POST['prod_imei']))
		$prod_imei = $_POST['prod_imei'];
	if (isset($_POST['prod_color']))
		$prod_color = $_POST['prod_color'];

	
	date_default_timezone_set('Asia/Manila');
	$date = date("Y-m-d H:i:s");

	$id=$_SESSION['id'];

	if (!empty($prod_imei))
	{
		$sql = mysqli_query($con, "SELECT * FROM mobile WHERE imei = '$prod_imei' AND branch_id ='$branch'")or die(mysqli_error());
		$count = mysqli_num_rows($sql);

		if ($count > 0)
		{
			echo "<script type='text/javascript'>alert('Error, this IMEI already exists. Please try again.');</script>";
			echo "<script>window.history.back();</script>";   
			return;
		}
	}

	if (((isset($_POST['furniture']) || isset($_POST['furniture_stockin1'])) && !empty($prod_color)))
	{
		$sql = mysqli_query($con, "SELECT * FROM furniture WHERE color = '$prod_color' AND branch_id ='$branch'")or die(mysqli_error());
		$count = mysqli_num_rows($sql);

		if ($count > 0)
		{
			echo "<script type='text/javascript'>alert('Error, this COLOR already exists. Please try again.');</script>";
			echo "<script>window.history.back();</script>";   
			return;
		}
	}
	
	if (isset($_POST['prod_name']) && !isset($_POST['mobile_stockin1']) && !isset($_POST['furniture_stockin1']))
	{
		$query = "SELECT * FROM product WHERE prod_name = '$prod_name' AND branch_id='$branch'";
		$sql = mysqli_query($con, $query)or die(mysqli_error());
		$count = mysqli_num_rows($sql);

			if ($count == 0)
			{
				if (isset($_POST['furniture']))
				{
					if (empty($prod_color))
					{
						mysqli_query($con, "INSERT INTO product(prod_name, prod_desc, cat_id, prod_qty, branch_id, reorder, supplier_id, base_price, type, color)VALUES('$prod_name', '$prod_desc', '$prod_cat', '$prod_qty', '$branch', '$reorder', '$supplier', '$prod_price', 'furniture', '$prod_color')")or die(mysqli_error($con));
					}
					else
					{
						mysqli_query($con, "INSERT INTO product(prod_name, prod_desc, cat_id, prod_qty, branch_id, reorder, supplier_id, base_price, type, color)VALUES('$prod_name', '$prod_desc', '$prod_cat', '1', '$branch', '$reorder', '$supplier', '$prod_price', 'furniture', '$prod_color')")or die(mysqli_error($con));
					}
				}

				if (isset($_POST['cosmetics']))
				{
					mysqli_query($con, "INSERT INTO product(prod_name, prod_desc, cat_id, prod_qty, branch_id, reorder, supplier_id, base_price, type)VALUES('$prod_name', '$prod_desc', '$prod_cat', '$prod_qty', '$branch', '$reorder', '$supplier', '$prod_price', 'cosmetics')")or die(mysqli_error($con));
				}

				if (isset($_POST['mobile']))
				{
					if (empty($prod_imei))
					{
						mysqli_query($con, "INSERT INTO product(prod_name, cat_id, prod_qty, branch_id, reorder, base_price, type, imei, color, supplier_id)VALUES('$prod_name', '$prod_cat', '$prod_qty', '$branch', '$reorder', '$prod_price', 'mobile', '$prod_imei', '$prod_color', '$supplier')")or die(mysqli_error($con));
					}
					else
					{
						mysqli_query($con, "INSERT INTO product(prod_name, cat_id, prod_qty, branch_id, reorder, base_price, type, imei, color, supplier_id)VALUES('$prod_name', '$prod_cat', '1', '$branch', '$reorder', '$prod_price', 'mobile', '$prod_imei', '$prod_color', '$supplier')")or die(mysqli_error($con));
					}
				}
				
		    	$prod_id = mysqli_insert_id($con);
			}
			else
			{
				if (!empty($prod_imei) || ((isset($_POST['furniture']) || isset($_POST['furniture_stockin1'])) && !empty($prod_color)))
				{
					mysqli_query($con, "UPDATE product SET prod_qty = prod_qty+1 WHERE prod_name = '$prod_name' AND branch_id = '$branch'")or die(mysqli_error());
				}
				else
				{
					echo "<script>alert('Item with this name is currently exists. Pick another name and try again.')</script>";
					echo "<script>window.history.back();</script>";
					return;
				}

				/*if (isset($_POST['furniture']) || isset($_POST['furniture_stockin1']))
				{
					if (!empty($prod_color))
					{
						mysqli_query($con, "UPDATE product SET prod_qty = prod_qty+1 WHERE prod_name = '$prod_name' AND branch_id = '$branch'")or die(mysqli_error());
					}
					else
					{
						echo "<script>alert('Item with this name is currently exists. Pick another name and try again.')</script>";
						echo "<script>window.history.back();</script>";
						return;
					}

					
				}*/
			}	

			if (!empty($prod_imei))
			{
				$sql = mysqli_query($con, "SELECT * FROM product WHERE prod_name = '$prod_name' AND branch_id='$branch'")or die(mysqli_error());
				$row = mysqli_fetch_array($sql);
				$id = $row['prod_id'];

				mysqli_query($con, "INSERT INTO mobile(prod_id, imei, color, branch_id)VALUES('$id', '$prod_imei', '$prod_color', '$branch')")or die(mysqli_error());
				$prod_id = $id;
			}	

			if (((isset($_POST['furniture']) || isset($_POST['furniture_stockin1'])) && !empty($prod_color)))
			{
				$sql = mysqli_query($con, "SELECT * FROM product WHERE prod_name = '$prod_name' AND branch_id='$branch'")or die(mysqli_error());
				$row = mysqli_fetch_array($sql);
				$id = $row['prod_id'];

				mysqli_query($con, "INSERT INTO furniture(prod_id, color, branch_id)VALUES('$id', '$prod_color', '$branch')")or die(mysqli_error());
				$prod_id = $id;
			}

	}	

	if (isset($_POST['furniture_stockin']) || isset($_POST['cosmetics_stockin']) || isset($_POST['mobile_stockin']))
	{
		$prod_id = $_GET['id'];
		$prod_qty = $_POST['qty'];
		mysqli_query($con, "UPDATE product SET prod_qty = prod_qty + '$prod_qty' WHERE prod_id='$prod_id' AND branch_id='$branch'")or die(mysqli_error());

		$query = mysqli_query($con, "SELECT * FROM product WHERE prod_id = '$prod_id'")or die(mysqli_error());
		$row = mysqli_fetch_array($query);
		$prod_name = $row['prod_name'];
		$prod_price = $row['base_price'];
	}

	if (isset($_POST['mobile_stockin1']))
	{
		$prod_id = $_GET['id'];
		mysqli_query($con, "UPDATE product SET prod_qty = prod_qty + 1 WHERE prod_id = '$prod_id'")or die(mysqli_error());
		mysqli_query($con, "INSERT INTO mobile(prod_id, imei, color, branch_id)VALUES('$prod_id', '$prod_imei', '$prod_color', '$branch')")or die(mysqli_error());
		$prod_qty = 1;
	}

	if (isset($_POST['furniture_stockin1']))
	{
		$prod_id = $_GET['id'];
		mysqli_query($con, "UPDATE product SET prod_qty = prod_qty + 1 WHERE prod_id = '$prod_id'")or die(mysqli_error());
		mysqli_query($con, "INSERT INTO furniture(prod_id, color, branch_id)VALUES('$prod_id', '$prod_color', '$branch')")or die(mysqli_error());
		$prod_qty = 1;
	}

	$remarks="added $prod_qty of $prod_name";  
	
	mysqli_query($con,"INSERT INTO history_log(user_id,action,date) VALUES('$id','$remarks','$date')")or die(mysqli_error($con));


	mysqli_query($con,"INSERT INTO stockin(prod_id,qty,date,branch_id,base_price) VALUES('$prod_id','$prod_qty','$date','$branch','$prod_price')")or die(mysqli_error($con));

			
	echo "<script type='text/javascript'>alert('Successfully added new stocks!');</script>";
	echo "<script>document.location='stockin.php'</script>";   
	
?>