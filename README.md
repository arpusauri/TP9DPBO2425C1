# TP9DPBO2425C1
Saya Arya Purnama Sauri dengan NIM 2408521 mengerjakan Tugas Praktikum 9 dalam mata kuliah Desain Pemrograman Berbasis Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

# Desain Program

## Database

### Nama
`mvp_db`

### Struktur Tabel
Memiliki 2 entitas (tabel) yaitu.

#### 1. Tabel: `pembalap`
Tabel ini menyimpan data pembalap Formula 1 yang terdaftar.

| Field           | Tipe Data    | Constraint   | Keterangan                                                   |
|-------          |-----------   |------------  |------------                                                  |
| `id`            | INT(11)      | PRIMARY KEY  | ID PRIMARY KEY unik dengan AUTO_INCREMENT                    |
| `nama`          | VARCHAR(255) | NOT NULL     | Nama pembalap                                                |
| `tim`           | VARCHAR(255) | NOT NULL         | Nama tim pembalap                                            |
| `negara`        | VARCHAR(255)  | NOT NULL         | Negara asal pembalap                                         |
| `poinMusim`     | INT(11)      | NULL    | Poin perolehan pembalap pada musim ini                       |
| `jumlahMenang`  | INT(11)      | NULL    | Jumlah menang yang diraih pembalap pada musim ini            |

#### 2. Tabel: `grandprix`
Tabel ini menyimpan data Grand Prix yang diselenggarakan.

| Field           | Tipe Data    | Constraint    | Keterangan                                             |
|-------          |-----------   |------------   |------------                                            |
| `id`            | INT(11)      | PRIMARY KEY   | ID PRIMARY unik grandprix dengan AUTO_INCREMENT        |
| `nama_gp`       | VARCHAR(255) | NOT NULL      | Nama Grand Prix                                        |
| `tahun`         | INT(4)       | NOT NULL      | Tahun Grand Prix diadakan                              |
| `tanggal`       | DATE         | NOT NULL          | Tanggal Grand Prix diadakan                            |
| `keterangan`    | VARCHAR(255) | NULL          | Deskripsi Grand Prix                                   |

## MVP (Model-View-Presenter)   

### 1. `Pembalap`

#### Model
Mengelola data pembalap di database.
- **File**: `models/TabelPembalap.php`
- **Implements**: `KontrakModel.php`
- **Extends**: `DB.php` (untuk koneksi database)

**Method:**
- `__construct($host, $db, $user, $pass)` : Inisialisasi koneksi database
- `getAllPembalap()` : Mengambil semua data pembalap dari database, diurutkan berdasarkan poin tertinggi
- `getPembalapById($id)` : Mengambil data pembalap spesifik berdasarkan ID
- `tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang)` : Menambah data pembalap baru ke database
- `ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang)` : Mengupdate data pembalap berdasarkan ID
- `hapusPembalap($id)` : Menghapus data pembalap dari database berdasarkan ID

#### View
Menampilkan antarmuka pengelolaan data pembalap.
- **File**: `views/ViewPembalap.php`
- **Implements**: `KontrakView.php`
- **Template**: `template/skin.html` (list), `template/form.html` (form)

**Method:**
- `tampilkanPembalap($data)` : Menampilkan tabel list semua pembalap dengan kolom: No, Nama, Tim, Negara, Poin Musim, Jumlah Menang, dan tombol Edit & Hapus
- `tampilkanFormPembalap($data = null)` : Menampilkan form input untuk tambah/edit pembalap dengan field: nama, tim, negara, poinMusim, jumlahMenang

#### Presenter
Mengatur alur CRUD pembalap (Business Logic).
- **File**: `presenters/PresenterPembalap.php`
- **Implements**: `KontrakPresenter.php`

**Method:**
- `__construct($model, $view)` : Inisialisasi dengan dependency injection Model dan View
- `tampilkanPembalap()` : Mengambil data dari model, konversi ke objek Pembalap, kirim ke view untuk ditampilkan
- `tampilkanFormPembalap($id = null)` : Menampilkan form kosong (add) atau form terisi (edit)
- `tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang)` : Meminta model untuk menyimpan data baru
- `ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang)` : Meminta model untuk update data
- `hapusPembalap($id)` : Meminta model untuk menghapus data

