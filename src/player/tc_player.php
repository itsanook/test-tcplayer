<html >
<head>
<meta charset="utf-8">


<style>
  .left{
	  float:left;width:120px;background:#cccccc;
	  border:1px solid #999999;
	  padding:3px;
  }
  .right{
	  
	  float:left;width:500px;
	  border:1px solid #999999;
	  padding:3px;
	  background:#f2f2f2;
  }
  #ima-container {
  margin: auto;
}


</style>
<script src="http://p3.isanook.com/sh/0/js/jquery-1.8.3.min.js" type="text/javascript" ></script>
<script src="http://p3.isanook.com/sh/0/js/mobile-detect.min.js"></script>
<script src="//imasdk.googleapis.com/js/sdkloader/ima3.js"></script>
<script src="//imgcache.qq.com/open/qcloud/video/vcplayer/TcPlayer-2.2.0.js" charset="utf-8"></script>
<script src="http://test.topspace.com/tcplayer/vendor-ext/tcplayer/vod-ima-0.1.10.js"></script>
</head>
<body>
<script>
var a;
var b;
function getstartTime(){
	a = performance.now();
}

function getendTime(){
	b = performance.now();
}

function difTime(){
	c = ((b - a)/1000) + 'sec.';
	a=0;
	b=0;
	return c;
}


var adtimestate=0;
function showDebug(e,m){
    // console.log(e.type);
    // console.log(e);
    data='&nbsp;';
    var type = '&nbsp;';
    if(e ==null){
        type = '&nbsp;';
    }
    else{
        type =  e.type;
    }

    if(m!==undefined){
        data=m;
    }
    // console.log(data);
   


   msg="<div class='left'>"+type+"</div><div class='right'>"+data+"</div><br clear='all'>";
    document.getElementById("debug").innerHTML=document.getElementById("debug").innerHTML+msg;
   
}

function is_mobile()
{
  if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/Android/i)) {

       return true;
    }else{
        return false;
    }
}

function is_android()
{
  if (navigator.userAgent.match(/Android/i)) {

       return true;
    }else{
        return false;
    }
}

function is_ios()
{
  if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {

       return true;
    }else{
        return false;
    }
}


var state = {}; 
state.adsType = '';
state.prerollPlayed = false;	
state.midrollPlayed = false;
state.midrollPlayedStart = false;
state.midrollStateSave = 0;
state.postrollPlayed = false;
state.segmentPlayed = false;
state.vast_linear_index = 0;
state.preroll_complete =0;

var ads_type = '<?=$_GET['ads_type']?>';
if(ads_type =='vpaid')
{
    vastAdsURL={
	    "vast_linear": "http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=is&c=23&pl=VAST&pli=10724976&PluID=0&pos=113&ord=%5btimestamp%5d&cim=1&t=1&ai=23227072",  
		"vast_midroll": "https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dskippablelinear&correlator=",
		"vast_postroll":"https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dskippablelinear&correlator="
     }
}
else if(ads_type == 'dfp')
{
    var md = new MobileDetect(window.navigator.userAgent);
    if(!md.mobile() && !md.tablet())
    {
        console.log('desktop');
        vastAdsURL={
            "vast_linear": "https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dskippablelinear&correlator=",  
            "vast_midroll": "https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dskippablelinear&correlator=",
            "vast_postroll":"https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dskippablelinear&correlator="
        }    }
    else
    { // mobile
        console.log('mobile');
        vastAdsURL={
            "vast_linear": "https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dlinear&correlator=",  
            "vast_midroll": "https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dlinear&correlator=",
            "vast_postroll":"https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dlinear&correlator="
        }

    }
    
}
else if(ads_type == 'third_party')
{ 
	vastAdsURL={
	    "vast_linear": "http://bs.serving-sys.com/Serving?cn=display&c=23&pl=VAST&pli=20266289&PluID=0&pos=5471&ord=419529&cim=1",  
		"vast_midroll": "http://bs.serving-sys.com/Serving?cn=display&c=23&pl=VAST&pli=20266289&PluID=0&pos=5471&ord=419529&cim=1",
		"vast_postroll":"http://bs.serving-sys.com/Serving?cn=display&c=23&pl=VAST&pli=20266289&PluID=0&pos=5471&ord=419529&cim=1"
     }
}
else if(ads_type == 'error'){
    vastAdsURL={
	    "vast_linear": "http://prepro.video.sanook.com/_experiment/player/empty_ads.xml",  
		"vast_midroll": "http://prepro.video.sanook.com/_experiment/player/empty_ads.xml",
		"vast_postroll":"http://prepro.video.sanook.com/_experiment/player/empty_ads.xml"
     }

}
else if(ads_type == 'noads'){
    vastAdsURL={
	    "vast_linear": "",  
		"vast_midroll": "",  
		"vast_postroll":""
     }
}










