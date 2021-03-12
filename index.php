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
  <form id="calc-form" onsubmit="return false;">
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
<?php for ($i = 1; $i <= 10; $i++) { ?>
          <tr>
            <td><?= $i ?></td>
            <td>
              <input class="form-control" type="text">
            </td>
            <td>
              <input id="before_price_<?= $i ?>" class="form-control" type="number">
            </td>
            <td>
              <input id="after_price_<?= $i ?>" class="form-control" type="number">
            </td>
            <td>
              <output id="hendou_<?= $i ?>"></output>
            </td>
            <td>
              <output id="toraku_<?= $i ?>" class="toraku"></output>
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
<?php for ($i = 1; $i <= 10; $i++) { ?>
        before_price = Number(document.getElementById('before_price_<?= $i ?>').value);
        after_price = Number(document.getElementById('after_price_<?= $i ?>').value);
        if (before_price > 0 && after_price > 0) {
          document.getElementById('hendou_<?= $i ?>').value = calc_hendou(before_price, after_price);
          document.getElementById('toraku_<?= $i ?>').value = calc_toraku(before_price, after_price);
        }
<?php } ?>
      });
    });
  </script>
</body>
</html>
