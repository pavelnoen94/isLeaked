<?php 
function isLeaked($password){
  
  // Get checksum prefix of the password that is going to be sent
  $checkSum = strtoupper(sha1($password));
  $checkSumPrefix = substr($checkSum, 0,5);
  
  // setup curl
  $curl = curl_init();
  $url = "https://api.pwnedpasswords.com/range/".$checkSumPrefix;
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_FAILONERROR, true);
  if(curl_errno($curl)){
    print(curl_errno($curl)."<br>");
    print(curl_error($curl));
    curl_close($curl);
    return -1;
  }
  
  // excecute Curl and get the response
  $response = curl_exec($curl);
  if(!$response){
    return -1; // error. No response. Return
  }
  
  // close the connection since it's not needed
  curl_close($curl);
  
  // response will return hashes without prefix. We need to remove it as well to compare
  $checkSumPostFix = substr($checkSum,5,strlen($checkSum)-5);
  
  // Find matching hashes
  $position = strpos($response, $checkSumPostFix);
  
    if($position === false){
      // password is not found
      return 0;
    }
    
    // Split response into arrays
    $structuredResponseWithWhiteSpace = preg_split('[\s]', $response);
    
    $structuredResponse = array();
    // reg_split detects two whitespaces per line so every second line is empty
    for($i = 0; $i < count($structuredResponseWithWhiteSpace); $i += 2)
    {
      array_push($structuredResponse,$structuredResponseWithWhiteSpace[$i]);
    }
    
    for ($i=0; $i < count($structuredResponse); $i++)
    {
      if(substr($structuredResponse[$i],0,35) == $checkSumPostFix)
      {
        // Password has been leaked. Return the number of times it has been leaked
        return $timesLeaked = substr($structuredResponse[$i],36);
      }
    }
  return 0; // password has never been leaked
}

$password = "correcthorsebatterystaple";
print(isLeaked($password));



 ?>

