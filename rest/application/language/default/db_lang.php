<?php
/*
 * English language
 */
$lang['text_rest_invalid_api_key'] = 'Invalid API key %s'; // %s is the REST API key
$lang['text_rest_invalid_credentials'] = 'Invalid credentials';
$lang['text_rest_ip_denied'] = 'IP denied';
$lang['text_rest_ip_unauthorized'] = 'IP unauthorized';
$lang['text_rest_unauthorized'] = 'Unauthorized';
$lang['text_rest_ajax_only'] = 'Only AJAX requests are allowed';
$lang['text_rest_api_key_unauthorized'] = 'This API key does not have access to the requested controller';
$lang['text_rest_api_key_permissions'] = 'This API key does not have enough permissions';
$lang['text_rest_api_key_time_limit'] = 'This API key has reached the time limit for this method';
$lang['text_rest_unknown_method'] = 'Unknown method';
$lang['text_rest_unsupported'] = 'Unsupported protocol';


//custom messages
//$this->lang->line('company_id_req') - syntax for getting message
$lang['session_exceed'] = 'Already logged in other location';
$lang['account_created'] = 'Account Created';
$lang['qlana_account_created'] = 'Q-lana Account Created';
$lang['hello'] = 'hello';
$lang['welcome_to_qlana'] = 'welcome to q-lana';
$lang['login_details_are'] = 'your login details are';
$lang['email_label'] = 'Email';
$lang['password_label'] = 'Password';
$lang['account_created_label'] = 'Account Created';

$lang['invalid_data'] = 'Invalid Data';
$lang['invalid_fields'] = 'Invalid fields';
$lang['invalid_type'] = 'Invalid type';
$lang['success'] = 'Success';
$lang['name_req'] = 'Name required';
$lang['id_req'] = 'id required';
$lang['company_id_req'] = 'Company id required';
//$lang['crm_project_id_req'] = 'Project id required';
$lang['assigned_to_req'] = 'Assigned to required';
$lang['status_req'] = 'Status required';
$lang['comment_req'] = 'Comment required';
$lang['comment_by_req'] = 'Comment by required';
$lang['comment_to_req'] = 'Comment to required';
$lang['form_key_req'] = 'Form key required';
$lang['field_key_req'] = 'Form key required';
$lang['reference_type_req'] = 'Reference Type required';
$lang['reference_id_req'] = 'Reference id required';
$lang['image_format'] = 'upload only jpg,png format files only';
$lang['image_size'] = 'Image size must be less than 2MB';
$lang['password_req'] = 'Password required';
$lang['login_error'] = 'Incorrect login details';
$lang['new_password'] = 'New password mailed successfully.';
$lang['upload_error'] = 'attachment upload error occurred';
$lang['info_update'] = 'Information saved.';
$lang['info_add'] = 'Information saved';
$lang['data_req'] = 'Data required';
$lang['offset_req'] = 'offset required';
$lang['limit_req'] = 'limit required';
$lang['no_records_found'] = 'No records found';
$lang['customer_add'] = 'Customer created successfully';
$lang['company_inactive'] = 'Company Inactivated successfully';
$lang['xls_valid'] = 'upload only xls,xlsx format files only';
$lang['upload_excel'] = 'Please upload excel';
$lang['max_upload_size'] = 'Maximum MUZ files allowed';
$lang['excel_headers_match'] = 'Excel headers does not match';
$lang['excel_empty'] = 'Excel is empty';
$lang['state_req'] = 'State required';
$lang['city_req'] = 'City required';
$lang['country_invalid'] = 'invalid country';
$lang['max_2mb_allowed'] = 'Maximum 2MB files allowed';
$lang['invalid_format'] = 'Invalid format file';
$lang['module_data_req'] = 'Module data required';
$lang['master_key_req'] = 'Master key required';
$lang['search_key_req'] = 'Search key required';
$lang['search_type_req'] = 'Search type required';

//user
$lang['created_by_req'] = 'Created by required';
$lang['user_req'] = 'user required';
$lang['user_id_req'] = 'User id required';
$lang['email_req'] = 'Email required';
$lang['email_invalid'] = 'Enter valid email';
$lang['email_wrong'] = 'Invalid email';
$lang['email_not_exists'] = 'Email does not exist';
$lang['user_update'] = 'User updated successfully.';
$lang['user_add'] = 'User created successfully.';