### 2. `GrandPrix`

#### Model
Mengelola data Grand Prix di database.
- **File**: `models/TabelGrandprix.php`
- **Implements**: `KontrakModelGP.php`
- **Extends**: `DB.php`

**Method:**
- `__construct($host, $db, $user, $pass)` : Inisialisasi koneksi database
- `getAllGP()` : Mengambil semua data Grand Prix, diurutkan berdasarkan tanggal terbaru
- `getGPById($id)` : Mengambil data Grand Prix spesifik berdasarkan ID
- `addGP($nama, $tahun, $tanggal, $ket)` : Menambah data Grand Prix baru ke database
- `updateGP($id, $nama, $tahun, $tanggal, $ket)` : Mengupdate data Grand Prix berdasarkan ID
- `deleteGP($id)` : Menghapus data Grand Prix dari database berdasarkan ID

#### View
Menampilkan antarmuka pengelolaan Grand Prix.
- **File**: `views/ViewGrandprix.php`
- **Implements**: `KontrakViewGP.php`
- **Template**: `template/gp_list.html` (list), `template/gp_form.html` (form)

**Method:**
- `tampilListGP($data)` : Menampilkan tabel list Grand Prix dengan kolom: Nama GrandPrix, Tahun, Tanggal, Keterangan, dan tombol Edit & Hapus
- `tampilFormGP($data = null)` : Menampilkan form input untuk tambah/edit Grand Prix dengan field: nama_gp, tahun, tanggal, keterangan

#### Presenter
Mengatur alur CRUD Grand Prix (Business Logic).
- **File**: `presenters/PresenterGP.php`
- **Implements**: `KontrakPresenterGP.php`

**Method:**
- `__construct($model, $view)` : Inisialisasi dengan dependency injection Model dan View
- `loadData()` : Mengambil data dari model, konversi ke objek GrandPrix, kirim ke view
- `showFormAdd()` : Menampilkan form kosong untuk tambah data
- `showFormEdit($id)` : Mengambil data spesifik dan tampilkan ke form edit
- `add($nama, $tahun, $tanggal, $ket)` : Meminta model untuk menyimpan data baru
- `edit($id, $nama, $tahun, $tanggal, $ket)` : Meminta model untuk update data
- `delete($id)` : Meminta model untuk menghapus data

## Routing System
**File**: `index.php`

Sistem routing menggunakan parameter GET untuk navigasi:
- `?nav=MODULE` : Menentukan modul yang akan ditampilkan (pembalap/grandprix)
- `?screen=ACTION` : Menentukan aksi (list/add/edit)
- `?id=ID` : ID data untuk edit/delete

**Contoh URL:**
```
index.php?nav=pembalap                          → List pembalap
index.php?nav=pembalap&screen=add              → Form tambah pembalap
index.php?nav=pembalap&screen=edit&id=1        → Form edit pembalap
index.php?nav=grandprix                         → List Grand Prix
index.php?nav=grandprix&screen=add             → Form tambah Grand Prix
index.php?nav=grandprix&screen=edit&id=1       → Form edit Grand Prix
```

# Penjelasan Alur Program

## 1. Jalankan Program
Akses: `http://localhost/nama-folder-project/index.php`

## 2. Menampilkan tampilan awal 
Terdapat navbar yang mengandung 2 link yang bisa ditekan oleh user:
- **Pembalap** (default halaman pertama)
- **Grand Prix**

## 3. Menekan halaman Pembalap

### READ
1. Menampilkan data pembalap dalam tabel dengan kolom: No, Nama, Tim, Negara, Poin Musim, Jumlah Menang, dan tombol Actions (Edit & Hapus)
2. Data diurutkan berdasarkan poin tertinggi
3. Presenter memanggil `$model->getAllPembalap()`
4. Data dikonversi menjadi array objek `Pembalap`
5. View merender data ke template `skin.html`

