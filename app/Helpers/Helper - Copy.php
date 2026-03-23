<?php
namespace App\Helpers;
use Str;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\State;
use App\Models\Setting;
use App\Models\UpsShipment;
use App\Models\OrderDetails;
use App\Models\Order;



class Helper
{

    public static function getUpstoken(){

        $curl = curl_init();

        $payload = "grant_type=client_credentials";
        $Combineuserandpassword = env("UpsClientID") . ':' . env("UpsClientSecret");

        curl_setopt_array($curl, [
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/x-www-form-urlencoded",
            "Authorization: Basic " . base64_encode($Combineuserandpassword)
        ],
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_URL => env("Ups_Url")."/security/v1/oauth/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        // echo "<pre>";
        // print_r(json_decode($response));exit;

        curl_close($curl);

        if ($error) {
            return 0;
        } else {
            $responseArray = json_decode($response, true);

            if (isset($responseArray['response']['errors'])) {
                return 0;
            } else {
                if ($responseArray['status'] === 'approved') {
                    return $responseArray['access_token'];
                }
            }
        }

    }

    public static function getShipment($order_id){
        $accessToken = Helper::getUpstoken();
        if($accessToken!=0){

            $cart_item = \Cart::getContent();
            $product_array = array();
            foreach ($cart_item as $key => $cart_itemvalue) {
                $product_id = Str::before($cart_itemvalue->id, '_');
                $quantity = $cart_itemvalue->quantity;
                if (array_key_exists($product_id, $product_array)) {
                    $product_array[$product_id] += $quantity;
                } else {
                    $product_array[$product_id] = $quantity;
                }
            }

            $shipping_charge_data = session('shipping_charge_data');
            $costomer_data = session()->get('user_data');
            $from_address = Setting::first();


            $packageArray = array();
            $productArraykeys = array_keys($product_array);
            // dd($productArraykeys[0]);

            foreach ($product_array as $product_id => $quantity) {
                $product = Product::where('id', $product_id)->first();
                $length = ($product->productCategory->length * $quantity);
                $width = ($product->productCategory->width * $quantity);
                $height = ($product->productCategory->height * $quantity);
                $weight = ($product->productCategory->weight * $quantity);

                $packageArray[] = array(
                    "PackageWeight" => array(
                        "Weight" => "$weight",
                        "UnitOfMeasurement" => array(
                        "Description" => "desc",
                        "Code" => "LBS"
                        )
                    ),
                    "Dimensions" => array(
                        "Height" => "$height",
                        "Width" => "$width",
                        "Length" => "$length",
                        "UnitOfMeasurement" => array(
                        "Description" => "desc",
                        "Code" => "IN"
                        )
                    ),
                    "Packaging" => array(
                        "Description" => "desc",
                        "Code" => "02"
                    ),
                    "Description" => "desc"
                );
            }


            $version = "v1";
            $query = array(
            "additionaladdressvalidation" => "string"
            );

            $curl = curl_init();

            $payload = array(
                "ShipmentRequest" => array(
                    "Request" => array(
                    "RequestOption" => "nonvalidate",
                    "SubVersion" => "1701",
                    "TransactionReference" => array(
                        "CustomerContext" => ""
                    )
                    ),
                    "Shipment" => array(
                        // "Package" => array(
                        //     array(
                        //         "PackageWeight" => array(
                        //             "Weight" => "0.2",
                        //             "UnitOfMeasurement" => array(
                        //             "Description" => "desc",
                        //             "Code" => "LBS"
                        //             )
                        //         ),
                        //         "Dimensions" => array(
                        //             "Height" => "2",
                        //             "Width" => "2",
                        //             "Length" => "02",
                        //             "UnitOfMeasurement" => array(
                        //             "Description" => "desc",
                        //             "Code" => "IN"
                        //             )
                        //         ),
                        //         "Packaging" => array(
                        //             "Description" => "desc",
                        //             "Code" => "02"
                        //         ),
                        //         "Description" => "desc"
                        //     ),
                        //     array(
                        //         "PackageWeight" => array(
                        //             "Weight" => "0.2",
                        //             "UnitOfMeasurement" => array(
                        //             "Description" => "desc",
                        //             "Code" => "LBS"
                        //             )
                        //         ),
                        //         "Dimensions" => array(
                        //             "Height" => "1",
                        //             "Width" => "1",
                        //             "Length" => "01",
                        //             "UnitOfMeasurement" => array(
                        //             "Description" => "desc",
                        //             "Code" => "IN"
                        //             )
                        //         ),
                        //         "Packaging" => array(
                        //             "Description" => "desc",
                        //             "Code" => "02"
                        //         ),
                        //         "Description" => "desc"
                        //     )
                        // ),
                        "Package" => $packageArray,
                        "Description" => "UPS Premier",
                        "Shipper" => array(
                            "Name" => env('CompanyName'),
                            "AttentionName" => "",
                            "CompanyDisplayableName" => env('CompanyName'),
                            "TaxIdentificationNumber" => "",
                            "Phone" => array(
                            "Number" => env('PhoneNumber'),
                            "Extension" => "1"
                            ),
                            "ShipperNumber" => env('UpsAccountnumber'),
                            "FaxNumber" => "",
                            "EMailAddress" => env('EMailAddress'),
                            "Address" => array(
                            "AddressLine" => array(
                                $from_address->from_address,
                            ),
                            "City" => $from_address->from_city,
                            "StateProvinceCode" => $from_address->from_state,
                            "PostalCode" => $from_address->from_zip,
                            "CountryCode" => "US"
                            )
                        ),
                        "ShipTo" => array(
                            "Name" => $costomer_data['s_name'],
                            "AttentionName" => "",
                            "CompanyDisplayableName" => "",
                            "TaxIdentificationNumber" => "",
                            "Phone" => array(
                            "Number" => "1234567890",
                            "Extension" => "1"
                            ),
                            "FaxNumber" => "",
                            "EMailAddress" => $costomer_data['email'],
                            "Address" => array(
                            "AddressLine" => array(
                                "AddressLine"
                            ),
                            "City" => $costomer_data['s_city'],
                            "StateProvinceCode" => $costomer_data['s_state'],
                            "PostalCode" => $costomer_data['s_zipcode'],
                            "CountryCode" => "US",
                            "ResidentialAddressIndicator" => "Y"
                            )
                        ),
                        "ShipFrom" => array(
                            "Name" => env('CompanyName'),
                            "AttentionName" => "",
                            "CompanyDisplayableName" => env('CompanyName'),
                            "TaxIdentificationNumber" => "",
                            "Phone" => array(
                            "Number" => env('PhoneNumber'),
                            "Extension" => "1"
                            ),
                            "FaxNumber" => "",
                            "Address" => array(
                            "AddressLine" => array(
                                $from_address->from_address
                            ),
                            "City" => $from_address->from_city,
                            "StateProvinceCode" => $from_address->from_state,
                            "PostalCode" => $from_address->from_zip,
                            "CountryCode" => "US"
                            ),
                            "EMailAddress" => env('EMailAddress'),
                        ),
                        "PaymentInformation" => array(
                            "ShipmentCharge" => array(
                            "Type" => "01",
                            "BillShipper" => array(
                                "AccountNumber" => env('UpsAccountnumber'),
                            )
                            )
                        ),
                        "Service" => array(
                            "Code" => $shipping_charge_data['service_type'],
                            "Description" => "desc"
                        )
                    ),
                    "LabelSpecification" => array(
                        "LabelImageFormat" => array(
                            "Code" => "ZPL",
                            "Description" => "ZPL"
                        ),
                        "HTTPUserAgent" => "Mozilla/4.5",
                        "LabelStockSize" => array(
                            "Height" => "6",
                            "Width" => "4"
                        )
                    )
                )
            );

            // dd($payload);



            curl_setopt_array($curl, [
                CURLOPT_HTTPHEADER => [
                    "Authorization: Bearer " . $accessToken,
                    "Content-Type: application/json",
                    "transId: string",
                    "transactionSrc: testing"
                ],
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_URL => env('Ups_Url')."/api/shipments/" . $version . "/ship?" . http_build_query($query),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            // echo "<pre>";
            // print_r(json_decode($response));exit;

            curl_close($curl);

            if ($error) {
            echo "cURL Error #:" . $error;
            } else {
            // echo $response;


                // Assuming $shipmentResponse is the stdClass object containing the data

                $shipmentResponse = json_decode($response);
                // if (isset($shipmentResponse->ShipmentResponse->ShipmentResults->PackageResults)) {
                //     $packageResults = $shipmentResponse->ShipmentResponse->ShipmentResults->PackageResults;
                //     foreach ($packageResults as $index => $packageResult) {
                //         $trackingNumber = $packageResult->TrackingNumber;
                //         $baseServiceCharge = $packageResult->BaseServiceCharge->MonetaryValue;
                //         $serviceOptionsCharges = $packageResult->ServiceOptionsCharges->MonetaryValue;
                //         $shippingLabelFormat = $packageResult->ShippingLabel->ImageFormat->Code;
                //         $graphicImage = $packageResult->ShippingLabel->GraphicImage;
                //         $itemizedCharges = $packageResult->ItemizedCharges->MonetaryValue;

                //         UpsShipment::create([
                //             'order_id'=>$order_id,
                //             'product_id'=>$productArraykeys[$index],
                //             'order_id'=>$order_id,
                //             'trackingNumber'=>$trackingNumber,
                //             'imageFormat_code'=>$shippingLabelFormat,
                //             'graphicImage'=>$graphicImage,
                //             'current_status'=>'Label Created',
                //         ]);

                //         OrderDetails::where('order_id', $order_id)->where('product_id', $productArraykeys[$index])->update([
                //             'trackingNumber'=>$trackingNumber,
                //             'graphicImage'=>$graphicImage,
                //             'current_status'=>'Label Created',
                //         ]);
                //     }
                // } else {
                //     echo "No PackageResults found in the response.\n";
                // }


                if (isset($shipmentResponse->ShipmentResponse->ShipmentResults->PackageResults)) {
                    $packageResults = $shipmentResponse->ShipmentResponse->ShipmentResults->PackageResults;
                    $shipmentIdentificationNumber = $shipmentResponse->ShipmentResponse->ShipmentResults->ShipmentIdentificationNumber;

                    if (is_array($packageResults)) {
                        // It's an array, so loop through each package
                        foreach ($packageResults as $index => $packageResult) {
                            Helper::processPackageResult($index, $packageResult, $order_id, $productArraykeys, $shipmentIdentificationNumber);
                        }
                    } elseif (is_object($packageResults)) {
                        // It's an object, so process the single package
                        Helper::processPackageResult(0, $packageResults, $order_id, $productArraykeys, $shipmentIdentificationNumber);
                    } else {
                        echo "Unexpected type for PackageResults.\n";
                    }
                } else {
                    echo "No PackageResults found in the response.\n";
                }



            }




        }

    }


    public static function processPackageResult($index, $packageResult, $order_id, $productArraykeys, $shipmentIdentificationNumber) {
        // Accessing data for each package
        $trackingNumber = $packageResult->TrackingNumber;
        $baseServiceCharge = $packageResult->BaseServiceCharge->MonetaryValue;
        $serviceOptionsCharges = $packageResult->ServiceOptionsCharges->MonetaryValue;
        $shippingLabelFormat = $packageResult->ShippingLabel->ImageFormat->Code;
        $graphicImage = $packageResult->ShippingLabel->GraphicImage;
        $itemizedCharges = $packageResult->ItemizedCharges->MonetaryValue;


        UpsShipment::create([
            'order_id'=>$order_id,
            'product_id'=>$productArraykeys[$index],
            'order_id'=>$order_id,
            'trackingNumber'=>$trackingNumber,
            'imageFormat_code'=>$shippingLabelFormat,
            'graphicImage'=>$graphicImage,
            'current_status'=>'Shipment Ready for UPS',
            'shipmentIdentificationNumber'=>$shipmentIdentificationNumber,
        ]);

        OrderDetails::where('order_id', $order_id)->where('product_id', $productArraykeys[$index])->update([
            'trackingNumber'=>$trackingNumber,
            'graphicImage'=>$graphicImage,
            'current_status'=>'Shipment Ready for UPS',
        ]);

        Order::where('id', $order_id)->update([
            'current_status'=>'Shipment Ready for UPS',
        ]);


    }



}
