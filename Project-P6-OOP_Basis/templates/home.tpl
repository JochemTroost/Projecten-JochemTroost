{extends file='layout.tpl'}

{block name='content'}
    <div class="container text-center mt-5">
        <h1 class="display-4">Welkom bij onze Webshop!</h1>
        <p class="lead mt-3">Ontdek ons uitgebreide assortiment kwaliteitsproducten tegen scherpe prijzen. Van electronics tot mode, wij hebben alles wat je nodig hebt!</p>

        <hr class="my-4">

        <h3>Waarom bij ons winkelen?</h3>
        <ul class="list-group">
            <li class="list-group-item">✓ Snelle en gratis verzending vanaf €25</li>
            <li class="list-group-item">✓ 30 dagen bedenktijd - niet tevreden, geld terug</li>
            <li class="list-group-item">✓ Uitstekende klantenservice - altijd bereikbaar</li>
            <li class="list-group-item">✓ Veilig betalen met iDEAL, PayPal en creditcard</li>
        </ul>

        <div class="row mt-5">
            <div class="col-md-4">
                <h4>🛍️ Populaire Categorieën</h4>
                <p>Bekijk onze meest populaire productcategorieën</p>
                <a class="btn btn-outline-primary" href="index.php?action=categories" role="button">Alle Categorieën</a>
            </div>
            <div class="col-md-4">
                <h4>🔥 Aanbiedingen</h4>
                <p>Mis onze dagelijkse deals en kortingen niet!</p>
                <a class="btn btn-outline-danger" href="index.php?action=deals" role="button">Bekijk Deals</a>
            </div>
            <div class="col-md-4">
                <h4>⭐ Nieuw</h4>
                <p>Ontdek de nieuwste producten in ons assortiment</p>
                <a class="btn btn-outline-success" href="index.php?action=new" role="button">Nieuwe Producten</a>
            </div>
        </div>

        <p class="mt-5">
            Start nu met winkelen en ontdek onze geweldige producten!
        </p>

        <a class="btn btn-primary btn-lg" href="index.php?page=productList" role="button">Bekijk Alle Producten</a>
        <a class="btn btn-success btn-lg ml-2" href="index.php?action=cart" role="button">🛒 Winkelwagen</a>
    </div>
{/block}