//sector
$lang['sector_req'] = 'Sector required';
$lang['sector_name_req'] = 'Sector name required';
$lang['sector_name_duplicate'] = 'Sector name already exists';
$lang['sector_add'] = 'Sector added successfully';
$lang['sector_update'] = 'Sector updated successfully';
$lang['sector_id_req'] = 'Sector id required';
$lang['sub_sector_id_req'] = 'Sub sector id required';

//country
$lang['country_name_req'] = 'Country name required';
$lang['country_duplicate'] = 'Country already exists';
$lang['country_add'] = 'Country added successfully';
$lang['country_update'] = 'Country updated successfully';
$lang['country_delete'] = 'Country deleted successfully';

//branch type
$lang['branch_type_name_req'] = 'Branch Type name required';
$lang['branch_type_duplicate'] = 'Branch type already exist';
$lang['branch_type_add'] = 'Branch type added successfully';
$lang['branch_type_update'] = 'Branch type updated successfully';
$lang['branch_type_req'] = 'Branch type required';
$lang['branch_type_invalid'] = 'Invalid branch type';
$lang['branch_id_req'] = 'branch_id required';
$lang['reporting_branch_type_req'] = 'Reporting branch type required';
$lang['same_approval_role_err'] = 'You can not report to same approval role';

//branch
$lang['branch_req'] = 'Branch required';
$lang['branch_name_req'] = 'Branch name required';
$lang['address_req'] = 'Address required';
$lang['city_req'] = 'City required';
$lang['branch_code_req'] = 'Branch code required';
$lang['branch_update'] = 'Branch updated successfully';
$lang['branch_add'] = 'Branch created successfully';
$lang['legal_name_req'] = 'Legal name required';
$lang['reporting_branch_req'] = 'Reporting Branch required';
$lang['reporting_branch_invalid'] = 'invalid Reporting branch';
$lang['add_succ'] = 'Successfully added';
$lang['branches_uploaded_suc'] = 'Branches uploaded successfully.';
$lang['branch_invalid'] = 'invalid Branch';

//plans
$lang['plan_name_req'] = 'Plan name required';
$lang['no_of_loans_req'] = 'No of loans required';
$lang['no_of_loans_num'] = 'No of loans should be numeric';
$lang['no_of_users_req'] = 'No of users required';
$lang['no_of_users_num'] = 'No of users should be numeric';
$lang['disk_space_req'] = 'Total disk space required';
$lang['disk_space_num'] = 'Total disk space should be numeric';
$lang['price_per_loan_req'] = 'Price per loan required';
$lang['price_per_loan_num'] = 'Price per loan should be numeric';
$lang['plan_add'] = 'Plan Added successfully';
$lang['plan_update'] = 'Plan updated successfully';

//risk
$lang['risk_name_req'] = 'Name required';
$lang['risk_name_duplicate'] = 'Risk already exist';
$lang['risk_add'] = 'Risk added successfully';
$lang['risk_update'] = 'Risk updated successfully';
$lang['risk_delete'] = 'Risk deleted successfully';
$lang['risk_factors_req'] = 'Risk factors required';
$lang['risk_comment_req'] = 'Comment required';
$lang['risk_assessment_update'] = 'Risk Assessment updated successfully.';
$lang['risk_assessment_info_add'] = 'Risk assessment information added';
$lang['risk_assessment_info_update'] = 'Risk assessment information updated';
$lang['risk_percentage_req'] = 'Risk percentage required';
$lang['risk_percentage_exceeds'] = 'Risk percentage exceeds';
$lang['risk_category_add'] = 'Risk category added successfully.';
$lang['risk_category_update'] = 'Risk category updated successfully.';
$lang['category_id_req'] = 'Category id required';
$lang['category_item_name_req'] = 'category item name required';
$lang['category_item_grade_req'] = 'Category item grade required';
$lang['risk_category_item_add'] = 'Risk category Item added successfully.';
$lang['risk_category_item_update'] = 'Risk category Item updated successfully.';
$lang['risk_category_item_id_req'] = 'Risk category item id required';

