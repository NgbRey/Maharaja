  const nomorAdmin = "6285157690339";

    const qtyInputs = document.querySelectorAll('.qty');
    const prices = document.querySelectorAll('.price');
    const productNames = document.querySelectorAll('.product h3');
    const totalDisplay = document.getElementById('grand-total');
    const waLink = document.getElementById('whatsapp-link');

    const nickname = document.getElementById('nickname');
    const id = document.getElementById('id');
    const server = document.getElementById('server');

    const openBtn = document.getElementById("open-checkout");
    const modal = document.getElementById("checkout-modal");
    const closeBtn = document.querySelector(".modal .close");


    function updateTotal() {
      let total = 0;
      let pesan = "Halo admin, saya ingin membeli:\n";
      qtyInputs.forEach((input, index) => {
        const qty = parseInt(input.value);
        const price = parseInt(prices[index].textContent);
        const name = productNames[index].textContent;

        if (qty > 0) {
          const subtotal = qty * price;
          total += subtotal;
          pesan += `- ${name} x${qty} = Rp${subtotal}\n`;
        }
      });

      totalDisplay.textContent = total;

      if (total > 0) {
        pesan += `\nTotal: Rp${total}`;
        pesan += `\n\n📌 Data Akun ML:\n- Nickname: ${nickname.value}\n- ID: ${id.value}\n- Server: ${server.value}`;

        const url = `https://wa.me/${nomorAdmin}?text=${encodeURIComponent(pesan)}`;
        waLink.href = url;
      } else {
        waLink.href = "#";
        
      }
    }
//popup checkout
  openBtn.addEventListener("click", (e) => {
    e.preventDefault();
    modal.classList.add("show");
    modal.style.display = "block";
  });

  closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
    modal.classList.remove("show");
  });

  window.addEventListener("click", (e) => {
    if (e.target == modal) {
      modal.style.display = "none";
      modal.classList.remove("show");
    }
  });

  const warningModal = document.getElementById('warning-modal');
  const closeWarning = document.querySelector('.close-warning');

  waLink.addEventListener('click', function(e) {
  // Cek apakah total = 0 popup warning
  const total = parseInt(totalDisplay.textContent);
  if (total === 0) {
    e.preventDefault(); // Mencegah link WhatsApp terbuka
    warningModal.classList.add("show");
    warningModal.style.display = "block"; // Tampilkan popup
  }
});

  closeWarning.addEventListener('click', () => {
  warningModal.style.display = "none";
  warningModal.classList.remove("show");
  });

  window.addEventListener("click", (e) => {
  if (e.target === warningModal) {
    warningModal.style.display = "none";
    warningModal.classList.remove("show");
      }
    });


  // Tetap jalanin perhitungan total seperti sebelumnya
  qtyInputs.forEach(input => input.addEventListener('input', updateTotal));
  nickname.addEventListener('input', updateTotal);
  id.addEventListener('input', updateTotal);
  server.addEventListener('input', updateTotal);