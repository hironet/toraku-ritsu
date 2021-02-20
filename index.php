<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <style>
    .ctrl-button {
      border-radius: 4px;
      border-style: none;
      color: white;
      margin: 10px 10px;
      padding: 0.8em 0.2em;
      position: relative;
      width: 80px;
    }

    .ctrl-button:hover {
      opacity: 0.7;
    }

    .ctrl-button:active {
      top: 4px;
    }

    #change-button {
      background-color: #1e90ff;
    }

    #add-button {
      background-color: #32cd32;
    }

    #del-button {
      background-color: #ff8c00;
    }

    #reset-button {
      background-color: #ff69b4;
    }

    output.toraku::after {
      content: " %";
    }
  </style>
  <title>騰落率計算ツール</title>
</head>
<body>
  <h1>騰落率計算ツール</h1>
  <?php
  const MIN_FORM_NUM = 1;
  const MAX_FORM_NUM = 30;
  const DEFAULT_FORM_NUM = 4;

  $default_form_num = DEFAULT_FORM_NUM;
  $form_num = isset($_GET['form_num']) ? htmlspecialchars($_GET['form_num']) : $default_form_num;
  $form_num = $form_num > MIN_FORM_NUM ? $form_num : MIN_FORM_NUM;
  $form_num = $form_num < MAX_FORM_NUM ? $form_num : MAX_FORM_NUM;
  $form_num_plus_one = $form_num + 1;
  $form_num_minus_one = $form_num - 1;
  ?>
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-auto">
        <form method="GET" action="index.php">
          <label>項目数：<input class="form_num" type="number" name="form_num" value="<?php print $form_num ?>" style="width: 50px;"></label>
          <input id="change-button" class="ctrl-button" type="submit" value="変更">
        </form>
      </div>
      <div class="col-auto col-lg-auto">
        <div class="btn-group" role="group">
          <form method="GET" action="index.php">
            <input type="hidden" name="form_num" value="<?php print $form_num_plus_one ?>">
            <input id="add-button" class="ctrl-button" type="submit" value="1行追加">
          </form>
          <form method="GET" action="index.php">
            <input type="hidden" name="form_num" value="<?php print $form_num_minus_one ?>">
            <input id="del-button" class="ctrl-button" type="submit" value="1行削除">
          </form>
          <form method="GET" action="index.php">
            <input type="hidden" name="form_num" value="<?php print $default_form_num ?>">
            <input id="reset-button" class="ctrl-button" type="submit" value="リセット">
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row" style="text-align: center;">
      <div class="col-6 col-lg-1 border">No</div>
      <div class="col-6 col-lg-2 border">銘柄</div>
      <div class="col-6 col-lg-2 border">変動前の価格</div>
      <div class="col-6 col-lg-2 border">変動後の価格</div>
      <div class="col-6 col-lg-2 border">変動幅</div>
      <div class="col-6 col-lg-2 border">騰落率</div>
      <div class="col-12 col-lg-1 border"></div>
    </div>
  <?php
  function calc_form($no) {
    print <<<CALC_FORM
    <form onsubmit="return false;" oninput="
      hendou.value = calc_hendou(Number(a.value), Number(b.value));
      toraku.value = calc_toraku(Number(a.value), Number(b.value));
    ">
    <div class="row">
      <div class="col-6 col-lg-1 border" style="text-align: right;">{$no}</div>
      <div class="col-6 col-lg-2 border"><input class="brand" type="text" style="width: 100%;"></div>
      <div class="col-6 col-lg-2 border"><input class="price" type="number" name="a" style="width: 100%;"></div>
      <div class="col-6 col-lg-2 border"><input class="price" type="number" name="b" style="width: 100%;"></div>
      <div class="col-6 col-lg-2 border" style="text-align: right;"><output name="hendou"></output></div>
      <div class="col-6 col-lg-2 border" style="text-align: right;"><output class="toraku" name="toraku"></output></div>
      <div class="col-12 col-lg-1 border"><input type="reset" value="リセット"></div>
    </div>
  </form>
CALC_FORM;
  }

  for ($i = 1; $i <= $form_num; $i++) {
    calc_form($i);
  }
  ?>
  </div>
  <script>
    function calc_hendou(a, b) {
      return Math.round((b - a) * 100) / 100;
    }

    function calc_toraku(a, b) {
      return Math.round((b / a - 1) * 100 * 100) / 100;
    }
  </script>
</body>
</html>