//social
$lang['business_social_network_req'] = 'Name required';
$lang['business_social_network_duplicate'] = 'Name already exist';
$lang['business_social_network_add'] = 'Network added successfully';
$lang['business_social_network_update'] = 'Network updated successfully';

//Other
$lang['child_name_req'] = 'Name required';
$lang['child_name_duplicate'] = 'Name already exist';
$lang['child_name_add'] = 'Master added successfully';
$lang['child_name_update'] = 'Master updated successfully';

//contact
$lang['business_contact_req'] = 'Name required';
$lang['business_contact_duplicate'] = 'Name already exist';
$lang['business_contact_add'] = 'Contact added successfully';
$lang['business_contact_update'] = 'Contact updated successfully';

//bank category
$lang['bank_category_req'] = 'Bank category required';
$lang['bank_category_name_req'] = 'Bank category name required';
$lang['bank_category_update'] = 'Bank category updated successfully';
$lang['bank_category_add'] = 'Bank category added successfully';
$lang['category_name_req'] = 'Category name required';
$lang['parent_category_id_req'] = 'Parent category id required';

//approval Role
$lang['approval_name_req'] = 'Approval name required';
$lang['approval_role_req'] = 'Approval role required';
$lang['approval_role_add'] = 'Approval role added successfully';
$lang['approval_role_update'] = 'Approval role updated successfully';
$lang['reporting_role_req'] = 'Reporting role required';
$lang['approval_name_invalid'] = 'Invalid approval name';

//currency
$lang['country_req'] = 'Country required';
$lang['currency_req'] = 'Currency required';
$lang['currency_code_req'] = 'Currency code required';
$lang['currency_symbol_req'] = 'Currency symbol required';
$lang['currency_add'] = 'Currency added successfully.';
$lang['currency_update'] = 'Currency updated successfully.';
$lang['config_currency'] = 'Please configure currency and try again';
$lang['company_url_req'] = 'Company url required';
$lang['primary_currency_update'] = 'Primary currency updated successfully.';

//language
$lang['code_req'] = 'Code required';
$lang['flag_req'] = 'Flag required';
$lang['name_req'] = 'Name required';
$lang['name_in_english_req'] = 'Name in english required';
$lang['language_id_req'] = 'Language id successfully.';
$lang['name_duplicate'] = 'Name already exists';
$lang['name_in_english_duplicate'] = 'Name in english already exists';
$lang['lang_added'] = 'Language added successfully.';
$lang['lang_updated'] = 'Language updated successfully.';
$lang['lang_delete'] = 'Language deleted successfully.';

//user
$lang['first_name_req'] = 'Enter valid first name';
$lang['first_name_len'] = 'First name should be below 100 characters';
$lang['last_name_req'] = 'Enter valid last name';
$lang['last_name_len'] = 'Last name should be below 100 characters';
$lang['old_password_req'] = 'Old password required';
$lang['old_password_num'] = 'Old Password should be alpha numeric';
$lang['confirm_password_req'] = 'Confirm Password required';
$lang['password_match'] = 'Password not matched';
$lang['phone_num_req'] = 'Phone Number required';
$lang['phone_num_num'] = 'Phone number should be numeric';
$lang['phone_num_min_len'] = 'Phone no must be minimum 7 digits';
$lang['phone_num_max_len'] = 'Phone no must be maximum 10 digits';
$lang['phone_num_max_len_20'] = 'Phone no must be maximum 20 digits';
$lang["old_password_not_match"] = "Existing password doesn't match";
$lang['password_changed'] = 'Password changed successfully.';
$lang['user_add'] = 'User created successfully.';
$lang['email_duplicate'] = 'Email already exists';
$lang['reporting_to_req'] = 'Reporting_to required';
$lang['reporting_to_invalid'] = 'invalid reporting_to';
$lang['users_upload'] = 'Users uploaded successfully.';
$lang['password_num_min_len'] = 'Password must be minimum 6 characters';
$lang['password_num_max_len'] = 'Password must be maximum 12 characters';

//task
$lang['task_req'] = 'task required';
$lang['task_type_req'] = 'task type required';
$lang['task_add'] = 'Task added successfully.';
$lang['task_update'] = 'Task updated successfully.';
$lang['task_delete'] = 'Task deleted successfully.';

