<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Portfolio - Jochem Troost</title>
  <style>
    /* Kleurenpalet */
    :root {
      --groen: #28a745;
      --blauw: #007bff;
      --wit: #fff;
      --donker: #222;
      --transparant-wit: rgba(255, 255, 255, 0.9);
    }

    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      scroll-behavior: smooth;
    }

    body,
    html {
      width: 100vw;
      height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--wit);
      background: linear-gradient(135deg, var(--groen), var(--blauw));
      overflow-x: hidden;
    }

    /* Sticky nav */
    header {
      position: sticky;
      top: 0;
      width: 100%;
      background: var(--transparant-wit);
      color: var(--donker);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 4vw;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      backdrop-filter: saturate(180%) blur(10px);
      transition: background-color 0.3s ease;
    }

    header h1 {
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--groen);
    }

    nav a {
      color: var(--blauw );
      text-decoration: none;
      margin-left: 2rem;
      font-weight: 600;
      font-size: 1rem;
      position: relative;
      padding: 0.3rem 0;
      transition: color 0.3s ease;
    }

    nav a::after {
      content: '';
      position: absolute;
      width: 0%;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: var(--groen);
      transition: width 0.3s ease;
    }

    nav a:hover,
    nav a:focus {
      color: var(--groen);
    }

    nav a:hover::after,
    nav a:focus::after {
      width: 100%;
    }

    /* Sections */
    section {
      min-height: 100vh;
      padding: 8rem 10vw 6rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      scroll-margin-top: 70px;
    }

    /* Over Mij */
    #over-mij {
      display: flex;
      align-items: center;
      gap: 3rem;
      flex-wrap: wrap;
      color: var(--wit);
    }

    #over-mij img {
      flex-shrink: 0;
      width: 250px;
      height: 250px;
      border-radius: 50%;
      object-fit: cover;
      border: 6px solid var(--wit);
      box-shadow: 0 0 25px var(--wit);
      filter: drop-shadow(0 0 10px var(--groen));
      order: 0;
    }

    #over-mij>div {
      flex: 1 1 300px;
      font-size: 1.3rem;
      line-height: 1.8;
      order: 1;
    }

    /* Over Mij info */
    #over-mij-info {
      color: var(--wit);
    }

    #over-mij-info div {
      font-size: 1.3rem;
      line-height: 1.8;
    }

   #contact {
  text-align: center;
  padding: 3rem 2rem;
  max-width: 700px;
  margin: 0 auto;
  color: var(--wit);
}

#contact h2 {
  font-size: 2.8rem;
  margin-bottom: 1.5rem;
  color: var(--wit);
  text-shadow: 0 0 10px var(--groen);
}

#contact p {
  font-size: 1.3rem;
  line-height: 1.6;
  max-width: 600px;
  margin: 0 auto 2.5rem;
  font-weight: 600;
}

.social-links {
  display: flex;
  justify-content: center;
  gap: 3.5rem;
  margin-top: 1rem;
}

.social-links a {
  color: var(--wit);
  font-weight: 700;
  text-decoration: none;
  font-size: 1.25rem;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: transform 0.3s ease;
}

.social-links a:hover {
  transform: scale(1.15);
  color: var(--groen);
}

.social-links img {
  width: 55px;
  margin-top: 0.5rem;
  filter: drop-shadow(0 0 6px var(--wit));
  transition: filter 0.3s ease;
}

.social-links a:hover img {
  filter: drop-shadow(0 0 15px var(--groen));
}


    /* Tijdlijn */
    #tijdlijn h2 {
      font-size: 2.5rem;
      margin-bottom: 3rem;
      color: var(--wit);
      text-align: center;
      text-shadow: 0 0 10px var(--groen);
    }

    .timeline {
      max-width: 800px;
      margin: 0 auto;
      position: relative;
      padding-left: 50px;
      border-left: 4px solid var(--groen);
    }

    .timeline-item {
      position: relative;
      margin-bottom: 4rem;
      color: var(--wit);
      opacity: 0;
      transform: translateX(-40px);
      animation: slideInLeft 1s forwards;
    }

    /* Animatie delay per item */
    .timeline-item:nth-child(1) {
      animation-delay: 0.2s;
    }

    .timeline-item:nth-child(2) {
      animation-delay: 0.5s;
    }

    .timeline-item:nth-child(3) {
      animation-delay: 0.8s;
    }

    .timeline-item:nth-child(4) {
      animation-delay: 1.1s;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: -30px;
      top: 5px;
      width: 20px;
      height: 20px;
      background-color: var(--wit);
      border: 4px solid var(--groen);
      border-radius: 50%;
      box-shadow: 0 0 10px var(--groen);
    }

    .timeline-item-content {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }

    .timeline-item-image {
      width: 100%;
      max-width: 600px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    /* Projecten */
    #projecten h2 {
      font-size: 2.5rem;
      margin-bottom: 3rem;
      text-align: center;
      color: var(--wit);
      text-shadow: 0 0 10px var(--groen);
    }

    #projecten>div {
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
      font-size: 1.2rem;
      color: var(--wit);
      opacity: 0;
      transform: translateY(40px);
      animation: fadeInUp 1s forwards;
      animation-delay: 1.3s;
    }

    /* Animaties */
    @keyframes slideInLeft {
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive */
    @media (max-width: 700px) {
      section {
        padding: 6rem 6vw 5rem;
      }

      #over-mij {
        flex-direction: column;
        text-align: center;
        gap: 3rem;
      }

      #over-mij img {
        margin-bottom: 3rem;
      }

      nav a {
        margin-left: 1rem;
        font-size: 0.95rem;
      }

      .timeline {
        padding-left: 30px;
      }

      .timeline-item::before {
        left: -25px;
      }
    }
  </style>
