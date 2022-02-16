<!DOCTYPE HTML>
<Html lang="en">
<Head>
    <title>payment example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
</Head>
<Body>
    
<div class="card" style="width: 18rem;">
    <img src="images/laptophp.jpg" class="card-img-top" alt="product_img">
    <div class="card-body">
        <h5 class="card-title">laptop HP</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
        <a href="#" class="btn btn-primary">Go payment</a>
    </div>
</div>
</Body>
</Html>

<?php

//general fun
    function consumeWebservice($path, $type = "json", $data = "")
    {
        if ($type == "json") {
            $jsondata = file_get_contents($path . "&json=true");
            $data = json_decode($jsondata, true);
        } elseif ($type == "payload") {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $path);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // Set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            // Return response instead of outputting
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Execute the POST request
            $result  = curl_exec($ch);
            $info = curl_getinfo($ch);
            $data = json_decode($result , true);
            // Close cURL resource
            curl_close($ch);
        } elseif ($type == "post") {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $path);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            // Return response instead of outputting
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Execute the POST request
            $result  = curl_exec($ch);
            $info = curl_getinfo($ch);
            $data = json_decode($result , true);
            // Close cURL resource
            curl_close($ch);
        } else {
            $data = simplexml_load_file($path);
        }
        //System::printFormat($info);
        return $data;
    }
    $url = "https://newsapi.org/v2/everything?q=apple&from=2022-02-13&to=2022-02-13&sortBy=popularity&apiKey=1665ee67176f4a0cb3e291b9c80adacc";
    //print_r(consumeWebservice($url)['status']);
    echo "first";
    function curlPostRequest(){
        //$dataArr = array('Id' => 1, 'Customer' => 'Jhon Smith', 'Quantity' => 10, 'Price' => 20.00);
        $url = "https://secure-egypt.paytabs.com/payment/request ";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Content-Type: application/json",
            "Accept: application/json",
            "authorization:SMJN2GHDM2-JDB2KMKMN2-NZZHLZ69GD",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = '{
                    "profile_id": 89380,
                    "tran_type": "sale",
                    "tran_class": "ecom" ,
                    "cart_id":"4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca",
                    "cart_description": "Dummy Order 35925502061445345",
                    "cart_currency": "EGP",
                    "cart_amount": 46.17,
                    "callback": "https://qbizns.com/paytabs-php/pages/request.php",
                    "return": "https://qbizns.com/paytabs-php/pages/request.php"
                }';
        //var_dump($data, $dataArr);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $resp = curl_exec($curl);
        //var_dump($resp);
        curl_close($curl);
        return $resp;
    }
    echo '<br/>';
    $resData = curlPostRequest();
    //$response = json_decode($resData,true);
    var_dump($resData);
    //print_r($response['redirect_url']);
    //header('Location: '.$response['redirect_url']);

/*
$url = "https://newsapi.org/v2/everything?q=apple&from=2022-02-13&to=2022-02-13&sortBy=popularity&apiKey=1665ee67176f4a0cb3e291b9c80adacc";
$sender = curl_init();
curl_setopt($sender,CURLOPT_RETURNTRANSFER,true);
curl_setopt($sender,CURLOPT_URL,$url);
//print_r(curl_exec($sender));
curl_close($sender);




*/
?>