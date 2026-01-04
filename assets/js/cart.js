function addToCart(name, price) {
    const item = {
        name: name,
        price: price
    };
    
    fetch('cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(item)
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Produk berhasil ditambahkan ke keranjang!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal menambahkan produk ke keranjang');
    });
}