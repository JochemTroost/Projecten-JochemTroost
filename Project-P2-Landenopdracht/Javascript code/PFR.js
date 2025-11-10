document.addEventListener("DOMContentLoaded", () => {
    const features = document.querySelectorAll(".feature");
    const scheduleSection = document.querySelector(".schedule");
    const infoSection = document.querySelector(".info");
  
    const options = {
      root: null,
      rootMargin: "0px",
      threshold: 0.1,
    };
  
    const callback = (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        } else {
          entry.target.classList.remove("visible");
        }
      });
    };
  
    const observer = new IntersectionObserver(callback, options);
  
    features.forEach((feature) => {
      observer.observe(feature);
    });
  
    observer.observe(scheduleSection);
    observer.observe(infoSection);
    const moveBackground = () => {
      const scrollY = window.scrollY;
      document.body.style.backgroundPositionY = `${scrollY * 0.7}px`;
    };
  
    window.addEventListener("scroll", moveBackground);
  });
  
  function skils() {
    let h2 = document.getElementById("displayZone-h2");
    let p = document.getElementById("displayZone-p");
    let skils =
      "Mijn skills zijn onder andere: HTML, CSS, JavaScript, PHP en een beetje SQL. Ik ben op dit moment ook bezig met het leren van de taal LUA.";
      portoimg.src = "../CSS Code/img/e7936798-180f-4e37-bc78-66a1d8841165_cards_documentation.jpg";
      p.innerHTML = skils;
    h2.innerText = "Mijn Skils";
  }
  function profielFoto() {
    let h2 = document.getElementById("displayZone-h2");
    let p = document.getElementById("displayZone-p");
    let portoimg = document.getElementById("portoimg");
    portoimg.src = "../CSS Code/img/IMG_E2021.jpg";
    
    p.innerHTML = overmij;
    h2.innerText = "Over Mij";
  }

  function overMij() {
    let h2 = document.getElementById("displayZone-h2");
    let p = document.getElementById("displayZone-p");
    let overmij =
      "Ik ben Ryan en ik ben 17 jaar oud. Ik zit op dit moment op de school Techniek college Rotterdam, in Schiedam. Als sport ga ik gemiddeld 3-4 keer per week naar de sportrschool. Ik heb 3 honden, ongeveer 20 eenden en een paar kippen, een cavia, een konijn en 4 schapen. En om niet te vergeten 3 paarden. Maar ik ben geen boer, ondanks dat dat wel zo lijkt.";

    p.innerHTML = overmij;
    h2.innerText = "Over Mij";
  }
  function contact() {
    let h2 = document.getElementById("displayZone-h2");
    let p = document.getElementById("displayZone-p");
    let portoimg = document.getElementById("portoimg");
    let contactt =
      "Contact <br> Telefoon: <strong> 06 04738395 </strong><br> Mail:<strong> 9024915@student.zadkine.nl </strong><br> Adres: <strong>Schiedamseweg 254 </strong> ";
    portoimg.src =
      "../CSS Code/img/contactus-810f9fbd50c984380afdd8faa4ca6b0e1937d2a7d36471de66fc0f86beb4db9e.png";
    p.innerHTML = contactt;
    h2.innerText = "Contact";
  }
  
  function school() {
    let h2 = document.getElementById("displayZone-h2");
    let p = document.getElementById("displayZone-p");
    let portoimg = document.getElementById("portoimg");
    let School =
      "Ik zit op de school Techniek college Rotterdam in Schiedam. Ik doe hier de opleiding software developer en ik zit op dit moment in het 1e jaar. ";
    portoimg.src = "../CSS Code/img/Schiedamseweg245.jpg";
    p.innerHTML = School;
    h2.innerText = "School";
    
  }
  
  function werk() {
    let h2 = document.getElementById("displayZone-h2");
    let p = document.getElementById("displayZone-p");
    let portoimg = document.getElementById("portoimg");
    let werK =
      "Ik heb een jaar gewerkt bij de MCD in Zuidland, als vakkenvuller. En ik werk nu bij de Hoecksack in Heenvliet, en hier werk ik nu al een jaar. Hier werk ik als keukenhulp.";
    portoimg.src = "../CSS Code/img/hoecksack-restaurant-heenvliet-nissewaard-1_964704327.jpg";
    p.innerHTML = werK;
    h2.innerText = "Werk";
  }
  