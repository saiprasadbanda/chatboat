<?php

require_once '../../../classes/CreateDocx.inc';

$docx = new CreateDocx();
$docx->setDefaultFont('Tahoma');

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
$headerText->embedHTML('<p style="text-align:right; font-size:9;">Pre-Appraisal Report <span style="color:red;font-style: italic;">[Name of Project]</span><br><span style="color:red;font-style: italic;">[Date, Place]</span></p>');
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
        <h3 style="text-align:center; padding:30px 0;margin-bottom: 200px">PRE-APPRAISAL REPORT</h3>
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
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;text-align: left;">SUMMARY OF THE PROPOSAL</td>
					<td nowrap="nowrap" style="width:250px;height:17px;font-weight:bold;text-align: center;"></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;text-align: left">1.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;text-align: left">Statement of the Application</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D7]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.2.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project Background Information</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D7]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Rationale of the Client to apply</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D7]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Project Concept & Scope</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D7]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.5.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Expected Economic Benefit and Additionalities</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D7]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">2</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">PROJECT AND COMPANY ASSESSMENT</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Shareholder Structure</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D8]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.2.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Sponsors and Promoters</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D8]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Products / Operations</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D8]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Markets</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D8]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.5.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Environmental and Social Considerations</div></td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D8]</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.6.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Financial Aspects</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D8]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">3</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">RISK ASSESSMENT</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Risk Grading</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D8]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.2.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Risk Factor</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D8]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Comments on Risk Assessment</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input D8]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">4</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">COMMENTS AND OBSERVATIONS</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Strengths and Weaknesses Analysis</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D9]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.2.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Credit Worthiness</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D9]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Short Character Assessment</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D9]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">5</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">RECOMMENDATIONS</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">5.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Recommendations</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D10]</div></td>
				</tr>
			</tbody>
		</table>
        <div style="margin-top:50px">
        	<table style="width: 100%;border: none;">
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
$docx->embedHTML($html);
$docx->addBreak(array('type' => 'page'));
$docx->embedHTML($html_1);
$docx->createDocx('Template_ 2 Pre Appraisal');