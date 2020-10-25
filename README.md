# Progetto di test.
Il progetto è un embrione di sistema MVC scalabile.
E' possibile aggiungere Controller con annessi relativi file di configurazione e driver/wrapper per l'accesso ai dati.
Sulla base della configurazione è possibile usare il wrapper CSV, piuttosto che quell MYSQL, PostGresql etc.
Ovviamente mancano tutti i metodi necessari alla connessione al DB e quant'altro.
Il sistema risponde in text plain e json sulla base della chiamata.
L'endPoint è il file index.php, che va chiamato tramite PHP CLI. ES: php index.php {customerID} {plain|json(opt)}.
Il sistema è connesso a un servizio gratuito di conversione. Purtroppo non risulta essere molto stabile.
Sarebbe ideale creare una sorta di cache temporale per evitare di caricare l'API del servizio di conversione.
Sarebbe ugualmente ideale creare una live cache per le richieste alle valute di cui è gia stata la chiamata nel TTL del programma.

I Test tengono conto dell'eventuale malfunzionamento del sistema di conversione.
L'output viene emesso ugualmente anche se non viene effettuata la conversione. Il valore convertito viene stippato nella variabile valueConverted delle transazioni.
