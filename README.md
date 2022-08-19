# meli
Test para MercadoLibre

Juan David Castrillón Gómez.
CC 1019010248
Prueba Técnica Mercado Libre

Documentacion API REST

EndPoint:
https://juandavidcastrillongomez.online/index.php/

Verificar Humano/Mutante
Url: https://juandavidcastrillongomez.online/index.php/mutant/
Mediante el método POST, enviar json con las cadenas de ADN a verificar.
POST -> 
{
"dna":["ATGCGA","CAGTGC","TTATGT","AGAAGG","CCCCTA","TCACTG"]
}

Response->
200 OK -> Indica que la cadena evaluada corresponde a un Mutante.
403 Forbiden -> La cadena no pertenece y/o contiene errores de datos.

Obtener estadísticas
Url: https://juandavidcastrillongomez.online/index.php/mutant/stats
Por método GET, Obtiene :
200 OK -> Conteo de humanos, mutantes y relación.

