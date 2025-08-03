const express = require("express");
const router = express.Router();
const publicController = require("../controllers/publicController");

// Halaman daftar materi
router.get("/materi", publicController.getAllMateri);

// Halaman detail materi + soal
router.get("/materi/:id", publicController.getMateriDetail);

// Kirim hasil kuis
router.post("/kuis", publicController.submitJawaban);

module.exports = router;
