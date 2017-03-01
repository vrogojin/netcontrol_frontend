<?php


// Application_ID
$app_id="net_control";


// Page title
$page_title="NET CONTROL";

// The header HTML code
$head='
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-Equiv="Cache-Control" Content="no-cache">
	<meta http-Equiv="Pragma" Content="no-cache">
	<meta http-Equiv="Expires" Content="0">
';


$style='
    html{
    background-color: #f3f3f3;
    }

    .main-content{
    margin-top: 20px;
    margin-bottom: 20px;
    }

    .form-labels-on-top{
        box-sizing: border-box;
        max-width: 700px;
        margin: 0 auto;
        padding: 55px;

        background-color:  #ffffff;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);

        font: bold 14px sans-serif;
        text-align: center;
    }

    header{
    box-sizing: border-box;
    text-align: center;
    width: 100%;
    padding: 25px 40px;
    background-color: #34495e;
    overflow: hidden;
    margin: 0 auto;
    }


    header h1{
        float: left;
        font: normal 24px/1.5 \'Open Sans\', sans-serif;
        color: #fff;
    }

    header a{
        color:#fff;
        float: right;
        text-decoration: none;
        display: inline-block;
        width: 150px;
        height: 15px;
        padding: 13px 0px;
        border-radius: 3px;
        font: bold 14px/1 \'Open Sans\', sans-serif;
        background-color:#27ae60;
        margin: auto;
        margin-left: 5px;
        margin-top: 5px;

    }

    .form-labels-on-top .form-row{
        text-align: left;
        max-width: 405px;
        margin: 25px auto 0;
    }

    .form-labels-on-top .form-title-row{
        margin: 0 auto 40px;
    }

    .form-labels-on-top h1{
        display: inline-block;
        box-sizing: border-box;
        color: #4C565E;
        font-size: 24px;
        padding: 0 0 12px 0;
        margin: 0;
        border-bottom: 2px solid #6CAEE0;
    }

    .form-labels-on-top .form-row > label span{
        display: block;
        box-sizing: border-box;
        color:  #5f5f5f;
        width: 400px;
        padding: 0 0 12px;
    }

    .form-labels-on-top input{
    color:  #5f5f5f;
    box-sizing: border-box;
    width: 100%;
    max-width: 405px;
    box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
    padding: 12px 18px;
    border: 1px solid #dbdbdb;
    
    }

    .form-labels-on-top .form-row .form-radio-buttons {
        width: auto;
    }

    .form-labels-on-top .form-row .form-check-box {
        width: auto;
    }

    .form-labels-on-top textarea{
        color:  #5f5f5f;
        box-sizing: border-box;
        width: 100%;
        height: 200px;
        box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
        border: 1px solid #dbdbdb;
        margin: auto;
    }

    .form-labels-on-top input[type=radio],
    .form-labels-on-top input[type=checkbox]{
        box-shadow: none;
        width: auto;
    }

    .form-labels-on-top select{
        background-color: #ffffff;
        color:  #5f5f5f;
        box-sizing: border-box;
        width: 100%;
        box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
        padding: 12px 18px;
        border: 1px solid #dbdbdb;
    }

    .form-labels-on-top .form-radio-buttons > div{
        margin-bottom: 10px;
    }

    .form-labels-on-top .form-radio-buttons label span{
        margin-left: 8px;
        color:  #5f5f5f;
        font-weight: normal;
    }

    .form-labels-on-top .form-check-box label span{
        margin-left: 8px;
        padding-top: 0px;
        color:  #5f5f5f;
        font-weight: normal;
    }

    .form-labels-on-top .form-radio-buttons input{
        width: auto;
    }

    .form-labels-on-top input[type=submit]{
        border-radius: 2px;
        background-color:  #6caee0;
        color: #ffffff;
        font-weight: bold;
        box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.08);
        padding: 14px 22px;
        border: 0;
        margin-top: 15px;
    }

    .footer-distributed{
    background-color: #292c2f;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
    box-sizing: border-box;
    width: 100%;
    text-align: left;
    font: bold 16px sans-serif;

    padding: 55px 50px;
    margin-top: 20px;
    }

    .footer-distributed .footer-center,
    .footer-distributed .footer-right{
        display: inline-block;
        vertical-align: top;
    }


    .footer-distributed h3 span{
        color:  #5383d3;
    }

    /* Footer links */


    .footer-distributed a{
        display:inline-block;
        float: left; 
        clear:left;
        line-height: 1.8;
        text-decoration: none;
        color:  inherit;
    }

    .footer-distributed a:hover{
        color:  #e6e6e6;
    }


    /* Footer Center */

    .footer-distributed .footer-center{
        width: 50%;
    }

    .footer-distributed .footer-center img{
        background-color:  #33383b;
        color: #ffffff;
        font-size: 25px;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        text-align: center;
        line-height: 42px;
        margin: 10px 15px;
        vertical-align: middle;
    }


    .footer-distributed .footer-center p{
        display: inline-block;
        color: #ffffff;
        vertical-align: middle;
        margin:0;
    }

    .footer-distributed .footer-center p span{
        display:block;
        font-weight: normal;
        font-size:14px;
        line-height:2;
    }


    /* Footer Right */

    .footer-distributed .footer-right{
        width: 20%;
    }

    .footer-distributed .footer-company-about{
        line-height: 20px;
        color:  #92999f;
        font-size: 13px;
        font-weight: normal;
        margin: 0;
    }

    .footer-distributed .footer-company-about span{
        display: block;
        color:  #ffffff;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 20px;
    }
