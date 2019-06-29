<?php

if(isset($_GET['id'])){
  $id = $_GET["id"];
  parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id='.$id), $video_data);
  $streams = $video_data['url_encoded_fmt_stream_map'];
  $streams = explode(',',$streams);
  $counter = 1;
  foreach ($streams as $streamdata) {
    printf("Quality %d:<br/>----------------<br/><br/>", $counter);
    parse_str($streamdata,$streamdata);
    foreach ($streamdata as $key => $value) {
      if ($key == "url") {
        $value = urldecode($value);
        printf("<strong>%s:</strong> <a href='%s' target='_blank'>Video link</a><br/>", $key, $value);
      } else {
        printf("<strong>%s:</strong> %s<br/>", $key, $value);
      }
    }
    $counter = $counter+1;
    printf("<br/><br/>");

  }
}else{
  die('Please provide a video id');
}

 ?>
