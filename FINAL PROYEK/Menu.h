#ifndef MENU_H
#define MENU_H

#include "DataModel.h"
#include "KTP_Data.h"
#include "DoubleLinkedList.h"
#include "Trees.h"
#include "Transactions.h"
#include "Auth.h"
#include "TransaksiSystem.h"
#include <fstream>
#include <cstdlib>
#include <iomanip>
#include <string>

using namespace std;

// Variabel global untuk sistem
KTP* dataKTP = NULL;
int jumlahKTP = 0;
DoublyLinkedList katalog;
AVLTree avlTree;
Stack stackPembatalan;
Queue queueKasir;
LaporanTransaksi laporan;
HuffmanTree huffman;
AuthSystem* authSystem = NULL;

// Fungsi utilitas untuk pause
void pauseScreen() {
    cout << "\nTekan Enter untuk melanjutkan...";
    cin.ignore();
    cin.get();
}

// Header dekoratif
void tampilkanHeader(const char* judul) {
    cout << "\n---------------------------------------------------------------------------\n";
    cout << "                         " << judul << "\n";
    cout << "---------------------------------------------------------------------------\n";
}

// Export KTP ke file dengan format visual
void exportKTPToFile() {
    ofstream file("KTP.txt");
    if (!file.is_open()) {
        cout << "[!] Gagal membuat file KTP.txt\n";
        return;
    }
    
    for (int i = 0; i < jumlahKTP; i++) {
        file << "+-----------------------------------------------------------------------+\n";
        file << "|                     REPUBLIK INDONESIA                                |\n";
        file << "|                     KARTU TANDA PENDUDUK                              |\n";
        file << "|-----------------------------------------------------------------------|\n";
        file << "| NIK               : " << left << setw(49) << dataKTP[i].NIK << "|\n";
        file << "| Nama              : " << setw(49) << dataKTP[i].Nama << "|\n";
        file << "| Tempat/Tgl Lahir  : " << setw(49) << (dataKTP[i].TempatLahir + ", " + dataKTP[i].TanggalLahir) << "|\n";
        file << "| Jenis Kelamin     : " << setw(49) << dataKTP[i].JenisKelamin << "|\n";
        file << "| Alamat            : " << setw(49) << dataKTP[i].Alamat << "|\n";
        file << "| Agama             : " << setw(49) << dataKTP[i].Agama << "|\n";
        file << "| Status Perkawinan : " << setw(49) << dataKTP[i].StatusPerkawinan << "|\n";
        file << "| Pekerjaan         : " << setw(49) << dataKTP[i].Pekerjaan << "|\n";
        file << "| Kewarganegaraan   : " << setw(49) << dataKTP[i].Kewarganegaraan << "|\n";
        file << "+-----------------------------------------------------------------------+\n\n";
    }
    
    file.close();
    cout << "\n[?] Data KTP berhasil diekspor ke KTP.txt\n";
}

// Fungsi untuk build AVL Tree dari katalog
void buildAVLTree() {
    NodeDLL* temp = katalog.getHead();
    while (temp != NULL) {
        avlTree.insert(temp->data.ID, &(temp->data));
        temp = temp->next;
    }
}

