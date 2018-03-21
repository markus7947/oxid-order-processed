
        <form name="sendprocessedorder" id="sendprocessedorder" action="[{ $oViewConf->getSelfLink() }]" method="post" >
        [{ $oViewConf->getHiddenSid() }]
        <input type="hidden" name="cl" value="order_overview">
        <input type="hidden" name="fnc" value="sendprocessedorder">
        <input type="hidden" name="oxid" value="[{ $oxid }]">
        <input type="hidden" name="editval[oxorder__oxid]" value="[{ $oxid }]">
            <tr>
                <td class="edittext">
                </td>
                <td class="edittext" style="border : 1px #A9A9A9; border-style : solid solid solid solid; padding-top: 5px; padding-bottom: 5px; padding-right: 5px; padding-left: 5px;">
                    <input type="submit" class="edittext" name="save" value="&nbsp;&nbsp;[{ oxmultilang ident="GENERAL_NOWSENDPROCESSED" }]&nbsp;&nbsp;" [{ $readonly }]><br>
                    [{ oxmultilang ident="GENERAL_SENDPROCESSEDEMAIL" }] <input class="edittext" type="checkbox" name="sendmail" value='1' [{ $readonly }]>
                </td>
            </tr>
            </form>
			<tr>
                <td class="edittext">
                </td>
                <td class="edittext" valign="bottom"><br>
                [{ if $oView->canResetProcessedDate() }]
                    <b>[{ oxmultilang ident="GENERAL_PROCESSEDON" }]</b><b>[{$edit->oxorder__oxprocesseddate|oxformdate:'datetime':true }]</b>
                [{else}]
                    <b>[{ oxmultilang ident="GENERAL_NOTPROCESSED" }]</b>
                [{/if}]
                </td>
            </tr>
           [{ if $oView->canResetProcessedDate() }]
        <form name="resetprocessed" id="resetprocessed" action="[{ $oViewConf->getSelfLink() }]" method="post">
        [{ $oViewConf->getHiddenSid() }]
        <input type="hidden" name="cl" value="order_overview">
        <input type="hidden" name="fnc" value="resetprocessed">
        <input type="hidden" name="oxid" value="[{ $oxid }]">
        <input type="hidden" name="editval[oxorder__oxid]" value="[{ $oxid }]">
        [{block name="admin_order_overview_reset_form3"}]
            <tr>
                <td class="edittext">
                </td>
                <td class="edittext"><br>
                    <input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SETBACKPROCESSEDTIME" }]" [{ $readonly }]>
                </td>
            </tr>
        [{/block}]
        </form>
        [{/if}]
		        <form name="sendorder" id="sendorder" action="[{ $oViewConf->getSelfLink() }]" method="post">
        [{ $oViewConf->getHiddenSid() }]
        <input type="hidden" name="cl" value="order_overview">
        <input type="hidden" name="fnc" value="sendorder">
        <input type="hidden" name="oxid" value="[{ $oxid }]">
        <input type="hidden" name="editval[oxorder__oxid]" value="[{ $oxid }]">
        [{block name="admin_order_overview_send_form2"}]
            <tr>
                <td class="edittext">
                </td>
                <td class="edittext" style="border : 1px #A9A9A9; border-style : solid solid solid solid; padding-top: 5px; padding-bottom: 5px; padding-right: 5px; padding-left: 5px;">
                    <input type="submit" class="edittext" name="save" value="&nbsp;&nbsp;[{ oxmultilang ident="GENERAL_NOWSEND" }]&nbsp;&nbsp;" [{ $readonly }]><br>
                    [{ oxmultilang ident="GENERAL_SENDEMAIL" }] <input class="edittext" type="checkbox" name="sendmail" value='1' [{ $readonly }]>
                </td>
            </tr>
            </form>
            <tr>
                <td class="edittext">
                </td>
                <td class="edittext" valign="bottom"><br>
                [{if $oView->canResetShippingDate() }]
                    <b>[{ oxmultilang ident="GENERAL_SENDON" }]</b><b>[{$edit->oxorder__oxsenddate|oxformdate:'datetime':true }]</b>
                [{else}]
                    <b>[{ oxmultilang ident="GENERAL_NOSENT" }]</b>
                [{/if}]
                </td>
            </tr>
        [{/block}]
       
       