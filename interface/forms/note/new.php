<?php
/*
 * Sports Physical Form created by Jason Morrill: January 2009
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");
formHeader("Form: Sports Physical");
$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';
?>

<html><head>
<?php html_header_show();?>

<!-- supporting javascript code -->
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js"></script>

<!-- page styles -->
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
<link rel="stylesheet" href="../../forms/sports_physical/style.css" type="text/css">

<!-- pop up calendar -->
<style type="text/css">@import url(<?php echo $GLOBALS['webroot'] ?>/library/dynarch_calendar.css);</style>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/dynarch_calendar.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/dynarch_calendar_en.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/dynarch_calendar_setup.js"></script>

<script language="JavaScript">
var mypcc = '<?php echo $GLOBALS['phone_country_code'] ?>';

/* convert the yyyy-mm-dd date to mm/dd/yyyy */
function ConvertDate(thedate) {
    var dateparts = thedate.split("-");
    return dateparts[1]+"/"+dateparts[2]+"/"+dateparts[0];
}

/* determine the Age of the person */
function CalculateAge(date1, date2) {
    var date1 = Date.parse(ConvertDate(date1));
    var date2 = Date.parse(ConvertDate(date2));
    var t = date1 - date2;
    
    var minutes = 1000 * 60;
    var hours = minutes * 60;
    var days = hours * 24;
    var years = days * 365;
    var age = t/years;

    return Math.floor(age);
}
</script>

</head>

<body class="body_top">
<?php echo date("F d, Y", time()); ?>

<form method=post action="<?php echo $rootdir;?>/forms/sports_physical/save.php?mode=new" name="my_form">
<span class="title"><?php xl('Sports Physical','e'); ?></span><br>

<!-- Save/Cancel links -->
<input type="button" class="save" value="<?php xl('Save','e'); ?>"> &nbsp; 
<input type="button" class="dontsave" value="<?php xl('Don\'t Save','e'); ?>"> &nbsp; 

<div id="form_container">  <!-- container for the main body of the form -->

<div id="general">
<table>
<tr><td>
Date: 
   <input type='text' size='10' name='form_date' id='form_date'
    value='<?php echo date('Y-m-d', time()); ?>'
    title='<?php xl('yyyy-mm-dd','e'); ?>'
    onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' />
   <img src='../../pic/show_calendar.gif' align='absbottom' width='24' height='22'
    id='img_form_date' border='0' alt='[?]' style='cursor:pointer;cursor:hand'
    title='<?php xl('Click here to choose a date','e'); ?>'>
</td></tr>
<tr><td>
Sport(s): <input id="sports" name="sports" type="text" size="60" maxlength="250">
Grade: <input id="grade" name="grade" type="text" size="10" maxlength="20">
</td></tr>
<tr><td>
Name: <input id="name" name="name" type="text" size="50" maxlength="250">
Date of Birth:
   <input type='text' size='10' name='dob' id='dob'
    value='<?php echo $date ?>'
    title='<?php xl('yyyy-mm-dd Date of Birth','e'); ?>'
    onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc); my_form.age.value = CalculateAge(my_form.form_date.value, this.value);'
    onChange="my_form.age.value = CalculateAge(my_form.form_date.value, this.value)"
   <img src='../../pic/show_calendar.gif' align='absbottom' width='24' height='22'
    id='img_dob' border='0' alt='[?]' style='cursor:pointer;cursor:hand'
    title='<?php xl('Click here to choose a date','e'); ?>'>
Age: <input id="age" name="age" type="text" size="3" maxlength="3">
</td></tr>
<tr><td>
Parent/Guardian: <input name="parent" id="parent" type="text" size="50" maxlength="250">
Phone: <input name="phone" id="phone" type="text" size="15" maxlength="15">
</td></tr>
<tr><td>
Address: <input name="address" id="address" type="text" size="80" maxlength="250">
</td></tr>
<tr><td>
What school sports have you played before?<br>
<input name="previous_sports" id="previous_sports" type="text" size="80" maxlength="250"><br>
When?  <input name="previous_years" id="previous_years" type="text" size="15" maxlength="15">
</td></tr>
</table>
</div>