// Fungsi untuk mencari produk berdasarkan nama (substring match)
void cariProdukBerdasarkanNama(string keyword) {
    NodeDLL* temp = katalog.getHead();
    int no = 1;
    bool found = false;
    
    // Convert keyword ke lowercase untuk pencarian case-insensitive
    for (size_t i = 0; i < keyword.length(); i++) {
        keyword[i] = tolower(keyword[i]);
    }
    
    cout << "\n+---------------------------------------------------------------------+\n";
    cout << "| No |  ID  | Nama Produk            | Gender    | Stok  | Harga      |\n";
    cout << "|----+------+------------------------+-----------+-------+------------|\n";
    
    while (temp != NULL) {
        string namaProduk = temp->data.Nama;
        // Convert nama produk ke lowercase
        for (size_t i = 0; i < namaProduk.length(); i++) {
            namaProduk[i] = tolower(namaProduk[i]);
        }
        
        // Cek apakah keyword ada di nama produk
        if (namaProduk.find(keyword) != string::npos) {
            found = true;
            cout << "| " << left << setw(2) << no++ << " | ";
            cout << setw(4) << temp->data.ID << " | ";
            cout << setw(22) << temp->data.Nama.substr(0, 22) << " | ";
            cout << setw(9) << temp->data.Gender << " | ";
            cout << setw(5) << temp->data.Stok << " | Rp ";
            cout << setw(8) << fixed << setprecision(0) << temp->data.Harga << " |\n";
        }
        temp = temp->next;
    }
    
    if (!found) {
        cout << "|              Tidak ada produk yang cocok dengan pencarian             |\n";
    }
    cout << "+---------------------------------------------------------------------+\n";
}

// Fungsi untuk menampilkan katalog dengan opsi tambah ke keranjang
void tampilkanKatalogDenganKeranjang(TransaksiSystem* transaksi, string kategori = "") {
    while (true) {
        system("cls");
        if (kategori.empty()) {
            tampilkanHeader("KATALOG SEMUA PRODUK");
            katalog.tampilkanSemua();
        } else {
            string judulKatalog = "KATALOG " + kategori;
            for (size_t i = 0; i < judulKatalog.length(); i++) {
                judulKatalog[i] = toupper(judulKatalog[i]);
            }
            tampilkanHeader(judulKatalog.c_str());
            katalog.tampilkanKategori(kategori);
        }
        
        cout << "\n[A] Tambah ke Keranjang";
        cout << "\n[B] Cari Produk";
        cout << "\n[0] Kembali\n";
        cout << "\nPilihan: ";
        
        string pilihan;
        cin >> pilihan;
        
        if (pilihan == "0") {
            break;
        } else if (pilihan == "A" || pilihan == "a") {
            int id, jumlah;
            cout << "\nMasukkan ID Produk: ";
            cin >> id;
            
            Produk* p = katalog.cariProduk(id);
            if (p == NULL) {
                cout << "\n[!] Produk tidak ditemukan.\n";
            } else {
                cout << "\nProduk: " << p->Nama << "\n";
                cout << "Harga: Rp " << fixed << setprecision(0) << p->Harga << "\n";
                cout << "Stok: " << p->Stok << "\n\n";
                cout << "Masukkan Jumlah: ";
                cin >> jumlah;
                
                if (transaksi != NULL) {
                    transaksi->tambahKeKeranjang(p, jumlah);
                }
            }
            pauseScreen();
        } else if (pilihan == "B" || pilihan == "b") {
            system("cls");
            tampilkanHeader("PENCARIAN PRODUK");
            cout << "\n[1] Cari berdasarkan ID (AVL Tree)\n";
            cout << "[2] Cari berdasarkan Nama\n";
            cout << "Pilihan: ";
            
            int pilihanCari;
            cin >> pilihanCari;
            
            if (pilihanCari == 1) {
                int id;
                cout << "\nMasukkan ID Produk: ";
                cin >> id;
                
                Produk* p = avlTree.search(id);
                if (p != NULL) {
                    cout << "\n+----------------------------------------------------------+\n";
                    cout << "|                   PRODUK DITEMUKAN                       |\n";
                    cout << "|----------------------------------------------------------|\n";
                    cout << "| ID       : " << left << setw(45) << p->ID << "|\n";
                    cout << "| Nama     : " << setw(45) << p->Nama << "|\n";
                    cout << "| Kategori : " << setw(45) << p->Kategori << "|\n";
                    cout << "| Gender   : " << setw(45) << p->Gender << "|\n";
                    cout << "| Stok     : " << setw(45) << p->Stok << "|\n";
                    cout << "| Harga    : Rp " << setw(42) << fixed << setprecision(0) << p->Harga << "|\n";
                    cout << "+----------------------------------------------------------+\n";
                    
                    if (transaksi != NULL) {
                        cout << "\nTambah ke keranjang? (Y/N): ";
                        char tambah;
                        cin >> tambah;
                        if (tambah == 'Y' || tambah == 'y') {
                            int jumlah;
                            cout << "Masukkan Jumlah: ";
                            cin >> jumlah;
                            transaksi->tambahKeKeranjang(p, jumlah);
                        }
                    }
                } else {
                    cout << "\n[!] Produk dengan ID " << id << " tidak ditemukan.\n";
                }
            } else if (pilihanCari == 2) {
                string keyword;
                cout << "\nMasukkan Nama Produk (atau sebagian): ";
                cin.ignore();
                getline(cin, keyword);
                
                cariProdukBerdasarkanNama(keyword);
                
                if (transaksi != NULL) {
                    cout << "\nTambah ke keranjang? (Y/N): ";
                    char tambah;
                    cin >> tambah;
                    if (tambah == 'Y' || tambah == 'y') {
                        int id, jumlah;
                        cout << "Masukkan ID Produk: ";
                        cin >> id;
                        
                        Produk* p = katalog.cariProduk(id);
                        if (p != NULL) {
                            cout << "Masukkan Jumlah: ";
                            cin >> jumlah;
                            transaksi->tambahKeKeranjang(p, jumlah);
                        } else {
                            cout << "\n[!] ID tidak valid.\n";
                        }
                    }
                }
            }
            pauseScreen();
        }
    }
}

