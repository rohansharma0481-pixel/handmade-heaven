

const PRODUCTS = [
  {
    id: 1,
    name: "Teddy Bear Heart Keychain",
    description: "A handmade clay bear keychain holding a red heart, featuring a 'LOVE' charm in pink lettering.",
    price: 120.0,
    image: "../images/bear.jpg",
    category: "Keychains",
    stock: 15,
    featured: true,
  },
  {
    id: 2,
    name: "Cybernetic Computer Science Project",
    description: "A detailed, hand-drawn and 3D layered cover page featuring a robotic head and circuit board aesthetics.",
    price: 200.0,
    image: "../images/computer_project_cover.jpg",
    category: "Art & Projects",
    stock: 10,
    featured: false,
  },
  {
    id: 3,
    name: "Friendship (Dosti) Clay Art",
    description: "A sentimental clay relief depicting two friends from behind, framed within a heart-accented arch.",
    price: 160.0,
    image: "../images/Dosti.jpg.jpeg",
    category: "Wall Decor",
    stock: 10,
    featured: true,
  },
  {
    id: 4,
    name: "Hand-Lettered New Year Card",
    description: "A vibrant New Year card featuring elegant hand-lettering shaped like a champagne glass surrounded by colorful fireworks.",
    price: 140.0,
    image: "../images/popup_card.jpg",
    category: "Cards",
    stock: 50,
    featured: false,
  },
  {
    id: 5,
    name: "Floral Bunny Clay Medallion",
    description: "An intricate clay art piece featuring a white rabbit with a purple bow, surrounded by green vines and purple flowers.",
    price:190.0,
    image: "../images/rabbit.jpg",
    category: "Wall Decor",
    stock: 10,
    featured: false,
  },
  {
    id: 6,
    name: "Handmade Paper Wreath",
    description: "A festive green paper wreath adorned with a bright pink bow and shimmering gold glitter accents.",
    price: 160.0,
    image: "../images/wreath.jpg",
    category: "Home Decor",
    stock: 15,
    featured: true,
  },
  {
    id: 7,
    name: "Miniature Bear in a Bottle",
    description: "A tiny pink clay bear holding a heart, preserved inside a miniature glass jar with a keychain attachment.",
    price: 180.0,
    image: "../images/teddy_in_bottle.jpeg",
    category: "Keychains",
    stock: 10,
    featured: true,
  },
  {
    id: 8,
    name: "Radha Krishna Holi Painting",
    description: "A colorful, hand-drawn illustration of Radha and Krishna celebrating Holi with vibrant powders.",
    price: 240.0,
    image: "../images/blue_guy_with_skin_lady_painting.jpeg",
    category: "Art & Projects",
    stock: 10,
    featured: true,
  },
  {
    id: 9,
    name: "Mandala Art Dolphin",
    description: "A beautiful dolphin silhouette filled with intricate mandala patterns, jumping over stylized ocean waves.",
    price: 260.0,
    image: "../images/dolphin_painting.jpeg",
    category: "Art & Projects",
    stock: 10,
    featured: false,
  },
  {
    id: 10,
    name: "Monogram 'R' Floral Plaque",
    description: "A personalized clay wall hanging featuring the letter 'R' surrounded by colorful 3D clay flowers.",
    price: 280.0,
    image: "../images/r_wall_decorator.jpeg",
    category: "Wall Decor",
    stock: 10,
    featured: false,
  },
  {
    id: 11,
    name: "Anti-Bullying Awareness Poster",
    description: "An educational and impactful hand-painted poster highlighting the different types of bullying and the power of words.",
    price: 159.0,
    image: "../images/stop_bullying_poster.jpeg",
    category: "Art & Projects",
    stock: 10,
    featured: false,
  },
  {
    id: 12,
    name: "Pink Heart Bear Figurine",
    description: "A cute, standalone pink clay bear figurine hugging a large orange heart.",
    price: 200.0,
    image: "../images/teddy.jpeg",
    category: "Home Decor",
    stock: 12,
    featured: false,
  },
  {
    id: 13,
    name: "Serenity Baby Sketch",
    description: "A delicate pencil sketch of a sleeping baby with a butterfly, capturing a moment of peace and innocence.",
    price: 160.0,
    image: "../images/baby_with_a_big_face_sketch.jpeg",
    category: "Fine Art",
    stock: 10,
    featured: false,
  },
  {
    id: 14,
    name: "Bunny Garden Vine Display",
    description: "A charming 3D clay scene featuring two bunnies under a climbing vine with hanging roses and carrots.",
    price: 240.0,
    image: "../images/bunny_under_the_wine.jpeg",
    category: "Home Decor",
    stock: 10,
    featured: true,
  },
  {
    id: 15,
    name: "Bird & Daisy Clay Medallion",
    description: "A hand-sculpted clay badge featuring an orange bird and a white daisy on a textured grey background.",
    price:120.0,
    image: "../images/clay_badge.jpeg",
    category: "Wall Decor",
    stock: 10,
    featured: false,
  },
  {
    id: 16,
    name: "Miniature Rose Bouquet",
    description: "A vibrant bundle of hand-sculpted clay roses in multiple colors, wrapped in a white paper cone.",
    price: 440.0,
    image: "../images/clay_flower_bundle.jpeg",
    category: "Gifts",
    stock: 10,
    featured: true,
  },
  {
    id: 17,
    name: "Zentangle Elephant Art",
    description: "An intricate, high-contrast ink drawing of an elephant head filled with complex zentangle patterns.",
    price: 200.0,
    image: "../images/fine_art_elephant.jpeg",
    category: "Fine Art",
    stock: 10,
    featured: true,
  },
  {
    id: 18,
    name: "Feather & Flora Sketch",
    description: "A detailed graphite drawing of a feather transitioning into a collection of flowers and berries.",
    price: 440.0,
    image: "../images/flowers_sketch.jpeg",
    category: "Fine Art",
    stock: 10,
    featured: false,
  },
  {
    id: 19,
    name: "Divine Love Pencil Portrait",
    description: "A soulful pencil drawing depicting a serene moment of devotion with traditional Indian cultural elements.",
    price: 400.0,
    image: "../images/for_real_question_mark.jpeg",
    category: "Fine Art",
    stock: 10,
    featured: true,
  },
  {
    id: 20,
    name: "Diwali Lotus Wall Hangings",
    description: "A pair of festive wall hangings featuring 3D clay lotuses and hand-drawn deities with decorative pom-poms.",
    price: 120.0,
    image: "../images/2_in_1_mythical_cretures.jpeg",
    category: "Home Decor",
    stock: 10,
    featured: true,
  },
  {
    id: 21,
    name: "Profile Beauty Sketch",
    description: "A minimalist and elegant profile sketch of a woman with flowing hair, focused on soft shading and clean lines.",
    price: 200.0,
    image: "../images/absolute_beauty_sketch.jpeg",
    category: "Fine Art",
    stock: 10,
    featured: false,
  },
  {
    id: 22,
    name: "Handmade Nativity Scene",
    description: "A beautiful 3D mixed-media nativity scene featuring cut-out figures and real straw accents.",
    price: 170.0,
    image: "../images/adam_eve_praying_with_child_bullshit.jpeg",
    category: "Home Decor",
    stock: 10,
    featured: true,
  },
  {
    id: 23,
    name: "Happy Feast Day Poster",
    description: "A vibrant hand-drawn greeting poster with pink floral accents and bold typography on a yellow-banded background.",
    price: 180.0,
    image: "../images/good_wishes_poster.jpeg",
    category: "Cards",
    stock: 20,
    featured: false,
  },
  {
    id: 24,
    name: "Arthur Fleck Joker Portrait",
    description: "A high-contrast sketch and ink painting of the Joker, featuring his iconic face paint and a reflective quote.",
    price: 200.0,
    image: "../images/joker_sketch_painting.jpeg",
    category: "Fine Art",
    stock: 10,
    featured: true,
  },
  {
    id: 25,
    name: "Origami Bear & Tulip Set",
    description: "A cute yellow origami bear holding a purple heart, paired with a matching paper tulip in a small vase.",
    price: 120.0,
    image: "../images/paper_bear_with_flower.jpeg",
    category: "Gifts",
    stock: 10,
    featured: false,
  },
  {
    id: 26,
    name: "Pink Paper Bloom Bouquet",
    description: "An intricate, multi-layered paper flower bouquet in bright pink, presented in a sleek blue cone wrapper.",
    price: 100.0,
    image: "../images/paper_flower_port.jpeg",
    category: "Gifts",
    stock: 10,
    featured: true,
  },
  {
    id: 27,
    name: "Koala Garden Clay Keychain",
    description: "A textured clay keychain depicting a peach-colored koala nestled among colorful vines and leaves.",
    price: 120.0,
    image: "../images/quala_key_chain.jpeg",
    category: "Keychains",
    stock: 10,
    featured: false,
  },
  {
    id: 28,
    name: "Merchant of Venice Scale Prop",
    description: "A symbolic 3D poster for the classic play, featuring a scale balancing dark stones against a realistic clay organ.",
    price: 200.0,
    image: "../images/trade_organ_with_rocks.jpeg",
    category: "Art & Projects",
    stock: 10,
    featured: true,
  },
  {
    id: 29,
    name: "Tropical Parrot Wall Mural",
    description: "A hand-painted wall mural of a colorful parrot perched on a branch, designed to accent home fixtures.",
    price: 400.0,
    image: "../images/wallpaper_with_parrot.jpeg",
    category: "Home Decor",
    stock: 10,
    featured: true,
  },
  {
    id: 30,
    name: "Canal City Landscape",
    description: "A peaceful colored pencil drawing of a city with a bridge over a canal, featuring charming houses and trees.",
    price: 110.0,
    image: "../images/water_city_painting.jpeg",
    category: "Fine Art",
    stock: 10,
    featured: false,
  },
  {
    id: 31,
    name: "Vintage Calligraphy Gift Box",
    description: "A handmade white gift box featuring a vintage script-patterned lid and a white paper fan accent.",
    price: 140.0,
    image: "../images/what_is_this.jpeg",
    category: "Gifts",
    stock: 10,
    featured: false,
  },
  {
    id: 32,
    name: "Hooded Reflection Sketch",
    description: "A moody graphite sketch of a figure in a hoodie sitting in a field, focusing on light and shadow textures.",
    price: 120.0,
    image: "../images/wishing_a_good_tomorrow_sketch.jpeg",
    category: "Fine Art",
    stock: 10,
    featured: false,
  },
  {
    id: 33,
    name: "Midnight Reading Silhouette",
    description: "A circular ink illustration featuring a silhouette of a person reading on a swing under a tree, illuminated by a glowing yellow lantern.",
    price: 140.0,
    image: "../images/woman_under_the_tree_painting.jpeg",
    category: "Fine Art",
    stock: 10,
    featured: true,
  }
];