<div id="history">
<h1>Health History (To be completed by student &amp; parent(s) prior to examination)</h1>
<table>
<tr>
<td class="bold">&nbsp;&nbsp;&nbsp;Yes No</td>
<td class="bold">Has this student had any:</td>
<td class="bold">&nbsp;&nbsp;&nbsp;Yes No</td>
<td class="bold">Is there any history of:</td>
</tr>
<tr>
<td width="15%">1 <input type="radio" id="chronic_illness" name="chronic_illness" value="y"> <input type="radio" id="chronic_illness" name="chronic_illness" value="n"> </td>
<td width="35%">Chronic (Asthma, Diabetes, etc) or recurrent illness?</td>
<td width="15%">16 <input type="radio" id="md_injury" name="md_injury" value="y"> <input type="radio" id="md_injury" name="md_injury" value="n"> </td>
<td width="35%">Injuries requireing MD treatment</td>
</tr>
<tr>
<td>2 <input type="radio" id="1week_illness" name="1week_illness" value="y"> <input type="radio" id="1week_illness" name="1week_illness" value="n"> </td>
<td>Illness lasting over 1 week?</td>
<td>17 <input type="radio" id="neck_injury" name="neck_injury" value="y"> <input type="radio" id="neck_injury" name="neck_injury" value="n"> </td>
<td>Neck Injury?</td>
</tr>
<tr>
<td>3 <input type="radio" id="hospitalization" name="hospitalization" value="y"> <input type="radio" id="hospitalization" name="hospitalization" value="n"> </td>
<td>Hospitalization?</td>
<td>18 <input type="radio" id="knee_injury" name="knee_injury" value="y"> <input type="radio" id="knee_injury" name="knee_injury" value="n"> </td>
<td>Knee Injury?</td>
</tr>
<tr>
<td>4 <input type="radio" id="surgery" name="surgery" value="y"> <input type="radio" id="surgery" name="surgery" value="n"> </td>
<td>Surgery other than tonsillectomy?</td>
<td>19 <input type="radio" id="knee_surgery" name="knee_surgery" value="y"> <input type="radio" id="knee_surgery" name="knee_surgery" value="n"> </td>
<td>Knee Surgery?</td>
</tr>
<tr>
<td>5 <input type="radio" id="missing_organs" name="missing_organs" value="y"> <input type="radio" id="missing_organs" name="missing_organs" value="n"> </td>
<td>Missing organs (eye, kidney, testicle)?</td>
<td>20 <input type="radio" id="ankle_injury" name="ankle_injury" value="y"> <input type="radio" id="ankle_injury" name="ankle_injury" value="n"> </td>
<td>Ankle Injury?</td>
</tr>
<tr>
<td>6 <input type="radio" id="drug_allergy" name="drug_allergy" value="y"> <input type="radio" id="drug_allergy" name="drug_allergy" value="n"> </td>
<td>Allergy to any medication?</td>
<td>21 <input type="radio" id="joint_injury" name="joint_injury" value="y"> <input type="radio" id="joint_injury" name="joint_injury" value="n"> </td>
<td>Other Serious joint injury?</td>
</tr>
<tr>
<td>7 <input type="radio" id="heart_problems" name="heart_problems" value="y"> <input type="radio" id="heart_problems" name="heart_problems" value="n"> </td>
<td>Problems with heart or blood pressure?</td>
<td>22 <input type="radio" id="broken_bones" name="broken_bones" value="y"> <input type="radio" id="broken_bones" name="broken_bones" value="n"> </td>
<td>Broken Bones?</td>
</tr>
<tr>
<td>8 <input type="radio" id="chest_pain" name="chest_pain" value="y"> <input type="radio" id="chest_pain" name="chest_pain" value="n"> </td>
<td>Chest pain with exercise?</td>
<td></td>
<td><td>
</tr>
<tr>
<td>9 <input type="radio" id="dizzy_exercise" name="dizzy_exercise" value="y"> <input type="radio" id="dizzy_exercise" name="dizzy_exercise" value="n"> </td>
<td>Dizziness or fainting with exercise?</td>
<td class="bold">&nbsp;&nbsp;&nbsp;Yes No</td>
<td class="bold">Further History:</td>
</tr>
<tr>
<td>10 <input type="radio" id="dizzy_other" name="dizzy_other" value="y"> <input type="radio" id="dizzy_other" name="dizzy_other" value="n"> </td>
<td>Dizziness, fainting, frequent headcahes or convulsions?</td>
<td>23 <input type="radio" id="no_participate" name="no_participate" value="y"> <input type="radio" id="no_participate" name="no_participate" value="n"> </td>
<td>Is there any reason why this student should not participate in Sports?</td>
</tr>
<tr>
<td>11 <input type="radio" id="concussions" name="concussions" value="y"> <input type="radio" id="concussions" name="concussions" value="n"> </td>
<td>Concussion or unconsciousness?</td>
<td>24 <input type="radio" id="sudden_death" name="sudden_death" value="y"> <input type="radio" id="sudden_death" name="sudden_death" value="n"> </td>
<td>Has any family member died suddenly less than 40 years of age of causes other than an accident?</td>
</tr>
<tr>
<td>12 <input type="radio" id="heat_problems" name="heat_problems" value="y"> <input type="radio" id="heat_problems" name="heat_problems" value="n"> </td>
<td>Heat exhaustion, heatstroke, or other problems with heat?</td>
<td>25 <input type="radio" id="heart_attack" name="heart_attack" value="y"> <input type="radio" id="heart_attack" name="heart_attack" value="n"> </td>
<td>Has any family member had a heart attack at less than 55 years of age?</td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td class="bold">&nbsp;&nbsp;&nbsp;Yes No</td>
<td class="bold">Does this student:</td>
<td></td>
<td></td>
</tr>
<tr>
<td>13 <input type="radio" id="eyeglasses" name="eyeglasses" value="y"> <input type="radio" id="eyeglasses" name="eyeglasses" value="n"> </td>
<td>Wear eyeglasses or contact lens?</td>
<td></td>
<td></td>
</tr>
<tr>
<td>14 <input type="radio" id="dental_work" name="dental_work" value="y"> <input type="radio" id="dental_work" name="dental_work" value="n"> </td>
<td>Wear dental bridges, braces, plates?</td>
<td></td>
<td></td>
</tr>
<tr>
<td>15 <input type="radio" id="medication" name="medication" value="y"> <input type="radio" id="medication" name="medication" value="n"> </td>
<td>Take any medications?</td>
<td></td>
<td></td>
</tr>
</table>
</div>

