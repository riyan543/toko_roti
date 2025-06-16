describe('Halaman Keranjang - Toko Roti', () => {
  beforeEach(() => {
    // Abaikan error JavaScript dari aplikasi agar tidak ganggu pengujian
    Cypress.on('uncaught:exception', () => false);
  });

  it('Login dan tampilkan isi keranjang', () => {
    // 1. Kunjungi halaman login
    cy.visit('http://127.0.0.1:8000/login');

    // 2. Masukkan kredensial login
    cy.get('input[name="email"]').type('lisyalsv@gmail.com');
    cy.get('input[name="password"]').type('12345678');
    cy.get('button[type="submit"]').click();

    // 3. Akses halaman keranjang
    cy.wait(2000); // beri waktu proses login selesai
    cy.contains('Keranjang').click();

    // 4. Verifikasi URL keranjang
    cy.url().should('include', '/checkout');

    // 5. Verifikasi konten di dalam keranjang
    cy.contains('Keranjang Anda').should('be.visible');
    cy.contains('Buttery Ham and Cheese Croissant').should('exist');
    cy.contains('Rp23.000').should('exist');
  });
});
