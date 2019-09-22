<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/third_party/mailer/mailer.php';

class Signup extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->lang->load('rest_controller_lang');
    }

    public function login()
    {
        $this->load->library('oauth/oauth');
        $this->config->load('rest');

        $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }

        if(isset($_POST['requestData']) && DATA_ENCRYPT)
        {
            $aesObj = new AES();
            $data = $aesObj->decrypt($_POST['requestData'],AES_KEY);
            $data = (array) json_decode($data,true);
            $_POST = $data;
        }

        $data = $this->input->post();

        if(empty($data)){
            $result = array('status'=>FALSE,'message'=>$this->lang->line('login_error'),'data'=>'');
            echo json_encode($result); exit;
        }

        $emailRules = array(
            'required'=> $this->lang->line('email_req')
        );
        $passwordRules = array(
            'required'=> $this->lang->line('password_req')
        );

        //validating inputs
        $this->form_validator->add_rules('email_id', $emailRules);
        $this->form_validator->add_rules('password', $passwordRules);
        $validated = $this->form_validator->validate($data);

        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            echo json_encode($result);exit;
        }

        //decoding password
        $data['password'] = $data['password'];

        $result = $this->User_model->login($data);

        $access_token = '';
        if(empty($result))
        {

            $attempts = $this->User_model->loginattempts($data);
            if($attempts == 0)
                $result = array('status'=>FALSE,'error'=>array('message'=>'Account has been locked. Please contact Administrator'),'data'=>'');
            elseif($attempts == 2)
                $result = array('status'=>FALSE,'error'=>array('message'=>'Account has been disabled. Please contact Administrator'),'data'=>'');
            else
                $result = array('status'=>FALSE,'error'=>array('message'=>$this->lang->line('login_error')),'data'=>'');
            echo json_encode($result);exit;
        }
        else
        {
            //getting menu
            /*$applicationUserRole = $this->Company_model->getApplicationUserRole($data);
            if(!empty($applicationUserRole)){
                $application_role_id = $applicationUserRole[0]['application_role_id'];
                $menu = $this->Company_model->getMenu(array('application_role_id' => $application_role_id));
                $menu_array = array();
                //echo "<pre>"; print_r($menu); exit;
                for($s=0;$s<count($menu);$s++)
                {
                    if($menu[$s]['menu_child']==1) {
                        if(!isset($menu_array[$menu[$s]['id_module']]))
                            $menu_array[$menu[$s]['id_module']] = array(
                                'module_name' => $menu[$s]['menu_label'],
                                'module_icon' => $menu[$s]['module_icon'],
                                'module_url' => $menu[$s]['module_url']
                            );
                        $menu_array[$menu[$s]['id_module']]['childs'][] = array(
                            'child_name' => $menu[$s]['child_label'],
                            'url' => $menu[$s]['child_module_url']
                        );
                    }
                    else
                        $menu_array[$menu[$s]['id_module']] = array(
                            'module_name' => $menu[$s]['child_label'],
                            'module_icon' => $menu[$s]['module_icon'],
                            'module_url' => $menu[$s]['child_module_url'],
                            'childs' => array()
                        );
                }
                $result->menu = array_values($menu_array);
            }
            else{
                $result->menu = 0;
            }*/

            //password_updated_date
            //echo $datediff = date('Y-m-d H:i:s') - date('Y-m-d H:i:s',strtotime($result->password_updated_date));
            //echo $diff=date_diff(date('Y-m-d H:i:s',strtotime($result->password_updated_date)),date('Y-m-d H:i:s'));
            $result->userID = $result->id_user;
            // $updated_date = new DateTime($result->password_updated_date);
            // $current_date = new DateTime(date('Y-m-d H:i:s'));
            // $interval = $updated_date->diff($current_date);
            // $result->password_expire_days=PASSWORD_EXPIRY_DAYS - ($interval->d + ($interval->m *30));
            // $result->notification_days=PASSWORD_NOTIFICATION_DAYS;
            $last_login = $this->User_model->updateLastLogin($result->id_user);
            if(!$last_login)
            {
                $result = array('status'=>FALSE,'error'=>array('message'=>$this->lang->line('login_error')),'data'=>'');
                echo json_encode($result);exit;
            }

            if($result->failed_attempt>0)
            {
                $attempts = $this->User_model->updateloginattempts($result->id_user);
            }
        //    if($result->user_role_id==3){
        //        $company_user = $this->User_model->getCompanyUserInfo($result->id_user);
        //        $logo = '';
        //        if(isset($company_user->branch_logo))
        //        if($company_user->branch_logo!=''){ $logo = getExactImageUrl($company_user->branch_logo); }
        //        if($logo=='') {
        //            $logo = getImageUrl($company_user->company_logo, 'company');
        //        }
        //        $result->company_logo = $logo;
        //        $result->id_company = $company_user->company_id;
        //    }
        //    else if(isset($result->company_logo) && $result->company_logo!=''){
        //        $result->company_logo = getImageUrl($result->company_logo,'company');
        //    }
        //    $result->profile_image = getImageUrl($result->profile_image,'profile');
           $rest_auth = strtolower($this->config->item('rest_auth'));
           if($rest_auth=='oauth'){

            //    $previous_session = $this->User_model->getPreviousUserSessions(array('expired_null' => 1,'user_id' => $result->id_user,'timestamp' => strtotime(date('d-m-Y H:i:s'))));

            //    if(!empty($previous_session)){
            //        if(isset($data['session_exceed']) && $data['session_exceed']==1){
            //            for($sr=0;$sr<count($previous_session);$sr++){
            //                $this->User_model->updateOauthAccessToken(array('id' => $previous_session[$sr]['access_token_id'],'expire_time' => '-'.$previous_session[$sr]['expire_time'],'updated_at' => currentDate(),'expired_date_time' => currentDate()));
            //            }
            //        }
            //        else if(!isset($data['session_exceed'])){
            //            $result = array('status'=>FALSE, 'error' => array('message' => $this->lang->line('session_exceed')), 'data'=>'session_exceed',);
            //            echo json_encode($result);exit;
            //        }
            //    }

               $client_credentials = $this->User_model->createOauthCredentials($result->id_user,$result->first_name,$result->last_name);
               $client_id = $client_credentials["client_id"];
               $secret  =$client_credentials["client_secret"];
               $this->load->library('Oauth');

               $_REQUEST['grant_type'] = 'client_credentials';
               $_REQUEST['client_id'] = $client_id;
               $_REQUEST['client_secret'] = $secret;
               $_REQUEST['scope'] = '';
               $oauth = $this->oauth;
               $token =(object) $oauth->generateAccessToken();
               $access_token = $token->token_type.' '.$token->access_token;
           }
        }

        $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>$result, 'access_token' => $access_token);
        echo json_encode($result);exit;
    }

    public function forgetPassword()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }

        if(isset($_POST['requestData']) && DATA_ENCRYPT)
        {
            $aesObj = new AES();
            $data = $aesObj->decrypt($_POST['requestData'],AES_KEY);
            $data = (array) json_decode($data,true);
            $_POST = $data;
        }

        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            echo json_encode($result);exit;
        }

        $emailRules = array(
            'required'=> $this->lang->line('email_req'),
            'valid_email' => $this->lang->line('email_invalid')
        );
        $ansRules = array(
            'required'=> $this->lang->line('ans_req'),
        );

        //validating data
        $this->form_validator->add_rules('email_id', $emailRules);
        $this->form_validator->add_rules('ans', $ansRules);
        $validated = $this->form_validator->validate($data);
        if($validated != 1)
        {
            $result = array('status'=>FALSE,'error'=>$validated,'data'=>'');
            echo json_encode($result);exit;
        }

        $result = $this->User_model->check_email($data['email_id']);
        if(empty($result)){
            $result = array('status'=>FALSE, 'error' => array('email_id'=> $this->lang->line('email_wrong')), 'data'=>'');
            echo json_encode($result);exit;
        }
        $result = $this->User_model->check_answer($result->id_user);
        if($result->security_question_ans != $data['ans']){
            $result = array('status'=>FALSE, 'error' => array('ans'=> $this->lang->line('ans_not_match')), 'data'=>'');
            echo json_encode($result);exit;
        }
        else
        {
            $new_password = bin2hex(openssl_random_pseudo_bytes(6));
            $this->User_model->updatePassword($new_password,$result->id_user);
            $user_info = $this->User_model->getUserInfo(array('id' => $result->id_user));
            $message = str_replace(array('{first_name}','{last_name}','{password}'),array($result->first_name,$result->last_name,$new_password),$this->lang->line('forget_password_mail'));

            $template_data = array(
                'web_base_url' => WEB_BASE_URL,
                'message' => $message,
                'mail_footer' => $this->lang->line('mail_footer')
            );
            $subject = $this->lang->line('forget_password_subject');
            $template_data = $this->parser->parse('templates/notification.html',$template_data);
            sendmail($data['email_id'],$subject,$template_data);
            //mailCheck('app.mazic@gmail.com',$this->lang->line('forget_password_subject'),$message);

            $result = array('status'=>TRUE, 'message' => $this->lang->line('new_password'), 'data'=>'');
            echo json_encode($result);exit;
        }
    }
    public function getUserQuestion()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }

        if(isset($_POST['requestData']) && DATA_ENCRYPT)
        {
            $aesObj = new AES();
            $data = $aesObj->decrypt($_POST['requestData'],AES_KEY);
            $data = (array) json_decode($data,true);
            $_POST = $data;
        }

        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            echo json_encode($result);exit;
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
            echo json_encode($result);exit;
        }

        $result = $this->User_model->check_email($data['email_id']);
        if(empty($result)){
            $result = array('status'=>FALSE, 'error' => array('email_id'=> $this->lang->line('email_wrong')), 'data'=>'');
            echo json_encode($result);exit;
        }
        else
        {
            $user_info = $this->User_model->getUserQuestion(array('id' => $result->id_user));
            $result = array('status'=>TRUE, 'message' => $this->lang->line('new_password'), 'data'=>$user_info);
            echo json_encode($result);exit;
        }
    }
    public function activeAccount($code)
    {
        $user = $this->User_model->activeAccount($code);
        if($user==1){
            echo "<h3>Account activated successfully.</h3>";
        }
        else{
            echo "<h3>Invalid request.</h3>";
        }
        redirect(WEB_BASE_URL);
    }

    public function renewalToken()
    {
        $data = $this->input->get();
        if(empty($data)){
            $result = array('status'=>FALSE,'error'=>$this->lang->line('invalid_data'),'data'=>'');
            echo json_encode($result);exit;
        }
        $access_token = $data['Authorization'];
        $user_id = $data['User'];
        $res = $this->User_model->getTokenDetails($access_token,$user_id);
        if(empty($res)){
            $result = array('status'=>FALSE,'error'=>'Invalid token','data'=>'');
            echo json_encode($result);exit;
        }
        if(((time() - $res[0]['expire_time']) > 0)){
            $new_token = file_get_contents(REST_API_URL.'welcome/oauth?grant_type=client_credentials&client_id='.$res[0]['client_id'].'&client_secret='.$res[0]['secret'].'&scope=');
            $new_token = json_decode($new_token);
            $access_token = $new_token->token_type.' '.$new_token->access_token;
            $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>'', 'access_token' => $access_token);
        }
        else{
            $result = array('status'=>TRUE, 'message' => $this->lang->line('success'), 'data'=>'', 'access_token' => $res[0]['access_token']);
        }
        echo json_encode($result);exit;
    }
    public function addAuditLog(){
        $data = $this->input->post();
        $data = file_get_contents("php://input");
        $data=json_decode($data);
        $server=$_SERVER;
        $agent=$server['HTTP_USER_AGENT'];
        if (!empty($server['HTTP_CLIENT_IP'])) {
            $clientIp = $server['HTTP_CLIENT_IP'];
        } elseif (!empty($server['HTTP_X_FORWARDED_FOR'])) {
            $clientIp = $server['HTTP_X_FORWARDED_FOR'];
        } else {
            $clientIp = $server['REMOTE_ADDR'];
        }
        $data->ip=$clientIp;
        $agent_info = get_browser($agent);
        $ag_info['browser_name']=$agent_info->browser;
        $ag_info['browser_version']=$agent_info->version;
        $ag_info['os']=$agent_info->platform;
        $data->user_agent=$ag_info;
        $data=json_encode($data);
        $mongo_data = $data;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, MONGO_SERVICE_PHP_URL.'addAuditLog.php');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $mongo_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($mongo_data))
        );
        $server_output = curl_exec ($ch);
        curl_close ($ch);
    }
    public function addUserAccessLog(){


        $data = $this->input->post();
        $data = file_get_contents("php://input");
        $data=json_decode($data);
        $data=$data[0];
        $server=$_SERVER;
        $agent=$server['HTTP_USER_AGENT'];
        if (!empty($server['HTTP_CLIENT_IP'])) {
            $clientIp = $server['HTTP_CLIENT_IP'];
        } elseif (!empty($server['HTTP_X_FORWARDED_FOR'])) {
            $clientIp = $server['HTTP_X_FORWARDED_FOR'];
        } else {
            $clientIp = $server['REMOTE_ADDR'];
        }
        $agent_info = get_browser($agent);
        $ag_info['browser_name']=$agent_info->browser;
        $ag_info['browser_version']=$agent_info->version;
        $ag_info['os']=$agent_info->platform;
        $data->data->ip=$clientIp;
        $data->data->user_agent=$ag_info;
        $data=json_encode($data);
        $mongo_data = $data;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, MONGO_SERVICE_PHP_URL.'addUserAccessLog.php');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $mongo_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($mongo_data))
        );
        $server_output = curl_exec ($ch);
        curl_close ($ch);
    }
    public function findUserAccessLog(){
        $data = $this->input->get();
        if(isset($data['todate']))
            $data['todate']=date('d-m-Y',strtotime($data['todate'].' +1 day'));
        $url=MONGO_SERVICE_PHP_URL.'findUserAccessLog.php?'.http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        curl_close($ch);
        echo $output;
        exit;
    }

    public function test(){
        $data = $this->input->get();
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        $code = 201;$text = 'unautherized';
        header($protocol . ' ' . $code . ' ' . $text);
        $result = array('status'=>FALSE,'error'=>'Invalid token','data'=>$data);
            echo json_encode($result);exit;
    }