</head>

<body>
  <header>
    <h1>Jochem Troost</h1>
    <nav>
      <a href="#over-mij-info">Over Mij</a>
      <a href="#contact">Contact</a>
      <a href="#tijdlijn">Tijdlijn</a>
      <a href="#projecten">Projecten</a>
    </nav>
  </header>

  <section id="over-mij">
    <img src="style/img/profile.jpg" alt="Profielfoto van Jochem Troost" />
    <div>
      <h1>Jochem Troost</h1>
      <p><strong>Enthousiast student op Techniek College Rotterdam Als Software Developer</strong></p>
      <p>Hallo! Ik ben Jochem. Een enthousiaste student met veel intresse voor technologie en ontwikkeling.</p>
    </div>
  </section>

  <section id="over-mij-info">
    <div>
      <h1>Mijn verhaal</h1>
      <p>Mijn naam is Jochem Troost. Vanaf jonge leeftijd heb ik een grote interesse in technologie, automatisering
        en ontwikkeling. Wat begon als een nieuwsgierige hobby is inmiddels uitgegroeid tot een serieus doel.
        <br> <br> Op dit moment volg ik de opleiding Software Developer aan het Techniek College Rotterdam.

        Wat mij aanspreekt in deze opleiding is dat je niet alleen technische kennis opdoet, maar ook leert om problemen
        op creative manieren op te lossen. <br>Ik ben van nature enthousiast, doelgericht en vind het leuk om
        uitdagingen aan te gaan en mezelf voortdurend te verbeteren. <br><br>

        Ik geloof dat ik een waardevolle toevoeging ben voor elk bedrijf dat op zoek is naar een gemotiveerde
        en leergierige software developer. Naast mijn technische vaardigheden, zoals het ontwikkelen van software
        en het oplossen van problemen, beschik ik over goede communicatieve vaardigheden.
        Ik kan duidelijk en effectief samenwerken met collega’s, wat essentieel is om projecten succesvol af te ronden en ideeën uit te wisselen.
<br><br>

        Mijn ideale werkdag bestaat uit het ontwikkelen van software of toepassingen die direct impact hebben. Ik werk
        graag aan projecten die mijn kennis verbreden en mij scherp houden. Dit doe ik niet alleen voor mezelf, maar ook
        met het doel om een positieve bijdrage te leveren aan de maatschappij. <br> Technologie kan het leven makkelijker maken,
        en daar wil ik graag aan meewerken. <br>


        <br> In de toekomst zie ik mezelf als een enthousiaste software developer die met passie en doorzettingsvermogen werkt
        aan innovatieve oplossingen. Ik blijf mezelf ontwikkelen en wil steeds nieuwe dingen leren om zo een waardevolle bijdrage
        te leveren aan mijn vakgebied.
      </p>
    </div>
  </section>

  <section id="projecten">
    <h2>Projecten</h2>
    <div>
      <!-- Voeg hier je projecten toe -->
      <p>Momenteel werk ik aan meerdere interessante projecten. Binnenkort meer informatie hier!</p>
    </div>
  </section>

  <section id="contact">
  <h2>Links & Contact</h2>
  <p>
    Ik vind het altijd erg leuk als mensen contact met mij zoeken! Of het nu gaat om een interessant project, een vraag, of gewoon een gezellig gesprek over technologie en ontwikkeling – ik sta altijd open voor nieuwe connecties. Voel je vrij om me te benaderen via de onderstaande gegevens. Ik kijk ernaar uit om van je te horen!
  </p>
  <div class="social-links">
    <a href="https://www.linkedin.com/in/jochem-troost-ab8008318/" target="_blank" rel="noopener noreferrer">
      LinkedIn
      <img src="style/icon/linkedin.png" alt="LinkedIn Logo" />
    </a>
    <a href="#">
      GitHub
      <img src="style/icon/github.png" alt="GitHub Logo" />
    </a>
    <a href="mailto:9025293@student.zadkine.nl">
      Mail
      <img src="style/icon/mail.png" alt="Mail Logo" />
    </a>
  </div>
</section>


  <section id="tijdlijn">
    <h2>Tijdlijn</h2>
    <div class="timeline">
      <div class="timeline-item">
        <div class="timeline-item-content">
          <strong>2020 - 2024</strong> Helinium VMBO-K Techniek
        </div>
        <img src="style/img/example1.jpg" alt="Project 2023-2024" class="timeline-item-image" />
      </div>

      <div class="timeline-item">
        <div class="timeline-item-content">
          <strong>Juni 2024</strong> Geslaagd op Helinium VMBO-K Techniek
        </div>
        <img src="style/img/example2.jpg" alt="Ervaring 2024" class="timeline-item-image" />
      </div>

      <div class="timeline-item">
        <div class="timeline-item-content">
          <strong>2024 - Heden</strong> Techniek College Rotterdam als Software developer
        </div>
        <img src="style/img/example2.jpg" alt="Ervaring 2024" class="timeline-item-image" />
      </div>

      <div class="timeline-item">
        <div class="timeline-item-content">
          <strong>Feb 2026</strong> Stage voor Techniek College Rotterdam als Software developer
        </div>
        <img src="style/img/example2.jpg" alt="Ervaring 2024" class="timeline-item-image" />
      </div>
    </div>
  </section>

</body>

</html>