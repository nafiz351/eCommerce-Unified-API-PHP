<?php

require "../../mpgClasses.php";

/************************ Request Variables **********************************/

$store_id='monusqa002';
$api_token='qatoken';

/************************ Transaction Variables ******************************/

$type='res_update_ach';  
$data_key='ejJJON45q6M8maeptQyzJWc35';
$cust_id='';
$phone = '0000000000';
$email = '';
$note = 'note';

/************************ Transaction Array **********************************/

$txnArray=array('type'=>$type,
				'data_key'=>$data_key,
				'cust_id'=>$cust_id,
				'phone'=>$phone,
				'email'=>$email,
				'note'=>$note
          		);

/************************** ACH Info Variables *****************************/

//Mandatory payment details
$sec = 'ccd';				//only ppd|ccd|web are supported
$routing_num = '123456789';
$account_num = '999999999';
$account_type = 'checking';

//Optional payment detail
$check_num = '';

//Optional customer details
$cust_first_name = '';
$cust_last_name = 'SMITH';
$cust_address1 = '';
$cust_address2 = '';
$cust_city = '';
$cust_state = '';
$cust_zip = '';

/********************** ACH Info Associative Array *************************/

$achTemplate = array(
		     sec =>$sec,
		     cust_first_name => $cust_first_name,
                     cust_last_name => $cust_last_name,
                     cust_address1 => $cust_address1,
                     cust_address2 => $cust_address2,
                     cust_city => $cust_city,
                     cust_state => $cust_state,
                     cust_zip => $cust_zip,
                     routing_num => $routing_num,
                     account_num => $account_num,
                     check_num => $check_num,
                     account_type => $account_type
                    );

/************************** ACH Info Object ********************************/

$mpgAchInfo = new mpgAchInfo ($achTemplate);

/************************ Transaction Object *******************************/

$mpgTxn = new mpgTransaction($txnArray);

/************************ Set ACH Info *************************************/

$mpgTxn->setAchInfo($mpgAchInfo);

/************************ Request Object **********************************/

$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("US"); //"CA" for sending transaction to Canadian environment
$mpgRequest->setTestMode(true); //false or comment out this line for production transactions
$mpgRequest->setTestMode(true);

/************************ mpgHttpsPost Object ******************************/

$mpgHttpPost = new mpgHttpsPost($store_id,$api_token,$mpgRequest);

/************************ Response Object **********************************/

$mpgResponse=$mpgHttpPost->getMpgResponse();

print("\nDataKey = " . $mpgResponse->getDataKey());
print("\nResponseCode = " . $mpgResponse->getResponseCode());
print("\nMessage = " . $mpgResponse->getMessage());
print("\nTransDate = " . $mpgResponse->getTransDate());
print("\nTransTime = " . $mpgResponse->getTransTime());
print("\nComplete = " . $mpgResponse->getComplete());
print("\nTimedOut = " . $mpgResponse->getTimedOut());
print("\nResSuccess = " . $mpgResponse->getResSuccess());
print("\nPaymentType = " . $mpgResponse->getPaymentType());

//----------------- ResolveData ------------------------------

print("\n\nCust ID = " . $mpgResponse->getResDataCustId());
print("\nPhone = " . $mpgResponse->getResDataPhone());
print("\nEmail = " . $mpgResponse->getResDataEmail());
print("\nNote = " . $mpgResponse->getResDataNote());
print("\nMasked Pan = " . $mpgResponse->getResDataMaskedPan());
print("\nExp Date = " . $mpgResponse->getResDataExpDate());
print("\nCrypt Type = " . $mpgResponse->getResDataCryptType());
print("\nAvs Street Number = " . $mpgResponse->getResDataAvsStreetNumber());
print("\nAvs Street Name = " . $mpgResponse->getResDataAvsStreetName());
print("\nAvs Zipcode = " . $mpgResponse->getResDataAvsZipcode());
print("\nPresentation Type = " . $mpgResponse->getResDataPresentationType());
print("\nP Account Number = " . $mpgResponse->getResDataPAccountNumber());
print("\nSec = " . $mpgResponse->getResDataSec());
print("\nCust First Name = " . $mpgResponse->getResDataCustFirstName());
print("\nCust Last Name = " . $mpgResponse->getResDataCustLastName());
print("\nCust Address 1 = " . $mpgResponse->getResDataCustAddress1());
print("\nCust Address 2 = " . $mpgResponse->getResDataCustAddress2());
print("\nCust City = " . $mpgResponse->getResDataCustCity());
print("\nCust State = " . $mpgResponse->getResDataCustState());
print("\nCust Zip = " . $mpgResponse->getResDataCustZip());
print("\nRouting Num = " . $mpgResponse->getResDataRoutingNum());
print("\nMasked Account Num = " . $mpgResponse->getResDataMaskedAccountNum());
print("\nCheck Num = " . $mpgResponse->getResDataCheckNum());
print("\nAccount Type = " . $mpgResponse->getResDataAccountType());

?>
