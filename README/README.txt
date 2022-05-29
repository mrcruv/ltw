CONTATTI:
Federico Detomaso, detomaso.1903906@studenti.uniroma1.it
Marco Ruvolo, ruvolo.1883257@studenti.uniroma1.it

REPOSITORY GITHUB: https://github.com/mrcruv/ltw

Il progetto presentato è una piattaforma che funge da punto di incontro tra enti (pubblici e privati) ed esperti (in vari settori).
La piattaforma presenta un modulo di login per gli utenti registrati e due moduli di registrazione (uno per gli enti ed uno per gli esperti).
Un esempio di caso d'uso per un utente-ente è il seguente: l'ente si registra alla piattaforma, effettua il login, inserisce nuovi processi,
consulta la lista degli esperti iscritti, aggiunge nuove assegnazioni di processi ad esperti.
Un altro esempio di caso d'uso per un utente-esperto è il seguente: l'esperto si registra alla piattaforma, effettua il login, inserisce i propri
titoli di studio e le proprie competenze, all'arrivo dell'assegnazione di un processo da parte di un ente accetta/rifiuta l'assegnazione.
Sono state implementate le operazioni basilari CRUDI (Create, Read, Update, Delete, Index) per ogni oggetto utilizzato nella piattaforma (per alcuni oggetti non tutte le 5
operazioni sono state implementate).
In particolare, l'operazione Update è stata prevista solo per le informazioni associate all'account di un utente (sito web, PEC, ecc...);
l'operazione Delete non è stata prevista, ad esempio, per le assegnazioni e per i processi.
In ogni caso, l'evoluzione dell'applicazione ne prevede l'implementazione per pressoché tutti gli oggetti utilizzati; inoltre, già in fase di progettazione concettuale,
sono stati individuati ulteriori aspetti addizionali rispetto a quelli già implementati nella versione DEMO della piattaforma:
attributo data_conclusione in Processi (+ funzionalità associate), generalizzazione Titoli di studio in Diploma, Laurea, ecc... (+ funzionalità associate) ed altri.
Essendo questa una versione dimostrativa, questi aspetti e funzionalità avanzate non sono state implementate, sebbene gli autori dell'applicazione abbiano intenzione di proseguire
nello sviluppo di una versione più ricca della piattaforma.

Tecnologie usate: HTML, Bootstrap, JavaScript (JQuery), PHP, MySQL.
Altri strumenti usati: XAMPP (Apache Web Server, MySQL, PHP), GitHub (code versioning e sviluppo collaborativo),
	diagrams.net (per disegnare diagrammi ER), VSC e PhpStorm (editor/IDE)

Per quanto riguarda gli aspetti più tecnici, si riporta di seguito una breve descrizione della struttura dei file componenti l'applicazione.
La directory del progetto contiene:
-le pagine principali dell'applicazione (assegnazioni, competenze, esperti, index, me, processi, titoli)
-una sottodirectory css, contenente il foglio di stile style utilizzato ricorrentemente nelle pagine principali
-una sottodirectory scripts, contenente vari scripts in PHP e JS (JQuery) utilizzati per diversi scopi tra cui validazione form (lato client, lato server),
	operazioni CRUDI (prefissi add, delete, update, show), effetti grafici/gestione eventi/visualizzazione alert (error, message, form_switch, toggle_psw, ecc...)
-una sottodirectory includes, contenente files (fondamentalmente scripts PHP) inclusi ricorrentemente in più pagine dell'applicazione (modularità e riuso del codice!)
-una sottodirectory img, contenente le immagini utilizzate nell'applicazione
-una sottodirectory README, contenente i diagrammi concettuali e logici in formato JPG e drawio, gli script SQL per la creazione e popolazione del database, questo file README

Suddivisione task di progettazione e sviluppo:
Federico Detomaso: validazione lato client, grafica con bootstrap, interazione utente con JS/JQuery, effetti grafici
Marco Ruvolo: validazione lato server, interazione con server (query, ecc...), strutturazione 

NOTA:
Abbiamo privilegiato una linea di sviluppo che si incentrasse soprattutto sul buon funzionamento e sulla manutenibilità dell'applicazione: per raggiungere un buon livello di
modularità, i vari script sono stati scritti in file separati, in cartelle apposite ed importati in base alle necessità; per raggiungere un buon livello di manutenibilità abbiamo
optato, quando possibile, per la definizione di variabili e costanti utilizzate da più script in file appositi (vedi regex.php, e.g.: basta modificare una regex in regex.php
per aggiornare tutti i file che ne fanno uso); per rendere leggibile il codice abbiamo utilizzato nomi di variabili, file, funzioni significativi e seguito i buoni principi della
programmazione (sebbeno i commenti siano rari, il codice stesso dovrebbe fungere da autodocumentazione ed essere di facile comprensione e lettura); per ottenere un livello di
sicurezza medio/alto abbiamo scelto di procedere con una validazione form utente two-step (client-side: JQuery valida ed espone a video eventuali messaggi di errore,
server-side: PHP valida e redireziona senza effettuare modifiche al database in caso di errore) - validazione lato client per l'usabilità e
validazione lato server per la sicurezza; (tenendo conto del fatto che l'obiettivo del progetto non era dimostrare di padroneggiare le interfacce utenti
o l'esperienza utente (UI/UX)) la grafica, seppur minimale, è stata curata in modo attento, con particolare enfasi sulla responsività (Bootstrap, media query, viewport) 
delle pagine web.