';

// The header HTML code
$header='
    <header>
        <h1>NetControl4BioMed 0.1</h1>
        <a href="documentation.html">Documentation</a>
        <a href="download.html">Download</a>
        <a href="">Home</a>
    </header>
    <div class=\"main-content\">
';

// The footer HTML code
$footer='
    <footer class="footer-distributed">

            <div class="footer-center">

                <div>
                    <i class="tucs logo"><img id="tucs" src="/net_control/img/TUCS_logo.png"/></i>
                    <p><span>TUCS</span></p>
                </div>

                <div>
                    <i class="abo logo"><img id="abo" src="/net_control/img/ABO_logo.png"/></i>
                    <p><span>Åbo Akademi</span></p>
                </div>

                <div>
                    <i class="acm logo"><img id="acm" src="/net_control/img/AKA_logo.png"/></i>
                    <p><span>Academy of Finland</span></p>
                </div>

                <div>
                    <i class="tekes logo"><img id="tekes" src="/net_control/img/TEKES_logo.png"/></i>
                    <p><span>Tekes</span></p>
                </div>
                
                <div>
                    <i class="cimo logo"><img id="cimo" src="/net_control/img/CIMO_logo.png"/></i>
                    <p><span>CIMO</span></p>
                </div>
            </div>

            <div class="footer-right">

                <p class="footer-company-about">
                    <span>About</span>
                    <a href="http://">Contributers</a>
                    <a href="http://">References</a>
                </p>

            </div>
            <div class="footer-right">

                <p class="footer-company-about">
                    <span>Contact</span>
                    <a href="mailto:kkanhaiy@abo.fi">Krishna Kanhaiya</a>
                    <a href="mailto:vrogojin@abo.fi">Vladimir Rogojin</a>
                </p>

            </div>

    </footer>
';

