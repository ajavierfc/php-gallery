<?php
  ini_set("display_errors", 1);

  $filter = isset($_GET['filter']) ? $_GET['filter'] : "*.{jpg,jpeg,png,gif}";

  $files = glob($filter, GLOB_BRACE);

  $total = count($files);
  $ipp = isset($_GET['ipp']) ? $_GET['ipp'] : 40;
  $p = isset($_GET['p']) ? $_GET['p'] : 1;

  echo "<html><head>";
  echo "<style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
      border: 0;
      margin: 0;
    }
    .main {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: flex-start;
      height: 100%;
      width: 100%;
      padding: 24px;
      background: linear-gradient(to bottom, #bbb, #eee);
    }
    .content {
      display: flex;
      flex-wrap: wrap;
      flex-direction: row;
      align-items: flex-start;
    }
    .item {
      width: 64px;
      padding: 8px;
      border: 0;
      border-radius: 2px;
      box-shadow: 1px 1px 4px #333;
      margin: 8px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .item * {
      font-family: monospace;
      font-size: 60%;
    }
    .thumb {
      width: 100%;
      margin-bottom: 8px;
    }
    .link {
      color: #039;
    }
    .nav {
      margin-top: 24px;
      font-family: monospace;
    }
    .nav * {
      margin: 4px;
      color: #039;
    }
  </style>";
  echo "</head><body><div class='main'>";

  echo "<div class='content'>";

  for ($i = $p * $ipp - $ipp; $i < min($p * $ipp, $total); $i++) {
    $file = $files[$i];
    echo "<div class='item'><div class='thumb'><img class='thumb' src='$file' width=100% /></div><span>$file</span><br /><a class='link' target='_blank' href='$file'>visit</a></div>\n";
  }

  echo "</div>";

  $lp = ceil($total / $ipp);

  echo "<div class='nav'>";
  echo "<a href='". $_SERVER['PHP_SELF'] ."?filter=$filter&p=1&ipp=$ipp'><<</a>";
  echo "<a href='". $_SERVER['PHP_SELF'] ."?filter=$filter&p=". ($p - 1) ."&ipp=$ipp'><</a>";
  echo "<span>Page $p of $lp</span>";
  echo "<a href='". $_SERVER['PHP_SELF'] ."?filter=$filter&p=". ($p + 1) ."&ipp=$ipp'>></a>";
  echo "<a href='". $_SERVER['PHP_SELF'] ."?filter=$filter&p=$lp&ipp=$ipp'>>></a>";
  echo "</div>";

  echo "</div></body></html>";
?>
