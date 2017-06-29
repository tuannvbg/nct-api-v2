<?php

require_once("sdk.php");

$nct = new NCT;

print_r($nct -> getVideoSearch("em chua 18",1,5));

print_r($nct -> getSongSearch("em chua 18",1,5));

print_r($nct -> getSongDetail("HUrRmiQuz1P7"));

print_r($nct -> getSongDetail("zwMCvLWwwaEqZ"));

print_r($nct -> getPlaylistDetail("8MhBtO3rwQKe"));

print_r($nct -> getLyric("HUrRmiQuz1P7"));

?>