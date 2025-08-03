import {
    Table,
    TableBody,
    TableCell,
    TableHeader,
    TableRow,
} from "../ui/table";
import Badge from "../ui/badge/Badge";
import { useEffect, useState } from "react";
import Button from "../ui/button/Button";
import { Download } from "lucide-react";
import jsPDF from "jspdf";
import autoTable from "jspdf-autotable";
import { baseUrl } from "../../lib/api";
import { Link } from "react-router";

type RiwayatItem = {
    mahasiswa_id: string;
    mahasiswa_name: string;
    mahasiswa_nim: string;
    mahasiswa_foto: string | null;
    mahasiswa_prodi: string;
    mahasiswa_stambuk: string;

    dosen_id: string;
    dosen_name: string;
    dosen_nip: string;
    dosen_foto: string | null;
    dosen_prodi: string;

    waktu_pendaftaran: string;
    status: string;
    tujuan: string;
    alasan: string;
};

export default function RiwayatAntrian() {
    const [data, setData] = useState<RiwayatItem[]>([]);
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 10;

    useEffect(() => {
        const fetchData = async () => {
            try {
                const res = await fetch(`${baseUrl}/api/recent-antrian`);
                const json = await res.json();
                setData(json);
                setCurrentPage(1);
            } catch (error) {
                console.error("Gagal memuat data:", error);
            }
        };

        fetchData();
    }, []);

    const downloadPdf = (data: RiwayatItem[]) => {
        const doc = new jsPDF();
        const title = "Riwayat Bimbingan Akademik Keseluruhan";

        // Judul
        doc.setFontSize(14);
        const pageWidth = doc.internal.pageSize.getWidth();
        const textWidth = doc.getTextWidth(title);
        const centerX = (pageWidth - textWidth) / 2;
        doc.text(title, centerX, 20);

        // Informasi dosen
        doc.setFontSize(10);
        if (data.length > 0) {
            const { dosen_name, dosen_nip } = data[0];
            doc.text(`Nama Dosen: ${dosen_name}`, 14, 28);
            doc.text(`NIP: ${dosen_nip}`, 14, 34);
        }

        // Tanggal Unduh
        const tanggalDownload = new Date().toLocaleDateString("id-ID", {
            day: "numeric",
            month: "long",
            year: "numeric",
        });
        doc.text(`Tanggal Unduh: ${tanggalDownload}`, 14, 40);

        // Kolom tabel
        const tableColumn = [
            "Nama Mahasiswa",
            "NIM",
            "Prodi",
            "Tanggal Bimbingan",
            "Waktu Bimbingan",
            "Tujuan",
            "Status",
        ];

        // Baris tabel
        const tableRows = data.map((item) => [
            item.mahasiswa_name,
            item.mahasiswa_nim,
            item.mahasiswa_prodi,
            new Date(item.waktu_pendaftaran).toLocaleDateString("id-ID", {
                day: "numeric",
                month: "long",
                year: "numeric",
            }),
            new Date(item.waktu_pendaftaran).toLocaleTimeString("id-ID", {
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: false,
            }) + " WIB",
            item.tujuan + (item.alasan ? `. ${item.alasan}` : ""),
            item.status,
        ]);

        // Generate tabel PDF
        autoTable(doc, {
            head: [tableColumn],
            body: tableRows,
            startY: 46,
        });

        // Simpan file
        doc.save("Riwayat_Bimbingan_Akademik.pdf");
    };

    const toTitleCase = (str: string | undefined): string => {
        if (!str) return "";
        return str
            .toLowerCase()
            .split(" ")
            .map((w: string) => w.charAt(0).toUpperCase() + w.slice(1))
            .join(" ");
    };

    const totalPages = Math.ceil(data.length / itemsPerPage);
    const startIndex = (currentPage - 1) * itemsPerPage;
    const paginatedData = data.slice(startIndex, startIndex + itemsPerPage);

    const handlePageChange = (page: number) => {
        if (page < 1 || page > totalPages) return;
        setCurrentPage(page);
    };

    return (
        <div className="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
            <div className="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
                <h3 className="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Record Bimbingan Akademik Terbaru
                </h3>
                <div className="flex items-center gap-3">
                    <Button
                        size="sm"
                        variant="outline"
                        className="w-full flex items-center gap-2 justify-center"
                        onClick={() => downloadPdf(data)}
                    >
                        <Download size={16} />
                        Unduh
                    </Button>
                </div>
            </div>

            <div className="max-w-full overflow-x-auto">
                <Table>
                    <TableHeader className="border-gray-100 dark:border-gray-800 border-y">
                        <TableRow>
                            <TableCell isHeader className="py-3 font-medium text-gray-500 text-start text-theme-xs dark:text-gray-400">
                                Mahasiswa
                            </TableCell>
                            <TableCell isHeader className="py-3 font-medium text-gray-500 text-start text-theme-xs dark:text-gray-400">
                                Dosen
                            </TableCell>
                            <TableCell isHeader className="py-3 font-medium text-gray-500 text-start text-theme-xs dark:text-gray-400">
                                Tanggal Bimbingan
                            </TableCell>
                            <TableCell isHeader className="py-3 font-medium text-gray-500 text-start text-theme-xs dark:text-gray-400">
                                Waktu Bimbingan
                            </TableCell>
                            <TableCell isHeader className="py-3 font-medium text-gray-500 text-start text-theme-xs dark:text-gray-400">
                                Tujuan Bimbingan
                            </TableCell>
                            <TableCell isHeader className="py-3 font-medium text-gray-500 text-start text-theme-xs dark:text-gray-400">
                                Status
                            </TableCell>
                        </TableRow>
                    </TableHeader>

                    <TableBody className="divide-y divide-gray-100 dark:divide-gray-800">
                        {paginatedData.map((item, index) => (
                            <TableRow key={index}>
                                {/* MAHASISWA */}
                                <TableCell className="py-3">
                                    <Link to={`/admin/daftar-prodi/profil/mahasiswa/${item.mahasiswa_id}`}>
                                        <a className="flex items-center gap-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-white/5 p-2 rounded-md transition">
                                            <div className="h-[50px] w-[50px] overflow-hidden rounded-md">
                                                <img
                                                    src={
                                                        item.mahasiswa_foto
                                                            ? `https://pmb.uinsu.ac.id/file/photo/${item.mahasiswa_foto}`
                                                            : "/images/user/owner.jpg"
                                                    }
                                                    alt={item.mahasiswa_name || "Mahasiswa"}
                                                    className="h-[50px] w-[50px] object-cover"
                                                />
                                            </div>
                                            <div>
                                                <p className="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                    {toTitleCase(item.mahasiswa_name)}
                                                </p>
                                                <span className="text-gray-500 text-theme-xs dark:text-gray-400">
                                                    {item.mahasiswa_nim} | {toTitleCase(item.mahasiswa_prodi)} ({item.mahasiswa_stambuk})
                                                </span>
                                            </div>
                                        </a>
                                    </Link>
                                </TableCell>

                                {/* DOSEN */}
                                <TableCell className="py-3">
                                    <Link
                                        to={`/admin/daftar-prodi/profil/dosen/${item.dosen_id}`}
                                        className="flex items-center gap-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-white/5 p-2 rounded-md transition"
                                    >
                                        <div className="h-[50px] w-[50px] overflow-hidden rounded-md">
                                            <img
                                                src={item.dosen_foto ? item.dosen_foto : "/images/user/owner.jpg"}
                                                alt={item.dosen_name || "Dosen"}
                                                className="h-[50px] w-[50px] object-cover"
                                            />
                                        </div>
                                        <div>
                                            <p className="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                {toTitleCase(item.dosen_name)}
                                            </p>
                                            <span className="text-gray-500 text-theme-xs dark:text-gray-400">
                                                {item.dosen_nip} | {toTitleCase(item.dosen_prodi)}
                                            </span>
                                        </div>
                                    </Link>
                                </TableCell>

                                {/* TANGGAL */}
                                <TableCell className="py-3 text-gray-500 text-theme-sm dark:text-gray-400">
                                    {item.waktu_pendaftaran
                                        ? new Date(item.waktu_pendaftaran).toLocaleDateString("id-ID", {
                                            day: "numeric",
                                            month: "long",
                                            year: "numeric",
                                        })
                                        : "-"}
                                </TableCell>

                                {/* WAKTU */}
                                <TableCell className="py-3 text-gray-500 text-theme-sm dark:text-gray-400">
                                    {item.waktu_pendaftaran
                                        ? new Date(item.waktu_pendaftaran).toLocaleTimeString("id-ID", {
                                            hour: "2-digit",
                                            minute: "2-digit",
                                            second: "2-digit",
                                        })
                                        : "-"} WIB
                                </TableCell>

                                {/* TUJUAN */}
                                <TableCell className="py-3 text-gray-500 text-theme-sm dark:text-gray-400">
                                    {item.tujuan}
                                    {item.alasan && `, ${item.alasan}`}
                                </TableCell>

                                {/* STATUS */}
                                <TableCell className="py-3 text-gray-500 text-theme-sm dark:text-gray-400">
                                    <Badge
                                        size="sm"
                                        color={
                                            item.status === "selesai"
                                                ? "success"
                                                : item.status === "menunggu"
                                                    ? "warning"
                                                    : item.status === "dibatalkan"
                                                        ? "error"
                                                        : "primary"
                                        }
                                    >
                                        {item.status}
                                    </Badge>
                                </TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </div>

            {/* PAGINATION */}
            <div className="flex justify-center mt-6 gap-2">
                <button
                    onClick={() => handlePageChange(currentPage - 1)}
                    disabled={currentPage === 1}
                    className="px-3 py-1 rounded border border-gray-300 dark:border-gray-700 disabled:opacity-50 dark:text-gray-200"
                >
                    Prev
                </button>

                {[...Array(totalPages)].map((_, idx) => {
                    const pageNum = idx + 1;
                    return (
                        <button
                            key={pageNum}
                            onClick={() => handlePageChange(pageNum)}
                            className={`px-3 py-1 rounded border ${pageNum === currentPage
                                ? "bg-green-600 text-white border-green-600 dark:text-gray-200"
                                : "border-gray-300 dark:border-gray-700"
                                }`}
                        >
                            {pageNum}
                        </button>
                    );
                })}

                <button
                    onClick={() => handlePageChange(currentPage + 1)}
                    disabled={currentPage === totalPages}
                    className="px-3 py-1 rounded border border-gray-300 dark:border-gray-700 disabled:opacity-50 dark:text-gray-200"
                >
                    Next
                </button>
            </div>
        </div>
    );

}
