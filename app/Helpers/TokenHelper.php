<?php

namespace App\Helpers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class TokenHelper 
{

    /**
     * 
     */
    private $signer;

    /**
     * Initialization
     */
    public function __construct()
    {
        $this->signer = new Sha256();
    }

    /**
     * Create a new JWT token
     * @author tvarghese
     *
     * @param  string  $user_id
     * @return string   JWT Token
     */
    public function createAppToken($mobile_number)
    {
        $time = time();
        return (string)(new Builder())->issuedBy(config('jwt.issuedBy'))
            ->permittedFor(config('jwt.permittedFor'))
            ->identifiedBy(config('jwt.identifiedBy'), true)
            ->issuedAt($time)
            ->expiresAt($time + config('jwt.expiredAfter'))
            ->withClaim('lumen', ['app_mobile_number' => $mobile_number])
            ->getToken($this->signer, new Key(config('jwt.signature')));
    }

    /**
     * Create a new JWT token
     * @author tvarghese
     *
     * @param  string  $user_id
     * @return string   JWT Token
     */
    public function createWebToken($user_id = null, $school_id = '', $role_permissions = '')
    {
        $time = time();
        return (string)(new Builder())->issuedBy(config('jwt.issuedBy'))
            ->permittedFor(config('jwt.permittedFor'))
            ->identifiedBy(config('jwt.identifiedBy'), true)
            ->issuedAt($time)
            ->expiresAt($time + config('jwt.expiredAfter'))
            ->withClaim('lumen', [ 
                'user_id'           => $user_id,
                'school_id'         => $school_id,
                'role_permissions'  => $role_permissions
            ])
            ->getToken($this->signer, new Key(config('jwt.signature')));
    }

    /**
     * Verify the given token
     * @author tvarghese
     *
     * @param   string  $token
     * @return  bool    true if the token gets verified; else false will be returned
     */
    public function verifyToken($token)
    {
        try
        {
            return ((new Parser())->parse((string) $token))->verify($this->signer, config('jwt.signature'));
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    /**
     * Check if the token is expired or not
     * @author tvarghese <email@email.com>
     *
     * @param   string  $token
     * @return  boolean true if the token is not expired
     */
    public function isTokenNotExpired($token)
    {
        try
        {
            $data = (new ValidationData());
            $data->setIssuer(config('jwt.issuedBy'));
            $data->setAudience(config('jwt.permittedFor'));
            $data->setId(config('jwt.identifiedBy'));
            $data->setCurrentTime(time());
            return (new Parser())->parse((string) $token)->validate($data);
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    /**
     * To get user id from token
     * 
     * @return  
     */
    public function getTokenClaim($claim)
    {
        $headers    = array_change_key_case(getallheaders(), CASE_LOWER);
        if( isset($headers['authorization']) )
        {
            $token  = explode(" ", $headers['authorization']);
            return ((new Parser())->parse((string) $token[1]))->getClaim($claim);
        }
        return false;
    }

}