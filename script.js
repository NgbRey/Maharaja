const cart = {};
const cartItemsEl = document.getElementById('cart-items');
const cartTotalEl = document.getElementById('cart-total');
const cartCountEl = document.getElementById('cart-count');

function updateCartDisplay() {
  cartItemsEl.innerHTML = '';
  let total = 0;
  for (let name in cart) {
    const { price, qty } = cart[name];
    total += price * qty;

    const item = document.createElement('div');
    item.classList.add('cart-item');
    item.innerHTML = `
      <span class="cart-name">${name}</span>
      <span class="cart-info">Rp ${price * qty} • x${qty}</span>
      <button class="remove-btn" data-name="${name}">❌</button>
    `;
    cartItemsEl.appendChild(item);
  }

  cartTotalEl.textContent = total;
  cartCountEl.textContent = Object.keys(cart).length;

  const pesan = Object.entries(cart)
    .map(([name, val]) => `- ${name} x${val.qty} = Rp${val.price * val.qty}`)
    .join('\n');
  const link = `https://wa.me/6285157690339?text=Halo admin, saya ingin memesan:\n${pesan}\n\nTotal: Rp${total}`;
  document.getElementById('checkout-btn').href = link;
}

document.querySelectorAll('.product').forEach(prod => {
  prod.addEventListener('click', () => {
    const name = prod.dataset.name;
    const price = parseInt(prod.dataset.price);
    if (!cart[name]) {
      cart[name] = { price, qty: 1 };
    } else {
      cart[name].qty += 1;
    }
    prod.classList.add('added');
    prod.setAttribute('data-qty', `x${cart[name].qty}`);
    updateCartDisplay();
  });
});

cartItemsEl.addEventListener('click', (e) => {
  if (e.target.classList.contains('remove-btn')) {
    const name = e.target.dataset.name;
    delete cart[name];
    updateCartDisplay();
    document.querySelectorAll('.product').forEach(prod => {
      if (prod.dataset.name === name) {
        prod.classList.remove('added');
        prod.removeAttribute('data-qty');
      }
    });
  }
});

document.getElementById('open-cart').addEventListener('click', () => {
  document.getElementById('cart-sidebar').classList.add('show');
});
document.querySelector('.close-cart').addEventListener('click', () => {
  document.getElementById('cart-sidebar').classList.remove('show');
});

// === SLIDESHOW ===
let slideIndex = 0;
const slides = document.querySelectorAll(".slide");
const nextBtn = document.querySelector(".next-slide");
const prevBtn = document.querySelector(".prev-slide");

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove("active");
    slide.style.left = "100%";
  });

  slides[index].classList.add("active");
  slides[index].style.left = "0";
}

function nextSlide() {
  slideIndex = (slideIndex + 1) % slides.length;
  showSlide(slideIndex);
}

function prevSlide() {
  slideIndex = (slideIndex - 1 + slides.length) % slides.length;
  showSlide(slideIndex);
}

if (nextBtn && prevBtn && slides.length > 0) {
  nextBtn.addEventListener("click", nextSlide);
  prevBtn.addEventListener("click", prevSlide);
  showSlide(slideIndex); // Tampilkan slide pertama
  setInterval(nextSlide, 4000); // Autoplay tiap 4 detik
}