// ============== MENU TRANSAKSI (UPDATED) ==============
void menuTransaksi() {
    // Cek autentikasi
    if (!authSystem->checkLogin()) {
        system("cls");
        cout << "\n+---------------------------------------------------------------+\n";
        cout << "|            AKSES DITOLAK - AUTENTIKASI DIPERLUKAN            |\n";
        cout << "+---------------------------------------------------------------+\n";
        cout << "\n[!] Anda harus login atau registrasi terlebih dahulu!\n\n";
        cout << " [1] Login\n";
        cout << " [2] Registrasi\n";
        cout << " [0] Kembali\n";
        cout << "\nPilihan: ";
        
        int pilihan;
        cin >> pilihan;
        
        if (pilihan == 1) {
            if (!authSystem->login()) {
                pauseScreen();
                return;
            }
        } else if (pilihan == 2) {
            if (!authSystem->registrasi()) {
                pauseScreen();
                return;
            }
            // Setelah registrasi, harus login
            pauseScreen();
            if (!authSystem->login()) {
                pauseScreen();
                return;
            }
        } else {
            return;
        }
        pauseScreen();
    }
    
    // User sudah login, buat transaksi system
    KTP userLogin = authSystem->getUserLogin();
    TransaksiSystem transaksi(userLogin);
    
    while (true) {
        system("cls");
        tampilkanHeader("SISTEM TRANSAKSI BELANJA");
        
        cout << "\n+------------------------------------+\n";
        cout << "|  User: " << left << setw(27) << userLogin.Nama.substr(0, 27) << "|\n";
        cout << "|  NIK : " << setw(27) << userLogin.NIK << "|\n";
        cout << "+------------------------------------+\n\n";
        
        cout << " [1] Lihat Katalog Produk\n";
        cout << " [2] Cari Produk\n";
        cout << " [3] Lihat Keranjang\n";
        cout << " [4] Hapus dari Keranjang\n";
        cout << " [5] Checkout & Bayar\n";
        cout << " [6] Kosongkan Keranjang\n";
        cout << " [7] Logout\n";
        cout << " [0] Kembali ke Menu Utama\n";
        cout << "\nPilihan: ";
        
        int pilihan;
        cin >> pilihan;
        
        if (pilihan == 0) break;
        
        switch (pilihan) {
            case 1: {
                system("cls");
                tampilkanHeader("PILIH KATEGORI");
                cout << "\n [1] Semua Produk\n [2] Baju\n [3] Celana\n [4] Jaket\n [5] Sepatu\n";
                cout << "Pilihan: ";
                int sub;
                cin >> sub;
                
                if (sub == 1) tampilkanKatalogDenganKeranjang(&transaksi, "");
                else if (sub == 2) tampilkanKatalogDenganKeranjang(&transaksi, "Baju");
                else if (sub == 3) tampilkanKatalogDenganKeranjang(&transaksi, "Celana");
                else if (sub == 4) tampilkanKatalogDenganKeranjang(&transaksi, "Jaket");
                else if (sub == 5) tampilkanKatalogDenganKeranjang(&transaksi, "Sepatu");
                break;
            }
            case 2: {
                system("cls");
                tampilkanHeader("PENCARIAN PRODUK");
                cout << "\n[1] Cari berdasarkan ID (AVL Tree)\n";
                cout << "[2] Cari berdasarkan Nama\n";
                cout << "Pilihan: ";
                
                int pilihanCari;
                cin >> pilihanCari;
                
                if (pilihanCari == 1) {
                    int id;
                    cout << "\nMasukkan ID Produk: ";
                    cin >> id;
                    
                    Produk* p = avlTree.search(id);
                    if (p != NULL) {
                        cout << "\n+----------------------------------------------------------+\n";
                        cout << "|                   PRODUK DITEMUKAN                       |\n";
                        cout << "|----------------------------------------------------------|\n";
                        cout << "| ID       : " << left << setw(45) << p->ID << "|\n";
                        cout << "| Nama     : " << setw(45) << p->Nama << "|\n";
                        cout << "| Kategori : " << setw(45) << p->Kategori << "|\n";
                        cout << "| Gender   : " << setw(45) << p->Gender << "|\n";
                        cout << "| Stok     : " << setw(45) << p->Stok << "|\n";
                        cout << "| Harga    : Rp " << setw(42) << fixed << setprecision(0) << p->Harga << "|\n";
                        cout << "+----------------------------------------------------------+\n";
                        
                        cout << "\nTambah ke keranjang? (Y/N): ";
                        char tambah;
                        cin >> tambah;
                        if (tambah == 'Y' || tambah == 'y') {
                            int jumlah;
                            cout << "Masukkan Jumlah: ";
                            cin >> jumlah;
                            transaksi.tambahKeKeranjang(p, jumlah);
                        }
                    } else {
                        cout << "\n[!] Produk dengan ID " << id << " tidak ditemukan.\n";
                    }
                } else if (pilihanCari == 2) {
                    string keyword;
                    cout << "\nMasukkan Nama Produk (atau sebagian): ";
                    cin.ignore();
                    getline(cin, keyword);
                    
                    cariProdukBerdasarkanNama(keyword);
                    
                    cout << "\nTambah ke keranjang? (Y/N): ";
                    char tambah;
                    cin >> tambah;
                    if (tambah == 'Y' || tambah == 'y') {
                        int id, jumlah;
                        cout << "Masukkan ID Produk: ";
                        cin >> id;
                        
                        Produk* p = katalog.cariProduk(id);
                        if (p != NULL) {
                            cout << "Masukkan Jumlah: ";
                            cin >> jumlah;
                            transaksi.tambahKeKeranjang(p, jumlah);
                        } else {
                            cout << "\n[!] ID tidak valid.\n";
                        }
                    }
                }
                
                pauseScreen();
                break;
            }
            case 3: {
                system("cls");
                tampilkanHeader("KERANJANG BELANJA");
                transaksi.tampilkanKeranjang();
                pauseScreen();
                break;
            }
            case 4: {
                system("cls");
                tampilkanHeader("HAPUS DARI KERANJANG");
                transaksi.tampilkanKeranjang();
                
                if (transaksi.getJumlahItem() > 0) {
                    cout << "\nMasukkan nomor item yang akan dihapus: ";
                    int nomor;
                    cin >> nomor;
                    transaksi.hapusDariKeranjang(nomor - 1);
                }
                
                pauseScreen();
                break;
            }
            case 5: {
                transaksi.checkout(katalog, laporan);
                pauseScreen();
                break;
            }
            case 6: {
                system("cls");
                tampilkanHeader("KOSONGKAN KERANJANG");
                transaksi.kosongkanKeranjang();
                pauseScreen();
                break;
            }
            case 7: {
                authSystem->logout();
                pauseScreen();
                return;
            }
            default:
                cout << "\n[!] Pilihan tidak valid.\n";
                pauseScreen();
        }
    }
}

