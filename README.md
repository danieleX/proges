#Changelog 29/07/2016
### Query di ricerca
- __Lista articoli :__ Ora è possibile ricercare gli articoli in base al cliente
### Virgole, punti... nzoccu vo' tu
I punti sono stati sostituiti dalle virgole.
### Note
Le aree di testo riportano nella stampa tutto il testo e non solo il primo rigo (bug)
### Codice cliente
Il codice cliente è la prima cosa da inserire, **non è modificabile**.
Se necessario, il cliente può essere cancellato e ricreato.
#Changelog 14/07/2016

###Database
 
- __stampa_ddt :__ Abolite le colonne "prov" e "cap" Aggiunta la colonna "codC"
- __stampa_prev :__ stampa_ndc, stampa_fatt
- Aggiunta la colonna "codC"

### Meno criptico, più funzionale!

I documenti riguardante ddt, fattura, ndc e preventivo sono stati sistemati secondo una logica migliorata. Nessun join, nessun lavoro sporco: Alla selezione del cliente viene implicitamente salvato anche il suo codice. 