# oxid-order-processed

[German below]

## Description

This module extends OXID eShop administration panel at _"Administer orders" -> "Orders"_ with the possibility to send a message to clients if his order is processed.

## Installation

1. Extend the table _"oxorder"_ in the database with the following SQL statement (OXID admin panel -> _Services -> Tools -> SQL_):
ALTER TABLE `oxorder` ADD `OXPROCESSEDDATE` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `OXSENDDATE`;
2. Extend the table _"oxshops"_ in the database with the following SQL statement ((OXID admin panel -> _Services -> Tools -> SQL_):
ALTER TABLE `oxshops` ADD `OXPROCESSEDSUBJECT` VARCHAR(255) NOT NULL DEFAULT 'Your Order is beeing processed' AFTER `OXSENDEDNOWSUBJECT`;
3. Generate a CMS page with the IDENT _“oxorderprocessedemail”_ with the following content (example):
`Hello, [{ $order->oxorder__oxbillsal->value|oxmultilangsal }] [{ $order->oxorder__oxbillfname->value }] [{ $order->oxorder__oxbilllname->value }],</br>Thanks for your order!
</br>Your purchase is about to be proceeded, and we'll inform you with a seperate e-mail, once the shipment left our stock.`
3. Copy the content of the folder _"copy_this"_ into the document root of your shop and activate the module via the admin panel.

-----

## Beschreibung

Das Modul erweitert den OXID eShop - Admininstrationsbereich unter _"Bestellungen verwalten -> Bestellungen"_ um die Möglichkeit, den Kunden per E-Mail zu
informieren, wenn seine Bestellung bearbeitet wird.

## Installation

1. In der Datenbank muss die Tabelle _"oxorder"_ erweitert werden (im OXID Administrationsbereich unter _"Service -> Tools -> Sql ausführen"_):
ALTER TABLE `oxorder` ADD `OXPROCESSEDDATE` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `OXSENDDATE`;
In der Datenbank muss die Tabelle _"oxshops"_ erweitert werden (im OXID Administrationsbereich unter _"Service -> Tools -> Sql ausführen"_):
ALTER TABLE `oxshops` ADD `OXPROCESSEDSUBJECT` VARCHAR(255) NOT NULL DEFAULT 'Ihre Bestellung wird bearbeitet' AFTER `OXSENDEDNOWSUBJECT`;

2. Erstelle eine CMS-Seite mit der IDENT _“oxorderprocessedemail”_ mit z.B. folgendem Inhalt:  
`Guten Tag, [{ $order->oxorder__oxbillsal->value|oxmultilangsal }] [{ $order->oxorder__oxbillfname->value }] [{ $order->oxorder__oxbilllname->value }],</br>Wir danken für Ihre Bestellung.</br>Diese befindet sich in Bearbeitung, und wir informieren Sie in einer gesonderten E-Mail, sobald sie unser Lager verlassen hat.`
3. Kopiere den Inhalt aus dem Ordner _"copy_this"_ in das root-Verzeichnis des Shops und aktiviere das Modul über den Admin-Bereich.
