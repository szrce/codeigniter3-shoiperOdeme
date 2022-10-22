<?php

//namespace App\libraries;

use Shopier\Enums\ProductType;
use Shopier\Enums\WebsiteIndex;
use Shopier\Exceptions\NotRendererClassException;
use Shopier\Exceptions\RendererClassNotFoundException;
use Shopier\Exceptions\RequiredParameterException;
use Shopier\Models\Address;
use Shopier\Models\Buyer;
use Shopier\Renderers\AutoSubmitFormRenderer;
use Shopier\Renderers\IframeRenderer;
use Shopier\Renderers\ShopierButtonRenderer;
use Shopier\Shopier;
use Shopier\Renderers\ButtonRenderer;
use Shopier\Models\ShopierResponse;

class TestPayment {

    protected  $shopier;


    public function __construct(){
      $this->shopier =  new Shopier('null','null');
    }

    public function setpayment(Array $productSeller, Array $productSellerAddr , String $pid , string $p_price, String $productname){
            // Satın alan kişi bilgileri
      $buyer = new Buyer($productSeller);
      $address = new Address($productSellerAddr);
      $params = $this->shopier->getParams();
      $params->setWebsiteIndex(WebsiteIndex::SITE_1);
      $params->setBuyer($buyer);
      $params->setAddress($address);
      $params->setOrderData($pid, $p_price);
      $params->setProductData($productname, ProductType::DOWNLOADABLE_VIRTUAL);
      return $this;
    }

    public function setpaymentButton(){
      $renderer = $this->shopier->createRenderer(ButtonRenderer::class);
      $renderer->withStyle("padding:15px; color: #fff; background-color:#51cbb0; border:1px solid #fff; border-radius:7px")
      ->withText('Shopier İle Güvenli Öde');
      $this->shopier->goWith($renderer);
    }

    public function setRedirect(){
      $renderer = new AutoSubmitFormRenderer($shopier);
      $this->$shopier->goWith($renderer);
    }
    public function setPaymentResponse(){
      $shopierResponse =  ShopierResponse::fromPostData();

      if(!$shopierResponse->hasValidSignature('null')){
        return false;
      }
      return $shopierResponse->toArray();
    }
}
