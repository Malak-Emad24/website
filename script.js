const categories = document.querySelectorAll('.categories li');
const cards = document.querySelectorAll('.card');

categories.forEach(cat => {
    cat.addEventListener('click', () => {

        categories.forEach(c => c.classList.remove('active'));
        cat.classList.add('active');

        const category = cat.dataset.category;

        cards.forEach(card => {
            if (category === 'all' || card.dataset.category === category) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// ADD TO CART (AJAX)
const buttons = document.querySelectorAll('.add-to-cart');
const cartCount = document.getElementById('cart-count');

buttons.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;

        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + id
        })
        .then(res => res.text())
        .then(count => {
            cartCount.textContent = count;
        });
    });
});

// LOAD CART COUNT ON PAGE LOAD
fetch('cart_count.php')
    .then(res => res.text())
    .then(count => {
        cartCount.textContent = count;
    });

////
fetch('cart_count.php')
.then(res => res.text())
.then(count => {
    document.getElementById('cart-count').textContent = count;
});

const qtyButtons = document.querySelectorAll('.qty-btn');

qtyButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const action = btn.dataset.action;

        fetch('update_cart.php', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: `id=${id}&action=${action}`
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('qty-' + id).textContent = data.qty;
            document.getElementById('subtotal-' + id).textContent = data.subtotal;
            document.getElementById('total').textContent = data.total;
            document.getElementById('cart-count').textContent = data.totalItems;
             });
    });
});
const readBtns = document.querySelectorAll('.read-more');

readBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    const desc = btn.previousElementSibling; // <p class="description">
    if(desc.style.webkitLineClamp === "unset"){
      desc.style.webkitLineClamp = "3"; // يرجع يخفّي النص
      btn.textContent = "Read More";
    } else {
      desc.style.webkitLineClamp = "unset"; // يوسّع النص كامل
      btn.textContent = "Read Less";
    }
  });
});
