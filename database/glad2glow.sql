-- =============================================
-- DATABASE: glad2glow
-- Prototype Skripsi UEQ+ & Kano Model
-- Kategori disesuaikan dengan desain Figma
-- =============================================

CREATE DATABASE IF NOT EXISTS glad2glow CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE glad2glow;

-- =============================================
-- TABLE: categories
-- =============================================
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL,
    image VARCHAR(255) DEFAULT 'placeholder.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- TABLE: products
-- =============================================
CREATE TABLE products (
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
    image VARCHAR(255) DEFAULT 'placeholder.jpg',
    is_bestseller TINYINT(1) DEFAULT 0,
    is_new TINYINT(1) DEFAULT 1,
    stock INT DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- =============================================
-- SEED: Categories (sesuai Figma)
-- =============================================
INSERT INTO categories (name, slug, image) VALUES
('Make Up',    'make-up',    'makeup.png'),
('Cleanser',   'cleanser',   'micellar.png'),
('Serum',      'serum',      'serum.png'),
('Toner',      'toner',      'toner.png'),
('Moisturizer','moisturizer','moisturizer.png'),
('Body Lotion','body-lotion','lotion.png'),
('Combo Sets', 'combo-sets', 'combo.png');

-- =============================================
-- SEED: Products (sesuai Figma - nama produk real)
-- =============================================
INSERT INTO products (category_id, name, slug, variant, size, price, old_price, rating, review_count, description, benefits, how_to_use, ingredients, image, is_bestseller, is_new) VALUES

-- SERUM (cat id 3) - Bestsellers
(3, 'Brightening Lip Serum', 'brightening-lip-serum', 'Brightening', '15ml',
 20, 25, 4.5, 0,
 'Serum bibir pencerah dengan kandungan Vitamin C dan Niacinamide yang membantu mencerahkan warna bibir gelap secara bertahap dan memberikan kelembaban intensif.',
 'Mencerahkan bibir gelap|Melembabkan bibir kering|Memberikan efek glossy alami|Menyamarkan garis bibir',
 'Oleskan tipis pada bibir pagi dan malam setelah membersihkan wajah. Bisa dipakai sebagai base sebelum lipstik.',
 'Aqua, Ascorbic Acid, Niacinamide, Hyaluronic Acid, Glycerin, Tocopherol, Rosa Canina Fruit Extract',
 'product-serum.jpg', 1, 0),

(2, 'Milk Amino Acid Gentle Cleanser 80g', 'milk-amino-acid-cleanser', 'All Skin Type', '80g',
 20, 25, 4.5, 0,
 'Pembersih wajah lembut dengan kandungan Amino Acid susu yang membersihkan pori tanpa menghilangkan kelembaban alami kulit. Cocok untuk semua jenis kulit termasuk sensitif.',
 'Membersihkan kotoran dan makeup|Menjaga kelembaban kulit|Tidak menyebabkan iritasi|Cocok untuk kulit sensitif',
 'Basahi wajah, ambil secukupnya lalu buat busa di tangan. Pijat lembut ke wajah dengan gerakan memutar, bilas dengan air bersih.',
 'Aqua, Sodium Cocoyl Glutamate, Milk Amino Acid, Glycerin, Panthenol, Allantoin, Centella Asiatica Extract',
 'product-toner.jpg', 1, 0),

(3, 'Blueberry Gel Cleanser', 'blueberry-gel-cleanser', 'Normal to Oily', '100ml',
 20, 25, 4.5, 0,
 'Gel cleanser dengan ekstrak blueberry kaya antioksidan yang membantu membersihkan pori secara mendalam sambil melindungi kulit dari radikal bebas.',
 'Membersihkan pori secara mendalam|Kaya antioksidan blueberry|Mencegah penuaan dini|Kulit terasa segar',
 'Gunakan pagi dan malam. Basahi wajah, oleskan gel, pijat lembut, bilas bersih.',
 'Aqua, Vaccinium Myrtillus Extract, Salicylic Acid 0.5%, Glycerin, Niacinamide, Panthenol',
 'product-mask.jpg', 1, 0),

(3, 'AHA BHA PHA Intensive Peeling Solution', 'aha-bha-pha-peeling', 'Exfoliating', '30ml',
 20, 25, 4.5, 0,
 'Peeling solution intensif dengan kombinasi AHA, BHA, dan PHA yang bekerja sinergis mengangkat sel kulit mati, mengecilkan pori, dan meratakan tekstur kulit.',
 'Mengangkat sel kulit mati|Mengecilkan pori-pori|Meratakan tekstur kulit|Mencerahkan kulit kusam',
 'Gunakan 1-2x seminggu. Oleskan pada wajah kering, diamkan 10-15 menit, bilas bersih. Gunakan SPF saat pagi hari.',
 'Aqua, Glycolic Acid 10%, Salicylic Acid 2%, Polyhydroxy Acid, Niacinamide 5%, Aloe Vera',
 'product-moisturizer.jpg', 1, 0),

-- NEW PRODUCTS
(6, 'Niacinamide Bright Body Serum', 'niacinamide-bright-body-serum', 'Brightening', '200ml',
 40, NULL, 4.7, 12,
 'Body serum pencerah dengan Niacinamide 5% dan Alpha Arbutin yang membantu meratakan warna kulit tubuh, menyamarkan bekas luka, dan memberikan efek glowing merata.',
 'Mencerahkan kulit tubuh|Menyamarkan bekas luka|Meratakan warna kulit|Memberikan efek glowing',
 'Oleskan pada kulit tubuh yang bersih setelah mandi. Pijat hingga meresap. Gunakan pagi dan malam.',
 'Aqua, Niacinamide 5%, Alpha Arbutin 2%, Glycerin, Hyaluronic Acid, Vitamin C, Shea Butter',
 'product-lotion.jpg', 0, 1),

(2, 'Sensitive Clear Micellar Water', 'sensitive-clear-micellar-water', 'Sensitive Skin', '200ml',
 40, NULL, 4.6, 8,
 'Micellar water untuk kulit sensitif yang membersihkan makeup, kotoran, dan sebum tanpa perlu dibilas. Formula lembut bebas alkohol dan parfum.',
 'Membersihkan makeup tanpa bilas|Aman untuk kulit sensitif|Bebas alkohol dan parfum|Menjaga kelembaban',
 'Tuangkan pada kapas, usapkan lembut ke seluruh wajah hingga kapas bersih. Tidak perlu dibilas.',
 'Aqua, Micelles, Glycerin, Panthenol, Allantoin, Chamomile Extract, Aloe Vera',
 'product-serum.jpg', 0, 1),

(5, 'Flawless Bluring Skin Tint', 'flawless-bluring-skin-tint', 'Natural Beige', '30ml',
 40, NULL, 4.8, 24,
 'Skin tint ringan dengan finish blur yang menyamarkan ketidaksempurnaan kulit secara natural. Memberikan coverage ringan dengan hasil akhir kulit sehat bercahaya.',
 'Coverage ringan dan natural|Finish blur menyamarkan pori|SPF 30 PA++|Kulit terlihat sehat glowing',
 'Oleskan dengan jari atau beauty sponge pada wajah. Blend rata ke leher untuk hasil natural.',
 'Aqua, Cyclopentasiloxane, Titanium Dioxide, Niacinamide 3%, Hyaluronic Acid, SPF 30',
 'product-moisturizer.jpg', 0, 1),

(5, 'Perfect Cover BB Cream', 'perfect-cover-bb-cream', 'Light Beige', '40ml',
 40, NULL, 4.5, 6,
 'BB Cream multifungsi yang memberikan coverage medium, SPF 50, dan perawatan kulit dalam satu langkah. Cocok untuk tampilan natural sehari-hari.',
 'Coverage medium|SPF 50 PA+++|Menutrisi dan melembabkan|Tahan lama 12 jam',
 'Oleskan pada wajah menggunakan jari atau kuas. Blend rata, bisa dipadukan dengan bedak untuk hasil lebih tahan lama.',
 'Aqua, Titanium Dioxide, Zinc Oxide, Niacinamide 5%, Hyaluronic Acid, Collagen, SPF 50',
 'product-mask.jpg', 0, 1);
