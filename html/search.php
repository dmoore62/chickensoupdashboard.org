<?php

require "../config/mysql_header.php";
require "helpers/sanitize.php";

$term = sanitize($_GET['term']);
//sql to search recipients
$queryr = "SELECT * FROM Recipients WHERE (first_name like '%$term%' OR last_name like '%$term%' OR email like '%$term%');";
$queryv = "SELECT * FROM Volunteers WHERE first_name like '%$term%' OR last_name like '%$term%' OR email like '%$term%';";

$recip_results = mysql_query($queryr);
$vol_results = mysql_query($queryv);
//sql to search vols
?>
<ul id="out-list">
	<li>Recipients
		<ul id="recip-list">
			<?php if(mysql_num_rows($recip_results) > 0):?>
				<?php while($r = mysql_fetch_assoc($recip_results)):?>
					<li><a href="/recipients/view.php?rid=<?= $r['RID'];?>"><?= $r['first_name']." ".$r['last_name'];?></a></li>
				<?php endwhile;?>
			<?php else:?>
				<li>No Recipients Found</li>
				<li><?= $queryr;?></li>
			<?php endif;?>
		</ul>
	</li>
	<li>Volunteers
		<ul id="vol-list">
			<?php if(mysql_num_rows($vol_results) > 0):?>
				<?php while($r = mysql_fetch_assoc($vol_results)):?>
					<li><a href="/recipients/view.php?rid=<?= $r['VID'];?>"><?= $r['first_name']." ".$r['last_name'];?></a></li>
				<?php endwhile;?>
			<?php else:?>
				<li>No Volunteers Found</li>
			<?php endif;?>
		</ul>
	</li>
</ul>
