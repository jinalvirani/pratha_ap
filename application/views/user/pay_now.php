<?php
  $book_id= $this->session->userdata('book_id');
  $firstname= $this->session->userdata('firstname');
  $facility_name= $this->session->userdata('facility_name');
  $book_date=$this->session->userdata('book_date');
  $total_charge=$this->session->userdata('total_charge');
  $time_slot=$this->session->userdata('time_slot');
  $email=$this->session->userdata('email');
  $mobile_no=$this->session->userdata('mobile_no');




include 'instamojo.php';

$api = new Instamojo\Instamojo('test_82635103637894a8be480e4dd30', 'test_44144be9810ccf9a4b66e2cbfe4','https://test.instamojo.com/api/1.1/');


try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $facility_name,
        "amount" => $total_charge,
        "buyer_name" => $firstname,
        "phone" => $mobile_no,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => (base_url().'owner_controller/update_pay_status_cont?book_id='.$book_id)
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
