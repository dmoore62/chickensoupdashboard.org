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
									<?php
									$rid = $r['RID'];
									$event_sql = "SELECT start_date FROM Events WHERE RID = '$rid' ORDER BY start_date DESC LIMIT 1";
									$event_result = mysql_query($event_sql);
									?>
									<?php if(mysql_num_rows($event_result) > 0):?>
										<?php $e = mysql_fetch_row($event_result);?>
										<td><?php echo date('m/d/Y', strtotime($e[0]));?></td>
									<?php else:?>
										<td>None</td>
									<?php endif;?>
								</tr>
<?php endwhile;?>
