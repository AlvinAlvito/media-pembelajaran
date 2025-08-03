const db = require("../db");

// ----------------------------
// MATERI
// ----------------------------
exports.getAllMateri = async (req, res) => {
  try {
    const [rows] = await db.execute("SELECT * FROM materi ORDER BY created_at DESC");
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

exports.getMateriById = async (req, res) => {
  try {
    const [rows] = await db.execute("SELECT * FROM materi WHERE id = ?", [req.params.id]);
    if (rows.length === 0) return res.status(404).json({ message: "Materi not found" });
    res.json(rows[0]);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

exports.createMateri = async (req, res) => {
  try {
    const { judul, gambar, isi, link_video } = req.body;
    const [result] = await db.execute(
      "INSERT INTO materi (judul, gambar, isi, link_video) VALUES (?, ?, ?, ?)",
      [judul, gambar, isi, link_video]
    );
    res.json({ id: result.insertId, message: "Materi created" });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

exports.updateMateri = async (req, res) => {
  try {
    const { judul, gambar, isi, link_video } = req.body;
    const [result] = await db.execute(
      "UPDATE materi SET judul = ?, gambar = ?, isi = ?, link_video = ? WHERE id = ?",
      [judul, gambar, isi, link_video, req.params.id]
    );
    res.json({ message: "Materi updated" });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

exports.deleteMateri = async (req, res) => {
  try {
    await db.execute("DELETE FROM materi WHERE id = ?", [req.params.id]);
    res.json({ message: "Materi deleted" });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

// ----------------------------
// SOAL
// ----------------------------
exports.getSoalByMateri = async (req, res) => {
  try {
    const [rows] = await db.execute("SELECT * FROM soal WHERE materi_id = ?", [req.params.materiId]);
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

exports.createSoal = async (req, res) => {
  try {
    const { materi_id, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, pilihan_e, jawaban_benar } = req.body;
    const [result] = await db.execute(
      `INSERT INTO soal 
       (materi_id, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, pilihan_e, jawaban_benar)
       VALUES (?, ?, ?, ?, ?, ?, ?, ?)`,
      [materi_id, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, pilihan_e, jawaban_benar]
    );
    res.json({ id: result.insertId, message: "Soal created" });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

exports.deleteSoal = async (req, res) => {
  try {
    await db.execute("DELETE FROM soal WHERE id = ?", [req.params.id]);
    res.json({ message: "Soal deleted" });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};
