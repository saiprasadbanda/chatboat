<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors','1');
ini_set('memory_limit','256M');
define('ENV','DEV');
switch(ENV)
{
    case 'DEV':
        /*$base_host = sprintf('%s://%s/',$_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http',$_SERVER['SERVER_NAME'])."eadb_04/";
        /* site urls starts */
        //$base_host = "http://183.82.97.231:9080/html/projects/eadb/development/";
        $base_host = "http://localhost/chatboatapi/";
        define('BASE_URL', $base_host);
        define('WEB_BASE_URL', $base_host.'html/');
        define('REST_API_URL', $base_host.'rest/');
        define('PAGING_LIMIT', '10');
        /* site urls ends */
        /* database configuration starts*/
        define('DB_HOST', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'chatboat');
        /* database configuration ends*/
		
		
		/* aes encryption configuration starts */
        define('AES_KEY', 'threshold');
        define('DATA_ENCRYPT',FALSE);
        /* aes encryption configuration ends */

        define('EXCEL_UPLOAD_SIZE','2097152');
        define('IMAGE_UPLOAD_SIZE','2097152');
		
        define('PASSWORD_EXPIRY_DAYS',90);
        define('PASSWORD_NOTIFICATION_DAYS',10);
		
        define('ACCESS_TOKEN_EXPIRE',1800);//in seconds
        
        define('FILE_SYSTEM_PATH','');
		
        break;

    case 'STAGE':
        $base_host = sprintf('%s://%s/',$_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http',$_SERVER['SERVER_NAME']);
        $base_host = $base_host.'/accessbank/';
        /* site urls starts */
        define('WEB_BASE_URL', $base_host);
        define('REST_API_URL', $base_host.'rest/');
        define('PAGING_LIMIT', '10');
        /* site urls ends */

        /* database configuration starts*/
        define('DB_HOST', 'localhost');
        define('DB_USERNAME', 'admin');
        define('DB_PASSWORD', 'the@123');
        define('DB_NAME', 'accessbank');
        /* database configuration ends*/
		
		/*mongo server urls starts*/
        define('MONGO_SERVICE_URL', 'http://183.82.97.231:9086/');
        define('MONGO_SERVICE_PHP_URL', 'http://139.59.76.171/mongo-php/accessbank/');
        define('LOG_AUTH_KEY', 'F%DTBh*nY9Kq@QdWc');
        /*mongo server urls ends*/
		
		/* aes encryption configuration starts */
        define('AES_KEY', 'threshold');
        define('DATA_ENCRYPT',TRUE);
        /* aes encryption configuration ends */
		
        define('EXCEL_UPLOAD_SIZE','20971520');
        define('IMAGE_UPLOAD_SIZE','20971520');
				
        define('PASSWORD_EXPIRY_DAYS',90);
        define('PASSWORD_NOTIFICATION_DAYS',10);

        define('FILE_SYSTEM_PATH','');

        break;
}

?>
