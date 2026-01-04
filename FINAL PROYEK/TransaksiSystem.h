#ifndef TRANSAKSISYSTEM_H
#define TRANSAKSISYSTEM_H

#include "DataModel.h"
#include "DoubleLinkedList.h"
#include <iostream>
#include <iomanip>
#include <fstream>
#include <ctime>
#include <sstream>

using namespace std;

// Class untuk manajemen ukuran
class UkuranManager {
private:
    Ukuran ukuranList[5];
    int jumlahUkuran;
    
public:
    UkuranManager() {
        jumlahUkuran = 5;
        ukuranList[0].nama = "S";
        ukuranList[0].hargaTambahan = 0;
        ukuranList[1].nama = "M";
        ukuranList[1].hargaTambahan = 0;
        ukuranList[2].nama = "L";
        ukuranList[2].hargaTambahan = 0;
        ukuranList[3].nama = "XL";
        ukuranList[3].hargaTambahan = 2000;
        ukuranList[4].nama = "XXL";
        ukuranList[4].hargaTambahan = 3000;
    }
    
    void tampilkanMenu() {
        cout << "\n+--------------------------------+\n";
        cout << "|      PILIH UKURAN PRODUK       |\n";
        cout << "+--------------------------------+\n";
        for (int i = 0; i < jumlahUkuran; i++) {
            cout << "| [" << (i+1) << "] " << left << setw(5) << ukuranList[i].nama;
            if (ukuranList[i].hargaTambahan > 0) {
                cout << " (+Rp " << fixed << setprecision(0) << ukuranList[i].hargaTambahan << ")";
            } else {
                cout << " (Normal)";
            }
            cout << endl;
        }
        cout << "+--------------------------------+\n";
    }
    
    Ukuran getUkuran(int index) {
        if (index >= 0 && index < jumlahUkuran) {
            return ukuranList[index];
        }
        return ukuranList[0]; // Default S
    }
    
    double getHargaTambahan(string ukuran) {
        for (int i = 0; i < jumlahUkuran; i++) {
            if (ukuranList[i].nama == ukuran) {
                return ukuranList[i].hargaTambahan;
            }
        }
        return 0;
    }
};

// Struktur untuk item dalam keranjang
struct ItemKeranjang {
    Produk* produk;
    string ukuran;
    int jumlah;
    double subtotal;
};

class TransaksiSystem {
private:
    ItemKeranjang* keranjang;
    int kapasitasKeranjang;
    int jumlahItem;
    KTP pembeli;
    int nomorTransaksi;
    UkuranManager ukuranMgr;
    
    // Generate nomor transaksi unik
    string generateNomorTransaksi() {
        time_t now = time(0);
        tm* ltm = localtime(&now);
        
        stringstream ss;
        ss << "TRX";
        ss << (1900 + ltm->tm_year);
        ss << setfill('0') << setw(2) << (1 + ltm->tm_mon);
        ss << setfill('0') << setw(2) << ltm->tm_mday;
        ss << setfill('0') << setw(4) << (++nomorTransaksi);
        
        return ss.str();
    }
    
    // Generate timestamp
    string getCurrentTimestamp() {
        time_t now = time(0);
        tm* ltm = localtime(&now);
        
        stringstream ss;
        ss << setfill('0') << setw(2) << ltm->tm_mday << "-";
        ss << setfill('0') << setw(2) << (1 + ltm->tm_mon) << "-";
        ss << (1900 + ltm->tm_year) << " ";
        ss << setfill('0') << setw(2) << ltm->tm_hour << ":";
        ss << setfill('0') << setw(2) << ltm->tm_min << ":";
        ss << setfill('0') << setw(2) << ltm->tm_sec;
        
        return ss.str();
    }

public:
    TransaksiSystem(KTP user) : pembeli(user), nomorTransaksi(1000) {
        kapasitasKeranjang = 50;
        jumlahItem = 0;
        keranjang = new ItemKeranjang[kapasitasKeranjang];
    }
    
