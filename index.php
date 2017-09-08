<?php

// https://cloud.tencent.com/document/product/267/9498

class Testcase {
  public $file;
  public $title;
  public $expected;
  public $actual;
  public $pass;

  public function __construct($file, $title, $expected, $actual, $pass) {
    $this->file = $file;
    $this->title = $title;
    $this->expected = $expected;
    $this->actual = $actual;
    $this->pass = $pass;
  }
}

$SCRIPTS = [
  "vod-ima-0.1.0" => "vendor-ext/tcplayer/vod-ima-0.1.0.js",
  "vod-ima-0.1.1" => "vendor-ext/tcplayer/vod-ima-0.1.1.js",
  "vod-ima-0.1.3" => "vendor-ext/tcplayer/vod-ima-0.1.3.js",
  "TcPlayer-2.2.0.js" => "//imgcache.qq.com/open/qcloud/video/vcplayer/TcPlayer-2.2.0.js"
];
$script_key = array_key_exists('s', $_REQUEST)
  ? $_REQUEST['s']
  : "vod-ima-0.1.3";
$script = array_key_exists($script_key, $SCRIPTS)
  ? $SCRIPTS[$script_key]
  : NULL;

/** @var \Testcase[] $TESTCASES */
$TESTCASES = [
  "play" => new Testcase(
    "play.part.html",
    "Play",
    "Able to playback the video and audio",
    "The video can be played and audio can be heard but the piggybacking to the reporting server failed over SSL as well as there is no option to disable it",
    FALSE
  ),
  "play-multi-birates" => new Testcase(
    "multi-bitrates.part.html",
    "Play: Multiple bitrates",
    "Supports 240p, 360p, 480p, 720p, 1080p and auto-scale to the best resolution",
    "1) It only auto-scale to 360p whereas my network is at 1Gbps, 2) Auto should also display the resolution used, 3) Please copy Youtube (https://www.youtube.com/watch?v=9e4NWnCsrl8), 4) Bitrate selection must be available regardless of flag autoLevel",
    FALSE
  ),
  "play-multi-birates-2" => new Testcase(
    "multi-bitrates-2.part.html",
    "Play: Multiple bitrates",
    "Supports 240p, 360p, 480p, 720p, 1080p and auto-scale to the best resolution",
    "1) It only auto-scale to 360p whereas my network is at 1Gbps",
    FALSE
  ),
  "play-volumn" => new Testcase(
    "play.part.html",
    "Play: Volumn",
    "Volumn settings is maintained across page refresh",
    "Volumn settings is maintained across page refresh",
    TRUE
  ),
  "ui-volumn" => new Testcase(
    "play.part.html",
    "UI: Volumn",
    "Volumn button is correctly displayed on mouseover",
    "It is correctly displayed",
    TRUE
  ),
  "ui-onpause" => new Testcase(
    "play.part.html",
    "UI: On Pause",
    "The video is paused and no audio plays",
    "The video screen is paused and audio is muted",
    TRUE
  ),
  "ui-responsive" => new Testcase(
    "responsive.part.html",
    "UI: Responsive",
    "",
    "",
    TRUE
  ),
  "ad-autoplay" => new Testcase(
    "ad-autoplay.part.html",
    "Ad: Autoplay ?",
    "Linear preroll ad is displayed when the video has autoplay set",
    "Ads correctly shown every time",
    TRUE
  ),
  "ad-multivast" => new Testcase(
    "ad-multivast.part.html",
    "Ad: Multi-Vast",
    "Ad is displayed at pre, mid, and end of the video",
    "1) piggybacking to the QCloud should be optional, 2) occasionally exceptions thrown e.g. Uncaught Error: playAd called when not ready, and few other exceptions",
    FALSE
  ),
  "error-custom" => new Testcase(
    "error-custom.part.html",
    "Error: Messages",
    "Custom error message is displayed",
    "Custom error message is displayed",
    TRUE
  ),
  "api-method" => new Testcase(
    "api-method.part.html",
    "API: Methods",
    "Basic methods such as play, pause, togglePlay and mute are working correctly.",
    "All basic method works correctly.",
    TRUE
  ),
  "listener" => new Testcase(
    "api-listener.part.html",
    "API: Events",
    "Capable of detecting events",
    "Events correctly printed to console",
    TRUE
  ),
];
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
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="//imasdk.googleapis.com/js/sdkloader/ima3.js"></script>
  <script src="<?php echo $script; ?>"></script>
</head>
<body>
<div class="container">
  <div class="col-sm-2">
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
        <li>
          <a
            href="?t=<?php echo $k; ?>&s=<?php echo $script_key; ?>"
            style="padding-left:2px;border-left:solid 2px <?php echo $k === $testcase_key ? '#337ab7' : 'transparent'; ?>"
          >
            <?php echo $val->pass ? '✔' : '✘'; ?>
            <?php echo $val->title; ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="col-sm-10">
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
        <div class="panel-body"><?php echo $testcase->expected; ?></div>
      </div>
      <div class="panel <?php echo $testcase->pass ? "panel-success" : "panel-danger"; ?>">
        <div class="panel-heading">
          Actual Results
          <?php if (!$testcase->pass): ?>
            <span class="label label-danger">FAILED</span>
          <?php endif; ?>
        </div>
        <div class="panel-body"><?php echo $testcase->actual; ?></div>
      </div>
    <?php else: ?>
      <div class="alert alert-info">Please select a test case from the menu</div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
