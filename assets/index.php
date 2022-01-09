<?php
include ("header.php");
?>


        <div class="shop-page-area pt-100 pb-100">
            <div class="container">
                <div class="row flex-row-reverse"  style="padding-bottom: 10dp;">
                    <div class="col-lg-9">
                        <div class="grid-list-product-wrapper" >
                            <div class="product-grid product-view pb-20" >
                                    <div class="row" >
                                            <?php 
											$brgs=mysqli_query($conn,"SELECT * from produk order by idproduk ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){

												?>
                                        <div class="col-md-4 top_brand_left" style="margin-bottom: 10px;">
                                        <div class="hover14 column">
                                            <div class="agile_top_brand_left_grid" >
                                                <!--<div class="agile_top_brand_left_grid_pos">
                                                    <img src="images/offer.png" alt=" " class="img-responsive" />
                                                </div>-->
                                                <div class="agile_top_brand_left_grid1" >
                                                    <figure>
                                                        <div class="snipcart-item block">
                                                            <div class="snipcart-thumb">
                                                        <a href="product.php?idproduk=<?php echo $p['idproduk'] ?>"><img title=" " alt=" " src="<?php echo $p['gambar']?>" width="200px" height="200px" /></a>
                                                        <p><?php echo $p['namaproduk'] ?></p>
                                                        <div class="stars">
                                                             <?php
															$bintang = '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
															$rate = $p['rate'];
															
															for($n=1;$n<=$rate;$n++){
																echo '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
															};
															?>
                                                            </div>
                                                            <h4>Rp<?php echo number_format($p['hargaafter']) ?><span>Rp<?php echo number_format($p['hargabefore']) ?></span></h4>  
                                                            <div class="snipcart-details top_brand_home_details" style="cursor: hand;">
																<fieldset>
                                                                    <?php
                                                                    if($_SESSION['role']=='Admin'){
                                                                     }else{
                                                                     ?>
                                                                    <a href="product.php?idproduk=<?php echo $p['idproduk'] ?>"><input class="btn btn-red"  type="submit" class="button" value="Lihat Produk" /></a>
                                                                     
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    </fieldset>
                                                                    </div>
                                                                </div>
                                                            </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        <?php } ?>        
                                    </div>
            
                            </div>
                            
                        </div>
                    </div>
                    <?php
                    $kat=mysqli_query($conn,"SELECT * from kategori order by idkategori ASC");
                    ?>
                    <div class="col-lg-3">
                        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title">Shop By Categories</h4>
                                <div class="shop-catigory">
                                    <ul id="faq" class="category_list">
                                        <?php 
                                        while($p=mysqli_fetch_array($kat)){
                                            
                                            ?>
                                            <li><a href="kategori.php?idkategori=<?php echo $p['idkategori'] ?>"><?php echo $p['namakategori'] ?></a></li>  
                                        <?php
                                                }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include("footer.php");
?>