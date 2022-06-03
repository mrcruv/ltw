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
	diagrams.net (per disegnare diagrammi ER), VSC e PhpStorm (editor/IDE), Adobe Photoshop (loghi, icone)

Per quanto riguarda gli aspetti più tecnici, si riporta di seguito una breve descrizione della struttura dei file componenti l'applicazione.
La directory del progetto contiene:
-le pagine principali dell'applicazione (assegnazioni, competenze, esperti, index, me, processi, titoli)
-una sottodirectory css, contenente il foglio di stile style utilizzato ricorrentemente nelle pagine principali
-una sottodirectory scripts, contenente vari scripts in PHP e JS (JQuery) utilizzati per diversi scopi tra cui validazione form (lato client, lato server),
	operazioni CRUDI (prefissi add, delete, update, show), effetti grafici/gestione eventi/visualizzazione alert (error, message, form_switch, toggle_psw, ecc...)
-una sottodirectory includes, contenente files (fondamentalmente scripts PHP) inclusi ricorrentemente in più pagine dell'applicazione (modularità e riuso del codice!)
-una sottodirectory img, contenente le immagini utilizzate nell'applicazione
-una sottodirectory README, contenente i diagrammi concettuali e logici in formato JPG e drawio, gli script SQL per la creazione e popolazione del database, questo file README ed
    un'ulteriore sottodirectory screenshots contenente gli screenshots delle pagine che compongono l'applicazione (suddivise in quattro tipologie: ente, esperto, responsiveness
    ed infine altro - sotto responsiveness sono raccolti gli screenshots che mostrano la visualizzazione delle pagine web in modalità mobile/smartphone)

NOTA:
Entrambi i componenti del gruppo hanno collaborato allo sviluppo comune di alcuni task (form, progettazione struttura applicazione);
altri task sono stati portati avanti in maniera più indipendente, in particolare:
-validazione lato client, grafica ed effetti grafici, interazione utente con JS/JQuery (Federico Detomaso)
-validazione lato server, interazione con server (query, ecc...), strutturazione in moduli (Marco Ruvolo)

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

NOTA:
Per completezza:
-negli header HTML delle pagine principali (index, me, titoli, processi, esperti, competenze, assegnazioni), sono stati inseriti i meta-tag author, keywords
e description (oltre a viewport)
-è stato generato attraverso un tool online, un file che fungesse da foglio di termini e condizioni d'uso dell'applicazione (è ovviamente un fac-simile ed è del tutto generico)
-si assume che l'applicazione venga utilizzata nel rispetto delle normative sul copyright (soprattutto per le immagini utilizzate)

