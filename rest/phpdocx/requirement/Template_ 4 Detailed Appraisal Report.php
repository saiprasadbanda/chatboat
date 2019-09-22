<?php

require_once '../../../classes/CreateDocx.inc';

$docx = new CreateDocx();
$docx->setDefaultFont('Arial');

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
$headerText->embedHTML('<p style="text-align:right; font-size:16px;">Detailed Appraisal Report <span style="color:red;font-style: italic;">[Name of Project]</span><br><span style="color:red;font-style: italic;">[Date, Place]</span></p>');
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
//$first->addText('');
$docx->addFooter(array('default' => $default, 'first' => $first));

$docx->modifyPageLayout('A4',array('marginLeft' => '1000','marginRight' => '1000'));

$html = '<table style="width: 100%;"><tr><td style="text-align: left">Confidential</td><td style="text-align: left">BP. No. <span style="color:red;font-style: italic;">[Project Reference Number]</span></td></tr></table>
        <h2 style="color:#000; text-align:center; font-weight:bold; padding:30px 0;margin-top: 80px">EAST AFRICAN DEVELOPMENT BANK</h2>
        <h3 style="color:red; text-align:center; font-weight:bold; padding:20px 0;font-style: italic;">[Name of Project]</h3>
        <p style="color:red; text-align:center; padding:20px 0; font-size:16px;font-style: italic;">[Country]</p>
        <h3 style="text-align:center; padding:30px 0;margin-bottom: 200px">DETAILED APPRAISAL REPORT</h3>
        <table border="0" style="border:0;width: 100%;margin-top: 200px;margin-bottom: 100px;">
            <tr>
                <td colspan="2" style="font-size:16px; font-weight:bold;width: 100%">
                    PROJECT TEAM:
                </td>
            </tr>
        	<tr>
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
        </table>
        <div style="font-size:16px; padding:30px 0;">Date: <span style="color:red;font-style: italic">[Input Date]</span></div>
    </div>';

$html_1 = '<table border="1" width="100%" style="width: 100%;border-collapse: collapse;border-color: #000000;margin-top: 10px;" >
			<tbody>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;text-align: left;">1.</td>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;text-align: left;">INTRODUCTION</td>
					<td nowrap="nowrap" style="width:250px;height:17px;font-weight:bold;text-align: center;"></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;text-align: left">1.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;text-align: left">Main Project Features</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D18]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.2.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project Background</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D18]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Business and Economic Environment</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D18]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">2</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">CLIENT</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Company Profile</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D19]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.2.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Borrower’s character assessment and credibility</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D19]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Governance and Management</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D19]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Past Performance</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D19]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.5.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Ratio Analysis</div></td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D19]</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.6.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Risk Grading Analysis</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D19]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.7.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Financial Projections</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D19]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.8.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Security Cover Analysis</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D19]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">3</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">PROJECT</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project Concept and Rationale</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D20]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.2.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project Objectives and Description</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D20]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project Components and Cost Estimates</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D20]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Financing Plan and Role of EADB</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D20]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.5.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Implementation Plan</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D20]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.6.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project and Operational Management</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D20]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.7.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Procurement and Disbursement</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D20]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.8.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Market Analysis</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D20]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.9.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project Risks and Uncertainties</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D20]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">4</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">JUSTIFICATION OF EADB’s INVOLVEMENT</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Business Viability</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D21]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.2.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Economic Aspects</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D21]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Environmental and Social Aspects</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D21]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">EADB’s Portfolio Analysis</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D21]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.5.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">EADB’s Benefits</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D21]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.6.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">EADB’s Additionalities</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D21]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">5</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">CONCLUSIONS AND RECOMMENDATIONS</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">5.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Conclusions</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D22]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">5.2.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Recommendations</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[D22]</div></td>
				</tr>
			</tbody>
		</table>';
$docx->embedHTML($html);
$docx->addBreak(array('type' => 'page'));
$docx->embedHTML($html_1);
$docx->createDocx('Template_ 4 Detailed Appraisal Report');