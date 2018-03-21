[{ assign var="shop"      value=$oEmailView->getShop() }]
[{ assign var="oViewConf" value=$oEmailView->getViewConfig() }]

[{block name="email_plain_ordershipped_sendemail"}]
[{ oxcontent ident="oxorderprocessedplainemail" }]
[{/block}]

[{block name="email_plain_ordershipped_infoheader"}]
[{ oxmultilang ident="ORDER_SHIPPED_TO" suffix="COLON" }]
[{/block}]

[{block name="email_plain_ordershipped_address"}]
[{if $order->oxorder__oxdellname->value }]
    [{ $order->oxorder__oxdelcompany->getRawValue() }]
    [{ $order->oxorder__oxdelfname->getRawValue() }] [{ $order->oxorder__oxdellname->getRawValue() }]
    [{ $order->oxorder__oxdelstreet->getRawValue() }] [{ $order->oxorder__oxdelstreetnr->value }]
    [{ $order->oxorder__oxdelstateid->value }]
    [{ $order->oxorder__oxdelzip->value }] [{ $order->oxorder__oxdelcity->getRawValue() }]
[{else}]
    [{ $order->oxorder__oxbillcompany->getRawValue() }]
    [{ $order->oxorder__oxbillfname->getRawValue() }] [{ $order->oxorder__oxbilllname->getRawValue() }]
    [{ $order->oxorder__oxbillstreet->getRawValue() }] [{ $order->oxorder__oxbillstreetnr->value }]
    [{ $order->oxorder__oxbillstateid->value }]
    [{ $order->oxorder__oxbillzip->value }] [{ $order->oxorder__oxbillcity->getRawValue() }]
[{/if}]
[{/block}]

[{block name="email_plain_ordershipped_oxordernr"}]
[{ oxmultilang ident="ORDER_NUMBER" suffix="COLON" }] [{ $order->oxorder__oxordernr->value }]
[{/block}]

[{block name="email_plain_ordershipped_orderarticles"}]
[{foreach from=$order->getOrderArticles(true) item=oOrderArticle}]
[{ $oOrderArticle->oxorderarticles__oxamount->value }] &nbsp;[{ $oOrderArticle->oxorderarticles__oxtitle->getRawValue() }] [{ $oOrderArticle->oxorderarticles__oxselvariant->getRawValue() }]
[{/foreach}]
[{/block}]

[{block name="email_plain_ordershipped_infofooter"}]
[{ oxmultilang ident="YOUR_TEAM" args=$shop->oxshops__oxname->getRawValue()}]
[{/block}]

[{block name="email_html_ordershipped_shipmenttrackingurl"}]
[{if $order->getShipmentTrackingUrl()}][{ oxmultilang ident="SHIPMENT_TRACKING" suffix="COLON" }] [{ $order->getShipmentTrackingUrl()}][{/if}]
[{/block}]

[{ oxcontent ident="oxemailfooterplain" }]