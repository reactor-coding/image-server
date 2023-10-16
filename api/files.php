<?
  echo json_encode(glob('../images/{*.gif,*.jpg,*.jpeg,*.png,*.icon,*.webp,*.svg}', GLOB_BRACE));
  exit();