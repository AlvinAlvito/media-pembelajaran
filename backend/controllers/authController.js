const db = require("../db");
const bcrypt = require("bcrypt");

// Registrasi admin baru (optional, hanya untuk setup awal)
exports.register = async (req, res) => {
  try {
    const { username, password } = req.body;

    // Cek apakah username sudah ada
    const [exist] = await db.execute("SELECT * FROM admin WHERE username = ?", [username]);
    if (exist.length > 0) {
      return res.status(400).json({ message: "Username already exists" });
    }

    // Hash password
    const hashedPassword = await bcrypt.hash(password, 10);

    // Simpan ke DB
    await db.execute("INSERT INTO admin (username, password) VALUES (?, ?)", [username, hashedPassword]);

    res.json({ message: "Registrasi berhasil" });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

// Login admin
exports.login = async (req, res) => {
  try {
    const { username, password } = req.body;

    // Cari user
    const [rows] = await db.execute("SELECT * FROM admin WHERE username = ?", [username]);
    if (rows.length === 0) {
      return res.status(401).json({ message: "Username salah" });
    }

    const user = rows[0];

    // Cek password
    const match = await bcrypt.compare(password, user.password);
    if (!match) {
      return res.status(401).json({ message: "Password salah" });
    }

    // Simpan sesi
    req.session.isAdmin = true;
    req.session.username = user.username;

    res.json({ message: "Login berhasil" });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

// Logout
exports.logout = (req, res) => {
  req.session.destroy();
  res.json({ message: "Logout berhasil" });
};

// Middleware proteksi untuk route admin
exports.requireAdmin = (req, res, next) => {
  if (req.session.isAdmin) {
    next();
  } else {
    res.status(403).json({ message: "Unauthorized" });
  }
};
