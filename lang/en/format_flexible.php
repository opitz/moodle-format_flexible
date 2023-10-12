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
 * Strings for component Flexible course format.
 *
 * @package   format_flexible
 * @copyright  2023 onwards UCL <m.opitz@ucl.ac.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['topic'] = 'Topic';
$string['topic0'] = 'General';

$string['sectionname'] = 'Topic';
$string['pluginname'] = 'Flexible format';
$string['section0name'] = 'General';

// MDL-26105.
$string['page-course-view-grid'] = 'Any course main page in the grid format';
$string['page-course-view-grid-x'] = 'Any course page in the grid format';

$string['addsection'] = 'Add topic';
$string['addsections'] = 'Add topic';
$string['hidefromothers'] = 'Hide topic'; // No longer used kept for legacy versions.
$string['showfromothers'] = 'Show topic'; // No longer used kept for legacy versions.
$string['currentsection'] = 'This topic'; // No longer used kept for legacy versions.
$string['markedthissection'] = 'This topic is highlighted as the current topic';
$string['markthissection'] = 'Highlight this topic as the current topic';

// Moodle 3.0 Enhancement.
$string['editsection'] = 'Edit topic';
$string['deletesection'] = 'Delete topic';

// MDL-51802.
$string['editsectionname'] = 'Edit topic name';
$string['newsectionname'] = 'New name for topic {$a}';

$string['numbersections'] = 'Number of topic';

// Setting general.
$string['default'] = 'Default - {$a}';

// Section image.
$string['sectionimage'] = 'topic image';
$string['sectionimage_help'] = 'The topic image';
$string['sectionimagealttext'] = 'Image alt text';
$string['sectionimagealttext_help'] = "This text will be set as the image 'alt', being 'alternative' attribute.";

// Section break.
$string['sectionbreak'] = 'Topic break';
$string['sectionbreak_help'] = 'Break the grid at this topic';
$string['sectionbreakheading'] = 'Topic break heading';
$string['sectionbreakheading_help'] = 'Show this heading at the point this topic breaks in the grid.  HTML can be used.';

// Grid justification.
$string['gridjustification'] = 'Set the justification of the grid';
$string['gridjustification_help'] = 'Set the justification to one of: Start, Centre, End, Space around, Space between or Space evenly';
$string['defaultgridjustification'] = 'Default justification of the grid';
$string['defaultgridjustification_desc'] = 'One of: Start, Centre, End, Space around, Space between or Space evenly.';
$string['start'] = 'Start';
$string['centre'] = 'Centre';
$string['end'] = 'End';
$string['spacearound'] = 'Space around';
$string['spacebetween'] = 'Space between';
$string['spaceevenly'] = 'Space evenly';

// Image container width.
$string['imagecontainerwidth'] = 'Set the image container width';
$string['imagecontainerwidth_help'] = 'One of: 128, 192, 210, 256, 320, 384, 448, 512, 576, 640, 704 or 768';
$string['defaultimagecontainerwidth'] = 'Default width of the image container';
$string['defaultimagecontainerwidth_desc'] = 'One of: 128, 192, 210, 256, 320, 384, 448, 512, 576, 640, 704 or 768.';

// Image container ratio.
$string['imagecontainerratio'] = 'Set the image container ratio relative to the width';
$string['imagecontainerratio_help'] = 'One of: 3-2, 3-1, 3-3, 2-3, 1-3, 4-3 or 3-4';
$string['defaultimagecontainerratio'] = 'Default ratio of the image container relative to the width';
$string['defaultimagecontainerratio_desc'] = 'One of: 3-2, 3-1, 3-3, 2-3, 1-3, 4-3 or 3-4.';

// Image resize method.
$string['scale'] = 'Scale';
$string['crop'] = 'Crop';
$string['imageresizemethod'] = 'Set the image resize method';
$string['imageresizemethod_help'] = "Set to: 'Scale' or 'Crop' when resizing the image to fit the container";
$string['defaultimageresizemethod'] = 'Default image resize method';
$string['defaultimageresizemethod_desc'] = "Set to: 'Scale' or 'Crop' when resizing the image to fit the container.";

