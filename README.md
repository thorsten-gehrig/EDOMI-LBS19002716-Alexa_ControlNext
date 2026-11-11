# EDOMI LBS 19002716 – Alexa ControlNext

EDOMI-Logikbaustein zur Steuerung von Amazon-Echo-Geräten ohne Sprachbefehl:
Wiedergabe, Lautstärke, Ansagen (`Alexa.Speak`/`AlexaAnnouncement`), Multiroom,
Bluetooth, Routinen, Alarme sowie Actionable Notifications über einen eigenen
Alexa-Skill.

* **LBS-Nummer:** 19002716
* **Version:** 4.0.0 (vollständige Neuimplementierung) als Ersatz für 19000809
* **Datei:** `19002716_lbs.php`

Die **Ein- und Ausgänge sind unverändert** (Nummern, Typen und Bedeutung
identisch) – bestehende Logiken laufen ohne Anpassung weiter.

## Inhalt

* zentraler HTTP-Client (eine Stelle für cURL, Cookies, Header, Timeouts)
* getrennte Klassen für Transport (`AcxHttpClient`), Anmeldung (`AcxSession`),
  Gerät (`AcxEchoDevice`), Befehle (`AlexaControl`) und Daemon (`AcxDaemon`)
* Login ausschließlich über Refresh-Token
* automatische Wiederholung bei HTTP 429 (Amazon-Rate-Limit) inkl. Drosselung
* sofortiger Statusabruf nach dem Start (A3–A13 bleiben nicht mehr leer)

## Voraussetzungen

* EDOMI mit PHP >= 5.4 und dem Paket `php-process` (posix/sysvmsg)
* **Refresh-Token** im Eingang E57. Erzeugen z. B. mit
  https://github.com/adn77/alexa-cookie-cli
* nur für Actionable Notifications (E55/E56): OAuth2-Server und die Scripte
  aus dem LBS-Archiv

## Installation

1. LBS-Bibliothek → Import → `19002716_lbs.php` auswählen
2. Baustein in eine Logikseite ziehen
3. E2 (Log-Level) auf `8` (debug) für den ersten Start
4. E3 (E-Mail), E5 (Land) und E57 (Refresh-Token) setzen
5. E1 auf `1` → Daemon startet; E10 wählt das zu steuernde Echo

Nach einem Update der Datei den Daemon neu starten (E1 einmal `0`, dann `1`,
oder E37 = 1), damit der neue Code im EXEC-Prozess aktiv wird.

## Eingänge (Kurzfassung)

| Eingang | Bedeutung |
|---|---|
| E1 | 1 = starten, 0 = stoppen |
| E2 | Log-Level 0–8 |
| E3 | Amazon-Konto (nur noch Name der Cookie-Datei) |
| E4 | **Dummy** – Passwort wird nicht mehr benötigt |
| E5 | Land `DE` oder `US` |
| E6–E9 | manueller Modus: Gerät, Löschen, Cookie, CSRF |
| E10 | Name des Echos (wie in der Alexa-App) |
| E11–E19 | Lautstärke, Play, Pause, Next, Previous, ±30 s, Repeat, Shuffle |
| E20–E25 | TuneIn, Bibliotheks-Track/-Playlist, Prime-Playlist/-Station/-Verlauf |
| E26 | Geräteliste neu einlesen (A2) |
| E27–E30 | Multiroom-Gruppe: Name, Mitglieder, anlegen, löschen |
| E31–E33 | Bluetooth: Adresse, verbinden, trennen |
| E34–E36 | Ersatz-Cover, Bildbreite, Aktualisierungsintervall (0 = aus) |
| E37 | Speicherbereinigung (Daemon-Neustart) |
| E38 | Modus `auto` (Refresh-Token) oder `manual` (Cookie/CSRF) |
| E39 | Status sofort aktualisieren |
| E40/E41 | Alarm-Auswertung und Aktion (`delete`/`disable`) |
| E42/E44 | Sprechen / Ansage, Format `[Volume]\|Text\|[Volume danach]` |
| E43 | User-Agent |
| E45 | **Dummy** – 2FA entfällt beim Refresh-Token-Login |
| E46–E48 | Alarm aktivieren/deaktivieren/löschen (`all` möglich) |
| E49/E50 | Routinen lesen / ausführen |
| E51–E54 | Sprech-Lautstärke, Standard-Lautstärke, max. Alter, Volume abfragen |
| E55/E56 | Actionable Notification `ID\|TEXT` und Skill-ID |
| E57 | Refresh-Token |

Die vollständige Beschreibung steht im `###[HELP]###`-Abschnitt der Datei
(im EDOMI-Editor über den Hilfe-Button erreichbar).

## Ausgänge

A1 Ergebnis (`OK`/`ERROR`), A2 Geräte (JSON), A3 Volume, A4 Mute, A5–A7
Titel/Textzeilen, A8 Provider, A9 Cover-URL, A10 Player-Status, A11/A12
Multiroom, A13 Online, A14 Online-Status aller Geräte (JSON), A15–A17
Rohdaten (Player/Queue/State), A18 neuer Alarm, A19 alle Alarme, A20 Zeitpunkt
der letzten Aktualisierung, A21 User-Agent, A22 verfügbare Routinen.

## Logging

Logdatei: `Alexa_ControlNext-LBS19002716-<Instanz>.log`. Empfehlung: im
Normalbetrieb E2 = 6 (notice), bei Problemen 8 (debug).

## Changelog

### 4.0.0 – Neuimplementierung

* vollständige Neufassung mit klaren Klassen und sprechenden Namen
* ein zentraler HTTP-Client statt ~30 kopierter cURL-Blöcke
* Login ausschließlich über Refresh-Token (kein Passwort-/2FA-Login)
* höhere Robustheit: fehlende Geräte/Tokens führen zu Logmeldungen statt
  PHP-Notices; Status-/Alarmantworten werden auf ihr Format geprüft
* HTTP 429 wird einmal wiederholt, Mindestabstand zwischen API-Aufrufen
* E36 = 0 verhindert nur die periodische, nicht die einmalige Aktualisierung
* Hinweis auf nicht unterstützte Gerätefamilien (z. B. `VOX` = Alexa-App)
  erscheint nur einmal pro Gerät und Prozesslauf

## Lizenz

Noch nicht festgelegt. Bis dahin gelten die Regeln des EDOMI-Forums für
veröffentlichte Logikbausteine.