// Per each key-value pair from this array, the page will contain a
// multiline text input with the name equal to the key.  The input
// will be preceded by the description given by the value.
$fields = array(
    "title" => array(
	"desc" => "<div class=\"form-title-row\">\n
		    <center>\n
		    <h1>SEARCH</h1>\n
		    </center>\n
		    </div>\n",
	"type" => "inline"
    ),
/*    "useremail" => array(
	"desc" => "Please Enter a Valid Email Address:",
	"type" => "email"
    ),*/
    "network" => array(
        "desc" => "List of Genes/Proteins to Generate the Network",
        "type" => "textarea"
    ),
    "graphml" => array(
	"desc" => "Custom network",
	"type" => "file",
	"id"   => "graphml"
    ),
    "cancers" => array(
        "desc" => "Cancer Cell Lines",
        "type" => "select",
        "options" => array(
    	    "none" => "None",
    	    "Breast cancer" => array(
	      "BT-20" => "BT-20",
	      "BT-474" => "BT-474",
	      "BT-549" => "BT-549",
	      "CAL-51" => "CAL-51",
	      "CAMA-1" => "CAMA-1",
	      "EFM-19" => "EFM-19",
	      "HCC1143" => "HCC1143",
	      "HCC1187" => "HCC1187",
	      "HCC1395" => "HCC1395",
	      "HCC1419" => "HCC1419",
	      "HCC1428" => "HCC1428",
	      "HCC1500" => "HCC1500",
	      "HCC1806" => "HCC1806",
	      "HCC1937" => "HCC1937",
	      "HCC1954" => "HCC1954",
	      "HCC38" => "HCC38",
	      "Hs_578T" => "Hs_578T",
	      "KPL-1" => "KPL-1",
	      "MCF7" => "MCF7",
	      "MDA-MB-157" => "MDA-MB-157",
	      "MDA-MB-231" => "MDA-MB-231",
	      "MDA-MB-361" => "MDA-MB-361",
	      "MDA-MB-436" => "MDA-MB-436",
	      "MDA-MB-453" => "MDA-MB-453",
	      "MDA-MB-468" => "MDA-MB-468",
	      "SK-BR-3" => "SK-BR-3",
	      "SW527" => "SW527",
	      "T-47D" => "T-47D",
	      "ZR-75-1" => "ZR-75-1"
	    ),
    	    "Ovarian cancer" => array(
	      "609050M" => "609050M",
	      "A2780" => "A2780",
	      "A2780_CIS" => "A2780 CIS",
	      "MM_OVCAR432_Bast_1" => "MM OVCAR432 Bast 1",
	      "OV-1946" => "OV-1946",
	      "OV-90" => "OV-90",
	      "OVCA1369_TR" => "OVCA1369 TR",
	      "OVCA433_Bast" => "OVCA433 Bast",
	      "OVCA5" => "OVCA5",
	      "OVCA8" => "OVCA8",
	      "OVCAR-3" => "OVCAR-3",
	      "SK-OV-3" => "SK-OV-3",
	      "TOV-1946" => "TOV-1946",
	      "TOV-2223G" => "TOV-2223G",
	      "TOV-3133G" => "TOV-3133G"
    	    ),
    	    "Pancreatic cancer" => array(
	      "AsPC-1" => "AsPC-1",
	      "BxPC-3" => "BxPC-3",
	      "CFPAC-1" => "CFPAC-1",
	      "Capan-2" => "Capan-2",
	      "HPAC" => "HPAC",
	      "HPAF-II" => "HPAF-II",
	      "HPDE" => "HPDE",
	      "Hs_766T" => "Hs 766T",
	      "IMIM-PC-1" => "IMIM-PC-1",
	      "IMIM-PC-2" => "IMIM-PC-2",
	      "KP-3" => "KP-3",
	      "KP-4" => "KP-4",
	      "MIA_PaCa-2" => "MIA PaCa-2",
	      "PANC-1" => "PANC-1",
	      "PL45" => "PL45",
	      "PaTu_8988S" => "PaTu 8988S",
	      "PaTu_8988T" => "PaTu 8988T",
	      "Panc_02.03" => "Panc 02.03",
	      "Panc_03.27" => "Panc 03.27",
	      "Panc_04.03" => "Panc 04.03",
	      "Panc_05.04" => "Panc 05.04",
	      "Panc_08.13" => "Panc 08.13",
	      "Panc_10.05" => "Panc 10.05"
    	    )
        )
    ),
    "cancer_checkbox" => array(
            "desc" => "Include Cancer Cell Line in Network Creation",
            "type" => "checkbox",
            "value" => "cancer-network"
    ),                                
    "target_genes" => array(
        "desc" => "List of Additional Target Genes",
        "type" => "textarea"
    ),
    "gap" => array(
        "desc" => "Gap Between Genes",
        "type" => "select",
        "options" => array(
    	    "1" => "One",
    	    "2" => "Two",
    	    "3" => "Three"
        )
    ),
    "drug" => array(
	"label" => "Target By Drug",
        "desc" => "Include in the analysis drug target approved genes from DrugBank",
        "type" => "checkbox",
        "value" => "drug"
    ),
    "additional_drug_targets" => array(
        "desc" => "User defined drug target genes to be included in the analysis",
        "type" => "textarea"
    ),
);