//meeting
$lang['meeting_name_req'] = 'Meeting name required';
$lang['where_req'] = 'where parameter required';
$lang['when_req'] = 'when parameter to required';
$lang['meeting_add'] = 'Meeting scheduled successfully.';
$lang['meeting_update'] = 'Meeting updated successfully.';
$lang['meeting_complete'] = 'Meeting Completed successfully.';
$lang['meeting_cancel'] = 'Meeting cancelled successfully.';
$lang['meeting_delete'] = 'Meeting deleted successfully.';
$lang['meeting_task_type_req'] = 'task type required';
$lang['from_time_req'] = 'From time required';
$lang['end_time_req'] = 'End time required';
$lang['meeting_id_req'] = 'Meeting id required';
$lang['meeting_mom_req'] = 'Meeting mom required';

//discussion
$lang['dis_ref_id_req'] = 'discussion reference id required';
$lang['dis_type_req'] = 'discussion type required';
$lang['dis_description_req'] = 'discussion description required';
$lang['dis_add'] = 'Discussion added successfully';

//notification
$lang['notification_add'] = 'Notification added successfully';
$lang['notification_delete'] = 'Notification deleted successfully';
$lang['notification_id_req'] = 'Notification id required';

//approval
$lang['forward_by_req'] = 'Forwarded by required';
$lang['forward_to_req'] = 'Forwarded to required';

$lang['comments_req'] = 'Comments required';
$lang['approval_frw'] = 'Approval forwarded successfully.';
$lang['approval_approve'] = 'Approval approved successfully.';
$lang['approval_rej'] = 'Approval rejected successfully.';
$lang['user_role_req'] = 'user role required';
$lang['user_role_invalid'] = 'invalid user role';

//crm contact
$lang['contact_id_req'] = 'Contact id required';
$lang['module_id_req'] = 'Module id required';
$lang['contact_update'] = 'Contact updated successfully.';
$lang['contact_type'] = 'Contact Type required';
$lang['contact_add'] = 'Contact added successfully.';
$lang['contact_company_id_req'] = 'Contact id or company id required';
$lang['company_contact_id_req'] = 'Company or contact id required';
$lang['search_key'] = 'Search_key required';
$lang['contact_to_company_add'] = 'Contact added to company successfully.';
$lang['company_to_contcat_add'] = 'Company added to contact successfully.';
$lang['contact_to_project_add'] = 'Contact added to project successfully';
$lang['company_to_project_add'] = 'Company added to project successfully';
$lang['contact_delete'] = 'Contact deleted successfully.';

//crm_company
$lang['crm_company_id'] = 'Crm company id required';
$lang['company_id'] = 'Company id required';
$lang['company_name_req'] = 'Company name required';
$lang['company_name_duplicate'] = 'Company name already exists';
$lang['company_add'] = 'Company added successfully.';
$lang['company_desi_req'] = 'Company designation required';
$lang['company_type_id_req'] = 'Company type id required';
$lang['company_delete'] = 'Company deleted successfully.';
$lang['company_name_req'] = 'Enter company name';
$lang['company_addr_req'] = 'Company address required';
$lang['plan_req'] = 'Plan required';
$lang['country_req'] = 'Country required';
$lang['company_url_duplicate'] = 'Company url already exists';


//crm project
$lang['project_add'] = 'Project added successfully..';
$lang['project_name_req'] = 'project name required';
$lang['project_title_req'] = 'Project title required';
$lang['crm_project_id_req'] = 'Project id required';
$lang['project_description_req'] = 'project description required';
$lang['project_id_req'] = 'Project id required';
$lang['team_member_id_req'] = 'Team member id required';
$lang['team_add'] = 'Team added successfully.';
$lang['team_delete'] = 'Team deleted successfully.';

