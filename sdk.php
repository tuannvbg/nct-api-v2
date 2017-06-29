<?php

/* Begin With Some Note 
	
	* This SDK is not by NCT Crop
	* This SDK is not for COMMERCIAL
	* The SDK by Phuc Phoenix (github@phuchptty)
	* You Can Find Me At
		+ Facebook: https://facebook.com/hoangphuchotboy
		+ Twitter : @phuchptty
		+ GitHub  : phuchptty
	* Share free at GitHub, BitBucket and J2Team Community
	* DO NOT EDIT UNLESS YOU KNOW ABOUT CODING. JUST WAIT FOR A NEW UPDATE

This is END */

class NCT {

	private function getToken(){

		$headers = array();
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Host: graph.nhaccuatui.com';
		$headers[] = 'Connection: Keep-Alive';
		
		
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, "https://graph.nhaccuatui.com/v2/commons/token");
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($c, CURLOPT_POST, 1);
		curl_setopt($c, CURLOPT_POSTFIELDS, "deviceinfo=%7B%22DeviceID%22%3A%22dd03852ada21ec149103d02f76eb0a04%22%2C%22DeviceName%22%3A%22TrolyFaceBook.Com%22%2C%22OsName%22%3A%22SmartTV%22%2C%22OsVersion%22%3A%228.0%22%2C%22AppName%22%3A%22NCTTablet%22%2C%22AppVersion%22%3A%221.3.0%22%2C%22UserName%22%3A%220%22%2C%22QualityPlay%22%3A%22128%22%2C%22QualityDownload%22%3A%22128%22%2C%22QualityCloud%22%3A%22128%22%2C%22Network%22%3A%22WIFI%22%2C%22Provider%22%3A%22BeDieuApp%22%7D%0A&md5=488c994e95caa50344d217e9926caf76&timestamp=1497863709521");


		$page = curl_exec($c);
		curl_close($c);
		
		$a = json_decode($page,true);
		
		if ($a['code'] == "0"){
			
			$a = $a['data'];
			return $a['accessToken'];
		
		}else{
			return "Get Token Error";
		}

