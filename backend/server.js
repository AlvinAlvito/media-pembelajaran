require('dotenv').config(); 
const express = require("express");
const cors = require("cors");
const http = require("http");
const session = require("express-session");
const authRoutes = require("./routes/auth");
const adminRoutes = require("./routes/adminRoutes");
const publicRoutes = require("./routes/publicRoutes");

const app = express();
const server = http.createServer(app);

// Middleware global
app.use(cors({
  origin: true,
  credentials: true // penting untuk session antar frontend-backend
}));
app.use(express.json());

// ✅ Session middleware
app.use(session({
  secret: process.env.SESSION_SECRET || "rahasia_sesi", // bisa disimpan di .env
  resave: false,
  saveUninitialized: false,
  cookie: {
    secure: false, // kalau HTTPS => true
    httpOnly: true,
    maxAge: 24 * 60 * 60 * 1000 // 1 hari
  }
}));

// ✅ Middleware anti-cache
app.use((req, res, next) => {
  res.set('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate');
  res.set('Pragma', 'no-cache');
  res.set('Expires', '0');
  next();
});

// ✅ Route binding
app.use("/api/auth", authRoutes);
app.use("/api", publicRoutes);
app.use("/api", adminRoutes);

// ✅ Start server
const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
  console.log(`🚀 Server running on http://localhost:${PORT}`);
});