$form_class="form-labels-on-top";

$form_row_class="form-row";

$form_checkbox_class="form-check-box";

//$app_dir="/var/docker/combio_docker/volumes_web_services/remote_call/".$app_id."/";
$app_dir=getcwd()."/";

// Directory at the host to place the result files online for prolonged access
$wwwdir = $app_dir.getLocalSession();

// URL of the dir to access online the result files placed for prolonged access
$resurl = getLocalSession();


// The temporary directory to store intermediate files in on local host.
$tmpdir = "/tmp/$app_id";

// The name of the file we need to show on the page.
$resultFile = "res";

// List of result files to put online
$resultFiles = array(
    "html" => array(
	"remote" => "result.html",
	"link_text" => "Result"
    )
);

// The maximal allowed size of files, in bytes.
$maxResultSize = 1 * 1024 * 1024; // 1 MB

// Remote command.
$remoteCommand = "/home/net_control/start_net_control.sh";

// The simulator will stop if task is not completed within this interval.
//$remoteTimeout = 30;

// Remote host and user

$remoteHost = "net_control@backend";

// The list of options to specify to all ssh-related commands.
#$sshOpts = "-i /var/www/html/net_control/id_rsa -o 'StrictHostKeyChecking no' -o 'UserKnownHostsFile /dev/null'";
$sshOpts = "-i ".getcwd()."/id_rsa -o 'StrictHostKeyChecking no' -o 'UserKnownHostsFile /dev/null'";
#echo $sshOpts;
#$sshOpts = "-i /home/net_control/.ssh/id_rsa -o 'StrictHostKeyChecking no' -o 'UserKnownHostsFile /dev/null'";

// Should we erase working folder at the remote host after completion of executing of the program?
$eraseRemoteDir = false;


// The submit buttons to have and the commands to run, by submit
// button.
$buttons = array(
    "run" => array(
        "value"   => "Submit",
        "command" => function($workingdir) { //Script to execute set of remote bash commands
            if(handleNORS()) {
                return;
            }

            

            global $remoteCommand;
            global $remoteTimeout;
            global $app_id;
            global $wwwdir;
            $remotedir = $app_id."/".getLocalSession();
//            echo $app_id."/".getLocalSession();
            $commands = array(
                "'cd $remotedir;"
                . "export SESSION_ID=" . getLocalSession() . "; export SERVER_DIR=$wwwdir; $remoteCommand $remotedir;"
//                . "echo > res; echo --- >> res; cat output >> res; echo --- >> res; cat err >> res'"
		. "touch res;'"
            );
            withInputOnRemoteHost($workingdir, $remotedir, $commands);
        },
        "prettify" => function($output) { //Generate HTML output based on the result obtained from the remote host
            if(($output == "") || handleremoteError($output))
                return;

            // We now have to get back the parts of the output.
            $parts = preg_split("/---/", $output);

//            echo("<p />FIELD1:");
            echo("<pre>" . $parts[0] . "</pre>");

//            echo("<p />FIELD2:");
//            echo("<pre>" . $parts[1] . "</pre>");
            echo("<hr />");
//	    list_all_results($session_id);
	    echo("<hr />");
        }
    )
    
);


// Complains and returns 1 if invalid input is supplied.
// Otherwise returns 0.
function handleNoRS() {
/*    if((!isset($_POST["target_genes"]) || (trim($_POST["target_genes"]) == ""))&&
	(!isset($_POST["network"]) || (trim($_POST["network"]) == ""))) {
        prettyError("Empty input supplied for target genes or network!");
                return 1;
    }*/
    return 0;
}
                            


// The submit button on the form will be called like this.
$submitValue = "run";

$tooBigResError = "Result too big.  Currently, the result size is limited to "
    . $maxResultSize . " bytes."

?>

