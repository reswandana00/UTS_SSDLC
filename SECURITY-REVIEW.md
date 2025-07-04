# Review Keamanan Manual: Kode Rentan di CobaUTS

## 1. Kerentanan Cross-Site Scripting (XSS)

**Berkas:** `app/Views/feedback.php`

```js
// Sengaja dibuat rentan XSS
const feedbackContainer = document.getElementById("feedbackContainer");
const feedbackItem = document.createElement("div");
feedbackItem.className = "p-4 bg-gray-50 rounded-lg";
feedbackItem.innerHTML = feedback; // Rentan XSS
feedbackContainer.prepend(feedbackItem);
```

- **Risiko:** Input pengguna dimasukkan langsung ke DOM menggunakan `innerHTML` tanpa sanitasi, sehingga memungkinkan XSS.

---

## 2. Tantangan XSS (Kerentanan Disengaja)

**Berkas:** `app/Views/hidden_quiz.php`

- File ini memang sengaja dibuat rentan XSS sebagai tantangan.

---

## 3. Menampilkan Data Session (Risiko Rendah)

**Berkas:** `app/Views/dashboard.php`

```php
<p class="text-lg text-blue-700">Selamat Datang, <span class="font-semibold"><?= session('username') ?></span></p>
<p class="text-blue-600">Role: <?= session('role') ?></p>
<p class="text-blue-600">Akses berlaku sampai: <?= session('access_expires') ?></p>
```

- **Risiko:** Jika data session diisi dari input pengguna tanpa sanitasi, bisa dieksploitasi untuk XSS. Namun, session CodeIgniter umumnya aman kecuali Anda mengisi dari input yang tidak disaring.

---

## 4. Kredensial Hardcoded (Hanya Demo)

**Berkas:** `app/Controllers/Auth.php`

```php
if ($this->request->getPost('username') === 'demo' &&
    $this->request->getPost('password') === 'demo') {
    session()->set([
        'username' => 'user',
        'role'     => 'demo',
        'access_expires' => date('Y-m-d H:i:s', strtotime('+10 minutes'))
    ]);
    return redirect()->to('/dashboard');
}
```

- **Risiko:** Kredensial hardcoded tidak aman untuk produksi, namun ini hanya untuk demo.

---

## 5. SQL Injection (Tidak Ditemukan)

- Tidak ditemukan query SQL langsung yang menggunakan input pengguna tanpa filter pada konteks yang diberikan. Jika Anda menggunakan query mentah di tempat lain, mohon periksa kembali untuk risiko SQL injection.

---

## 6. Perlindungan CSRF

- Pada `app\Config\Security.php` perlindungan CSRF sudah aktif secara default, ini sudah baik.

---

## Ringkasan

- Kerentanan nyata paling kritis adalah XSS di `feedback.php`.
- Tantangan XSS di `hidden_quiz.php` memang disengaja.
- Area lain berisiko rendah atau hanya untuk demo.

Jika ingin pemeriksaan lebih dalam (misal untuk SQL injection atau upload file), sebutkan file atau fitur yang ingin difokuskan.