//covenant module messages
$lang['covenant_company_id_req'] = 'Company id required';
$lang['covenant_type_key_req'] = 'Covenant type key required';
$lang['covenant_type_id_req'] = 'Covenant type id required';
$lang['covenant_sector_req'] = 'Sector required';
$lang['covenant_category_req'] = 'Covenant category required';
$lang['covenant_category_unique'] = 'Category Already exists';
$lang['covenant_category_id_req'] = 'Covenant category required';
$lang['covenant_name_req'] = 'Covenant name required';
$lang['covenant_name_unique'] = 'Covenant Already exists';
$lang['covenant_ids_req'] = 'Covenant id required';
$lang['covenant_category_add'] = 'Category added successfully';
$lang['covenant_category_update'] = 'Category updated successfully';
$lang['covenant_add'] = 'Covenant added successfully';
$lang['covenant_update'] = 'Covenant updated successfully';
$lang['covenant_delete'] = 'Covenant deleted successfully';
$lang['covenant_details_defination_req'] = 'Details defination required';
$lang['covenant_value_req'] = 'Covenant value required';
$lang['covenant_mandatory_req'] = 'Covenant mandatory required';
$lang['frequency_id_req'] = 'Frequency id required';
$lang['notice_days_req'] = 'Notice days required';
$lang['grace_days_req'] = 'Grace days required';
$lang['covenant_tags_req'] = 'Covenant tags required';
$lang['module_covenant_id_req'] = 'Module covenant id required';
$lang['reason_req'] = 'Reason required';
$lang['covenant_task_id_req'] = 'Covenant task id required';
$lang['task_condition_req'] = 'Task condition required';


//application role management messages
$lang['module_id_req'] = 'Module id required';
$lang['application_role_name_req'] = 'Role name required';
$lang['application_role_name_unique'] = 'Role name already exists';
$lang['application_role_name_add'] = 'Role name added successfully.';
$lang['application_role_name_update'] = 'Role name updated successfully.';
$lang['application_role_req'] = 'Application role required.';
$lang['company_approval_role_req'] = 'Company approval role required.';
$lang['application_user_role_update'] = 'Application user role updated successfully.';
$lang['application_user_role_add'] = 'Application user role added successfully.';
$lang['application_user_role_req'] = 'Application user role required';
$lang['application_role_id'] = 'Application role required';
$lang['module_access_update'] = 'Module access updated successfully.';
$lang['application_user_role_del'] = 'Application user role deleted successfully.';
$lang['type_application_user_role_req'] = 'Type required';
$lang['approval_role_application_role_unique'] = 'This approval role assigned to %s';
$lang['user_application_role_unique'] = 'This user assigned to %s';
$lang['module_key_req'] = 'Module key required';


//approval credit committee
$lang['committee_id_req'] = 'Committee id required';
$lang['committee_name_req'] = 'Committee name required';
$lang['committee_name_duplicate'] = 'Committee name already exists';
$lang['id_company_approval_credit_committee_req'] = 'Approval credit committee required';
$lang['approval_struc_req'] = 'Approval structure required';
$lang['pre_approval_struc_req'] = 'Pre approval structure required';
$lang['approval_structure_added'] = 'Approval structure added successfully.';
$lang['approval_structure_update'] = 'Approval structure updated successfully.';
$lang['pre_approval_structure_for_product'] = 'Please select pre approval structure for product';
$lang['no_committees'] = 'No committees exists';
$lang['committee_forward_duplicate'] = 'Already @C1@ committee forward to @C2@ committee, do you want to continue?';
$lang['approval_structure_name_req'] = 'Approval structure id name required';
$lang['committee_secretary_req'] = 'Committee secretary required';
$lang['forwarded_to_committee_req'] = 'Forwarded to committee required';
$lang['credit_committee_update'] = 'Credit committee updated successfully.';
$lang['credit_committee_add'] = 'Credit committee added successfully.';
$lang['credit_committee_structure_update'] = 'Credit committee structure updated successfully.';
$lang['credit_committee_structure_add'] = 'Credit committee structure added successfully.';
$lang['approval_limit_delete'] = 'Approval limit deleted successfully..';

//monitoring
$lang['item_order_req'] = 'Item order required';
$lang['item_data_add'] = 'monitoring added successfully.';
$lang['item_data_update'] = 'monitoring updated successfully.';

//product term
$lang['product_name_req'] = 'product name required';
$lang['product_term_id'] = 'Product Term id required';
$lang['product_term_item_id_req'] = 'Product term item id required';
$lang['Product_term_key_req'] = 'Product term key required';

