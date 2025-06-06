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
 * Strings for component 'calendar', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package   core_calendar
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['advancedoptions'] = 'Advanced options';
$string['allday'] = 'All day';
$string['addevent'] = 'Add events';
$string['annually'] = 'Annually';
$string['activityevent'] = 'Activity event';
$string['calendar'] = 'Calendar';
$string['calendarexporturl'] = 'Calendar URL';
$string['calendarheading'] = '{$a} Calendar';
$string['calendarpreferences'] = 'Calendar preferences';
$string['calendartypes'] = 'Calendar types';
$string['calendarurlcopiedtoclipboard'] = 'Calendar URL copied to clipboard';
$string['category'] = 'Category';
$string['clickhide'] = 'click to hide';
$string['clickshow'] = 'click to show';
$string['colcalendar'] = 'Calendar';
$string['collastupdated'] = 'Last updated';
$string['colpoll'] = 'Refresh interval';
$string['colactions'] = 'Actions';
$string['commontasks'] = 'Options';
$string['confirmeventdelete'] = 'Are you sure you want to delete the "{$a}" event?';
$string['confirmeventseriesdelete'] = 'The "{$a->name}" event is part of a series. Do you want to delete just this event, or all {$a->count} events in the series?';
$string['confirmsubscriptiondelete'] = 'Are you sure you want to delete the "{$a}" calendar subscription?';
$string['copycalendarurl'] = 'Copy calendar URL';
$string['copyurl'] = 'Copy URL';
$string['course'] = 'Course';
$string['coursecalendarlink'] = 'Course calendar';
$string['courseevents'] = 'Course events';
$string['categoryevents'] = 'Category events';
$string['courses'] = 'Courses';
$string['customexport'] = 'Custom range ({$a->timestart} - {$a->timeend})';
$string['daily'] = 'Daily';
$string['day'] = 'Day';
$string['dayeventsmany'] = '{$a->num} events, {$a->day}';
$string['dayeventsnone'] = 'No events, {$a}';
$string['dayeventsone'] = '1 event, {$a}';
$string['daynext'] = 'Next day';
$string['dayprev'] = 'Previous day';
$string['dayviewfor'] = 'Day view for:';
$string['dayviewtitle'] = 'Day view: {$a}';
$string['daywithnoevents'] = 'There are no events this day.';
$string['default'] = 'Default';
$string['deleteevent'] = 'Delete event';
$string['deleteevents'] = 'Events';
$string['deleteoneevent'] = 'Delete this event';
$string['deleteallevents'] = 'Delete all events';
$string['detailedmonthviewfor'] = 'Detailed month view for:';
$string['detailedmonthviewtitle'] = 'Detailed month view: {$a}';
$string['durationminutes'] = 'Duration in minutes';
$string['durationnone'] = 'Without duration';
$string['durationuntil'] = 'Until';
$string['editevent'] = 'Editing event';
$string['erroraddingevent'] = 'Failed to add event';
$string['errorbadsubscription'] = 'Calendar subscription not found.';
$string['errorbeforecoursestart'] = 'Cannot set event before course start date';
$string['errorcannotimport'] = 'You cannot set up a calendar subscription at this time.';
$string['errorhasuntilandcount'] = 'Either UNTIL or COUNT may appear in a recurrence rule, but UNTIL and COUNT MUST NOT occur in the same recurrence rule.';
$string['errorinvalidbydaysuffix'] = 'Valid values for the day of the week parts of the BYDAY rule are MO, TU, WE, TH, FR, SA and SU';
$string['errorinvalidbydayprefix'] = 'Integer values preceding BYDAY rules can only be present for a MONTHLY or YEARLY recurrence rule.';
$string['errorinvalidbyhour'] = 'Valid values for the BYHOUR rule are 0 to 23.';
$string['errorinvalidinterval'] = 'The value for the INTERVAL rule must be a positive integer.';
$string['errorinvalidbyminute'] = 'Valid values for the BYMINUTE rule are 0 to 59.';
$string['errorinvalidbymonth'] = 'Valid values for the BYMONTH rule are 1 to 12.';
$string['errorinvalidbymonthday'] = 'Valid values for the BYMONTHDAY rule are 1 to 31 or -31 to -1.';
$string['errorinvalidbysetpos'] = 'Valid values for the BYSETPOS rule are 1 to 366 or -366 to -1.';
$string['errorinvalidbyweekno'] = 'Valid values for the BYWEEKNO rule are 1 to 53 or -53 to -1.';
$string['errorinvalidbyyearday'] = 'Valid values for the BYYEARDAY rule are 1 to 366 or -366 to -1.';
$string['errorinvalidbysecond'] = 'Valid values for the BYSECOND rule are 0 to 59.';
$string['errorinvaliddate'] = 'Invalid date';
$string['errorinvalidminutes'] = 'Specify duration in minutes by giving a number between 1 and 999.';
$string['errorinvalidrepeats'] = 'Specify the number of events by giving a number between 1 and 99.';
$string['errorinvalidicalurl'] = 'The given iCal URL is invalid.';
$string['errormustbeusedwithotherbyrule'] = 'The BYSETPOS rule must only be used in conjunction with another BYxxx rule part.';
$string['errornodescription'] = 'Description is required';
$string['errornoeventname'] = 'Name is required';
$string['errornonyearlyfreqwithbyweekno'] = 'The BYWEEKNO rule is only valid for YEARLY rules.';
$string['errorrequiredurlorfile'] = 'Either a URL or a file is required to import a calendar.';
$string['errorrrule'] = 'The passed recurrence rule seems incorrect.';
$string['errorrrulefreq'] = 'The recurrence rule has an invalid frequency parameter.';
$string['errorrruleday'] = 'The recurrence rule has an invalid day parameter.';
$string['eventdate'] = 'Date';
$string['eventdescription'] = 'Description';
$string['eventduration'] = 'Duration';
$string['eventendtime'] = 'End time';
$string['eventendtimewrapped'] = '{$a} (End time)';
$string['eventinstanttime'] = 'Time';
$string['eventkind'] = 'Type of event';
$string['eventname'] = 'Event title';
$string['eventnameandcategory'] = '{$a->category}: {$a->name}';
$string['eventnameandcourse'] = '{$a->course}: {$a->name}';
$string['eventnamelocation'] = '{$a->name} location: {$a->location}';
$string['eventnone'] = 'No events';
$string['eventrepeat'] = 'Repeats';
$string['events'] = 'Events';
$string['eventsall'] = 'All events';
$string['eventsdeleted'] = '{$a} events were deleted';
$string['eventsimported'] = '{$a} events were imported';
$string['eventsource'] = 'Event source';
$string['eventsskipped'] = '{$a} events were skipped';
$string['eventsupdated'] = '{$a} events were updated';
$string['eventsfor'] = '{$a} events';
$string['eventskey'] = 'Events key';
$string['eventspersonal'] = 'My personal events';
$string['eventsrelatedtocategories'] = 'Events related to categories';
$string['eventsrelatedtocourses'] = 'Events related to courses';
$string['eventsrelatedtogroups'] = 'Events related to groups';
$string['eventstarttime'] = 'Start time';
$string['eventstoexport'] = 'Events to export';
$string['eventtime'] = 'Time';
$string['eventtype'] = 'Event type';
$string['eventview'] = 'Event details';
$string['eventcalendareventcreated'] = 'Calendar event created';
$string['eventcalendareventupdated'] = 'Calendar event updated';
$string['eventcalendareventdeleted'] = 'Calendar event deleted';
$string['eventsubscriptioncreated'] = 'Calendar subscription created';
$string['eventsubscriptionupdated'] = 'Calendar subscription updated';
$string['eventsubscriptiondeleted'] = 'Calendar subscription deleted';
$string['eventsubscriptioneditwarning'] = 'This calendar event is part of a subscription.  Any changes you make to this event will be lost if the subscription is deleted.';
$string['expired'] = 'Expired';
$string['explain_site_timeformat'] = 'You can choose to see times in either 12 or 24 hour format for the whole site. If you choose "default", then the format will be automatically chosen according to the language you use in the site. This setting can be overridden by user preferences.';
$string['export'] = 'Export';
$string['exporthelp'] = '<p>The calendar URL provides a dynamic link for importing events into other calendars. Any new, changed or deleted events in the source calendar <strong>will</strong> be reflected in the other calendars.</p>
<p>The calendar export allows you to create a backup copy of events, which may be imported into other calendars. Updates made in the source calendar <strong>will not</strong> be reflected in the other calendars.</p>';
$string['exportbutton'] = 'Export';
$string['exportcalendar'] = 'Export calendar';
$string['forcecalendartype'] = 'Force calendar';
$string['fri'] = 'Fri';
$string['friday'] = 'Friday';
$string['fullcalendar'] = 'Full calendar';
$string['generateurlbutton'] = 'Get calendar URL';
$string['gotoactivity'] = 'Go to activity';
$string['gotocalendar'] = 'Go to calendar';
$string['group'] = 'Group';
$string['groupevents'] = 'Group events';
$string['eventtypesite'] = 'site';
$string['eventtypecategory'] = 'category';
$string['eventtypecourse'] = 'course';
$string['eventtypemodule'] = 'module';
$string['eventtypegroup'] = 'group';
$string['eventtypeother'] = 'other';
$string['eventtypeuser'] = 'user';
$string['hideeventtype'] = 'Hide {$a} events';
$string['showeventtype'] = 'Show {$a} events';
$string['hourly'] = 'Hourly';
$string['importcalendar'] = 'Import calendar';
$string['importcalendarheading'] = 'Import calendar...';
$string['importcalendarfrom'] = 'Import from';
$string['importfromfile'] = 'Calendar file (.ics)';
$string['importfromurl'] = 'Calendar URL';
$string['invalidtimedurationminutes'] = 'The duration in minutes you have entered is invalid. Please enter the duration in minutes greater than 0 or select no duration.';
$string['invalidtimedurationuntil'] = 'The date and time you selected for duration until is before the start time of the event. Please correct this before proceeding.';
$string['invalideventtype'] = 'The event type you have selected is invalid.';
$string['iwanttoexport'] = 'Export';
$string['less'] = 'Less';
$string['managesubscriptions'] = 'Import or export calendars';
$string['manyevents'] = '{$a} events';
$string['mon'] = 'Mon';
$string['monday'] = 'Monday';
$string['monthly'] = 'Monthly';
$string['monthnext'] = 'Next month';
$string['monthprev'] = 'Previous month';
$string['monththis'] = 'This month';
$string['more'] = 'More';
$string['moreevents'] = '{$a} more';
$string['namewithsource'] = '{$a->name} ({$a->source})';
$string['never'] = 'Never';
$string['newevent'] = 'New event';
$string['newmonthannouncement'] = 'Calendar is now set to {$a}.';
$string['nocalendarsubscriptionsimportexternal'] = 'No calendar subscriptions yet. <a href="{$a}">Import an external calendar</a>';
$string['notitle'] = 'no title';
$string['noupcomingevents'] = 'There are no upcoming events';
$string['oneevent'] = '1 event';
$string['pollinterval'] = 'Update interval';
$string['pollinterval_help'] = 'How often you would like the calendar to update with new events.';
$string['preferences'] = 'Preferences';
$string['preferences_available'] = 'Your personal preferences';
$string['preferredcalendar'] = 'Preferred calendar';
$string['pref_lookahead'] = 'Upcoming events look-ahead';
$string['pref_lookahead_help'] = 'This sets the (maximum) number of days in the future that an event has to start in in order to be displayed as an upcoming event. Events that start beyond this will never be displayed as upcoming. Please note that <strong>there is no guarantee</strong> that all events starting in this time frame will be displayed; if there are too many (more than the "Maximum upcoming events" preference) then the most distant events will not be shown.';
$string['pref_maxevents'] = 'Maximum upcoming events';
$string['pref_maxevents_help'] = 'This sets the maximum number of upcoming events that can be displayed. If you pick a large number here it is possible that upcoming events displays will take up a lot of space on your screen.';
$string['pref_persistflt'] = 'Remember filter settings';
$string['pref_persistflt_help'] = 'If this is enabled, then Moodle will remember your last event filter settings and automatically restore them each time you login.';
$string['pref_startwday'] = 'First day of week';
$string['pref_startwday_help'] = 'Calendar weeks will be shown as starting on the day that you select here.';
$string['pref_timeformat'] = 'Time display format';
$string['pref_timeformat_help'] = 'You can choose to see times in either 12 or 24 hour format. If you choose "default", then the format will be automatically chosen according to the language you use in the site.';
$string['privacy:metadata:calendar:event'] = 'The Calendar component can store user calendar event details within the core subsystem.';
$string['privacy:metadata:calendar:event:name'] = 'The name of the calendar event.';
$string['privacy:metadata:calendar:event:description'] = 'The description of the calendar event.';
$string['privacy:metadata:calendar:event:eventtype'] = 'The event type of the calendar event.';
$string['privacy:metadata:calendar:event:timestart'] = 'The start time of the calendar event.';
$string['privacy:metadata:calendar:event:timeduration'] = 'The duration of the calendar event.';
$string['privacy:metadata:calendar:event_subscriptions'] = 'The Calendar component can stores user calendar subscriptions details within the core subsystem.';
$string['privacy:metadata:calendar:event_subscriptions:name'] = 'The name of the calendar subscription.';
$string['privacy:metadata:calendar:event_subscriptions:url'] = 'The url of the calendar subscription.';
$string['privacy:metadata:calendar:event_subscriptions:eventtype'] = 'The event type of the calendar subscription.';
$string['privacy:metadata:calendar:preferences:calendar_savedflt'] = 'The configured calendar event type display user preference.';
$string['recentupcoming'] = 'Recent and next 60 days';
$string['repeatedevents'] = 'Repeated events';
$string['repeateditall'] = 'Also apply changes to the other {$a} events in this repeat series';
$string['repeateditthis'] = 'Apply changes to this event only';
$string['repeatevent'] = 'Repeat this event';
$string['repeatnone'] = 'No repeats';
$string['repeatweeksl'] = 'Repeat weekly, creating altogether';
$string['repeatweeksr'] = 'events';
$string['requiresaction'] = '{$a} requires action';
$string['sat'] = 'Sat';
$string['saturday'] = 'Saturday';
$string['shown'] = 'shown';
$string['site'] = 'Site';
$string['siteevents'] = 'Site events';
$string['spanningevents'] = 'Events underway';
$string['subscriptions'] = 'Subscriptions';
$string['subscriptionname'] = 'Calendar name';
$string['subscriptionremoved'] = 'Calendar subscription {$a} removed';
$string['subscriptionsource'] = 'Event source: {$a}';
$string['subscriptionupdated'] = 'The \'{$a}\' calendar subscription has been updated';
$string['sun'] = 'Sun';
$string['sunday'] = 'Sunday';
$string['timerelativetoday'] = 'Today, {$a}';
$string['timerelativetomorrow'] = 'Tomorrow, {$a}';
$string['timerelativeyesterday'] = 'Yesterday, {$a}';
$string['thu'] = 'Thu';
$string['thursday'] = 'Thursday';
$string['timeformat_12'] = '12-hour (am/pm)';
$string['timeformat_24'] = '24-hour';
$string['timeperiod'] = 'Time period';
$string['today'] = 'Today';
$string['todayplustitle'] = 'Today {$a}';
$string['tomorrow'] = 'Tomorrow';
$string['tue'] = 'Tue';
$string['tuesday'] = 'Tuesday';
$string['typeclose'] = 'Close event';
$string['typecourse'] = 'Course event';
$string['typecategory'] = 'Category event';
$string['typedue'] = 'Due event';
$string['typegradingdue'] = 'Grading due event';
$string['typegroup'] = 'Group event';
$string['typeopen'] = 'Open event';
$string['typesite'] = 'Site event';
$string['typeuser'] = 'User event';
$string['upcomingevents'] = 'Upcoming events';
$string['upcomingeventsfor'] = 'Upcoming events for:';
$string['urlforical'] = 'URL for iCalendar export, for subscribing to calendar';
$string['user'] = 'User';
$string['userevents'] = 'User events';
$string['viewupcomingactivitiesdue'] = 'View the upcoming activities due';
$string['wed'] = 'Wed';
$string['wednesday'] = 'Wednesday';
$string['weekly'] = 'Weekly';
$string['weeknext'] = 'Next week';
$string['weekthis'] = 'This week';
$string['when'] = 'When';
$string['whendate'] = 'When: {$a}';
$string['yesterday'] = 'Yesterday';
$string['youcandeleteallrepeats'] = 'This event is part of a repeating event series. You can delete this event only, or all {$a} events in the series at once.';
$string['yoursubscriptions'] = 'Imported calendars';

// Deprecated since Moodle 4.5.
$string['importcalendarexternal'] = 'Import an external calendar?';
$string['nocalendarsubscriptions'] = 'No calendar subscriptions yet. Do you want to {$a}';

// Deprecated since Moodle 5.0.
$string['categoryevent'] = 'Category event';
$string['courseevent'] = 'Course event';
$string['groupevent'] = 'Group event';
$string['siteevent'] = 'Site event';
$string['tt_deleteevent'] = 'Delete event';
$string['tt_editevent'] = 'Edit event';
$string['userevent'] = 'User event';
