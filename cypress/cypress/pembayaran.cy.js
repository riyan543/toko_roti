describe('Menuju Halaman Pembayaran - Toko Roti', () => {
  it('Login, tambah roti ke keranjang, checkout, dan masuk ke halaman pembayaran', () => {
    // Login
    cy.visit('http://127.0.0.1:8000/login');

    cy.get('input[name="email"]').type('lisyalsv@gmail.com');
    cy.get('input[name="password"]').type('12345678');
    cy.get('button[type="submit"]').click();

    // Pastikan berhasil login
    cy.url().should('not.include', '/login');
    cy.contains('Beranda');

    // Tambah ke keranjang (pakai isi tombol)
    cy.contains('button', 'Tambah ke Keranjang').first().click();

    // Buka halaman checkout
    cy.visit('http://127.0.0.1:8000/checkout');

    // Klik tombol "Bayar" atau semacamnya
    cy.contains('button', 'Bayar').click();

    // Verifikasi halaman pembayaran muncul
    cy.contains('Pembayaran Anda').should('be.visible');
    cy.contains('Total yang harus dibayar').should('exist');
    cy.get('img[alt="QRIS"]').should('be.visible');
  });
});
