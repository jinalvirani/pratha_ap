<?php
  $maintanance_id = $this->session->userdata('maintanance_id');
  $maintanance_date=$this->session->userdata('maintanance_date');
  $m = 'Maintenance of '.$maintanance_date;
  $total_charge=$this->session->userdata('total_charge');
  $firstname=$this->session->userdata('firstname');
  $email=$this->session->userdata('email');
  $mobile_no=$this->session->userdata('mobile_no');




include 'instamojo.php';

$api = new Instamojo\Instamojo('test_82635103637894a8be480e4dd30', 'test_44144be9810ccf9a4b66e2cbfe4','https://test.instamojo.com/api/1.1/');


try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $m,
        "amount" => $total_charge,
        "buyer_name" => $firstname,
        "phone" => $mobile_no,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => (base_url().'owner_controller/update_pay_status_cont?maintanance_id='. $maintanance_id)
       // redirect(base_url().'owner_controller/change_profile_cont');

        ));
    //print_r($response);

    $pay_ulr = $response['longurl'];
    
    //Redirect($response['longurl'],302); //Go to Payment page

    header("Location: $pay_ulr");
    exit();

}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}     
  ?>
