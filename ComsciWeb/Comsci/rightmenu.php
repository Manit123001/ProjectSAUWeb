<div class="col-md-3 ">

    <aside class="sidebar">
        <div class="block animated fadeIn">
            <ul id="myTab2" class="nav nav-tabs nav-tabs-ar">
                <li class="active"><a data-toggle="tab" href="#fav2"><i class="fa fa-star"></i></a></li>
                <!-- <li><a data-toggle="tab" href="#categories2"><i class="fa fa-folder-open"></i></a></li> -->
                <!-- <li><a data-toggle="tab" href="#archive2"><i class="fa fa-clock-o"></i></a></li>
                <li><a data-toggle="tab" href="#tags2"><i class="fa fa-tags"></i></a></li> -->
            </ul>

            <div class="tab-content">

                <div id="fav2" class="tab-pane active">
                    <h3 class="post-title no-margin-top"><a href="news_list.php">News & Activity</a></h3>
                    <ul class="media-list">
                    <?php

                        $res = Select("tbnews", "order by id desc  limit 3" );
                        while ($row = mysql_fetch_array($res))
                        {
                            $id = $row['id'];
                            $news_title = $row['news_title'];
                            $news_text = $row['news_text'];
                            $news_img = $row['news_img'];
                            $news_date = $row['news_date'];
                            $news_type = $row['news_type'];

                        ?>

                        <li class="media">
                            <a href="news_cs.php?NewsPage=<?=$id;?>" class="pull-left"><img width="90" height="80" alt="image"
                              src="images/news/<?php echo $news_img; ?>" class="media-object"></a>
                            <div class="media-body">
                            <p class="media-heading">
                                <a href="news_cs.php?NewsPage=<?=$id;?>"><?php echo mb_substr($news_title, 0, 30,'UTF-8'); ?></a>

                            </p>

                                <small><i class="fa fa-clock-o"></i> <?php echo $news_date; ?></small>
                            </div>
                        </li>

                        <?php
                         }
                    ?>

                    </ul>
                </div>

                   <div id="categories2" class="tab-pane">
                       <h3 class="post-title no-margin-top">Categories</h3>
                      <ul class="simple">
                          <li><a href="#">pokemon</a></li>
                          <li><a href="#">pikaju</a>
                              <ul>
                                  <li><a href="#">onepiece Life</a></li>
                                  <li><a href="#">nami</a></li>
                              </ul>
                          </li>
                          <li><a href="#">Resources</a></li>

                      </ul>
                  </div>
            </div> <!-- tab-content -->
        </div>

        <!-- Video -->
        <?php

        $res = Select("tbrightmenu", "where id = 1" );
        while ($row = mysql_fetch_array($res))
        {
            $id = $row['id'];
            $right_link = $row['right_link'];
            echo $right_link;
        }
        ?>

          <!-- <div class="panel panel-primary animated fadeIn " >
              <div class="panel-heading " ><i class="fa fa-play-circle"></i>VDO Suggest</div>
              <div class="video">
                  <iframe  src="https://www.youtube.com/embed/5gMi3rSjHoM" frameborder="0" allowfullscreen></iframe>
              </div>
          </div>

          <div class="panel panel-primary animated fadeIn">
              <div class="panel-heading"><i class="fa fa-align-left"></i> Widget Text</div>
              <div class="panel-body">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atomus, appellat dedocendi omnes quoddam atomos. Vestra. Corrupti sensum multa dissentiet uberius displicet medeam, efficiatur quaeque saluto sollicitare arbitraretur conectitur chaere, deorum consiliisque arbitrer doctrina nasci. Odia malis, scipio, libido. Iudico graviter seditione hoc. Venustate.</p>
              </div>
          </div> -->




          <div class="panel panel-primary animated fadeIn">
              <div class="panel-heading"><i class="fa fa-align-left"></i> Fan Page</div>
              <div class="panel-body no-padding" >
                  <div class="fb-page" data-href="https://www.facebook.com/saucomsci/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/saucomsci/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/saucomsci/">วิทย์คอม ม.เอเชีย</a></blockquote></div>
              </div>
          </div>

          <div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    </aside>


</div> <!-- end col-md-3 -->