//collateral
$lang['collateral_req'] = 'Collateral required';
$lang['collateral_id_req'] = 'Collateral id required';
$lang['date_req'] = 'Date required';
$lang['due_date_req'] = 'Due date required';
$lang['type_req'] = 'Type required';
$lang['document_req'] = 'Document required';
$lang['suggest_reg'] = 'Suggest required';
$lang['collateral_add'] = 'Collateral added successfully';
$lang['collateral_update'] = 'Collateral updated successfully';
$lang['collateral_type_req'] = 'Collateral type required';
$lang['collateral_stage_id_req'] = 'Collateral stage id required';

//facility
$lang['facility_req'] = 'Facility required';
$lang['facility_id_reg'] = 'Facility id required';
$lang['facility_name_req'] = 'Facility name required';
$lang['loan_amount_req'] = 'Loan amount required';
$lang['loan_amount_invalid'] = 'Invalid loan amount';
$lang['start_date_req'] = 'Start date required';
$lang['maturity_req'] = 'Maturity required';
$lang['maturity_type_req'] = 'Maturity type required';
$lang['interest_rate_req'] = 'Interest rate required';
$lang['interest_rate_invalid'] = 'Invalid interest rate';
$lang['loan_type_req'] = 'Loan type required';
$lang['payment_type_req'] = 'Payment type required';


//touch points
$lang['touch_point_type_req'] = 'Touch point type required';
$lang['module_type_req'] = 'Module type required';
$lang['description_req'] = 'Description required';
$lang['touch_point_add'] = 'Touch point added successfully.';

//product
$lang['product_add'] = 'Product added successfully.';
$lang['product_update'] = 'Product updated successfully.';

//knowledge
$lang['knowledge_document_id_req'] = 'Knowledge document id required';
$lang['document_id_req'] = 'Document id required';
$lang['document_title_req'] = 'Document title required';
$lang['document_type_req'] = 'Document type required';
$lang['document_status_req'] = 'Document status required';
$lang['tags_req'] = 'tags required';
$lang['upload_document'] = 'Please upload document';
$lang['document_update'] = 'Document updated successfully.';
$lang['document_add'] = 'Document added successfully.';
$lang['group_id_req'] = 'group id required';

//finance
$lang['financial_statement_req'] = 'Financial statement required';

//assessment
$lang['question_req'] = 'Question required';
$lang['question_id_req'] = 'Question id required';
$lang['question_type_req'] = 'Question type required';
$lang['question_type_id_req'] = 'Question type id required';
$lang['question_category_id_req'] = 'Question category id required';
$lang['question_category_update'] = 'Question category updated successfully';
$lang['question_category_add'] = 'Question category Added successfully';
$lang['question_option_req'] = 'Question option required';
$lang['question_add'] = 'Question added successfully.';
$lang['assessment_key_req'] = 'Assessment key required';
$lang['assessment_id_req'] = 'Assessment id required';
$lang['assessment_select'] = 'Please select assessments';
$lang['assessment_update'] = 'Assessment updated successfully.';
$lang['assessment_item_id_req'] = 'Assessment item id required';
$lang['step_title_req'] = 'Step title required';
$lang['succ_add'] = 'Added successfully.';
$lang['item_id_req'] = 'item id required';
$lang['succ_delete'] = 'Deleted successfully.';
$lang['crm_reference_id_req'] = 'crm reference id required';
$lang['answer_update'] = 'Answer update successfully.';
$lang['answer_add'] = 'Answer added successfully.';
$lang['assessment_answer_id_req'] = 'assessment answer id required';
$lang['succ_delete'] = 'Deleted successfully.';

