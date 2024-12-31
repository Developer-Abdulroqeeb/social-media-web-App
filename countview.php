<?php
     $selct_view = mysqli_query($connection,"SELECT  * FROM view WHERE videoId = '$vid_id' && userid != '' ");
       $row_view = mysqli_fetch_array($selct_view);
      if(mysqli_num_rows($selct_view) === 1){
        echo mysqli_num_rows($selct_view)."   "."view";
          }else{
        echo mysqli_num_rows($selct_view)."   "."views";
                }
        ?>