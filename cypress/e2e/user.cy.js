describe('Klik Produk Roti dan Checkout', () => {
  const baseUrl = 'http://localhost:8000';

  function loginUser() {
    cy.visit(`${baseUrl}/login`);
    cy.get('input[name=email]').type('via@gmail.com');
    cy.get('input[name=password]').type('12345678');
    cy.get('button[type=submit]').click();
    cy.url().should('include', '/beranda');
    cy.contains('Beranda').should('exist');
  }

  it('User login, lihat produk, dan tambah ke keranjang', () => {
    loginUser(); // panggil di sini

    cy.contains('Freshly Baked with Love').should('exist');
    cy.get('.bakery-card', { timeout: 10000 }).should('have.length.greaterThan', 0);

    cy.get('.bakery-card').first().click();
    cy.get('#productModal').should('be.visible');
    cy.get('#modalProductImage').should('be.visible');
    cy.get('#modalProductDescription').should('not.be.empty');
    cy.get('.modal .btn-close').click();

    cy.get('.bakery-card form').first().submit();
    cy.contains('Keranjang').click();

    cy.url().should('include', '/checkout');
    cy.contains('Keranjang Anda').should('exist');
    cy.get('table tbody tr').should('have.length.greaterThan', 0);

    cy.visit(`${baseUrl}/checkout`);
    cy.contains('button', 'Hapus').first().click();
    cy.on('window:confirm', () => true);
    cy.wait(1000);

    cy.get('body').then(($body) => {
      if ($body.text().includes('Keranjang masih kosong.')) {
        cy.contains('Keranjang masih kosong.').should('exist');
      } else {
        cy.get('table tbody tr').should('have.length.greaterThan', 0);
      }
    });
  });

  it('Menambahkan ulang produk dan melakukan pembayaran', () => {
    loginUser(); // ini baru bisa dipanggil

    cy.get('.bakery-card form').first().submit();

    cy.visit(`${baseUrl}/checkout`);
    cy.get('form[action*="checkout/bayar"]').submit();

    cy.url().should('include', '/pembayaran');
    cy.contains('Pembayaran Anda').should('exist');
    cy.contains('QRIS').should('exist');
  });
});