### CREATE
1. Klik tombol "**+ Tambah Pembalap**" di bawah tabel
2. Sistem redirect ke `index.php?nav=pembalap&screen=add`
3. Presenter memanggil `tampilkanFormPembalap()` tanpa parameter
4. View merender form kosong dari template `form.html`
5. Isi field: Nama (required), Tim (required), Negara, Poin Musim, Jumlah Menang
6. Klik "**Simpan**" untuk submit atau "**Batal**" untuk kembali
7. Form submit via POST dengan `action=add` dan `nav=pembalap`
8. Index.php route ke handler POST pembalap
9. Presenter memanggil `$model->tambahPembalap(...)`
10. Data tersimpan ke database
11. Redirect ke `index.php?nav=pembalap` dengan data terbaru

### UPDATE
1. Klik tombol "**Edit**" pada baris data yang ingin diubah
2. Sistem redirect ke `index.php?nav=pembalap&screen=edit&id=X`
3. Presenter memanggil `tampilkanFormPembalap($id)`
4. Model mengambil data via `getPembalapById($id)`
5. View merender form dengan data existing sudah terisi (pre-filled)
6. Ubah data sesuai kebutuhan
7. Klik "**Simpan**" atau "**Batal**"
8. Form submit via POST dengan `action=edit`, `nav=pembalap`, dan `id`
9. Presenter memanggil `$model->ubahPembalap(...)`
10. Data terupdate di database
11. Redirect ke `index.php?nav=pembalap`

### DELETE
1. Klik tombol "**Hapus**" pada baris data yang ingin dihapus
2. JavaScript menampilkan konfirmasi: "Yakin ingin menghapus entri #X?"
3. Klik "**Cancel**" untuk batal atau "**OK**" untuk konfirmasi
4. JavaScript membuat form POST dengan `action=delete`, `nav=pembalap`, dan `id`
5. Presenter memanggil `$model->hapusPembalap($id)`
6. Data dihapus dari database
7. Redirect ke `index.php?nav=pembalap`

## 4. Menekan halaman Grand Prix

### READ
1. Klik menu "**Grand Prix**" di navigation bar
2. Sistem redirect ke `index.php?nav=grandprix`
3. Menampilkan tabel Grand Prix dengan kolom: Nama GrandPrix, Tahun, Tanggal, Keterangan, dan tombol Actions
4. Data diurutkan berdasarkan tanggal terbaru
5. Presenter memanggil `$model->getAllGP()`
6. Data dikonversi menjadi array objek `GrandPrix`
7. View merender data ke template `gp_list.html`

### CREATE
1. Klik tombol "**+ Tambah GrandPrix**"
2. Redirect ke `index.php?nav=grandprix&screen=add`
3. Presenter memanggil `showFormAdd()`
4. View merender form dari `gp_form.html`
5. Isi field: Nama GrandPrix (required), Tahun (required), Tanggal (date picker), Keterangan
6. Klik "**Simpan**" atau "**Batal**"
7. Form submit POST dengan `action=add`, `nav=grandprix`
8. Presenter memanggil `$model->addGP(...)`
9. Data tersimpan ke database
10. Redirect ke `index.php?nav=grandprix`

### UPDATE
1. Klik tombol "**Edit**" pada data yang dipilih
2. Redirect ke `index.php?nav=grandprix&screen=edit&id=X`
3. Presenter memanggil `showFormEdit($id)`
4. Model mengambil data via `getGPById($id)`
5. View merender form dengan data existing
6. Ubah data yang diinginkan
7. Klik "**Simpan**" untuk submit
8. Form POST dengan `action=edit`, `nav=grandprix`, `id`
9. Presenter memanggil `$model->updateGP(...)`
10. Data terupdate di database
11. Redirect ke `index.php?nav=grandprix`

### DELETE
1. Klik tombol "**Hapus**"
2. JavaScript konfirmasi: "Yakin ingin menghapus entri #X?"
3. Jika OK, JavaScript submit form POST dengan `action=delete`, `nav=grandprix`, `id`
4. Presenter memanggil `$model->deleteGP($id)`
5. Data dihapus dari database
6. Redirect ke `index.php?nav=grandprix`

# Dokumentasi


https://github.com/user-attachments/assets/8af9df9d-4872-4867-8a00-63e3073e512d


