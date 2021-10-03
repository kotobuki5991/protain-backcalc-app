<?php
  function json_convert($src){
    // json形式で値を返す宣言
    header("Content-Type: application/json; charset=utf-8");
    //引数の値をjson形式に変換
    return json_encode($src, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
  }


