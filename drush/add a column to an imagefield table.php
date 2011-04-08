<?php
if (db_query("alter table {content_field_slideshowimages} add column field_slideshowimages_feature INT NOT NULL DEFAULT 0;")) {
print 'success';
} else { print 'fail'; }
