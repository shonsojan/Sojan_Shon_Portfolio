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

  // Contact

  function regForm(event) {
    event.preventDefault();
    //console.log("regForm Called");
    const thisform = event.currentTarget;
    const url = "send_mail.php";
    //console.log(thisform.elements);
    const formdata =
      "last_name=" +
      thisform.elements.lname.value +
      "&first_name=" +
      thisform.elements.fname.value +
      "&email=" +
      this.elements.email.value +
      "&message=" +
      this.elements.message.value;
    console.log(formdata);
    fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: formdata,
    })
      .then((response) => response.json())
      .then((response) => {
        console.log(response);
        feedback.innerHTML = "";
        if (response.errors) {
          response.errors.forEach((error) => {
            const errorElement = document.createElement("p");
            errorElement.textContent = error;
            feedback.appendChild(errorElement);
          });
        } else {
          form.reset();
          const messageElement = document.createElement("p");
          messageElement.textContent = response.message;
          feedback.appendChild(messageElement);
        }
        feedback.scrollIntoView({ behavior: "smooth", block: "end" });
      })
      .catch((error) => {
        console.log(error);
        feedback.innerHTML = "";
        feedback.innerHTML = `<p>Sorry there seems to be an issue. Either you're using an older browser or javascript is disabled.</p>`;
      });
  }

  form.addEventListener("submit", regForm);



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
      start: "top 80%",
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
    scale: 0.95,
    duration: 1,
    ease: "power2.out",
  });

  // 5. Projects Section Animation
  gsap.from(".yellow-bg h2", {
    scrollTrigger: {
      trigger: ".yellow-bg",
      start: "top 80%",
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
    duration: 1,
    delay: 0.3,
    ease: "power2.out",
  });
})();
