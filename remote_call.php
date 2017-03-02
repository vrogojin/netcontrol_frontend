<?php session_start();

/**********************************

Web interface for calling a remote CLI application via SSH

**********************************/

// Including case-specific configuration
include 'config.php';

// Local session ID
function	getLocalSession()
{
    return	session_id()."_".date('Y_m_d_H_i_s');
}

// Copies the files from $workingdir to RemoteHost, runs the supplied
function withInputOnRemoteHost($workingdir, $remotedir, $commands) {
    global $sshOpts, $resultFile, $remoteHost, $wwwdir, $resultFiles, $eraseRemoteDir;
    exec("ssh $sshOpts $remoteHost 'rm $remotedir/*'");
    exec("ssh $sshOpts $remoteHost 'mkdir -p $remotedir'");
//  echo("ssh $sshOpts $remoteHost 'mkdir -p $remotedir'");
    exec("ssh $sshOpts $remoteHost 'echo $remotedir >> test_res.txt'");
    exec("scp $sshOpts $workingdir/* $remoteHost:$remotedir");

    foreach($commands as $command){
//	echo("ssh $sshOpts $remoteHost " . $command);
        exec("ssh $sshOpts $remoteHost " . $command);
    }

    exec("scp $sshOpts $remoteHost:$remotedir/$resultFile $workingdir/");
    
    foreach(array_keys($resultFiles) as $file_id){
	exec("mkdir -p $wwwdir");
	exec("scp $sshOpts $remoteHost:$remotedir/".$resultFiles[$file_id]["remote"]." $wwwdir/");
	}

    if($eraseRemoteDir) {
        exec("ssh $sshOpts $remoteHost 'rm -r $remotedir'");
    }
}

function prettyError($msg) {
    echo("<table><tr><td style='width: 10px'><img src='error.png' /></td> <td >$msg</td></tr></table><br />");
}

// If the output contains a remote error, outputs the error and returns
// 1.  Otherwise returns 0.
function handleremoteError($output) {
    if(preg_match("/ERROR:/", $output)) {
        // remote has complained, let's just get the error message and
        // show it.
        $parts = preg_split("/ERROR:/", $output);
        prettyError($parts[1]);
        return 1;
    }
    return 0;
}


?>

<html>

<head>
    <?php if(isset($page_title)){ ?>
    <title><?php echo($page_title); ?></title>
    <?php } 
    if(isset($head)){
	echo($head);
    }
    ?>
    
    <!--  <link rel='stylesheet' id='graphene-stylesheet-css'  href='http://combio.abo.fi/wp-content/themes/graphene/style.css?ver=3.9' type='text/css' media='screen' /> -->

</head>

<style>

<?php
    if(isset($style)){
	echo($style);
    }    
?>
  
</style>


<script>
function getPageHeight() {
  var rect = document.getElementById("bottomAnchor").getBoundingClientRect();
  return rect.top;
}
<?php
if(isset($script)){
    echo($script);
}
?>
</script>

<body onload="parent.setFrameSize(getPageHeight());">

<?php

// HTML code before the fields

if(isset($header)){
    echo($header);
}


// Some error codes.
define("SUCCESS",               0);
define("NO_INPUT_SPECIFIED",    1);
define("NO_SUCH_FIELD",         2);
define("FILE_COPY_ERROR",	3);

// If the use inputs any text into the form field called $field, puts
// that into $filename.  Otherwise tries seeing if $fallbackFile got
// uploaded and moves it to $filename.  If everything works out
// nicely, returns SUCCESS, otherwise it returns an error code.
function process_input($field, $filename) {
    if(isset($_POST[$field])) {
        $content = trim($_POST[$field]);
        if($content == "") {
            // The user specified nothing.
            return NO_INPUT_SPECIFIED;
        } else {
        // The user has actually written something in the text
        // field.
        $handle = fopen($filename, "w");
        if(!$handle)
            die("FATAL: Could not create the file " . $filename . ".");
        fwrite($handle, $content);
        fclose($handle);
        return SUCCESS;
        }
    } else {
        return NO_SUCH_FIELD;
    }
}

function process_input_file($file, $filename) {
//    echo("file=$file<br>");
//    echo("filename=$filename<br>");
//    echo($_FILES[$file]["tmp_name"]);
    if(isset($_FILES[$file]))
    {
//	echo($_FILES[$file]["tmp_name"]);
//	echo("<br>");
	if(strlen($_FILES[$file]["tmp_name"])>0){
    	    if(copy($_FILES[$file]["tmp_name"],$filename)){
		return	SUCCESS;}
		else{
		    return	FILE_COPY_ERROR;}
	    }
	else
	{
	    return	NO_SUCH_FIELD;
	}
    }
    else
    {
	return	NO_SUCH_FIELD;
    }
}

function detect_button() {
    global $buttons;
    foreach(array_keys($buttons) as $name)
        if(isset($_POST[$name]))
            return($name);

    return "";
}

function	list_all_results($id){
    global $app_id;
    global $wwwdir;
    $app_dir="/var/www/html/".$app_id;
    echo("<details>\n\t<summary>PREVIOUS RUNS:</summary>\n\t<br>\n\t<ul>");
    foreach (glob($id."*") as $filename){
    echo("\t\t<li><a href=\"$filename/result.html\" target=\"_new\">".str_replace($id."_","",$filename)."</a></li>\n");
    }
    echo("\t</ul>\n</details>");
}


