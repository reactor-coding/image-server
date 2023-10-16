<?php
  // 定義
  define("image_extension", array(
      "gif", "jpg", "jpeg", "png", "icon", "webp", "svg"
    )
  );
  /* define("image_mimetype", array(
      IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_ICO, IMAGETYPE_WEBP
    )
  ); */
  
  // ファイルの安全性の確認

  if (!isset("image", $_POST)) exit(json_encode(array(
    message => "Error: File Not Setted"
  )));

  $file_name = $_FILES["image"]["name"];
  $file_tmpname = $_FILES["image"]["tmp_name"];
  $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
  $mimetype = exif_imagetype($file_tmpname);

  if (!($mimetype && in_array($file_extension, image_extension, true))) exit(json_encode(array(
    message => "Error: it is not image."
  )));

  /**
   * uuid
   */
  $uuid = preg_replace_callback(
    "/x|y/",
    function($m) {
      return dechex($m[0] === 'x' ? random_int(0, 15) : random_int(8, 11));
    },
    "xxxxxxxxxxxx4xxxyxxxxxxxxxxxxxxx"
  );

  move_uploaded_file($file_tmpname, "../images/".$uuid.$file_extension);

  exit(json_encode(array(
    message => "ok",
    url => $uuid.$file_extension
  )))

?>