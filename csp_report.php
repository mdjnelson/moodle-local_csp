<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This is an admin_externalpage 'local_csp_report' for displaying the recorded csp reports.
 *
 * @package   local_csp
 * @author    Suan Kan <suankan@catalyst-au.net>
 * @copyright Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir.'/adminlib.php');

admin_externalpage_setup('local_csp_report', '', null, '', array('pagelayout' => 'report'));

$title = get_string('cspreports', 'local_csp');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_pagelayout('admin');

global $OUTPUT, $DB;

echo $OUTPUT->header();
echo $OUTPUT->heading($title);


$documenturi = get_string('documenturi', 'local_csp');
$blockeduri = get_string('blockeduri', 'local_csp');
$violateddirective = get_string('violateddirective', 'local_csp');
$failcounter = get_string('failcounter', 'local_csp');
$timecreated = get_string('timecreated', 'local_csp');
$timeupdated = get_string('timeupdated', 'local_csp');

$table = new \local_csp\table\table_sql_time_pretty('cspreportstable');
$table->define_baseurl($PAGE->url);
$table->define_columns(array('id', 'documenturi', 'blockeduri', 'violateddirective', 'failcounter', 'timecreated', 'timeupdated'));
$table->define_headers(array('id', $documenturi, $blockeduri, $violateddirective, $failcounter, $timecreated, $timeupdated));

$fields = 'id, documenturi, blockeduri, violateddirective, failcounter, timecreated, timeupdated';
$from = '{local_csp}';
$where = '1 = 1';
$table->set_sql($fields, $from, $where);

$table->out(10, true);

echo $OUTPUT->footer();