		return $infotoken;
	}

	private $nct_v1_token_key = "nct@asdgvhfhyth1391515932000";

	private $index = 1;

	private $size = 30;

	private function getV1Curl($url){
		
		$ch = @curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$head[] = "Connection: keep-alive";
		$head[] = "Keep-Alive: 300";
		$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$head[] = "Accept-Language: en-us,en;q=0.5";
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		$page = curl_exec($ch);
		curl_close($ch);
		return $page;
	}

	private function createV1Token($type,$id){
		return md5($type.$id.$this ->nct_v1_token_key);
	}

	private function createV1SearchToken($type,$keyword){
		return md5($type.$keyword.$this -> index.$this -> size.$this ->nct_v1_token_key);
	}

	private function buildV1URL($action,$token,$option){

		$api = 'http://api.m.nhaccuatui.com/mobile/v5.0/api?secretkey=nct@mobile_service&deviceinfo={"DeviceID":"90c18c4cb3c37d442e8386631d46b46f","OsName":"ANDROID","OsVersion":"10","AppName":"NhacCuaTui","AppVersion":"5.0.1","UserInfo":"","LocationInfo":""}&pageindex='.$this -> index.'&pagesize='.$this -> size.'&time=1391515932000&token='.$token.'&action='.$action.'&'.$option;
		return $api;
	}


	/* Begin API Music V2 */

	public function getSongDetail($id){
	
		$linklist = 'https://graph.nhaccuatui.com/v2/songs/'.$id.'?access_token='.$this -> getToken();
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $linklist);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

		$page = curl_exec($c);
		curl_close($c);
		
		$data = json_decode($page,true);
		
		if ($data['code'] != 0){
			return $data['msg'];
		}else{

			$a = $data['data'];

			$array = array(

				"SongID" => $a[1],
				"SongName" => $a[2],
				"SongSinger" => $a[3],
				"SongLike" => $a[4],
				"SongListen" => $a[5],
				"SongLink" => $a[6],
				"SongStreamLink" => $a[7],
				"SongThumbnail" => $a[8],
				"SongDuration" => $a[10],
				"SongDownload128" => $a[11],
				"SongDownload320" => $a[12],
				"SongDownloadLosLess" => $a[19]				

			);
			
			return $array;
		}
	
	}

	function getVideoDetail($id){
	
		$linklist = 'https://graph.nhaccuatui.com/v1/videos/'.$id.'?access_token='.$this -> getToken();
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $linklist);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

		$page = curl_exec($c);
		curl_close($c);
		
		$data = json_decode($page,true);
		
		if ($data['code'] != 0){
			return $data['msg'];
		}else{

			$a = $data['data'];

			$array360 = array(

				"VideoQuality" => $a[12][0][1],
				"VideoStreamLink" => $a[12][0][2],
				"VideoDownloadLink" => $a[12][0][4],

			);

			$array480 = array(

				"VideoQuality" => $a[12][1][1],
				"VideoStreamLink" => $a[12][1][2],
				"VideoDownloadLink" => $a[12][1][4],

			);

			$array720 = array(

				"VideoQuality" => $a[12][2][1],
				"VideoStreamLink" => $a[12][2][2],
				"VideoDownloadLink" => $a[12][2][4],

			);

			$array1080 = array(

				"VideoQuality" => $a[12][3][1],
				"VideoStreamLink" => $a[12][3][2],
				"VideoDownloadLink" => $a[12][3][4],

			);

			$array = array(

				"VideoID" => $a[1],
				"VideoName" => $a[2],
				"VideoThumbnail" => $a[3],
				"VideoArtis" => $a[4],
				"VideoDuration" => $a[5],
				"VideoLike" => $a[6],
				"VideoView" => $a[7],
				"VideoLink" => $a[8],
				"VideoStreamURL" => $a[9],
				"Video360" => $array360,
				"Video480" => $array480,
				"Video720" => $array720,
				"Video1080" => $array1080,

			);
			
			return $array;
		}
	
	}

	public function getPlaylistDetail($id){
	
		$linklist = 'https://graph.nhaccuatui.com/v1/playlists/'.$id.'?access_token='.$this -> getToken();
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $linklist);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

		$page = curl_exec($c);
		curl_close($c);
		
		$data = json_decode($page,true);
		
		if ($data['code'] != 0){
			return $data['msg'];
		
		}else{

			$a = $data['data'];

			$array = array(

				"PlaylistID" => $a[1],
				"PlaylistName" => $a[2],
				"PlaylistThumbnail" => $a[4],
				"PlaylistArtis" => $a[5],
				"PlaylistLink" => $a[6],
				"PlaylistView" => $a[7],
				"PlaylistLink" => $a[8],
				"PlaylistSongDetail" => $a[9],
				"PlaylistDescription" => $a[11],

			);

			return $array;

		}
		
	}


	/* Begin API Music + SMT V1 */

	private function getSongIntID($songid){
		$detail = $this -> getSongDetail($songid);
		$streamurl = $detail['SongStreamLink'];

		$a = explode('/', $streamurl);
		$a = $a[6];

		$b = explode('-', $a);
		$c = explode('.', $b[count($b) -1]);

		return $c[0];

	}


	public function getLyric($id){
		if (!isset($id) || $id == NULL){
			return false;
		}
		$id = $this -> getSongIntID($id);

		$token = $this -> createV1Token("get-lyric",$id);
		
		$url = $this -> buildV1URL("get-lyric",$token,"songid=".$id);

		$a = $this -> getV1Curl($url);

		$b = json_decode($a,true);

		if ($b['Result'] != 1){
			return false;
		}

		$a = $b['Data'];

		$array = array(
			"Lyric" => $a['Lyric'],
			"LyricWithTime" => $a['TimedLyric'],
			"Creator" => $a['UsernameCreated'],
		);

		return $array;
	}

	public function getSongSearch($keyword,$page = 1,$size = 10){

		$this -> index = $page;
		$this -> size = $size;

		$token = $this -> createV1SearchToken("search-song",$keyword);
		$url = $this -> buildV1URL("search-song",$token,"keyword=".$keyword);

		$a = $this -> getV1Curl($url);

		$b = json_decode($a,true);

		
		if ($b['Result'] != 1){
			return false;
		}
		

		return $a;
	}

	public function getVideoSearch($keyword,$page = 1,$size = 10){

		$this -> index = $page;
		$this -> size = $size;

		$token = $this -> createV1SearchToken("search-video",$keyword);
		$url = $this -> buildV1URL("search-video",$token,"keyword=".$keyword);

		
		$a = this -> getV1Curl($url);

		$b = json_decode($a,true);

		if ($b['Result'] != 1 || $b['Result'] != true){
			return "Error";
		}
		
		return $a;
	}

}