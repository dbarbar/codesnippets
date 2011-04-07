<?php
$r = db_query("DROP TABLE IF EXISTS {actions}");
if ($r === FALSE) { drush_print("fail 1\n"); } else { drush_print("success 1\n"); }

$r = db_query("RENAME TABLE {actions_old} TO {actions}");
if ($r === FALSE) { drush_print("fail 2\n"); } else { drush_print("success 2\n"); }

$r = db_query("ALTER TABLE {workflow_node_history} DROP COLUMN hid");
if ($r === FALSE) { drush_print("fail 3\n"); } else { drush_print("success 3\n"); }
