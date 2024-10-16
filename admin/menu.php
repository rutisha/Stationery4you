<?php  
session_start(); 
  
?>  

<?php  if(!$_SESSION['aname'])  
        {  
          header("Location: pages-sign-in.php"); 
         }  ?>
	<?php include('header.php'); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Add Menu </h1>
                    <div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<form action="" method="POST" enctype="multipart/form-data" class="eform">
                                    <label><b>Menu text:</b></label> <br>
                                    <input type="text" name="mtext" id="title" size="100" required ><br><br><br>

                                    <label><b>URL:</b></label> <br>
                                    <input type="text" name="url" id="title" size="100" required ><br><br> <br>
                                     
                                    <label><b>Orber Number:</b></label> <br>
                                    <input type="text" name="order" id="title" size="100" required ><br><br> <br>

                                    <input type="checkbox" name="parentid" id="parentid" >
                                    <label><b>- Select Parent</b></label> <br><br><br>

                                    <?php 
                                     require('conn.php');
                                     $sql = " SELECT * FROM menu WHERE parent_id ='0'";
                                     $result = $conn->query($sql);
                                     if ($result->num_rows > 0) {
                                    ?>

                                    <select id='parent' name="parent">
                                        <?php while($row = $result->fetch_assoc()) { ?>
                                    <option value="<?php echo $row["ID"]; ?>"><?php echo "$row[text]"?></option> <?php } ?>
                                    </select>  <br><br><br>
                                    <?php } ?>

                                    <label><b>Add Menu Type:</b></label> <br>
                                    <select name="type" id="parent">
                                           <option value="footer">Footer</option>
                                           <option value="header">Header</option>
                                           
                                    </select> <br><br><br>

                                     <input type="submit" id="sub" name="Submit" value="Submit">

                                    </form>
                                    </div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

            <?php include('footer.php'); ?>
            <script src="js/jquery-3.4.1.min.js"></script>
            <script>
             jQuery(document).ready(($) => {
            $('#parent').hide();
            $('#parentid').bind('change', function () {
            if ($(this).is(':checked')) {
                $('#parent').show();
            } 
            else {
                $('#parent').hide();
            } 
            }); 
          });
           </script>
            <?php
    require('conn.php');
    if(isset($_POST['Submit'])){
    
    $Menu_text = $_REQUEST['mtext'];
    $Url = $_REQUEST['url'];
    $Order =$_REQUEST['order'];
    $Menu_type = $_REQUEST['type'];

    if(isset($_POST['parentid']))
    {
        $Parent_ID = $_POST['parent'];
        $sql = "INSERT INTO `menu`(`ID`, `text`, `url`, `parent_id`, `display_order`, `menu_type`)VALUES (NULL,'$Menu_text','$Url','$Parent_ID','$Order','$Menu_type')";
        if(mysqli_query($conn, $sql)){
            echo "Data stored with parent ID successfully.";
          } else{
            echo "ERROR: Hush! Sorry $sql."
                . mysqli_error($conn);
        } 
    }
    else {
    $sql = "INSERT INTO `menu`(`ID`, `text`, `url`, `parent_id`, `display_order`, `menu_type`) VALUES (NULL,'$Menu_text','$Url',DEFAULT,'$Order','$Menu_type')";
    if(mysqli_query($conn, $sql)){
       echo "Data stored in a successfully.";
     } else{
       echo "ERROR: Hush! Sorry $sql."
           . mysqli_error($conn);
   } 
   }
}
   mysqli_close($conn);
         ?>
  
		</div>
	</div>

	<script src="js/app.js"></script>
