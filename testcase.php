<?php

$this->load->library('TestPayment');
$shopier = new TestPayment();
$shopier->setpayment(
  [
  'id' => 101,
  'name' => 'Erkin',
  'surname' => 'Eren',
  'email' => 'eren@erkin.net',
  'phone' => '8503023601'
  ],
  [
  'address' => 'Kızılay Mh.',
  'city' => 'Ankara',
  'country' => 'Turkey',
  'postcode' => '06100',
  ],'9999999',$genelToplam,'urun1'
)->setpaymentButton();
$shopier->setPaymentResponse();

?>
