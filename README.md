#Easy2Post webhook WeFact Hosting 
*Auteur:* [TECHMAUS](www.techmaus.nl)
Een hook voor WeFact Hosting om facturen die als eigenschap hebben (ook) per post verstuurd te moeten worden, automatisch te verzenden naar de Easy2Post api. 

----------

##Installatie
 1. Ga naar https://www.easy2post.nl/easy2post/user/api_mail.html en vraag uw PHP api aan via de oranje button.
 2. U ontvangt vervolgens per mail een 'api.zip' bestand, met hierin de file 'ease2post.api.php', sla deze op. 
 2. Upload het 'hooks.php' bestand uit deze repository tezamen met de 'easy2post.api.php' file naar de map /Pro/includes/ op de server waar WeFact draait. 

> **Opmerking:**
> - Deze webhook verzend automatisch alle facturen, herinneringen en aanmaningen die de verzendmethode 'per post' of 'per e-mail en post' hebben naar Easy2Post.
> - Eigenschappen van de te verzenden factuur (adres afdrukken, kleur/zwart-wit en aangetekend verzenden) kunt u aanpassen in de file 'hooks.php' onder het kopje *Upload to easy2post api*
> - Ease2Post is niet verbonden aan deze module, en het gebruik van deze module is voor eigen risico. 