// Displayed image type.
$string['original'] = 'Original';
$string['webp'] = 'WebP';
$string['defaultdisplayedimagefiletype'] = 'Displayed image type';
$string['defaultdisplayedimagefiletype_desc'] = "'Original' or 'WebP'.";

// Single page summary image.
$string['off'] = 'Off';
$string['centre'] = 'Centre';
$string['left'] = 'Left';
$string['right'] = 'Right';
$string['singlepagesummaryimage'] = 'Show the grid image in the topic summary';
$string['singlepagesummaryimage_help'] = 'When there is a summary in the topic';
$string['defaultsinglepagesummaryimage'] = 'Show the grid image in the topic summary';
$string['defaultsinglepagesummaryimage_desc'] = 'When there is a summary in the topic.';

// Modal.
$string['popup'] = 'Use a popup';
$string['popup_help'] = 'Display the topic in a popup instead of navigating to a single topic page';
$string['defaultpopup'] = 'Use a popup';
$string['defaultpopup_desc'] = 'Display the topic in a popup instead of navigating to a single topic page.';

// Completion.
$string['showcompletion'] = 'Show completion';
$string['showcompletion_help'] = 'Show the completion of the topic on the grid';
$string['defaultshowcompletion'] = 'Show completion';
$string['defaultshowcompletion_desc'] = 'Show the completion of the topic on the grid.';

// Other.
$string['information'] = 'Information';
$string['informationsettings'] = 'Information settings';
$string['informationsettingsdesc'] = 'Grid format information';
$string['informationchanges'] = 'Changes';
$string['settings'] = 'Settings';
$string['settingssettings'] = 'Settings settings';
$string['settingssettingsdesc'] = 'Flexible format settings';
$string['love'] = 'love';
$string['versioninfo'] = 'Release {$a->release}, version {$a->version} on Moodle {$a->moodle}.  Made with {$a->love} in Great Britain.';
$string['versionalpha'] = 'Alpha version - Almost certainly contains bugs.  This is a development version for developers \'only\'!  Don\'t even think of installing on a production server!';
$string['versionbeta'] = 'Beta version - Likely to contain bugs.  Ready for testing by administrators on a test server only.';
$string['versionrc'] = 'Release candidate version - May contain bugs.  Check completely on a test server before considering on a production server.';
$string['versionstable'] = 'Stable version - Could contain bugs.  Check on a test server before installing on your production server.';

// Exception messages.
$string['cannotconvertuploadedimagetodisplayedimage'] = 'Cannot convert uploaded image to displayed image - {$a}.  Please report error details and the information contained in the php.log file to developer.';
$string['cannotgetmanagesectionimagelock'] = 'Cannot get manage topic image lock.  This can happen if two people are editing the settinsg of the same topic on the same course at the same time.';
$string['formatnotsupported'] = 'Format is not supported at this server, please fix the system configuration to have the GD PHP extension installed - {$a}.';
$string['functionfailed'] = 'Function failed on image - {$a}.';
$string['mimetypenotsupported'] = 'Mime type is not supported as an image format in the Grid format - {$a}.';
$string['originalheightempty'] = 'Original height is empty - {$a}.';
$string['originalwidthempty'] = 'Original width is empty - {$a}.';
$string['noimageinformation'] = 'Image information is empty - {$a}.';
$string['reporterror'] = 'Please report error details and the information contained in the php.log file to developer';

// Privacy.
$string['privacy:nop'] = 'The Grid format stores lots of settings that pertain to its configuration.  None of the settings are related to a specific user.  It is your responsibilty to ensure that no user data is entered in any of the free text fields.  Setting a setting will result in that action being logged within the core Moodle logging system against the user whom changed it, this is outside of the formats control, please see the core logging system for privacy compliance for this.  When uploading images, you should avoid uploading images with embedded location data (EXIF GPS) included or other such personal data.  It would be possible to extract any location / personal data from the images.  Please examine the code carefully to be sure that it complies with your interpretation of your privacy laws.  I am not a lawyer and my analysis is based on my interpretation.  If you have any doubt then remove the format forthwith.';

// Flexible section.
$string['showmore'] = 'Show more';
$string['showless'] = 'Show less';
