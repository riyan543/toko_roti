describe('Fitur Admin - Toko Roti', () => {
  beforeEach(() => {
    // Login sebelum setiap tes
    cy.visit('http://localhost:8000/login');
    cy.get('input[name=email]').type('admin@tokoroti.com');
    cy.get('input[name=password]').type('password123');
    cy.get('button[type=submit]').click();

    // Pastikan masuk ke dashboard admin
    cy.url().should('include', '/admin');
    cy.contains('Daftar Menu Admin');
  });

  it('Menampilkan halaman dashboard admin', () => {
    cy.contains('Daftar Menu Admin');
    cy.contains('Lihat Transaksi');
    cy.contains('Manajemen Akun User');
  });

  it('Navigasi ke halaman transaksi', () => {
    cy.contains('Lihat Transaksi').click();
    cy.url().should('include', '/transactions');
    cy.contains('Daftar Transaksi per User');

    // Validasi isi tabel
    cy.get('table').should('exist');
    cy.get('table tbody tr').should('have.length.greaterThan', 0);
  });

  it('Navigasi ke halaman manajemen user', () => {
    cy.contains('Manajemen Akun User').click();
    cy.url().should('include', '/users');
    cy.contains('Manajemen Akun User');

    // Validasi isi tabel
    cy.get('table').should('exist');
    cy.get('table thead').contains('Nama');
    cy.get('table thead').contains('Role');
    cy.get('table tbody tr').should('have.length.greaterThan', 0);
  });
});
