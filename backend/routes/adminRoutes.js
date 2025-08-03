const express = require("express");
const router = express.Router();
const admin = require("../controllers/adminController");

// Materi Routes
router.get("/admin/materi", admin.getAllMateri);
router.get("/admin/materi/:id", admin.getMateriById);
router.post("/admin/materi", admin.createMateri);
router.put("/admin/materi/:id", admin.updateMateri);
router.delete("/admin/materi/:id", admin.deleteMateri);

// Soal Routes
router.get("/admin/soal/:materiId", admin.getSoalByMateri);
router.post("/admin/soal", admin.createSoal);
router.delete("/admin/soal/:id", admin.deleteSoal);

module.exports = router;