/// ── API Helper ──────────────────────────────────────────────
const API_PREFIX = window.location.pathname.includes('/pages/') ? '../backend/' : 'backend/';

function apiCall(endpoint, method = 'GET', data = null) {
    const xhr = new XMLHttpRequest();
    const url = API_PREFIX + endpoint + (endpoint.includes('?') ? '&' : '?') + 't=' + Date.now();
    console.log("API CALL:", method, url, data);
    xhr.open(method, url, false); // synchronous
    try {
        if (method === 'POST' && data) {
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(data));
        } else {
            xhr.send();
        }
    } catch (e) {
        console.error("XHR Send Exception:", e);
        return { error: 'XHR Exception: ' + e.message };
    }
    console.log("API RESP:", xhr.status, xhr.responseText);
    if (xhr.status >= 200 && xhr.status < 300) {
        return JSON.parse(xhr.responseText);
    }
    return { error: 'API Error: ' + xhr.status };
}

// ── Inventory ───────────────────────────────────────────────
const Inventory = {
  get() {
    let products = apiCall('products.php');
    if (!products || products.error || !Array.isArray(products)) {
        // Fallback to localStorage or hardcoded array if API fails for some reason
        products = JSON.parse(localStorage.getItem('ac_products'));
        if (!products || !products.length) {
            products = PRODUCTS;
        }
    }
    const isPages = window.location.pathname.includes('/pages/');
    return products.map(p => ({
        ...p,
        id: parseInt(p.id),
        image: (isPages ? '../' : '') + p.image.replace('../', '')
    }));
  },
  getById(id) {
    return this.get().find(p => p.id === parseInt(id));
  },
  updateStock(productId, qtyToDeduct) {
    let local = JSON.parse(localStorage.getItem('ac_products')) || PRODUCTS;
    const prod = local.find(p => p.id === parseInt(productId));
    if (prod) {
        prod.stock = Math.max(0, prod.stock - qtyToDeduct);
        localStorage.setItem('ac_products', JSON.stringify(local));
    }
  }
};

