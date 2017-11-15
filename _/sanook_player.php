<html >
<head>
<meta charset="utf-8">
<script src="http://p3.isanook.com/de/0/shared/js/vendors/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="http://p3.isanook.com/sh/0/js/mobile-detect.min.js"></script>
<script src="http://video.sanook.com/assets/vi/js/jwplayer-7.8.7/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="WY6JkPZYIN0Po/wQoZS9PZs8hBaGeneyoNd5pA==";</script>
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
</script>
</head>

<div class="player" id="mediaplay">
<div>
	<p>Loading...</p>
</div>
</div>
<div id="ad_timing">ad timing: 0.0</div>
<div id="ads_duration">ads duration: 0.0</div>
<div id="duration">duration: 0.0</div>
<div id="timing">timing: 0.0</div>
<div id="debug">&nbsp;</div>


<script>
var ads_idx = 0;
var vast_linear=new Array;
var vast_linear_vpaid = new Array;
var vast_linear_3party = new Array;
// vast_linear[0] = 'http://';
vast_linear[0] = 'https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dskippablelinear&correlator=';//desktop
vast_linear[1] ='https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dlinear&correlator=';//mobile
vast_linear_vpaid[0] = "http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=is&c=23&pl=VAST&pli=10724976&PluID=0&pos=113&ord=%5btimestamp%5d&cim=1&t=1&ai=23227072";//vaid
vast_linear_3party[0] = "http://bs.serving-sys.com/Serving?cn=display&c=23&pl=VAST&pli=20266289&PluID=0&pos=5471&ord=419529&cim=1";
// vast_linear[1] = 'https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/4899711/MOBILE.PREROLL&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&url=[referrer_url]&description_url=[description_url]&correlator=[timestamp]&dd';//mobile
// vast_linear[0] = 'http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=is&c=23&pl=VAST&pli=17072322&PluID=0&pos=5435&ord=1461839794324&cim=1';
// vast_linear[1] = 'http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=is&c=23&pl=VAST&pli=17168576&PluID=0&pos=7347&ord=1461838580572&cim=1';
// vast_linear[2] = 'http://myaday.net/c/otv_ads.xml';
/*vast_linear[1] = 'http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=is&c=23&pl=VAST&pli=17168283&PluID=0&pos=7416&ord=1461839545684&cim=1';
vast_linear[2] = 'http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=is&c=23&pl=VAST&pli=17168576&PluID=0&pos=7347&ord=1461838580572&cim=1';
vast_linear[3] = 'http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=is&c=23&pl=VAST&pli=17180387&PluID=0&pos=6165&ord=1461900109921&cim=1';
vast_linear[4] = 'http://backoffice.video.sanook.com/communitygroup_/20140107-preload-Dplusfeb.html';
vast_linear[5] = 'http://backoffice.video.sanook.com/communitygroup_/otv_ads.xml'; */

var  vast_midroll = "http://myaday.net/c/adskip.php";
var vast_postroll = "http://myaday.net/c/adskip.php";

