<?php

require_once '../classes/CreateDocx.inc';

$docx = new CreateDocx();
$docx->setDefaultFont('Tahoma');

$json_code_raw='{"status":true,"message":"Success","data":{"id_project_stage_info":"41","project_id":"15","stage_id":"1","version_number":"1","project_stage_status":"in progress","workflow_phase_id":"1","assigned_to":"254","created_by":"254","start_date_time":"2016-08-25 14:29:19","end_date_time":null,"id_project_stage":"1","stage_name":"Concept Note","stage_key":"concept_note","stage_order":"1","stage_workflow":"1","workflow_id":"1","next_project_stage_id":"2","stage_class":"blue-thick-bg","stage_status":"1","created_date_time":"2016-08-19 14:24:39","fields":{"project_title":"Aponye Term Loan","borrower":"Aponye","application_date":"2016-08-25 14:29:19","country_office":"Rwanda Office","main_sector":"Agriculture and Fisheries","sub_sector":null,"required_loan_amount_currency":[{"project_facility_name":"Aponye Term Loan","facility_amount":"0","currency":"RWF"}],"project_description":"<p>The Bank has received an application from Aponye Uganda Limited for a term loan facility of up to UGX 17 billion for capital expenditure and working capital to support the construction of silos and processing facilities at Kyazanga and Mubende and the purchase of adequate grain stocks.<\/p>\n\n<p>Aponye Uganda Ltd (&lsquo;Aponye&rsquo;) is involved in buying and selling of produce in the domestic and regional market as well as cargo transportation. The company buys maize, beans and sorghum from farmers and traders, improves the grain quality by cleaning, drying and packing in 50 kg unit bags. The company currently handles over 80,000 metric tonnes of grain annually and provides market to over 10,000 small holder farmers who they also support with small sized corn shellers and tarpaulins to help improve on quality of post-harvest handling activities. Aponye Uganda Ltd is also involved in small holder farmers&rsquo; sensitization on best agronomy and post-harvest handling practices.<\/p>\n\n<p>Currently Aponye operations comprise of;<\/p>\n\n<p>Grain cleaning and drying facilities at Plot 6, Nalukolongo in Kampala and in Kyazanga, Lwengo District.<\/p>\n\n<ol style=\"list-style-type:lower-alpha;\">\n\t<li>Grain milling plant at Plot 6, Nalukolongo in Kampala.<\/li>\n\t<li>Cooking Oil refinery at Plot 6, Nalukolongo in Kampala.<\/li>\n\t<li>Soap processing plant at Plot 6, Nalukolongo in Kampala.<\/li>\n<\/ol>\n","project_concept_purpose":"<p>Existing farmers and traders from Mubende, Kyenjojo, Mityana and Kamwenge districts who supply maize to Aponye face high transportation costs and have inadequate market infrastructure for drying, storage, packing and market information and therefore supply grains of poor quality.<\/p>\n\n<p>Therefore Aponye&rsquo;s expansion plan to establish a grain handling facility in Mubende is an important part solution to the problem of maize quality in Uganda.<\/p>\n","status_of_project_implementation":"","project_cost_financing_plan":"<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" width=\"462\">\n\t<tbody>\n\t\t<tr>\n\t\t\t<td style=\"width:103px;height:86px;\">\n\t\t\t<p><u>Interest Rate<\/u>:<\/p>\n\t\t\t<\/td>\n\t\t\t<td style=\"width:359px;height:86px;\">\n\t\t\t<p>The facility will carry an interest rate of EADB UGX internal Reference Rate minus 150 bps which currently translates to an interest rate of 15.0% per annum on disbursed and outstanding Loan amounts.<\/p>\n\t\t\t<\/td>\n\t\t<\/tr>\n\t\t<tr>\n\t\t\t<td style=\"width:103px;height:34px;\">\n\t\t\t<p><u>Appraisal Fee\/ Commission<\/u>:<\/p>\n\t\t\t<\/td>\n\t\t\t<td style=\"width:359px;height:34px;\">\n\t\t\t<p>100 bps on total Loan amount equivalent to<\/p>\n\n\t\t\t<p>UGX 120 million.<\/p>\n\t\t\t<\/td>\n\t\t<\/tr>\n\t\t<tr>\n\t\t\t<td style=\"width:103px;height:40px;\">\n\t\t\t<p><u>Waiver Fee<\/u>:<\/p>\n\t\t\t<\/td>\n\t\t\t<td style=\"width:359px;height:40px;\">\n\t\t\t<p>USD 10,000 for material waivers in the Loan agreement.<\/p>\n\t\t\t<\/td>\n\t\t<\/tr>\n\t<\/tbody>\n<\/table>\n","summary_of_avalibale_information":"","social_and_environmental_concerns":"<p>The project site is within a sparsely forested area that is reserved for Mubende Town Council industrial park. The project is expected to have minor environmental impacts, mainly site specific, whose mitigation measures the promoters have factored in the project implementation plan and necessary approvals applied for from the environmental management authority.<\/p>\n"}}}';
$json_code=preg_replace('/<table (.*?)>/', '<table border=\'1\' style=\'border-collapse: collapse;border-color: #000000;\' >', $json_code_raw);
$concept_note_raw_data=json_decode($json_code, true);
$concept_note_date=$concept_note_raw_data['data'];
$project_name=$concept_note_date['fields']['project_title'];
$country=$concept_note_date['fields']['country_office'];
$application_date = date("d-m-Y", strtotime($concept_note_date['fields']['application_date']));
$borrower=$concept_note_date['fields']['borrower'];
$main_sector=$concept_note_date['fields']['main_sector'];
$sub_sector=$concept_note_date['fields']['sub_sector'];
$requested_loan_data=$concept_note_date['fields']['required_loan_amount_currency'];
//Need to build the phpdocx table

