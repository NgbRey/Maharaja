
  // Keranjang
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
`     ;

    cartItemsEl.appendChild(item);
  }

  cartTotalEl.textContent = total;
  cartCountEl.textContent = Object.keys(cart).length;

  // Update checkout link
  const pesan = Object.entries(cart)
    .map(([name, val]) => `- ${name} x${val.qty} = Rp${val.price * val.qty}`)
    .join('\n');
  const link = `https://wa.me/6285157690339?text=Halo admin, saya ingin memesan:\n${pesan}\n\nTotal: Rp${total}`;
  document.getElementById('checkout-btn').href = link;
}

// Klik produk
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


// Hapus produk dari keranjang
cartItemsEl.addEventListener('click', (e) => {
  if (e.target.classList.contains('remove-btn')) {
    const name = e.target.dataset.name;
    delete cart[name];
    updateCartDisplay();

    // Cari produk DOM dan hapus class 'added'
    const allProducts = document.querySelectorAll('.product');
    allProducts.forEach(prod => {
      if (prod.dataset.name === name) {
        prod.classList.remove('added');
        prod.removeAttribute('data-qty');
      }
    });
  }
});

const cartSidebar = document.getElementById('cart-sidebar');
const closeCartBtn = document.querySelector('.close-cart');
const openCartBtn = document.getElementById('open-cart');

openCartBtn.addEventListener('click', () => {
  cartSidebar.classList.add('show');
});

closeCartBtn.addEventListener('click', () => {
  cartSidebar.classList.remove('show');
});