<div id="bottom">
Use this space to explain any of the above numbered YES answers or to provide any additional information <br>
<textarea name="notes" id="notes" cols="80" rows="4"></textarea>
<br><br>
<div style="text-align:right;">
Parent/Guardian signature?
<input type="radio" id="parent_sig" name="parent_sig" value="y">Yes
/
<input type="radio" id="parent_sig" name="parent_sig" value="n">No
&nbsp;&nbsp;
Date of signature: <input name="sig_date" id="sig_date" type="text" size="12" maxlength="12">
   <input type='text' size='10' name='sig_date' id='sig_date'
    value='<?php echo date('Y-m-d', time()); ?>'
    title='<?php xl('yyyy-mm-dd','e'); ?>'
    onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' />
   <img src='../../pic/show_calendar.gif' align='absbottom' width='24' height='22'
    id='img_sig_date' border='0' alt='[?]' style='cursor:pointer;cursor:hand'
    title='<?php xl('Click here to choose a date','e'); ?>'>
</div>
</div>

</div> <!-- end form_container -->

<!-- Save/Cancel links -->
<input type="button" class="save" value="<?php xl('Save','e'); ?>"> &nbsp; 
<input type="button" class="dontsave" value="<?php xl('Don\'t Save','e'); ?>"> &nbsp; 
</form>

</body>

<script language="javascript">
/* required for popup calendar */
Calendar.setup({inputField:"dob", ifFormat:"%Y-%m-%d", button:"img_dob"});
Calendar.setup({inputField:"form_date", ifFormat:"%Y-%m-%d", button:"img_form_date"});
Calendar.setup({inputField:"sig_date", ifFormat:"%Y-%m-%d", button:"img_sig_date"});

// jQuery stuff to make the page a little easier to use

$(document).ready(function(){
    $(".save").click(function() { top.restoreSession(); document.my_form.submit(); });
    $(".dontsave").click(function() { location.href='<?php echo "$rootdir/patient_file/encounter/$returnurl";?>'; });
});

</script>

</html>