$load_data=array(array('Name','Amount','Currency'));
for($t=0;$t<count($requested_loan_data);$t++)
{
    array_push($load_data,array_values($requested_loan_data[$t]));
}
$requested_loan_table=$docx->buildArrayToTable($load_data);

//End of table build
$project_description=$concept_note_date['fields']['project_description'];
$project_concept_purpose=$concept_note_date['fields']['project_concept_purpose'];
$status_of_project_implementation=$concept_note_date['fields']['status_of_project_implementation'];
$project_cost_estimates=$concept_note_date['fields']['project_cost_financing_plan'];
$summary_of_available_information=$concept_note_date['fields']['summary_of_avalibale_information'];
$social_and_environmental_concerns=$concept_note_date['fields']['social_and_environmental_concerns'];
//exit;

$options = array(
    'display' => 'firstPage',
    'borderWidth' => 12,
    'borderColor' => '000000'
);
$docx->addPageBorders($options);
$textOptions = array(
    'textAlign' => 'right',
    'fontSize' => 13,
    'color' => '000000',
);
$headerText = new WordFragment($docx, 'defaultHeader');
$headerText->embedHTML('<p style="text-align:right; font-size:9;">Concept Note '.$project_name.'<br>'.$application_date.', '.$country.'</p>');
$first = new WordFragment($docx, 'firstHeader');
$first->addText('');
$docx->addHeader(array('default' => $headerText, 'first' => $first));

$pageNumberOptions = array(
    'textAlign' => 'center',
    'fontSize' => 11
);
$default = new WordFragment($docx, 'defaultFooter');
$default->addPageNumber('numerical', $pageNumberOptions);
$first = new WordFragment($docx, 'firstFooter');
$first->addPageNumber('numerical', $pageNumberOptions);

$docx->addFooter(array('default' => $default, 'first' => $first));

$docx->modifyPageLayout('A4',array('marginLeft' => '1000','marginRight' => '1000'));


