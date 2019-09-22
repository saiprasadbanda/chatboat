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
$headerText->embedHTML('<p style="text-align:right; font-size:16px;">Facility Term Sheet <span style="color:red;font-style: italic;">[Name of Project]</span><br><span style="color:red;font-style: italic;">[Date, Place]</span></p>');
$docx->addHeader(array('default' => $headerText));

$pageNumberOptions = array(
    'textAlign' => 'center',
    'fontSize' => 11
);
$default = new WordFragment($docx, 'defaultFooter');
$default->addPageNumber('numerical', $pageNumberOptions);
$docx->addFooter(array('default' => $default));

$docx->modifyPageLayout('A4',array('marginLeft' => '1000','marginRight' => '1000'));

$html = '<h3 style="color:red; text-align:center; font-weight:bold; padding:20px 0;font-style: italic;">[Name of Project]</h3>
        <h3 style="text-align:center; padding:30px 0;">FACILITY TERM SHEET</h3>
        <table border="1" width="100%" style="width: 100%;border-collapse: collapse;border-color: #000000;margin-top: 10px;" >
			<tbody>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;text-align: left;">1.</td>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;text-align: left;">PARTIES</td>
					<td nowrap="nowrap" style="width:50px;height:17px;"></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;text-align: left">1.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;text-align: left">Lender:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;">East African Development Bank ("EADB" or the "Bank")</td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.2.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Borrower:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Name of Company]</div>(the "Borrower")</td>
				</tr>
                <tr style="padding-bottom:20px;">
					<td nowrap="nowrap" style="width:50px;height:17px;">1.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Shareholders:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input Shareholder Table]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">1.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Others:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">2</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">FACILITY</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Currency:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input Currency from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.2.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Amount:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input Amount from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Type of Loan:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input Type of Loan from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Purpose of the Facility:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input Facility Purpose from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">2.5.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Minimum Amount of Facility:</div></td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">3</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">PRICING</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Interest Rate</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.2.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Default Interest Rate:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Appraisal Fee & Commission:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Waiver Fee:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.5.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Commitment Fee:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">3.6.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Loan Monitoring & Management fees:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">4</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">REPAYMENT, PREPAYMENT AND CANCELLATION</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Interest Payment:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.2.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Maturity/Loan Repayments:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">----</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Voluntary Prepayment:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.5.</p></td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Mandatory Prepayment:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.6.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Cancellation:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.7.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Application of Prepayments:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">4.8.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Other Facility Modalities:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D12]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">5</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">CONDITIONS PRECEDENT TO DISBURSEMENT</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">5.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Preconditions of Disbursement:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D13]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">5.2.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">----</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D13]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">5.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">----</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D13]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">5.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Procurement of Goods:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D13]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">5.5.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Insurance</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D13]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">5.6.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Other Conditions</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D13]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">6</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">SECURITY</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">6.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Security:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D14]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">7</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">REPRESENTATIONS AND WARRANTIES, CONVENANTS AND EVENTS OF DEFAULT</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">7.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Representations and Warranties:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D15]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">7.2.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Information Undertakings:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D15]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">7.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Financial Covenants:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D15]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">7.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">General Undertakings:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D15]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">7.5.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Events of Default:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D15]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;font-weight: bold;">8</td>
					<td nowrap="nowrap" style="width:100px;height:17px;font-weight: bold;">OTHER PROVISIONS</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"></td>
				</tr>
                <tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">8.1.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Special Audit:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D16]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">8.2.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Legal Documentation:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D16]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">8.3.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Costs and Expenses:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D16]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">8.4.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Applicable Law:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D16]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">8.5.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Dispute Resolution:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D16]</div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" style="width:50px;height:17px;">8.6.</td>
					<td nowrap="nowrap" style="width:100px;height:17px;">Others:</td>
					<td nowrap="nowrap" style="width:250px;height:17px;"><div style="color:red;font-style: italic;">[Input from D16]</div></td>
				</tr>
			</tbody>
		</table>';
$docx->embedHTML($html);
$docx->createDocx('Template_ 5 Facility Term Sheet');