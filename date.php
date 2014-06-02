<?php
/*
首先要获取年份和月份，可以通过地址栏传值的方式来指定。
如果没有指定年份和月份，则默认打印系统当前的年份和月份的月历
然后获取当月有多少天，本月的的第一天是周几。
然后循环打印，循环打印的时候要满足两个条件
1、每七天要换一次行，即<tr></tr>，并且打印的天数不能多于本月拥有的天数
比如是1月，不能多于31天
3、当前的1号要和周几对应起来，不可能每个月的1号都是周日，如果是周四，那么周日到周三
这一段应该打印出空格，而不应该有值
不能多于本月的天数好控制，循环并自增来判断一下当前值是否比本月应当拥有的天数大即可
不大于本月应当拥有的天数时正常打印数字，否则就应该打印空格
每个月1号和周几对应起来这个有点难理解，这个应该是在上面那个循环的基础上来做的。
大于7天的时候，应该打印下一行，也即是<tr></tr>
如果外面的循环是第一次运行，要判断本月1号对应的周几，如果是周四，则应当在前面打印4个空格。
只有外循环在第一次循环的时候，才要做判断，否则是不做判断的。
*/
?>
<html>
	<head><title>万年厉</title></head>
	<body>
		<center>
			<?php 
			$year = $_GET['y'] ? $_GET['y'] : date('Y');
			$mon = $_GET['m'] ? $_GET['m'] : date('m');
			echo '<h1>'.$year.'年'.$mon.'月'.'</h1>' ?>
			<table border="1" >
				<tr bgcolor='gray'>
					<th>星期日</th>
					<th>星期一</th>
					<th>星期二</th>
					<th>星期三</th>
					<th>星期四</th>
					<th>星期五</th>
					<th>星期六</th>
			</tr>
			<?php 
				$monthavedays = date('t',time());
				$monthofirstday = date('w',mktime(0,0,0,$mon,1,$year));
				//echo $monthofirstday;
				$i=1;
				while($i<=$monthavedays){
					echo '<tr>';
					for ($j=0; $j <= 6; $j++) { 
						//当变量i的值小于月份拥有的天数时，打印i的值，并且i增加
						//如果i的值已经超过了月份拥有的天数，应该输出空
						//使用for循环来控制打印一周的天数
						//当第一次循环的时候，应当对比本月第一天是周几，如果是周四
						//那么应当打印4个空格，然后在周四的时候打印出1号

						if ($i<=$monthavedays&&($j>=$monthofirstday||$i!=1)) {
							echo '<td>'.$i.'</td>';
							$i++;
						}else {
							echo '<td>&nbsp;</td>';
						}
					}
					echo '</tr>';
				}
			?>
			</table>
			<p></p>
			<?php
				if(($perm=$mon-1)==0){
					$perm = 12;
					$pyear=$year - 1;
				}else{
					$perm = $mon - 1;
					$pyear = $year;
				}
				if(($nextm=$mon+1)==13){
					$nextm=1;
					$nyear=$year + 1;
				} else {
					$nextm = $mon + 1;
					$nyear = $year;
				}
				echo "<a href='date.php?y={$pyear}&m={$perm}'><h3>上一月</a>&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "<a href='date.php?y={$nyear}&m={$nextm}'>下一月</a></h3>";
			?>
		</center>
	</body>
</html>
