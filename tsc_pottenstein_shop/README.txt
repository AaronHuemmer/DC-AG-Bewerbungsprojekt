TSC Pottenstein Fan‑Shop (PHP + MySQL + jQuery + LESS)
======================================================

Voraussetzungen
- XAMPP (Apache + MySQL/MariaDB + PHP)
- Internetzugang für jQuery-CDN (alternativ: jQuery lokal ablegen und den <script>-Tag in header.php anpassen)

Installation
1) Datenbank importieren
   - Starte XAMPP (Apache + MySQL).
   - Öffne http://localhost/phpmyadmin
   - Erstelle eine neue Datenbank namens tsc_shop (oder importiere direkt).
   - Importiere die Datei ./sql/database.sql
2) Dateien kopieren
   - Kopiere den Ordner "tsc_pottenstein_shop" nach: C:\xampp\htdocs\ (Windows) oder /Applications/XAMPP/htdocs/ (macOS)
3) Konfiguration prüfen
   - In config.php sind XAMPP-Standardwerte gesetzt (root / kein Passwort). Passe sie bei Bedarf an.
4) Shop aufrufen
   - http://localhost/tsc_pottenstein_shop/index.php

Struktur
- index.php         Startseite mit Teaser und Neuigkeiten
- products.php      Produktübersicht + Filter nach Kategorie
- product.php       Produktdetailseite + In-den-Warenkorb
- cart.php          Warenkorb (AJAX-Update mit jQuery)
- checkout.php      Kasse (Bestellung wird in DB gespeichert)
- thankyou.php      Bestellbestätigung
- cart_action.php   AJAX-Endpoint für Warenkorb
- assets/css        Kompilierte CSS-Datei (aus LESS abgeleitet)
- assets/less       Originale LESS-Quelle (styles.less)
- assets/js         app.js (jQuery-Logik)
- assets/img        Logo + Platzhalter-Bilder
- sql/database.sql  Schema + Beispieldaten

Hinweise
- LESS: Die Styles liegen als LESS (assets/less/styles.less) und als bereits kompilierte CSS (assets/css/styles.css) vor.
- jQuery: Wird per CDN geladen (header.php). Bei Bedarf lokal ersetzen.
- Sicherheit/Prod: Dies ist eine einfache Demo ohne vollständige Härtung (z. B. keine Benutzerverwaltung, keine Zahlung).