//company facility
$lang['company_facility_id_req'] = 'Company facility id required';
$lang['master_id_req'] = 'Master id required';
$lang['company_facility_id_duplicate'] = 'Facility already exists';
$lang['field_section_req'] = 'Field section required';
$lang['facility_type_req'] = 'Facility type required';
$lang['field_name_req'] = 'Field name required';
$lang['time_period_id_req'] = 'Time period id required';
$lang['facility_amount_type_req'] = 'Facility amount type required';
$lang['facility_field_value_req'] = 'Facility field value required';
$lang['facility_name_duplicate'] = 'Facility name already exists';
$lang['facility_field_id'] = 'Facility field id required';
$lang['facility_field_description_req'] = 'Facility field description required';
$lang['company_facility_field_id_req'] = 'Company facility field id required';
$lang['project_facility_amount_req'] = 'Project facility amount required';
$lang['project_facility_usd_amount_req'] = 'Project facility amount in usd required';
$lang['facility_add'] = 'facility added successfully';
$lang['facility_update'] = 'facility updated successfully';
$lang['company_facility_add'] = 'Company facility added successfully';
$lang['company_facility_update'] = 'Company facility updated successfully';
$lang['project_facility_description_req'] = 'Facility Description successfully';
$lang['project_facility_id_req'] = 'Facility id required';
$lang['facility_delete'] = 'Facility deleted successfully';
$lang['project_facility_name_req'] = 'Facility name required';
$lang['contract_id_req'] = 'Contract id required';

//project forms
$lang['project_form_id_req'] = 'Project form required';
$lang['stage_id_req'] = 'Stage id required';
$lang['stage_key_req'] = 'Stage key required';
$lang['form_id_req'] = 'Form id required';
$lang['project_stage_id_req'] = 'Stage id required';
$lang['workflow_phase_id_req'] = 'Workflow phase id required';
$lang['project_stage_info_id_req'] = 'Project Stage info id required';
$lang['project_stage_section_form_id_req'] = 'Project stage section form id required';
$lang['id_workflow_phase_action_req'] = 'Workflow phase action id required';
$lang['workflow_phase_activity_id_req'] = 'Workflow phase activity id required';
$lang['workflow_comments_req'] = 'Workflow comments required';
$lang['action_applied_suc'] = 'Action performed successfully.';
$lang['project_stage_workflow_phase_id_req'] = 'Project stage workflow phase id required';
$lang['supervision_assessment_id_req'] = 'Supervision assessment id required';
$lang['supervision_project_committee_id_req'] = 'Supervision project committee id required';
$lang['disbursement_request_id_req'] = 'Disbursement request id required';
/*$lang['supervision_assessment_add'] = 'Supervision assessment added successfully';
$lang['supervision_assessment_update'] = 'Supervision assessment updated successfully';
$lang['supervision_assessment_delete'] = 'Supervision assessment deleted successfully';
$lang['supervision_assessment_add'] = 'Supervision assessment added successfully';
$lang['supervision_assessment_update'] = 'Supervision assessment updated successfully';
$lang['supervision_assessment_delete'] = 'Supervision assessment deleted successfully';
$lang['supervision_project_committee_add'] = 'Supervision project added successfully';
$lang['supervision_project_committee_update'] = 'Supervision assessment updated successfully';
$lang['supervision_project_committee_delete'] = 'Supervision assessment deleted successfully';*/

//mis upload
$lang['upload_success'] = 'file uploaded successfully';
$lang['invalid_upload'] = 'invalid file format';
$lang['save_success'] = 'saved successfully';
$lang['no_records'] = 'no records found';
$lang['save_failed'] = 'cannot be saved';
$lang['invalid_format'] = 'invalid format';

//versions
$lang['version_create_success'] = 'Version created successfully.';

//notification and mailing message
//$lang['covenant_notification_message'] = 'New {covenant} in {project} is assigned to you by {user} Click {here} for details.';
//$lang['covenant_notification_mail'] = 'Dear {name}, New {covenant} in {project} is assigned to you by {user}. Click {here} for details.';
$lang['covenant_notification_message'] = '{covenant}({frequency}) for {project} is due for action. Click {here} for details.';
$lang['covenant_notification_mail'] = 'Dear {name}, {covenant}({frequency}) for {project} is due for action. Click {here} for details.';
$lang['covenant_notification_subject'] = 'CKMT | New Covenant Notification';

//user registration
$lang['user_registration_subject'] = 'CKMT | Account Information';
$lang['user_registration_mail'] = '<p>Dear {first_name} {last_name}, Welcome to CKMT access your account with below details.</p><p>Email: {email} <br> Password: {password}</p>';

//forget password
$lang['forget_password_subject'] = 'CKMT | Forgot password';
$lang['forget_password_mail'] = '<p>Dear {first_name} {last_name},</p><p>Newly generated password to access your account : <b>{password}</b>. We recommend to change your password after login</p>';

