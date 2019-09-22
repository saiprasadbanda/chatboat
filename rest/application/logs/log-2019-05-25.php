<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-05-25 06:00:58 --> Severity: Compile Error --> Cannot redeclare User::postCategories_post() D:\wamp64\www\secondop\rest\application\controllers\User.php 541
ERROR - 2019-05-25 07:13:31 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) D:\wamp64\www\secondop\rest\application\models\User_model.php 475
ERROR - 2019-05-25 07:14:26 --> Severity: 4096 --> Argument 1 passed to Form_Validator::validate() must be of the type array, null given, called in D:\wamp64\www\secondop\rest\application\controllers\User.php on line 609 and defined D:\wamp64\www\secondop\rest\application\libraries\common\Form_Validator.php 316
ERROR - 2019-05-25 07:14:39 --> Severity: 4096 --> Argument 1 passed to Form_Validator::validate() must be of the type array, null given, called in D:\wamp64\www\secondop\rest\application\controllers\User.php on line 609 and defined D:\wamp64\www\secondop\rest\application\libraries\common\Form_Validator.php 316
ERROR - 2019-05-25 07:15:15 --> Severity: 4096 --> Argument 1 passed to Form_Validator::validate() must be of the type array, null given, called in D:\wamp64\www\secondop\rest\application\controllers\User.php on line 609 and defined D:\wamp64\www\secondop\rest\application\libraries\common\Form_Validator.php 316
ERROR - 2019-05-25 07:15:37 --> Severity: 4096 --> Argument 1 passed to Form_Validator::validate() must be of the type array, null given, called in D:\wamp64\www\secondop\rest\application\controllers\User.php on line 609 and defined D:\wamp64\www\secondop\rest\application\libraries\common\Form_Validator.php 316
ERROR - 2019-05-25 07:15:44 --> Severity: 4096 --> Argument 1 passed to Form_Validator::validate() must be of the type array, null given, called in D:\wamp64\www\secondop\rest\application\controllers\User.php on line 609 and defined D:\wamp64\www\secondop\rest\application\libraries\common\Form_Validator.php 316
ERROR - 2019-05-25 07:15:49 --> Severity: 4096 --> Argument 1 passed to Form_Validator::validate() must be of the type array, null given, called in D:\wamp64\www\secondop\rest\application\controllers\User.php on line 609 and defined D:\wamp64\www\secondop\rest\application\libraries\common\Form_Validator.php 316
ERROR - 2019-05-25 09:06:48 --> Severity: Parsing Error --> syntax error, unexpected '$data' (T_VARIABLE) D:\wamp64\www\secondop\rest\application\models\User_model.php 489
ERROR - 2019-05-25 09:07:32 --> Severity: Parsing Error --> syntax error, unexpected '$data' (T_VARIABLE) D:\wamp64\www\secondop\rest\application\models\User_model.php 489
ERROR - 2019-05-25 10:41:21 --> Severity: Warning --> Missing argument 4 for User_model::check_record(), called in D:\wamp64\www\secondop\rest\application\controllers\User.php on line 686 and defined D:\wamp64\www\secondop\rest\application\models\User_model.php 433
ERROR - 2019-05-25 10:41:35 --> Severity: Warning --> Missing argument 4 for User_model::check_record(), called in D:\wamp64\www\secondop\rest\application\controllers\User.php on line 686 and defined D:\wamp64\www\secondop\rest\application\models\User_model.php 433
ERROR - 2019-05-25 10:41:44 --> Severity: Warning --> Missing argument 4 for User_model::check_record(), called in D:\wamp64\www\secondop\rest\application\controllers\User.php on line 686 and defined D:\wamp64\www\secondop\rest\application\models\User_model.php 433
ERROR - 2019-05-25 12:08:42 --> Query error: FUNCTION d.con_feesum does not exist - Invalid query: SELECT `h`.*, `d`.`name` as `doctor_name`, d.con_feesum(d.con_fee) as all_payment
FROM `patients` as `h`
LEFT JOIN `doctors` as `d` ON `d`.`did`=`h`.`assigned_to`
WHERE `d`.`status` = '1'
AND `h`.`payment` = '1'
ORDER BY `h`.`pid` DESC
 LIMIT 10
ERROR - 2019-05-25 12:08:42 --> Could not find the language line "db_error_heading"
ERROR - 2019-05-25 12:16:41 --> Severity: Warning --> Missing argument 4 for User_model::check_record(), called in D:\wamp64\www\secondop\rest\application\controllers\User.php on line 16 and defined D:\wamp64\www\secondop\rest\application\models\User_model.php 433
ERROR - 2019-05-25 12:41:39 --> Severity: Parsing Error --> syntax error, unexpected 'if' (T_IF) D:\wamp64\www\secondop\rest\application\controllers\User.php 717
ERROR - 2019-05-25 12:41:59 --> Severity: Parsing Error --> syntax error, unexpected '}', expecting variable (T_VARIABLE) D:\wamp64\www\secondop\rest\application\controllers\User.php 728
