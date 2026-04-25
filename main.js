const express = require('express')
const path = require('path')
const app = express()
const port = 3000

// Serve static files from root
app.use(express.static(path.join(__dirname)))

// Routes for pages
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'))
})

app.get('/about', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'about.html'))
})

app.get('/admin-orders', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'admin-orders.html'))
})

app.get('/admin-products', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'admin-products.html'))
})

app.get('/admin-queries', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'admin-queries.html'))
})

app.get('/cart', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'cart.html'))
})

app.get('/contact', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'contact.html'))
})

app.get('/login', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'login.html'))
})

app.get('/orders', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'orders.html'))
})

app.get('/product-detail', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'product-detail.html'))
})

app.get('/products', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'products.html'))
})

app.get('/signup', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'signup.html'))
})

app.get('/wishlist', (req, res) => {
  res.sendFile(path.join(__dirname, 'pages', 'wishlist.html'))
})

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`)
})