var playerOBJ;
var file_type = '<?=$_GET['file_type']?>';	
var paramsObj = {
        'vdo_type': 'vdo',
        'vdo_link': 'http://video.sanook.com/player/1092653/',
        'file': {
            'video': '/liveplay/1092653.m3u8',
        },
        'image': 'https://p3.isanook.com/vi/0/ud/3/17/jpg/197/3941970.jpg',
        'ss': 'https://p3.isanook.com/vi/0/ud/3/17/ss/197/3941970.jpg',
        'duration': '644',
        'embed': 'http://video.sanook.com/embed/player/1092653',
        'relate_file': '/relateXml/1092653',
        'user': 'tvburabha',
        'youtube_type': '0',
        'controller': {
            'auto': 'false',
            'plugin': 1,
            'logo_file': '1',
            'embed_width': '100%',
            'embed_height': '100%',
            'controlbar': 'bottom',
            'skin': 'http://video.sanook.com/assets/vi/js/jwplayer6.12/skins/premium/glow.xml'
        },
        'title': 'กบนอกกะลา : ตุ๊กแก เซเลปราตรี ช่วงที่ 4/4 (15 มิ.ย.60)',
        'partner' : {
            'image': '',
            'link': ''
        }
    };


if(file_type == 'mp4')
{
    var vdo_options = 
    {
        "auth": {
            "app_id": "TUzewtzZthmfkGFx",
            "user_id": "puvanach@tencent.co.th",
            "license": "hDE3w8QbIgKNEKAaJt9gD9X4RpKhtxSc"
        },
        "mp4" : 
        {
            "240p" : "https://bmedia1.fsanook.com/3/17/HD/240p/197/3941970.mp4",
            "360p" : "https://bmedia1.fsanook.com/3/17/HD/360p/197/3941970.mp4",
            "720p HD" : "https://bmedia1.fsanook.com/3/17/HD/720p/197/3941970.mp4",
            "1080p HD" : "https://bmedia1.fsanook.com/3/17/HD/1080p/197/3941970.mp4"
        },
        
        "autoLevel": true,
        "playerid":"content_video",
        // "coverpic": {"style":"stretch", "src":"http://p3.isanook.com/vi/0/ud/3/17/jpg/197/3941970.jpg"},
        "width" : '640',
        "height" : '360',
        "autoplay" : false, 

        "watermark": {
            "image": "http://video.sanook.com/assets/vi/di/logo_sn.png",
            "link": "http://video.sanook.com"
        },
        "title": "กบนอกกะลา : ตุ๊กแก เซเลปราตรี ช่วงที่ 4/4 (15 มิ.ย.60)",
        "share": 
        {
                "facebook": true,   //default false
                "twitter": true,       //default false
                "google": true,              //default false
                "code": '<iframe width="560" height="315" src="'+paramsObj.embed+'" frameborder="0" allowfullscreen ></iframe>',
                "title": "กบนอกกะลา : ตุ๊กแก เซเลปราตรี ช่วงที่ 4/4 (15 มิ.ย.60)",
                "url": "http://video.sanook.com/player/1092653/" 
        },
        "relate": {
            items:[
                    {"title": "คนมันส์พันธุ์อาสา : Teaser ภารกิจปลูกดาวเรืองเพื่อพ่อของแผ่นดิน (15 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003814.jpg", "link": "http://video.sanook.com/player/1151089/", "duration": 60},
                    {"title": "คนค้นฅน : Teaser ซีรี่ย์ ฅนของพระราชา ตอนที่ 1 (10 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003810.jpg", "link": "http://video.sanook.com/player/1151085/", "duration": 120},
                    {"title": "กบนอกกะลา : Teaser ขบวนพระบรมอิสริยยศ 1 (10 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003806.jpg", "link": "http://video.sanook.com/player/1151081/", "duration": 180},
                    {"title": "คนมันส์พันธุ์อาสา : Teaser ภารกิจปลูกดาวเรืองเพื่อพ่อของแผ่นดิน (15 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003814.jpg", "link": "http://video.sanook.com/player/1151089/", "duration": 60},
                    {"title": "คนค้นฅน : Teaser ซีรี่ย์ ฅนของพระราชา ตอนที่ 1 (10 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003810.jpg", "link": "http://video.sanook.com/player/1151085/", "duration": 120},
                    {"title": "กบนอกกะลา : Teaser ขบวนพระบรมอิสริยยศ 1 (10 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003806.jpg", "link": "http://video.sanook.com/player/1151081/", "duration": 180},
            ]
        }, // /relateXml/1092653
        "thumbnails": '/player/screenshot?tmb=1&duration='+paramsObj.duration+'&ssurl='+paramsObj.ss+'&ran=19718', 

        listener: function(e) {
            // console.log(e);
            playerOBJ.playerEvent(e);
        },
        onAdError: function(e){
            console.log(e);
            showDebug(null, 'Ads event: '+e.l);	
        },
        onAdEvent: function(e) {
            // console.log(e);
            playerOBJ.onAdEvent(e);
        }

    };
}
else if(file_type == 'm3u8')
{
    var vdo_options = 
    {
        "auth": {
            "app_id": "TUzewtzZthmfkGFx",
            "user_id": "puvanach@tencent.co.th",
            "license": "hDE3w8QbIgKNEKAaJt9gD9X4RpKhtxSc"
        },
        "m3u8": "/liveplay/1092653.m3u8",
        
        "autoLevel": true,
        "playerid":"content_video",
        "coverpic": {"style":"stretch", "src":"http://p3.isanook.com/vi/0/ud/3/17/jpg/197/3941970.jpg"},
        // "width": '100%',
        // "height": 'auto',
        "width" : '640',
        "height" : '360',
        "autoplay" : false, 
        "watermark": {
            "image": "http://video.sanook.com/assets/vi/di/logo_sn.png",
            "link": "http://video.sanook.com"
        },
        "title": "กบนอกกะลา : ตุ๊กแก เซเลปราตรี ช่วงที่ 4/4 (15 มิ.ย.60)",
        "share": 
        {
                "facebook": true,   //default false
                "twitter": true,       //default false
                "google": true,              //default false
                "code": '<iframe width="560" height="315" src="'+paramsObj.embed+'" frameborder="0" allowfullscreen ></iframe>',
                "title": "กบนอกกะลา : ตุ๊กแก เซเลปราตรี ช่วงที่ 4/4 (15 มิ.ย.60)",
                "url": "http://video.sanook.com/player/1092653/" 
        },
        "relate": {
                items:[
                    {"title": "คนมันส์พันธุ์อาสา : Teaser ภารกิจปลูกดาวเรืองเพื่อพ่อของแผ่นดิน (15 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003814.jpg", "link": "http://video.sanook.com/player/1151089/", "duration": 60},
                    {"title": "คนค้นฅน : Teaser ซีรี่ย์ ฅนของพระราชา ตอนที่ 1 (10 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003810.jpg", "link": "http://video.sanook.com/player/1151085/", "duration": 120},
                    {"title": "กบนอกกะลา : Teaser ขบวนพระบรมอิสริยยศ 1 (10 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003806.jpg", "link": "http://video.sanook.com/player/1151081/", "duration": 180},
                    {"title": "คนมันส์พันธุ์อาสา : Teaser ภารกิจปลูกดาวเรืองเพื่อพ่อของแผ่นดิน (15 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003814.jpg", "link": "http://video.sanook.com/player/1151089/", "duration": 60},
                    {"title": "คนค้นฅน : Teaser ซีรี่ย์ ฅนของพระราชา ตอนที่ 1 (10 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003810.jpg", "link": "http://video.sanook.com/player/1151085/", "duration": 120},
                    {"title": "กบนอกกะลา : Teaser ขบวนพระบรมอิสริยยศ 1 (10 ต.ค.60)", "image":"https://p3.isanook.com/vi/0/ud/3/17/jpg/200/4003806.jpg", "link": "http://video.sanook.com/player/1151081/", "duration": 180},
            ]
        }, // /relateXml/1092653
        "thumbnails": '/player/screenshot?tmb=1&duration='+paramsObj.duration+'&ssurl='+paramsObj.ss+'&ran=19718', 

        listener: function(e) {
            // console.log(e);
            playerOBJ.playerEvent(e);
        },
        onAdError: function(e){
            console.log(e);
            showDebug(null, 'Ads event: '+e.l);	
        },
        onAdEvent: function(e) {
            // console.log(e);
            playerOBJ.onAdEvent(e);
        }

    };}





