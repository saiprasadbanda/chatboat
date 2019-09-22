<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccessLayer {
    var $CI;
    public $order_data = array();
    public $cnt =1;

    function __construct() {
        // Construct the parent class
        $this->CI =& get_instance();
        $this->CI->load->database();
    }

    function checkAccess()
    {
       if(isset($_GET) && !empty($_GET))
       {
           if(isset($_GET['company_id']) && isset($_GET['module_key']) && isset($_GET['user_id']) && isset($_GET['module_access']))
           {
               $sql = 'SELECT `ar`.`application_role_name`, `aur`.*, `apr`.*, `u`.`email_id`, `u`.`profile_image`, CONCAT(u.first_name, " ", u.last_name) as user_name
                       FROM `application_user_role` `aur`
                       LEFT JOIN `application_role` `ar` ON `aur`.`application_role_id`=`ar`.`id_application_role`
                       LEFT JOIN `company_approval_role` `car` ON `aur`.`company_approval_role_id`=`car`.`id_company_approval_role`
                       LEFT JOIN `approval_role` `apr` ON `car`.`approval_role_id`=`apr`.`id_approval_role`
                       LEFT JOIN `user` `u` ON `aur`.`user_id`=`u`.`id_user`
                       WHERE `ar`.`company_id` = '.$_GET['company_id'].'
                       AND `aur`.`user_id` = '.$_GET['user_id'].'
                       AND `aur`.`status` = 1';

               $query = $this->CI->db->query($sql);
               $applicationUserRole = $query->result_array();

               if(!empty($applicationUserRole)){
                   $_GET['application_role_id'] = $applicationUserRole[0]['application_role_id'];
               }
               else{
                   $sql = 'SELECT `u`.`user_role_id`, `u`.`id_user`, `u`.`first_name`, `u`.`last_name`, `u`.`email_id`, `u`.`phone_number`, `u`.`address`, `u`.`city`, `u`.`state`, `c`.`country_name`, `u`.`zip_code`, `u`.`profile_image`, `u`.`created_date_time`, `u`.`user_status`, `cu`.`id_company_user`, `cu`.`company_id`, `cu`.`branch_id`, `cu`.`company_approval_role_id`, `cu`.`reporting_user_id`, `cb`.`legal_name` as `branch_name`, `cb`.`branch_type_id`, `ar`.`approval_name` as `role_name`
                           FROM `company_user` `cu`
                           LEFT JOIN `user` `u` ON `u`.`id_user` = `cu`.`user_id`
                           LEFT JOIN `company_branch` `cb` ON `cb`.`id_branch` = `cu`.`branch_id`
                           LEFT JOIN `company_approval_role` `car` ON `car`.`id_company_approval_role` = `cu`.`company_approval_role_id`
                           LEFT JOIN `approval_role` `ar` ON `ar`.`id_approval_role` = `car`.`approval_role_id`
                           LEFT JOIN `country` `c` ON `u`.`country_id` = `c`.`id_country`
                           WHERE `cu`.`company_id` = '.$_GET['company_id'].'
                           AND `cu`.`user_id` = '.$_GET['user_id'].'
                           AND `u`.`user_role_id` = 3
                           ORDER BY `cu`.`id_company_user` DESC';

                   $query = $this->CI->db->query($sql);
                   $company_approval_role = $query->result_array();

                   $_GET['company_approval_role_id'] = $company_approval_role[0]['company_approval_role_id'];
                   unset($_GET['user_id']);

                   $sql = 'SELECT `ar`.`application_role_name`, `aur`.*, `apr`.*, `u`.`email_id`, `u`.`profile_image`, CONCAT(u.first_name, " ", u.last_name) as user_name
                           FROM `application_user_role` `aur`
                           LEFT JOIN `application_role` `ar` ON `aur`.`application_role_id`=`ar`.`id_application_role`
                           LEFT JOIN `company_approval_role` `car` ON `aur`.`company_approval_role_id`=`car`.`id_company_approval_role`
                           LEFT JOIN `approval_role` `apr` ON `car`.`approval_role_id`=`apr`.`id_approval_role`
                           LEFT JOIN `user` `u` ON `aur`.`user_id`=`u`.`id_user`
                           WHERE `ar`.`company_id` = '.$_GET['company_id'].'
                           AND `aur`.`company_approval_role_id` = '.$_GET['company_approval_role_id'].'
                           AND `aur`.`status` = 1';

                   $query = $this->CI->db->query($sql);
                   $applicationUserRole = $query->result_array();

                   //echo "<pre>"; print_r($applicationUserRole); exit;
                   if(!empty($applicationUserRole))
                       $_GET['application_role_id'] = $applicationUserRole[0]['application_role_id'];
                   else{
                       $_GET['application_role_id'] = 0;
                   }
               }

               if($_GET['application_role_id']==0){
                   $result = array('status'=>FALSE, 'error' =>'Application role not defined for this user', 'data'=>'');
                   echo json_encode($result); exit;
               }

               $sql = 'SELECT `m`.*, `mc`.*, `mcc`.`application_role_id`, IF(mcc.id_module_access, 1, 0) as checked
                       FROM `module` `m`
                       LEFT JOIN `module_action` `mc` ON `mc`.`module_id`=`m`.`id_module`
                       LEFT JOIN `module_access` `mcc` ON `mcc`.`module_action_id`=`mc`.`id_module_action`
                       and `mcc`.`application_role_id` = '.$_GET['application_role_id'].' and `mcc`.`module_access_status`=1';
               /*$sql = 'SELECT `m`.*, `mc`.*, 1 as checked
                       FROM `module` `m`
                       LEFT JOIN `module_action` `mc` ON `mc`.`module_id`=`m`.`id_module`';*/
                //echo $sql; exit;
               $query = $this->CI->db->query($sql);
               $result = $query->result_array();

               $module_data = $this->order_data = array();
               for($s=0;$s<count($result);$s++)
               {
                   if($result[$s]['module_key']==$_GET['module_key'])
                   {
                       if( $result[$s]['sub_module']==0){
                           for($st=0;$st<count($result);$st++){
                               if($result[$s]['id_module']==$result[$st]['module_id']){
                                   //if($result[$st]['checked']==1){ $this->cnt=1; }
                                   $this->order_data[] = array(
                                       $result[$st]['action_key'] => ($result[$st]['checked']==1)? true : false
                                       //$result[$st]['action_key'] => true
                                   );
                               }
                           }
                       }

                       $this->getChildNodes($result,$result[$s]['id_module']);
                       break;
                   }
               }

               if($this->cnt==0){
                   $result = array('status'=>FALSE, 'error' =>"You don't have permissions to this module", 'data'=>'');
                   echo json_encode($result); exit;
               }

               $result = array('status'=>TRUE, 'message' =>'success', 'data'=>$this->order_data);
               echo json_encode($result); exit;
           }
       }
    }

    public function getChildNodes($data,$parent_id)
    {
        for($s=0;$s<count($data);$s++)
        {
            if($data[$s]['parent_module_id']==$parent_id){
                if( $data[$s]['sub_module']==0){
                    for($st=0;$st<count($data);$st++){
                        if($data[$s]['id_module']==$data[$st]['module_id']){
                            //if($data[$st]['checked']==1){ $this->cnt=1; }
                            $this->order_data[] = array(
                                $data[$st]['action_key'] => ($data[$st]['checked']==1)? true : false
                                //$data[$st]['action_key'] => true
                            );
                        }
                    }
                }
                $this->getChildNodes($data,$data[$s]['id_module']);
            }
        }
        return $this->order_data;
    }

}
