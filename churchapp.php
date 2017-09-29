<?php
include_once('../../../wp-load.php');

define( 'CS_APP_ACCOUNT', 'valley' );
define( 'CS_APP_APPLICATION', 'valleychurch-website' );
define( 'CS_APP_AUTH', 'Dg8lHr5mIg30qcVdN7Je' );
define( 'CS_BASE_URL', 'https://api.churchsuite.co.uk/v1' );

define( 'CS_EVENTS_URL', CS_BASE_URL . '/calendar/events?per_page=200' );
define( 'CS_GROUPS_URL', CS_BASE_URL . '/smallgroups/groups?view=active_future' );

?>