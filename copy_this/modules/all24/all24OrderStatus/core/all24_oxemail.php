<?php
/**
 * This file is part of OXID eShop Community Edition.
 *
 * OXID eShop Community Edition is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eShop Community Edition is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2016
 * @version   OXID eShop CE
 */
/**
 * Includes PHP mailer class.
 */
//require oxRegistry::getConfig()->getConfigParam('sCoreDir') . "/phpmailer/class.phpmailer.php";
//require oxRegistry::getConfig()->getConfigParam('sCoreDir') . "/phpmailer/class.smtp.php";


/**
 * Mailing manager.
 * Collects mailing configuration, other parameters, performs mailing functions
 * (newsletters, ordering, registration emails, etc.).
 */
class all24_oxemail extends all24_oxemail_parent
{
  /**
     * Send order notification mail template
     *
     * @var string
     */
	 
    protected $_sProcessedTemplate = "processed_html.tpl";

    /**
     * Send order notification plain mail template
     *
     * @var string
     */
    protected $_sProcessedTemplatePlain = "processed_plain.tpl";

	
	public function sendProcessedMail( $oOrder, $sSubject = null )
    {
        $myConfig = $this->getConfig();

        $iOrderLang = (int) ( isset( $oOrder->oxorder__oxlang->value ) ? $oOrder->oxorder__oxlang->value : 0 );

        // shop info
        $oShop = $this->_getShop( $iOrderLang );

        //set mail params (from, fromName, smtp)
        $this->_setMailParams( $oShop );

        //create messages
        //$oLang = oxLang::getInstance();
		$oLang = oxRegistry::getLang();  
        $oSmarty = $this->_getSmarty();
        $this->setViewData( "order", $oOrder );
        $this->setViewData( "shopTemplateDir", $myConfig->getTemplateDir(false) );

        if ( $myConfig->getConfigParam( "bl_perfLoadReviews" ) ) {
            $this->setViewData( "blShowReviewLink", true );
            //deprecated var
            $oUser = oxNew( 'oxuser' );
            $this->setViewData( "reviewuserhash", $oUser->getReviewUserHash($oOrder->oxorder__oxuserid->value) );
        }

        // Process view data array through oxoutput processor
        $this->_processViewArray();

        // dodger #1469 - we need to patch security here as we do not use standard template dir, so smarty stops working
        $aStore['INCLUDE_ANY'] = $oSmarty->security_settings['INCLUDE_ANY'];
        //V send email in order language
        $iOldTplLang = $oLang->getTplLanguage();
        $iOldBaseLang = $oLang->getTplLanguage();
        $oLang->setTplLanguage( $iOrderLang );
        $oLang->setBaseLanguage( $iOrderLang );

        $oSmarty->security_settings['INCLUDE_ANY'] = true;
        // force non admin to get correct paths (tpl, img)
        $myConfig->setAdminMode( false );
        $this->setBody( $oSmarty->fetch( $this->_sProcessedTemplate ) );
        $this->setAltBody( $oSmarty->fetch( $this->_sProcessedTemplatePlain ) );
        $myConfig->setAdminMode( true );
        $oLang->setTplLanguage( $iOldTplLang );
        $oLang->setBaseLanguage( $iOldBaseLang );
        // set it back
        $oSmarty->security_settings['INCLUDE_ANY'] = $aStore['INCLUDE_ANY'] ;

        //Sets subject to email
        $this->setSubject( ( $sSubject !== null ) ? $sSubject : $oShop->oxshops__oxprocessedsubject->getRawValue() );

        $sFullName = $oOrder->oxorder__oxbillfname->getRawValue() . " " . $oOrder->oxorder__oxbilllname->getRawValue();

        $this->setRecipient( $oOrder->oxorder__oxbillemail->value, $sFullName );
        $this->setReplyTo( $oShop->oxshops__oxorderemail->value, $oShop->oxshops__oxname->getRawValue() );

        return $this->send();
    }

} 