<?php
/*
文件上传方法
@param $



前端上传图片及时显示
  1.找到type='file'标签

  2找0的下标

  3.找files的下标

  4.找0的下标



获取图片地址
@param file FileOBject
*/

function upload($file){
if(!$_FILES){ //判断html有没有问题 并且不能上传
        echo '<script>alert("上传异常");window.location.href="index.php?m=1&c'.C.'&a='.A.'"</script>';
        exit;
    }

	if($file['size']>2*1024*1024){
		echo '<script>alert("文件过大");window.location.href="index.php?m=1&c='.C.'&a='.A.'"</script>';
		exit;  //终止
	}
	// print_r($_FILES['img']);die;
	$num = strrpos($file['type'],'/');
	// 获取图片名称中点的位置
	$type = substr($file['type'],$num+1);//获取后缀
	$allow = ['jpg','png','gif','jpeg'];//从数组中选择文件上传的类型
	if(!in_array($type,$allow)){//判断当前文件上传类型
      
        echo '<script>alert("文件类型不正确");window.location.href="index.php?m=1&c='.C.'&a='.A.'"</script>';

        exit;
	}
	// 图片名称
	$name = 'img_'.mt_rand(000000,999999).time();// mt_rand()随机数
    //创建文件夹
    $path = 'resources/admin/uploads/';
    if(!file_exists($path)){//判断是否存在这个路径
        mkdir($path);//创建文件夹
    }
    $data= date('Y-m-d');//定义时间格式
    $path= $path.$data.'/';//拼接时间路径
    if(!file_exists($path)){//判断这个路径是否存在
    	mkdir($path);//创建时间文件
    }
    $path .= "$name.$type";
    $res = move_uploaded_file($file['tmp_name'], $path);//将上传的文件移到新路径下
    return $path;  //返回结果  为了让程序知道文件上传到哪里去了
}
        

/*
分页
*/
function page($table,$page,$show_data_num=5,$max_btn_num = 5){
$data = select("select count(id) as num from $table");
// 数据总条数
$total = $data[0]['num'];  //cont($data);
//每页显示条数
//$show_data_num = 5;
// 按钮数或者分页数
$page_num = ceil($total/$show_data_num);  //ceil()向上取整

//按钮固定个数组多现实额的按钮个数
//$max_btn_num = 5;
//中间按钮数
$center_btn = ceil($max_btn_num/2);
//当前页(地址栏的page)
//$page =isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :1;
// 开始位置
$start=1;
// 结束为止
$end = $max_btn_num;
// 判断结束位置大于总按钮数(总页数)
if($end>$page_num ){
$end=$page_num;
}
// 当前页大于中间按钮数
if($page>$center_btn){
    $start = $page-($center_btn-1);
    $end = $page+($center_btn-1);
}
// 判断结束位置大于总按钮数(总分页数)
if($end>$page_num){
    $end = $page_num;
    $start = $end-4;
}
//准备组装分页的变量($max_btn_num-1)
$str = '<li><a href="index.php?m=1&c='.C.'&a='.A.'&page='.($page==1 ? 1:$page-1).'">&laquo;</a></li>';
for($i=$start;$i<=$end;$i++){
    if($page == $i){
     $str.='<li class="active"><a href="index.php?m=1&c='.C.'&a='.A.'&page='.$i.'">'.$i.'</a></li>';
    }else{
    $str.='<li><a href="index.php?m=1&c='.C.'&a='.A.'&page='.$i.'">'.$i.'</a></li>';
}  
 }    
    
$str.='<li><a href="index.php?m=1&c='.C.'&a='.A.'&page='.($page==$page_num?$page:$page+1).'">&raquo;</a></li>';

 return $str;

}



