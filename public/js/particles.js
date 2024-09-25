document.addEventListener("DOMContentLoaded", (event) => {
  particlesJS("particles-1", {
    particles: {
      number: {
        value: 4,
        density: {
          enable: false,
          value_area: 800,
        },
      },
      color: {
        value: "#152e57",
      },
      shape: {
        type: "polygon",
        stroke: {
          width: 0, // No border for the hexagons
        },
        polygon: {
          nb_sides: 6,
        },
      },
      opacity: {
        value: 0.1,
        random: false,
        anim: {
          enable: false,
          speed: 1,
          opacity_max: 0.1,
          sync: false,
        },
      },
      size: {
        value: 165,
        random: true,
        anim: {
          enable: false,
          speed: 40,
          size_min: 0.1,
          sync: false,
        },
      },

      move: {
        enable: true,
        speed: 6,
        direction: "none",
        random: false,
        straight: false,
        out_mode: "out",
        bounce: false,
        attract: {
          enable: false,
          rotateX: 600,
          rotateY: 1200,
        },
      },
    },

    interactivity: {
      events: {
        onhover: {
          enable: false,
        },

        onclick: {
          enable: false,
        },
      },
    },

    modes: {
      grab: {
        distance: 0,
        line_linked: {
          opacity: 0,
        },
      },
    },

    retina_detect: true,
  });
});
