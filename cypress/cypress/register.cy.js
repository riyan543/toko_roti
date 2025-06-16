describe('Register Akun Baru - Toko Roti', () => {
  it('Berhasil daftar dan diarahkan ke halaman login', () => {
    cy.visit('http://127.0.0.1:8000/register');

    const email = `lisyalsv${Date.now()}@gmail.com`; // email unik tiap test
    const password = '12345678';

    // Isi form register
    cy.get('input[name="name"]').type('Lisya Septia Verona');
    cy.get('input[name="email"]').type(email);
    cy.get('input[name="password"]').type(password);
    cy.get('input[name="password_confirmation"]').type(password);
    cy.get('button[type="submit"]').click();

    // Verifikasi diarahkan ke halaman login
    cy.url().should('include', '/login');
    cy.contains('Masuk').should('be.visible'); // atau sesuaikan dengan teks heading/tombol
  });
});
