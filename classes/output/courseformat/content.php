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
 * Output content for the format_flexible plugin.
 *
 * @package   format_flexible
 * @copyright  2023 onwards UCL <m.opitz@ucl.ac.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace format_flexible\output\courseformat;

use core_courseformat\output\local\content as content_base;
use format_grid\output\courseformat\content as format_grid_content;
use stdClass;
use course_modinfo;

class content extends format_grid_content {

    /**
     * Returns the output class template path.
     *
     * This method redirects the default template when the course content is rendered.
     */
    public function get_template_name(\renderer_base $renderer): string {
        return 'format_flexible/local/content';
    }

    /**
     * Export this data so it can be used as the context for a mustache template (core/inplace_editable).
     *
     * @param renderer_base $output typically, the renderer that's calling this function
     * @return stdClass data context for a Mustache template
     */
    public function export_for_template(\renderer_base $output) {
        global $DB, $PAGE;
        $format = $this->format;
        $editing = $PAGE->user_is_editing();

        $data = (object)[
            'title' => $format->page_title(),
            'format' => $format->get_format(),
            'sectionreturn' => 0,
        ];

        $singlesection = $this->format->get_section_number();
        $sections = $this->export_sections($output);
        $initialsection = '';
        $course = $format->get_course();
        $currentsectionid = 0;

        if (!empty($sections)) {
            // Most formats uses section 0 as a separate section so we remove from the list.
            $initialsection = array_shift($sections);
            if (!$singlesection) {
                $data->initialsection = $initialsection;
            }
            if (($editing) || ($singlesection || true)) { // This triggers the display of the standard list of section(s).
                $data->sections = $sections;
            }
            if (!empty($course->marker)) {
                foreach ($sections as $section) {
                    if ($section->num == $course->marker) {
                        $currentsectionid = $section->id;
                        break;
                    }
                }
            }
        }

        // The single section format has extra navigation.
        if ($singlesection) {
            $sectionnavigation = new $this->sectionnavigationclass($format, $singlesection);
            $data->sectionnavigation = $sectionnavigation->export_for_template($output);

            $sectionselector = new $this->sectionselectorclass($format, $sectionnavigation);
            $data->sectionselector = $sectionselector->export_for_template($output);
            $data->hasnavigation = true;
            $data->singlesection = array_shift($data->sections);
            $data->sectionreturn = $singlesection;
            $data->maincoursepage = new \moodle_url('/course/view.php', ['id' => $course->id]);
        } else {
            $coursesettings = $format->get_settings();
            $toolbox = \format_grid\toolbox::get_instance();
            $coursesectionimages = $DB->get_records('format_grid_image', ['courseid' => $course->id]);
            if (!empty($coursesectionimages)) {
                $fs = get_file_storage();
                $coursecontext = \context_course::instance($course->id);
                foreach ($coursesectionimages as $coursesectionimage) {
                    $replacement = $toolbox->check_displayed_image($coursesectionimage, $course->id, $coursecontext->id,
                        $coursesectionimage->sectionid, $format, $fs);
                    if (!empty($replacement)) {
                        $coursesectionimages[$coursesectionimage->id] = $replacement;
                    }
                }
            }

            // Justification.
            $data->gridjustification = $coursesettings['gridjustification'];

            // Popup.
            if (!$editing) {
                $data->popup = false;
                if ((!empty($coursesettings['popup'])) && ($coursesettings['popup'] == 2)) {
                    $data->popup = true;
                    $data->popupsections = [];
                    $potentialpopupsections = [];
                    foreach ($sections as $section) {
                        $potentialpopupsections[$section->id] = $section;
                    }
                }
            }

            // Suitable array.
            $sectionimages = [];
            foreach ($coursesectionimages as $coursesectionimage) {
                $sectionimages[$coursesectionimage->sectionid] = $coursesectionimage;
            }

            // Now iterate over the sections.
            $data->gridsections = [];
            $sectionsforgrid = $this->get_grid_sections($output, $coursesettings);
            $displayediswebp = (get_config('format_grid', 'defaultdisplayedimagefiletype') == 2);

            $completionshown = false;
            $headerimages = false;
            if ($editing) {
                $datasectionmap = [];
                foreach ($data->sections as $datasectionkey => $datasection) {
                    $datasectionmap[$datasection->id] = $datasectionkey;
                }
            }
            foreach ($sectionsforgrid as $section) {
                // Do we have an image?
                if ((array_key_exists($section->id, $sectionimages)) && ($sectionimages[$section->id]->displayedimagestate >= 1)) {
                    $sectionimages[$section->id]->imageuri = $toolbox->get_displayed_image_uri(
                        $sectionimages[$section->id], $coursecontext->id, $section->id, $displayediswebp);
                } else {
                    // No.
                    $sectionimages[$section->id] = new stdClass;
                    $sectionimages[$section->id]->generatedimageuri = $output->get_generated_image_for_id($section->id);
                }
                // Number.
                $sectionimages[$section->id]->number = $section->num;

                // Alt text.
                $sectionformatoptions = $format->get_format_options($section);
                $sectionimages[$section->id]->imagealttext = $sectionformatoptions['sectionimagealttext'];

                // Current section?
                if ((!empty($currentsectionid)) && ($currentsectionid == $section->id)) {
                    $sectionimages[$section->id]->currentsection = true;
                }

                if ($editing) {
                    if (!empty($data->sections[$datasectionmap[$section->id]])) {
                        // Add the image to the section content.
                        $data->sections[$datasectionmap[$section->id]]->gridimage = $sectionimages[$section->id];
                        $headerimages = true;
                    }
                } else {
                    // Section link.
                    $sectionimages[$section->id]->sectionurl = new \moodle_url(
                        '/course/view.php',
                        ['id' => $course->id, 'section' => $section->num]
                    );
                    $sectionimages[$section->id]->sectionurl = $sectionimages[$section->id]->sectionurl->out(false);

                    // Section name.
                    $sectionimages[$section->id]->sectionname = $section->name;

                    /* User visible.  For more info, see: $format->is_section_visible($thissection) method in relation
                       to 'hiddensections' course format setting. */
                    if (!$section->uservisible) {
                        $sectionimages[$section->id]->notavailable = true;
                    }

                    // Section break.
                    if ($sectionformatoptions['sectionbreak'] == 2) { // Yes.
                        $sectionimages[$section->id]->sectionbreak = true;
                        if (!empty ($sectionformatoptions['sectionbreakheading'])) {
                            // Note:  As a PARAM_TEXT, then does need to be passed through 'format_string' for multi-lang or not?
                            $sectionimages[$section->id]->sectionbreakheading = format_text(
                                $sectionformatoptions['sectionbreakheading'],
                                FORMAT_HTML
                            );
                        }
                    }

                    // Completion?
                    if (!empty($section->sectioncompletionmarkup)) {
                        $sectionimages[$section->id]->sectioncompletionmarkup = $section->sectioncompletionmarkup;
                        $completionshown = true;
                    }

                    // For the template.
                    $data->gridsections[] = $sectionimages[$section->id];
                    if ($data->popup) {
                        $data->popupsections[] = $potentialpopupsections[$section->id];
                    }
                }
            }

            // WIP.
            foreach ($sections as $key => $section) {
                if ($data->gridsections && isset($section->expandable)) {
                    $data->gridsections[$key]->expandable = true;
                    $data->gridsections[$key]->summarytext = strip_tags($section->summary->summarytext);
                    $data->gridsections[$key]->section = $data->sections[$key];
                }
            }
            // End WIP.

            $data->hasgridsections = (!empty($data->gridsections)) ? true : false;
            if ($data->hasgridsections) {
                $data->coursestyles = $toolbox->get_displayed_image_container_properties($coursesettings);
                if ((!empty($coursesettings['showcompletion'])) && ($coursesettings['showcompletion'] == 2) && ($completionshown)) {
                    $data->showcompletion = true;
                }
            }

            if ($headerimages) {
                $data->hasheaderimages = true;
                $coursesettings['imagecontainerwidth'] = 144;
                $data->coursestyles = $toolbox->get_displayed_image_container_properties($coursesettings);
            }
        }

        if ($this->hasaddsection) {
            $addsection = new $this->addsectionclass($format);
            $data->numsections = $addsection->export_for_template($output);
        }

        if ($format->show_editor()) {
            $bulkedittools = new $this->bulkedittoolsclass($format);
            $data->bulkedittools = $bulkedittools->export_for_template($output);
        }

        return $data;
    }

}