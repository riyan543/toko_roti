describe('Halaman Login Toko Roti', () => {
  it('Berhasil login dengan akun lisyalsv@gmail.com', () => {
    cy.visit('http://127.0.0.1:8000/login');

    // Isi form login
    cy.get('input[name="email"]').type('lisyalsv@gmail.com');
    cy.get('input[name="password"]').type('12345678');

    // Klik tombol Masuk/Login
    cy.get('button[type="submit"]').click();

    // Verifikasi sudah tidak di halaman login
    cy.url().should('not.include', '/login');

    // (Opsional) Verifikasi ada tombol logout/menu utama setelah login
    cy.contains('Logout'); // atau sesuaikan misalnya 'Beranda', 'Dashboard', dsb
  });
});
