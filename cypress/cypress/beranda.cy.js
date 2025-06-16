describe('Login ke Dashboard Toko Roti', () => {
  beforeEach(() => {
    // Hindari error JS dari aplikasi agar tes tidak gagal
    Cypress.on('uncaught:exception', () => false);
  });

  it('Login berhasil dan tampil halaman beranda', () => {
    // 1. Buka halaman login
    cy.visit('http://127.0.0.1:8000/login');

    // 2. Isi form login
    cy.get('input[name="email"]').type('lisyalsv@gmail.com'); // sesuaikan jika nama field berbeda
    cy.get('input[name="password"]').type('12345678');
    cy.get('button[type="submit"]').click();

    // 3. Tunggu halaman redirect
    cy.wait(3000); // idealnya diganti cek loading/spinner

    // 4. Verifikasi elemen pada halaman beranda
    cy.contains('Toko Roti').should('be.visible'); // dari <a class="navbar-brand">
    cy.contains('Beranda').should('be.visible');
    cy.contains('Keranjang').should('be.visible');
    cy.contains('Profil').should('be.visible');
    cy.get('form[action*="/logout"]').should('exist'); // tombol logout

    // 5. Alternatif: cek konten dashboard (misal ada teks "🍞 Home Bakery")
    cy.contains('🍞 Home Bakery').should('be.visible');
  });
});