    // Tambah produk ke keranjang dengan ukuran
    bool tambahKeKeranjang(Produk* produk, int jumlah) {
        if (produk == NULL) {
            cout << "\n[!] Produk tidak valid!\n";
            return false;
        }
        
        if (produk->Stok < jumlah) {
            cout << "\n[!] Stok tidak mencukupi!\n";
            cout << "[i] Stok tersedia: " << produk->Stok << "\n";
            return false;
        }
        
        // Tampilkan menu ukuran
        ukuranMgr.tampilkanMenu();
        cout << "\nPilih ukuran (1-5): ";
        int pilihanUkuran;
        cin >> pilihanUkuran;
        
        if (pilihanUkuran < 1 || pilihanUkuran > 5) {
            cout << "\n[!] Pilihan ukuran tidak valid!\n";
            return false;
        }
        
        Ukuran ukuranDipilih = ukuranMgr.getUkuran(pilihanUkuran - 1);
        
        // Cek apakah produk dengan ukuran yang sama sudah ada di keranjang
        for (int i = 0; i < jumlahItem; i++) {
            if (keranjang[i].produk->ID == produk->ID && 
                keranjang[i].ukuran == ukuranDipilih.nama) {
                int totalJumlah = keranjang[i].jumlah + jumlah;
                if (produk->Stok < totalJumlah) {
                    cout << "\n[!] Total jumlah melebihi stok tersedia!\n";
                    return false;
                }
                keranjang[i].jumlah = totalJumlah;
                keranjang[i].subtotal = (produk->Harga + ukuranDipilih.hargaTambahan) * totalJumlah;
                cout << "\n[?] Jumlah produk di keranjang diperbarui!\n";
                return true;
            }
        }
        
        // Tambah item baru
        if (jumlahItem >= kapasitasKeranjang) {
            cout << "\n[!] Keranjang penuh!\n";
            return false;
        }
        
        keranjang[jumlahItem].produk = produk;
        keranjang[jumlahItem].ukuran = ukuranDipilih.nama;
        keranjang[jumlahItem].jumlah = jumlah;
        keranjang[jumlahItem].subtotal = (produk->Harga + ukuranDipilih.hargaTambahan) * jumlah;
        jumlahItem++;
        
        cout << "\n[?] Produk berhasil ditambahkan ke keranjang!\n";
        cout << "[i] Ukuran: " << ukuranDipilih.nama;
        if (ukuranDipilih.hargaTambahan > 0) {
            cout << " (+Rp " << fixed << setprecision(0) << ukuranDipilih.hargaTambahan << ")";
        }
        cout << "\n[i] Harga per item: Rp " << (produk->Harga + ukuranDipilih.hargaTambahan) << "\n";
        
        return true;
    }
    
    // Hapus item dari keranjang
    bool hapusDariKeranjang(int index) {
        if (index < 0 || index >= jumlahItem) {
            cout << "\n[!] Index tidak valid!\n";
            return false;
        }
        
        for (int i = index; i < jumlahItem - 1; i++) {
            keranjang[i] = keranjang[i + 1];
        }
        jumlahItem--;
        
        cout << "\n[?] Item berhasil dihapus dari keranjang!\n";
        return true;
    }
    
    // Tampilkan keranjang
    void tampilkanKeranjang() {
        if (jumlahItem == 0) {
            cout << "\n[!] Keranjang kosong!\n";
            return;
        }
        
        cout << "\n+-----------------------------------------------------------------------------------------+\n";
        cout << "| No | ID   | Nama Produk            | Ukuran | Harga      | Qty | Subtotal       |\n";
        cout << "|----+------+------------------------+--------+------------+-----+----------------|\n";
        
        double total = 0;
        for (int i = 0; i < jumlahItem; i++) {
            double hargaTambahan = ukuranMgr.getHargaTambahan(keranjang[i].ukuran);
            double hargaPerItem = keranjang[i].produk->Harga + hargaTambahan;
            
            cout << "| " << left << setw(2) << (i + 1) << " | ";
            cout << setw(4) << keranjang[i].produk->ID << " | ";
            cout << setw(22) << keranjang[i].produk->Nama.substr(0, 22) << " | ";
            cout << setw(6) << keranjang[i].ukuran << " | Rp ";
            cout << setw(8) << fixed << setprecision(0) << hargaPerItem << " | ";
            cout << setw(3) << keranjang[i].jumlah << " | Rp ";
            cout << setw(12) << keranjang[i].subtotal << " |\n";
            total += keranjang[i].subtotal;
        }
        
        cout << "+-----------------------------------------------------------------------------------------+\n";
        cout << "| TOTAL PEMBAYARAN:" << right << setw(70) << "Rp " << setw(12) << total << " |\n";
        cout << "+-----------------------------------------------------------------------------------------+\n";
    }
    
    // Hitung total belanja
    double hitungTotal() {
        double total = 0;
        for (int i = 0; i < jumlahItem; i++) {
            total += keranjang[i].subtotal;
        }
        return total;
    }
    
