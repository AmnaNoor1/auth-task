document.addEventListener("DOMContentLoaded", function () {
  const radioButtons = document.querySelectorAll(".btn-filter-item-1");
  const cards = document.querySelectorAll(".col");

  radioButtons.forEach((radio) => {
    radio.addEventListener("change", function () {
      const selectedCategory = this.value;

      cards.forEach((card) => {
        const cardCategories = card.getAttribute("data-category").split(",");

        if (
          selectedCategory === "all" ||
          cardCategories.includes(selectedCategory)
        ) {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      });
    });
  });
});

document.querySelectorAll('.btn-group input[type="radio"]').forEach((radio) => {
  radio.addEventListener("change", function () {
    document.querySelectorAll(".custom-radio-button").forEach((button) => {
      button.classList.remove("active");
    });
    if (radio.checked) {
      radio.nextElementSibling.classList.add("active");
    }
  });
});