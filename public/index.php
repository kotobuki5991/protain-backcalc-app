<?php

require_once(__DIR__ . '/../private/php/db_connect.php');
require_once(__DIR__ . '/../private/php/common_func.php');
require_once(__DIR__ . '/../private/php/json_convert.php');



$db_connect_ins = new db_connect;

$db_connect_ins->exec_sql();



//db_connect.phpで取得した各項目最大値をjson形式に変換
$json_max_of_column = trim(
  json_encode($db_connect_ins->max_of_column, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
  '[\[\]]'
);

?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta name="description" content="このWebサイトでは、摂取したいタンパク質の量から必要な食材の量を逆算できます。
  「タンパク質を○○g摂取したいけど何をどれくらい食べたら良いか分からない！」という時などにご利用ください。">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="keywords" content="タンパク質,タンパク,食材,減量,食品,栄養,PFC,筋トレ" />

  <title>逆タン！！-タンパク質量から食材の量を逆算-</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/flexslider.css">
  <link rel="stylesheet" href="css/jquery.fancybox.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/font-icon.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/mainpage.css">
</head>

<body>
  <!-- header section -->
  <section class="banner" role="banner">
    <!--header navigation -->
    <header id="header">
      <!-- <div class="header_color"></div> -->
      <div class="header-content clearfix header_color"> <a class="logo" href="index.php"><img class="logo" src="images/logo.png" alt=""></a>
        <!-- 検索ボックス -->
        <div class="input-group input-grams" id="form-div">
          <form action="" method="post" class="protain-input-form" id="form-element" name="protaininput">
            <input type="text" class="form-control-input" placeholder="摂りたいタンパク質のg数" name="protain-amount">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" id="submit-button">
                <i class='glyphicon glyphicon-search'></i>
              </button>
            </span>
            <!-- 並び替え指定用セレクトボックス デフォルトはカロリー低い順 -->
            <select class="select-sort" name="sort">
              <option value="calories">低カロリー順</option>
              <option value="fat">低脂質順</option>
              <option value="carb">低炭水化物順</option>
              <option value="protain desc">高タンパク質順</option>
            </select>

          </form>
        </div>

      </div>
    </header>
    <!--header navigation -->
  </section>
  <!-- header section -->
  <!-- text banner section -->
  <section id="banner" class="banner no-padding">
    <div class="container-fluid">
      <div class="row no-gutter">
        <div class="flexslider">
          <ul class="slides">
            <li>
              <div class="col-md-12">
                <blockquote>
                  <h1>Protain back calculator</h1>
                  <p>逆タン！！-タンパク質量から食材の量を逆算-</p>
                </blockquote>
              </div>
            </li>
            <li>
              <div class="col-md-12">
                <blockquote>
                <h1>Protain back calculator</h1>
                  <h4>このサイトでは、摂取したいタンパク質の量から必要な食材の量を逆算できます</h4>
                </blockquote>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Text banner section -->


  <!-- 食材のリストを表示 -->
  <ul>
    <!-- SELECTの結果の数ループ -->
    <?php foreach ($db_connect_ins->results as $index => $result) : ?>
      <li>
        <div class="search_rasult">
          <div class="food_info ">
            <div class="food_name_img_block">
              <!-- 食材の名前とg数表示 -->
              <h5><?= h($result['name']) . ' : ' . round(floatval(h($result['required_amount'])), 1) . 'g'; ?></h5>
              <!-- 写真 -->
              <img class="imagesize" src="<?= h($result['pass_of_image']); ?>" alt="">
            </div>
          </div>
          <!-- 食材のデータをJSON形式に変換 -->
          <?php
          $json_nutrition = json_encode($result, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
          $json_index = json_decode($index);
          ?>

          <!-- インデックスとJSON形式に返還されたデータをjsに渡すためのタグ -->
          <div type="hidden" style="display: none;" id="<?= h($index); ?>" data-pfc="<?= h($json_nutrition); ?>"></div>
          <!-- グラフを表示 -->
          <div class="food_info nutrition_chart">
            <!-- id属性値でグラフ描画位置を特定している -->
            <!-- カロリー -->
            <div class="parent-my_chart">
              <h5 class="display-grams"><?= round(floatval(h($result['calories'])), 1) . ' kcal' ?></h5>
              <canvas class="my_chart" id="<?= h("myChart_calories{$index}"); ?>" width="200px" height="50px"></canvas>
            </div>
            <!-- タンパク質 -->
            <div class="parent-my_chart">
              <h5 class="display-grams"><?= 'タンパク質 : '.round(floatval(h($result['protain'])), 1) . ' g' ?></h5>
              <canvas class="my_chart" id="<?= h("myChart_protain{$index}"); ?>" width="200px"  height="50px"></canvas>
            </div>
            <!-- 脂質 -->
            <div class="parent-my_chart">
              <h5 class="display-grams"><?= '脂質 : '.round(floatval(h($result['fat'])), 1) . ' g' ?></h5>
              <canvas class="my_chart" id="<?= h("myChart_fat{$index}"); ?>" width="200px"  height="50px"></canvas>
            </div>
            <!-- 炭水化物 -->
            <div class="parent-my_chart">
              <h5 class="display-grams"><?= '炭水化物 : '.round(floatval(h($result['carb'])), 1) . ' g' ?></h5>
              <canvas class="my_chart" id="<?= h("myChart_carb{$index}"); ?>" width="200px"  height="50px"></canvas>
            </div>
          </div>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>



  <!-- portfolio section -->
  <section id="works" class="works section no-padding">
    <div class="container-fluid">
      <div class="row no-gutter">
        
        <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/tanpakushitsu_setsumei.jpg" class="work-box"> <img src="images/tanpakushitsu.jpg" alt="">
            <div class="overlay">
              <div class="overlay-caption">
                <h5>タンパク質について</h5>
                <p><i class="fa fa-search-plus fa-2x"></i></p>
              </div>
            </div>
            <!-- overlay -->
          </a> </div>
        <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/shishitsu_setsumei.jpg" class="work-box"> <img src="images/shishitsu.jpg" alt="">
            <div class="overlay">
              <div class="overlay-caption">
                <h5>脂質について</h5>
                <p><i class="fa fa-search-plus fa-2x"></i></p>
              </div>
            </div>
            <!-- overlay -->
          </a> </div>
        <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/tansuikabutsu_setsumei.jpg" class="work-box"> <img src="images/tansuikabutsu.jpg" alt="">
            <div class="overlay">
              <div class="overlay-caption">
                <h5>炭水化物について</h5>
                <p><i class="fa fa-search-plus fa-2x"></i></p>
              </div>
            </div>
            <!-- overlay -->
          </a> </div>
        <div class="col-lg-3 col-md-6 col-sm-6 work"> <a href="images/bitaminmineraru_setsumei.jpg" class="work-box"> <img src="images/bitaminmineraru.jpg" alt="">
            <div class="overlay">
              <div class="overlay-caption">
                <h5>ビタミン・ミネラルについて</h5>
                <p><i class="fa fa-search-plus fa-2x"></i></p>
              </div>
            </div>
            <!-- overlay -->
          </a> </div>
      </div>
    </div>
  </section>
  <!-- portfolio section -->
  <!-- footer -->
  <footer class="section footer">
    <div class="footer-bottom">
      <div class="container">
        <div class="col-md-12">
          <p>© 2021 T.Fukuju. All Rights Reserved<br>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer -->
  <!-- JS FILES -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.flexslider-min.js"></script>
  <script src="js/jquery.fancybox.pack.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/retina.min.js"></script>
  <script src="js/modernizr.js"></script>
  <script src="js/main.js"></script>




  <script src="js/mainpage.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js" integrity="sha512-U3hGSfg6tQWADDQL2TUZwdVSVDxUt2HZ6IMEIskuBizSDzoe65K3ZwEybo0JOcEjZWtWY3OJzouhmlGop+/dBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    //selectのindexをjson形式からオブジェクトに変換
    var food_select_index = JSON.parse('<?= $json_index; ?>');
    //各項目の最大値をjson形式からオブジェクトに変換
    var selected_max_of_column = JSON.parse('<?= $json_max_of_column; ?>');
  </script>
  <script type="text/javascript" src="js/chart.js"></script>
</body>

</html>