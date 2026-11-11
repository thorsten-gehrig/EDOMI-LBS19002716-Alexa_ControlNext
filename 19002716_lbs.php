###[DEF]###

[name		= Alexa ControlNext    v4.0.0 ]

[e#1 trigger	= (Re)Start/Stop ]
[e#2			= Loglevel #init=8 ]
[e#3 important	= Amazon-Account - fuer Cookie-Datei ]
[e#4 important	= Dummy - Amazon Password ]
[e#5 important	= Country (DE|US) #init=DE ]

[e#6 optional	= Add Device ]
[e#7 optional	= Delete Device ]
[e#8 optional	= Cookie ]
[e#9 optional	= CSRF ]

[e#10 trigger	= Echo Name ]
[e#11 trigger	= Volume (0-100) ]
[e#12 trigger	= Play ]
[e#13 trigger	= Pause ]
[e#14 trigger	= Next ]
[e#15 trigger	= Previous ]
[e#16 trigger	= Forward ]
[e#17 trigger	= Rewind ]
[e#18 trigger	= Repeat ]
[e#19 trigger	= Shuffle ]
[e#20 trigger	= Play TuneIn station ]
[e#21 trigger	= Play library track ]
[e#22 trigger	= Play library playlist ]
[e#23 trigger	= Play Prime playlist ]
[e#24 trigger	= Play Prime station ]
[e#25 trigger	= Play Prime historical queue ]
[e#26 trigger	= Update device list ]
[e#27			= Multi-room group name ]
[e#28			= Multi-room devices ]
[e#29 trigger	= Create Multi-room group ]
[e#30 trigger	= Delete Multi-room group ]
[e#31			= Bluetooth device ]
[e#32 trigger	= Connect bluetooth device ]
[e#33 trigger	= Disconnect bluetooth device ]
[e#34			= noArt URL ]
[e#35			= Screen width #init=1280 ]
[e#36			= Update frequency (s) #init=10 ]
[e#37			= Memory cleanup ]
[e#38			= Mode (auto|manual) #init=auto ]
[e#39 trigger	= Status Update ]
[e#40			= Alarm #init=0 ]
[e#41			= Alarm action ]
[e#42 trigger	= Speak ]
[e#43			= User-Agent #init=Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0 ]
[e#44 trigger	= Announce (SSML) ]
[e#45			= Dummy - 2FA Secret ]
[e#46			= Enable Alarm ]
[e#47			= Disable Alarm ]
[e#48			= Delete Alarm ]
[e#49 trigger	= Read/Update Routines ]
[e#50 trigger	= Execute Routine ]
[e#51			= Speak Volume (0-100) ]
[e#52 important	= Default Volume (0-100) #init=50 ]
[e#53			= Max Volume Age (minutes) #init=30 ]
[e#54			= Update volume ]
[e#55 trigger	= Action Trigger (ID|TEXT) ]
[e#56			= Action Skill ID ]
[e#57			= Refresh Token ]

[a#1		= Result ]
[a#2		= Devices ]
[a#3		= Volume ]
[a#4		= Mute ]
[a#5		= Titel ]
[a#6		= Text1 ]
[a#7		= Text2 ]
[a#8		= Provider ]
[a#9		= Art cover URL ]
[a#10		= State ]
[a#11		= Multiroom ]
[a#12		= Multiroom volume ]
[a#13		= Online ]
[a#14		= All Online ]
[a#15		= JSON player info ]
[a#16		= JSON queue info ]
[a#17		= JSON state info ]
[a#18		= New Alarm ]
[a#19		= All Alarms ]
[a#20		= Last update ]
[a#21		= UserAgent ]
[a#22		= Available Routines ]

[v#1		= 0 ]							// Message-Queue-Id (IPC zwischen LBS und EXEC)
[v#100		= 4.0.0 ]						// Version (nur fuer Logausgabe)
[v#101		= 19002716 ]					// LBS-Nummer (muss unveraendert bleiben!)
[v#102		= Alexa ControlNext ]			// Logdatei-Name
[v#103		= 0 ]							// Log-Level (0=aus, 1=emerg ... 8=debug)
[v#104		= 1 ]							// 1 = eine Logdatei pro LBS-Instanz
[v#105		= 0 ]							// 1 = LBS-Instanz-Id an jede Logzeile anhaengen

###[/DEF]###


###[HELP]###

Alexa ControlNext v4.0.0
=======================

Steuert Amazon-Echo-Geraete ohne Sprachbefehl aus EDOMI heraus.

Die Ein- und Ausgaenge sind mit Baustein 19000809 1:1 kompatibel (Nummern, Typen und
Bedeutung identisch). Die Logik muss also nicht angepasst werden.


1. Voraussetzungen
------------------
* EDOMI mit PHP >= 5.4 (getestet gegen die EDOMI-Standardumgebung)
* Paket "php-process" (posix/sysvmsg) - ist bei EDOMI bereits vorhanden
* Kein Passwort-Login mehr: bitte Refresh-Token in E57 hinterlegen
  Erzeugen z.B. mit:  https://github.com/adn77/alexa-cookie-cli
* Fuer Actionable Notifications (E55/E56) zusaetzlich der OAuth2-Server und
  die Scripte aus dem LBS-Archiv.


2. Modi (E38)
-------------
auto   - Anmeldung ueber Refresh-Token (E57). Geraete werden automatisch
         gesucht, Online-Status wird ausgewertet.
manual - Es werden die Werte aus E6 (Geraet), E8 (Cookie) und E9 (CSRF)
         verwendet. Kein automatischer Geraeteabgleich.


3. Eingaenge
------------
E1  1 = Daemon starten, 0 = Daemon stoppen
E2  Log-Level (0=aus, 1=emerg ... 8=debug)
E3  Amazon-Account -  Wird nur noch als Name der Cookie-Datei benutzt.
E4  Dummy-Amazon-Passwort. WIRD NICHT MEHR BENOETIGT (nur noch E57).
E5  Land des Echo-Kontos: DE oder US
E6  Geraet fuer den manuellen Modus:
    Name,Geraetetyp,Seriennummer,deviceOwnerCustomerId,deviceFamily
E7  Geraet (Name) aus der internen Liste entfernen (nur manual)
E8  Cookie-Header (nur manual)
E9  CSRF-Token (nur manual)
E10 Name des zu steuernden Echos (wie in der Alexa-App)
E11 Lautstaerke 0-100
E12 Play
E13 Pause/Stop
E14 Next
E15 Previous
E16 30 s vor
E17 30 s zurueck
E18 Repeat (0/1)
E19 Shuffle (0/1)
E20 TuneIn-Sender: Name, "s12345" oder "1LIVE - s12345".
    Eine Sender-ID wird ueber die TuneIn-API in den Sendernamen aufgeloest.
E21 Track-ID aus der Amazon-Bibliothek
E22 Playlist-ID aus der Amazon-Bibliothek
E23 Prime-Playlist (ASIN)
E24 Prime-Station (Seed-ID)
E25 Prime-Verlauf (Queue-ID)
E26 Geraeteliste neu einlesen (Ausgabe A2)
E27 Name der Multiroom-Gruppe
E28 Mitglieder der Multiroom-Gruppe, kommasepariert
E29 Multiroom-Gruppe anlegen (E27 + E28)
E30 Multiroom-Gruppe loeschen (E27)
E31 Bluetooth-Geraet (MAC-Adresse)
E32 Bluetooth verbinden
E33 Bluetooth trennen
E34 Ersatz-Coverbild, wenn Alexa keines liefert
E35 Bildbreite fuer die Cover-Erzeugung (A9)
E36 Aktualisierungsintervall in Sekunden fuer A3-A17
    0 = keine automatische Aktualisierung (dann E39 benutzen)
E37 Speicherbereinigung: startet den EXEC-Daemon neu
    Empfehlung: EDOMI-Stundentrigger (iKO21) auf E37 legen
E38 Betriebsmodus (auto|manual)
E39 Status sofort aktualisieren
E40 Alarm-Auswertung:
    0 = aus
    1 = alle Alarme des Amazon-Kontos
    2 = nur Alarme des Echos aus E10
E41 Aktion fuer neu erkannte Alarme (A18):
    "delete"  = Alarm loeschen
    "disable" = Alarm deaktivieren
    leer      = Alarm unveraendert lassen
E42 Text sprechen. Format: [Lautstaerke]|"Text"|[Lautstaerke danach]
    Beispiel: 50|Hallo Edomi|30
    Beispiel: Hallo Edomi   (Lautstaerke aus E51, danach alte Lautstaerke)
E43 User-Agent fuer die HTTP-Aufrufe
E44 Ankuendigung (AlexaAnnouncement) - gleiches Format wie E42.
    Komplettes SSML wird unterstuetzt, wenn der Text in <speak>...</speak>
    steht, z.B. <speak>Achtung <break time="1s"/> Test</speak>
E45 Dummy-Feld - nicht benoetigt
E46 Alarm-ID aktivieren ("all" = alle)
E47 Alarm-ID deaktivieren ("all" = alle)
E48 Alarm-ID loeschen ("all" = alle)
E49 Routinen einlesen (Ausgabe A22)
E50 Routine ausfuehren (Name oder Ausloese-Satz aus A22)
E51 Lautstaerke fuer E42/E44, wenn dort keine angegeben ist
E52 Lautstaerke, auf die nach dem Sprechen zurueckgesetzt wird, wenn die
    vorherige Lautstaerke nicht ermittelbar ist
E53 Maximales Alter der Lautstaerke in Minuten (danach gilt sie als unbekannt)
E54 Lautstaerke (A3) und Mute (A4) neu abfragen
E55 Actionable Notification: "ID|TEXT"
E56 Skill-ID des eigenen Alexa-Skills (fuer E55)
E57 Refresh-Token fuer die Anmeldung


4. Ausgaenge
------------
A1  Ergebnis des letzten Alexa-Befehls (OK|ERROR, nur zur Kontrolle)
A2  Gefundene Geraete als JSON: {Seriennummer: Name}
A3  Aktuelle Lautstaerke (0-100)
A4  Mute (0|1)
A5  Titel
A6  Zusatzzeile 1
A7  Zusatzzeile 2
A8  Anbieter (z.B. Amazon Music)
A9  Cover-URL (bzw. E34)
A10 Player-Status (PLAYING|PAUSED|IDLE)
A11 Multiroom-Wiedergabe (0|1)
A12 Multiroom-Lautstaerke
A13 Echo aus E10 erreichbar (1) oder nicht (0)
A14 Online-Status aller Geraete als JSON, z.B.
    {"Wohnzimmer":1,"Wohnzimmer_pretty":"ONLINE",...}
A15 Player-Rohdaten (JSON)
A16 Queue-Rohdaten (JSON)
A17 State-Rohdaten (JSON)
A18 Zuletzt neu erkannter Alarm (JSON), Felder wie bisher:
    id, new, device, createTime, createDate, alarmTime, alarmDate, type,
    reminderLabel, status, recurringPattern, snoozedToTime
A19 Alle Alarme (JSON-Array)
A20 Zeitpunkt der letzten Statusaktualisierung
A21 Verwendeter User-Agent
A22 Verfuegbare Routinen als JSON-Array [{name, utterance}]


5. Aenderungen in v4.0.0
------------------------
* Zentraler HTTP-Client:
  Konsolidierung der Netzwerkanfragen auf einen einzigen HTTP-Client 

* Reduzierte Prozessorlast:
  Der EXEC-Bereich liest die Eingaenge nun bedarfsorientiert ein

* Klare Klassenstrukturen:

* Sofortiger Status nach Start:
  Unmittelbar nach dem Start wird ein Status abgerufen, sodass die Ausgaenge
  A3 bis A13 direkt ein ergebniss liefern.

###[/HELP]###
###[LBS]###
<?
/**
 * Alexa ControlNext - Teil 1: Eingangsverarbeitung
 *
 * Diese Funktion laeuft bei jeder Aenderung eines Eingangs. Sie ist bewusst
 * schlank: sie prueft Start/Stop, sammelt die geaenderten Eingaenge ein und
 * schiebt sie als kleine Nachrichten an den EXEC-Daemon.
 */

/**
 * Zuordnung Eingang -> Befehlsname.
 *
 * Neue Eingaenge werden hier einmal eingetragen; die Weiterleitung an den
 * Daemon erfolgt automatisch. E1 (Start/Stop) und E37 (Speicherbereinigung)
 * werden getrennt behandelt, weil sie den Prozess selbst betreffen.
 *
 * @return array
 */
function LB_LBSID_commandMap()
{
    return array(
        6  => 'addDevice',
        7  => 'deleteDevice',
        8  => 'cookie',
        9  => 'csrf',
        10 => 'selectDevice',
        11 => 'volume',
        12 => 'play',
        13 => 'pause',
        14 => 'next',
        15 => 'previous',
        16 => 'forward',
        17 => 'rewind',
        18 => 'repeat',
        19 => 'shuffle',
        20 => 'tuneInStation',
        21 => 'libraryTrack',
        22 => 'libraryPlaylist',
        23 => 'primePlaylist',
        24 => 'primeStation',
        25 => 'primeHistory',
        26 => 'refreshDevices',
        27 => 'multiroomName',
        28 => 'multiroomMembers',
        29 => 'multiroomCreate',
        30 => 'multiroomDelete',
        31 => 'bluetoothAddress',
        32 => 'bluetoothConnect',
        33 => 'bluetoothDisconnect',
        34 => 'fallbackCoverUrl',
        35 => 'screenWidth',
        36 => 'updateInterval',
        38 => 'mode',
        39 => 'statusUpdate',
        40 => 'alarmMode',
        41 => 'alarmAction',
        42 => 'speak',
        43 => 'userAgent',
        44 => 'announce',
        46 => 'alarmEnable',
        47 => 'alarmDisable',
        48 => 'alarmDelete',
        49 => 'readRoutines',
        50 => 'runRoutine',
        51 => 'speakVolume',
        52 => 'defaultVolume',
        53 => 'maxVolumeAge',
        54 => 'refreshVolume',
        55 => 'action',
        56 => 'skillId',
        57 => 'refreshToken'
    );
}

/**
 * Schreibt eine Zeile ins LBS-Log (abhaengig von E2).
 *
 * @param int        $id
 * @param string     $message
 * @param mixed|null $context  optionaler Kontext (Array/Objekt/String)
 * @param int        $priority 1=emerg ... 8=debug
 */
function LB_LBSID_log($id, $message, $context = null, $priority = 8)
{
    static $levelNames = array(
        1 => 'emerg',
        2 => 'alert',
        3 => 'crit',
        4 => 'err',
        5 => 'warning',
        6 => 'notice',
        7 => 'info',
        8 => 'debug'
    );

    $logLevel = (int) getLogicElementVar($id, 103);
    if ($priority < 1 || $logLevel < 1 || $priority > $logLevel) {
        return;
    }

    $levelName = isset($levelNames[$priority]) ? $levelNames[$priority] : 'debug';
    $version = getLogicElementVar($id, 100);
    $lbsNumber = getLogicElementVar($id, 101);
    $logName = preg_replace('/\s+/', '_', getLogicElementVar($id, 102) . '-LBS' . $lbsNumber);
    if (logic_getVar($id, 104)) {
        $logName .= '-' . $id;
    }
    if (logic_getVar($id, 105) == 1) {
        $message .= ' (' . $id . ')';
    }

    $prefix = 'LBS' . $lbsNumber . ' [v' . $version . "]:\t";
    writeToCustomLog($logName, str_pad($levelName, 7), $prefix . $message);

    if ($context !== null) {
        writeToCustomLog($logName, str_pad($levelName, 7), $prefix . '---- Kontext START ----');
        writeToCustomLog($logName, str_pad($levelName, 7), $prefix . (is_string($context) ? $context : json_encode($context)));
        writeToCustomLog($logName, str_pad($levelName, 7), $prefix . '---- Kontext ENDE  ----');
    }
}

/**
 * Signalnummer fuer SIGTERM, unabhaengig davon ob pcntl geladen ist.
 *
 * @return int
 */
function LB_LBSID_terminationSignal()
{
    return defined('SIGTERM') ? SIGTERM : 15;
}

/**
 * Sucht in einer "ps x"-Ausgabe die PID des EXEC-Prozesses dieser Instanz.
 *
 * @param string $processList
 * @param int    $lbsNumber
 * @param int    $id
 * @return int|false
 */
function LB_LBSID_pidFromProcessList($processList, $lbsNumber, $id)
{
    if (!is_string($processList) || $processList === '') {
        return false;
    }

    $pattern = '~EXE' . preg_quote((string) $lbsNumber, '~') . '\.php\s+' . (int) $id . '(\s|$)~';
    foreach (preg_split('/\r?\n/', $processList) as $processLine) {
        if ($processLine === '' || strpos($processLine, 'grep') !== false) {
            continue;
        }
        if (!preg_match($pattern, $processLine)) {
            continue;
        }
        $fields = preg_split('/\s+/', trim($processLine));
        if (isset($fields[0]) && preg_match('/^\d+$/', $fields[0])) {
            return (int) $fields[0];
        }
    }

    return false;
}

/**
 * Liefert die PID des laufenden EXEC-Prozesses dieser LBS-Instanz.
 *
 * Die Pruefung erfolgt in PHP statt per grep, damit z.B. Instanz 42 nicht
 * versehentlich auf Instanz 420 passt.
 *
 * @param int $id
 * @return int|false
 */
function LB_LBSID_daemonPid($id)
{
    $lbsNumber = getLogicElementVar($id, 101);
    return LB_LBSID_pidFromProcessList(@shell_exec('/bin/ps x'), $lbsNumber, $id);
}

/**
 * Sendet eine Nachricht an den EXEC-Daemon.
 *
 * Jeder Befehl wird einzeln verschickt. Damit bleibt jede Nachricht klein
 * (SysV begrenzt die Groesse einer Nachricht) und ein einzelner Fehler
 * blockiert nicht alle anderen Befehle.
 *
 * @param int   $id
 * @param array $message
 * @return bool
 */
function LB_LBSID_sendMessage($id, array $message)
{
    $queueId = (int) logic_getVar($id, 1);
    if ($queueId <= 0 || !msg_queue_exists($queueId)) {
        LB_LBSID_log($id, 'Nachricht nicht gesendet: Daemon ist nicht aktiv', null, 5);
        return false;
    }

    $queue = msg_get_queue($queueId);
    if ($queue === false) {
        LB_LBSID_log($id, 'Message-Queue ' . $queueId . ' nicht verfuegbar', null, 4);
        return false;
    }

    if (!@msg_send($queue, 1, $message, true, false)) {
        LB_LBSID_log($id, 'Nachricht konnte nicht gesendet werden (Queue ' . $queueId . ')', null, 5);
        return false;
    }

    return true;
}

/**
 * Entfernt die Message-Queue beim Stoppen.
 *
 * @param int $id
 */
function LB_LBSID_removeQueue($id)
{
    $queueId = (int) logic_getVar($id, 1);
    if ($queueId > 0 && msg_queue_exists($queueId)) {
        @msg_remove_queue(msg_get_queue($queueId));
        LB_LBSID_log($id, 'Message-Queue ' . $queueId . ' entfernt');
    }
    setLogicElementVar($id, 1, 0);
}

/**
 * Wartet, bis der EXEC-Prozess beendet ist (max. 2 Sekunden).
 *
 * @param int $id
 */
function LB_LBSID_waitForDaemonExit($id)
{
    for ($attempt = 0; $attempt < 20; $attempt++) {
        if (LB_LBSID_daemonPid($id) === false) {
            return;
        }
        usleep(100000);
    }
    LB_LBSID_log($id, 'Daemon reagiert nicht auf SIGTERM', null, 4);
}

/**
 * Behandelt E1 (Start/Stop).
 *
 * @param int $id
 * @param mixed $value
 */
function LB_LBSID_handlePowerSwitch($id, $value)
{
    $isRunning = (LB_LBSID_daemonPid($id) !== false);

    if ((int) $value === 1) {
        if ($isRunning) {
            LB_LBSID_log($id, 'Daemon laeuft bereits');
            return;
        }

        // Neue Queue anlegen: die LBS-Instanz erzeugt sie, der EXEC haengt sich an.
        $queueId = hexdec(uniqid());
        setLogicElementVar($id, 1, $queueId);
        if (msg_get_queue($queueId) === false) {
            setLogicElementVar($id, 1, 0);
            LB_LBSID_log($id, 'Message-Queue konnte nicht angelegt werden', null, 4);
            return;
        }

        LB_LBSID_log($id, 'Starte Daemon (Message-Queue ' . $queueId . ')', null, 6);
        logic_callExec(LBSID, $id, true);
        LB_LBSID_sendMessage($id, array('start' => true));
        return;
    }

    if (!$isRunning) {
        LB_LBSID_log($id, 'Daemon laeuft nicht');
        LB_LBSID_removeQueue($id);
        return;
    }

    LB_LBSID_log($id, 'Stoppe Daemon', null, 6);
    $pid = LB_LBSID_daemonPid($id);
    if ($pid !== false) {
        posix_kill($pid, LB_LBSID_terminationSignal());
    }
    LB_LBSID_waitForDaemonExit($id);
    LB_LBSID_removeQueue($id);
}

/**
 * Behandelt E37 (Speicherbereinigung).
 *
 * Der Daemon wird neu gestartet, die Message-Queue bleibt bestehen.
 *
 * @param int   $id
 * @param mixed $value
 * @return bool true, wenn der Rest der Verarbeitung uebersprungen werden soll
 */
function LB_LBSID_handleMemoryCleanup($id, $value)
{
    if ((int) $value !== 1 || LB_LBSID_daemonPid($id) === false) {
        return false;
    }

    LB_LBSID_log($id, 'Speicherbereinigung: Daemon wird neu gestartet', null, 6);
    $pid = LB_LBSID_daemonPid($id);
    if ($pid !== false) {
        posix_kill($pid, LB_LBSID_terminationSignal());
        LB_LBSID_waitForDaemonExit($id);
    }

    logic_callExec(LBSID, $id, true);
    LB_LBSID_sendMessage($id, array('start' => true));

    return true;
}

function LB_LBSID($id)
{
    $inputs = logic_getInputs($id);
    if (!$inputs) {
        return;
    }

    setLogicElementVar($id, 103, isset($inputs[2]['value']) ? (int) $inputs[2]['value'] : 0);
    LB_LBSID_log($id, 'LBS gestartet');

    if (!empty($inputs[1]['refresh'])) {
        LB_LBSID_handlePowerSwitch($id, $inputs[1]['value']);
        if ((int) $inputs[1]['value'] === 0) {
            LB_LBSID_log($id, 'LBS beendet');
            return;
        }
    }

    if (!empty($inputs[37]['refresh']) && LB_LBSID_handleMemoryCleanup($id, $inputs[37]['value'])) {
        LB_LBSID_log($id, 'LBS beendet (Speicherbereinigung)');
        return;
    }

    $commands = array();
    foreach (LB_LBSID_commandMap() as $inputIndex => $commandName) {
        if (!isset($inputs[$inputIndex]) || empty($inputs[$inputIndex]['refresh'])) {
            continue;
        }
        $commands[$commandName] = $inputs[$inputIndex]['value'];
    }

    if (!count($commands)) {
        LB_LBSID_log($id, 'LBS beendet (keine Befehle)');
        return;
    }

    $sent = 0;
    foreach ($commands as $commandName => $commandValue) {
        if (!LB_LBSID_sendMessage($id, array($commandName => $commandValue))) {
            break;
        }
        $sent++;
    }
    LB_LBSID_log($id, 'LBS beendet (' . $sent . ' Befehl(e) an den Daemon)');
}

?>
###[/LBS]###
###[EXEC]###
<?
/**
 * Alexa ControlNext - Teil 2: Hintergrundprozess (EXEC-Daemon)
 *
 * Aufbau:
 *   acxLog()          Protokollierung
 *   AcxHttpResponse   Ergebnis eines HTTP-Aufrufs
 *   AcxHttpClient     einziger Ort fuer cURL
 *   AcxEchoDevice     ein Echo-Geraet
 *   AcxSession        Login, Cookies, CSRF, Hosts
 *   AlexaControl      alle Alexa-Befehle
 *   AcxDaemon         Nachrichtenschleife, Status- und Alarmabfrage
 */

require(dirname(__FILE__) . "/../../../../main/include/php/incl_lbsexec.php");
set_time_limit(0);
sql_connect();

/**
 * Schreibt eine Zeile ins EXEC-Log (abhaengig von E2).
 *
 * @param int        $id
 * @param string     $message
 * @param mixed|null $context
 * @param int        $priority 1=emerg ... 8=debug
 */
function acxLog($id, $message, $context = null, $priority = 8)
{
    static $levelNames = array(
        1 => 'emerg',
        2 => 'alert',
        3 => 'crit',
        4 => 'err',
        5 => 'warning',
        6 => 'notice',
        7 => 'info',
        8 => 'debug'
    );

    $logLevel = (int) getLogicElementVar($id, 103);
    if ($priority < 1 || $logLevel < 1 || $priority > $logLevel) {
        return;
    }

    $levelName = isset($levelNames[$priority]) ? $levelNames[$priority] : 'debug';
    $version = getLogicElementVar($id, 100);
    $lbsNumber = getLogicElementVar($id, 101);
    $logName = preg_replace('/\s+/', '_', getLogicElementVar($id, 102) . '-LBS' . $lbsNumber);
    if (logic_getVar($id, 104)) {
        $logName .= '-' . $id;
    }
    if (logic_getVar($id, 105) == 1) {
        $message .= ' (' . $id . ')';
    }

    $scriptName = (strpos($_SERVER['SCRIPT_NAME'], (string) $lbsNumber) !== false) ? 'EXE' : 'LBS';
    $prefix = $scriptName . $lbsNumber . ' [v' . $version . "]:\t";
    writeToCustomLog($logName, str_pad($levelName, 7), $prefix . $message);

    if ($context !== null && $context !== '') {
        writeToCustomLog($logName, str_pad($levelName, 7), $prefix . '---- Kontext START ----');
        writeToCustomLog($logName, str_pad($levelName, 7), $prefix . (is_string($context) ? $context : json_encode($context)));
        writeToCustomLog($logName, str_pad($levelName, 7), $prefix . '---- Kontext ENDE  ----');
    }
}

/**
 * Leitet PHP-Fehler ins LBS-Log um, damit der Daemon nicht still stirbt.
 *
 * @param int $id
 */
function acxInstallErrorHandler($id)
{
    error_reporting(E_ALL);
    set_error_handler(function ($severity, $text, $file, $line) use ($id) {
        if (!(error_reporting() & $severity)) {
            return false;
        }
        $labels = array(
            E_ERROR             => 'error',
            E_WARNING           => 'warning',
            E_PARSE             => 'parse',
            E_NOTICE            => 'notice',
            E_CORE_ERROR        => 'core-error',
            E_CORE_WARNING      => 'core-warning',
            E_COMPILE_ERROR     => 'compile-error',
            E_COMPILE_WARNING   => 'compile-warning',
            E_USER_ERROR        => 'user-error',
            E_USER_WARNING      => 'user-warning',
            E_USER_NOTICE       => 'user-notice',
            E_RECOVERABLE_ERROR => 'recoverable',
            E_DEPRECATED        => 'deprecated',
            E_USER_DEPRECATED   => 'user-deprecated'
        );
        $label = isset($labels[$severity]) ? $labels[$severity] : 'php';
        acxLog($id, 'PHP-' . $label . ': ' . $text . ' (' . basename($file) . ':' . $line . ')', null, 8);
        return true;
    });
}

/**
 * Ergebnis eines HTTP-Aufrufs.
 */
class AcxHttpResponse
{
    public $url = '';
    public $httpCode = 0;
    public $body = '';
    public $headers = array();
    public $error = '';
    public $curlErrorNumber = 0;

    /**
     * @return bool
     */
    public function isOk()
    {
        return $this->httpCode >= 200 && $this->httpCode < 300;
    }

    /**
     * @return array|null
     */
    public function json()
    {
        $decoded = json_decode($this->body, true);
        return (json_last_error() === JSON_ERROR_NONE) ? $decoded : null;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getHeader($name)
    {
        $name = strtolower($name);
        return isset($this->headers[$name]) ? $this->headers[$name] : null;
    }
}

/**
 * Einziger Ort fuer HTTP-Aufrufe.
 *
 * Kapselt Cookie-Verwaltung, Header, Timeouts und die Auswertung des
 * Ergebnisses. Dadurch entfaellt das frueher mehrfach kopierte
 * curl_setopt-Geflecht.
 */
class AcxHttpClient
{
    const DEFAULT_TIMEOUT = 10;

    protected $userAgent;
    protected $cookieFile = null;
    protected $cookieFileReadOnly = false;
    protected $cookieHeader = null;

    public function __construct($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Cookies aus einer cURL-Cookiedatei lesen/schreiben.
     *
     * @param string $path
     * @param bool   $readOnly
     */
    public function useCookieFile($path, $readOnly = false)
    {
        $this->cookieFile = $path;
        $this->cookieFileReadOnly = $readOnly;
        $this->cookieHeader = null;
    }

    /**
     * Fertigen Cookie-Header verwenden (Modus "manual").
     *
     * @param string $header
     */
    public function useCookieHeader($header)
    {
        $this->cookieHeader = $header;
        $this->cookieFile = null;
    }

    /**
     * @param string $method  GET|POST|PUT|DELETE
     * @param string $url
     * @param array  $options headers, body, json, timeout
     * @return AcxHttpResponse
     */
    public function request($method, $url, array $options = array())
    {
        $response = new AcxHttpResponse();
        $response->url = $url;

        $handle = curl_init();
        if ($handle === false) {
            $response->error = 'cURL konnte nicht initialisiert werden';
            return $response;
        }

        $method = strtoupper($method);
        $timeout = isset($options['timeout']) ? max(1, (int) $options['timeout']) : self::DEFAULT_TIMEOUT;
        $headers = isset($options['headers']) ? $options['headers'] : array();

        if ($this->cookieHeader !== null && $this->cookieHeader !== '') {
            $headers[] = 'Cookie: ' . $this->cookieHeader;
        }

        $body = null;
        if (isset($options['json']) && is_array($options['json'])) {
            $body = json_encode($options['json']);
            if (!$this->hasHeader($headers, 'content-type')) {
                $headers[] = 'Content-Type: application/json; charset=UTF-8';
            }
        } elseif (array_key_exists('body', $options) && $options['body'] !== null) {
            $body = $options['body'];
            if (is_array($body)) {
                $body = http_build_query($body);
            }
        }

        $receivedHeaders = array();

        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_MAXREDIRS, 5);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, min(5, $timeout));
        curl_setopt($handle, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($handle, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($handle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($handle, CURLOPT_ENCODING, '');
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_HEADERFUNCTION, function ($curl, $headerLine) use (&$receivedHeaders) {
            $trimmed = trim($headerLine);
            if (stripos($trimmed, 'HTTP/') === 0) {
                // Neuer Antwortblock (z.B. nach Redirect)
                $receivedHeaders = array();
            } elseif (strpos($trimmed, ':') !== false) {
                list($name, $value) = explode(':', $trimmed, 2);
                $receivedHeaders[strtolower(trim($name))] = trim($value);
            }
            return strlen($headerLine);
        });

        if ($this->cookieFile !== null) {
            curl_setopt($handle, CURLOPT_COOKIEFILE, $this->cookieFile);
            if (!$this->cookieFileReadOnly) {
                curl_setopt($handle, CURLOPT_COOKIEJAR, $this->cookieFile);
            }
        }

        if ($method === 'POST') {
            curl_setopt($handle, CURLOPT_POST, true);
            curl_setopt($handle, CURLOPT_POSTFIELDS, $body === null ? '' : $body);
        } elseif ($method !== 'GET') {
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $method);
            if ($body !== null) {
                curl_setopt($handle, CURLOPT_POSTFIELDS, $body);
            }
        }

        $rawBody = curl_exec($handle);
        $response->httpCode = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $response->headers = $receivedHeaders;

        if (is_string($rawBody)) {
            $response->body = $rawBody;
        } else {
            $response->curlErrorNumber = curl_errno($handle);
            $response->error = curl_error($handle);
        }

        curl_close($handle);
        return $response;
    }

    /**
     * @param array  $headers
     * @param string $name
     * @return bool
     */
    protected function hasHeader(array $headers, $name)
    {
        foreach ($headers as $header) {
            if (stripos($header, $name . ':') === 0) {
                return true;
            }
        }
        return false;
    }
}

/**
 * Ein Echo-Geraet.
 */
class AcxEchoDevice
{
    public $name;
    public $deviceType;
    public $serialNumber;
    public $ownerCustomerId;
    public $deviceFamily;
    public $online;

    public function __construct($name, $deviceType, $serialNumber, $ownerCustomerId, $deviceFamily, $online = null)
    {
        $this->name = $name;
        $this->deviceType = $deviceType;
        $this->serialNumber = $serialNumber;
        $this->ownerCustomerId = $ownerCustomerId;
        $this->deviceFamily = $deviceFamily;
        $this->online = $online;
    }

    /**
     * @param array $data Datensatz aus /api/devices-v2/device
     * @return AcxEchoDevice
     */
    public static function fromApi(array $data)
    {
        return new self(
            isset($data['accountName']) ? $data['accountName'] : '',
            isset($data['deviceType']) ? $data['deviceType'] : '',
            isset($data['serialNumber']) ? $data['serialNumber'] : '',
            isset($data['deviceOwnerCustomerId']) ? $data['deviceOwnerCustomerId'] : '',
            isset($data['deviceFamily']) ? $data['deviceFamily'] : '',
            isset($data['online']) ? $data['online'] : null
        );
    }

    /**
     * @return bool
     */
    public function isOnline()
    {
        return ($this->online === 'TRUE' || $this->online === true || $this->online === 1);
    }
}

/**
 * Anmeldung, Cookies, CSRF und Hostnamen.
 */
class AcxSession
{
    const MODE_AUTO = 'auto';
    const MODE_MANUAL = 'manual';
    const AUTH_CHECK_INTERVAL = 60;
    const DEFAULT_USER_AGENT = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0';
    const MIN_REQUEST_INTERVAL_MS = 200;
    const RATE_LIMIT_DELAY = 2;

    protected $id;
    protected $email;
    protected $amazonHost;
    protected $alexaHost;
    protected $locale;
    protected $acceptLanguage;
    protected $mode = self::MODE_AUTO;
    protected $refreshToken = '';
    protected $csrf = '';
    protected $manualCookie = '';
    protected $cookieFile;
    protected $http;
    protected $lastAuthCheck = 0;
    protected $lastApiRequestAt = 0;

    public function __construct($id, $email, $country, $userAgent)
    {
        $this->id = $id;
        $this->email = trim($email);

        if (strtoupper(trim($country)) === 'US') {
            $this->amazonHost = 'amazon.com';
            $this->alexaHost = 'pitangui.amazon.com';
            $this->locale = 'en-US';
            $this->acceptLanguage = 'en-US,en;q=0.9,de;q=0.8';
        } else {
            $this->amazonHost = 'amazon.de';
            $this->alexaHost = 'alexa.amazon.de';
            $this->locale = 'de-DE';
            $this->acceptLanguage = 'de,en-US;q=0.7,en;q=0.3';
        }

        // Dateiname bewusst wie in v4, damit bestehende Sessions weiterlaufen
        $this->cookieFile = '/tmp/.alexa-' . $this->email . '.cookie';

        $this->http = new AcxHttpClient($userAgent === '' ? self::DEFAULT_USER_AGENT : $userAgent);
        $this->applyTransport();
    }

    /**
     * Legt fest, woher die Cookies kommen (Datei oder E8).
     */
    public function applyTransport()
    {
        if ($this->isManualMode()) {
            $this->http->useCookieHeader($this->manualCookie);
        } else {
            $this->http->useCookieFile($this->cookieFile);
        }
    }

    public function setMode($mode)
    {
        $mode = strtolower(trim($mode));
        $newMode = ($mode === self::MODE_MANUAL) ? self::MODE_MANUAL : self::MODE_AUTO;

        // Nur bei echtem Wechsel neu anmelden (spart einen Bootstrap-Aufruf)
        if ($newMode !== $this->mode) {
            $this->lastAuthCheck = 0;
        }

        $this->mode = $newMode;
        $this->applyTransport();
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function isManualMode()
    {
        return $this->mode === self::MODE_MANUAL;
    }

    public function isAutoMode()
    {
        return $this->mode === self::MODE_AUTO;
    }

    public function setRefreshToken($token)
    {
        $token = trim((string) $token);
        if ($token !== $this->refreshToken) {
            $this->refreshToken = $token;
            $this->lastAuthCheck = 0;
        }
    }

    public function setManualCookie($cookie)
    {
        $this->manualCookie = trim((string) $cookie);
        $this->applyTransport();
    }

    public function setCsrf($csrf)
    {
        $this->csrf = trim((string) $csrf);
    }

    public function getCsrf()
    {
        return $this->csrf;
    }

    public function setUserAgent($agent)
    {
        $this->http->setUserAgent($agent === '' ? self::DEFAULT_USER_AGENT : $agent);
    }

    public function getUserAgent()
    {
        return $this->http->getUserAgent();
    }

    public function getAmazonHost()
    {
        return $this->amazonHost;
    }

    public function getAlexaHost()
    {
        return $this->alexaHost;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function getCookieFile()
    {
        return $this->cookieFile;
    }

    /**
     * Konfiguration fuer /tmp/.echos.inc.php (unveraendert zu v4).
     *
     * @return array
     */
    public function getConfig()
    {
        return array(
            'cookieFile' => $this->cookieFile,
            'amazon'     => $this->amazonHost,
            'alexa'      => $this->alexaHost,
            'userAgent'  => $this->http->getUserAgent()
        );
    }

    /**
     * Sorgt dafuer, dass eine gueltige Anmeldung vorliegt.
     *
     * Das Ergebnis wird kurz zwischengespeichert, damit nicht jeder Befehl
     * einen zusaetzlichen Bootstrap-Aufruf ausloest.
     *
     * @return bool
     */
    public function authenticate()
    {
        if ($this->isManualMode()) {
            return true;
        }

        $now = time();
        if ($this->lastAuthCheck > 0 && ($now - $this->lastAuthCheck) < self::AUTH_CHECK_INTERVAL) {
            return true;
        }

        $this->applyTransport();

        $authenticated = false;
        if (is_file($this->cookieFile)) {
            $authenticated = $this->checkAuthentication();
        }
        if (!$authenticated) {
            $authenticated = $this->loginWithRefreshToken();
        }

        $this->lastAuthCheck = $authenticated ? time() : 0;
        return $authenticated;
    }

    /**
     * API-Aufruf gegen den Alexa-Host.
     *
     * Amazon drosselt die Web-API; bei HTTP 429 wird der Aufruf einmal
     * wiederholt (429 bedeutet: der Aufruf wurde nicht ausgefuehrt).
     * Zusaetzlich sorgt ein Mindestabstand zwischen zwei Aufrufen dafuer,
     * dass Befehle nicht in Bursts abgeschickt werden.
     *
     * @param string     $method
     * @param string     $path
     * @param int        $timeout
     * @param array|null $jsonBody
     * @return AcxHttpResponse
     */
    public function request($method, $path, $timeout = AcxHttpClient::DEFAULT_TIMEOUT, array $jsonBody = null)
    {
        $response = $this->sendApiRequest($method, $path, $timeout, $jsonBody);

        if ($response->httpCode === 429) {
            acxLog($this->id, 'Amazon meldet Rate-Limit (HTTP 429) - neuer Versuch in ' . self::RATE_LIMIT_DELAY . ' s', null, 5);
            sleep(self::RATE_LIMIT_DELAY);
            $response = $this->sendApiRequest($method, $path, $timeout, $jsonBody);
            if ($response->httpCode === 429) {
                acxLog($this->id, 'Rate-Limit bleibt bestehen - Aufruf wird verworfen', $response->body, 4);
            }
        }

        return $response;
    }

    /**
     * @param string     $method
     * @param string     $path
     * @param int        $timeout
     * @param array|null $jsonBody
     * @return AcxHttpResponse
     */
    protected function sendApiRequest($method, $path, $timeout, array $jsonBody = null)
    {
        $this->applyTransport();
        $this->throttle();

        return $this->http->request($method, 'https://' . $this->alexaHost . $path, array(
            'headers' => $this->buildApiHeaders(),
            'timeout' => $timeout,
            'json'    => $jsonBody
        ));
    }

    /**
     * Haelt einen Mindestabstand zwischen zwei API-Aufrufen ein.
     */
    protected function throttle()
    {
        if ($this->lastApiRequestAt > 0) {
            $elapsed = microtime(true) - $this->lastApiRequestAt;
            $remaining = (self::MIN_REQUEST_INTERVAL_MS / 1000) - $elapsed;
            if ($remaining > 0) {
                usleep((int) ($remaining * 1000000));
            }
        }
        $this->lastApiRequestAt = microtime(true);
    }

    /**
     * @param bool $includeCsrf
     * @return array
     */
    public function buildApiHeaders($includeCsrf = true)
    {
        $headers = array(
            'Accept-Language: ' . $this->acceptLanguage,
            'Accept: application/json, text/javascript, */*; q=0.01',
            'DNT: 1',
            'Connection: keep-alive',
            'Referer: https://' . $this->alexaHost . '/spa/index.html',
            'Origin: https://' . $this->alexaHost
        );
        if ($includeCsrf && $this->csrf !== '') {
            $headers[] = 'csrf: ' . $this->csrf;
        }
        return $headers;
    }

    /**
     * Login per Refresh-Token (E57).
     *
     * @return bool
     */
    protected function loginWithRefreshToken()
    {
        if ($this->refreshToken === '') {
            acxLog($this->id, 'Login nicht moeglich: Refresh-Token (E57) ist leer', null, 4);
            return false;
        }

        acxLog($this->id, 'Login ueber Refresh-Token', null, 7);

        $response = $this->http->request('POST', 'https://api.' . $this->amazonHost . '/ap/exchangetoken/cookies', array(
            'headers' => array(
                'x-amzn-identity-auth-domain: api.' . $this->amazonHost,
                'Content-Type: application/x-www-form-urlencoded',
                'Accept-Language: ' . $this->acceptLanguage
            ),
            'body' => array(
                'app_name'           => 'Amazon Alexa',
                'requested_token_type' => 'auth_cookies',
                'domain'             => 'www.' . $this->amazonHost,
                'source_token_type'  => 'refresh_token',
                'source_token'       => $this->refreshToken
            ),
            'timeout' => 20
        ));

        if (!$response->isOk()) {
            acxLog($this->id, 'Login fehlgeschlagen (HTTP ' . $response->httpCode . ')', $response->body, 4);
            return false;
        }

        $data = $response->json();
        if (!isset($data['response']['tokens']['cookies']) || !is_array($data['response']['tokens']['cookies'])) {
            acxLog($this->id, 'Login fehlgeschlagen: keine Cookies in der Antwort', $response->body, 4);
            return false;
        }

        if (!$this->writeCookieJar($data['response']['tokens']['cookies'])) {
            acxLog($this->id, 'Cookie-Datei konnte nicht geschrieben werden: ' . $this->cookieFile, null, 4);
            return false;
        }

        return $this->warmUpSession();
    }

    /**
     * Holt nach dem Login den CSRF-Token aus der Cookiedatei.
     *
     * @return bool
     */
    protected function warmUpSession()
    {
        $paths = array(
            '/api/language',
            '/templates/oobe/d-device-pick.handlebars',
            '/api/devices-v2/device?cached=false'
        );

        foreach ($paths as $path) {
            $this->http->request('GET', 'https://' . $this->alexaHost . $path, array(
                'headers' => $this->buildApiHeaders(false),
                'timeout' => 10
            ));
            if ($this->refreshCsrfFromCookieJar()) {
                acxLog($this->id, 'CSRF-Token empfangen', null, 7);
                return true;
            }
        }

        acxLog($this->id, 'Login fehlgeschlagen: kein CSRF-Token erhalten', null, 4);
        return false;
    }

    /**
     * Prueft eine bestehende Session und frischt den CSRF-Token auf.
     *
     * @return bool
     */
    protected function checkAuthentication()
    {
        $response = $this->http->request('GET', 'https://' . $this->alexaHost . '/api/bootstrap?version=0', array(
            'headers' => $this->buildApiHeaders(false),
            'timeout' => 8
        ));

        if (!$response->isOk()) {
            return false;
        }

        $data = $response->json();
        $authenticated = false;
        if (is_array($data)) {
            if (isset($data['authentication']['authenticated'])) {
                $authenticated = (bool) $data['authentication']['authenticated'];
            } elseif (isset($data['authenticated'])) {
                $authenticated = (bool) $data['authenticated'];
            }
        }
        if (!$authenticated && strpos($response->body, '"authenticated":true') !== false) {
            $authenticated = true;
        }
        if (!$authenticated) {
            return false;
        }

        if (!$this->refreshCsrfFromCookieJar()) {
            $this->fetchCsrf();
        }

        return true;
    }

    /**
     * Holt den CSRF-Token ueber /api/language.
     *
     * @return bool
     */
    protected function fetchCsrf()
    {
        $this->http->request('GET', 'https://' . $this->alexaHost . '/api/language', array(
            'headers' => $this->buildApiHeaders(false),
            'timeout' => 8
        ));
        return $this->refreshCsrfFromCookieJar();
    }

    /**
     * @return bool
     */
    protected function refreshCsrfFromCookieJar()
    {
        foreach ($this->readCookieJar() as $cookie) {
            if ($cookie['name'] === 'csrf' && $cookie['value'] !== '') {
                $this->csrf = $cookie['value'];
                return true;
            }
        }
        return false;
    }

    /**
     * Liest die cURL-Cookiedatei.
     *
     * @return array
     */
    protected function readCookieJar()
    {
        if (!is_readable($this->cookieFile)) {
            return array();
        }

        $lines = file($this->cookieFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!is_array($lines)) {
            return array();
        }

        $cookies = array();
        foreach ($lines as $line) {
            if (strpos($line, '#HttpOnly_') === 0) {
                $line = substr($line, strlen('#HttpOnly_'));
            } elseif (strpos($line, '#') === 0) {
                continue;
            }

            $fields = explode("\t", $line);
            if (count($fields) < 7) {
                continue;
            }

            $cookies[] = array(
                'domain' => $fields[0],
                'path'   => $fields[2],
                'name'   => $fields[5],
                'value'  => $fields[6]
            );
        }

        return $cookies;
    }

    /**
     * Schreibt die Cookies aus der Token-Antwort in die Cookiedatei.
     *
     * @param array $cookieDomains
     * @return bool
     */
    protected function writeCookieJar(array $cookieDomains)
    {
        $lines = array();
        foreach ($cookieDomains as $domain => $cookies) {
            if (!is_array($cookies)) {
                continue;
            }
            foreach ($cookies as $cookie) {
                if (!isset($cookie['Name']) || !isset($cookie['Value'])) {
                    continue;
                }
                $line = $domain
                    . "\tTRUE\t"
                    . (isset($cookie['Path']) && $cookie['Path'] !== '' ? $cookie['Path'] : '/')
                    . "\t"
                    . (!empty($cookie['Secure']) ? 'TRUE' : 'FALSE')
                    . "\t"
                    . (isset($cookie['Expires']) ? strtotime($cookie['Expires']) : 0)
                    . "\t"
                    . $cookie['Name'] . "\t" . $cookie['Value'];

                if (!empty($cookie['HttpOnly'])) {
                    $line = '#HttpOnly_' . $line;
                }
                $lines[] = $line;
            }
        }

        if (!count($lines)) {
            return false;
        }

        return @file_put_contents($this->cookieFile, implode(PHP_EOL, $lines) . PHP_EOL, LOCK_EX) !== false;
    }
}

/**
 * Alle Alexa-Befehle und Statusabfragen.
 */
class AlexaControl
{
    const ANNOUNCEMENT_TITLE = 'EDOMI';
    const SKILL_INPUT_FILE = '/usr/local/edomi/www/admin/include/php/alexa-actions/input.json';
    const DEFAULT_RECOVER_VOLUME = 50;
    const COLLECT_EXTENDED_STATUS = true;

    /**
     * deviceFamily-Werte, die als steuerbare Geraete uebernommen werden.
     *
     * Bei Bedarf ergaenzen (z.B. 'VOX' fuer neuere Echo-Modelle). Die
     * Logzeile "Geraetefamilie wird nicht unterstuetzt" nennt Name und Typ,
     * damit sich ein gefiltertes Geraet eindeutig identifizieren laesst.
     */
    protected static $supportedFamilies = array('ECHO', 'WHA', 'FIRE_TV', 'KNIGHT', 'ROOK');

    protected $id;
    protected $session;
    protected $devices = array();
    protected $devicesBySerial = array();
    protected $selectedDeviceName = null;
    protected $unsupportedDevicesLogged = array();
    protected $multiroomGroupName = '';
    protected $multiroomMembers = array();
    protected $bluetoothAddress = '';
    protected $notificationsSeenUntil;
    protected $routines = false;
    protected $fallbackVolume = false;
    protected $speakVolume = false;
    protected $maxVolumeAgeMinutes = 30;
    protected $lastKnownVolume = null;
    protected $lastKnownLemurVolume = null;
    protected $lastVolumeUpdateTime = 0;

    public function __construct($id, $email, $country, $userAgent)
    {
        $this->id = $id;
        $this->session = new AcxSession($id, $email, $country, $userAgent);
        $this->notificationsSeenUntil = time();
    }

    // -----------------------------------------------------------------------
    // Grundlagen
    // -----------------------------------------------------------------------

    public function setMode($mode)
    {
        $this->session->setMode($mode);
    }

    public function getMode()
    {
        return $this->session->getMode();
    }

    public function isManualMode()
    {
        return $this->session->isManualMode();
    }

    public function isAutoMode()
    {
        return $this->session->isAutoMode();
    }

    public function setRefreshToken($token)
    {
        $this->session->setRefreshToken($token);
    }

    public function setManualCookie($cookie)
    {
        $this->session->setManualCookie($cookie);
    }

    public function setCsrf($csrf)
    {
        $this->session->setCsrf($csrf);
    }

    public function setUserAgent($agent)
    {
        $this->session->setUserAgent($agent);
    }

    public function getUserAgent()
    {
        return $this->session->getUserAgent();
    }

    public function getConfig()
    {
        return $this->session->getConfig();
    }

    /**
     * @param bool $loadDevices
     * @return bool
     */
    public function authenticate($loadDevices = false)
    {
        if (!$this->session->authenticate()) {
            return false;
        }
        if ($loadDevices) {
            $this->loadDevices();
        }
        return true;
    }

    /**
     * Geraeteliste von Alexa holen (nur im Modus "auto").
     *
     * @return bool
     */
    public function loadDevices()
    {
        if ($this->isManualMode()) {
            return true;
        }

        $response = $this->session->request('GET', '/api/devices-v2/device?cached=false', 10);
        if (!$response->isOk()) {
            acxLog($this->id, 'Geraeteliste konnte nicht gelesen werden (HTTP ' . $response->httpCode . ')', null, 5);
            return false;
        }

        $payload = $response->json();
        if (!isset($payload['devices']) || !is_array($payload['devices'])) {
            acxLog($this->id, 'Geraeteliste hat ein unerwartetes Format', null, 5);
            return false;
        }

        $this->devices = array();
        $this->devicesBySerial = array();
        foreach ($payload['devices'] as $deviceData) {
            $family = isset($deviceData['deviceFamily']) ? $deviceData['deviceFamily'] : '';
            if (!in_array($family, self::$supportedFamilies, true)) {
                $this->reportUnsupportedDevice($deviceData, $family);
                continue;
            }
            $device = AcxEchoDevice::fromApi($deviceData);
            $this->devices[$device->name] = $device;
            $this->devicesBySerial[$device->serialNumber] = $device->name;
        }

        acxLog($this->id, 'Geraeteliste gelesen: ' . count($this->devices) . ' Geraet(e)', null, 7);
        return true;
    }

    /**
     * Meldet ein nicht unterstuetztes Geraet genau einmal pro Prozesslauf.
     *
     * Die Geraeteliste wird bei jeder Statusaktualisierung neu gelesen; ohne
     * diese Merkliste wuerde dieselbe Zeile im Minutentakt im Log stehen.
     *
     * @param array  $deviceData
     * @param string $family
     */
    protected function reportUnsupportedDevice(array $deviceData, $family)
    {
        $serial = isset($deviceData['serialNumber']) ? $deviceData['serialNumber'] : '';
        $key = ($serial !== '')
            ? $serial
            : (isset($deviceData['accountName']) ? $deviceData['accountName'] : '?') . '/' . $family;

        if (isset($this->unsupportedDevicesLogged[$key])) {
            return;
        }
        $this->unsupportedDevicesLogged[$key] = true;

        acxLog($this->id, 'Geraetefamilie wird nicht unterstuetzt: ' . $family
            . ' (Name "' . (isset($deviceData['accountName']) ? $deviceData['accountName'] : '?')
            . '", Typ "' . (isset($deviceData['deviceType']) ? $deviceData['deviceType'] : '?')
            . '") - wird ignoriert, Meldung nur einmal pro Lauf', null, 8);
    }

    /**
     * @return array Name => AcxEchoDevice
     */
    public function getDevices()
    {
        return $this->devices;
    }

    /**
     * @param string $name Geraet aus E6 (manual): Name,Typ,Seriennr,CustomerId,Familie
     * @return bool
     */
    public function addDeviceFromSpec($spec)
    {
        $parts = array_map('trim', explode(',', (string) $spec));
        if (count($parts) !== 5) {
            acxLog($this->id, 'Geraet konnte nicht angelegt werden: Format ist Name,Typ,Seriennummer,CustomerId,Familie', null, 5);
            return false;
        }

        $device = new AcxEchoDevice($parts[0], $parts[1], $parts[2], $parts[3], $parts[4]);
        $this->devices[$device->name] = $device;
        $this->devicesBySerial[$device->serialNumber] = $device->name;
        acxLog($this->id, 'Geraet angelegt: ' . $device->name, null, 6);
        return true;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function removeDevice($name)
    {
        $name = trim((string) $name);
        if (!isset($this->devices[$name])) {
            acxLog($this->id, 'Geraet nicht gefunden: ' . $name, null, 5);
            return false;
        }

        $device = $this->devices[$name];
        unset($this->devices[$name]);
        unset($this->devicesBySerial[$device->serialNumber]);
        if ($this->selectedDeviceName === $name) {
            $this->selectedDeviceName = null;
        }
        return true;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function selectDevice($name)
    {
        $name = trim((string) $name);
        if ($name === '') {
            $this->selectedDeviceName = null;
            acxLog($this->id, 'Kein Echo ausgewaehlt (E10 ist leer)', null, 5);
            return false;
        }
        if (!isset($this->devices[$name])) {
            $this->selectedDeviceName = null;
            acxLog($this->id, 'Echo nicht gefunden: ' . $name, null, 5);
            return false;
        }

        $this->selectedDeviceName = $name;
        acxLog($this->id, 'Echo ausgewaehlt: ' . $name, null, 6);
        return true;
    }

    /**
     * @return AcxEchoDevice|null
     */
    public function getSelectedDevice()
    {
        if ($this->selectedDeviceName !== null && isset($this->devices[$this->selectedDeviceName])) {
            return $this->devices[$this->selectedDeviceName];
        }
        return null;
    }

    /**
     * Liefert das ausgewaehlte Geraet oder null (mit Logmeldung).
     *
     * @return AcxEchoDevice|null
     */
    protected function requireDevice()
    {
        $device = $this->getSelectedDevice();
        if ($device === null) {
            acxLog($this->id, 'Befehl abgebrochen: kein gueltiges Echo ausgewaehlt', null, 5);
        }
        return $device;
    }

    // -----------------------------------------------------------------------
    // Lautstaerke / Sprechen
    // -----------------------------------------------------------------------

    /**
     * @param mixed $level
     * @return int|false
     */
    protected function sanitizeVolume($level)
    {
        if ($level === null || $level === false || $level === '') {
            return false;
        }
        if (!is_numeric(trim((string) $level))) {
            return false;
        }
        $level = (int) $level;
        return ($level >= 0 && $level <= 100) ? $level : false;
    }

    public function setSpeakVolume($volume)
    {
        $this->speakVolume = $this->sanitizeVolume($volume);
    }

    public function setDefaultVolume($volume)
    {
        $this->fallbackVolume = $this->sanitizeVolume($volume);
    }

    public function setMaxVolumeAge($minutes)
    {
        $this->maxVolumeAgeMinutes = max(0, (int) $minutes);
    }

    /**
     * @param int $level
     * @return bool
     */
    public function setVolume($level)
    {
        $rawLevel = $level;
        $level = $this->sanitizeVolume($level);
        if ($level === false) {
            acxLog($this->id, 'Ungueltige Lautstaerke: ' . $rawLevel, null, 5);
            return false;
        }

        $device = $this->requireDevice();
        if ($device === null) {
            return false;
        }

        $node = $this->buildDeviceNode('Alexa.DeviceControls.Volume', $device, array('value' => $level));
        if (!$this->executeSequence(array($node))) {
            return false;
        }

        // Optimistisch in A3 schreiben; der naechste Statusabruf korrigiert.
        $this->lastKnownVolume = $level;
        $this->lastVolumeUpdateTime = time();
        logic_setOutput($this->id, 3, $level);
        return true;
    }

    /**
     * Ermittelt die Lautstaerke, die nach dem Sprechen gesetzt wird.
     *
     * @return int
     */
    protected function determineRecoverVolume()
    {
        $candidates = array($this->lastKnownVolume, $this->lastKnownLemurVolume, $this->fallbackVolume);
        foreach ($candidates as $candidate) {
            $volume = $this->sanitizeVolume($candidate);
            if ($volume !== false) {
                return $volume;
            }
        }
        return self::DEFAULT_RECOVER_VOLUME;
    }

    /**
     * Zerlegt "|"-Format aus E42/E44.
     *
     * @param string $input
     * @return array|false
     */
    protected function parseSpeechInput($input)
    {
        $parts = explode('|', (string) $input);
        if (count($parts) > 3) {
            acxLog($this->id, 'Sprechbefehl hat mehr als 3 Teile', null, 5);
            return false;
        }

        $result = array('text' => '', 'volume' => null, 'recoverVolume' => null);

        if (count($parts) === 1) {
            $result['text'] = $parts[0];
            return $result;
        }

        $volume = $this->sanitizeVolume($parts[0]);
        $result['volume'] = ($volume === false) ? null : $volume;
        $result['text'] = $parts[1];

        if (count($parts) === 3) {
            $recover = $this->sanitizeVolume($parts[2]);
            $result['recoverVolume'] = ($recover === false) ? null : $recover;
        }

        return $result;
    }

    /**
     * @param string $input
     * @return bool
     */
    public function speak($input)
    {
        return $this->playSpeech($input, false);
    }

    /**
     * @param string $input
     * @return bool
     */
    public function announce($input)
    {
        return $this->playSpeech($input, true);
    }

    /**
     * Gemeinsame Umsetzung von E42 (Speak) und E44 (Announcement).
     *
     * @param string $input
     * @param bool   $asAnnouncement
     * @return bool
     */
    protected function playSpeech($input, $asAnnouncement)
    {
        $speech = $this->parseSpeechInput($input);
        if ($speech === false) {
            return false;
        }

        $device = $this->requireDevice();
        if ($device === null) {
            return false;
        }

        $speakVolume = ($speech['volume'] !== null) ? $speech['volume'] : $this->sanitizeVolume($this->speakVolume);
        $recoverVolume = ($speech['recoverVolume'] !== null) ? $speech['recoverVolume'] : $this->determineRecoverVolume();

        $nodes = array();
        if ($speakVolume !== false) {
            $nodes[] = $this->buildDeviceNode('Alexa.DeviceControls.Volume', $device, array('value' => $speakVolume));
        }

        if ($asAnnouncement) {
            $nodes[] = $this->buildAnnouncementNode($device, $speech['text']);
        } else {
            $nodes[] = $this->buildDeviceNode('Alexa.Speak', $device, array('textToSpeak' => $speech['text']));
        }

        if ($speakVolume !== false) {
            $nodes[] = $this->buildDeviceNode('Alexa.DeviceControls.Volume', $device, array('value' => $recoverVolume));
        }

        return $this->executeSequence($nodes);
    }

    /**
     * @param AcxEchoDevice $device
     * @param string        $text
     * @return array
     */
    protected function buildAnnouncementNode(AcxEchoDevice $device, $text)
    {
        $text = trim(str_replace("\n", ' ', (string) $text));
        $isSsml = (preg_match('/^<speak\b[^>]*>.*<\/speak>$/is', $text) === 1);

        return array(
            '@type' => 'com.amazon.alexa.behaviors.model.OpaquePayloadOperationNode',
            'type' => 'AlexaAnnouncement',
            'operationPayload' => array(
                'customerId' => $device->ownerCustomerId,
                'expireAfter' => 'PT5S',
                'content' => array(
                    array(
                        'locale'  => $this->session->getLocale(),
                        'display' => array(
                            'title' => self::ANNOUNCEMENT_TITLE,
                            'body'  => trim(strip_tags($text))
                        ),
                        'speak'   => array(
                            'type'  => $isSsml ? 'ssml' : 'text',
                            'value' => $text
                        )
                    )
                ),
                'target' => array(
                    'customerId' => $device->ownerCustomerId,
                    'devices'    => array(
                        array(
                            'deviceTypeId'       => $device->deviceType,
                            'deviceSerialNumber' => $device->serialNumber
                        )
                    )
                )
            )
        );
    }

    // -----------------------------------------------------------------------
    // Wiedergabe
    // -----------------------------------------------------------------------

    /**
     * @param string        $type
     * @param AcxEchoDevice $device
     * @param array         $payload
     * @return array
     */
    protected function buildDeviceNode($type, AcxEchoDevice $device, array $payload)
    {
        return array(
            '@type' => 'com.amazon.alexa.behaviors.model.OpaquePayloadOperationNode',
            'type' => $type,
            'operationPayload' => array_merge(array(
                'deviceType'         => $device->deviceType,
                'deviceSerialNumber' => $device->serialNumber,
                'customerId'         => $device->ownerCustomerId,
                'locale'             => $this->session->getLocale()
            ), $payload)
        );
    }

    /**
     * Fuehrt eine Alexa-Sequenz aus (/api/behaviors/preview).
     *
     * @param array $nodes
     * @return bool
     */
    protected function executeSequence(array $nodes)
    {
        if (!count($nodes)) {
            return false;
        }

        $startNode = (count($nodes) === 1) ? $nodes[0] : array(
            '@type'         => 'com.amazon.alexa.behaviors.model.SerialNode',
            'nodesToExecute' => $nodes
        );

        $sequence = array(
            '@type'     => 'com.amazon.alexa.behaviors.model.Sequence',
            'startNode' => $startNode
        );

        $sequenceJson = json_encode($sequence);
        if ($sequenceJson === false) {
            acxLog($this->id, 'Sequenz konnte nicht als JSON kodiert werden', null, 4);
            return false;
        }

        $response = $this->session->request('POST', '/api/behaviors/preview', 10, array(
            'behaviorId'   => 'PREVIEW',
            'sequenceJson' => $sequenceJson,
            'status'       => 'ENABLED'
        ));

        if (!$response->isOk()) {
            acxLog($this->id, 'Sequenz fehlgeschlagen (HTTP ' . $response->httpCode . ')', $response->body, 4);
            return false;
        }
        return true;
    }

    /**
     * @param array $command z.B. array('type' => 'PlayCommand')
     * @return bool
     */
    protected function sendPlayerCommand(array $command)
    {
        $device = $this->requireDevice();
        if ($device === null) {
            return false;
        }

        $response = $this->session->request('POST', '/api/np/command' . $this->buildDeviceQuery($device), 10, $command);
        if (!$response->isOk()) {
            acxLog($this->id, 'Player-Befehl fehlgeschlagen (HTTP ' . $response->httpCode . ')', $response->body, 4);
            return false;
        }
        return true;
    }

    /**
     * @param AcxEchoDevice $device
     * @param array         $extra
     * @return string
     */
    protected function buildDeviceQuery(AcxEchoDevice $device, array $extra = array())
    {
        $query = array_merge(array(
            'deviceSerialNumber' => $device->serialNumber,
            'deviceType'         => $device->deviceType
        ), $extra);
        return '?' . http_build_query($query);
    }

    public function play()
    {
        return $this->sendPlayerCommand(array('type' => 'PlayCommand'));
    }

    public function pause()
    {
        return $this->sendPlayerCommand(array('type' => 'PauseCommand'));
    }

    public function nextTrack()
    {
        return $this->sendPlayerCommand(array('type' => 'NextCommand'));
    }

    public function previousTrack()
    {
        return $this->sendPlayerCommand(array('type' => 'PreviousCommand'));
    }

    public function skipForward()
    {
        return $this->sendPlayerCommand(array('type' => 'ForwardCommand'));
    }

    public function skipBackward()
    {
        return $this->sendPlayerCommand(array('type' => 'RewindCommand'));
    }

    public function setShuffle($enabled)
    {
        return $this->sendPlayerCommand(array('type' => 'ShuffleCommand', 'shuffle' => (bool) $enabled));
    }

    public function setRepeat($enabled)
    {
        return $this->sendPlayerCommand(array('type' => 'RepeatCommand', 'repeat' => (bool) $enabled));
    }

    /**
     * TuneIn-Sender abspielen (Name oder ID).
     *
     * @param string $input
     * @return bool
     */
    public function playTuneInStation($input)
    {
        $station = $this->resolveTuneInStation($input);
        if ($station === false) {
            return false;
        }
        return $this->playSearchPhrase($station, 'TUNEIN');
    }

    /**
     * Loest "s12345" bzw. "1LIVE - s12345" in einen Sendernamen auf.
     *
     * @param string $input
     * @return string|false
     */
    protected function resolveTuneInStation($input)
    {
        $input = trim((string) $input);
        if ($input === '') {
            acxLog($this->id, 'TUNEIN: kein Sender angegeben', null, 5);
            return false;
        }

        if (!preg_match('/(?:^|[\s\-])([sp][0-9]{3,})\s*$/i', $input, $matches)) {
            return $input; // Sendername
        }

        $stationId = $matches[1];

        // TuneIn laeuft ueber einen anderen Host, daher eigener HTTP-Aufruf
        $response = $this->requestExternal('https://api.tunein.com/profiles/' . rawurlencode($stationId), 8);
        if ($response === null || !$response->isOk()) {
            acxLog($this->id, 'TUNEIN: ID ' . $stationId . ' nicht aufloesbar, Suche direkt', null, 5);
            return $stationId;
        }

        $data = $response->json();
        if (isset($data['Item']['Title']) && $data['Item']['Title'] !== '') {
            acxLog($this->id, 'TUNEIN: ' . $stationId . ' => ' . $data['Item']['Title'], null, 7);
            return $data['Item']['Title'];
        }

        acxLog($this->id, 'TUNEIN: ID ' . $stationId . ' ohne Titel, Suche direkt', null, 5);
        return $stationId;
    }

    /**
     * Suchphrase ueber Alexa abspielen.
     *
     * @param string $searchPhrase
     * @param string $provider
     * @return bool
     */
    protected function playSearchPhrase($searchPhrase, $provider)
    {
        $searchPhrase = trim((string) $searchPhrase);
        if ($searchPhrase === '') {
            return false;
        }

        $device = $this->requireDevice();
        if ($device === null) {
            return false;
        }

        $node = $this->buildDeviceNode('Alexa.Music.PlaySearchPhrase', $device, array(
            'searchPhrase'          => $searchPhrase,
            'sanitizedSearchPhrase' => $searchPhrase,
            'musicProviderId'       => $provider
        ));

        return $this->executeSequence(array($node));
    }

    /**
     * @param string $trackId
     * @return bool
     */
    public function playTrack($trackId)
    {
        return $this->queueAndPlay(array('trackId' => (string) $trackId, 'playQueuePrime' => true), '/api/cloudplayer/queue-and-play');
    }

    /**
     * @param string $playlistId
     * @return bool
     */
    public function playPlaylistById($playlistId)
    {
        return $this->queueAndPlay(array('playlistId' => (string) $playlistId, 'playQueuePrime' => true), '/api/cloudplayer/queue-and-play');
    }

    /**
     * @param string $asin
     * @return bool
     */
    public function playPrimePlaylist($asin)
    {
        return $this->queueAndPlay(array('asin' => (string) $asin), '/api/prime/prime-playlist-queue-and-play');
    }

    /**
     * @param string $seedId
     * @return bool
     */
    public function playPrimeStation($seedId)
    {
        $body = array(
            'seed'        => json_encode(array('type' => 'KEY', 'seedId' => (string) $seedId)),
            'stationName' => 'none',
            'seedType'    => 'KEY'
        );
        return $this->queueAndPlay($body, '/api/gotham/queue-and-play');
    }

    /**
     * @param string $queueId
     * @return bool
     */
    public function playPrimeHistory($queueId)
    {
        $device = $this->requireDevice();
        if ($device === null) {
            return false;
        }

        $body = array(
            'deviceType'          => $device->deviceType,
            'deviceSerialNumber'  => $device->serialNumber,
            'mediaOwnerCustomerId' => $device->ownerCustomerId,
            'queueId'             => (string) $queueId,
            'service'             => null,
            'trackSource'         => 'TRACK'
        );

        $response = $this->session->request('POST', '/api/media/play-historical-queue', 10, $body);
        return $this->isSuccessful($response, 'Historische Queue');
    }

    /**
     * Cloud-Player-Aufrufe (Track, Playlist, Prime).
     *
     * @param array  $body
     * @param string $path
     * @return bool
     */
    protected function queueAndPlay(array $body, $path)
    {
        $device = $this->requireDevice();
        if ($device === null) {
            return false;
        }

        $query = $this->buildDeviceQuery($device, array(
            'mediaOwnerCustomerId' => $device->ownerCustomerId,
            'shuffle'              => 'false'
        ));

        $response = $this->session->request('POST', $path . $query, 10, $body);
        return $this->isSuccessful($response, $path);
    }

    /**
     * @param AcxHttpResponse $response
     * @param string          $context
     * @return bool
     */
    protected function isSuccessful(AcxHttpResponse $response, $context)
    {
        if ($response->isOk()) {
            return true;
        }
        acxLog($this->id, $context . ' fehlgeschlagen (HTTP ' . $response->httpCode . ')', $response->body, 4);
        return false;
    }

    /**
     * HTTP-Aufruf an einen fremden Host (z.B. TuneIn).
     *
     * @param string $url
     * @param int    $timeout
     * @return AcxHttpResponse|null
     */
    protected function requestExternal($url, $timeout)
    {
        $client = new AcxHttpClient($this->session->getUserAgent());
        $response = $client->request('GET', $url, array('timeout' => $timeout));
        if ($response->error !== '') {
            acxLog($this->id, 'HTTP-Fehler bei ' . $url . ': ' . $response->error, null, 5);
        }
        return $response;
    }

    // -----------------------------------------------------------------------
    // Multiroom / Bluetooth
    // -----------------------------------------------------------------------

    public function setMultiroomGroupName($name)
    {
        $this->multiroomGroupName = trim((string) $name);
    }

    /**
     * E28 kann als String ("A,B") oder als Array kommen.
     *
     * @param mixed $members
     */
    public function setMultiroomMembers($members)
    {
        if (!is_array($members)) {
            $members = explode(',', (string) $members);
        }

        $members = array_map('trim', $members);
        $this->multiroomMembers = array_values(array_filter($members, function ($member) {
            return $member !== '';
        }));
    }

    /**
     * @return bool
     */
    public function createMultiroomGroup()
    {
        $name = trim($this->multiroomGroupName);
        if ($name === '' || count($this->multiroomMembers) < 2) {
            acxLog($this->id, 'Multiroom: Gruppenname (E27) und mindestens zwei Geraete (E28) noetig', null, 5);
            return false;
        }

        $members = array();
        foreach ($this->multiroomMembers as $memberName) {
            if (!isset($this->devices[$memberName])) {
                acxLog($this->id, 'Multiroom: Geraet nicht gefunden: ' . $memberName, null, 5);
                continue;
            }
            $members[] = array(
                'dsn'        => $this->devices[$memberName]->serialNumber,
                'deviceType' => $this->devices[$memberName]->deviceType
            );
        }

        if (!count($members)) {
            return false;
        }

        $response = $this->session->request('POST', '/api/lemur/tail', 10, array(
            'id'      => null,
            'name'    => $name,
            'members' => $members
        ));

        if (!$this->isSuccessful($response, 'Multiroom-Gruppe anlegen')) {
            return false;
        }

        $this->loadDevices();
        return true;
    }

    /**
     * @return bool
     */
    public function deleteMultiroomGroup()
    {
        $name = trim($this->multiroomGroupName);
        if ($name === '' || !isset($this->devices[$name])) {
            acxLog($this->id, 'Multiroom: Gruppe nicht gefunden: ' . $name, null, 5);
            return false;
        }

        $response = $this->session->request('DELETE', '/api/lemur/tail/' . rawurlencode($this->devices[$name]->serialNumber), 10);
        return $this->isSuccessful($response, 'Multiroom-Gruppe loeschen');
    }

    public function setBluetoothAddress($address)
    {
        $this->bluetoothAddress = trim((string) $address);
    }

    /**
     * @return bool
     */
    public function connectBluetooth()
    {
        $device = $this->requireDevice();
        if ($device === null) {
            return false;
        }
        if ($this->bluetoothAddress === '') {
            acxLog($this->id, 'Bluetooth: keine Adresse in E31', null, 5);
            return false;
        }

        $response = $this->session->request(
            'POST',
            '/api/bluetooth/pair-sink/' . rawurlencode($device->deviceType) . '/' . rawurlencode($device->serialNumber),
            10,
            array('bluetoothDeviceAddress' => $this->bluetoothAddress)
        );
        return $this->isSuccessful($response, 'Bluetooth verbinden');
    }

    /**
     * @return bool
     */
    public function disconnectBluetooth()
    {
        $device = $this->requireDevice();
        if ($device === null) {
            return false;
        }

        $response = $this->session->request(
            'POST',
            '/api/bluetooth/disconnect-sink/' . rawurlencode($device->deviceType) . '/' . rawurlencode($device->serialNumber),
            10
        );
        return $this->isSuccessful($response, 'Bluetooth trennen');
    }

    // -----------------------------------------------------------------------
    // Status
    // -----------------------------------------------------------------------

    /**
     * Player-, Queue- und State-Informationen holen.
     *
     * @param int $screenWidth
     * @return array|false
     */
    public function getStatus($screenWidth = 1280)
    {
        $device = $this->getSelectedDevice();
        if ($device === null) {
            return false;
        }

        $query = $this->buildDeviceQuery($device, array('screenWidth' => (int) $screenWidth));

        $response = $this->session->request('GET', '/api/np/player' . $query, AcxHttpClient::DEFAULT_TIMEOUT);
        if (!$response->isOk()) {
            acxLog($this->id, 'Statusabruf fehlgeschlagen (HTTP ' . $response->httpCode . ')', null, 7);
            return false;
        }

        $status = $this->extractPlayerInfo($response->json());
        $status['rawPlayer'] = $response->body;

        if (self::COLLECT_EXTENDED_STATUS) {
            $queue = $this->session->request('GET', '/api/np/queue' . $query, AcxHttpClient::DEFAULT_TIMEOUT);
            if ($queue->isOk()) {
                $status['rawQueue'] = $queue->body;
            }
            $state = $this->session->request('GET', '/api/media/state' . $query, AcxHttpClient::DEFAULT_TIMEOUT);
            if ($state->isOk()) {
                $status['rawState'] = $state->body;
            }
        }

        return $status;
    }

    /**
     * Wandelt die Alexa-Antwort in die Ausgaenge A3-A12 um.
     *
     * @param array|null $payload
     * @return array
     */
    protected function extractPlayerInfo($payload)
    {
        $status = array();
        if (!isset($payload['playerInfo']) || !is_array($payload['playerInfo'])) {
            return $status;
        }

        $playerInfo = $payload['playerInfo'];

        if (isset($playerInfo['infoText']) && is_array($playerInfo['infoText'])) {
            foreach (array('title', 'subText1', 'subText2') as $key) {
                if (isset($playerInfo['infoText'][$key])) {
                    $status[$key] = $playerInfo['infoText'][$key];
                }
            }
        }

        if (isset($playerInfo['provider']) && is_array($playerInfo['provider'])) {
            if (!empty($playerInfo['provider']['providerDisplayName'])) {
                $status['provider'] = $playerInfo['provider']['providerDisplayName'];
            } elseif (isset($playerInfo['provider']['providerName'])) {
                $status['provider'] = $playerInfo['provider']['providerName'];
            }
        }

        if (isset($playerInfo['state'])) {
            $status['state'] = $playerInfo['state'];
        }

        $currentVolume = null;
        if (isset($playerInfo['volume']) && is_array($playerInfo['volume'])) {
            $status['muted'] = empty($playerInfo['volume']['muted']) ? 0 : 1;
            if (isset($playerInfo['volume']['volume']) && $playerInfo['volume']['volume'] !== '') {
                $currentVolume = (int) $playerInfo['volume']['volume'];
            }
        }

        if ($currentVolume !== null) {
            $status['volume'] = $currentVolume;
            $this->lastKnownVolume = $currentVolume;
            $this->lastVolumeUpdateTime = time();
        } elseif ((time() - $this->lastVolumeUpdateTime) > ($this->maxVolumeAgeMinutes * 60)) {
            // Lautstaerke ist zu alt: als unbekannt melden
            $this->lastKnownVolume = null;
            $status['volume'] = false;
        }

        if (isset($playerInfo['mainArt']['url'])) {
            $status['artUrl'] = $playerInfo['mainArt']['url'];
        }

        if (array_key_exists('isPlayingInLemur', $playerInfo)) {
            $status['isPlayingInLemur'] = $playerInfo['isPlayingInLemur'];
        }

        $status['lemurVolume'] = isset($playerInfo['lemurVolume']) ? $playerInfo['lemurVolume'] : false;
        $this->lastKnownLemurVolume = $status['lemurVolume'];

        return $status;
    }

    /**
     * Lautstaerke und Mute direkt am Geraet abfragen (E54).
     *
     * @return array|false array('volume' => int|null, 'muted' => int)
     */
    public function refreshVolume()
    {
        $device = $this->getSelectedDevice();
        if ($device === null) {
            return false;
        }

        $response = $this->session->request('GET', '/api/devices/deviceType/dsn/audio/v1/allDeviceVolumes', 8);
        if (!$response->isOk()) {
            acxLog($this->id, 'Lautstaerke konnte nicht gelesen werden (HTTP ' . $response->httpCode . ')', null, 5);
            return false;
        }

        $data = $response->json();
        if (!isset($data['volumes']) || !is_array($data['volumes'])) {
            return false;
        }

        foreach ($data['volumes'] as $volumeInfo) {
            if (!isset($volumeInfo['dsn']) || $volumeInfo['dsn'] !== $device->serialNumber) {
                continue;
            }

            $volume = isset($volumeInfo['speakerVolume']) ? (int) $volumeInfo['speakerVolume'] : null;
            if ($volume !== null) {
                $this->lastKnownVolume = $volume;
                $this->lastVolumeUpdateTime = time();
            }

            return array(
                'volume' => $volume,
                'muted'  => empty($volumeInfo['speakerMuted']) ? 0 : 1
            );
        }

        return false;
    }

    // -----------------------------------------------------------------------
    // Routinen
    // -----------------------------------------------------------------------

    /**
     * Routinen einlesen und A22 schreiben.
     *
     * @return bool
     */
    public function readRoutines()
    {
        $response = $this->session->request('GET', '/api/behaviors/v2/automations?limit=200', 12);
        if (!$response->isOk()) {
            acxLog($this->id, 'Routinen konnten nicht gelesen werden (HTTP ' . $response->httpCode . ')', null, 5);
            return false;
        }

        $data = $response->json();
        if (isset($data['automations']) && is_array($data['automations'])) {
            $data = $data['automations'];
        }
        if (!is_array($data)) {
            return false;
        }

        $this->routines = array_values($data);

        $output = array();
        foreach ($this->routines as $index => $routine) {
            $item = array('name' => isset($routine['name']) ? $routine['name'] : '');
            if (isset($routine['triggers']) && is_array($routine['triggers'])) {
                foreach ($routine['triggers'] as $trigger) {
                    if (isset($trigger['payload']['utterance'])) {
                        $item['utterance'][] = $trigger['payload']['utterance'];
                    }
                }
            }
            $output[$index] = $item;
        }

        logic_setOutput($this->id, 22, json_encode($output));
        return true;
    }

    /**
     * Routine per Name oder Ausloese-Satz starten (E50).
     *
     * @param string $routineName
     * @return bool
     */
    public function runRoutine($routineName)
    {
        $routineName = trim((string) $routineName);
        if ($routineName === '') {
            return false;
        }

        if ($this->routines === false && !$this->readRoutines()) {
            return false;
        }

        $routineIndex = $this->findRoutine($routineName);
        if ($routineIndex === false) {
            acxLog($this->id, 'Routine nicht gefunden: ' . $routineName, null, 5);
            return false;
        }

        $device = $this->requireDevice();
        if ($device === null) {
            return false;
        }

        $routine = $this->routines[$routineIndex];
        if (!isset($routine['sequence'], $routine['automationId'])) {
            acxLog($this->id, 'Routine ist unvollstaendig: ' . $routineName, null, 5);
            return false;
        }

        $sequenceJson = json_encode($routine['sequence']);
        if ($sequenceJson === false) {
            acxLog($this->id, 'Routine konnte nicht als JSON kodiert werden: ' . $routineName, null, 4);
            return false;
        }
        $sequenceJson = str_replace('ALEXA_CURRENT_DEVICE_TYPE', $device->deviceType, $sequenceJson);
        $sequenceJson = str_replace('ALEXA_CURRENT_DSN', $device->serialNumber, $sequenceJson);

        $response = $this->session->request('POST', '/api/behaviors/preview', 10, array(
            'behaviorId'   => $routine['automationId'],
            'sequenceJson' => $sequenceJson,
            'status'       => 'ENABLED'
        ));

        return $this->isSuccessful($response, 'Routine "' . $routineName . '"');
    }

    /**
     * @param string $routineName
     * @return int|false
     */
    protected function findRoutine($routineName)
    {
        foreach ($this->routines as $index => $routine) {
            if (isset($routine['name']) && $routine['name'] === $routineName) {
                return $index;
            }
            if (isset($routine['triggers']) && is_array($routine['triggers'])) {
                foreach ($routine['triggers'] as $trigger) {
                    if (isset($trigger['payload']['utterance']) && $trigger['payload']['utterance'] === $routineName) {
                        return $index;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Eigenen Alexa-Skill starten (E55/E56).
     *
     * @param string $skillId
     * @param string $eventId
     * @param string $text
     * @return bool
     */
    public function launchSkill($skillId, $eventId, $text)
    {
        $skillId = trim((string) $skillId);
        if ($skillId === '') {
            acxLog($this->id, 'Actionable Notification: Skill-ID (E56) fehlt', null, 5);
            return false;
        }

        $device = $this->requireDevice();
        if ($device === null) {
            return false;
        }

        $state = json_encode(array('event' => $eventId, 'text' => $text));
        if ($state === false) {
            acxLog($this->id, 'Actionable Notification: Text konnte nicht kodiert werden', null, 4);
            return false;
        }
        if (!@file_put_contents(self::SKILL_INPUT_FILE, json_encode(array('state' => $state)))) {
            acxLog($this->id, 'Actionable Notification: ' . self::SKILL_INPUT_FILE . ' ist nicht beschreibbar', null, 5);
        }

        $node = array(
            '@type' => 'com.amazon.alexa.behaviors.model.OpaquePayloadOperationNode',
            'type'  => 'Alexa.Operation.SkillConnections.Launch',
            'operationPayload' => array(
                'targetDevice' => array(
                    'deviceType'         => $device->deviceType,
                    'deviceSerialNumber' => $device->serialNumber
                ),
                'locale'       => str_replace('-', '_', $this->session->getLocale()),
                'customerId'   => $device->ownerCustomerId,
                'connectionRequest' => array(
                    'uri'   => 'connection://AMAZON.Launch/' . $skillId,
                    'input' => new stdClass()
                )
            )
        );

        return $this->executeSequence(array($node));
    }

    // -----------------------------------------------------------------------
    // Alarme / Erinnerungen
    // -----------------------------------------------------------------------

    /**
     * Neue Alarme ermitteln und optional loeschen/deaktivieren.
     *
     * @param string $action       delete|disable|leer
     * @param bool   $onlySelected nur Alarme des Echos aus E10
     * @return array|false
     */
    public function refreshAlarms($action = '', $onlySelected = false)
    {
        $notifications = $this->fetchNotifications($onlySelected);
        if ($notifications === false) {
            return false;
        }

        $action = strtolower(trim((string) $action));
        $result = array();

        foreach ($notifications as $notification) {
            $item = $this->buildAlarmItem($notification);
            $result[] = $item;

            if (!$item['new']) {
                continue;
            }
            if ($item['id'] === '') {
                continue;
            }
            if ($action === 'delete') {
                $this->deleteAlarm($item['id'], $onlySelected);
            } elseif ($action === 'disable') {
                $this->disableAlarm($item['id'], $onlySelected);
            }
        }

        if (count($result)) {
            $this->notificationsSeenUntil = time();
        }

        return $result;
    }

    /**
     * @param array $notification
     * @return array
     */
    protected function buildAlarmItem(array $notification)
    {
        $createdDate = isset($notification['createdDate']) ? (float) $notification['createdDate'] : 0;
        $serial = isset($notification['deviceSerialNumber']) ? $notification['deviceSerialNumber'] : '';

        $item = array(
            'id'               => isset($notification['id']) ? $notification['id'] : '',
            'new'              => ($this->notificationsSeenUntil < ($createdDate / 1000)) ? 1 : 0,
            'device'           => isset($this->devicesBySerial[$serial]) ? $this->devicesBySerial[$serial] : 'unknown',
            'createTime'       => $createdDate > 0 ? date('H:i:s', (int) ($createdDate / 1000)) : '',
            'createDate'       => $createdDate > 0 ? date('m.d.y', (int) ($createdDate / 1000)) : '',
            'alarmTime'        => '',
            'alarmDate'        => isset($notification['originalDate']) ? $notification['originalDate'] : '',
            'type'             => isset($notification['type']) ? $notification['type'] : '',
            'reminderLabel'    => isset($notification['reminderLabel']) ? $notification['reminderLabel'] : '',
            'status'           => isset($notification['status']) ? $notification['status'] : '',
            'recurringPattern' => isset($notification['recurringPattern']) ? $notification['recurringPattern'] : '',
            'snoozedToTime'    => isset($notification['snoozedToTime']) ? $notification['snoozedToTime'] : ''
        );

        if (isset($notification['originalTime']) && preg_match('/^([0-9]{2}:[0-9]{2}:[0-9]{2}).*$/', $notification['originalTime'], $matches)) {
            $item['alarmTime'] = $matches[1];
        } elseif (isset($notification['originalTime'])) {
            $item['alarmTime'] = $notification['originalTime'];
        }

        return $item;
    }

    /**
     * Rohe Benachrichtigungen von Alexa.
     *
     * @param bool $onlySelected
     * @return array|false
     */
    protected function fetchNotifications($onlySelected = false)
    {
        $response = $this->session->request('GET', '/api/notifications', 10);
        if (!$response->isOk()) {
            acxLog($this->id, 'Alarme konnten nicht gelesen werden (HTTP ' . $response->httpCode . ')', null, 5);
            return false;
        }

        $data = $response->json();
        if (!isset($data['notifications']) || !is_array($data['notifications'])) {
            return false;
        }

        if (!$onlySelected) {
            return $data['notifications'];
        }

        $device = $this->getSelectedDevice();
        if ($device === null) {
            return array();
        }

        $filtered = array();
        foreach ($data['notifications'] as $notification) {
            if (isset($notification['deviceSerialNumber']) && $notification['deviceSerialNumber'] === $device->serialNumber) {
                $filtered[] = $notification;
            }
        }
        return $filtered;
    }

    /**
     * @param string $notificationId
     * @param bool   $onlySelected
     * @return array|null
     */
    protected function fetchNotification($notificationId, $onlySelected = false)
    {
        $response = $this->session->request('GET', '/api/notifications/' . rawurlencode($notificationId), 10);
        if (!$response->isOk()) {
            return null;
        }

        $data = $response->json();
        if (!is_array($data)) {
            return null;
        }

        if ($onlySelected) {
            $device = $this->getSelectedDevice();
            if ($device === null || !isset($data['deviceSerialNumber']) || $data['deviceSerialNumber'] !== $device->serialNumber) {
                return null;
            }
        }

        return $data;
    }

    /**
     * Ermittelt die betroffenen Alarme ("all" oder eine ID).
     *
     * @param string $notificationId
     * @param bool   $onlySelected
     * @return array
     */
    protected function resolveAlarmTargets($notificationId, $onlySelected)
    {
        if (strtolower(trim((string) $notificationId)) === 'all') {
            $notifications = $this->fetchNotifications($onlySelected);
            return is_array($notifications) ? $notifications : array();
        }

        $notification = $this->fetchNotification($notificationId, $onlySelected);
        return ($notification === null) ? array() : array($notification);
    }

    /**
     * @param string $notificationId
     * @param bool   $onlySelected
     * @return bool
     */
    public function enableAlarm($notificationId, $onlySelected = false)
    {
        return $this->setAlarmStatus($notificationId, $onlySelected, 'ON');
    }

    /**
     * @param string $notificationId
     * @param bool   $onlySelected
     * @return bool
     */
    public function disableAlarm($notificationId, $onlySelected = false)
    {
        return $this->setAlarmStatus($notificationId, $onlySelected, 'OFF');
    }

    /**
     * @param string $notificationId
     * @param bool   $onlySelected
     * @param string $status ON|OFF
     * @return bool
     */
    protected function setAlarmStatus($notificationId, $onlySelected, $status)
    {
        $targets = $this->resolveAlarmTargets($notificationId, $onlySelected);
        if (!count($targets)) {
            acxLog($this->id, 'Alarm nicht gefunden: ' . $notificationId, null, 5);
            return false;
        }

        $success = true;
        foreach ($targets as $notification) {
            if (!isset($notification['id'])) {
                continue;
            }
            $notification['status'] = $status;
            $response = $this->session->request(
                'PUT',
                '/api/notifications/' . rawurlencode($notification['id']),
                10,
                $notification
            );
            if (!$this->isSuccessful($response, 'Alarm ' . $notification['id'] . ' auf ' . $status . ' setzen')) {
                $success = false;
            }
        }
        return $success;
    }

    /**
     * @param string $notificationId
     * @param bool   $onlySelected
     * @return bool
     */
    public function deleteAlarm($notificationId, $onlySelected = false)
    {
        $targets = $this->resolveAlarmTargets($notificationId, $onlySelected);
        if (!count($targets)) {
            acxLog($this->id, 'Alarm nicht gefunden: ' . $notificationId, null, 5);
            return false;
        }

        $success = true;
        foreach ($targets as $notification) {
            if (!isset($notification['id'])) {
                continue;
            }
            $response = $this->session->request('DELETE', '/api/notifications/' . rawurlencode($notification['id']), 10);
            if (!$this->isSuccessful($response, 'Alarm ' . $notification['id'] . ' loeschen')) {
                $success = false;
            }
        }
        return $success;
    }
}

/**
 * Nachrichtenschleife des Daemons.
 */
class AcxDaemon
{
    const LOOP_INTERVAL_MICROSECONDS = 100000;
    const STATUS_DEBOUNCE_SECONDS = 5;
    const MAX_MESSAGES_PER_LOOP = 50;

    protected $id;
    protected $queueId = 0;
    protected $queue = null;
    protected $control = null;

    protected $screenWidth = 1280;
    protected $fallbackCoverUrl = '';
    protected $updateInterval = 10;
    protected $alarmMode = 0;
    protected $alarmAction = '';
    protected $skillId = '';

    protected $nextStatusUpdate = 0;
    protected $alarmsDirty = true;
    protected $previousStatus = array();

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Hauptschleife.
     */
    public function run()
    {
        $this->queueId = (int) logic_getVar($this->id, 1);
        if ($this->queueId <= 0) {
            acxLog($this->id, 'Kein Message-Queue-Id vorhanden - Daemon wird beendet', null, 3);
            return;
        }

        $this->queue = msg_get_queue($this->queueId);
        if ($this->queue === false) {
            acxLog($this->id, 'Message-Queue ' . $this->queueId . ' nicht verfuegbar - Daemon wird beendet', null, 3);
            return;
        }

        acxInstallErrorHandler($this->id);
        $this->clearStatusOutputs();
        acxLog($this->id, 'Daemon gestartet (Message-Queue ' . $this->queueId . ')', null, 7);

        while (getSysInfo(1)) {
            $this->processPendingMessages();
            $this->updateStatusIfDue();
            $this->pollAlarmsIfDue();
            usleep(self::LOOP_INTERVAL_MICROSECONDS);
        }

        acxLog($this->id, 'Daemon beendet', null, 7);
    }

    // -----------------------------------------------------------------------
    // Nachrichten
    // -----------------------------------------------------------------------

    /**
     * Leert die Message-Queue und verarbeitet alle Befehle.
     */
    protected function processPendingMessages()
    {
        for ($i = 0; $i < self::MAX_MESSAGES_PER_LOOP; $i++) {
            $messageType = 0;
            $errorCode = 0;
            $message = null;

            $received = @msg_receive($this->queue, 1, $messageType, 65536, $message, true, MSG_IPC_NOWAIT | MSG_NOERROR, $errorCode);
            if (!$received) {
                return;
            }
            if (!is_array($message) || !count($message)) {
                continue;
            }

            if (isset($message['start'])) {
                $this->handleStart();
                continue;
            }

            foreach ($message as $commandName => $commandValue) {
                $this->executeCommand($commandName, $commandValue);
            }
        }

        acxLog($this->id, 'Nachrichtenstau: weitere Befehle folgen im naechsten Durchlauf', null, 5);
    }

    /**
     * Fuehrt einen einzelnen Befehl aus und schreibt A1.
     *
     * @param string $name
     * @param mixed  $value
     */
    protected function executeCommand($name, $value)
    {
        if ($this->control === null) {
            acxLog($this->id, 'Befehl "' . $name . '" ohne gestarteten Daemon ignoriert', null, 5);
            return;
        }

        if (!$this->control->isManualMode() && !$this->control->authenticate()) {
            acxLog($this->id, 'Befehl "' . $name . '" abgebrochen: keine Verbindung zu Alexa', null, 4);
            return;
        }

        acxLog($this->id, 'Befehl: ' . $name . ' => ' . $this->describeValue($value), null, 7);

        $result = $this->handleCommand($name, $value);
        if ($result !== null) {
            logic_setOutput($this->id, 1, $result ? 'OK' : 'ERROR');
        }
    }

    /**
     * Kuerzt lange Werte (Cookie, Refresh-Token) fuer das Log.
     *
     * @param mixed $value
     * @return string
     */
    protected function describeValue($value)
    {
        if (is_array($value)) {
            return json_encode($value);
        }
        if (!is_string($value)) {
            return var_export($value, true);
        }
        if (strlen($value) > 120) {
            return substr($value, 0, 60) . '...(' . strlen($value) . ' Zeichen)';
        }
        return $value;
    }

    /**
     * Startmeldung: Konfiguration einlesen und verbinden.
     */
    protected function handleStart()
    {
        $inputs = logic_getInputs($this->id);
        if (!$inputs) {
            acxLog($this->id, 'Start abgebrochen: Eingaenge nicht lesbar', null, 4);
            return;
        }

        $this->readConfiguration($inputs);

        $userAgent = $this->inputValue($inputs, 43);
        if ($userAgent === '') {
            $userAgent = AcxSession::DEFAULT_USER_AGENT;
        }
        logic_setOutput($this->id, 21, $userAgent);

        $control = new AlexaControl($this->id, $this->inputValue($inputs, 3), $this->inputValue($inputs, 5), $userAgent);
        $control->setMode($this->inputValue($inputs, 38));
        $control->setRefreshToken($this->inputValue($inputs, 57));
        $control->setSpeakVolume($this->inputValue($inputs, 51));
        $control->setDefaultVolume($this->inputValue($inputs, 52));
        $control->setMaxVolumeAge($this->inputValue($inputs, 53, 30));
        $this->control = $control;

        acxLog($this->id, 'Start im Modus "' . $control->getMode() . '"', null, 7);

        if (!$control->authenticate(true)) {
            acxLog($this->id, 'Verbindung zu Alexa fehlgeschlagen - naechster Befehl versucht es erneut', null, 4);
            return;
        }
        acxLog($this->id, 'Verbindung zu Alexa hergestellt', null, 6);

        if ($control->isManualMode()) {
            $control->setManualCookie($this->inputValue($inputs, 8));
            $control->setCsrf($this->inputValue($inputs, 9));

            $deviceSpec = trim($this->inputValue($inputs, 6));
            if ($deviceSpec !== '') {
                $control->addDeviceFromSpec($deviceSpec);
            }
        }

        $control->selectDevice($this->inputValue($inputs, 10));
        $control->setMultiroomGroupName($this->inputValue($inputs, 27));
        $control->setMultiroomMembers($this->inputValue($inputs, 28));
        $control->setBluetoothAddress($this->inputValue($inputs, 31));

        $this->publishDevices();
        $this->scheduleStatusUpdate();
        $this->alarmsDirty = true;
    }

    /**
     * @param array $inputs
     */
    protected function readConfiguration(array $inputs)
    {
        $this->screenWidth = max(1, (int) $this->inputValue($inputs, 35, 1280));
        $this->fallbackCoverUrl = $this->inputValue($inputs, 34);
        $this->alarmMode = (int) $this->inputValue($inputs, 40, 0);
        $this->alarmAction = trim($this->inputValue($inputs, 41));
        $this->skillId = trim($this->inputValue($inputs, 56));

        $interval = (int) $this->inputValue($inputs, 36, 10);
        $this->updateInterval = ($interval > 0) ? $interval : 0;
    }

    /**
     * @param array  $inputs
     * @param int    $index
     * @param mixed  $default
     * @return mixed
     */
    protected function inputValue(array $inputs, $index, $default = '')
    {
        return isset($inputs[$index]['value']) ? $inputs[$index]['value'] : $default;
    }

    // -----------------------------------------------------------------------
    // Befehle
    // -----------------------------------------------------------------------

    /**
     * @param string $name
     * @param mixed  $value
     * @return bool|null true=OK, false=ERROR, null=keine Ausgabe auf A1
     */
    protected function handleCommand($name, $value)
    {
        if ($this->control === null) {
            acxLog($this->id, 'Befehl "' . $name . '" ohne Verbindung ignoriert', null, 5);
            return false;
        }

        switch ($name) {
            case 'mode':
                $this->control->setMode($value);
                return null;

            case 'refreshToken':
                $this->control->setRefreshToken($value);
                return null;

            case 'userAgent':
                $this->control->setUserAgent($value);
                logic_setOutput($this->id, 21, $this->control->getUserAgent());
                return null;

            case 'cookie':
                $this->control->setManualCookie($value);
                return null;

            case 'csrf':
                $this->control->setCsrf($value);
                return null;

            case 'addDevice':
                if (!$this->control->isManualMode()) {
                    acxLog($this->id, 'E6 wird nur im Modus "manual" verwendet', null, 5);
                    return false;
                }
                $added = $this->control->addDeviceFromSpec($value);
                if ($added) {
                    $this->publishDevices();
                }
                return $added;

            case 'deleteDevice':
                if (!$this->control->isManualMode()) {
                    acxLog($this->id, 'E7 wird nur im Modus "manual" verwendet', null, 5);
                    return false;
                }
                $removed = $this->control->removeDevice($value);
                if ($removed) {
                    $this->publishDevices();
                }
                return $removed;

            case 'selectDevice':
                $selected = $this->control->selectDevice($value);
                if ($selected) {
                    $this->clearStatusOutputs();
                    $this->scheduleStatusUpdate();
                }
                return $selected;

            case 'refreshDevices':
                $loaded = $this->control->isAutoMode() ? $this->control->loadDevices() : true;
                if ($loaded) {
                    $this->publishDevices();
                }
                return $loaded;

            case 'play':
                return $this->runPlayback('play');
            case 'pause':
                return $this->runPlayback('pause');
            case 'next':
                return $this->runPlayback('nextTrack');
            case 'previous':
                return $this->runPlayback('previousTrack');
            case 'forward':
                return $this->runPlayback('skipForward');
            case 'rewind':
                return $this->runPlayback('skipBackward');

            case 'volume':
                return $this->runPlayback('setVolume', $value);
            case 'shuffle':
                return $this->runPlayback('setShuffle', $value);
            case 'repeat':
                return $this->runPlayback('setRepeat', $value);

            case 'tuneInStation':
                return $this->runPlayback('playTuneInStation', $value);
            case 'libraryTrack':
                return $this->runPlayback('playTrack', $value);
            case 'libraryPlaylist':
                return $this->runPlayback('playPlaylistById', $value);
            case 'primePlaylist':
                return $this->runPlayback('playPrimePlaylist', $value);
            case 'primeStation':
                return $this->runPlayback('playPrimeStation', $value);
            case 'primeHistory':
                return $this->runPlayback('playPrimeHistory', $value);

            case 'speak':
                return $this->control->speak($value);

            case 'announce':
                return $this->control->announce($value);

            case 'statusUpdate':
                $this->scheduleStatusUpdate();
                return null;

            case 'fallbackCoverUrl':
                $this->fallbackCoverUrl = (string) $value;
                $this->scheduleStatusUpdate();
                return true;

            case 'screenWidth':
                $this->screenWidth = max(1, (int) $value);
                $this->scheduleStatusUpdate();
                return true;

            case 'updateInterval':
                $this->setUpdateInterval($value);
                return true;

            case 'alarmMode':
                $this->alarmMode = (int) $value;
                $this->alarmsDirty = true;
                return null;

            case 'alarmAction':
                $this->alarmAction = trim((string) $value);
                return null;

            case 'alarmEnable':
                return $this->changeAlarms('enable', $value);

            case 'alarmDisable':
                return $this->changeAlarms('disable', $value);

            case 'alarmDelete':
                return $this->changeAlarms('delete', $value);

            case 'readRoutines':
                return $this->control->readRoutines();

            case 'runRoutine':
                return $this->control->runRoutine($value);

            case 'skillId':
                $this->skillId = trim((string) $value);
                return null;

            case 'action':
                return $this->handleActionableNotification($value);

            case 'multiroomName':
                $this->control->setMultiroomGroupName($value);
                return null;

            case 'multiroomMembers':
                $this->control->setMultiroomMembers($value);
                return null;

            case 'multiroomCreate':
                return $this->runPlayback('createMultiroomGroup');

            case 'multiroomDelete':
                return $this->runPlayback('deleteMultiroomGroup');

            case 'bluetoothAddress':
                $this->control->setBluetoothAddress($value);
                return null;

            case 'bluetoothConnect':
                return $this->control->connectBluetooth();

            case 'bluetoothDisconnect':
                return $this->control->disconnectBluetooth();

            case 'speakVolume':
                $this->control->setSpeakVolume($value);
                return null;

            case 'defaultVolume':
                $this->control->setDefaultVolume($value);
                return null;

            case 'maxVolumeAge':
                $this->control->setMaxVolumeAge($value);
                return null;

            case 'refreshVolume':
                return $this->handleRefreshVolume($value);

            default:
                acxLog($this->id, 'Unbekannter Befehl: ' . $name, null, 5);
                return false;
        }
    }

    /**
     * @param string $method
     * @param mixed  $argument null = Methode ohne Argument
     * @return bool
     */
    protected function runPlayback($method, $argument = null)
    {
        $result = ($argument === null) ? $this->control->$method() : $this->control->$method($argument);
        $this->scheduleStatusUpdate();
        return $result;
    }

    /**
     * @param string $action enable|disable|delete
     * @param string $alarmId
     * @return bool
     */
    protected function changeAlarms($action, $alarmId)
    {
        $onlySelected = ($this->alarmMode > 1);

        if ($action === 'enable') {
            $result = $this->control->enableAlarm($alarmId, $onlySelected);
        } elseif ($action === 'disable') {
            $result = $this->control->disableAlarm($alarmId, $onlySelected);
        } else {
            $result = $this->control->deleteAlarm($alarmId, $onlySelected);
        }

        $this->alarmsDirty = true;
        return $result;
    }

    /**
     * @param mixed $value
     * @return bool|null
     */
    protected function handleRefreshVolume($value)
    {
        if ((int) $value !== 1) {
            return null;
        }

        $volumeInfo = $this->control->refreshVolume();
        if (!is_array($volumeInfo)) {
            return false;
        }

        if ($volumeInfo['volume'] !== null) {
            logic_setOutput($this->id, 3, $volumeInfo['volume']);
        }
        logic_setOutput($this->id, 4, $volumeInfo['muted']);
        return true;
    }

    /**
     * E55: "ID|TEXT" an den eigenen Skill schicken.
     *
     * @param mixed $value
     * @return bool
     */
    protected function handleActionableNotification($value)
    {
        $parts = explode('|', (string) $value, 2);
        if (count($parts) !== 2 || trim($parts[0]) === '') {
            acxLog($this->id, 'E55 erwartet das Format "ID|TEXT"', null, 5);
            return false;
        }

        if ($this->skillId === '') {
            acxLog($this->id, 'Actionable Notification: E56 (Skill-ID) ist leer', null, 5);
            return false;
        }

        if ($this->control === null) {
            acxLog($this->id, 'Actionable Notification: keine Verbindung zu Alexa', null, 5);
            return false;
        }

        return $this->control->launchSkill($this->skillId, trim($parts[0]), $parts[1]);
    }

    /**
     * @param mixed $value
     */
    protected function setUpdateInterval($value)
    {
        $interval = (int) $value;
        $this->updateInterval = ($interval > 0) ? $interval : 0;

        if ($this->updateInterval === 0) {
            // Keine periodische Aktualisierung mehr. Ein bereits terminierter
            // Abruf (z.B. direkt nach dem Start oder nach einem Befehl) bleibt
            // bestehen und laeuft genau einmal.
            acxLog($this->id, 'Automatische Statusaktualisierung deaktiviert', null, 6);
            return;
        }

        $this->scheduleStatusUpdate();
    }

    // -----------------------------------------------------------------------
    // Status und Alarme
    // -----------------------------------------------------------------------

    protected function scheduleStatusUpdate()
    {
        $this->nextStatusUpdate = microtime(true) + self::STATUS_DEBOUNCE_SECONDS;
    }

    /**
     * Schreibt A2 und A14 und aktualisiert /tmp/.echos.inc.php.
     */
    protected function publishDevices()
    {
        $namesBySerial = array();
        $onlineStates = array();

        foreach ($this->control->getDevices() as $device) {
            $namesBySerial[$device->serialNumber] = $device->name;
            if ($this->control->isAutoMode()) {
                $online = $device->isOnline() ? 1 : 0;
                $onlineStates[$device->name] = $online;
                $onlineStates[$device->name . '_pretty'] = $online ? 'ONLINE' : 'OFFLINE';
            }
        }

        logic_setOutput($this->id, 2, json_encode($namesBySerial));
        if ($this->control->isAutoMode()) {
            logic_setOutput($this->id, 14, json_encode($onlineStates));
        }

        $this->writeEchoCacheFile($namesBySerial);
    }

    /**
     * Schreibt die Geraeteliste fuer externe Scripte (unveraendertes Format).
     *
     * @param array $namesBySerial
     */
    protected function writeEchoCacheFile(array $namesBySerial)
    {
        $content = "<?php\n\n"
            . '$echos = ' . var_export($namesBySerial, true) . ";\n\n"
            . '$config = ' . var_export($this->control->getConfig(), true) . ";\n\n"
            . "?>\n";

        if (@file_put_contents('/tmp/.echos.inc.php', $content, LOCK_EX) === false) {
            acxLog($this->id, '/tmp/.echos.inc.php ist nicht beschreibbar', null, 5);
        }
    }

    /**
     * Regelt Statusabruf und Intervall.
     */
    protected function updateStatusIfDue()
    {
        if ($this->control === null) {
            return;
        }

        $now = microtime(true);
        if ($this->nextStatusUpdate <= 0 || $now < $this->nextStatusUpdate) {
            return;
        }

        if ($this->updateInterval > 0) {
            $this->nextStatusUpdate += $this->updateInterval;
            if ($this->nextStatusUpdate <= $now) {
                // Rueckstand aufholen, ohne mehrere Abrufe direkt hintereinander
                $this->nextStatusUpdate = $now + $this->updateInterval;
            }
        } else {
            $this->nextStatusUpdate = 0;
        }

        if ($this->control->loadDevices()) {
            $this->publishDevices();
        }

        $status = $this->control->getStatus($this->screenWidth);
        if ($status === false) {
            logic_setOutput($this->id, 13, 0);
        } else {
            $this->publishStatus($status);
            logic_setOutput($this->id, 20, date('H:i:s - d.m.Y'));
            logic_setOutput($this->id, 13, 1);
        }

        $this->alarmsDirty = true;
    }

    /**
     * @param array $status
     */
    protected function publishStatus(array $status)
    {
        $outputMap = array(
            'volume'          => 3,
            'muted'           => 4,
            'title'           => 5,
            'subText1'        => 6,
            'subText2'        => 7,
            'provider'        => 8,
            'state'           => 10,
            'isPlayingInLemur' => 11,
            'lemurVolume'     => 12,
            'rawPlayer'       => 15,
            'rawQueue'        => 16,
            'rawState'        => 17
        );

        foreach ($outputMap as $statusKey => $outputIndex) {
            if (!array_key_exists($statusKey, $status)) {
                continue;
            }
            $this->setOutputIfChanged($outputIndex, $statusKey, $status[$statusKey]);
        }

        // Cover-Bild inklusive Ersatzbild (E34)
        if (array_key_exists('artUrl', $status)) {
            $stateIsIdle = (isset($status['state']) && $status['state'] === 'IDLE');
            $artUrl = ($stateIsIdle || $status['artUrl'] === '') ? $this->fallbackCoverUrl : $status['artUrl'];
            $this->setOutputIfChanged(9, 'artUrl', $artUrl);
        }
    }

    /**
     * @param int    $outputIndex
     * @param string $cacheKey
     * @param mixed  $value
     */
    protected function setOutputIfChanged($outputIndex, $cacheKey, $value)
    {
        if (array_key_exists($cacheKey, $this->previousStatus) && $this->previousStatus[$cacheKey] === $value) {
            return;
        }
        $this->previousStatus[$cacheKey] = $value;
        logic_setOutput($this->id, $outputIndex, $value);
    }

    /**
     * Setzt A3-A12 und A15-A17 zurueck (z.B. nach Geraetewechsel).
     */
    protected function clearStatusOutputs()
    {
        $this->previousStatus = array();
        foreach (array(3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 15, 16, 17) as $outputIndex) {
            logic_setOutput($this->id, $outputIndex, '');
        }
    }

    /**
     * Alarmabfrage, wenn faellig.
     */
    protected function pollAlarmsIfDue()
    {
        if ($this->control === null || $this->alarmMode <= 0 || !$this->alarmsDirty) {
            return;
        }

        $this->alarmsDirty = false;
        acxLog($this->id, 'Alarme werden aktualisiert', null, 7);

        $alarms = $this->control->refreshAlarms($this->alarmAction, $this->alarmMode > 1);
        if (!is_array($alarms)) {
            return;
        }

        foreach ($alarms as $alarm) {
            if (!empty($alarm['new'])) {
                logic_setOutputQueued($this->id, 18, json_encode($alarm));
            }
        }
        logic_setOutputQueued($this->id, 19, json_encode($alarms));
    }
}

/* --------------------------------------------------------------------------
 * Start
 * ----------------------------------------------------------------------- */

$acxDaemon = new AcxDaemon($id);
$acxDaemon->run();

sql_disconnect();

?>
###[/EXEC]###