var ads_type = '<?=$_GET['ads_type']?>';
if(ads_type =='vpaid')
{
	linears_link  = vast_linear_vpaid[ads_idx];
}
else if(ads_type == 'dfp')
{
    var md = new MobileDetect(window.navigator.userAgent);
    if(!md.mobile() && !md.tablet())
    {
        console.log('desktop');
		linears_link  = vast_linear[ads_idx];

	}
    else
    { // mobile
        console.log('mobile');
		linears_link  = vast_linear[1];

    }
}
else{
	linears_link = vast_linear_3party[ads_idx];
}


			//$('#ads_url').html('<a href="'+linears_link+'" target="_blank">'+linears_link+'</a>');
			$('#ads_url').html('<a href="'+linears_link+'" target="_blank">'+linears_link+'</a>');
			nonelinears_link = '';

			var paramsObj = {
						'vdo_type': 'vdo',
						'vdo_link': 'http://video.sanook.com/player/1092653/',
						'file': {
							'video': 'http://prepro.video.sanook.com/liveplay/1092653.m3u8',
						},
						'image': 'https://p3.isanook.com/vi/0/ud/3/17/jpg/197/3941970.jpg',
						'ss': 'https://p3.isanook.com/vi/0/ud/3/17/ss/197/3941970.jpg',
						'duration': '644',
						'embed': 'http://video.sanook.com/embed/player/1092653',
						'relate_file': 'http://prepro.video.sanook.com/relateXml/1092653',
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

				var file_type = '<?=$_GET['file_type']?>';
				if(file_type == 'mp4')
				{
					var _file = [
						{
							file: "https://bmedia1.fsanook.com/3/17/HD/240p/197/3941970.mp4", label: "240p"
						},{
							file: "https://bmedia1.fsanook.com/3/17/HD/360p/197/3941970.mp4", label: "360p"
						},{
							file: "https://bmedia1.fsanook.com/3/17/HD/720p/197/3941970.mp4", label: "720p HD"
						},{
							file: "https://bmedia1.fsanook.com/3/17/HD/1080p/197/3941970.mp4", label: "1080p HD"
						}
					]
				}
				else if(file_type == 'm3u8')
				{
					var _file = [{file: paramsObj.file.video}]
				}

				var trackObj = {
					file: 'http://prepro.video.sanook.com/player/screenshot?tmb=1&duration='+paramsObj.duration+'&ssurl='+paramsObj.ss+'&ran=19718',
					kind: "thumbnails"
				}

				var ads_obj = {};
				ads_obj.adbreak1 = {offset: "pre",tag: linears_link }
				var add_mid_offset = Math.round(paramsObj.duration/2);//Math.round(duration/2);
				ads_obj.adbreak2 = {offset: add_mid_offset,tag: vast_midroll }
				ads_obj.adbreak3 = {offset: "post",tag: vast_postroll }

				jwplayer('mediaplay').setup({
				    'primary': 'html5',
					'sources': _file,
					'image': paramsObj.image,
					'tracks': [trackObj],
					'autostart': false,
					'width': '615',
					'height': '400',
					'startparam':'start',
					'androidhls': true,
					skin: {
						name: "glow"
					},
					'logo' : {
						'file': 'http://video.sanook.com/assets/vi/di/logo_sn.png',
						'link': 'http://video.sanook.com/',
						'linktarget': '_blank',
						'position': 'top-left',
						'hide': false
					},
					'related': {
						file:  paramsObj.relate_file,
						dimensions: '240x160',
						heading: 'วิดีโอที่เกี่ยวข้อง',
						onclick: 'link'
					},
					sharing: {
						code: encodeURI('<iframe width="560" height="315" src="'+paramsObj.embed+'" frameborder="0" allowfullscreen ></iframe>'),
						link: paramsObj.vdo_link
					  },
					  plugins: {
						'http://prepro.video.sanook.com/assets/vi/js/jwplayer-7.8.7/plugin/title_e.v1.1.js': {
							text:'<a class="title-embed" style="cursor: pointer; color: #FFFFFF;" href="'+paramsObj.vdo_link+'" target="_blank" title="'+paramsObj.title+'" >'+paramsObj.title+'</a>'
						}
					},
				   advertising: {
					  client: "googima",
					  schedule: ads_obj
					},
					events: {
						onTime : function(ev){
							$('#timing').html('timing: ' + ev.position);
							$('#duration').html('duration: ' + ev.duration);

						},//end onTime
						onAdTime : function(ev){
							// console.log('onAdTime');
							// console.log(ev);
							$('#ad_timing').html('ads timing: ' + ev.position);
							$('#ads_duration').html('ads duration: ' + ev.duration);

						},//end onAdsTime
						// adRequest : function(ev){
						// 	// console.log('adRequest');
						// 	console.log(ev);
						// 	showDebug(ev, 'Ads Event: adRequest');
						// },

						adStarted : function(ev){
							// console.log('vpaid');
							// console.log(ev);
							showDebug(ev, 'Ads Event (VPAID only): adStarted');
							showDebug(ev, 'creativetype: '+ev.creativetype+' || tag: '+ ev.tag);

						},
						onAdClick : function(ev){
							showDebug(ev, 'Ads Event: onAdClick');
						},//end onAdClick
						onAdSkipped : function(ev){
							showDebug(ev, 'Ads Event: onAdSkipped');
						},
						onAdComplete : function(ev){
							showDebug(ev, 'Ads Event: onAdComplete');
						},
						onAdImpression: function(ev)
						{
							showDebug(ev, 'Ads Event: onAdImpression');
						},
						onAdError: function(ev)
						{
							console.log(ev);
							showDebug(ev, 'Ads Event: '+ ev.message +' || '+ ev.tag);
						},
						onPlay: function(ev){// increas_stat on vdo (embed or web)//
							// console.log('onPlay');
							// console.log(ev);
							showDebug(ev, 'Player Event: onPlay');
						},// end of increas_stat on vdo (embed or web)//
						onComplete : function(){
							showDebug(null, 'Player Event: onComplete');
						},
						onError : function(){
							showDebug(null, 'Player Event: onError');
						},
					}




				  });

				jwplayer('mediaplay').on('ready', function(ev) {
					console.log(ev);
					// console.log('setup ready');
					showDebug(ev, 'Player Event: setup ready, loading ='+ ev.setupTime/1000);
				});

				jwplayer('mediaplay').on('beforePlay', function() {
					// console.log('beforePlay:');
					showDebug(null, 'Player Event: beforePlay');
				});
				jwplayer('mediaplay').on('pause', function(ev) {
					showDebug(ev, 'Player Event: OnPause');
				});
				jwplayer('mediaplay').on('seek', function(ev) {
					showDebug(ev, 'Player Event: OnSeek to '+ ev.position);
				});
				jwplayer('mediaplay').on('seeked', function() {
					showDebug(null, 'Player Event: OnSeeked');
				});
				jwplayer('mediaplay').on('beforeComplete', function() {
					showDebug(null, 'Player Event: beforeComplete');
				});



				jwplayer('mediaplay').on('adPlay', function(ev) {
					showDebug(ev, 'Ads Event: adPlay');
				});
				jwplayer('mediaplay').on('adPause', function(ev) {
					showDebug(ev, 'Ads Event: adPause');
				});
				jwplayer('mediaplay').on('adRequest', function(ev) {
					console.log(ev);
					showDebug(ev, 'Ads Event: adRequest');
					showDebug(ev, 'ad position: '+ ev.adposition +' || ads client: '+ ev.client+' || ads tag: '+ ev.tag);
				});


</script>

<style>
	.jw-icon-rewind {
	display: none !important;
	}

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


</style>

</html>