// ── Auth ────────────────────────────────────────────────────
const Auth = {
  signup(name, email, password) {
    const res = apiCall('auth.php?action=signup', 'POST', { name, email, password });
    if (res && res.success) {
        this.setSession(res.user);
        return { success: true };
    }
    return { error: (res && res.error) ? res.error : 'Signup failed' };
  },
  login(email, password) {
    const res = apiCall('auth.php?action=login', 'POST', { email, password });
    if (res && res.success) {
        this.setSession(res.user);
        return { success: true };
    }
    return { error: (res && res.error) ? res.error : 'Invalid email or password' };
  },
  getSession() {
    return JSON.parse(localStorage.getItem("ac_session") || "null");
  },
  setSession(user) {
    localStorage.setItem("ac_session", JSON.stringify(user));
  },
  clearSession() {
    localStorage.removeItem("ac_session");
  },
  logout() {
    this.clearSession();
  },
  isLoggedIn() {
    return !!this.getSession();
  },
  currentUser() {
    return this.getSession();
  },
};

// ── Cart ────────────────────────────────────────────────────
const Cart = {
  key() {
    const s = Auth.getSession();
    return s ? `ac_cart_${s.id}` : "ac_cart_guest";
  },
  get() {
    const user = Auth.currentUser();
    if (user && user.id) {
        const res = apiCall(`cart.php?action=get&userId=${user.id}&item_type=cart`);
        if (res && Array.isArray(res)) {
            return res;
        }
    }
    return JSON.parse(localStorage.getItem(this.key()) || "[]");
  },
  save(items) {
    localStorage.setItem(this.key(), JSON.stringify(items));
  },
  add(productId, qty = 1) {
    const user = Auth.currentUser();
    if (user && user.id) {
        apiCall('cart.php?action=add', 'POST', { userId: user.id, productId, qty, item_type: 'cart' });
    } else {
        const items = this.get();
        const existing = items.find((i) => i.productId === productId);
        if (existing) existing.qty += qty;
        else items.push({ productId, qty });
        this.save(items);
    }
  },
  update(productId, qty) {
    const user = Auth.currentUser();
    if (user && user.id) {
        apiCall('cart.php?action=update', 'POST', { userId: user.id, productId, qty, item_type: 'cart' });
    } else {
        let items = this.get();
        if (qty <= 0) items = items.filter((i) => i.productId !== productId);
        else {
          const item = items.find((i) => i.productId === productId);
          if (item) item.qty = qty;
        }
        this.save(items);
    }
  },
  remove(productId) {
    const user = Auth.currentUser();
    if (user && user.id) {
        apiCall('cart.php?action=remove', 'POST', { userId: user.id, productId, item_type: 'cart' });
    } else {
        this.save(this.get().filter((i) => i.productId !== productId));
    }
  },
  clear() {
    const user = Auth.currentUser();
    if (user && user.id) {
        apiCall('cart.php?action=clear', 'POST', { userId: user.id, item_type: 'cart' });
    } else {
        localStorage.removeItem(this.key());
    }
  },
  count() {
    return this.get().reduce((s, i) => s + i.qty, 0);
  },
  getWithProducts() {
    return this.get()
      .map((item) => {
        const product = Inventory.getById(item.productId);
        return { ...item, product };
      })
      .filter((i) => i.product);
  },
  total() {
    return this.getWithProducts().reduce(
      (s, i) => s + i.product.price * i.qty,
      0
    );
  },
};

