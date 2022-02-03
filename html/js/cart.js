console.log("SDIFJKDIGJSFDIGJSIDFGJ IMPORT");

const openModalButtons = document.querySelectorAll("[data-modal-target]");
const openModalButtons = document.querySelectorAll("[data-close-button]");
console.log(openModalButtons);
const overlay = document.getElementById("overlay");

openModalButtons.forEach((button) => {
  button.addEventListener("click", () => {
    console.log("openModal button click event");
    const modal = document.querySelector(button.dataset.modalTarget);
    openModal(modal);
  });
});
overlay.addEventListener("click", () => {
  console.log("overlay click event");
  const modals = document.querySelectorAll(".modal.active");
  modals.forEach((modal) => {
    closeModal(modal);
  });
});

closeModalButtons.forEach((button) => {
  button.addEventListener("click", () => {
    console.log("close button click event");
    const modal = button.closest(".modal");
    closeModal(modal);
  });
});

function openModal(modal) {
  if (modal == null) {
    console.log("openModal return null");
    return;
  }
  modal.classList.add("active");
  overlay.classList.add("active");
}

function closeModal(modal) {
  if (modal == null) {
    console.log("closeModal return null");
    return;
  }
  modal.classList.remove("active");
  overlay.classList.remove("active");
}