// ============== MENU ADMIN ==============
void menuAdmin() {
    while (true) {
        system("cls");
        tampilkanHeader("MENU ADMINISTRATOR");
        
        cout << "\n+--------------------------------------+\n";
        cout << "|          PANEL ADMINISTRASI          |\n";
        cout << "+--------------------------------------+\n\n";
        
        cout << " [1] Lihat Data KTP Pengguna\n";
        cout << " [2] Export KTP ke File\n";
        cout << " [3] Kelola Katalog Produk\n";
        cout << " [4] Proses Antrian Kasir\n";
        cout << " [5] Kelola Pembatalan (Stack)\n";
        cout << " [6] Analisis Huffman Compression\n";
        cout << " [7] Laporan Penjualan\n";
        cout << " [8] Export Laporan ke File\n";
        cout << " [0] Kembali ke Menu Utama\n";
        cout << "\nPilihan: ";
        
        int pilihan;
        cin >> pilihan;
        
        if (pilihan == 0) break;
        
        switch (pilihan) {
            case 1: {
                system("cls");
                tampilkanHeader("DATA KTP PENGGUNA");
                for (int i = 0; i < jumlahKTP; i++) {
                    cout << "\n+-----------------------------------------------------------+\n";
                    cout << "| KTP #" << (i+1) << "                                                  |\n";
                    cout << "|-----------------------------------------------------------|\n";
                    cout << "| NIK    : " << left << setw(46) << dataKTP[i].NIK << "|\n";
                    cout << "| Nama   : " << setw(46) << dataKTP[i].Nama << "|\n";
                    cout << "| Alamat : " << setw(46) << dataKTP[i].Alamat << "|\n";
                    cout << "+-----------------------------------------------------------+\n";
                }
                pauseScreen();
                break;
            }
            case 2: {
                system("cls");
                tampilkanHeader("EXPORT DATA KTP");
                exportKTPToFile();
                pauseScreen();
                break;
            }
            case 3: {
                system("cls");
                tampilkanHeader("KATALOG PRODUK");
                katalog.tampilkanSemua();
                pauseScreen();
                break;
            }
            case 4: {
                system("cls");
                tampilkanHeader("PROSES ANTRIAN KASIR");
                
                if (queueKasir.isEmpty()) {
                    cout << "\n[!] Tidak ada antrian.\n";
                } else {
                    string nama, ukuran;
                    Produk* p;
                    int jumlah;
                    double total;
                    
                    if (queueKasir.dequeue(nama, p, jumlah, ukuran, total)) {
                        double profit = (p->Harga - p->HargaBeli) * jumlah;
                        
                        // Tambahkan ke laporan dengan timestamp
                        time_t now = time(0);
                        tm* ltm = localtime(&now);
                        stringstream ss;
                        ss << setfill('0') << setw(2) << ltm->tm_mday << "-";
                        ss << setfill('0') << setw(2) << (1 + ltm->tm_mon) << "-";
                        ss << (1900 + ltm->tm_year);
                        string timestamp = ss.str();
                        
                        laporan.tambahTransaksi(nama, p->ID, p->Nama, ukuran, jumlah, total, profit, timestamp);
                        
                        cout << "\n[?] Transaksi berhasil diproses!\n";
                        cout << "Pembeli: " << nama << "\n";
                        cout << "Produk: " << p->Nama << "\n";
                        cout << "Ukuran: " << ukuran << "\n";
                        cout << "Total: Rp " << fixed << setprecision(0) << total << "\n";
                        cout << "Profit: Rp " << profit << "\n";
                        
                        // Analisis Huffman untuk struk
                        string strukText = nama + p->Nama + p->Kategori;
                        int ukuranSebelum, ukuranSesudah;
                        double efisiensi;
                        
                        huffman.kompresi(strukText, ukuranSebelum, ukuranSesudah, efisiensi);
                        
                        cout << "\n+-------------------------------------------+\n";
                        cout << "|     ANALISIS HUFFMAN COMPRESSION         |\n";
                        cout << "|-------------------------------------------|\n";
                        cout << "| Ukuran Sebelum : " << setw(6) << ukuranSebelum << " bit           |\n";
                        cout << "| Ukuran Sesudah : " << setw(6) << ukuranSesudah << " bit           |\n";
                        cout << "| Efisiensi      : " << setw(6) << fixed << setprecision(2) << efisiensi << " %             |\n";
                        cout << "+-------------------------------------------+\n";
                    }
                }
                
                pauseScreen();
                break;
            }
            case 5: {
                system("cls");
                tampilkanHeader("KELOLA PEMBATALAN (STACK)");
                stackPembatalan.tampilkan();
                
                if (!stackPembatalan.isEmpty()) {
                    cout << "\nApprove pembatalan teratas? (y/n): ";
                    char ch;
                    cin >> ch;
                    
                    if (ch == 'y' || ch == 'Y') {
                        int id, jumlah;
                        string nama, ukuran;
                        
                        if (stackPembatalan.pop(id, jumlah, nama, ukuran)) {
                            katalog.kembalikanStok(id, jumlah);
                            cout << "\n[?] Pembatalan disetujui. Stok dikembalikan.\n";
                        }
                    }
                }
                
                pauseScreen();
                break;
            }
            case 6: {
                system("cls");
                tampilkanHeader("ANALISIS HUFFMAN COMPRESSION");
                
                cout << "\nMasukkan teks untuk dikompresi: ";
                cin.ignore();
                string teks;
                getline(cin, teks);
                
                int ukuranSebelum, ukuranSesudah;
                double efisiensi;
                
                huffman.kompresi(teks, ukuranSebelum, ukuranSesudah, efisiensi);
                
                cout << "\n+-------------------------------------------+\n";
                cout << "|     HASIL KOMPRESI HUFFMAN               |\n";
                cout << "|-------------------------------------------|\n";
                cout << "| Teks           : " << left << setw(23) << teks.substr(0, 23) << "|\n";
                cout << "| Ukuran Sebelum : " << setw(6) << ukuranSebelum << " bit           |\n";
                cout << "| Ukuran Sesudah : " << setw(6) << ukuranSesudah << " bit           |\n";
                cout << "| Efisiensi      : " << setw(6) << fixed << setprecision(2) << efisiensi << " %             |\n";
                cout << "+-------------------------------------------+\n";
                
                pauseScreen();
                break;
            }
            case 7: {
                system("cls");
                tampilkanHeader("LAPORAN PENJUALAN");
                laporan.tampilkan();
                pauseScreen();
                break;
            }
            case 8: {
                system("cls");
                tampilkanHeader("EXPORT LAPORAN");
                laporan.exportToFile("Laporan_Penjualan.txt");
                pauseScreen();
                break;
            }
            default:
                cout << "\n[!] Pilihan tidak valid.\n";
                pauseScreen();
        }
    }
}

// Fungsi inisialisasi sistem
void initSistem() {
    // Load data KTP
    initKTPData(dataKTP, jumlahKTP);
    
    // Load katalog produk
    initProduk(katalog);
    
    // Build AVL Tree
    buildAVLTree();
    
    // Inisialisasi Auth System
    authSystem = new AuthSystem(dataKTP, jumlahKTP);
}

// Fungsi cleanup
void cleanupSistem() {
    if (dataKTP != NULL) {
        delete[] dataKTP;
    }
    if (authSystem != NULL) {
        delete authSystem;
    }
}

#endif