// ── Wishlist ─────────────────────────────────────────────────
const Wishlist = {
  key() {
    const s = Auth.getSession();
    return s ? `ac_wish_${s.id}` : "ac_wish_guest";
  },
  get() {
    const user = Auth.currentUser();
    if (user && user.id) {
        const res = apiCall(`cart.php?action=get&userId=${user.id}&item_type=wishlist`);
        if (res && Array.isArray(res)) {
            return res.map(i => i.productId);
        }
    }
    return JSON.parse(localStorage.getItem(this.key()) || "[]");
  },
  save(ids) {
    localStorage.setItem(this.key(), JSON.stringify(ids));
  },
  has(id) {
    return this.get().includes(id);
  },
  toggle(id) {
    const user = Auth.currentUser();
    const ids = this.get();
    const idx = ids.indexOf(id);
    
    if (user && user.id) {
        if (idx >= 0) {
            apiCall('cart.php?action=remove', 'POST', { userId: user.id, productId: id, item_type: 'wishlist' });
            return false;
        } else {
            apiCall('cart.php?action=add', 'POST', { userId: user.id, productId: id, qty: 1, item_type: 'wishlist' });
            return true;
        }
    } else {
        if (idx >= 0) ids.splice(idx, 1);
        else ids.push(id);
        this.save(ids);
        return !ids.includes(id) ? false : true;
    }
  },
  remove(id) {
    const user = Auth.currentUser();
    if (user && user.id) {
        apiCall('cart.php?action=remove', 'POST', { userId: user.id, productId: id, item_type: 'wishlist' });
    } else {
        this.save(this.get().filter((i) => i !== id));
    }
  },
  getProducts() {
    return this.get()
      .map((id) => Inventory.getById(id))
      .filter(Boolean);
  },
};

// ── Orders ───────────────────────────────────────────────────
const Orders = {
  async get() {
    const user = Auth.currentUser();
    if (!user) return [];
    
    try {
        const url = API_PREFIX + 'orders.php?action=get&userId=' + user.id + '&email=' + encodeURIComponent(user.email) + '&t=' + Date.now();
        const response = await fetch(url);
        const resUser = await response.json();
        if (resUser && !resUser.error && Array.isArray(resUser)) {
            return resUser.map(o => ({
                id: parseInt(o.id),
                user_id: parseInt(o.user_id),
                date: o.date,
                status: o.status || 'pending_approval',
                total: parseFloat(o.total),
                extraCharge: parseFloat(o.extra_charge || 0),
                revisionNote: o.revision_note,
                previewImage: o.preview_image,
                customText: o.custom_text,
                customImage: o.custom_image,
                delivery_date: o.delivery_date,
                customer: {
                    name: user.name,
                    email: user.email,
                    phone: o.phone,
                    address: o.address,
                    paymentMethod: o.payment_method
                },
                items: (o.items || []).map(i => ({
                    productId: parseInt(i.product_id),
                    name: i.name,
                    image: i.image ? (i.image.startsWith('../') ? i.image : '../' + i.image) : '../images/bear.jpg',
                    qty: parseInt(i.qty),
                    price: parseFloat(i.price)
                }))
            }));
        }
    } catch (e) {
        console.error("Backend fetch failed:", e);
    }
    
    let orders = JSON.parse(localStorage.getItem('ac_orders') || '[]');
    return orders.filter(o => o.user_id === user.id);
  },
  async place(details = {}) {
    const items = Cart.getWithProducts();
    if (!items.length) return null;

    const user = Auth.currentUser();
    if (!user) return { error: "Please log in to place an order." };

    const discount = details.discountAmount || 0;
    const orderData = {
        id: Date.now(),
        user_id: user.id,
        date: new Date().toISOString().split('T')[0],
        status: 'pending_approval',
        total: Math.max(0, Cart.total() - discount),
        couponCode: details.couponCode || null,
        discountAmount: discount,
        customer: {
            name: user.name,
            email: user.email,
            phone: details.phone || '',
            address: details.address || '',
            paymentMethod: details.paymentMethod || 'COD'
        },
        items: items.map(i => ({
            productId: i.productId,
            name: i.product.name,
            image: i.product.image,
            qty: i.qty,
            price: i.product.price
        }))
    };

    let orders = JSON.parse(localStorage.getItem('ac_orders') || '[]');
    orders.push(orderData);
    localStorage.setItem('ac_orders', JSON.stringify(orders));

    try {
        const backendData = {
            id: orderData.id,
            user_id: user.id,
            total: orderData.total,
            phone: details.phone || '',
            address: details.address || '',
            paymentMethod: details.paymentMethod || 'COD',
            email: user.email,
            name: user.name,
            couponCode: details.couponCode || null,
            discountAmount: discount,
            items: items.map(i => ({
                productId: i.productId,
                qty: i.qty,
                price: i.product.price
            }))
        };
        const url = API_PREFIX + 'orders.php?action=place&t=' + Date.now();
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(backendData)
        });
        const res = await response.json();
        if (res && res.error) {
            return { error: "Backend error: " + res.error };
        }
    } catch (e) {
        console.error("Backend order sync failed:", e);
        return { error: "Failed to sync order with backend server." };
    }

    items.forEach(i => Inventory.updateStock(i.productId, i.qty));
    Cart.clear();
    return { id: orderData.id };
  },
  async getById(id) {
    const user = Auth.currentUser();
    if (user) {
        try {
            const url = API_PREFIX + 'orders.php?action=get&userId=' + user.id + '&email=' + encodeURIComponent(user.email) + '&t=' + Date.now();
            const response = await fetch(url);
            const resUser = await response.json();
            if (resUser && !resUser.error && Array.isArray(resUser)) {
                const o = resUser.find(ord => parseInt(ord.id) === parseInt(id));
                if (o) {
                    return {
                        id: parseInt(o.id),
                        user_id: parseInt(o.user_id),
                        date: o.date,
                        status: o.status || 'pending_approval',
                        total: parseFloat(o.total),
                        extraCharge: parseFloat(o.extra_charge || 0),
                        revisionNote: o.revision_note,
                        previewImage: o.preview_image,
                        customText: o.custom_text,
                        customImage: o.custom_image,
                        delivery_date: o.delivery_date,
                        customer: {
                            name: user.name,
                            email: user.email,
                            phone: o.phone,
                            address: o.address,
                            paymentMethod: o.payment_method
                        },
                        items: (o.items || []).map(i => ({
                            productId: parseInt(i.product_id),
                            name: i.name,
                            image: i.image ? (i.image.startsWith('../') ? i.image : '../' + i.image) : '../images/bear.jpg',
                            qty: parseInt(i.qty),
                            price: parseFloat(i.price)
                        }))
                    };
                }
            }
        } catch(e) { console.error('getById fetch failed:', e); }
    }
    let orders = JSON.parse(localStorage.getItem('ac_orders') || '[]');
    return orders.find(o => o.id === parseInt(id));
  },
  async updatePreview(orderId, imgUrl) {
    let orders = JSON.parse(localStorage.getItem('ac_orders') || '[]');
    const o = orders.find(o => o.id === parseInt(orderId));
    if (o) { o.previewImage = imgUrl; o.status = 'pending_approval'; localStorage.setItem('ac_orders', JSON.stringify(orders)); }
    try {
        const url = API_PREFIX + 'orders.php?action=updatePreview';
        await fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ orderId, previewImage: imgUrl }) });
    } catch(e) { console.error('updatePreview failed:', e); }
    return { success: true };
  },
  async confirmAndPay(orderId, paymentMethod, utrNumber = '') {
    let orders = JSON.parse(localStorage.getItem('ac_orders') || '[]');
    const o = orders.find(o => o.id === parseInt(orderId));
    if (o) { o.status = 'Processing'; if (o.customer) { o.customer.paymentMethod = paymentMethod; o.customer.utrNumber = utrNumber; } localStorage.setItem('ac_orders', JSON.stringify(orders)); }
    try {
        const url = API_PREFIX + 'orders.php?action=confirmAndPay';
        await fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ orderId, status: 'Processing', paymentMethod, utrNumber }) });
    } catch(e) { console.error('confirmAndPay failed:', e); }
    return { success: true };
  },
  async updateStatus(orderId, status, revisionNote = null) {
    let orders = JSON.parse(localStorage.getItem('ac_orders') || '[]');
    const o = orders.find(o => o.id === parseInt(orderId));
    if (o) { o.status = status; if (revisionNote) o.revisionNote = revisionNote; localStorage.setItem('ac_orders', JSON.stringify(orders)); }
    try {
        const url = API_PREFIX + 'orders.php?action=updateStatus';
        const body = { orderId, status };
        if (revisionNote !== null) body.revisionNote = revisionNote;
        await fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(body) });
    } catch(e) { console.error('updateStatus failed:', e); }
    return { success: true };
  }
};

