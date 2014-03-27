<?php

require "../config/mysql_header.php";
require "helpers/sanitize.php";

$term = sanitize($_POST['term']);
$search_sql = "SELECT * FROM Recipients WHERE (first_name like '%$term%' OR last_name like '%$term%' OR address like '%$term%');";

$search_results = mysql_query($search_sql);
?>

<?php while($r = mysql_fetch_assoc($search_results)):?>
								<tr>
									<td><a href="/recipients/view.php?rid=<?= $r['RID'];?>"><?= $r['first_name']." ".$r['last_name'];?></a></td>
									<td><?= build_phone($r['home_phone']);?></td>
									<td><?= $r['address']." ".$r['city']." ".$r['ZIP'];?></td>
									<td>2/14/2014</td>
								</tr>
<?php endwhile;?>