function pageHome($table,$page,$show_data_num=2,$max_btn_num = 2){
$data = select("select count(id) as num from $table");
// 数据总条数
$total = $data[0]['num'];  //cont($data);
//每页显示条数
//$show_data_num = 5;
// 按钮数或者分页数
$page_num = ceil($total/$show_data_num);  //ceil()向上取整

//按钮固定个数组多现实额的按钮个数
//$max_btn_num = 5;
//中间按钮数
$center_btn = ceil($max_btn_num/2);
//当前页(地址栏的page)
//$page =isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :1;
// 开始位置
$start=1;
// 结束为止
$end = $max_btn_num;
// 判断结束位置大于总按钮数(总页数)
if($end>$page_num ){
$end=$page_num;
}
// 当前页大于中间按钮数
if($page>$center_btn){
    $start = $page-($center_btn-1);
    $end = $page+($center_btn-1);
}
// 判断结束位置大于总按钮数(总分页数)
if($end>$page_num){
    $end = $page_num;
    $start = $end-4;
}
//准备组装分页的变量($max_btn_num-1)
$str = '<li class="active" ><a href="index.php?&c='.C.'&a='.A.'&page='.($page==1 ? 1:$page-1).'">&laquo;</a></li>';
for($i=$start;$i<=$end;$i++){
    if($page == $i){
     $str.='<li ><a href="index.php?&c='.C.'&a='.A.'&page='.$i.'">'.$i.'</a></li>';
    }else{
    $str.='<li><a href="index.php?&c='.C.'&a='.A.'&page='.$i.'">'.$i.'</a></li>';
}  
 }    
    
$str.='<li class="active" ><a href="index.php?&c='.C.'&a='.A.'&page='.($page==$page_num?$page:$page+1).'">&raquo;</a></li>';

 return $str;

}

/*
*递归
*/
function getCates($table,$data=[],$id=0,$num = 0){
    $cate_data = select("select * from $table where pid=$id");
      foreach ($cate_data as $k => $v) {
        $data[$v['id']]['name']=str_repeat('|--', $num).$v['name'];
        $data[$v['id']]['id']=$v['id'];
        $data[$v['id']]['pid']=$v['pid'];
        
        $data = getCates($table,$data,$v['id'],$num +1);
 }
      return $data;
}



/*
生成验证码方法
*/

function getCode(){
header("Content-type: image/png");
$width = 120;
$height = 45;
//画图
$img = imagecreatetruecolor($width, $height);

//生成颜色
$bg_color = imagecolorallocate($img, 0, 0, 0);
//画个矩形
imagefilledrectangle($img, 0, 0, $width, $height, $bg_color);


//画边框
$border_color = imagecolorallocate($img, 0, 255, 0);
imagerectangle($img, 0, 0, $width-1, $height-1,$border_color);


//生成点
for ($i=0; $i < 150; $i++) { 
    $pixel_color = imagecolorallocate($img, mt_rand(100,200), mt_rand(100,200), mt_rand(100,200));
    imagesetpixel($img, mt_rand(0, $width),mt_rand(0, $height),$pixel_color);
}


for ($i=0; $i < 6; $i++) { 
$arc_color = imagecolorallocate($img, mt_rand(100,200), mt_rand(100,200), mt_rand(100,200));
imagearc($img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,360),mt_rand(0,360),$arc_color);
}

// 取A-Z，a-z，0-9随机数组
$str = implode(range('A', 'Z')).implode(range('a', 'z')).implode(range('0', '9'));

$code = '';   //保存code的字符串

for ($i=0; $i < 4; $i++) { 
    //每次随机取一位
    $index = mt_rand(0, strlen($str)-1);
    $code .= $str[$index]; //每次生成以为随机数用 .= 追加进来 拿到字符$str[$index]

    $text_color = imagecolorallocate($img, mt_rand(100,200), mt_rand(100,200), mt_rand(100,200));
    imagettftext($img,30,mt_rand(0,18),$i*20 +20,33,$text_color,'D:\phpstudy_pro\WWW\mvc\resources\admin\fonts\simfang.ttf',$str[$index]);
}

// 存session做判断
$_SESSION['code']=$code;

// 清除缓冲区 防止第二天图片消失
ob_clean();

//生成图像 png格式的
imagepng($img);

//销毁图片
imagedestroy($img);//通常与生成图片连用

}



/*
缩略图

流程
1.获取原始图片并将图片转化为字符串 file_get_contents
2.常见原始图像资源（转化为资源）
3.获取原始图片的宽高
4.创建缩略图片资源
5.将原始图片资源拷贝到新图像资源
6.定义缩略图片存储的路径和名称
7.获取缩略图片后缀
8.按照新路径生成缩略图片
*/

