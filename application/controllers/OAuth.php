<?php
// vim: foldmethod=marker

/* Generic exception class
 */
/*class OAuthException extends Exception {
  // pass
}*/


/**
 * A class for implementing a Signature Method
 * See section 9 ("Signing Requests") in the spec
 */
abstract class OAuthSignatureMethod {
  /**
   * Needs to return the name of the Signature Method (ie HMAC-SHA1)
   * @return string
   */
  abstract public function get_name();

  /**
   * Build up the signature
   * NOTE: The output of this function MUST NOT be urlencoded.
   * the encoding is handled in OAuthRequest when the final
   * request is serialized
   * @param OAuthRequest $request
   * @param OAuthConsumer $consumer
   * @param OAuthToken $token
   * @return string
   */
  abstract public function build_signature($request, $consumer, $token);

  /**
   * Verifies that a given signature is correct
   * @param OAuthRequest $request
   * @param OAuthConsumer $consumer
   * @param OAuthToken $token
   * @param string $signature
   * @return bool
   */
  public function check_signature($request, $consumer, $token, $signature) {
    $built = $this->build_signature($request, $consumer, $token);
    return $built == $signature;
  }
}

/**
 * The HMAC-SHA1 signature method uses the HMAC-SHA1 signature algorithm as defined in [RFC2104] 
 * where the Signature Base String is the text and the key is the concatenated values (each first 
 * encoded per Parameter Encoding) of the Consumer Secret and Token Secret, separated by an '&' 
 * character (ASCII code 38) even if empty.
 *   - Chapter 9.2 ("HMAC-SHA1")
 */
class OAuthSignatureMethod_HMAC_SHA1 extends OAuthSignatureMethod {
  function get_name() {
    return "HMAC-SHA1";
  }

  public function build_signature($request, $consumer, $key) {
    return base64_encode(hash_hmac('sha1', $request, $key, true));
  }
}



/*$parameter = array("auth_id" => 'woundapp',
                   "secret_key" => 'woundapp',
                   "auth_url" => 'http://localhost/woundapp/');
				   
				   
echo OAuthSignatureMethod_HMAC_SHA1::build_signature(json_encode($parameter),'EO17DFFK7Y+FXPE6aN+i5g==','78aK8KzRVnrY93mdFzPikRBUsh4knPGNjlQ72kOkLwxXnSgjJdnVojim5CHVl8IO');*/


?>
