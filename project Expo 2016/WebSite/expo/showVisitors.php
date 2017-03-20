<?php


              $path = "./pictures/";
              $con = mysql_connect("localhost","expoSAU","1234") or die(mysql_error());
              mysql_select_db("images_expo");
              $strSQL = "SELECT * FROM tbexposau order by id desc";
              $res = mysql_query($strSQL);
              
              
              while($row = mysql_fetch_array($res))
              {
                $imageShow = $row["name_image"];

                ?>
                  <div class="col-lg-2 col-md-2 col-sm-6 work"  >
                    <div class="thumbnail" style="padding: 0px; margin: 0px;">
                      <div class="zoom-effect-container" >
                          <div class="image-card">
                              <a href="<?php echo $path.$imageShow;?>.jpg" class="work-box">
                                <img src="<?php echo $path.$imageShow;?>.jpg" alt="">
                                  <div class="overlay">
                                     <div class="overlay-caption">
                                        <h5 style="font-size: 24px; color: #00fff0;"><strong><?php echo $imageShow;?></strong></h5>
                                        <p>Expo 2016 </p>
                                    </div>
                                  </div>
                              </a>
                        </div>
                      </div>
                      
                    </div>
                  </div>    


                <?php 
              }          
              
             // mysql_close($con);
?>


  