// ── Reviews ──────────────────────────────────────────────────
const Reviews = {
  get(productId) {
    let reviews = JSON.parse(localStorage.getItem('ac_reviews_' + productId) || '[]');
    if (!reviews.length) {
        let allReviews = JSON.parse(localStorage.getItem('ac_reviews') || '[]');
        let prodReviews = allReviews.filter(r => r.productId === parseInt(productId));
        if (!prodReviews.length) {
            return [
              { id: 1, name: "Aarav Sharma", rating: 5, text: "Absolutely loved the quality! Highly recommend.", date: "2026-04-10" },
              { id: 2, name: "Sneha Patel", rating: 4, text: "Very pretty, but delivery took a day extra.", date: "2026-04-15" }
            ];
        }
        return prodReviews;
    }
    return reviews;
  },
  async load(productId) {
    try {
      const url = getRootPath() + 'backend/reviews.php?action=get&productId=' + productId + '&t=' + Date.now();
      const response = await fetch(url);
      const data = await response.json();
      if (Array.isArray(data) && !data.error) {
        const mapped = data.map(r => ({
          id: r.review_id || r.id,
          productId: parseInt(r.product_id),
          name: r.name,
          rating: parseInt(r.rating),
          text: r.text,
          date: r.date
        }));
        localStorage.setItem('ac_reviews_' + productId, JSON.stringify(mapped));
      }
    } catch (e) {
      console.error("Failed to load reviews from backend:", e);
    }
  },
  async add(productId, rating, text) {
    const user = Auth.currentUser() || { name: "Guest" };
    const review = { 
      productId: parseInt(productId), 
      name: user.name, 
      rating: parseInt(rating), 
      text, 
      date: new Date().toISOString().split('T')[0] 
    };

    let cached = JSON.parse(localStorage.getItem('ac_reviews_' + productId) || '[]');
    cached.push({ ...review, id: Date.now() });
    localStorage.setItem('ac_reviews_' + productId, JSON.stringify(cached));

    try {
      const url = getRootPath() + 'backend/reviews.php?action=add';
      const response = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(review)
      });
      const resData = await response.json();
      if (resData.success) {
        await this.load(productId);
      } else {
        alert("Backend Error: " + (resData.error || "Failed to save review."));
      }
    } catch (e) {
      console.error("Failed to save review to backend:", e);
      alert("Network Error: Could not connect to the backend server.");
    }
    return review;
  },
  getAverage(productId) {
    const reviews = this.get(productId);
    if (!reviews.length) return 0;
    const sum = reviews.reduce((acc, r) => acc + r.rating, 0);
    return (sum / reviews.length).toFixed(1);
  }
};

// ── Helpers ──────────────────────────────────────────────────
function fmt(n) {
  return new Intl.NumberFormat('en-IN', {
    style: 'currency',
    currency: 'INR',
    minimumFractionDigits: 0
  }).format(n);
}
function requireLogin(redirectBack) {
  if (!Auth.isLoggedIn()) {
    window.location.href = `pages/login.html${redirectBack ? "?next=" + encodeURIComponent(redirectBack) : ""}`;
    return false;
  }
  return true;
}

function updateNavCart() {
  const badges = document.querySelectorAll(".cart-badge");
  const count = Cart.count();
  badges.forEach((b) => {
    b.textContent = count;
    b.style.display = count > 0 ? "flex" : "none";
  });
}

