<?php
if(session_id() == '') {
  session_start();
} 
include 'header.php';?>

<?php 

$Search = $_POST['search'];


require('conn.php');
 $sql = "SELECT * FROM `products` WHERE `product_name` LIKE '%".$Search."%' OR `description` LIKE '%".$Search."%'   OR `product_category` LIKE '%".$Search."%' ";

 $result = $conn->query($sql); 
 if ($result->num_rows > 0) {
  
 ?>

<section class="product_section layout_padding">
    <div class="container">
      <div class="heading_container ">
             <h3>
                  Search Results for "<?php echo $Search; ?> "
             </h3>
      </div>
      <div class="row">
        <?php  while($row = $result->fetch_assoc()) {  ?>
           <div class="col-sm-6 col-lg-4 probox morebox" style="display:none;" >
           <form method="post" action="cart.php?action=add&id=<?php echo $row["ID"]; ?>">
             <div class="box">
             
                <div class="img-box" >
                <img src="./admin/static/<?php echo "$row[product_image]"?>" alt="">
                <a href="cart.php?action=add&id=<?php echo $row["ID"]; ?>" class="add_cart_btn">
                      <span>
                      <input type="submit" name="add"  class="btn btn-default" style="color:white;" value="Add to Cart">
                      </span>
                    </a>
                </div>
                <div class="detail-box">
                <h5>
                <a href="prodetail.php?id=<?php echo $row["ID"]; ?>"><?php echo "$row[product_name]" ?> </a>
                </h5>
                  <div class="product_info">
                    <h5>
                        <span>Rs</span> <?php echo "$row[product_price]" ?>
                    </h5>
                    <?php
                   if(isset($_SESSION["wishlist"])){
                   $item_array_id = array_column($_SESSION["wishlist"], 'product_id'); 
                 if(in_array($row["ID"], $item_array_id)) {?>
                <div class="heart_container icon_<?php echo $row["ID"]; ?>" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart" aria-hidden="true" style="color:red;"></i>
                </div>
                <?php } else{ ?>
                  <div class="star_container icon_<?php echo $row["ID"]; ?>" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                </div>
                <?php } } else {?>
                  <div class="star_container icon_<?php echo $row["ID"]; ?>" id="<?php echo $row["ID"]; ?>" >
                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                </div>
                <?php } ?>
                  </div>
                </div>
             </div> </form>
          </div> 
          <?php } ?>
        </div>
      <div class="btn_box" id="loadmore">
        <a href="#" class="view_more-link">
          View More
        </a>
      </div>
      <?php }  else {?>
        <div class="notfound">
            <img src="images/notfound.jpg" width="280px" height="260px"> <br>
           <p> No Results Found !! </p> 
           We couldn't find what you have searched for, <br>
           Try searching again
          </div>
          <?php } ?>
    </div>
  </section>
  <?php include 'footer.php';?>
  <script>
    jQuery(document).ready(($) => {
        
    $('.star_container').on('click',  function(e) {
        var data;
        var id = this.id;
        $.ajax({
              type: "GET",
              dataType: "text",
              url: "wish.php?id="+id, 
              data: data,
              success: function(data) {
                 console.log(data);
                 $(".star_container.icon_"+id).html(data);
              }
              
            });
    });
    });
  </script>
  <script>
    jQuery(document).ready(($) => {
        
    $('.heart_container').on('click',  function(e) {
        var data;
        var id = this.id;
        $.ajax({
              type: "GET",
              dataType: "text",
              url: "deletewish.php?id="+id, 
              data: data,
              success: function(data) {
                 console.log(data);
                 $(".heart_container.icon_"+id).html(data);
              }
              
            });
    });
    });
  </script>
  

<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
 <script src="js/bootstrap.js"></script> 
<!-- custom js -->
<script src="js/custom.js"></script> 
<script src="js/more.js"></script>