    // Proses checkout dan cetak struk dengan auto-save
    bool checkout(DoublyLinkedList& katalog, LaporanTransaksi& laporan) {
        if (jumlahItem == 0) {
            cout << "\n[!] Keranjang kosong! Tidak ada yang dibeli.\n";
            return false;
        }
        
        system("cls");
        cout << "\n+---------------------------------------------------------------+\n";
        cout << "|                    KONFIRMASI PEMBAYARAN                      |\n";
        cout << "+---------------------------------------------------------------+\n";
        
        tampilkanKeranjang();
        
        double total = hitungTotal();
        
        cout << "\n\nPembeli: " << pembeli.Nama << "\n";
        cout << "NIK    : " << pembeli.NIK << "\n";
        cout << "\nTotal yang harus dibayar: Rp " << fixed << setprecision(0) << total << "\n";
        cout << "\nLanjutkan pembayaran? (Y/N): ";
        
        char konfirmasi;
        cin >> konfirmasi;
        
        if (konfirmasi != 'Y' && konfirmasi != 'y') {
            cout << "\n[!] Transaksi dibatalkan.\n";
            return false;
        }
        
        cout << "\nMasukkan jumlah uang: Rp ";
        double uangDibayar;
        cin >> uangDibayar;
        
        if (uangDibayar < total) {
            cout << "\n[!] Uang tidak cukup!\n";
            return false;
        }
        
        double kembalian = uangDibayar - total;
        
        // Generate nomor transaksi dan timestamp
        string noTransaksi = generateNomorTransaksi();
        string timestamp = getCurrentTimestamp();
        
        // Update stok dan tambah ke laporan
        double totalProfit = 0;
        for (int i = 0; i < jumlahItem; i++) {
            katalog.updateStok(keranjang[i].produk->ID, keranjang[i].jumlah);
            
            double hargaTambahan = ukuranMgr.getHargaTambahan(keranjang[i].ukuran);
            double profit = ((keranjang[i].produk->Harga + hargaTambahan) - keranjang[i].produk->HargaBeli) * keranjang[i].jumlah;
            totalProfit += profit;
            
            laporan.tambahTransaksi(
                pembeli.Nama,
                keranjang[i].produk->ID,
                keranjang[i].produk->Nama,
                keranjang[i].ukuran,
                keranjang[i].jumlah,
                keranjang[i].subtotal,
                profit,
                timestamp
            );
        }
        
        // AUTO-SAVE: Simpan transaksi ke database
        laporan.autoSave();
        
        // Cetak struk ke layar
        system("cls");
        cout << "\n\n";
        cout << "+========================================================================+\n";
        cout << "|                                                                        |\n";
        cout << "|                      CLOTHING BRAND SHOP                               |\n";
        cout << "|                  Jl. Fashion Street No. 123                            |\n";
        cout << "|                    Telp: (021) 1234-5678                               |\n";
        cout << "|                                                                        |\n";
        cout << "+========================================================================+\n";
        cout << "| No. Transaksi : " << left << setw(54) << noTransaksi << "|\n";
        cout << "| Tanggal       : " << setw(54) << timestamp << "|\n";
        cout << "| Kasir         : Admin                                                  |\n";
        cout << "+------------------------------------------------------------------------+\n";
        cout << "| PEMBELI                                                                |\n";
        cout << "+------------------------------------------------------------------------+\n";
        cout << "| Nama          : " << setw(54) << pembeli.Nama.substr(0, 54) << "|\n";
        cout << "| NIK           : " << setw(54) << pembeli.NIK << "|\n";
        cout << "+========================================================================+\n";
        cout << "| DAFTAR BELANJA                                                         |\n";
        cout << "+------------------------------------------------------------------------+\n";
        cout << "| Nama Produk              | Ukuran | Harga      | Qty | Subtotal       |\n";
        cout << "|--------------------------+--------+------------+-----+----------------|\n";
        
        for (int i = 0; i < jumlahItem; i++) {
            double hargaTambahan = ukuranMgr.getHargaTambahan(keranjang[i].ukuran);
            double hargaPerItem = keranjang[i].produk->Harga + hargaTambahan;
            
            cout << "| " << left << setw(24) << keranjang[i].produk->Nama.substr(0, 24) << " | ";
            cout << setw(6) << keranjang[i].ukuran << " | Rp ";
            cout << setw(8) << fixed << setprecision(0) << hargaPerItem << " | ";
            cout << setw(3) << keranjang[i].jumlah << " | Rp ";
            cout << setw(12) << keranjang[i].subtotal << " |\n";
        }
        
        cout << "+========================================================================+\n";
        cout << "| TOTAL BELANJA            " << right << setw(30) << ": Rp " << setw(15) << total << " |\n";
        cout << "| UANG DIBAYAR             " << setw(30) << ": Rp " << setw(15) << uangDibayar << " |\n";
        cout << "| KEMBALIAN                " << setw(30) << ": Rp " << setw(15) << kembalian << " |\n";
        cout << "+========================================================================+\n";
        cout << "|                                                                        |\n";
        cout << "|              TERIMA KASIH ATAS KUNJUNGAN ANDA                          |\n";
        cout << "|                 BARANG YANG SUDAH DIBELI                               |\n";
        cout << "|               TIDAK DAPAT DIKEMBALIKAN                                 |\n";
        cout << "|                                                                        |\n";
        cout << "+========================================================================+\n\n";
        
        // Simpan struk ke file
        string namaFile = "Struk_" + noTransaksi + ".txt";
        ofstream file(namaFile.c_str());
        
        if (file.is_open()) {
            file << "+========================================================================+\n";
            file << "|                                                                        |\n";
            file << "|                      CLOTHING BRAND SHOP                               |\n";
            file << "|                  Jl. Fashion Street No. 123                            |\n";
            file << "|                    Telp: (021) 1234-5678                               |\n";
            file << "|                                                                        |\n";
            file << "+========================================================================+\n";
            file << "| No. Transaksi : " << left << setw(54) << noTransaksi << "|\n";
            file << "| Tanggal       : " << setw(54) << timestamp << "|\n";
            file << "| Kasir         : Admin                                                  |\n";
            file << "+------------------------------------------------------------------------+\n";
            file << "| PEMBELI                                                                |\n";
            file << "+------------------------------------------------------------------------+\n";
            file << "| Nama          : " << setw(54) << pembeli.Nama.substr(0, 54) << "|\n";
            file << "| NIK           : " << setw(54) << pembeli.NIK << "|\n";
            file << "+========================================================================+\n";
            file << "| DAFTAR BELANJA                                                         |\n";
            file << "+------------------------------------------------------------------------+\n";
            file << "| Nama Produk              | Ukuran | Harga      | Qty | Subtotal       |\n";
            file << "|--------------------------+--------+------------+-----+----------------|\n";
            
            for (int i = 0; i < jumlahItem; i++) {
                double hargaTambahan = ukuranMgr.getHargaTambahan(keranjang[i].ukuran);
                double hargaPerItem = keranjang[i].produk->Harga + hargaTambahan;
                
                file << "| " << left << setw(24) << keranjang[i].produk->Nama.substr(0, 24) << " | ";
                file << setw(6) << keranjang[i].ukuran << " | Rp ";
                file << setw(8) << fixed << setprecision(0) << hargaPerItem << " | ";
                file << setw(3) << keranjang[i].jumlah << " | Rp ";
                file << setw(12) << keranjang[i].subtotal << " |\n";
            }
            
            file << "+========================================================================+\n";
            file << "| TOTAL BELANJA            " << right << setw(30) << ": Rp " << setw(15) << total << " |\n";
            file << "| UANG DIBAYAR             " << setw(30) << ": Rp " << setw(15) << uangDibayar << " |\n";
            file << "| KEMBALIAN                " << setw(30) << ": Rp " << setw(15) << kembalian << " |\n";
            file << "+========================================================================+\n";
            file << "|                                                                        |\n";
            file << "|              TERIMA KASIH ATAS KUNJUNGAN ANDA                          |\n";
            file << "|                 BARANG YANG SUDAH DIBELI                               |\n";
            file << "|               TIDAK DAPAT DIKEMBALIKAN                                 |\n";
            file << "|                                                                        |\n";
            file << "+========================================================================+\n";
            
            file.close();
            
            cout << "[?] Struk berhasil disimpan ke file: " << namaFile << "\n";
        } else {
            cout << "\n[!] Gagal menyimpan struk ke file!\n";
        }
        
        cout << "\n[?] Data transaksi berhasil disimpan ke database (AUTO-SAVE)\n";
        
        // Kosongkan keranjang
        jumlahItem = 0;
        
        cout << "\n[?] Transaksi berhasil!\n";
        cout << "[?] Total Profit: Rp " << fixed << setprecision(0) << totalProfit << "\n";
        
        return true;
    }
    
    // Kosongkan keranjang
    void kosongkanKeranjang() {
        jumlahItem = 0;
        cout << "\n[?] Keranjang dikosongkan!\n";
    }
    
    int getJumlahItem() {
        return jumlahItem;
    }
    
    ~TransaksiSystem() {
        delete[] keranjang;
    }
};

#endif
