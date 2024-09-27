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

namespace tool_lcprunecourselogstep\lifecycle;

global $CFG;
require_once($CFG->dirroot . '/admin/tool/lifecycle/step/lib.php');

use tool_lifecycle\local\response\step_response;
use tool_lifecycle\step\libbase;

defined('MOODLE_INTERNAL') || die();

class step extends libbase {
    public function get_subpluginname()
    {
        return 'tool_lcprunecourselogstep';
    }

    public function get_plugin_description() {
        return "Prune course log";
    }

    public function process_course($processid, $instanceid, $course)
    {
        global $DB;

        // Ensure that the buffer is flushed. Size settings is "logstore_standard/buffersize", defaulting to 50.
        $manager = get_log_manager(true);
        $store = new \logstore_standard\log\store($manager);
        $store->flush();

        // Delete all logs of the course.
        // TODO: This should be configurable?.
        $DB->delete_records('logstore_standard_log', ['courseid' => $course->id]);
        return step_response::proceed();
    }

}