BREVE DESCRIZIONE DIRECTORY E FILE COMPONENTI L'APPLICAZIONE:
ltw-main

    /css
        /style.css: foglio di stile utilizzato per la grafica (ricorrente nelle pagine principali).

    /img
        /logo_ente.png: immagine rappresentativa di un ente; utilizzata in me.php.
        /logo_esperto.png: immagine rappresentativa di un esperto; utilizzata in me.php.
        /prova_logo.ico: favicon utilizzata in tutte le pagine principali.
        /prova_logo.png: logo dell'applicazione; utilizzata in index.php.

    /includes
        /close_connection.php: effettua la chiusura della connessione al database.
        /config.php: contiene le informazioni di configurazione del server e del database (IP, porta, ecc...).
        /error:php: contiene il modal visualizzato in caso di errore lato server (visualizzato attraverso la variabile globale $_GET).
        /footer.php: contiene il footer visualizzato in tutte le principali pagine dell'applicazione dopo aver effettuato il login.
        /header.php: contiene l'header (dinamico in base al tipo di utente) visualizzato in tutte le principali pagine dell'applicazione dopo aver effettuato il login.
        /info.php: contiene le informazioni dell'applicazione visualizzate nel footer (nome applicazione, autori, ecc...).
        /lengths.php: contiene le dimensioni minime e massime ammissibili per le validazioni lato server delle principali operazioni di login, register, add, update e delete.
        /message.php: contiene il modal visualizzato in caso di successo di un'operazione (login, update, ecc... - visualizzato attraverso la variabile globale $_GET).
        /open_connection.php: effettua l'apertura della connessione con il database (prendendo le informazioni di configurazione dal file config.php).
        /regex.php: contiene le espressioni regolari per le validazioni lato server delle principali operazioni di login, register, add, update e delete.
        /session.php: avvia una sessione se non è già stata avviata altrimenti reindirizza l'utente.
        /terms.html: contiene un fac-simile dei termini e delle condizioni d'uso dell'applicazione (scaricabile/consultabile da index.php, al termine della registrazione).

    /README
        /screenshots
            /altro: contiene gli screenshots di index.php (login) e di terms.html
            /ente: contiene gli screenshots (dal punto di vista di un ente) di assegnazioni.php, me.php, esperti.php, index.php (varie fasi di registrazione), processi.php
            /esperto: contiene gli screenshots (dal punto di vista di un esperto) di assegnazioni.php, competenze.php, me.php, index.php (varie fasi di registrazione), titoli.php
            /responsiveness: contiene gli screenshots (in modalità mobile/smartphone) di assegnazioni.php (sia dal punto di vista di un ente che di un esperto),
                             competenze.php, me.php (sia dal punto di vista di un ente che di un esperto), esperti.php, processi.php, titoli.php
                             index.php (login e fase iniziale di registrazione sia per enti che per esperti).

        /create_database.sql: contiene le istruzioni di definizione del database.
        /populate_database.sql: contiene le istruzioni per popolare il database.
        /diagramma_ER.jpg: schema concettuale individuato in fase di progettazione concettuale.
        /diagramma_ER_ristrutturato.jpg: schema concettuale ristrutturato.
        /diagramma_logico: schema logico individuato in fase di progettazione logica (esportato da phphMyAdmin).
        /ER.drawio: schema concettuale e schema concettuale ristrutturato in formato DRAWIO.
        /README.txt: questo file, definizione ricorsiva! :).

    /scripts
        /accept_reject.php: effettua l'accettazione o il rifiuto di una assegnazione pendente da parte dell'esperto associato;
                            dopo opporturni controlli viene aggiornata la data di accettazione, in caso di accettazione, o la data di rifiuto in caso di rifiuto.
        /add_availability.php: effettua l'aggiunta di una assegnazione da parte di un ente;
                               dopo opporturni controlli viene aggiunta l'assegnazione dell'ente con il processo e l'esperto designati.
        /add_competence.php: effettua l'aggiunta, da parte di un esperto, di una competenza; viene inoltre effettuata la validazione lato server.
        /add_process.php: effettua l'aggiunta, da parte di un ente, di un processo; viene inoltre effettuata la validazione lato server.
        /add_title.php: effettua l'aggiunta, da parte di un esperto, di un titolo di studio; viene inoltre effettuata la validazione lato server.
        /delete_competence.php: effettua l'eliminazione, da parte di un esperto, di una competenza.
        /delete_title.php: effettua l'eliminazione, da parte di un esperto, di un titolo di studio.
        /entity_stats.php: effettua il calcolo delle statistiche di un ente;
                           vengono visualizzati il numero di: processi, assegnazioni (divise in pendenti, accettate, rifiutate).
        /expert_stats.php: effettua il calcolo delle statistiche di un esperto;
                           vengono visualizzati il numero di: titoli di studio, competenze, assegnazioni (divise in pendenti, accettate, rifiutate).
        /login.php: effettua il login e setta la variabile globale $_SESSION con username e tipo di utente.
        /logout.php: effettua il logout, l'unset della variabile globale $_SESSION e distrugge la sessione.
        /register_entity.php: effettua la registrazione di un ente; viene effettuata la validazione lato server.
        /register_expert.php: effettua la registrazione di un esperto; viene effettuata la validazione lato server.
        /remove_website.php: effettua la rimozione, da parte di un utente, del sito web.
        /show_availability.php: contiene una funzione che memorizza in un array tutte le assegnazioni di un ente e lo restituisce
                                ed una funzione che memorizza in un array tutte le assegnazioni di un esperto e lo restituisce.
        /show_competence.php: contiene una funzione che memorizza in un array tutte le competenze di un esperto e lo restituisce.
        /show_expert.php: contiene una funzione che memorizza in un array tutti gli esperti e lo restituisce,
                          una funzione che memorizza in un array i titoli di studio di un esperto e lo restituisce,
                          una funzione che memorrizza in un array le competenze di un esperto e lo restituisce
                          ed una funzione che controlla l'esistenza di un esperto.
        /show_process.php: contiene una funzione che memorizza in un array tutte i processi di un ente e lo restituisce.
        /show_title.php: contiene una funzione che memorizza in un array tutte i titoli di studio di un esperto e lo restituisce.
        /update_cf.php: effettua l'update del Codice Fiscale di un utente; viene effettuata la validazione lato server.
        /update_entity_name.php: effettua l'update del nome dell'ente; viene effettuata la validazione lato server.
        /update_entity_type.php: effettua l'update del tipo dell'ente; viene effettuata la validazione lato server.
        /update_info.js: contiene il meccanismo di gestione degli eventi generati dalle operazioni di update/remove sulle informazioni utente.
        /update_password.php: effettua l'update della password di un utente; viene effettuata la validazione lato server.
        /update_pec.php: effettua l'update della PEC di un utente; viene effettuata la validazione lato server.
        /update_piva.php: effettua l'update della Partita IVA di un utente; viene effettuata la validazione lato server.
        /update_website.php: effettua l'update del sito web di un utente; viene effettuata la validazione lato server.
        /add_form.js: genera l'animazione a comparsa dei form di aggiunta nelle pagine titoli.php, assegnazioni.php, competenze.php, processi.php.
        /validate_add_competence.js: effettua la validazione lato client dell'aggiunta di una competenza.
        /validate_add_process.js: effettua la validazione lato client dell'aggiunta di un processo.
        /validate_add_title.js: effettua la validazione lato client dell'aggiunta di un titolo di studio.
        /validate_login.js: effettua la validazione lato client del login di un utente.
        /validate_register_entity.js: effettua la validazione lato client della registrazione.
        /validate_register_expert.js: effettua la validazione lato client dell'aggiunta di una competenza.
        /validate_update_cf.js: effettua la validazione lato client dell'update del Codice Fiscale di un utente.
        /validate_update_entity_name.js: effettua la validazione lato client dell'update del nome di un ente.
        /validate_update_entity_type.js: effettua la validazione lato client dell'update del tipo di un ente.
        /validate_update_password.js: effettua la validazione lato client dell'update della password di un utente.
        /validate_update_pec.js: effettua la validazione lato client dell'update della PEC di un utente.
        /validate_update_piva.js: effettua la validazione lato client dell'update della Partita IVA di un utente.
        /validate_update_website.js: effettua la validazione lato client dell'update del sito web di un utente.
        /form_switch.js: genera l'animazione del form di login e registrazione di index.php.
        /register_slide.js: genera l'animazione di scorrimento del form di registrazione nella pagina di index.php.
        /toggle_psw.js: contiene il meccanismo di toggle per la visibilità della password.
        /message.js: mostra il modal di successo dell'operazione eseguita.
        /error.js: mostra il modal di errore.

    /assegnazioni.php: visualizza tutte le assegnazioni che ha un utente (pendenti, accettate e rifiutate);
                       nel caso l'utente sia un ente viene visualizzato anche un form a comparsa per l'aggiunta di un'assegnazione.
    /competenze.php: visualizza tutte le competenze che ha un utente esperto; viene visualizzato anche un form a comparsa per l'aggiunta di una competenza.
    /esperti.php: visualizza tutti gli esperti registrati alla piattaforma;
                  in questa pagina un utente ente può visualizzare tutte le informazioni di un esperto (titoli di studio e competenze).
    /index.php: visualizza i form di login e registrazione e una breve descrizione dell'applicazione.
    /me.php: visualizza la dashboard dell'utente con tutte le informazioni, statistiche e form di cambio password.
    /processi.php: visualizza tutti i processi che un utente ente ha creato; viene visualizzato anche un form a comparsa per l'aggiunta di un processo.
    /titoli.php: visualizza tutti i titoli di studio di un utente esperto; viene visualizzato anche un form a comparsa per l'aggiunta di un titolo di studio.