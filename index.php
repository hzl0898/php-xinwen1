<?php
session_start(); 
require 'conn.php';
require 'function.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>新闻网站</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/roll.js"></script>
</head>
<body>
<div class="loops">
  <?php 
require_once 'header.php';
?>
  <div id="rolls" class="rolls">
    <div class="hd">
      <ul>
        <?php 
			  $query =  mysql_query( "SELECT * FROM `content` where photo!='' ORDER BY id desc limit 0,5");
			  $i=0;
				while ($row = mysql_fetch_array($query)) {
					$i++;		
					echo '<li>'.$i.'</li>';
			}
			?>
      </ul>
    </div>
    <div class="bd">
      <ul>
        <?php 
			  	$query =  mysql_query( "SELECT * FROM `content` where photo!='' ORDER BY id desc limit 0,5");
				while ($row = mysql_fetch_array($query)) {
					echo '<li><a href="content.php?id='.$row['id'].'" title="'.$row['title'].'"><img src="upfile/'.$row['photo'].'" /></a></li>';
								
			}
			?>
      </ul>
    </div>
  </div>
  <div class="newsbox">
    <div class="newstitle">最近更新</div>
    <ul class="newslist">
      <?php 
   
		$query =  mysql_query( "SELECT * FROM `content`   ORDER BY id desc limit 0,3");
		while ($row = mysql_fetch_array($query)) {
	?>
      <li style="text-align:center"><a href="content.php?id=<?php echo $row[id];?>"><strong><?php echo $row[title];?></strong></a>
        <p style="text-align:left"><?php echo cnsubstr(strip_tags($row[content]),0,60);?></p>
      </li>
      <?php			  
		}
	?>
    </ul>
  </div>
  <?php
  $sql="select * from `column`";
  $res=mysql_query($sql);
  while($d=mysql_fetch_array($res))
  {
	 
  ?>
  <div class="listloop">
    <div class="title"><a href="list.php?id=<?php echo $d[id]?>"><?php echo $d[name];?></a></div>
    <ul class="list">
      <?php 
   $sql= "SELECT * FROM `content` where columnid=$d[id] ORDER BY id desc limit 0,6";
  
		$query =  mysql_query($sql);
		while ($row = mysql_fetch_array($query)) {
	?>
      <li><em><?php echo cnsubstr($row[addtime],0,10);?></em><a href="content.php?id=<?php echo $row[id];?>"><?php echo $row[title];?></a> </li>
      <?php			  
		}
	?>
    </ul>
  </div>
  <?php
  }
  
  ?>
  <div class="roll_left">
      <div class="hd">图片新闻</div>
      <div class="bd2">
        <ul class="picList">
          <?php
  $query =  mysql_query("SELECT * FROM `content` where  photo!='' Order BY id desc limit 0,6");
	while ($row = mysql_fetch_array($query)) {
		?>
          <li>
            <div class="pic"><a href="content.php?id=<?php echo $row['id'];?>"><img src="upfile/<?php echo $row['photo'];?>" /></a></div>
            <div class="title"><a href="content.php?id=<?php echo $row['id'];?>"><?php echo $row['title'];?></a></div>
          </li>
          <?php
    }
  ?>
        </ul>
      </div>
    </div>
  <div class="clear"></div>
  <div class="footer"> CopyRight &copy; 2022 新闻网站 , All Rights Reserved <a href="manage/index.php">【后台管理】</a> </div>
</div>
  <script type="text/javascript">
	$(".rolls").slide({mainCell:".bd ul",autoPlay:true});
	$(".roll_left").slide({mainCell:".bd2 ul",autoPlay:true,effect:"leftMarquee",vis:5,interTime:50});
</script>
</body>
</html>