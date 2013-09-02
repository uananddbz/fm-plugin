<?php
function file_size($url){
	$size = filesize($url);
	if($size >= 1073741824){
		$fileSize = round($size/1024/1024/1024,1) . 'GB';
	}elseif($size >= 1048576){
		$fileSize = round($size/1024/1024,1) . 'MB';
	}elseif($size >= 1024){
		$fileSize = round($size/1024,1) . 'KB';
	}else{
		$fileSize = $size . ' bytes';
	}
	return $fileSize;
}
?>

<input type="text" id="filter" placeholder="search" />
<?php
$bd=isset($_POST['bd'])?$_POST['bd']:".";
$d=isset($_POST['d'])?$_POST['d']:$bd;

//breadcrump
$da=explode("/",$d);
if (count($da)>1) {
$last=array_slice($da,-1);
$path=array_splice($da,1,-1);

$link=$bd;
echo '<div id="breadcrumb"><a class="dir" href="'.$link.'">'.$bd.'</a><span class="divider">/</span>';
foreach ($path as $a) {
$link.='/'.$a;
echo "<a class='dir' href='$link'>$a</a><span class='divider'>/</span>";
}
echo '<span class="active">'.$last[0].'</span>';
}
else {
echo '<div id="breadcrumb"><span class="active">'.$bd.'</span>';
}
echo '</div>';




//files and folder list

$pd=scandir($d);
echo '<ul id="file_list">';
if (count($pd)>2) {

foreach ($pd as $f) {
if ($f=='.' or $f=='..') {}
elseif (is_dir($d.'/'.$f)) {
echo "<li><a class='dir' href='$d/$f'>$f</a></li>";
}
else
echo "<li><a class='file' href='$d/$f'>$f</a><span class='size'>".file_size($d.'/'.$f).'</span></li>';
}


}

else {
echo '<li class="empty">no files</li>';
}

echo '</ul>';
?>
