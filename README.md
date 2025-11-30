# 🛍️ MardikaStore — Platform E-Commerce Laravel

MardikaStore adalah platform e-commerce modern berbasis **Laravel**, dirancang untuk menghubungkan **Buyer**, **Seller**, dan **Admin** dalam satu ekosistem transaksi yang aman, nyaman, dan terstruktur.

Nama **“Mardika”** berasal dari akar kata **“Merdeka”** dalam bahasa Sanssekerta yang berarti **bebas, mandiri, dan berdaya**. Filosofi ini sejalan dengan tujuan platform untuk memberikan kebebasan dan kemandirian kepada penjual dan pembeli.

---

## ✨ Fitur Utama
- 🔐 **Role  (Admin, Seller, Buyer)**
- 🛒 **Sistem Keranjang**
- ❤️ **Wishlist**
- ⭐ **Review Produk**
- 🛍️ **Manajemen Toko & Produk**
- 📦 **Order & Checkout Sistem**
- 📊 **Dashboard sesuai per Role**
- 🗂️ **Kategori Produk**
- 👤 **Autentikasi Laravel Breeze**

---

## 🧩 Arsitektur Role dalam Sistem

### 👑 **Admin**
Fitur:
- 👥 Manajemen user  
- 🏷️ CRUD kategori  
- 🛍️ Monitoring seluruh produk  
- 🏪 Pengelolaan toko  
- 📊 Verifikasi seller  

---

### 🛒 **Buyer**
Fitur:
- 🔎 Browse produk & kategori  
- ❤️ Wishlist  
- 🛒 Keranjang belanja  
- 💳 Checkout  
- 📦 Track pesanan  
- ⭐ Beri review pada produk yang sudah diterima  
- 🧾 Riwayat pesanan  

---

### 🛍️ **Seller**
Fitur:
- 🏪 Kelola toko  
- 📦 Kelola produk (CRUD)  
- 🚚 Kelola pesanan masuk  
- 📊 Kelola pengguna
- 📲 Kelola status pemesanan  

---

## 🛠️ Teknologi yang Digunakan
- **Laravel 12**
- **Blade + TailwindCSS**
- **MySQL**
- **Xampp**
- **Laravel Breeze**
- **Eloquent ORM**

---

## 📘 Filosofi Sistem

Sejalan dengan makna **Mardika**, sistem ini dibangun untuk:

- Memberikan **kemandirian** bagi seller untuk berbisnis  
- Memberikan **kebebasan** bagi buyer untuk memilih produk  
- Menjaga **kepercayaan** melalui sistem review & tracking pesanan  
- Menjadi fondasi marketplace modern yang bisa terus berkembang

--

# 🔄 Flow Alur Marketplace MardikaStore

Dokumen ini menjelaskan alur lengkap bagaimana Marketplace MardikaStore bekerja mulai dari **Guest**, **Buyer**, **Seller**, hingga **Admin**. Penjelasan alur dibuat ringkas namun terstruktur agar mudah dipahami oleh developer maupun stakeholder.

---

## 🧭 1. Alur User & Autentikasi

### **Guest**
👤 Guest
↓
🔍 Melihat produk
↓
🚫 Tidak bisa checkout / wishlist / review
↓
📝 Diminta login atau register

### **Buyer**
🧑‍💼 Buyer Login
↓
🏠 Masuk ke Buyer Dashboard
↓
🔍 Cari Produk → Tambah ke Keranjang / Wishlist
↓
🛒 Checkout
↓
📦 Pesanan dibuat (status: pending)
↓
🚚 Seller memproses pesanan
↓
📬 Pesanan selesai (completed)
↓
⭐ Buyer bisa beri review produk

### **Admin**
👑 Admin Login
↓
📊 Dashboard Admin
↓
🧑‍💼 Kelola User & Seller Verification
↓
🏪 Kelola Toko
↓
🏷️ Kelola Kategori Produk
↓
🛍️ Monitoring Produk & Marketplace

## 📌 Pembuat
**MardikaStore**  
🥷 Sosok asli dibalik pembuatan **MardikaStore** yaitu: **Ditqzy** 🚀
