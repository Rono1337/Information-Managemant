<!DOCTYPE html>
<html>
	<head>
		<title>Page Title</title>
		
		<style>
			
		.th{
			background-color:#005f00bf;
			color:white;
			padding: 10px 30px 10px 55px;
			text-align:center;
		}
		.th2{
			background-color:#ccffcc;
			text-align:center;
		}
		.th3{
			background-color:#eeffcc;
			text-align:center;
		}
		.th4{
			background-color:#fff2cc;
			text-align:center;
		}
		.inpu input[type=text] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			background-color:red;
		}
		.form{
			padding: 5px 10px 5px;
			margin:30px 15px 5px 2px;
		}
		.form_top{
			padding: 5px 10px 5px;
			margin:10px 25px 5px 2px;
		}
		.upd{
			background-color:#00e6e6;
			padding:5px 6px;
		}
		.f{
			background-color:#71ceea;
			width:1150px;
		}
		.position{
			padding-left:88px;
		}
		.upda{
			background-color:#3399ff;
			padding:5px 10px 5px 10px;
			color:#fff;
			font-weight:bolder;
		}
			
		</style>
	</head>
	<body>
		<div class="position">
	
		<?php
		// db connect
			$db_connect = new mysqli("localhost", "root", "", "job");
		
		//data insert
			
			if(isset($_POST['send'])){
				
				$id = $_POST['id'];
				$name = $_POST['name'];
				$tution = $_POST['tution'];
				$overtime = $_POST['overtime'];
				$salary = $_POST['salary'];
				$insert = "INSERT INTO employer (id, name, tution, overtime, salary) VALUES (null, '$name', '$tution', '$overtime', '$salary')";
				if(mysqli_query($db_connect, $insert)){
					echo "Inserted";
					header("Location: index.php");
				}else{
					echo "Not Inserted";
				}
			}
		// data Delete
			if(isset($_POST['delete'])){
			$delete = "DELETE FROM employer WHERE id='".$_POST['delete2']."' ";
			if(mysqli_query($db_connect, $delete)){
				echo "Deleted";
				header("Location: index.php");
			}else{
				echo "Not Delete";
				}
			}
			// data Edit or update
			
			if(isset($_POST['update'])){
					
					$id = $_POST['id'];
					$name = $_POST['name'];
					$tution = $_POST['tution'];
					$overtime = $_POST['overtime'];
					$salary = $_POST['salary'];
					$update = "UPDATE employer SET id='$id', name='$name', tution='$tution', overtime='$overtime', salary='$salary' WHERE id='".$_POST['id']."' ";
					if(mysqli_query($db_connect, $update)){
						
						echo "Updated";
					}else{
						echo "Not Update";
					}
				}
				
			if(isset($_POST['edit2'])){
			$edit2 = $_POST['edit2'];
			$output_sql_id = "SELECT * FROM employer WHERE id = '$edit2' ";
			$show_output = mysqli_fetch_assoc(mysqli_query($db_connect, $output_sql_id));
		
			}
		
		
				
			// calculate of persentige
			if(isset($_POST['cal'])){
				$ac_id = $_POST['per_id'];
				$ac_total = $_POST['per_total'];
				$ac_per = $_POST['per'];
				$ac_d = $ac_total / 100;
				$result = $ac_d * $ac_per;
				
			}	
			
	
		?>		
		<form action="" method="POST" class="f">
			<center>
				<h1 style="color:#000;">Information</h1>
				<input class="form_top" type="text" name="find" placeholder="Findout Your Data">
				<input class="upda" type="submit" name="search" value="Search">
				<?php
					if(isset($_POST['search'])){
						$find = $_POST['find'];
						$data_select = "SELECT COUNT(*) FROM employer WHERE name like '%$find%' or id like '%$find%' ";
						$s_result = mysqli_fetch_row(mysqli_query($db_connect, $data_select));
						if($s_result[0] > '0'){
							echo '<p style="color:green;">"'.$find.'". ('.$s_result[0].') Iteam found.</p>';
						}else{
							echo '<p style="color:red;">"'.$find.'". No result found.</p>';
						}
					}
				?>
			</center>

			<input class="form" type="text" name="id" placeholder="ID" value="<?php if(!empty($show_output['id'])){ echo $show_output['id']; } ?>">
			<input class="form" type="text" name="name" placeholder="Name" value="">
			<input class="form" type="number" name="tution" placeholder="Tution" value="">
			<input class="form" type="number" name="overtime" placeholder="Over Time" value="">
			<input class="form" type="number" name="salary" placeholder="Salary" value="">
			
			<?php
				if(isset($_POST['edit'])){
					echo "<input class='upda' type='submit' name='update' value='Update'>";
				}else{
					echo "<input class='upda' type='submit' name='send' value='Submit'>";
				}
			?>
		</form>
		
		
		
		<table >
		
			<tr>
				<th style="background-color:green; color:white; padding: 10px; text-align:center;">ID</th>
				<th class="th">Name</th>
				<th class="th">Tution</th>
				<th class="th">Over Time</th>
				<th class="th">Salary</th>
				<th class="th">Total</th>
				<th class="th">Persentige</th>
				<th class="th">Persentige</th>
				<th style="background-color:green; color:white; padding: 10px; text-align:center;">Delete</th>
				<th style="background-color:green; color:white; padding: 10px; text-align:center;">Edit</th>
			</tr>
			
			

			<?php 
			// data output
			if(isset($_POST['search'])){
				$find = $_POST['find'];
				$data_select = "SELECT * FROM employer WHERE name like '%$find%' or id like '%$find%' ";
			}else{
				$data_select = "SELECT *  FROM employer";
			}			
			$query = mysqli_query($db_connect, $data_select);
			while($show = mysqli_fetch_assoc($query)){ ?>
				
			<tr>
			
				<td class="th2"><?php echo $show['id']; ?></td>
				<td class="th3"><?php echo $show['name']; ?></td>
				<td class="th4"><?php echo $show['tution']; ?></td>
				<td class="th3"><?php echo $show['overtime']; ?></td>
				<td class="th4"><?php echo $show['salary']; ?></td>
				<td class="th3"><?php echo $show['tution'] + $show['salary'] + $show['tution'] ; ?></td>
				
				<td class="th4"><?php if(!empty($ac_id) and $show['id'] == $ac_id){ echo $result." " ." ( " .$ac_per ."%" ." ) "; }  ?></td>

				<td class="th3">
					<form action="" method="POST">
						<input type="hidden" name="per_id" value="<?php echo $show['id']; ?>">
						<input type="hidden" name="per_total" value="<?php echo $show['tution'] + $show['salary'] + $show['tution']; ?>">
						<input style="background-color:#eeffcc; width:30px;" type="text" name="per">
						<input style="width:115px; background-color:#e4ffaf;" type="submit" name="cal" value="Calculate">
					</form>
				</td>
				
				<td class="th4">
					<form action="" method="POST">
						<input type="hidden" name="delete2" value="<?php echo $show['id']; ?>">
						<input style="background-color:#fb121275;" type="submit" name="delete" value="Delete">
					</form>
				</td>
				
				<td class="th3">
					<form action="" method="POST">
						<input type="hidden" name="edit2" value="<?php echo $show['id']; ?>">
						<input style="background-color:#affd144f;" type="submit" name="edit" value="Edit">
					</form>
				</td>
				
			
			</tr>
			<?php } ?>
		
			
		</table>
	

		</div>
	</body>
</html>