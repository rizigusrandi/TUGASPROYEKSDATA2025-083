#ifndef KTP_DATA_H
#define KTP_DATA_H

#include "DataModel.h"
#include <cstring>

// Fungsi untuk menginisialisasi 20 data KTP
void initKTPData(KTP*& dataKTP, int& jumlahKTP) {
    jumlahKTP = 20;
    dataKTP = new KTP[jumlahKTP];
    
    // Data KTP 1
    dataKTP[0].NIK = "3374010101950001";
    dataKTP[0].Nama = "Budi Santoso";
    dataKTP[0].TempatLahir = "Jakarta";
    dataKTP[0].TanggalLahir = "01-01-1995";
    dataKTP[0].JenisKelamin = "Laki-laki";
    dataKTP[0].Alamat = "Jl. Merdeka No. 10 RT 001/RW 005";
    dataKTP[0].Agama = "Islam";
    dataKTP[0].StatusPerkawinan = "Belum Kawin";
    dataKTP[0].Pekerjaan = "Karyawan Swasta";
    dataKTP[0].Kewarganegaraan = "WNI";
    
    // Data KTP 2
    dataKTP[1].NIK = "3374020202960002";
    dataKTP[1].Nama = "Siti Nurhaliza";
    dataKTP[1].TempatLahir = "Bandung";
    dataKTP[1].TanggalLahir = "02-02-1996";
    dataKTP[1].JenisKelamin = "Perempuan";
    dataKTP[1].Alamat = "Jl. Sudirman No. 25 RT 002/RW 003";
    dataKTP[1].Agama = "Islam";
    dataKTP[1].StatusPerkawinan = "Kawin";
    dataKTP[1].Pekerjaan = "Wiraswasta";
    dataKTP[1].Kewarganegaraan = "WNI";
    
    // Data KTP 3
    dataKTP[2].NIK = "3374030303970003";
    dataKTP[2].Nama = "Ahmad Rizki";
    dataKTP[2].TempatLahir = "Semarang";
    dataKTP[2].TanggalLahir = "03-03-1997";
    dataKTP[2].JenisKelamin = "Laki-laki";
    dataKTP[2].Alamat = "Jl. Gatot Subroto No. 15 RT 003/RW 004";
    dataKTP[2].Agama = "Islam";
    dataKTP[2].StatusPerkawinan = "Belum Kawin";
    dataKTP[2].Pekerjaan = "Mahasiswa";
    dataKTP[2].Kewarganegaraan = "WNI";
    
    // Data KTP 4
    dataKTP[3].NIK = "3374040404980004";
    dataKTP[3].Nama = "Dewi Lestari";
    dataKTP[3].TempatLahir = "Surabaya";
    dataKTP[3].TanggalLahir = "04-04-1998";
    dataKTP[3].JenisKelamin = "Perempuan";
    dataKTP[3].Alamat = "Jl. Ahmad Yani No. 30 RT 004/RW 002";
    dataKTP[3].Agama = "Kristen";
    dataKTP[3].StatusPerkawinan = "Belum Kawin";
    dataKTP[3].Pekerjaan = "Pegawai Negeri";
    dataKTP[3].Kewarganegaraan = "WNI";
    
    // Data KTP 5
    dataKTP[4].NIK = "3374050505990005";
    dataKTP[4].Nama = "Eko Prasetyo";
    dataKTP[4].TempatLahir = "Yogyakarta";
    dataKTP[4].TanggalLahir = "05-05-1999";
    dataKTP[4].JenisKelamin = "Laki-laki";
    dataKTP[4].Alamat = "Jl. Diponegoro No. 45 RT 005/RW 006";
    dataKTP[4].Agama = "Katolik";
    dataKTP[4].StatusPerkawinan = "Belum Kawin";
    dataKTP[4].Pekerjaan = "Desainer";
    dataKTP[4].Kewarganegaraan = "WNI";
    
    // Data KTP 6
    dataKTP[5].NIK = "3374060606000006";
    dataKTP[5].Nama = "Fitri Handayani";
    dataKTP[5].TempatLahir = "Medan";
    dataKTP[5].TanggalLahir = "06-06-2000";
    dataKTP[5].JenisKelamin = "Perempuan";
    dataKTP[5].Alamat = "Jl. Pahlawan No. 20 RT 006/RW 001";
    dataKTP[5].Agama = "Islam";
    dataKTP[5].StatusPerkawinan = "Belum Kawin";
    dataKTP[5].Pekerjaan = "Guru";
    dataKTP[5].Kewarganegaraan = "WNI";
    
    // Data KTP 7
    dataKTP[6].NIK = "3374070707010007";
    dataKTP[6].Nama = "Gilang Ramadhan";
    dataKTP[6].TempatLahir = "Malang";
    dataKTP[6].TanggalLahir = "07-07-2001";
    dataKTP[6].JenisKelamin = "Laki-laki";
    dataKTP[6].Alamat = "Jl. Veteran No. 35 RT 007/RW 008";
    dataKTP[6].Agama = "Islam";
    dataKTP[6].StatusPerkawinan = "Belum Kawin";
    dataKTP[6].Pekerjaan = "Programmer";
    dataKTP[6].Kewarganegaraan = "WNI";
    
    // Data KTP 8
    dataKTP[7].NIK = "3374080808020008";
    dataKTP[7].Nama = "Hana Kartika";
    dataKTP[7].TempatLahir = "Palembang";
    dataKTP[7].TanggalLahir = "08-08-2002";
    dataKTP[7].JenisKelamin = "Perempuan";
    dataKTP[7].Alamat = "Jl. Pemuda No. 50 RT 008/RW 007";
    dataKTP[7].Agama = "Budha";
    dataKTP[7].StatusPerkawinan = "Belum Kawin";
    dataKTP[7].Pekerjaan = "Marketing";
    dataKTP[7].Kewarganegaraan = "WNI";
    
    // Data KTP 9
    dataKTP[8].NIK = "3374090909950009";
    dataKTP[8].Nama = "Irfan Hakim";
    dataKTP[8].TempatLahir = "Bogor";
    dataKTP[8].TanggalLahir = "09-09-1995";
    dataKTP[8].JenisKelamin = "Laki-laki";
    dataKTP[8].Alamat = "Jl. Kenangan No. 12 RT 009/RW 005";
    dataKTP[8].Agama = "Islam";
    dataKTP[8].StatusPerkawinan = "Kawin";
    dataKTP[8].Pekerjaan = "Arsitek";
    dataKTP[8].Kewarganegaraan = "WNI";
    
    // Data KTP 10
    dataKTP[9].NIK = "3374101010960010";
    dataKTP[9].Nama = "Jasmine Putri";
    dataKTP[9].TempatLahir = "Bekasi";
    dataKTP[9].TanggalLahir = "10-10-1996";
    dataKTP[9].JenisKelamin = "Perempuan";
    dataKTP[9].Alamat = "Jl. Harmoni No. 22 RT 010/RW 003";
    dataKTP[9].Agama = "Kristen";
    dataKTP[9].StatusPerkawinan = "Belum Kawin";
    dataKTP[9].Pekerjaan = "Dokter";
    dataKTP[9].Kewarganegaraan = "WNI";
    
    // Data KTP 11
    dataKTP[10].NIK = "3374111111970011";
    dataKTP[10].Nama = "Kevin Ananda";
    dataKTP[10].TempatLahir = "Tangerang";
    dataKTP[10].TanggalLahir = "11-11-1997";
    dataKTP[10].JenisKelamin = "Laki-laki";
    dataKTP[10].Alamat = "Jl. Cendana No. 8 RT 011/RW 009";
    dataKTP[10].Agama = "Katolik";
    dataKTP[10].StatusPerkawinan = "Belum Kawin";
    dataKTP[10].Pekerjaan = "Pengacara";
    dataKTP[10].Kewarganegaraan = "WNI";
    
    // Data KTP 12
    dataKTP[11].NIK = "3374121212980012";
    dataKTP[11].Nama = "Linda Wijaya";
    dataKTP[11].TempatLahir = "Depok";
    dataKTP[11].TanggalLahir = "12-12-1998";
    dataKTP[11].JenisKelamin = "Perempuan";
    dataKTP[11].Alamat = "Jl. Melati No. 18 RT 012/RW 002";
    dataKTP[11].Agama = "Islam";
    dataKTP[11].StatusPerkawinan = "Kawin";
    dataKTP[11].Pekerjaan = "Akuntan";
    dataKTP[11].Kewarganegaraan = "WNI";
    
    // Data KTP 13
    dataKTP[12].NIK = "3374010101990013";
    dataKTP[12].Nama = "Mario Teguh";
    dataKTP[12].TempatLahir = "Jakarta";
    dataKTP[12].TanggalLahir = "13-01-1999";
    dataKTP[12].JenisKelamin = "Laki-laki";
    dataKTP[12].Alamat = "Jl. Mawar No. 40 RT 013/RW 004";
    dataKTP[12].Agama = "Kristen";
    dataKTP[12].StatusPerkawinan = "Belum Kawin";
    dataKTP[12].Pekerjaan = "Konsultan";
    dataKTP[12].Kewarganegaraan = "WNI";
    
    // Data KTP 14
    dataKTP[13].NIK = "3374020202000014";
    dataKTP[13].Nama = "Nina Septiani";
    dataKTP[13].TempatLahir = "Bandung";
    dataKTP[13].TanggalLahir = "14-02-2000";
    dataKTP[13].JenisKelamin = "Perempuan";
    dataKTP[13].Alamat = "Jl. Anggrek No. 55 RT 014/RW 006";
    dataKTP[13].Agama = "Islam";
    dataKTP[13].StatusPerkawinan = "Belum Kawin";
    dataKTP[13].Pekerjaan = "Chef";
    dataKTP[13].Kewarganegaraan = "WNI";
    
    // Data KTP 15
    dataKTP[14].NIK = "3374030303010015";
    dataKTP[14].Nama = "Oscar Lawalata";
    dataKTP[14].TempatLahir = "Semarang";
    dataKTP[14].TanggalLahir = "15-03-2001";
    dataKTP[14].JenisKelamin = "Laki-laki";
    dataKTP[14].Alamat = "Jl. Flamboyan No. 33 RT 015/RW 008";
    dataKTP[14].Agama = "Katolik";
    dataKTP[14].StatusPerkawinan = "Belum Kawin";
    dataKTP[14].Pekerjaan = "Fashion Designer";
    dataKTP[14].Kewarganegaraan = "WNI";
    
    // Data KTP 16
    dataKTP[15].NIK = "3374040404950016";
    dataKTP[15].Nama = "Prilly Latuconsina";
    dataKTP[15].TempatLahir = "Surabaya";
    dataKTP[15].TanggalLahir = "16-04-1995";
    dataKTP[15].JenisKelamin = "Perempuan";
    dataKTP[15].Alamat = "Jl. Kenari No. 27 RT 016/RW 001";
    dataKTP[15].Agama = "Islam";
    dataKTP[15].StatusPerkawinan = "Belum Kawin";
    dataKTP[15].Pekerjaan = "Artis";
    dataKTP[15].Kewarganegaraan = "WNI";
    
    // Data KTP 17
    dataKTP[16].NIK = "3374050505960017";
    dataKTP[16].Nama = "Qomar Zaman";
    dataKTP[16].TempatLahir = "Yogyakarta";
    dataKTP[16].TanggalLahir = "17-05-1996";
    dataKTP[16].JenisKelamin = "Laki-laki";
    dataKTP[16].Alamat = "Jl. Sakura No. 19 RT 017/RW 007";
    dataKTP[16].Agama = "Islam";
    dataKTP[16].StatusPerkawinan = "Kawin";
    dataKTP[16].Pekerjaan = "Pilot";
    dataKTP[16].Kewarganegaraan = "WNI";
    
    // Data KTP 18
    dataKTP[17].NIK = "3374060606970018";
    dataKTP[17].Nama = "Rina Nose";
    dataKTP[17].TempatLahir = "Medan";
    dataKTP[17].TanggalLahir = "18-06-1997";
    dataKTP[17].JenisKelamin = "Perempuan";
    dataKTP[17].Alamat = "Jl. Dahlia No. 42 RT 018/RW 005";
    dataKTP[17].Agama = "Islam";
    dataKTP[17].StatusPerkawinan = "Belum Kawin";
    dataKTP[17].Pekerjaan = "Komedian";
    dataKTP[17].Kewarganegaraan = "WNI";
    
    // Data KTP 19
    dataKTP[18].NIK = "3374070707980019";
    dataKTP[18].Nama = "Samuel Zylgwyn";
    dataKTP[18].TempatLahir = "Malang";
    dataKTP[18].TanggalLahir = "19-07-1998";
    dataKTP[18].JenisKelamin = "Laki-laki";
    dataKTP[18].Alamat = "Jl. Tulip No. 36 RT 019/RW 003";
    dataKTP[18].Agama = "Kristen";
    dataKTP[18].StatusPerkawinan = "Belum Kawin";
    dataKTP[18].Pekerjaan = "Aktor";
    dataKTP[18].Kewarganegaraan = "WNI";
    
    // Data KTP 20
    dataKTP[19].NIK = "3374080808990020";
    dataKTP[19].Nama = "Tasya Kamila";
    dataKTP[19].TempatLahir = "Palembang";
    dataKTP[19].TanggalLahir = "20-08-1999";
    dataKTP[19].JenisKelamin = "Perempuan";
    dataKTP[19].Alamat = "Jl. Lily No. 14 RT 020/RW 002";
    dataKTP[19].Agama = "Islam";
    dataKTP[19].StatusPerkawinan = "Kawin";
    dataKTP[19].Pekerjaan = "Penyanyi";
    dataKTP[19].Kewarganegaraan = "WNI";
}

#endif
