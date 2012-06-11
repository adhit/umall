<html>
	<head>
		<title>UMall</title>
	</head>
	<body>
		<div style="width:1024px; margin-left:auto; margin-right:auto; border: 1px solid black">
			<h1>In Data</h1>
			<?php
				print_r($in_data);
			?><br/>
			<h1>Listing</h1>
			<?php
				print_r($items);
			?>
			<br>
			<?php
				$page=$in_data['page']; $maxpage=$in_data['maxpage'];
				$link=site_url()."/item/listing";
				foreach($in_data as $key=>$val) {
					if($key=="page") continue;
					if($key=="maxpage") continue;
					$link=$link."/".$key."/".$val;
				}
				if($page>1) {
					echo "<a href=\"".$link."/page/1\">First</a> ";
					echo "<a href=\"".$link."/page/".($page-1)."\">Prev</a> ";
				}
				for($i=$page-2;$i<$page;$i++) {
					if($i<1) continue;
					echo "<a href=\"".$link."/page/".($i)."\">".$i."</a> ";
				}
				echo $i." ";
				for($i=$page+1;$i<=$page+2;$i++) {
					if($i>$maxpage) break;
					echo "<a href=\"".$link."/page/".($i)."\">".$i."</a> ";
				}
				if($page<$maxpage) {
					echo "<a href=\"".$link."/page/".($page+1)."\">Next</a> ";
					echo "<a href=\"".$link."/page/".$maxpage."\">Last</a> ";
				}
			?>
		</div>
	</body>
</html>