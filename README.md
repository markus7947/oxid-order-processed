# oxid-order-processed

## Description

Das Modul erweitert den OXID eShop - Admininstrationsbereich unter _"Bestellungen verwalten -> Bestellungen"_ um die Möglichkeit, den Kunden per E-Mail zu
informieren, wenn seine Bestellung bearbeitet wird.

## INSTALLATION:

1. In der Datenbank muss die Tabelle "oxorder" erweitert werden (im Oxid Backend unter "Service - Tools - Sql ausführen"):  
`ALTER TABLE oxorder ADD OXPROCESSEDDATE DATETIME NOT NULL DEFAULT ‘0000-00-00 00:00:00’ AFTER OXSENDDATE`
2. Erstelle eine CMS-Seite mit der IDENT _“oxorderprocessedemail”_ mit z.B. folgendem Inhalt:  
`Guten Tag, [{ $order->oxorder__oxbillsal->value|oxmultilangsal }] [{ $order->oxorder__oxbillfname->value }] [{ $order->oxorder__oxbilllname->value }],
</br>
Wir danken für Ihre Bestellung.
</br>
Diese befindet sich in Bearbeitung und wir informieren Sie in einer gesonderten Mail, sobald sie unser Lager verlassen hat.`
3. Kopiere den Inhalt aus dem Ordner _"copy_this"_ in das root-Verzeichnis des Shops und aktiviere das Modul über den Admin-Bereich.