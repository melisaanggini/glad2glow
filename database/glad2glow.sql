-- =============================================
-- DATABASE: glad2glow
-- Prototype for skripsi UEQ+ & Kano Model
-- =============================================

CREATE DATABASE IF NOT EXISTS glad2glow CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE glad2glow;

-- =============================================
-- TABLE: categories
-- =============================================
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL,
    image VARCHAR(255) DEFAULT 'default-category.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- TABLE: products
-- =============================================
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL,
    variant VARCHAR(100) DEFAULT NULL,
    size VARCHAR(50) DEFAULT NULL,
    price DECIMAL(12,0) NOT NULL,
    old_price DECIMAL(12,0) DEFAULT NULL,
    rating DECIMAL(2,1) DEFAULT 4.5,
    review_count INT DEFAULT 0,
    description TEXT,
    benefits TEXT,
    how_to_use TEXT,
    ingredients TEXT,
    image VARCHAR(255) DEFAULT 'default-product.jpg',
    is_bestseller TINYINT(1) DEFAULT 0,
    is_new TINYINT(1) DEFAULT 1,
    stock INT DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- =============================================
-- SEED DATA: Categories
-- =============================================
INSERT INTO categories (name, slug, image) VALUES
('Skincare', 'skincare', 'cat-skincare.jpg'),
('Body Care', 'body-care', 'cat-bodycare.jpg'),
('Hair Care', 'hair-care', 'cat-haircare.jpg'),
('Lip Care', 'lip-care', 'cat-lipcare.jpg'),
('Sun Care', 'sun-care', 'cat-suncare.jpg'),
('Eye Care', 'eye-care', 'cat-eyecare.jpg');

-- =============================================
-- SEED DATA: Products
-- =============================================
INSERT INTO products (category_id, name, slug, variant, size, price, old_price, rating, review_count, description, benefits, how_to_use, ingredients, image, is_bestseller, is_new) VALUES
(1, 'Glow Booster Serum', 'glow-booster-serum', 'Brightening', '30ml', 120000, 150000, 4.8, 234, 
 'Serum pencerah kulit dengan kandungan Vitamin C 15% dan Niacinamide yang bekerja sinergis untuk mencerahkan, meratakan warna kulit, dan melindungi dari radikal bebas.',
 'Mencerahkan kulit kusam|Meratakan warna kulit|Menyamarkan noda hitam|Melindungi dari radikal bebas',
 'Gunakan 2-3 tetes serum pada wajah bersih, pagi dan malam. Tepuk lembut hingga meresap sempurna sebelum menggunakan pelembab.',
 'Aqua, Ascorbic Acid 15%, Niacinamide 5%, Hyaluronic Acid, Glycerin, Tocopherol',
 'product-serum.jpg', 1, 1),
(1, 'Hydra Glow Moisturizer', 'hydra-glow-moisturizer', 'All Skin Type', '50ml', 95000, 120000, 4.6, 189,
 'Pelembab ringan dengan kandungan Hyaluronic Acid dan Ceramide yang memberikan hidrasi 24 jam untuk kulit lembab dan bercahaya sepanjang hari.',
 'Melembabkan kulit 24 jam|Memperkuat skin barrier|Tekstur ringan non-greasy|Cocok untuk semua jenis kulit',
 'Oleskan secukupnya pada wajah dan leher setelah toner, pagi dan malam hari.',
 'Aqua, Hyaluronic Acid, Ceramide NP, Glycerin, Niacinamide 3%, Panthenol',
 'product-moisturizer.jpg', 1, 0),
(1, 'Pore Clarifying Toner', 'pore-clarifying-toner', 'Oily Skin', '150ml', 75000, 95000, 4.5, 312,
 'Toner penyeimbang dengan kandungan BHA 2% dan Zinc PCA yang membantu mengecilkan pori-pori, mengontrol minyak berlebih, dan mencegah jerawat.',
 'Mengecilkan pori-pori|Mengontrol minyak berlebih|Mencegah jerawat|Menyegarkan kulit',
 'Tuangkan toner pada kapas atau telapak tangan, tepuk lembut pada wajah setelah membersihkan wajah.',
 'Aqua, Salicylic Acid 2%, Zinc PCA, Niacinamide 5%, Witch Hazel Extract, Aloe Vera',
 'product-toner.jpg', 1, 0),
(2, 'Glow Body Lotion', 'glow-body-lotion', 'Brightening', '200ml', 80000, 100000, 4.7, 156,
 'Body lotion pencerah dengan kandungan Alpha Arbutin dan Vitamin C yang membantu mencerahkan kulit tubuh secara merata dan memberikan kelembaban tahan lama.',
 'Mencerahkan kulit tubuh|Melembabkan 12 jam|Aroma segar dan tahan lama|Menyamarkan bekas luka',
 'Oleskan secukupnya pada seluruh tubuh setelah mandi. Pijat hingga meresap sempurna.',
 'Aqua, Alpha Arbutin 2%, Ascorbic Acid, Glycerin, Shea Butter, Sweet Almond Oil',
 'product-lotion.jpg', 1, 0),
(1, 'Calming Face Mask', 'calming-face-mask', 'Sensitive Skin', '75ml', 65000, 80000, 4.4, 98,
 'Masker wajah menenangkan dengan kandungan Centella Asiatica dan Aloe Vera yang cocok untuk kulit sensitif dan mudah iritasi.',
 'Menenangkan kulit iritasi|Meredakan kemerahan|Melembabkan intensif|Aman untuk kulit sensitif',
 'Oleskan masker pada wajah bersih, diamkan 15-20 menit, lalu bilas dengan air bersih. Gunakan 2-3x seminggu.',
 'Centella Asiatica Extract, Aloe Vera, Panthenol, Allantoin, Glycerin, Chamomile Extract',
 'product-mask.jpg', 0, 1),
(5, 'UV Shield Sunscreen SPF50', 'uv-shield-sunscreen', 'PA++++', '50ml', 110000, 135000, 4.9, 445,
 'Sunscreen broad spectrum SPF 50 PA++++ dengan tekstur ringan, tidak meninggalkan white cast, dan tidak lengket di kulit tropis.',
 'Perlindungan UVA & UVB|Tidak meninggalkan white cast|Tekstur ringan & cepat meresap|Melembabkan sekaligus melindungi',
 'Oleskan secukupnya pada wajah 15 menit sebelum beraktivitas di luar ruangan. Reapply setiap 2-3 jam.',
 'Zinc Oxide, Titanium Dioxide, Niacinamide 5%, Hyaluronic Acid, Vitamin E, Aloe Vera',
 'product-sunscreen.jpg', 1, 1);
