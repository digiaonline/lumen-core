<?php namespace Nord\Lumen\Core\App;

use Nord\Lumen\OAuth2\Contracts\OAuth2Service;

trait AuthenticatesUsers
{

    /**
     * @var OAuth2Service
     */
    private $oAuth2Service;


    /**
     * @return OAuth2Service
     */
    private function getOAuth2Service()
    {
        return $this->oAuth2Service;
    }


    /**
     * @param OAuth2Service $oAuth2Service
     */
    private function setOAuth2Service($oAuth2Service)
    {
        $this->oAuth2Service = $oAuth2Service;
    }
}
