<?php
const CALC_NUM_MIN = 1;
const CALC_NUM_MAX = 10;
const CALC_NUM_DEFALUT = 5;
$calc_num = isset($_GET['calc-num']) && is_numeric($_GET['calc-num']) ? $_GET['calc-num'] : CALC_NUM_DEFALUT;
$calc_num = $calc_num > CALC_NUM_MAX ? CALC_NUM_MAX : $calc_num;
$calc_num = $calc_num < CALC_NUM_MIN ? CALC_NUM_MIN : $calc_num;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <style>
    /* 第1,5,6カラムに適用 */
    .col156-align td:nth-of-type(1), td:nth-of-type(5), td:nth-of-type(6) {
      text-align: right;
    }

    output.toraku::after {
      content: " %";
    }
  </style>
  <title>騰落率計算ツール</title>
</head>
<body>
  <h1>騰落率計算ツール</h1>
  <form id="calc-form" action="index.php" method="GET">
    <div class="d-flex flex-row my-2">
      <div>
        <button class="btn btn-outline-danger text-nowrap mx-3" type="reset">リセット</button>
      </div>
      <div>
        <div class="input-group">
          <input class="form-control" name="calc-num" type="number" placeholder="行数を入力して下さい" aria-describedby="calc-num-btn">
          <button id="calc-num-btn" class="btn btn-outline-primary" type="submit">変更</button>
        </div>
      </div>
    </div><!-- d-flex -->
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle col156-align">
        <thead>
          <tr class="text-center text-nowrap">
            <th>No</th>
            <th>銘柄</th>
            <th>変動前の価格</th>
            <th>変動後の価格</th>
            <th style="width: 10%;">変動幅</th>
            <th style="width: 10%;">変動率</th>
          </tr>
        </thead>
        <tbody>
<?php for ($i = 1; $i <= $calc_num; $i++) { ?>
          <tr class="text-nowrap">
            <td><?= $i ?></td>
            <td>
              <input class="form-control" type="text">
            </td>
            <td>
              <input id="before-price-<?= $i ?>" class="form-control" type="number">
            </td>
            <td>
              <input id="after-price-<?= $i ?>" class="form-control" type="number">
            </td>
            <td>
              <output id="hendou-<?= $i ?>"></output>
            </td>
            <td>
              <output id="toraku-<?= $i ?>" class="toraku"></output>
            </td>
          </tr>
<?php } ?>
        </tbody>
      </table>
    </div><!-- table-responsive -->
  </form>
  <script>
    function calc_hendou(a, b) {
      return Math.round((b - a) * 100) / 100;
    }

    function calc_toraku(a, b) {
      return Math.round((b / a - 1) * 100 * 100) / 100;
    }

    window.addEventListener('DOMContentLoaded', function() {
      let before_price;
      let after_price;
      document.getElementById('calc-form').addEventListener('input', function(e) {
<?php for ($i = 1; $i <= $calc_num; $i++) { ?>
        before_price = Number(document.getElementById('before-price-<?= $i ?>').value);
        after_price = Number(document.getElementById('after-price-<?= $i ?>').value);
        if (before_price > 0 && after_price > 0) {
          document.getElementById('hendou-<?= $i ?>').value = calc_hendou(before_price, after_price);
          document.getElementById('toraku-<?= $i ?>').value = calc_toraku(before_price, after_price);
        }
<?php } ?>
      });
    });
  </script>
</body>
</html>
