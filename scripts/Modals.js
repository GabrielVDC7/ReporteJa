const openBtns = document.querySelectorAll(".btn-sm");
const closeBtn = document.getElementById("closeModal");
const modal = document.getElementById("modal");

openBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    modal.classList.add("open");
  });
});

closeBtn.addEventListener("click", () => {
  modal.classList.remove("open");
});