function renderNav() {
  const user = Auth.currentUser();
  const authArea = document.getElementById("auth-area");
  const wishNav = document.getElementById("wish-nav");
  const ordersNav = document.getElementById("orders-nav");
  if (authArea) {
    if (user) {
      authArea.innerHTML = `
        <span class="user-greeting">Hi, ${(user.name || 'User').split(" ")[0]}</span>
        <button class="btn-text" onclick="Auth.logout();window.location.href='${getRootPath()}index.html'">Logout</button>`;
    } else {
      authArea.innerHTML = `
        <a href="${getRootPath()}pages/login.html" class="btn-outline auth-btn">Login</a>
        <a href="${getRootPath()}pages/signup.html" class="btn-primary auth-btn">Sign Up</a>`;
    }
  }
  if (wishNav) wishNav.style.display = user ? "inline" : "none";
  if (ordersNav) ordersNav.style.display = user ? "inline" : "none";
  updateNavCart();
  initMobileMenu();
}

function initMobileMenu() {
  const toggle = document.getElementById('mobile-toggle');
  const nav = document.querySelector('.main-nav');
  if (toggle && nav) {
    // Remove existing listener to avoid duplicates if renderNav is called multiple times
    toggle.onclick = () => {
      nav.classList.toggle('active');
      toggle.classList.toggle('active');
    };
  }
}

function getRootPath() {
  // Works from both /index.html and /pages/*.html
  return window.location.pathname.includes("/pages/") ? "../" : "";
}

function handleNavSearch(inputElementId) {
  const input = document.getElementById(inputElementId);
  if (!input) return;
  const q = input.value.trim();
  const root = getRootPath();
  if (q) {
    if (window.location.pathname.includes("products.html")) {
      // Just update UI if already on products page
      if (typeof applyFilters === 'function') applyFilters();
    } else {
      window.location.href = `${root}pages/products.html?q=${encodeURIComponent(q)}`;
    }
  } else if (window.location.pathname.includes("products.html")) {
    if (typeof applyFilters === 'function') applyFilters();
  } else {
    window.location.href = `${root}pages/products.html`;
  }
}

function showFlash(msg, type = "success") {
  let el = document.getElementById("flash-msg");
  if (!el) {
    el = document.createElement("div");
    el.id = "flash-msg";
    document.body.prepend(el);
  }
  el.className = `flash flash-${type}`;
  el.textContent = msg;
  el.style.display = "block";
  setTimeout(() => {
    el.style.opacity = "0";
    setTimeout(() => el.remove(), 400);
  }, 3000);
}

