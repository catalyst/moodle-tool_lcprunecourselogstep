# Prune course log step (Life cycle plugin)

As the core Moodle course deletion process does not remove logs for a course, as part of the archival process to prevent continual growth of log tables, the log records for the archived course must be removed.

Installation
============
This is an admin plugin and should go into ``admin/tool/lcprunecourselogstep``.

Dependencies
============
This plugin depends on the following plugins:
* Life cycle: https://moodle.org/plugins/view/tool_lifecycle.
* The following refactoring is accepted https://github.com/learnweb/moodle-tool_lifecycle/pull/189
