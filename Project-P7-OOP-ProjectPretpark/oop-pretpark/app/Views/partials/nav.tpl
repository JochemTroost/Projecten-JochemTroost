<nav class="topnav">
  <a href="index.php" data-page="dashboard" class="brand">Pretpark</a>
  <a href="index.php?page=shopList"           data-page="shopList">Shopbeheer</a>
  <a href="index.php?page=attractionList"     data-page="attractionList">Attractiebeheer</a>
  <a href="index.php?page=employees&a=index"  data-page="employees" data-alt="e=employees">Medewerkers</a>
  <a href="index.php?page=roster&a=index"     data-page="roster">Rooster</a>
  <a href="index.php?page=reserveTicket"      data-page="reserveTicket">Tickets reserveren</a>
  <a href="index.php?page=visitorList"        data-page="visitorList">Bezoekersoverzicht</a>
  <a href="index.php?page=monthlyStats"       data-page="monthlyStats">Reserveringsstatistieken</a>
</nav>

<style>
{literal}
.topnav {
  display: flex;
  gap: .5rem;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;   /* centreert alle links */
  margin-bottom: 1rem;
  background: #f7f0e3;
  border: 1px solid #eadfc9;
  border-radius: .5rem;
  padding: .5rem .75rem;
}

.topnav .brand {
  font-weight: 700;
  margin-right: 0;           /* eventueel .25rem als je toch wat ruimte wilt */
}

.topnav a {
  text-decoration: none;
  padding: .4rem .6rem;
  border: 1px solid #ddd;
  border-radius: .5rem;
  color: #1f2937;
}
.topnav a:hover { background: #efe6d6; }
.topnav a.active { background: #e9d4b5; border-color: #d9c39e; }

.page {
  font-family: system-ui, Segoe UI, Roboto, Arial, sans-serif;
  margin: 2rem;
}

.table { border-collapse: collapse; width: 100%; }
.table th,
.table td {
  border: 1px solid #ddd;
  padding: .5rem;
  text-align: left;
}

.flash-ok { color: #0a0; }
.flash-err { color: #a00; }

.btn {
  display: inline-block;
  padding: .4rem .6rem;
  border: 1px solid #ccc;
  border-radius: .5rem;
  text-decoration: none;
}
.btn-primary { background: #0366d6; color: #fff; border-color: #0366d6; }
.btn-danger  { background: #b00020; color: #fff; border-color: #b00020; }

.form label { display: block; margin: .5rem 0 .2rem; }
.form input,
.form select { padding: .4rem; width: 20rem; max-width: 100%; }
{/literal}

</style>

<script>
{literal}
(function(){
  const params = new URLSearchParams(window.location.search);
  const page = params.get('page') || params.get('e') || (window.location.search ? '' : 'dashboard');

  document.querySelectorAll('.topnav a[data-page]').forEach(a=>{
    const want = a.dataset.page;
    const alt  = a.dataset.alt; // vangt e=employees varianten op
    if (page === want) a.classList.add('active');
    if (!page && want === 'dashboard') a.classList.add('active');
    if (alt && params.toString().includes(alt)) a.classList.add('active');
  });
})();
{/literal}
</script>