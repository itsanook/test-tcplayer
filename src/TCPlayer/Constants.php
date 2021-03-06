<?php

namespace TencentTH\TCPlayer;

class Constants {

  /**
   * @return string[]
   */
  public static function getScripts() {
    return [
      "vod-ima-0.1.0" => "vendor-ext/tcplayer/vod-ima-0.1.0.js",
      "vod-ima-0.1.1" => "vendor-ext/tcplayer/vod-ima-0.1.1.js",
      "vod-ima-0.1.3" => "vendor-ext/tcplayer/vod-ima-0.1.3.js",
      "vod-ima-0.1.4" => "vendor-ext/tcplayer/vod-ima-0.1.4.js",
      "vod-ima-0.1.6" => "vendor-ext/tcplayer/vod-ima-0.1.6-2.js",
      "vod-ima-0.1.10" => "vendor-ext/tcplayer/vod-ima-0.1.10.js",
      "vod-ima-0.1.14" => "vendor-ext/tcplayer/vod-ima-0.1.14.js",
      "vod-ima-1.0.1" => "vendor-ext/tcplayer/vod-ima-1.0.1.js",
      "vod-ima-1.0.2" => "vendor-ext/tcplayer/vod-ima-1.0.2.js",
      "vod-ima-1.0.3" => "vendor-ext/tcplayer/vod-ima-1.0.3.js",
      "vod-ima-1.0.4" => "vendor-ext/tcplayer/vod-ima-1.0.4.js",
      "vod-ima-1.0.5" => "vendor-ext/tcplayer/vod-ima-1.0.5.js",
      "vod-ima-ibg" => "//p.ibg.wechatapp.com/bossapp_arthur/vod-ima-dev/js/vod-ima.js",
      // "TcPlayer-2.2.0.js" => "//imgcache.qq.com/open/qcloud/video/vcplayer/TcPlayer-2.2.0.js"
    ];
  }

  /**
   * @return \TencentTH\TCPlayer\Testcase[]
   */
  public static function getTestcases() {
    return [
      "title" => new Testcase(
        "title.part.html",
        "Title",
        "Able to specify title and URL link",
        "Able to specify title and URL link",
        TRUE
      ),
      "watermark" => new Testcase(
        "watermark.part.html",
        "Watermark",
        "Logo is shown",
        "Logo is shown",
        TRUE
      ),
      "related" => new Testcase(
        "related.part.html",
        "Related",
        "Related is shown",
        "Related is shown",
        TRUE
      ),
      "share" => new Testcase(
        "share.part.html",
        "Share",
        "Share is shown",
        "Share is shown",
        TRUE
      ),
      "thumbnail" => new Testcase(
        "thumbnail.part.html",
        "Thumbnail",
        "Thumbnail is shown",
        "Thumbnail is shown",
        TRUE
      ),
      "seperator-00" => "<hr/>",
      "play" => new Testcase(
        "play.part.html",
        "Play",
        "Able to playback the video and audio",
        "Able to playback the video and audio",
        TRUE
      ),
      "play-multi-birates" => new Testcase(
        "multi-bitrates.part.html",
        "Play: Multiple bitrates",
        "Supports 240p, 360p, 480p, 720p, 1080p and auto-scale to the best resolution",
        "1) iOS unable to select bitrate
2) Android, Able to select bitrate for m3u8 video but not on mp4, please see working example from JWPlayer http://prepro.video.sanook.com/_experiment/player/sanook_player.php?file_type=mp4&ads_type=dfp",
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
        "All UI should be responsive",
        "All UI is responsive",
        TRUE
      ),
      "ad-default" => new Testcase(
        "ad-default.part.html",
        "Ad: Play",
        "Linear preroll ad is displayed when the video is started",
        "Linear preroll ad is displayed when the video is started",
        TRUE
      ),
      "ad-autoplay" => new Testcase(
        "ad-autoplay.part.html",
        "Ad: Autoplay",
        "Linear preroll ad is displayed when the video has autoplay set",
        "Ads correctly shown every time",
        TRUE
      ),
      "ad-multivast" => new Testcase(
        "ad-multivast.part.html",
        "Ad: Multi-Vast",
        "Ad is displayed at pre, mid, and end of the video",
        "Ad is displayed at pre, mid, and end of the video",
        TRUE
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
      "api-admeta" => new Testcase(
        "api-admeta.part.html",
        "API: Ad Meta",
        "Able to provide ad meta data info",
        "Able to provide ad meta data info",
        TRUE
      ),
      "listener" => new Testcase(
        "api-listener.part.html",
        "API: Events",
        "Capable of detecting events",
        "Capable of detecting events",
        TRUE
      ),
      "seperator-01" => "<hr/>",
      "event-ready" => new Testcase(
        "event-ready.part.html",
        "API: Event - Ready",
        "Able to detect when the video is ready for playback",
        "The event loadedmetadata is fired. The event fires when \"the user agent has just determined the duration and dimensions of the media resource\"
Ref: https://www.w3.org/wiki/HTML/Elements/video#Media_Events",
        TRUE
      ),
      "event-player-ready" => new Testcase(
        "event-ready.part.html",
        "API: Event - Player Ready",
        "Able to detect when the player is initialized and is ready for playback. This is the earliest point at which any API calls e.g. playAd should be made.",
        "The event is ready",
        TRUE
      ),
    ];
  }

}
