<?php

error_reporting(E_ALL); // Error/Exception engine, always use E_ALL

ini_set('ignore_repeated_errors', TRUE); // always use TRUE

 

ini_set('log_errors', TRUE); // Error/Exception file logging engine.
ini_set('error_log', '/srv/app/errors.log'); // Logging file pa

require_once __DIR__ . '/../vendor/autoload.php';
define("TOOL_HOST",  'https://' . $_SERVER['HTTP_HOST']);
session_start();
use \IMSGlobal\LTI;

class Example_Database implements LTI\Database {

    // private $dbconn;

    public function __construct() {
       // $this->dbconn = pg_connect("host=db dbname=postgres user=postgres password=postgres");
    }

     public function find_registration_by_issuer($iss, $client_id) {

    //     $result = pg_query_params(
    //         $this->dbconn,
    //         'SELECT * FROM lti_registration WHERE issuer = $1 LIMIT 1',
    //         [$iss]
    //     );

    //     if (!$result) {
    //         return false;
    //     }

    //     $registration = pg_fetch_assoc($result);

    //     if (empty($registration)) {
    //         return false;
    //     }

    //     $key_result = pg_query_params(
    //         $this->dbconn,
    //         'SELECT * FROM lti_key WHERE key_set_id = $1 LIMIT 1',
    //         [$registration['key_set_id']]
    //     );

    //     if (!$key_result) {
    //         return false;
    //     }

    //     $key = pg_fetch_assoc($key_result);

    //     if (empty($key_result)) {
    //         return false;
    //     }

        // return LTI\LTI_Registration::new()
        // ->set_issuer($registration['issuer'])
        // ->set_client_id($registration['client_id'])
        // ->set_auth_login_url($registration['platform_login_auth_endpoint'])
        // ->set_auth_token_url($registration['platform_service_auth_endpoint'])
        // ->set_key_set_url($registration['platform_jwks_endpoint'])
        // ->set_auth_server($registration['platform_auth_provider'])
        // ->set_kid($key['id'])
        // ->set_tool_private_key($key['private_key']);
        
        $url = 'https://elephango.com/lti/ep/LMSRegistration.cfm?issuer=' . $iss . '&client_id=' .  $client_id;
        $json = file_get_contents($url);
        $registration2 = json_decode($json);

        // echo $registration['issuer'];
        // echo '<br>';
        // echo $registration2->issuer;
        // echo '<br>';echo '<br>';
        // echo $registration['client_id'];
        // echo '<br>';
        // echo $registration2->clientid;
        // echo '<br>';echo '<br>';
        // echo $registration['platform_login_auth_endpoint'];
        // echo '<br>';
        // echo $registration2->platformLoginAuthEndpoint;
        // echo '<br>';echo '<br>';
        // echo $registration['platform_service_auth_endpoint'];
        // echo '<br>';
        // echo $registration2->platformServiceAuthEndpoint;
        // echo '<br>';echo '<br>';
        // echo $registration['platform_jwks_endpoint'];
        // echo '<br>';
        // echo $registration2->platformJwksEndpoint;
        // echo '<br>';echo '<br>';
        // echo $registration['platform_auth_provider'];
        // echo '<br>';
        // echo $registration2->platformAuthProvider;
        // echo '<br>';echo '<br>';
        // echo $key['id'];
        // echo '<br>';
        // echo $registration2->keyID;
        // echo '<br>';echo '<br>';
        // var_dump($key['private_key']);
        // echo '<br>';
        // var_dump($registration2->privateKey);

        return LTI\LTI_Registration::new()
            ->set_issuer($registration2->ISSUER)
            ->set_client_id($registration2->CLIENTID)
            ->set_auth_login_url($registration2->PLATFORMLOGINAUTHENDPOINT)
            ->set_auth_token_url($registration2->PLATFORMSERVICEAUTHENDPOINT)
            ->set_key_set_url($registration2->PLATFORMJWKSENDPOINT)
            ->set_auth_server($registration2->PLATFORMAUTHPROVIDER)
            ->set_kid($registration2->KEYID)
            ->set_tool_private_key($registration2->PRIVATEKEY);
    }

    public function find_deployment($iss, $deployment_id) {
        // $result = pg_query_params(
        //     $this->dbconn,
        //     'SELECT d.deployment_id FROM lti_deployment d JOIN lti_registration r ON (d.registration_id = r.id) WHERE r.issuer = $1 AND d.deployment_id = $2',
        //     [$iss, $deployment_id]
        // );

        // if (!$result) {
        //     return false;
        // }

        // $deployment = pg_fetch_assoc($result);

        // if (empty($deployment)) {
        //     return false;
        // }

        $json = file_get_contents('https://elephango.com/lti/ep/LMSRegistration.cfm?deploymentid=' . $deployment_id . '&issuer=' . $iss);
        $registration = json_decode($json);
        
        
        return LTI\LTI_Deployment::new()
            ->set_deployment_id($registration->DEPLOYMENTID);
    }

    public function get_keys_in_set($key_set_id) {
        // $key_result = pg_query_params(
        //     $this->dbconn,
        //     'SELECT * FROM lti_key WHERE key_set_id = $1',
        //     [$key_set_id]
        // );

        // if (!$key_result) {
        //     return [];
        // }

        // $keys = [];
        // while($key = pg_fetch_assoc($key_result)) {
        //     $keys[$key['id']] = $key['private_key'];
        // }
        // return $keys;

        $keys = [];

        $json = file_get_contents('https://elephango.com/lti/ep/LMSReturnKey.cfm?PKSchoolLMSSettingsID=' . $key_set_id);
        $registration = json_decode($json);
       
        $keys[$registration->KEYID] = $registration->PRIVATEKEY;
        return $keys;
    }
}
?>