<?php

/**
 * Test cases for TCPlayer
 * Documentation: https://cloud.tencent.com/document/product/267/9498
 */

include "vendor/autoload.php";

use TencentTH\TCPlayer\Testcase;
use TencentTH\TCPlayer\Constants;

$SCRIPTS = Constants::getScripts();
$TESTCASES = Constants::getTestcases();

$script_key = array_key_exists('s', $_REQUEST)
  ? $_REQUEST['s']
  : "vod-ima-0.1.3";
$script = array_key_exists($script_key, $SCRIPTS)
  ? $SCRIPTS[$script_key]
  : NULL;

$testcase_key = array_key_exists('t', $_REQUEST)
  ? $_REQUEST['t']
  : NULL;
$testcase = array_key_exists($testcase_key, $TESTCASES)
  ? $TESTCASES[$testcase_key]
  : NULL;
$testcase_html = $testcase !== NULL && file_exists("testcase/{$testcase->file}")
  ? file_get_contents("testcase/{$testcase->file}")
  : NULL;

?>
<html>
<head>
  <title>Tencent Player Test</title>
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/css/bootstrap.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//imasdk.googleapis.com/js/sdkloader/ima3.js"></script>
  <script src="<?php echo $script; ?>"></script>
</head>
<body>
<div class="container">
  <div class="col-sm-3">
    <h4>Scripts</h4>
    <div class="dropdown">
      <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        <?php echo $script_key; ?>
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        <?php foreach ($SCRIPTS as $k => $val): ?>
          <li>
            <a href="?t=<?php echo $testcase_key; ?>&s=<?php echo $k; ?>" title="<?php echo $val; ?>">
              <?php echo $k; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <h4>Test Cases</h4>
    <ul class="list-unstyled">
      <?php foreach ($TESTCASES as $k => $val): ?>
        <?php if ($val instanceof Testcase): ?>
          <li>
            <a
              href="?t=<?php echo $k; ?>&s=<?php echo $script_key; ?>"
              style="padding-left:2px;border-left:solid 2px <?php echo $k === $testcase_key ? '#337ab7' : 'transparent'; ?>"
            >
              <?php echo $val->pass ? '✔' : '✘'; ?>
              <?php echo $val->title; ?>
            </a>
          </li>
        <?php else: ?>
          <?php echo $val; ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="col-sm-9">
    <?php if ($testcase !== NULL): ?>
      <h1 style="margin-top:8px"><?php echo $testcase->title ?></h1>
      <div class="panel panel-default">
        <div class="panel-heading">
          <ul class="nav nav-pills">
            <li role="presentation" class="active"><a href="#results-results" data-toggle="tab">Results</a></li>
            <li role="presentation"><a href="#results-html" data-toggle="tab">HTML</a></li>
          </ul>
        </div>
        <div class="panel-body">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="results-results"><?php echo $testcase_html; ?></div>
            <div role="tabpanel" class="tab-pane" id="results-html">
              <pre style="margin:-16px;background-color:transparent"><?php echo htmlspecialchars($testcase_html); ?></pre>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-info">
        <div class="panel-heading">Expected Results</div>
        <div class="panel-body"><?php echo nl2br(htmlspecialchars($testcase->expected)); ?></div>
      </div>
      <div class="panel <?php echo $testcase->pass ? "panel-success" : "panel-danger"; ?>">
        <div class="panel-heading">
          Actual Results
          <?php if (!$testcase->pass): ?>
            <span class="label label-danger">FAILED</span>
          <?php endif; ?>
        </div>
        <div class="panel-body"><?php echo nl2br(htmlspecialchars($testcase->actual)); ?></div>
      </div>
    <?php else: ?>
      <div class="alert alert-info" style="margin-top:16px;">Please select a test case from the menu</div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
