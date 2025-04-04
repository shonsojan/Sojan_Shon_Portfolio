(() => {
  const player = new Plyr("video");
  const form = document.querySelector("#contactForm");
  const feedback = document.querySelector("#feedback");

  // Hamburger Menu

  const menu = document.querySelector("#menu");
  const hamburger = document.querySelector("#hamburger");
  const closeButton = document.querySelector("#close");
  const menuLinks = document.querySelectorAll("#menu ul a");

  function toggleMenu() {
    menu.classList.toggle("open");
    console.log("Menu toggled");
  }

  hamburger.addEventListener("click", toggleMenu);
  closeButton.addEventListener("click", toggleMenu);

  menuLinks.forEach((link) => {
    link.addEventListener("click", toggleMenu);
  });

  gsap.registerPlugin(ScrollTrigger);
  gsap.registerPlugin(ScrollToPlugin);

  document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.getElementById("hamburger");
    const menu = document.getElementById("menu");
    const close = document.getElementById("close");

    hamburger.addEventListener("click", function () {
      menu.classList.add("active");
    });

    close.addEventListener("click", function () {
      menu.classList.remove("active");
    });
  });

  // GSAP Animations
  // 1. Header Logo Animation (on page load)
  gsap.from("logo", {
    opacity: 0,
    y: -50,
    duration: 1,
    ease: "power2.out",
  });

  // 2. Profile Section Animation (scroll-triggered)
  gsap.from(".profile h3", {
    scrollTrigger: {
      trigger: ".black-bg",
      start: "top 70%",
      toggleActions: "play none none reverse",
    },
    opacity: 0,
    x: -100,
    duration: 1,
    ease: "power2.out",
  });

  gsap.from(".profile p", {
    scrollTrigger: {
      trigger: ".black-bg",
      start: "top 70%",
      toggleActions: "play none none reverse",
    },
    opacity: 0,
    x: 100,
    duration: 1,
    delay: 0.3,
    ease: "power2.out",
  });

  // 3. Tech Tools Animation (staggered entry)
  gsap.from("#tool li", {
    scrollTrigger: {
      trigger: "#tech",
      start: "top 80%",
      toggleActions: "play none none reverse",
    },
    opacity: 0,
    y: 30,
    duration: 0.8,
    stagger: 0.2,
    ease: "power2.out",
  });

  // 4. Video Player Animation
  gsap.from("#player-container", {
    scrollTrigger: {
      trigger: "#player-container",
      start: "top 90%",
      toggleActions: "play none none reverse",
    },
    opacity: 0,
    scale: 0.75,
    duration: 1,
    ease: "power2.out",
  });

  // 5. Projects Section Animation
  gsap.from(".yellow-bg h2", {
    scrollTrigger: {
      trigger: ".yellow-bg",
      start: "top 70%",
      toggleActions: "play none none reverse",
    },
    opacity: 0,
    y: 50,
    duration: 1,
    ease: "power2.out",
  });

  gsap.from(".project > div", {
    scrollTrigger: {
      trigger: ".yellow-bg",
      start: "top 70%",
      toggleActions: "play none none reverse",
    },
    opacity: 0,
    y: 50,
    duration: 1,
    stagger: 0.3,
    ease: "power2.out",
  });

  // 6. Contact Section Animation
  gsap.from("#contact h2", {
    scrollTrigger: {
      trigger: "#contact",
      start: "top 80%",
      toggleActions: "play none none reverse",
    },
    opacity: 0,
    scale: 0.9,
    duration: 1,
    ease: "power2.out",
  });

  gsap.from("#contactForm", {
    scrollTrigger: {
      trigger: "#contact",
      start: "top 70%",
      toggleActions: "play none none reverse",
    },
    opacity: 0,
    y: 50,
    duration: 2,
    delay: 0.3,
    ease: "power2.out",
  });
})();
