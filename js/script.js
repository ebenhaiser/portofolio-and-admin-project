// Ambil semua elemen modal
var modals = document.querySelectorAll(".modal");
var btns = document.querySelectorAll(".openModal");
var spans = document.getElementsByClassName("close");

// Fungsi untuk membuka modal berdasarkan ID
btns.forEach(function (btn) {
  console.log("Button clicked:", this.getAttribute("data-modal"));
  btn.onclick = function () {
    var modalId = this.getAttribute("data-modal");
    var modal = document.getElementById(modalId);
    modal.style.display = "block";
    setTimeout(function () {
      modal.classList.add("show"); // Tambahkan kelas show
    }, 10); // Delay singkat untuk memastikan transisi berfungsi
  };
});

// Fungsi untuk menutup modal
Array.from(spans).forEach(function (span) {
  span.onclick = function () {
    var modal = span.closest(".modal");
    modal.classList.remove("show"); // Hapus kelas show
    setTimeout(function () {
      modal.style.display = "none"; // Sembunyikan modal setelah transisi
    }, 300); // Waktu sesuai dengan durasi transisi
  };
});

// Menutup modal jika pengguna mengklik di luar modal
window.onclick = function (event) {
  modals.forEach(function (modal) {
    if (event.target == modal) {
      modal.classList.remove("show"); // Hapus kelas show
      setTimeout(function () {
        modal.style.display = "none"; // Sembunyikan modal setelah transisi
      }, 300); // Waktu sesuai dengan durasi transisi
    }
  });
};
