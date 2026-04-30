-- Handmade Heaven Database Schema
-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255),
    category VARCHAR(50),
    stock INT DEFAULT 0,
    featured BOOLEAN DEFAULT FALSE
);

-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    id BIGINT PRIMARY KEY,
    user_id INT,
    total DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending_approval',
    phone VARCHAR(15),
    address TEXT,
    payment_method VARCHAR(50),
    utr_number VARCHAR(100),
    preview_image LONGTEXT,
    custom_text LONGTEXT,
    custom_image LONGTEXT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Order Items Table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT,
    product_id INT,
    qty INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
);

-- Reviews Table
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    name VARCHAR(100),
    rating INT CHECK (rating >= 1 AND rating <= 5),
    text TEXT,
    date DATE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Admin Table
CREATE TABLE IF NOT EXISTS admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Wishlist / CART Table
CREATE TABLE IF NOT EXISTS wishlist_cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    item_type ENUM('cart', 'wishlist') DEFAULT 'cart',
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Seed Products
INSERT INTO products (id, name, description, price, image, category, stock, featured) VALUES
(1, 'Teddy Bear Heart Keychain', 'A handmade clay bear keychain holding a red heart, featuring a ''LOVE'' charm in pink lettering.', 120.00, 'images/bear.jpg', 'Keychains', 10, 1),
(2, 'Cybernetic Computer Science Project', 'A detailed, hand-drawn and 3D layered cover page featuring a robotic head and circuit board aesthetics.', 200.00, 'images/computer_project_cover.jpg', 'Art & Projects', 10, 0),
(3, 'Friendship (Dosti) Clay Art', 'A sentimental clay relief depicting two friends from behind, framed within a heart-accented arch.', 160.00, 'images/Dosti.jpg.jpeg', 'Wall Decor', 10, 1),
(4, 'Hand-Lettered New Year Card', 'A vibrant New Year card featuring elegant hand-lettering shaped like a champagne glass surrounded by colorful fireworks.', 140.00, 'images/popup_card.jpg', 'Cards', 50, 0),
(5, 'Floral Bunny Clay Medallion', 'An intricate clay art piece featuring a white rabbit with a purple bow, surrounded by green vines and purple flowers.', 190.00, 'images/rabbit.jpg', 'Wall Decor', 10, 0),
(6, 'Handmade Paper Wreath', 'A festive green paper wreath adorned with a bright pink bow and shimmering gold glitter accents.', 160.00, 'images/wreath.jpg', 'Home Decor', 15, 1),
(7, 'Miniature Bear in a Bottle', 'A tiny pink clay bear holding a heart, preserved inside a miniature glass jar with a keychain attachment.', 180.00, 'images/teddy_in_bottle.jpeg', 'Keychains', 10, 1),
(8, 'Radha Krishna Holi Painting', 'A colorful, hand-drawn illustration of Radha and Krishna celebrating Holi with vibrant powders.', 240.00, 'images/blue_guy_with_skin_lady_painting.jpeg', 'Art & Projects', 10, 1),
(9, 'Mandala Art Dolphin', 'A beautiful dolphin silhouette filled with intricate mandala patterns, jumping over stylized ocean waves.', 260.00, 'images/dolphin_painting.jpeg', 'Art & Projects', 10, 0),
(10, 'Monogram ''R'' Floral Plaque', 'A personalized clay wall hanging featuring the letter ''R'' surrounded by colorful 3D clay flowers.', 280.00, 'images/r_wall_decorator.jpeg', 'Wall Decor', 10, 0),
(11, 'Anti-Bullying Awareness Poster', 'An educational and impactful hand-painted poster highlighting the different types of bullying and the power of words.', 159.00, 'images/stop_bullying_poster.jpeg', 'Art & Projects', 10, 0),
(12, 'Pink Heart Bear Figurine', 'A cute, standalone pink clay bear figurine hugging a large orange heart.', 200.00, 'images/teddy.jpeg', 'Home Decor', 12, 0),
(13, 'Serenity Baby Sketch', 'A delicate pencil sketch of a sleeping baby with a butterfly, capturing a moment of peace and innocence.', 160.00, 'images/baby_with_a_big_face_sketch.jpeg', 'Fine Art', 10, 0),
(14, 'Bunny Garden Vine Display', 'A charming 3D clay scene featuring two bunnies under a climbing vine with hanging roses and carrots.', 240.00, 'images/bunny_under_the_wine.jpeg', 'Home Decor', 10, 1),
(15, 'Bird & Daisy Clay Medallion', 'A hand-sculpted clay badge featuring an orange bird and a white daisy on a textured grey background.', 120.00, 'images/clay_badge.jpeg', 'Wall Decor', 10, 0),
(16, 'Miniature Rose Bouquet', 'A vibrant bundle of hand-sculpted clay roses in multiple colors, wrapped in a white paper cone.', 440.00, 'images/clay_flower_bundle.jpeg', 'Gifts', 10, 1),
(17, 'Zentangle Elephant Art', 'An intricate, high-contrast ink drawing of an elephant head filled with complex zentangle patterns.', 200.00, 'images/fine_art_elephant.jpeg', 'Fine Art', 10, 1),
(18, 'Feather & Flora Sketch', 'A detailed graphite drawing of a feather transitioning into a collection of flowers and berries.', 440.00, 'images/flowers_sketch.jpeg', 'Fine Art', 10, 0),
(19, 'Divine Love Pencil Portrait', 'A soulful pencil drawing depicting a serene moment of devotion with traditional Indian cultural elements.', 400.00, 'images/for_real_question_mark.jpeg', 'Fine Art', 10, 1),
(20, 'Diwali Lotus Wall Hangings', 'A pair of festive wall hangings featuring 3D clay lotuses and hand-drawn deities with decorative pom-poms.', 120.00, 'images/2_in_1_mythical_cretures.jpeg', 'Home Decor', 10, 1),
(21, 'Profile Beauty Sketch', 'A minimalist and elegant profile sketch of a woman with flowing hair, focused on soft shading and clean lines.', 200.00, 'images/absolute_beauty_sketch.jpeg', 'Fine Art', 10, 0),
(22, 'Handmade Nativity Scene', 'A beautiful 3D mixed-media nativity scene featuring cut-out figures and real straw accents.', 170.00, 'images/adam_eve_praying_with_child_bullshit.jpeg', 'Home Decor', 10, 1),
(23, 'Happy Feast Day Poster', 'A vibrant hand-drawn greeting poster with pink floral accents and bold typography on a yellow-banded background.', 180.00, 'images/good_wishes_poster.jpeg', 'Cards', 20, 0),
(24, 'Arthur Fleck Joker Portrait', 'A high-contrast sketch and ink painting of the Joker, featuring his iconic face paint and a reflective quote.', 200.00, 'images/joker_sketch_painting.jpeg', 'Fine Art', 10, 1),
(25, 'Origami Bear & Tulip Set', 'A cute yellow origami bear holding a purple heart, paired with a matching paper tulip in a small vase.', 120.00, 'images/paper_bear_with_flower.jpeg', 'Gifts', 10, 0),
(26, 'Pink Paper Bloom Bouquet', 'An intricate, multi-layered paper flower bouquet in bright pink, presented in a sleek blue cone wrapper.', 100.00, 'images/paper_flower_port.jpeg', 'Gifts', 10, 1),
(27, 'Koala Garden Clay Keychain', 'A textured clay keychain depicting a peach-colored koala nestled among colorful vines and leaves.', 120.00, 'images/quala_key_chain.jpeg', 'Keychains', 10, 0),
(28, 'Merchant of Venice Scale Prop', 'A symbolic 3D poster for the classic play, featuring a scale balancing dark stones against a realistic clay organ.', 200.00, 'images/trade_organ_with_rocks.jpeg', 'Art & Projects', 10, 1),
(29, 'Tropical Parrot Wall Mural', 'A hand-painted wall mural of a colorful parrot perched on a branch, designed to accent home fixtures.', 400.00, 'images/wallpaper_with_parrot.jpeg', 'Home Decor', 10, 1),
(30, 'Canal City Landscape', 'A peaceful colored pencil drawing of a city with a bridge over a canal, featuring charming houses and trees.', 110.00, 'images/water_city_painting.jpeg', 'Fine Art', 10, 0),
(31, 'Vintage Calligraphy Gift Box', 'A handmade white gift box featuring a vintage script-patterned lid and a white paper fan accent.', 140.00, 'images/what_is_this.jpeg', 'Gifts', 10, 0),
(32, 'Hooded Reflection Sketch', 'A moody graphite sketch of a figure in a hoodie sitting in a field, focusing on light and shadow textures.', 120.00, 'images/wishing_a_good_tomorrow_sketch.jpeg', 'Fine Art', 10, 0),
(33, 'Midnight Reading Silhouette', 'A circular ink illustration featuring a silhouette of a person reading on a swing under a tree, illuminated by a glowing yellow lantern.', 140.00, 'images/woman_under_the_tree_painting.jpeg', 'Fine Art', 10, 1);