$html = '<table style="width: 600;font-size: 11;"><tr><td style="text-align: left;width: 300;">Confidential</td><td style="text-align: left;width: 300;">BP. No. [Project Reference Number]</td></tr></table>
        <h2 style="color:#000; text-align:center; font-weight:bold;font-size: 14; padding:30px 0;margin-top: 80px">EAST AFRICAN DEVELOPMENT BANK</h2>
        <h3 style="text-align:center; font-weight:bold; padding:20px 0;">%1s</h3>
        <p style="text-align:center; padding:20px 0; font-size:16px;">%2s</p>
        <h3 style="text-align:center; padding:30px 0;margin-bottom: 300">CONCEPT NOTE</h3>
        <table border="0" style="border:0;width: 600;margin-top: 650;font-size: 11;text-align: left;">
            <tr>
                <td colspan="2" style="font-weight:bold;padding: 20;">PROJECT TEAM:</td>
            </tr>
        	<tr style="padding: 20;">
            	<td>Task Manager:</td>
            	<td>....................</td>
            </tr>
            <tr>
            	<td>Reviewing Manager:</td>
                <td>....................</td>
            </tr>
            <tr>
            	<td>Environmental Specialist:</td>
                <td>....................</td>
            </tr>
            <tr>
            	<td>Legal Counsel:</td>
                <td>....................</td>
            </tr>
            <tr>
            	<td>Appraisal Manager:</td>
                <td>....................</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 20;">Date: <span style="color:red;font-style: italic">[Input Date]</span></td>
            </tr>
        </table>';

$html_1 = '<table border="1" width="650" style="width: 600;border-collapse: collapse;border-color: #000000;margin-top: 10px;font-size: 11;text-align: left;" >
			<tbody>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;text-align: left;">1.</td>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;text-align: left;">THE APPLICATION</td>
					<td nowrap="nowrap" style="width:250px;height:17px;font-weight:bold;text-align: center;"></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;text-align: left">1.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;text-align: left">Project Title:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%1s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.2.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Borrower:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%2s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Application Date:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%3s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Country Office:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%4s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.5.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Main Sector:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%5s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.6.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Sub-Sector:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%6s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.7.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Required Loan Amount and Currency</td>
					<td>'.$requested_loan_table.'</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">2</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">THE PROJECT</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project Description / Objectives:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%7s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.2.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project Concept / Purpose</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%8s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Status of Project Implementation</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%9s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project Cost Estimates / Proposed Financing Plan</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%10s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.5.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Summary of available Information</div></td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%11s</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.6.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Social and Environmental Concerns</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">%12s</td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.7.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Others</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><span style="color:red;font-style: italic">[Input from D3]</span></td>
				</tr>
			</tbody>
		</table>
        <div style="margin-top:50px">
        	<table style="width: 600;border: none;">
            	<tr>
                	<td style="font-weight: bold;">Date of Report:</td>
                    <td>...................</td>
                </tr>
                <tr>
                	<td>Officer-In-Charge:</td>
                    <td>...................</td>
                </tr>
                <tr style="padding-top: 20px;">
                	<td>Signature:</td>
                    <td>...................</td>
                </tr>
                <tr>
                	<td style="font-weight: bold;">Clearance by EADB <br/> Management:</td>
                    <td>...................</td>
                </tr>
                <tr>
                	<td>Date:</td>
                    <td>...................</td>
                </tr>
				<tr style="padding-top: 20px;">
                	<td>Signature:</td>
                    <td>...................</td>
                </tr>
            </table>
    </div>';

$html=sprintf($html,$project_name,$country);
$html_1=sprintf($html_1,$project_name,$borrower,$application_date,$country,$main_sector,$sub_sector,$project_description,$project_concept_purpose,$status_of_project_implementation,$project_cost_estimates,$summary_of_available_information,$social_and_environmental_concerns);
$docx->embedHTML($html);
$docx->addBreak(array('type' => 'page'));
$docx->embedHTML($html_1);
$docx->createDocx('Template_ 1 Concept Note_test');