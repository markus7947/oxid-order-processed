# oxid-order-processed

Das Modul erweitert das Backend unter "Bestellungen verwalten - Bestellungen" um die Möglichkeit den Kunden per E-mail zu
informieren wenn seine Bestellung bearbeitet wird.

INSTALLATION:

In der Datenbank muss die Tabelle "oxorder" erweitert werden (im Oxid Backend unter "Service - Tools - Sql ausführen"):

_______________________________________________________________________________________________________________________
ALTER TABLE oxorder ADD OXPROCESSEDDATE DATETIME NOT NULL DEFAULT ‘0000-00-00 00:00:00’ AFTER OXSENDDATE
_______________________________________________________________________________________________________________________

und es muss eine CMS-Seite mit der IDENT “oxorderprocessedemail” erstellt werden in der z.B. das stehen kann:

_______________________________________________________________________________________________________________________
Guten Tag, [{ $order->oxorder__oxbillsal->value|oxmultilangsal }] [{ $order->oxorder__oxbillfname->value }] [{ $order->oxorder__oxbilllname->value }],
</br>
Wir danken für Ihre Bestellung.
</br>
Diese befindet sich in Bearbeitung und wir informieren Sie in einer gesonderten Mail, sobald sie unser Lager verlassen hat.
_______________________________________________________________________________________________________________________

Danach den Inhalt aus dem "copy_this" Ordner in das root Verzeichnis des Shops kopieren und das Modul aktivieren.
