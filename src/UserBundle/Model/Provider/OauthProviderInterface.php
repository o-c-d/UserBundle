<?php

namespace Ocd\UserBundle\Model\Provider ;


interface OauthProviderInterface {
    
	
	/**
     * Get name of service provider (Facebook, Google...)
     *
     * @return string name
     */
    public function getProviderName();
	
	/**
     * Get route for connect with oauth
     *
     * @return string route
     */
    public function getConnectRoute();
	
	/**
     * Get icon patth
     *
     * @return string icon_path
     */
    public function getIconPath();
	
	/**
     * Get logo patth
     *
     * @return string logo_path
     */
    public function getLogoPath();
	
	/**
	 * Get all accounts from a single User Id
	 * 
	 * @param integer $user_id
	 * 
	 * @return array $accounts
	 */
	public function getAccountsByUserId($user_id);
	
	/**
	 * Get all emails from a single User Id
	 * 
	 * @param integer $user_id
	 * 
	 * @return array $emails
	 */
	public function getEmailsByUserId($user_id);
	
	/**
	 * Get all pictures from a single User Id
	 * 
	 * @param integer $user_id
	 * 
	 * @return array $pictures
	 */
	public function getPicturesByUserId($user_id);
	
	
}