function showCustomizeModal() {
  if (!requireLogin(window.location.pathname)) return;
  const existing = document.getElementById('customize-modal');
  if (existing) { existing.classList.add('active'); return; }

  const user = Auth.currentUser() || {};
  const CUSTOM_CHARGE = 200;

  const modalHTML = `
    <div class="modal-overlay" id="customize-modal">
      <div class="modal-content" style="max-width:600px;">
        <button class="modal-close" onclick="document.getElementById('customize-modal').classList.remove('active')">&times;</button>
        <h2 class="modal-title">Custom Design Request</h2>
        <p class="modal-desc">Fill in your details, describe your dream design, and upload an inspiration image. We'll review and get back to you with a quote!</p>

        <form id="customize-form" onsubmit="submitCustomRequest(event)">

          <!-- Personal Info -->
          <div style="background:rgba(180,144,224,0.08);border:1px solid var(--border);border-radius:12px;padding:1.2rem;margin-bottom:1.5rem;">
            <h3 style="font-size:1rem;font-weight:700;color:var(--ink);margin-bottom:1rem;display:flex;align-items:center;gap:.4rem;">👤 Personal Information</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
              <div>
                <label style="display:block;margin-bottom:.4rem;font-size:.82rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;">Name</label>
                <input type="text" id="cust-name" value="${user.name || ''}" readonly class="form-input" style="background:#f3f4f6;color:#6b7280;"/>
              </div>
              <div>
                <label style="display:block;margin-bottom:.4rem;font-size:.82rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;">Email</label>
                <input type="email" id="cust-email" value="${user.email || ''}" readonly class="form-input" style="background:#f3f4f6;color:#6b7280;"/>
              </div>
            </div>
            <div style="margin-bottom:1rem;">
              <label style="display:block;margin-bottom:.4rem;font-size:.82rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;">Phone Number *</label>
              <input type="tel" id="cust-phone" required class="form-input" placeholder="Enter your phone number" oninput="custOnlyDigits(this, 'cust-phone-err')" maxlength="10"/>
              <span id="cust-phone-err" style="font-size:.75rem;color:#dc2626;display:none;margin-top:.3rem;">⚠️ Only numbers are allowed in phone number.</span>
            </div>
            <div>
              <label style="display:block;margin-bottom:.4rem;font-size:.82rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;">Delivery Address *</label>
              <div style="display:flex;flex-direction:column;gap:.6rem;">
                <input type="text" id="addr-house" required class="form-input" placeholder="House / Flat No., Building Name" />
                <input type="text" id="addr-street" required class="form-input" placeholder="Street / Area / Colony" />
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:.6rem;">
                  <div>
                    <input type="text" id="addr-city" required class="form-input" placeholder="City" oninput="custOnlyLetters(this, 'cust-city-err')" />
                    <span id="cust-city-err" style="font-size:.75rem;color:#dc2626;display:none;margin-top:.2rem;">⚠️ Only letters are allowed in City.</span>
                  </div>
                  <div>
                    <input type="text" id="addr-state" required class="form-input" placeholder="State" oninput="custOnlyLetters(this, 'cust-state-err')" />
                    <span id="cust-state-err" style="font-size:.75rem;color:#dc2626;display:none;margin-top:.2rem;">⚠️ Only letters are allowed in State.</span>
                  </div>
                </div>
                <div style="position:relative;">
                  <input type="text" id="addr-pin" required class="form-input" placeholder="PIN Code" maxlength="6" pattern="[0-9]{6}" oninput="custPinInput(this)" />
                  <span id="cust-pin-hint" style="font-size:.75rem;color:var(--muted);margin-top:.3rem;display:block;"></span>
                </div>
              </div>
            </div>
          </div>

          <!-- Design Description -->
          <div style="margin-bottom:1.5rem;">
            <label style="display:block;margin-bottom:.5rem;font-size:.9rem;font-weight:600;color:var(--ink);">✏️ Design Description *</label>
            <textarea id="custom-text" required class="form-input" rows="6" placeholder="E.g. I want a clay keychain with a blue butterfly, pink wings, my name 'Priya' written on it, size medium..." style="resize:vertical;"></textarea>
          </div>

          <!-- Image Upload -->
          <div class="upload-area" onclick="document.getElementById('custom-file').click()" id="upload-area-box">
            <div class="upload-icon">
              <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            </div>
            <p class="upload-text">Click to upload inspiration image (optional)</p>
            <input type="file" id="custom-file" accept="image/*" style="display:none;" onchange="previewCustomImage(this)">
          </div>
          <div class="preview-container" id="custom-preview-container">
            <button type="button" class="btn-remove-preview" onclick="removeCustomImage()">✕</button>
            <img id="custom-preview-img" src="" alt="Preview">
          </div>

          <!-- Delivery Options -->
          <div style="background:rgba(180,144,224,0.08);border:1px solid var(--border);border-radius:12px;padding:1.2rem;margin:1.5rem 0;">
            <h3 style="font-size:1rem;font-weight:700;color:var(--ink);margin-bottom:1rem;">🚚 Delivery Option</h3>
            <label style="display:flex;align-items:center;gap:.75rem;padding:.6rem;border-radius:8px;cursor:pointer;margin-bottom:.5rem;border:1.5px solid var(--border);background:var(--bg-card);" onclick="selectDelivery('standard')">
              <input type="radio" name="delivery" value="standard" id="del-standard" checked style="accent-color:var(--primary);" onchange="updateBill()">
              <div style="flex:1;">
                <strong style="color:var(--ink);font-size:.95rem;">Standard Delivery</strong>
                <span style="display:block;font-size:.8rem;color:var(--muted);">7–10 business days</span>
              </div>
              <span style="font-weight:700;color:var(--sage);">FREE</span>
            </label>
            <label style="display:flex;align-items:center;gap:.75rem;padding:.6rem;border-radius:8px;cursor:pointer;border:1.5px solid var(--border);background:var(--bg-card);" onclick="selectDelivery('express')">
              <input type="radio" name="delivery" value="express" id="del-express" style="accent-color:var(--primary);" onchange="updateBill()">
              <div style="flex:1;">
                <strong style="color:var(--ink);font-size:.95rem;">Express Delivery</strong>
                <span style="display:block;font-size:.8rem;color:var(--muted);">3–5 business days</span>
              </div>
              <span style="font-weight:700;color:var(--primary);">+₹50</span>
            </label>
          </div>

          <!-- Bill Summary -->
          <div style="background:linear-gradient(135deg,rgba(118,75,162,0.08),rgba(180,144,224,0.12));border:1.5px solid var(--primary-light);border-radius:12px;padding:1.2rem;margin-bottom:1.5rem;">
            <h3 style="font-size:1rem;font-weight:700;color:var(--ink);margin-bottom:1rem;">🧾 Estimated Bill</h3>
            <div style="display:flex;justify-content:space-between;padding:.4rem 0;border-bottom:1px dashed var(--border);font-size:.9rem;color:var(--ink-light);">
              <span>Customization Charge</span><span style="font-weight:600;color:var(--ink);">₹${CUSTOM_CHARGE}</span>
            </div>
            <div style="display:flex;justify-content:space-between;padding:.4rem 0;border-bottom:1px dashed var(--border);font-size:.9rem;color:var(--ink-light);">
              <span>Delivery</span><span id="bill-delivery" style="font-weight:600;color:var(--sage);">FREE</span>
            </div>
            <div style="display:flex;justify-content:space-between;padding:.6rem 0;font-size:1.05rem;font-weight:700;color:var(--ink);">
              <span>Estimated Total</span><span id="bill-total" style="color:var(--primary);">₹${CUSTOM_CHARGE}</span>
            </div>
            <p style="font-size:.78rem;color:var(--muted);margin-top:.5rem;font-style:italic;">* Final price will be confirmed by the artisan after reviewing your design. You can approve or request changes before payment.</p>
          </div>

          <div class="modal-actions">
            <button type="button" class="btn-outline" onclick="document.getElementById('customize-modal').classList.remove('active')">Cancel</button>
            <button type="submit" class="btn-primary">Submit Request & Generate Bill</button>
          </div>
        </form>
      </div>
    </div>
  `;
  document.body.insertAdjacentHTML('beforeend', modalHTML);

  window.selectDelivery = function(type) {
    document.getElementById('del-' + type).checked = true;
    updateBill();
  };

  window.updateBill = function() {
    const isExpress = document.getElementById('del-express') && document.getElementById('del-express').checked;
    const deliveryCharge = isExpress ? 50 : 0;
    const total = CUSTOM_CHARGE + deliveryCharge;
    const deliveryEl = document.getElementById('bill-delivery');
    const totalEl = document.getElementById('bill-total');
    if (deliveryEl) deliveryEl.textContent = deliveryCharge === 0 ? 'FREE' : '₹' + deliveryCharge;
    if (totalEl) totalEl.textContent = '₹' + total;
  };

  window.previewCustomImage = function(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('custom-preview-img').src = e.target.result;
        document.getElementById('custom-preview-container').style.display = 'block';
        document.getElementById('upload-area-box').style.display = 'none';
      };
      reader.readAsDataURL(input.files[0]);
    }
  };

  window.removeCustomImage = function() {
    document.getElementById('custom-file').value = '';
    document.getElementById('custom-preview-img').src = '';
    document.getElementById('custom-preview-container').style.display = 'none';
    document.getElementById('upload-area-box').style.display = 'block';
  };

  window.fetchCustomPin = function(pin) {
    const hint = document.getElementById('cust-pin-hint');
    if (pin.length !== 6 || !/^[0-9]{6}$/.test(pin)) {
      if (hint) hint.textContent = '';
      return;
    }
    if (hint) hint.textContent = '🔍 Looking up location...';
    fetch(`https://api.postalpincode.in/pincode/${pin}`)
      .then(r => r.json())
      .then(data => {
        if (data && data[0] && data[0].Status === 'Success' && data[0].PostOffice && data[0].PostOffice.length > 0) {
          const po = data[0].PostOffice[0];
          const cityEl = document.getElementById('addr-city');
          const stateEl = document.getElementById('addr-state');
          if (cityEl) cityEl.value = po.District || po.Name || '';
          if (stateEl) stateEl.value = po.State || '';
          if (hint) hint.textContent = `✅ ${po.Name}, ${po.District}, ${po.State}`;
        } else {
          if (hint) hint.textContent = '❌ PIN not found. Enter city & state manually.';
        }
      })
      .catch(() => {
        if (hint) hint.textContent = '⚠️ Could not fetch. Enter manually.';
      });
  };

  window.custOnlyDigits = function(input, errId) {
    const val = input.value;
    const cleaned = val.replace(/[^0-9]/g, '');
    const errEl = document.getElementById(errId);
    if (val !== cleaned) {
      input.value = cleaned;
      if (errEl) { errEl.style.display = 'block'; clearTimeout(input._t); input._t = setTimeout(() => errEl.style.display = 'none', 2500); }
    } else {
      if (errEl) errEl.style.display = 'none';
    }
  };

  window.custOnlyLetters = function(input, errId) {
    const val = input.value;
    const cleaned = val.replace(/[^a-zA-Z\s\u0900-\u097F\-\.]/g, '');
    const errEl = document.getElementById(errId);
    if (val !== cleaned) {
      input.value = cleaned;
      if (errEl) { errEl.style.display = 'block'; clearTimeout(input._t); input._t = setTimeout(() => errEl.style.display = 'none', 2500); }
    } else {
      if (errEl) errEl.style.display = 'none';
    }
  };

  window.custPinInput = function(input) {
    const val = input.value;
    const cleaned = val.replace(/[^0-9]/g, '');
    const hint = document.getElementById('cust-pin-hint');
    if (val !== cleaned) {
      input.value = cleaned;
      if (hint) { hint.style.color = '#dc2626'; hint.textContent = '⚠️ Only numbers are allowed in PIN Code.'; clearTimeout(input._t); input._t = setTimeout(() => { if(hint && hint.textContent.includes('numbers')) hint.textContent = ''; }, 2500); }
    }
    fetchCustomPin(cleaned);
  };

  window.submitCustomRequest = async function(e) {
    e.preventDefault();
    const phone = document.getElementById('cust-phone').value;
    const house = document.getElementById('addr-house').value;
    const street = document.getElementById('addr-street').value;
    const city = document.getElementById('addr-city').value;
    const state = document.getElementById('addr-state').value;
    const pin = document.getElementById('addr-pin').value;
    const address = `${house}, ${street}, ${city}, ${state} - ${pin}`;
    const text = document.getElementById('custom-text').value;
    const imgObj = document.getElementById('custom-preview-img');
    const imageBase64 = imgObj.src.startsWith('data:image') ? imgObj.src : null;
    const isExpress = document.getElementById('del-express').checked;
    const deliveryCharge = isExpress ? 50 : 0;
    const total = CUSTOM_CHARGE + deliveryCharge;

    const user = Auth.currentUser() || {};
    const order = {
      id: Date.now(),
      customer: {
        name: user.name || '',
        email: user.email || '',
        phone: phone,
        address: address,
        paymentMethod: 'TBD'
      },
      items: [],
      total: total,
      status: 'pending_review',
      previewImage: null,
      customText: text,
      customImage: imageBase64,
      deliveryType: isExpress ? 'Express (3–5 days)' : 'Standard (7–10 days)',
      customizationCharge: CUSTOM_CHARGE,
      deliveryCharge: deliveryCharge,
      date: new Date().toISOString(),
    };

    let res = {};
    try {
        const url = API_PREFIX + 'orders.php?action=placeCustom&t=' + Date.now();
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id: order.id,
                user_id: user.id || null,
                total: order.total,
                phone: phone,
                address: address,
                paymentMethod: 'TBD',
                customText: text,
                customImage: imageBase64,
                email: user.email,
                name: user.name
            })
        });
        res = await response.json();
    } catch (e) {
        console.error("Custom order sync failed:", e);
        res = { error: e.message };
    }

    if (res.error) {
        showFlash('Error submitting custom request: ' + res.error, 'error');
        return;
    }

    document.getElementById('customize-modal').classList.remove('active');
    showFlash('Custom request submitted! Bill: ₹' + total + ' — Check Orders page.');
    setTimeout(() => {
      if (window.location.pathname.includes('orders.html')) window.location.reload();
    }, 1000);
  };

  setTimeout(() => document.getElementById('customize-modal').classList.add('active'), 10);
}

