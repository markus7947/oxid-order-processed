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
 * Admin order overview manager.
 * Collects order overview information, updates it on user submit, etc.
 * Admin Menu: Orders -> Display Orders -> Overview.
 */
class all24_Order_Overview extends all24_Order_Overview_parent
{
	public function render()
    {
        $return = parent::render();
        return $return;
    }
	
	public function canResetProcessedDate()
    {
        $oOrder = oxNew( "oxorder" );
        $blCan = false;
        if ( $oOrder->load( $this->getEditObjectId() ) ) {
            $blCan = $oOrder->oxorder__oxstorno->value == "0" &&
                     !( $oOrder->oxorder__oxprocesseddate->value == "0000-00-00 00:00:00" || $oOrder->oxorder__oxprocesseddate->value == "-" );
        }
        return $blCan;
    }
	public function sendprocessedorder()
    {
        $oOrder = oxNew( "oxorder" );
        if ( $oOrder->load( $this->getEditObjectId() ) ) {
            $oOrder->oxorder__oxprocesseddate = new oxField(date("Y-m-d H:i:s", oxRegistry::get("oxUtilsDate")->getTime()));
            $oOrder->save();

            // #1071C
            $oOrderArticles = $oOrder->getOrderArticles();
            foreach ( $oOrderArticles as $sOxid => $oArticle ) {
                // remove canceled articles from list
                if ( $oArticle->oxorderarticles__oxstorno->value == 1 ) {
                    $oOrderArticles->offsetUnset( $sOxid );
                }
            }

            if (($blMail = oxRegistry::getConfig()->getRequestParameter("sendmail"))) {
                // send eMail
                $oEmail = oxNew( "oxemail" );
                $oEmail->sendProcessedMail( $oOrder );
            }
        }

    }
	
	public function resetprocessed()
    {
        $oOrder = oxNew( "oxorder" );
        if ( $oOrder->load( $this->getEditObjectId() ) ) {
            $oOrder->oxorder__oxprocesseddate->setValue( "0000-00-00 00:00:00" );
			            $oOrder->oxorder__oxsenddate->setValue( "0000-00-00 00:00:00" );


            $oOrder->save();
			
        }
    }
	
	
	
}
	
	