describe('Lihat Profil Pengguna - Toko Roti', () => {
  beforeEach(() => {
    Cypress.on('uncaught:exception', () => false); // Abaikan error JS
  });

  it('Login dan lihat halaman profil', () => {
    // 1. Login terlebih dahulu
    cy.visit('http://127.0.0.1:8000/login');
    cy.get('input[name="email"]').type('lisyalsv@gmail.com');
    cy.get('input[name="password"]').type('12345678');
    cy.get('button[type="submit"]').click();

    // 2. Klik menu "Profil"
    cy.contains('Profil').click();

    // 3. Verifikasi berada di halaman profil
    cy.url().should('include', '/profile');
    cy.contains('Profil Saya').should('be.visible');

    // 4. Cek bahwa nama dan email sesuai
    cy.get('input[name="name"]').should('have.value', 'Lisya Septia Verona');
    cy.get('input[name="email"]').should('have.value', 'lisyalsv@gmail.com');
  });
});
