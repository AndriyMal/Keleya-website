<?php


class userManager
{
    public function getUser($token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://app-stage.keleya.de/api/V4/user",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: " . $token,
                "cache-control: no-cache",
                "postman-token: fd7bbe08-9528-cd2c-27b6-74c41737bc57"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }
    }

    public function updateUser($token, $newUserData)
    {
        $userJson = json_encode($newUserData);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://app-stage.keleya.de/api/V4/user",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => $userJson,
            CURLOPT_HTTPHEADER => array(
                "authorization: " . $token,
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: dd9eb816-d677-657a-2be2-4d0fdfedc932"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
