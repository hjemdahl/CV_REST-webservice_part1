# projekt-rest

REST-webbtjänst API utvecklad med objektorienterad PHP för en CV webbplats.

- En config.php fil för att automatiskt ladda classfiler, ansluta till databas och error rapportering.
- Klass filer för ämnena portfolio, studier respektive jobb innehållande metoder för att hämta, lägga till, ta bort och uppdatera data.
- Respektive ämnes php fil för hantering av CRUD metoder - GET, POST, DELTE och PUT.
- En cv.php fil för aktivering av ämnenas php filer beroende på url requests.

#### URI för CRUD
- GET: http://studenter.miun.se/~mohj1800/web3/projekt/rest/cv.php/api/*ÄMNE*
- POST: http://studenter.miun.se/~mohj1800/web3/projekt/rest/cv.php/api/*ÄMNE*
- DELETE: http://studenter.miun.se/~mohj1800/web3/projekt/rest/cv.php/api/*ÄMNE*/"ditt-id"
- PUT: http://studenter.miun.se/~mohj1800/web3/projekt/rest/cv.php/api/*ÄMNE*/"ditt-id"

Ämnena: portfolio, studies, work