$button = detect_button();

if($button != "") {
    // We have a result to process and then show, before showing the
    // form.

    // We will put all the files specific to this system in the
    // directory with this session name under $tmpdir.
    $workingdir = $tmpdir . "/" . getLocalSession() . "/";
    exec("rm $workingdir/*");
    mkdir($workingdir, 0777, true);

    // Get all stuff from the user and put it into files.
    foreach(array_keys($fields) as $field)
        process_input($field, $workingdir . $field);

    foreach(array_keys($_FILES) as $file)
	process_input_file($file, $workingdir . $file);

    // Execute the command associated with the button the user
    // clicked.
    $buttons[$button]["command"]($workingdir);

    // Retrieve the result.
    $resSize = filesize($workingdir . $resultFile);
    if($resSize > $maxResultSize) {
        prettyError($tooBigResError);
    } else {
        $handle = fopen($workingdir . $resultFile, "r");
        $res = fread($handle, $resSize);
        fclose($handle);

        $buttons[$button]["prettify"]($res);
    }

    // Generating link to the resulting files left from the last run
    foreach(array_keys($resultFiles) as $file_id)
    {
	echo("<br><a href=\"".$resurl."/".$resultFiles[$file_id]["remote"]."\" target=\"_new\">".$resultFiles[$file_id]["link_text"]."</a>");
    }
    
    echo("<hr>");
    list_all_results(session_id());
    echo("<hr>");
    
    // Now clean up everything.
    foreach(array_keys($fields) as $field)
        unlink($workingdir . $field);

    unlink($workingdir . $resultFile);
    rmdir($workingdir);
}


?>

<p />

<?php if(isset($form_class)){ ?>
<form method="post" action="remote_call.php" class=<?php echo("\"$form_class\""); ?> enctype="multipart/form-data">
<?php
}else{
?>
<form method="post" action="remote_call.php" enctype="multipart/form-data">
<?php
}
?>

<?php
    foreach($fields as $field => $info) {
    
	if(isset($form_row_class)){
	    ?><div class=<?php echo("\"$form_row_class\""); ?>><?php
	}

        switch($info["type"]) {
        case "inline":echo($info["desc"]);break;
        case "textarea":
?>

<label><span>
<?php echo($info["desc"]); ?></span>
<textarea name=<?php echo("\"$field\"") ?> >
<?php if(isset($_POST[$field])) echo($_POST[$field]); ?>
</textarea></label><br />

<?php   break;
	case "email":?>
<label><span>
<?php echo($info["desc"]); ?></span>
<input type="email" name=<?php echo("\"$field\"") ?> 
<?php if(isset($_POST[$field])) echo("value=\"$_POST[$field]\""); ?> >
</input></label><br />
	
<?php   break;	
        case "checkbox":?>

<?php if(isset($info["label"])){
?>	<label><span><?php echo($info["label"]); ?></span></label>
<?php } 
if(isset($form_checkbox_class)){
?>
<div class=<?php echo("\"$form_checkbox_class\""); ?> >
<?php } 
    else{
    ?><br /><?php
    }
?>
<label>
    <input type="checkbox" name=<?php echo("\"$field\""); if(isset($_POST[$field])) echo("checked") ?>
       />
    <span><?php echo($info["desc"]) ?></span>
</label>

<?php
if(isset($form_checkbox_class)){
?>
</div>
<?php } ?>


<?php   break; ?>

<?php	case "select":?>
    <label><span>
    <?php echo($info["desc"]); ?></span>
    <select name=<?php echo("\"$field\""); ?> >
    <?php	foreach($info["options"] as $option => $opt_item) {
	if(is_array($opt_item)){
	    ?><optgroup label=<?php echo("\"$option\""); ?> ><?php
	    foreach($opt_item as $sub_option => $opt_text){
		?>
		    <option value=<?php echo("\"$sub_option\""); 
		    if(isset($_POST[$field])){
			if(strcmp($_POST[$field],$sub_option)==0){
			    echo(" selected=\"selected\"");
			}
		    }
		    ?> ><?php echo($opt_text); ?></option>
		<?php
	    }?>
	    </optgroup>
	    <?php
	}
	else{
	?>
	<option value=<?php echo("\"$option\""); 
	if(isset($_POST[$field])){
	    if(strcmp($_POST[$field],$option)==0){
		echo(" selected=\"selected\"");
	    }
	}
	?> ><?php echo($opt_item); ?></option>
<?php    }
    }
    ?>
    </select></label>
<?php	break; ?>

<?php	case "file":?>
    <label><span>
    <?php echo($info["desc"]); ?></span>
    <input type="file"
	name=<?php echo("\"$field\"") ?>
	id=<?php echo("\"{$info['id']}\"") ?>
	/></label>
<?php	break; ?>

<?php   }
	if(isset($form_row_class)){
	    ?></div><?php
	}
     } ?>

<?php foreach($buttons as $name => $desc) { ?>

<input type ="submit"
       name =<?php echo("\"$name\"") ?>
       value=<?php echo("\"{$desc['value']}\"")?>
       />

<?php } ?>

</form>
<div id="bottomAnchor" style="height: 0px" />

<?php

// HTML code after the fields
if(isset($footer)){
    echo($footer);
}

?>

</body>
</html>