function getThumb($img_path,$w=50,$h=50){
    //缩略图   大图转小图存储
    $filename  = 'ground.png';
    // 1.获取原始图片并将图片转化为字符串 file_get_contents
    $img_str =  file_get_contents($img_path);
    // 2.常见原始图像资源（转化为资源)
    $img_res = imagecreatefromstring($img_str);
    // 3.获取原始图片的宽高
    list($width, $height) = getimagesize($img_path);
    // 4.创建缩略图片资源
    $thumb = imagecreatetruecolor($w, $h);
    // 5.将原始图片资源拷贝到新图像资源
    imagecopyresized($thumb, $img_res, 0, 0, 0, 0, $w, $h, $width, $height);
    // 6.定义缩略图片存储的路径和名称
    $name = 'thumb_'.mt_rand(000000,999999).time();
    $path = 'resources/admin/uploads/'.date('Y-m-d').'/thumb/';
    if(!file_exists($path)){//判断是否存在这个路径
        mkdir($path);//创建文件夹
    }
    // 7.获取缩略图片后缀
    $num =strrpos($img_path, '.');
    $type = substr($img_path,$num+1);
    $thumb_path=$path.$name.'.'.$type;
    // 8.按照新路径生成缩略图片
    imagepng($thumb,$thumb_path);

    return $thumb_path;
}



/*
水印图
*/
function getFonWater($img_path){
    //缩略图   大图转小图存储
    // 1.获取原始图片并将图片转化为字符串 file_get_contents
    $img_str =  file_get_contents($img_path);
    // 2.创见原始图像资源（转化为资源)
    $img_src = imagecreatefromstring($img_str);
    // 3.获取原始图片的宽高
    list($width, $height) = getimagesize($img_path);

    // 4.创建水印图片资源
    // $water = imagecreatetruecolor($width,$height);
    
    $textcolor=imagecolorallocate($img_src, 255, 0, 0);
    $x=$width/2;
    $y=$height/2;
    // 5.将原始图片资源拷贝到新图像资源
    imagettftext($img_src,30, 0, $x, $y, $textcolor,'D:\phpstudy_pro\WWW\mvc\resources\admin\fonts\simfang.ttf', 'wwwwyyyy');
    // imagestring($img_str,5,$width/2, $height/2, 'wy', $textcolor);
    // 6.定义缩略图片存储的路径和名称
    $name = 'water_'.mt_rand(000000,999999).time();
    $path = 'resources/admin/uploads/'.date('Y-m-d').'/water/';
    if(!file_exists($path)){//判断是否存在这个路径
        mkdir($path);//创建文件夹
    }
    // 7.获取缩略图片后缀
    $num =strrpos($img_path, '.');
    $type = substr($img_path,$num+1);
    $water_path=$path.$name.'.'.$type;

    // 8.按照新路径生成缩略图片
    imagepng($img_src,$water_path);

    return $water_path;
}



/*
图片水印
*/
function getimgWater($img_path){
    // 1.获取原始图片并将图片转化为字符串 file_get_contents
    $img_str =  file_get_contents($img_path);
    // 2.创见原始图像资源（转化为资源)
    $img_src = imagecreatefromstring($img_str);
    // 3.获取原始图片的宽高
    list($width, $height) = getimagesize($img_path);
    // 4.获取水印图片资源
    $water_src = imagecreatefromjpeg('D:\phpstudy_pro\WWW\mvc\resources\admin\img\shuiyin.jpeg');
   list($w,$h) = getimagesize('D:\phpstudy_pro\WWW\mvc\resources\admin\img\shuiyin.jpeg');
   // 5.计算文字在图片上出现的坐标位置
    $x=$width-$w;
    $y=$height-$h;
    // 将水印图片放置右下角
    imagecopy($img_src, $water_src, $x, $y, 0, 0, $w, $h);

    // 6.定义缩略图片存储的路径和名称
    $name = 'water_'.mt_rand(000000,999999).time();
    $path = 'resources/admin/uploads/'.date('Y-m-d').'/water/';
    if(!file_exists($path)){//判断是否存在这个路径
        mkdir($path);//创建文件夹
    }
    // 7.获取缩略图片后缀
    $num =strrpos($img_path, '.');
    $type = substr($img_path,$num+1);
    $water_path=$path.$name.'.'.$type;

    // 8.按照新路径生成缩略图片
    imagepng($img_src,$water_path);

    return $water_path;
}