//workflow notification and mail messages
$lang['workflow_notification_message'] = '{project_title} Project in {stage} stage is {action} to you by {assigned_user} from {assigned_user_department} department on {date_time} Date. Click {here} for details.';
$lang['workflow_notification_message1'] = '{project_title} Project in {stage} stage is {action} on {date_time} Date. Click {here} for details.';
$lang['workflow_mail_subject'] = 'CKMT | Project review request for {project_title} Project by {assigned_user}';
$lang['workflow_notification_mail'] = '{project_title} Project in {stage} stage is {action} to you by {assigned_user} from {assigned_user_department} department on {date_time} Date. Click {here} for details.';
$lang['workflow_notification_mail1'] = '{project_title} Project in {stage} stage is {action} to you on {date_time} Date. Click {here} for details.';

//workflow form comments for user
$lang['workflow_form_comments_notification'] = '{project_title} workflow comments are "{comments}" by {comments_by}';
$lang['workflow_form_comments_subject'] = '{project_title} | comments';
$lang['workflow_form_comments_mail'] = '{project_title} workflow comments are "{comments}" by {comments_by}';

//meeting notification and mail
$lang['meeting_notification'] = '{meeting_name} meeting  at {meeting_place} on {meeting_time} for {project_name} project has been scheduled for you. Click {here} for details';
$lang['meeting_notification_modified'] = '{meeting_name} meeting  at {meeting_place} on {meeting_time} for {project_name} project has been modified. Click {here} for details';
$lang['meeting_notification_cancelled'] = '{meeting_name} meeting  at {meeting_place} on {meeting_time} for {project_name} project has been cancelled. Click {here} for details';
$lang['meeting_subject'] = '{project_title} | Meeting';
$lang['meeting_subject_modified'] = '{project_title} | Meeting Modified';
$lang['meeting_subject_cancelled'] = '{project_title} | Meeting Cancelled';
$lang['meeting_mail'] = '<p>Dear {first_name} {last_name},</p><p>{meeting_name} meeting  at {meeting_place} on {meeting_time} in {project_name} project has been scheduled for you. Click {here} for details</p>';
$lang['meeting_mail_modified'] = '<p>Dear {first_name} {last_name},</p><p>{meeting_name} meeting  at {meeting_place} on {meeting_time} in {project_name} project has been modified. Click {here} for details</p>';
$lang['meeting_mail_cancelled'] = '<p>Dear {first_name} {last_name},</p><p>{meeting_name} meeting  at {meeting_place} on {meeting_time} in {project_name} project has been cancelled. Click {here} for details</p>';

//task notification and mail
$lang['task_notification'] = '{task_title} task with due date {date} for {project_name} project has been created for you by {from_user}. Click {here} for details';
$lang['task_subject'] = '{project_title} | Task';
$lang['task_mail'] = '<p>Dear {first_name} {last_name},</p><p>{task_title} task with due date {date} for {project_name} project has been created for you by {from_user}. Click {here} for details</p>';


//company creating mail
$lang['company_creation_subject'] = 'Q-lana Account Created';
$lang['company_creation_mail'] = '<p style="color:#221f60; font-weight:bold">Hey <span style="color:#74a6f9; font-size:16px; font-weight:500">{user_name}</span> Welcome to Q-Lana</p>
                                  <p style="font-size:17px">To Finish setting up your new account, we just need to verify your email address</p>
                                  <p>Your login credentials are</p>
                                  <p>Email: {email}</p>
                                  <p>Password: {password}</p>';

//mail footer
$lang['mail_footer'] = '<p style="color:#8e8e8e; line-height:20px; font-size:10px">This is an automated email, If you are not sure what this is about, you can disregard this message. Have questions? Need help?
                        <a href="javascript:;" style="color:#74a6f9; text-decoration:none">Contact our support team </a> and we’ll get back to you
                        in just a few minutes - promise</p>';

//mis upload
$lang['upload_success'] = 'file uploaded successfully';
$lang['invalid_upload'] = 'invalid file format';
$lang['save_success'] = 'saved successfully';
$lang['no_records'] = 'no records found';
$lang['save_failed'] = 'cannot be saved';
$lang['invalid_format'] = 'invalid format';
