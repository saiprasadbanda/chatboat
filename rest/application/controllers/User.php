<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
//require APPPATH . '/third_party/mailer/mailer.php';

class User extends REST_Controller
{

    public $session_user_info=NULL;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('Emailcomm');
        $this->session_user_info=$this->User_model->check_record('*','user',array('id_user'=>$_SERVER['HTTP_USER']),NULL)[0];
        //$this->load->library('common/form_validator');
    }

    public function check_email_post()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }
        $data = $this->input->post();

        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $emailRules = array(
            'required'=> $this->lang->line('email_req'),
            'valid_email' => $this->lang->line('email_invalid')
        );

        //validating data
        $this->form_validator->add_rules('email_id', $emailRules);
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $result = $this->User_model->check_email($data['email_id']);
        $value = 0;
        if(empty($result)){ $value=1; }
        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>$value);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function loginHistory_get()
    {
        $data = $this->input->get();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_ControllFer::HTTP_OK);
        }
        $result = $this->User_model->getSession($data);
        /*for($ul=0;$ul<count($result);$ul++)
        {
            $ubrowser=$this->getUserBrowser($result[$ul]['client_browser']);
            $result[$ul]['client_browser']='{"browser_name": "'.$ubrowser['name'].' '.$ubrowser['version'].' ","browser_version": "'.$ubrowser['version'].'","os": "'.$ubrowser['platform'].'"}';
        }*/
        $total_records = count($this->User_model->getTotalSession($data));
        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>array('data' =>$result,'total_records' => $total_records) );
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function changePassword_post()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }
        $data = $this->input->post();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $passwordRules               = array(
            'required'=> $this->lang->line('password_req'),
            'min_len-8' => $this->lang->line('password_num_min_len'),
            'max_len-12' => $this->lang->line('password_num_max_len'),
        );
        $confirmPasswordRules        = array(
            'required'=>$this->lang->line('confirm_password_req'),
            'match_field-password'=>$this->lang->line('password_match')
        );

        $req = array(
            'required'=> $this->lang->line('user_id_req')
        );

        if(isset($_POST['requestData']) && DATA_ENCRYPT)
        {
            $aesObj = new AES();
            $data = $aesObj->decrypt($_POST['requestData'],AES_KEY);
            $data = (array) json_decode($data,true);
            $_POST = $data;
        }

        $this->form_validator->add_rules('user_id', $req);
        $this->form_validator->add_rules('oldpassword', array('required'=>$this->lang->line('old_password_req')));
        $this->form_validator->add_rules('password', $passwordRules);
        $this->form_validator->add_rules('cpassword', $confirmPasswordRules);
        $validated = $this->form_validator->validate($data);

        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        if($data['password'] == $data['oldpassword']){
            $result = array('status'=>FALSE,'error'=>array('password'=>$this->lang->line("old_new_password_same")),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $passwordExist=$this->User_model->passwordExist($data);
        if($passwordExist!=1)
        {
            $result = array('status'=>FALSE,'error'=>array('oldpassword'=>$this->lang->line("old_password_not_match")),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $result = $this->User_model->changePassword($data);
        $result = array('status'=>TRUE, 'message' => $this->lang->line('password_changed'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function usersList_get($type)
    {
        if(empty($type)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $data['type'] = $type;
        //validating data
        $this->form_validator->add_rules('type', array('required' => $this->lang->line('type_req')));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $result = $this->User_model->getUsersList($data);
        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function userInfo_get()
    {
        $data = $this->input->get();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        //validating data
        $idRule = array('required'=> $this->lang->line('id_req'));
        $this->form_validator->add_rules('id', $idRule);
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $result = $this->User_model->getUserInfo($data);
        $result->profile_image = getImageUrl($result->profile_image,'profile');

        unset($result->password);
        unset($result->user_status);
        unset($result->updated_date);

        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }
    public function userInfo_post()
    {
       /* $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }*/
        $data = $this->input->post();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $data = $data['user'];
        $firstNameRules               = array(
            'required'=> $this->lang->line('first_name_req'),
            'max_len-100' => $this->lang->line('first_name_len'),
        );

        $lastNameRules               = array(
            'required'=> $this->lang->line('last_name_req'),
            'max_len-100' => $this->lang->line('last_name_len'),
        );
        $emailRules = array(
            'required'=> $this->lang->line('email_req'),
            'valid_email' => $this->lang->line('email_invalid')
        );
        $passwordRules  = array(
            'required'=> $this->lang->line('password_req')
        );
        $phoneRules  = array(
            'required' => $this->lang->line('phone_num_req'),
            /*'numeric' =>  $this->lang->line('phone_num_num'),*/
            'min_len-7' => $this->lang->line('phone_num_min_len'),
            'max_len-25' => $this->lang->line('phone_num_max_len_20'),
        );

        $this->form_validator->add_rules('first_name', $firstNameRules);
        $this->form_validator->add_rules('last_name', $lastNameRules);
        //$this->form_validator->add_rules('email_id', $emailRules);
        //$this->form_validator->add_rules('password', $passwordRules);
        $this->form_validator->add_rules('phone_number', $phoneRules);
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        /*$email_check = $this->User_model->check_email($data['email_id']);
        if(!empty($email_check)){
            $result = array('status'=>FALSE,'error'=>array('email_id' => $this->lang->line('email_duplicate')),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $result = $this->User_model->createUserInfo($data);

        sendmail($data['email_id'],'Q-lana Account Created','<p>welcome to q-lana,</p><p>hello, '.$data["email_id"].'</p>');*/

        if(!file_exists('uploads/'.$data['company_id'])){
            mkdir('uploads/'.$data['company_id']);
        }

        $path='uploads/';
        if(isset($_FILES) && !empty($_FILES['file']['name']['profile_image']))
        {
            $imageName = doUpload($_FILES['file']['tmp_name']['profile_image'],$_FILES['file']['name']['profile_image'],$path,$data['company_id'],'image');

            $data['profile_image'] = $imageName;
        }
        else{
            unset($data['profile_image']);
        }
        //echo "<pre>"; print_r($data); exit;
        $user_data = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country_id' => $data['country_id'],
            'zip_code' => $data['zip_code'],
        );
        if(isset($data['profile_image'])){
            $user_data['profile_image'] = $data['profile_image'];
        }

        $result = $this->User_model->updateUserData($user_data,$data['id_user']);
        $result = array('status'=>TRUE, 'message' => $this->lang->line('user_add'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function userInfo_put()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }
        $data = $this->input->post();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $firstNameRules               = array(
            'required'=> $this->lang->line('first_name_req'),
            'max_len-100' => $this->lang->line('first_name_len'),
        );
        $lastNameRules               = array(
            'required'=> $this->lang->line('last_name_req'),
            'max_len-100' => $this->lang->line('last_name_len'),
        );
        $phoneRules  = array(
            'required'=> $this->lang->line('phone_num_req'),
            'numeric'=>  $this->lang->line('phone_num_num'),
            'min_len-7' => $this->lang->line('phone_num_min_len'),
            'max_len-10' => $this->lang->line('phone_num_max_len'),
        );

        $this->form_validator->add_rules('first_name', $firstNameRules);
        $this->form_validator->add_rules('last_name', $lastNameRules);
        $this->form_validator->add_rules('phone_number', $phoneRules);
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $result = $this->User_model->updateUserInfo($data);
        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function userInfo_delete()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }
        $data = $this->input->post();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $result = $this->User_model->deleteUser($data);
        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function logout_post()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }
        $data = $this->input->post();
        $previous_session = $this->User_model->getPreviousUserSessions(array('user_id' => $_SERVER['HTTP_USER'],'access_token' => str_replace('Bearer ','',$_SERVER['HTTP_AUTHORIZATION'])));
        if(!empty($previous_session)){
            for($sr=0;$sr<count($previous_session);$sr++)
            {
                $this->User_model->updateOauthAccessToken(array('id' => $previous_session[$sr]['access_token_id'],'expire_time' => '-'.$previous_session[$sr]['expire_time'],'updated_at' => currentDate(),'expired_date_time' => currentDate()));
            }
        }
        $result = array('status'=>TRUE, 'message' => 'You have Logged out.', 'data'=>[]);
        $this->response($result, REST_Controller::HTTP_OK);
    }
    public function saveSecurityQuestion_post()
    {
        $data = $this->input->post();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $passwordRules               = array(
            'required'=> $this->lang->line('password_req'),
            'min_len-6' => $this->lang->line('password_num_min_len'),
            'max_len-12' => $this->lang->line('password_num_max_len'),
        );
        $confirmPasswordRules        = array(
            'required'=>$this->lang->line('confirm_password_req'),
            'match_field-password'=>$this->lang->line('password_match')
        );
        $req = array(
            'required'=> $this->lang->line('user_id_req')
        );
        $questionsRules               = array(
            'required'=> $this->lang->line('first_name_req'),
        );

        $ansRules               = array(
            'required'=> $this->lang->line('last_name_req'),
        );

        $this->form_validator->add_rules('user_id', $req);
        $this->form_validator->add_rules('oldpassword', array('required'=>$this->lang->line('old_password_req')));
        $this->form_validator->add_rules('password', $passwordRules);
        $this->form_validator->add_rules('cpassword', $confirmPasswordRules);
        $this->form_validator->add_rules('questions', $questionsRules);
        $this->form_validator->add_rules('ans', $ansRules);
        $validated = $this->form_validator->validate($data);

        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        if($data['password'] == $data['oldpassword']){
            $result = array('status'=>FALSE,'error'=>array('password'=>$this->lang->line("old_new_password_same")),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $passwordExist=$this->User_model->passwordExist($data);
        if($passwordExist!=1)
        {
            $result = array('status'=>FALSE,'error'=>array('oldpassword'=>$this->lang->line("old_password_not_match")),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $question_data = array('security_question_id' => $data['questions'], 'security_question_ans' => $data['ans'],);
        $this->User_model->saveSecurityQuestion($question_data,$data['user_id']);
        $user_data = array(
            'password' => $data['password'],
            'user_id' => $data['user_id'],
        );
        $result = $this->User_model->changePassword($user_data);

        $result = array('status'=>TRUE, 'message' => $this->lang->line('user_update'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function updateSecurityQuestion_post()
    {
        $data = $this->input->post();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $req = array(
            'required'=> $this->lang->line('user_id_req')
        );
        $questionsRules               = array(
            'required'=> $this->lang->line('first_name_req'),
        );

        $ansRules               = array(
            'required'=> $this->lang->line('last_name_req'),
        );

        $this->form_validator->add_rules('id_user', $req);
        $this->form_validator->add_rules('security_question_id', $questionsRules);
        $this->form_validator->add_rules('security_question_ans', $ansRules);
        $validated = $this->form_validator->validate($data);

        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $question_data = array('security_question_id' => $data['security_question_id'], 'security_question_ans' => $data['security_question_ans'],);
        $result = $this->User_model->saveSecurityQuestion($question_data,$data['id_user']);

        $result = array('status'=>TRUE, 'message' => $this->lang->line('security_updated'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function userLogByType_get()
    {
        $data = $this->input->get();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $result = $this->User_model->getUserLogByType($data);
        /*for($ul=0;$ul<count($result['user_log']);$ul++)
        {
            $ubrowser=$this->getUserBrowser($result['user_log'][$ul]->client_browser);
            $result['user_log'][$ul]->client_browser='{"browser_name": "'.$ubrowser['name'].' '.$ubrowser['version'].' ","browser_version": "'.$ubrowser['version'].'","os": "'.$ubrowser['platform'].'"}';
        }*/
        $total_records = count($result['user_log']);
        /*$result = $this->lang->line('success'), 'data'=>array('data' =>$result,'total_records' => $total_records);*/
        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>array('data' =>$result['user_log'],'total_records' => $total_records, 'user_details'=> $result['user_details']));
        $this->response($result, REST_Controller::HTTP_OK);
    }   
    ////////////////Second openion code starts here///////////////////

    public function getCategories_get(){
        // Get Categories
        // id (or) search_key
        $data = $this->input->get();
        if(isset($data["id"]))
            $result = $this->User_model->check_record('id,name','categories',array('id'=>$data["id"]),null);
        else if(isset($data["search_key"]))
            $result = $this->User_model->check_record('id,name','categories','name like "%'.$data["search_key"].'%"',null);
        else
            $result = $this->User_model->check_record('id,name','categories',null,null);
        
        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);        
    }

    public function postCategories_post(){
        //Post Categories
        // category_name
        // (or)
        // category_name & id
        // (or)
        // id & is_delete

        $data = $this->input->post();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        if(isset($data['is_delete'])){
            if($data['is_delete']){
                $this->form_validator->add_rules('id', array('required'=>'Category id Required'));
                $validated = $this->form_validator->validate($data);
                if($validated != 1)
                {
                    $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
                    $this->response($result, REST_Controller::HTTP_OK);
                }
                $this->User_model->delete_data('categories',array('id'=>$data["id"]));
                $result = array('status'=>TRUE, 'message' => 'Category Deleted.', 'data'=>[]);
            }else{
                $result = array('status'=>FALSE, 'message' => 'Operation Failed.', 'data'=>[]);
            }
            $this->response($result, REST_Controller::HTTP_OK);

        }else if(isset($data["id"])){
            $this->form_validator->add_rules('category_name', array('required'=>'Category name Required'));
            $this->form_validator->add_rules('id', array('required'=>'Category id Required'));
            $validated = $this->form_validator->validate($data);
            if($validated != 1)
            {
                $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
                $this->response($result, REST_Controller::HTTP_OK);
            }
            $update_result = $this->User_model->update_data('categories',array('name'=>$data['category_name'],'added_date'=>currentDate()),array('id'=>$data["id"]));
            if($update_result)
                $result = array('status'=>TRUE, 'message' => 'Category Updated.', 'data'=>[]);
            else
                $result = array('status'=>FALSE, 'message' => 'Operation Failed.', 'data'=>[]);

            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $this->form_validator->add_rules('category_name', array('required'=>'Category name Required'));
            $validated = $this->form_validator->validate($data);
            if($validated != 1)
            {
                $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
                $this->response($result, REST_Controller::HTTP_OK);
            }
            $check_exists = $this->User_model->check_record('*','categories',array('name'=>$data['category_name']),null);
            if(count($check_exists)>0){
                $result = array('status'=>FALSE, 'message' => 'Category already exixts', 'data'=>[]);
                $this->response($result, REST_Controller::HTTP_OK);
            }
            $insert_id = $this->User_model->insert_data('categories',array('name'=>$data['category_name'],'added_date'=>currentDate()));
            if($insert_id>0)
                $result = array('status'=>TRUE, 'message' => 'New Category Added.', 'data'=>[]);
            else
                $result = array('status'=>FALSE, 'message' => 'Operation Failed.', 'data'=>[]);

            $this->response($result, REST_Controller::HTTP_OK);
        }

    }

    public function getSymptoms_get(){
        // Get Symptoms
        // id (or) search_key
        $data = $this->input->get();
        if(isset($data["id"]))
            $result = $this->User_model->check_record('id,name,category','symps',array('id'=>$data["id"]),null);
        else if(isset($data["search_key"]))
            $result = $this->User_model->check_record('id,name,category','symps','name like "%'.$data["search_key"].'%"',null);
        else
            $result = $this->User_model->check_record('id,name,category','symps',null,null);
        
        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);        
    }

    public function postSymptoms_post(){
        //Post Symptoms
        // symptoms & category_id
        // (or)
        // symptoms & category_id & id
        // (or)
        // id & is_delete
        
        $data = $this->input->post();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        if(isset($data['is_delete'])){
            if($data['is_delete']){
                $this->form_validator->add_rules('id', array('required'=>'Symptom id Required'));
                $validated = $this->form_validator->validate($data);
                if($validated != 1)
                {
                    $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
                    $this->response($result, REST_Controller::HTTP_OK);
                }
                $this->User_model->delete_data('symps',array('id'=>$data["id"]));
                $result = array('status'=>TRUE, 'message' => 'Symptom Deleted.', 'data'=>[]);
            }else{
                $result = array('status'=>FALSE, 'message' => 'Operation Failed.', 'data'=>[]);
            }
            $this->response($result, REST_Controller::HTTP_OK);

        }else if(isset($data["id"])){
            $this->form_validator->add_rules('category_id', array('required'=>'Category id Required'));
            $this->form_validator->add_rules('symptoms', array('required'=>'Symptoms Required'));
            $this->form_validator->add_rules('id', array('required'=>'Symptoms id Required'));
            $validated = $this->form_validator->validate($data);
            if($validated != 1)
            {
                $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
                $this->response($result, REST_Controller::HTTP_OK);
            }
            $update_result = $this->User_model->update_data('symps',array('name'=>$data['symptoms'],'category'=>$data['category_id']),array('id'=>$data["id"]));
            if($update_result)
                $result = array('status'=>TRUE, 'message' => 'Symptoms Updated.', 'data'=>[]);
            else
                $result = array('status'=>FALSE, 'message' => 'Operation Failed.', 'data'=>[]);

            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $this->form_validator->add_rules('category_id', array('required'=>'Category id Required'));
            $this->form_validator->add_rules('symptoms', array('required'=>'Symptoms Required'));
            $validated = $this->form_validator->validate($data);
            if($validated != 1)
            {
                $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
                $this->response($result, REST_Controller::HTTP_OK);
            }
            $insert_id = $this->User_model->insert_data('symps',array('name'=>$data['symptoms'],'category'=>$data['category_id']));
            if($insert_id>0)
                $result = array('status'=>TRUE, 'message' => 'New Symptom Added.', 'data'=>[]);
            else
                $result = array('status'=>FALSE, 'message' => 'Operation Failed.', 'data'=>[]);

            $this->response($result, REST_Controller::HTTP_OK);
        }

    }

    public function getAlerts_get(){
        $data = $this->input->get();
        $this->form_validator->add_rules('page_no', array('required'=>'Page no. Required'));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        if((int)$data['page_no']>1)
            $data['page_no'] = ((int)$data['page_no'] - 1)*10;
        else
            $data['page_no'] = 0;

            
        if($this->session_user_info['user_role_id']==2)
            $data['doctor_id'] = $this->session_user_info['id_user'];

        $result = $this->User_model->getAlerts($data);

        $result = array('status'=>TRUE, 'message' => 'Success', 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function getPayments_get(){
        $data = $this->input->get();
        $this->form_validator->add_rules('page_no', array('required'=>'Page no. Required'));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        if((int)$data['page_no']>1)
            $data['page_no'] = ((int)$data['page_no'] - 1)*10;
        else
            $data['page_no'] = 0;
        //echo '<pre>'.print_r($data);exit;
        if($this->session_user_info['user_role_id']==2)
            $data['doctor_id'] = $this->session_user_info['id_user'];
        $result = $this->User_model->getPayments($data);

        $result = array('status'=>TRUE, 'message' => 'Success', 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function getAppointments_get(){
        $data = $this->input->get();
        $this->form_validator->add_rules('page_no', array('required'=>'Page no. Required'));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        if((int)$data['page_no']>1)
            $data['page_no'] = ((int)$data['page_no'] - 1)*10;
        else
            $data['page_no'] = 0;
        //echo '<pre>'.print_r($data);exit;

        if($this->session_user_info['user_role_id']==2)
            $data['doctor_id'] = $this->session_user_info['id_user'];

        $result = $this->User_model->getAppointments($data);

        $result = array('status'=>TRUE, 'message' => 'Success', 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function changepwd_post(){
        $data = $this->input->post();
        $this->form_validator->add_rules('owd_pwd', array('required'=>'Old password Required'));
        $this->form_validator->add_rules('new_pwd', array('required'=>'New password Required'));
        $this->form_validator->add_rules('confirm_pwd', array('required'=>'Confirm password Required'));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        if($data['new_pwd'] == $data['owd_pwd']){
            $result = array('status'=>FALSE,'error'=>array('password'=>'Old password & New password should not be same.'),'data'=>[]);
            $this->response($result, REST_Controller::HTTP_OK);
        }
        if($data['new_pwd'] != $data['confirm_pwd']){
            $result = array('status'=>FALSE,'error'=>array('password'=>'New password & confirm password doesn\'t match.'),'data'=>[]);
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $old_pwd = $this->User_model->check_record('*','user','id_user ='.$_SERVER["HTTP_USER"].' and password= md5('.$data["owd_pwd"].')',null);
        //echo $this->db->last_query();exit;
        if(empty($old_pwd)){
            $result = array('status'=>FALSE,'error'=>array('password'=>'Old password is incorrect.'),'data'=>[]);
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $result = $this->User_model->changePassword(array('user_id'=>$_SERVER["HTTP_USER"],'password'=>$data['new_pwd']));
        if($old_pwd[0]['user_role_id']==1)
            $this->User_model->update_data('admin',array('password'=>md5($data['new_pwd'])),array('email'=>$old_pwd[0]['email_id']));
        else if($old_pwd[0]['user_role_id']==2)
            $this->User_model->update_data('doctors',array('password'=>md5($data['new_pwd'])),array('user_name'=>$old_pwd[0]['email_id']));
        $result = array('status'=>TRUE, 'message' => $this->lang->line('password_changed'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);

    }

    public function getDashboard_get(){
        //$this->session_user_info['user_role_id']=2;
        if($this->session_user_info['user_role_id']==2)
            $data['doctor_id'] = $this->session_user_info['id_user'];
        
        $data['page_no'] = 0;
        $all_appointments = $this->User_model->getAppointments($data);

        $data['select'] = ',sum(d.con_fee) as all_payment';
        $all_payments = $this->User_model->getAppointments($data);

        $data['show_today'] = true;
        $today_appointments = $this->User_model->getAppointments($data);

        $all_doctors = $this->User_model->check_record('*','doctors',null,null);

        if($this->session_user_info['user_role_id']==2)
            $result = array('today_payments'=>isset($today_appointments['data'][0])?$today_appointments['data'][0]['all_payment']:"0",'today_appointments'=>$today_appointments['total_records'],'all_payments'=>isset($all_payments['data'][0])?$all_payments['data'][0]['all_payment']:"0",'all_appointments'=>$all_appointments['total_records']);
        else
            $result = array('all_doctors'=>count($all_doctors),'today_appointments'=>$today_appointments['total_records'],'all_payments'=>isset($all_payments['data'][0])?$all_payments['data'][0]['all_payment']:"0",'all_appointments'=>$all_appointments['total_records']);
        
        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>$result);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function export_get(){
        $data = $this->input->get();

        $this->form_validator->add_rules('start_date', array('required'=>'New password Required'));
        $this->form_validator->add_rules('end_date', array('required'=>'Confirm password Required'));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $result = $this->User_model->getExportData($data);
        //echo $this->db->last_query();exit;
        
        $data[] = array('x'=> $x, 'y'=> $y, 'z'=> $z, 'a'=> $a);
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"test".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('../assets/csv/export_'.date("Y-m-d").'.csv', 'w') or die("can't open file");;

        $header = array("Doctor Name","Category Name","Patient Name","Amount","mrnum","mobile","email","age","Booking date");

        fputcsv($handle, $header);
        foreach ($result as $key => $val) {
            fputcsv($handle, $val);
        }
            fclose($handle);

        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>BASE_URL.'assets/csv/export_'.date("Y-m-d").'.csv');
        $this->response($result, REST_Controller::HTTP_OK);
        
    }

    public function getReport_get(){
        $data = $this->input->get();
        $this->form_validator->add_rules('patient_id', array('required'=>'Patient id required'));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $patient_data = $this->User_model->check_record('*','patients',array('pid'=>$data['patient_id']),null);

        foreach($patient_data as $k => $v){
            //$patient_data[$k]['pdf'] = BASE_URL.'assets/uploads/pdf/'.$v['pdf'];
            //$patient_data[$k]['video'] = BASE_URL.'assets/uploads/video/'.$v['video'];
            
            $ifiles = explode(',',$patient_data[$k]['image']);
            $patient_data[$k]['image_files'] = array();
            foreach($ifiles as $k1 => $v1){
                if($v1 != '')
                    $patient_data[$k]['image_files'][$k1] = BASE_URL.'assets/uploads/images/'.$v1;
            }
                
            $dicom = explode(',',$patient_data[$k]['dicom']);
            $patient_data[$k]['dicom_files'] = array();
            foreach($dicom as $k2 => $v2){
                if($v2 != '')
                    $patient_data[$k]['dicom_files'][$k2] = BASE_URL.'assets/uploads/dicom/'.$v2;
            }

            $videos = explode(',',$patient_data[$k]['video']);
            $patient_data[$k]['video_files'] = array();
            foreach($videos as $k2 => $v2){
                if($v2 != '')
                    $patient_data[$k]['video_files'][$k2] = BASE_URL.'assets/uploads/video/'.$v2;
            }

            $pdfs = explode(',',$patient_data[$k]['pdf']);
            $patient_data[$k]['pdf_files'] = array();
            foreach($pdfs as $k2 => $v2){
                if($v2 != '')
                    $patient_data[$k]['pdf_files'][$k2] = BASE_URL.'assets/uploads/pdf/'.$v2;
            }

            $patient_data[$k]['symptoms'] = $this->User_model->check_record('name','symps',null,array('field'=>'id','data'=>explode(",",$patient_data[$k]['symptoms'])));
            //echo '<pre>'.print_r($patient_data[$k]['symptoms']);exit;
            $patient_data[$k]['symptoms'] = array_map(function ($i) { return $i['name']; }, $patient_data[$k]['symptoms']);
        }

        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>$patient_data);
        $this->response($result, REST_Controller::HTTP_OK);

    }

    // public function updateReport_post(){
        
    // }
    
    public function addDoctor_post(){

        $data = $this->input->post();
        $this->form_validator->add_rules('name', array('required'=>'Doctor name required'));
        $this->form_validator->add_rules('mobile', array('required'=>'Mobile is  required'));
        $this->form_validator->add_rules('category', array('required'=>'Category id required'));
        $this->form_validator->add_rules('con_fee', array('required'=>'Consultant free required'));
        $this->form_validator->add_rules('med_degree', array('required'=>'Medical degree required'));
        $this->form_validator->add_rules('email', array('required'=>'Email id required'));
        $this->form_validator->add_rules('area_of_exp', array('required'=>'Area of experience required'));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $ins=array(
            'name'=>$data['name'],
            'user_name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'category'=>$data['category'],
            'con_fee'=>$data['con_fee'],
            'med_degree'=>$data['med_degree'],
            'email'=>$data['email'],
            'area_exp'=>$data['area_of_exp'],
            'dob'=>isset($data['date_of_birth'])?$data['date_of_birth']:'',
            'bio'=>isset($data['bio'])?$data['bio']:'',
            'services'=>isset($data['services'])?$data['services']:'',
            'education'=>isset($data['education'])?$data['education']:'',
            'specialization'=>isset($data['specialization'])?$data['specialization']:'',
            'awards'=>isset($data['awards'])?$data['awards']:'',
            'publications'=>isset($data['publications'])?$data['publications']:'',
            'gender'=>isset($data['gender'])?$data['gender']:'',
            'address'=>isset($data['address'])?$data['address']:'',
            'location'=>isset($data['location'])?$data['location']:'',
            'yexp'=>isset($data['years_exp'])?$data['years_exp']:'',
            'status'=>1,
            'password'=>md5(123456),
            'added_date'=>date('Y-m-d'),
            'added_by'=>$_SERVER['HTTP_USER']
        );

        $path='../assets/uploads/profile_pics/';
        $file=time().'_'.$_FILES['profile_image']['name'];
        if(move_uploaded_file($_FILES['profile_image']['tmp_name'],$path.$file))
        {
            $ins['pic']=$file;
        }

        $ins_id = $this->User_model->insert_data('doctors',$ins);
        $this->User_model->update_data('doctors',array('user_name'=>'SODR'.$ins_id),array('did'=>$ins_id));

        $doctor_data = $this->User_model->check_record('*','doctors',array('did'=>$ins_id),null);
        if(count($doctor_data) > 0){
            $data['doc']=$doctor_data;
		    $msg=$this->load->view('admin/doctors_email',$data,TRUE); 
           
           //$this->emailcomm->forgot_pass($info);
           sendemail($data['email'],'Login Credentials',$msg);

            $username='sms@secondopinion.co.in';   
            $hash='dee58de3a5412fd1f61fd512e15ed7d1ece6fc9e'; 
            

            // Message details  
            if($doctor_data[0]['mobile'])
            {
                $numbers = array($doctor_data[0]['mobile']); 
                $sender = urlencode('SECOPI');    
                $message = urlencode('Dear Doctor ,Here is your secondopinion login credentials Username : '.$doctor_data[0]['user_name'].' and password : 123456  and Login Link : '.BASE_URL.'doctor  .Thank you From  www.secondopinion.co.in');  
                $numbers=implode(',',$numbers);   
                // Prepare data for POST request
                $data = array('username'=>$username,'hash'=>$hash,'numbers'=>$numbers,'sender'=>$sender,'message'=>$message);
                // Send the POST request with cURL
                $ch = curl_init('http://sms.beeravolutech.com/api2/send/');  
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
                $response = curl_exec($ch);
                //echo $response; 
                curl_close($ch); 
            
            }	

        }
        $result = array('status'=>TRUE, 'message' => 'Doctor Created successfully.', 'data'=>[]);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function updateDoctor_post(){
        $data = $this->input->post();
        $this->form_validator->add_rules('did', array('required'=>'Doctor id required'));
        $this->form_validator->add_rules('name', array('required'=>'Doctor name required'));
        $this->form_validator->add_rules('mobile', array('required'=>'Mobile is  required'));
        $this->form_validator->add_rules('category', array('required'=>'Category id required'));
        $this->form_validator->add_rules('con_fee', array('required'=>'Consultant free required'));
        $this->form_validator->add_rules('med_degree', array('required'=>'Medical degree required'));
        $this->form_validator->add_rules('email', array('required'=>'Email id required'));
        $this->form_validator->add_rules('area_of_exp', array('required'=>'Area of experience required'));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $update=array(
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'category'=>$data['category'],
            'con_fee'=>$data['con_fee'],
            'med_degree'=>$data['med_degree'],
            'email'=>$data['email'],
            'area_exp'=>$data['area_of_exp'],
            'dob'=>isset($data['date_of_birth'])?$data['date_of_birth']:'',
            'bio'=>isset($data['bio'])?$data['bio']:'',
            'services'=>isset($data['services'])?$data['services']:'',
            'education'=>isset($data['education'])?$data['education']:'',
            'specialization'=>isset($data['specialization'])?$data['specialization']:'',
            'awards'=>isset($data['awards'])?$data['awards']:'',
            'publications'=>isset($data['publications'])?$data['publications']:'',
            'gender'=>isset($data['gender'])?$data['gender']:'',
            'address'=>isset($data['address'])?$data['address']:'',
            'location'=>isset($data['location'])?$data['location']:'',
            'yexp'=>isset($data['years_exp'])?$data['years_exp']:'',
            'status'=>1
        );

        if(isset($_FILES)){
            $path='../assets/uploads/profile_pics/';
            $file=time().'_'.$_FILES['profile_image']['name'];
            if(move_uploaded_file($_FILES['profile_image']['tmp_name'],$path.$file))
            {
                $update['pic']=$file;
            }
        }

        if($this->User_model->update_data('doctors',$update,array('did'=>$data['did'])))
            $result = array('status'=>TRUE, 'message' => 'Doctor Updated successfully.', 'data'=>[]);
        else
            $result = array('status'=>FALSE, 'message' => 'Operation failed.', 'data'=>[]);
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function updateDoctorStatus_post(){
        $data = $this->input->post();
        $this->form_validator->add_rules('did', array('required'=>'Doctor id required'));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }

        $result = array('status'=>TRUE, 'message' => 'Success', 'data'=>[]);

        if(isset($data['is_delete'])){
            if($data['is_delete']){
                if($this->User_model->update_data('doctors',array('status'=>2),array('did'=>$data['did'])))
                    $result = array('status'=>TRUE, 'message' => 'Doctor Deleted successfully.', 'data'=>[]);
                else
                    $result = array('status'=>FALSE, 'message' => 'Operation failed.', 'data'=>[]);
            }
        }
        else if(isset($data['status'])){
            if($this->User_model->update_data('doctors',array('status'=>$data['status']),array('did'=>$data['did'])))
                $result = array('status'=>TRUE, 'message' => 'Doctor Updated successfully.', 'data'=>[]);
            else
                $result = array('status'=>FALSE, 'message' => 'Operation failed.', 'data'=>[]);
        }
        $this->response($result, REST_Controller::HTTP_OK);
    }

    public function bookAppointment_post(){
        $data = $this->input->post();
        //echo '<pre>'.print_r($_FILES);exit;
        $file_error = false;
        foreach($_FILES['video']['error'] as $v){
            if($v){
                $file_error = true;
                break;
            }
        }
        if($file_error){
            $result = array('status'=>FALSE,'error'=>array('file_type'=>'Incorrect video format'),'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $this->form_validator->add_rules('patient_name', array('required'=>'patient_name required'));
        $this->form_validator->add_rules('patient_age', array('required'=>'patient_age required'));
        $this->form_validator->add_rules('email', array('required'=>'email required'));
        $this->form_validator->add_rules('city', array('required'=>'city required'));
        $this->form_validator->add_rules('state', array('required'=>'state required'));
        $this->form_validator->add_rules('country', array('required'=>'country required'));
        $this->form_validator->add_rules('phone', array('required'=>'phone required'));
        $this->form_validator->add_rules('gender', array('required'=>'gender required'));
        $this->form_validator->add_rules('address', array('required'=>'address required'));
        $this->form_validator->add_rules('doctor_id', array('required'=>'doctor id required'));
        $this->form_validator->add_rules('agree', array('required'=>'Accept T&C required'));
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            $this->response($result, REST_Controller::HTTP_OK);
        }
        $sym=(count($data['symp'])>0)?implode(',',$data['symp']):'';
            $ins=array(
                'name'=>$data['patient_name'],
                'age'=>$data['patient_age'],
                'email'=>$data['email'],
                'city'=>$data['city'],
                'state'=>$data['state'],
                'country'=>$data['country'],
                'mobile'=>$data['phone'], 
                'gender'=>$data['gender'],
                'address'=>$data['address'],
                'bp'=>isset($data['bp'])?$data['bp']:'',
                'pulse_rate'=>isset($data['pulse_rate'])?$data['pulse_rate']:'',
                'wt'=>isset($data['weight'])?$data['weight']:'',
                'ht'=>isset($data['height'])?$data['height']:'',
                'med_conditio'=>isset($data['med_condition'])?$data['med_condition']:'',
                'sur_history'=>isset($data['sur_history'])?$data['sur_history']:'',
                'agree'=>isset($data['agree'])?$data['agree']:0,
                'assigned_to'=>isset($data['doctor_id'])?$data['doctor_id']:0,
                'symptoms'=>isset($sym)?$sym:'',
                "postdicom_patient_order_uid" => isset($data["dicomFolderUuid"])?$data["dicomFolderUuid"]:'',
                "postdicom_foldername" => isset($data["dicomFolderUuid"])?$data["dicomFolderUuid"]:'',
                'dropbox_link'=>isset($data['drop_link'])?$data['drop_link']:'',
                'status'=>1,
                'mrnum'=>0,
                'added_date'=>date('Y-m-d H:i:s')
            );

        if(isset($_FILES)){
            $fields = array('image','dicom','pdf','video');
            foreach($fields as $v1){
                $path='../assets/uploads/'.$v1.'/';
                if($v1 == 'image')//Due to missmatch folder names as field names in Table
                    $path='../assets/uploads/images/';
                if(isset($_FILES[$v1]['name'])){
                    $ins[$v1] = '';
                    if(is_array($_FILES[$v1]['name'])){
                        foreach($_FILES[$v1]['name'] as $k => $v){
                            $file=time().'_'.$k.$_FILES[$v1]['name'][$k];                            
                            if(move_uploaded_file($_FILES[$v1]['tmp_name'][$k],$path.$file))
                            {
                                $ins[$v1] .= $file.',';
                            }
                        }
                        $ins[$v1] = rtrim($ins[$v1],",");
                    }else{
                        $file=time().'_'.$_FILES[$v1]['name'];
                        if(move_uploaded_file($_FILES[$v1]['tmp_name'],$path.$file))
                        {
                            $ins[$v1] .= $file;
                        }
                    }
                }
            }            
        }
        $patient_id = $this->User_model->insert_data('patients',$ins);
        $this->User_model->update_data('patients',array('mrnum'=>'SOPID'.$patient_id),array('pid'=>$patient_id));
        
        $alert=array(
            'alert'=>'Registration',
            'description'=>'New Patient registered',
            'doctor_id'=>$data['doctor_id'],
            'patient_id'=>$patient_id, 
            'added_date'=>date('Y-m-d H:i:s'),
            );
        $this->User_model->insert_data('alerts',$alert);
        $data['doc']=$this->User_model->check_record('*','doctors',array('did'=>$data['doctor_id']),null);
		$data['pat']=$this->User_model->check_record('*','patients',array('pid'=>$patient_id),null);
        $doct=$data['doc'];

        if(count($data['doc']) > 0 && count($data['pat']) > 0 ){
            $msg=$this->load->view('reg_email',$data,TRUE); 
            //Email
            sendemail($data['email'],'New Registration',$msg);

            $username='sms@secondopinion.co.in';   
            $hash='dee58de3a5412fd1f61fd512e15ed7d1ece6fc9e'; 
            
            //sms to customer
            // Message details   
            $numbers = array($data['pat'][0]['mobile']); 
            $sender = urlencode('SECOPI');    
            $message = urlencode('Dear Customer, we have recieved your request.you are selected doctor '.$data['doc'][0]['name'].' .we will provide our opinion in 24 hrs through email.thank you From  www.secondopinion.co.in');  
            $numbers=implode(',',$numbers);   
            // Prepare data for POST request
            $data = array('username'=>$username,'hash'=>$hash,'numbers'=>$numbers,'sender'=>$sender,'message'=>$message);
            // Send the POST request with cURL
            $ch = curl_init('http://sms.beeravolutech.com/api2/send/');  
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
            $response = curl_exec($ch); 
                //echo $response; 
            curl_close($ch); 
            
            //sms to doctor
            // Message details   
            $numbers = array($doct[0]['mobile']);  
            $sender = urlencode('SECOPI');    
            $message = urlencode('Dear Doctor, New patient registered.Please look into the patient record and provide your opinion.thank you From  www.secondopinion.co.in');  
            $numbers=implode(',',$numbers);   
            // Prepare data for POST request
            $data = array('username'=>$username,'hash'=>$hash,'numbers'=>$numbers,'sender'=>$sender,'message'=>$message);
            // Send the POST request with cURL
            $ch = curl_init('http://sms.beeravolutech.com/api2/send/');  
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
            $response = curl_exec($ch); 
                //echo $response; 
            curl_close($ch);
            
            
            //sms to admin
            // Message details   
            $numbers = array(6303626874);  //6303626874
            $sender = urlencode('SECOPI');    
            $message = urlencode('Dear Admin, New patient registered.Please follow up the doctor('.$doct[0]['name'].') to look into the patient record and provide  opinion.thank you From  www.secondopinion.co.in');  
            $numbers=implode(',',$numbers);   
            // Prepare data for POST request
            $data = array('username'=>$username,'hash'=>$hash,'numbers'=>$numbers,'sender'=>$sender,'message'=>$message);
            // Send the POST request with cURL
            $ch = curl_init('http://sms.beeravolutech.com/api2/send/');  
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
            $response = curl_exec($ch); 
                //echo $response; 
            curl_close($ch);
        }

        $result = array('status'=>TRUE, 'message' => 'Patient Created successfully.', 'data'=>[]);
        $this->response($result, REST_Controller::HTTP_OK);

    }


}