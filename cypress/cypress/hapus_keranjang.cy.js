describe('Hapus item dari keranjang - Toko Roti', () => {
  beforeEach(() => {
    Cypress.on('uncaught:exception', () => false); // Abaikan error JS
  });

  it('Login, hapus item dari keranjang, dan pastikan item hilang', () => {
    // 1. Login
    cy.visit('http://127.0.0.1:8000/login');
    cy.get('input[name="email"]').type('lisyalsv@gmail.com');
    cy.get('input[name="password"]').type('12345678');
    cy.get('button[type="submit"]').click();

    // 2. Akses halaman keranjang
    cy.wait(2000);
    cy.contains('Keranjang').click();

    // 3. Verifikasi item ada
    cy.url().should('include', '/checkout');
    cy.contains('Chocolate Chip Muffin').should('exist');

    // 4. Konfirmasi otomatis untuk pop-up browser "confirm"
    cy.on('window:confirm', () => true);

    // 5. Klik tombol "Hapus"
    cy.contains('Chocolate Chip Muffin')
      .parents('tr')
      .within(() => {
        cy.get('button').contains('Hapus').click();
      });

    // 6. Verifikasi item dihapus
    cy.wait(1000); // tunggu request selesai
    cy.contains('Chocolate Chip Muffin').should('not.exist');
  });
});
