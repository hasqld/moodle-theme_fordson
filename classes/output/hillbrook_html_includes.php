<?php

// hide name data here for use with custom database activity forms later
// check if a user is logged in
if (isloggedin()) { // && !isguest()) {

    GLOBAL $USER, $CFG;
    $firstname = $USER->firstname;
    $lastname = $USER->lastname;
    $username = $USER->username;
    $userid = $USER->id;

    // print this dodgy form html
    $html .= "\n<!-- dodgy OCJ hack to hide fullname and username etc here for querying with javascript in the database activity for auto form filling -->\n";
    $html .=  '<form name="hbdata_hidden" method="post">'."\n";
    $html .= '<input type="hidden" name="hbdata_firstname" value="'.$firstname.'" />'."\n";
    $html .= '<input type="hidden" name="hbdata_lastname" value="'.$lastname.'" />'."\n";
    $html .= '<input type="hidden" name="hbdata_name" value="'.$firstname.' '.$lastname.'" />'."\n";
    $html .= '<input type="hidden" name="hbdata_code" id="hbdata_code" value="'.$username.'" />'."\n";

    // work on custom profile fields
    require_once("$CFG->dirroot/user/profile/lib.php");
    $hbprofilefields = profile_user_record($userid);
    if (isset($hbprofilefields->yeargroup)) {
        $yeargroup = $hbprofilefields->yeargroup;
        $html .= '<input type="hidden" name="hbdata_yeargroup" id="hbdata_yeargroup" value="'.$yeargroup.'" />'."\n";
    }
    if (isset($hbprofilefields->classgroup)) {
        $classgroup = $hbprofilefields->classgroup;
        $html .= '<input type="hidden" name="hbdata_classgroup" value="'.$classgroup.'" />'."\n";
    }
    if (isset($hbprofilefields->sex)) {
        $gender = $hbprofilefields->sex;
        $html .= '<input type="hidden" name="hbdata_gender" value="'.$gender.'" />'."\n";
    }
    if (isset($hbprofilefields->homeclass)) {
        $homeclass = $hbprofilefields->homeclass;
        $html .= '<input type="hidden" name="hbdata_homeclass" value="'.$homeclass.'" />'."\n";
    }
    
    $html .= "</form>\n";
    $html .= "<!-- end dodgy OCJ hack -->\n";

    // output the OARS login form for use in dashboard HTML block quicklinks
    $html .=<<<EOL
<!-- START ELES LOGIN FORM -->\n<form id="OSScLoginForm" method="POST" action="https://www.studyskillshandbook.com.au/admin/users/login.php?ce=0&group=1&url=http://www.studyskillshandbook.com.au/inside/&clogin=0" target="_blank" style="margin: 0; padding: 0;">\n<input name="do_login" value="Study Skills Handbook" class="ojnav_input" id="ojnav_input" type="hidden">\n<input name="username" value="hillbrook" type="hidden">\n<input name="password" value="removed" type="hidden">\n</form>\n<!-- END ELES LOGIN FORM -->
EOL;
    $html .= "\n";

}

?>