var adsManager;
var adsLoader;
var intervalTimer;

var Ads = function() 
{

   

    
    Ads.prototype.init = function()
    {

        $('#videoplayer').html('');
        this.player = new TcPlayer('videoplayer', vdo_options);
    };


    Ads.prototype.controlPlay = function(eventname) {
        showDebug(null, 'Control Play Event ='+eventname);	

        if(eventname=="initmobile"){
            this.init();
            
        }else if(eventname=="initdesktop"){
            
               this.init();
              
        }else if(eventname=="desktop_no_setting_ad"){
            
             
        }else if(eventname=="mobile_no_setting_ad"){
            
             
        }else if(eventname=="checking_play_have_ads"){
             
             
             if(is_ios()){

            }else if(is_android()){
                                     
                
                
             }
       
        }else if(eventname=="makesure_video_not_play_before_ads"){
             
                 if(is_android()){
                       
                  }
   
        }else if(eventname=="checking_play_have_ads_midroll"){
           
           
        }else if(eventname=="mobile_play_after_ad"){
             
             if(is_ios()){
   
             }else if(is_android()){       
                  
             }
           
        }else if(eventname=="nextpreroll_noad"){
             
           
        }


    };

    /*Player Event Management*/
    Ads.prototype.playerEvent = function(event) {
        switch(event.type){
            case 'timeupdate':
               var currentTime = this.currentTime();
               var durationTime = this.durationTime();
               var add_mid_offset = Math.round(durationTime/2);
            //    console.log('duration time: '+durationTime+',current time: '+currentTime);
               if(!state.midrollPlayed && currentTime > add_mid_offset)
               {
                   console.log('midroll');
                   this.playMidroll();
               }
              

            break;
            case 'AD_READY':
                console.log(event);
            break;
            case 'ready':
                console.log(event);
            break;
            case 'load':
                    console.log(event);
                    // alert(event.detail.src);
            break;
            case 'loadedmetadata':
                    console.log(event);
            break;
            
            case 'play':
                if(!state.prerollPlayed)
                {
                    state.prerollPlayed = true;
                    console.log('preroll');
                    this.playPreroll();
                    
                }
            break;

            case 'ended':
                if(!state.postrollPlayed)
                {
                    state.postrollPlayed = true;
                    console.log('postroll');
                    this.playPostroll();
                    
                }
            break;
            
        } // end switch

        if(event.type != 'progress' && event.type != 'timeupdate')
        {
            if(event.type == 'load')
            {
                showDebug(event, 'event: '+event.type+ ', file: ' + event.detail.src);
            }
            else
            {
                showDebug(event, 'event: '+event.type);
            }

        }
    };

    /*Ads Event Management*/
    Ads.prototype.onAdEvent = function (event) {
        console.log(event.type);
        switch(event.type){
            case 'adTimeUpdate':
                var remainingTime = event.remainingTime;
                var duration =  event.duration;
                var currentTime = duration - remainingTime;
                currentTime = currentTime > 0 ? currentTime : 0;
                $('#ad_timing').html('ads timing: ' + currentTime);
                $('#ads_duration').html('ads duration: ' + duration);
            break;
            case 'allAdsCompleted':
                
                if (!state.prerollPlayed && !state.midrollPlayed && !state.postrollPlayed) {		
                        
                		state.prerollPlayed = true;
                        showDebug(event, 'Ads Event : Preroll   finished');
                        
                		this.controlPlay("mobile_play_after_ad");

                }else if (state.prerollPlayed && state.midrollPlayed && !state.postrollPlayed) {		
                        state.midrollPlayed = true;
                         showDebug(event, 'Ads Event : Midroll   finished');
                        
                }else if (state.prerollPlayed && state.midrollPlayed && state.postrollPlayed) {	
                         state.postrollPlayed = true;
                         showDebug(event, 'Ads Event : Postroll  finished');
                        
                }
                
                
                showDebug(event, 'Ads Event : ads  secment finished');

                
            break;

            case 'impression':
                            
            break;
            case 'firstquartile':
            break;
            case 'midpoint':
            break;
            case 'thirdquartile':
            break;
            case 'complete':
                
            break;
            case 'click':

            break;
            case 'start':
            break;
            case 'skipped':
            break;            
        } // end switch

        if(event.type != 'adTimeUpdate')
        {
            showDebug(event, 'Ads event: '+event.type);

        }
        
    };

    Ads.prototype.currentTime = function() {

       
        $('#timing').html('currentTime: '+this.player.currentTime());
        return Math.floor(this.player.currentTime());
    };		


    Ads.prototype.durationTime = function() {
        $('#duration').html('duration: '+this.player.duration());
        return Math.floor(this.player.duration());
    };


    Ads.prototype.bind = function(thisObj, fn) {
        return function() {
            fn.apply(thisObj, arguments);
        };
    };

    Ads.prototype.playPreroll = function() {
	
        if(vastAdsURL.vast_linear!=""){
            state.adsType="preroll";
            showDebug(null, 'Ads Type:'+state.adsType+' || '+vastAdsURL.vast_linear);
            this.player.playAd(vastAdsURL.vast_linear);
        }

    };

    Ads.prototype.playMidroll = function() {
	
        if(vastAdsURL.vast_midroll!=""){
            state.adsType="midroll";
            showDebug(null, 'Ads Type:'+state.adsType+' || '+vastAdsURL.vast_midroll);
            this.player.playAd(vastAdsURL.vast_midroll);
            state.midrollPlayed = true;
        }
	
    };

        
    Ads.prototype.playPostroll = function() {
        
        if(vastAdsURL.vast_postroll!=''){
            state.adsType="postroll";
            showDebug(null, 'Ads Type:'+state.adsType+' || '+vastAdsURL.vast_postroll);
            this.player.playAd(vastAdsURL.vast_postroll);
            state.postrollPlayed = true;
        }else{

        }	
        
    };
};




(function() {

    document.write('<div id="videoplayer">Loading...</div><div>vod-ima-0.1.10.js</div><div id="ad_timing">ad timing: 0.0</div><div id="ads_duration">ads duration: 0.0</div><div id=\"duration">duration: 0.0</div><div id="timing">timing: 0.0</div><div id="debug">&nbsp;</div>');

		
    var delayparam;
		var delaynums=0;
	
		
        playerOBJ = new Ads();  
            if(is_mobile()){
                playerOBJ.controlPlay('initmobile');
            }else{
                playerOBJ.controlPlay('initdesktop'); //firstime
            }	


})();


</script>

<style>

#poster{
    background-repeat: no-repeat;
    background-size: 100% 100%;
	width:100%;
	height:100%;
	display: inline-block;
	position: relative;
}

#imgposter{

	  max-height: 100%;
	  max-width: 100%;
	  width: 20%;
	  height: 30%;
	  position: absolute;
	  top: 0;
	  bottom: 0;
	  left: 0;
	  right: 0;
	  margin: auto;

}

</style>





</body>
</html>