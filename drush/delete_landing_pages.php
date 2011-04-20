<?php
/**
 * Deletes landing_page content.
 */

$result = db_query("SELECT nid FROM {node} WHERE type = 'landing_page'");
while ($r = db_fetch_object($result)) {
  node_delete($r->nid);
  drush_print("Deleted node nid $r->nid");
}
