
--

{extends file='layout.tpl'}



{block name="head"}

    <link rel="stylesheet" href="assets/css/shops.css">

{/block}



{block name="content"}

    <h1>Bezoekersoverzicht</h1>


    <form method="get" action="index.php" class="search-form">
        <input type="hidden" name="page" value="visitorList">
        <input type="text" name="search" placeholder="Zoek op naam..." value="{$search|escape}" class="search-input">
        <button type="submit">Zoeken</button>
        {if $search}
            <a href="index.php?page=visitorList" class="clear-search">Wis</a>
        {/if}
    </form>
    {if $message}<p class="message">{$message|escape}</p>{/if}

    {if $error}<p class="error">{$error|escape}</p>{/if}



    <table class="shop-list-table">

        <thead>

        <tr>

            <th>#</th>

            <th>Naam</th>

            <th>E-mail</th>

            <th>Ticketnummer</th>

            <th>Datum bezoek</th>

            <th>Ticket type</th>

            <th>Personen</th>

            <th>Totaal (€)</th>

            <th>Aangemaakt op</th>

            <th>Acties</th>

        </tr>

        </thead>

        <tbody>

        {foreach $visitors as $visitor}

            <tr>

                <td>{$visitor->id}</td>

                <td>{$visitor->name}</td>

                <td>{$visitor->email}</td>

                <td>{$visitor->ticketNumber}</td>

                <td>{$visitor->visitDate}</td>

                <td>{$visitor->ticketType}</td>

                <td>{$visitor->persons}</td>

                <td>{$visitor->totalPrice|number_format:2:',':' '}</td>

                <td>{$visitor->createdAt}</td>

                <td>

                    <form method="post" action="index.php?page=visitorList" onsubmit="return confirm('Weet je zeker dat je deze reservering wilt verwijderen?');">

                        <input type="hidden" name="delete_id" value="{$visitor->id}">

                        <button type="submit">Verwijderen</button>

                    </form>

                </td>

            </tr>

        {/foreach}

        {if !$visitors}

            <tr><td colspan="10">Geen bezoekers gevonden.</td></tr>

        {/if}

        </tbody>

    </table>

{/block}




