const db = require("../db");

// Ambil semua materi
exports.getAllMateri = async (req, res) => {
  try {
    const [rows] = await db.execute("SELECT id, judul, gambar, LEFT(isi, 100) AS ringkasan FROM materi ORDER BY created_at DESC");
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

// Ambil detail materi + soal
exports.getMateriDetail = async (req, res) => {
  try {
    const materiId = req.params.id;

    // Detail materi
    const [materi] = await db.execute("SELECT * FROM materi WHERE id = ?", [materiId]);
    if (materi.length === 0) return res.status(404).json({ message: "Materi tidak ditemukan" });

    // Ambil soalnya
    const [soal] = await db.execute(
      "SELECT id, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, pilihan_e FROM soal WHERE materi_id = ?",
      [materiId]
    );

    res.json({ materi: materi[0], soal });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

// Simpan hasil kuis siswa
exports.submitJawaban = async (req, res) => {
  try {
    const { nama_siswa, materi_id, jawaban } = req.body;
    // jawaban = [{ soal_id: 1, jawaban: 'B' }, ...]

    let benar = 0;

    for (const item of jawaban) {
      const [soal] = await db.execute("SELECT jawaban_benar FROM soal WHERE id = ?", [item.soal_id]);
      if (soal.length && soal[0].jawaban_benar === item.jawaban.toUpperCase()) {
        benar++;
      }
    }

    const total = jawaban.length;
    const nilai = total === 0 ? 0 : Math.round((benar / total) * 100);

    // Simpan ke sesi_jawab
    const [result] = await db.execute(
      "INSERT INTO sesi_jawab (nama_siswa, materi_id, jumlah_benar, total_soal, nilai) VALUES (?, ?, ?, ?, ?)",
      [nama_siswa, materi_id, benar, total, nilai]
    );

    res.json({
      message: "Jawaban disimpan",
      sesi_id: result.insertId,
      jumlah_benar: benar,
      total_soal: total,
      nilai
    });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};