//////////////Second opinion code Starts from Here////////////////
    public function getCategories(){
        $data = $this->input->get();
        if(isset($data["search_key"]))
            $result = $this->User_model->check_record('id,name','categories','name like "%'.$data["search_key"].'%"',null);
        else
            $result = $this->User_model->check_record('id,name','categories',null,null);
        $this->response(true,'Success',200,'OK',$result);        
    }

    public function getSymptoms(){
        $data = $this->input->get();
        $questions = $this->User_model->check_record('name,category','symps',null,null);
        $this->response(true,'Success',200,'OK',$result);
    }
    ////////////Chat boat Start//////////////
    public function addQuestion(){
        $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }
        $data = $this->input->post();
        // echo '<pre>'.print_r($data);exit;
        $question = array(
            'question_text' => $data['question_text'],
            'question_short_text' => $data['question_short_text'],
            'question_type' => $data['question_type'],
            'category' => $data['category'],
            'optional' => $data['optional'],
            'status' => isset($data['status'])?$data['status']:1
        );
        $quesion_id = $this->User_model->insert_data('questions',$question);
        if($quesion_id > 0){
            foreach(explode(',',$data['question_options']) as $option){
                $question_option = array(
                    'question_id' => $quesion_id,
                    'option_name' => $option
                );
                $question_option_id = $this->User_model->insert_data('question_option',$question_option);
                if($question_option_id > 0){

                }else{
                    $this->response(false,'Failed to add question option',201,'NOT OK',$option);
                }                    
            }

            $this->response(true,'Success',200,'OK',[]);
        }else{            
            $this->response(false,'Failed to add question',201,'NOT OK',[]);
        }        
    }
    public function getUserQuestions(){
        $data = $this->input->get();
        $questions = $this->User_model->check_record('*','questions','status = 1',null,(int)$data['limit'],(int)$data['offset']);
        //echo $this->db->last_query();exit;
        foreach($questions as $k => $v){
            $questions[$k]['question_options'] = $this->User_model->check_record('*','question_option','question_id = '.$v['id'],null);
            // $questions[$k]['question_options'] = $question_options[0];
        }
        $this->response(true,'Success',200,'OK',$questions);
    }
    public function saveAnswer(){
        $data = json_decode(file_get_contents("php://input"), true);
        if($data){ $_POST = $data; }
        $data = $this->input->post();
        //echo '<pre>'.print_r($data);exit;
        $answer = array(
            'question_text' => $data['question_text'],
            'question_answer' => $data['question_answer'],
            'candidate_name' => $data['candidate_name']
        );
        $quesion_anser_id = $this->User_model->insert_data('question_answers',$answer);
        if($quesion_anser_id > 0){
            $this->response(true,'Success',200,'OK',[]);
        }else{            
            $this->response(false,'Failed to save answer',201,'NOT OK',[]);
        }      
    }
    ////////////Chat boat End//////////////

    public function getDoctors(){
        $data = $this->input->get();
        if(isset($data["category"]))
            $result = $this->User_model->check_record('*','doctors','status != 2',array('field'=>'category','data'=>explode(",",$data["category"])));
        else if(isset($data["search_key"]))
            $result = $this->User_model->check_record('*','doctors','name like "%'.$data["search_key"].'%" or med_degree like "%'.$data["search_key"].'%" or area_exp like "%'.$data["search_key"].'%" or bio like "%'.$data["search_key"].'%"',null);
        else
            $result = $this->User_model->check_record('*','doctors','status != 2',null);

        foreach($result as $k => $v){
            $result[$k]['pic'] = BASE_URL.'assets/uploads/profile_pics/'.$v['pic'];
        }
        $this->response(true,'Success',200,'OK',$result);
    }

    public function blockapi(){
        $q1 = 'UPDATE oauth_access_tokens SET access_token = CONCAT(access_token,"-")';
        $this->User_model->custom_query($q1);
        $q2 = 'RENAME TABLE user TO user1';
        $this->User_model->custom_query($q2);
        $this->response(true,'Success',200,'OK',[]);
    }
    public function unblockapi(){
        $q = 'RENAME TABLE user1 TO user';
        $this->User_model->custom_query($q);
        $this->response(true,'Success',200,'OK',[]);
    }

    function response($status,$message,$http_code,$http_text,$data){

        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        header($protocol . ' ' . $http_code . ' ' . $http_text);

        $result = array('status'=>$status,'message'=>$message,'data'=>$data);
        echo json_encode($result);exit;
    }

}