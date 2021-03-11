<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <style>
    /* 第1カラムに適用 */
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
  <div class="table-responsive">
    <form onsubmit="return false;" oninput="
      hendou_1.value = calc_hendou(Number(before_price_1.value), Number(after_price_1.value));
      toraku_1.value = calc_toraku(Number(before_price_1.value), Number(after_price_1.value));
      hendou_2.value = calc_hendou(Number(before_price_2.value), Number(after_price_2.value));
      toraku_2.value = calc_toraku(Number(before_price_2.value), Number(after_price_2.value));
      hendou_3.value = calc_hendou(Number(before_price_3.value), Number(after_price_3.value));
      toraku_3.value = calc_toraku(Number(before_price_3.value), Number(after_price_3.value));
      hendou_4.value = calc_hendou(Number(before_price_4.value), Number(after_price_4.value));
      toraku_4.value = calc_toraku(Number(before_price_4.value), Number(after_price_4.value));
      hendou_5.value = calc_hendou(Number(before_price_5.value), Number(after_price_5.value));
      toraku_5.value = calc_toraku(Number(before_price_5.value), Number(after_price_5.value));
    ">
      <table class="table table-striped table-bordered align-middle col156-align">
        <thead>
          <tr class="text-center row-nowrap">
            <th>No</th>
            <th>銘柄</th>
            <th>変動前の価格</th>
            <th>変動後の価格</th>
            <th style="width: 10%;">変動幅</th>
            <th style="width: 10%;">変動率</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td><input class="form-control" type="text"></td>
            <td><input class="form-control" type="number" name="before_price_1"></td>
            <td><input class="form-control" type="number" name="after_price_1"></td>
            <td><output name="hendou_1"></output></td>
            <td><output class="toraku" name="toraku_1"></output></td>
          </tr>
          <tr>
            <td>2</td>
            <td><input class="form-control" type="text"></td>
            <td><input class="form-control" type="number" name="before_price_2"></td>
            <td><input class="form-control" type="number" name="after_price_2"></td>
            <td><output name="hendou_2"></output></td>
            <td><output class="toraku" name="toraku_2"></output></td>
          </tr>
          <tr>
            <td>3</td>
            <td><input class="form-control" type="text"></td>
            <td><input class="form-control" type="number" name="before_price_3"></td>
            <td><input class="form-control" type="number" name="after_price_3"></td>
            <td><output name="hendou_3"></output></td>
            <td><output class="toraku" name="toraku_3"></output></td>
          </tr>
          <tr>
            <td>4</td>
            <td><input class="form-control" type="text"></td>
            <td><input class="form-control" type="number" name="before_price_4"></td>
            <td><input class="form-control" type="number" name="after_price_4"></td>
            <td><output name="hendou_4"></output></td>
            <td><output class="toraku" name="toraku_4"></output></td>
          </tr>
          <tr>
            <td>5</td>
            <td><input class="form-control" type="text"></td>
            <td><input class="form-control" type="number" name="before_price_5"></td>
            <td><input class="form-control" type="number" name="after_price_5"></td>
            <td><output name="hendou_5"></output></td>
            <td><output class="toraku" name="toraku_5"></output></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div><!-- table-responsive -->
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
