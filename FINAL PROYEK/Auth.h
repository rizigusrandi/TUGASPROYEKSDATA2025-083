#ifndef AUTH_H
#define AUTH_H

#include "DataModel.h"
#include <iostream>
#include <iomanip>
#include <string>
#include <fstream>
#include <sstream>

using namespace std;

class AuthSystem {
private:
    KTP* dataKTP;
    int jumlahKTP;
    KTP userLogin;
    bool isLoggedIn;
    const char* DATABASE_KTP_FILE = "database_ktp.txt";

    // AUTO-SAVE: Simpan semua data KTP ke file
    void autoSaveKTP() {
        ofstream file(DATABASE_KTP_FILE);
        
        if (!file.is_open()) {
            cout << "\n[!] ERROR: Gagal menyimpan data KTP ke database!\n";
            return;
        }
        
        file << "+==================================================================================+\n";
        file << "|                         DATABASE KARTU TANDA PENDUDUK                            |\n";
        file << "+==================================================================================+\n\n";
        
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
            file << "+-----------------------------------------------------------------------+\n";
            
            // Tambahkan delimiter untuk parsing
            file << "###DATA_SEPARATOR###\n";
        }
        
        file << "\n+==================================================================================+\n";
        file << "| Total Data KTP: " << left << setw(65) << jumlahKTP << "|\n";
        file << "+==================================================================================+\n";
        
        file.close();
    }
    
    // AUTO-LOAD: Muat data KTP dari file
    void autoLoadKTP() {
        ifstream file(DATABASE_KTP_FILE);
        
        if (!file.is_open()) {
            cout << "\n[i] Database KTP belum ada. Menggunakan data default...\n";
            return;
        }
        
        cout << "\n[v] Memuat data KTP dari database...\n";
        
        // Hitung jumlah data
        string line;
        int count = 0;
        while (getline(file, line)) {
            if (line.find("###DATA_SEPARATOR###") != string::npos) {
                count++;
            }
        }
        
        if (count == 0) {
            file.close();
            cout << "[i] Database kosong. Menggunakan data default...\n";
            return;
        }
        
        // Reset file pointer
        file.clear();
        file.seekg(0);
        
        // Alokasi array baru
        KTP* newData = new KTP[count];
        int idx = 0;
        
        // Parse data
        while (getline(file, line)) {
            if (line.find("| NIK               : ") != string::npos) {
                size_t pos = line.find(": ") + 2;
                string nik = line.substr(pos);
                // Trim whitespace dan |
                size_t end = nik.find_last_not_of(" |");
                newData[idx].NIK = nik.substr(0, end + 1);
                
                // Nama
                getline(file, line);
                pos = line.find(": ") + 2;
                string nama = line.substr(pos);
                end = nama.find_last_not_of(" |");
                newData[idx].Nama = nama.substr(0, end + 1);
                
                // Tempat/Tanggal Lahir
                getline(file, line);
                pos = line.find(": ") + 2;
                string ttl = line.substr(pos);
                end = ttl.find_last_not_of(" |");
                ttl = ttl.substr(0, end + 1);
                size_t commaPos = ttl.find(", ");
                if (commaPos != string::npos) {
                    newData[idx].TempatLahir = ttl.substr(0, commaPos);
                    newData[idx].TanggalLahir = ttl.substr(commaPos + 2);
                } else {
                    newData[idx].TempatLahir = ttl;
                    newData[idx].TanggalLahir = "";
                }
                
                // Jenis Kelamin
                getline(file, line);
                pos = line.find(": ") + 2;
                string jk = line.substr(pos);
                end = jk.find_last_not_of(" |");
                newData[idx].JenisKelamin = jk.substr(0, end + 1);
                
                // Alamat
                getline(file, line);
                pos = line.find(": ") + 2;
                string alamat = line.substr(pos);
                end = alamat.find_last_not_of(" |");
                newData[idx].Alamat = alamat.substr(0, end + 1);
                
                // Agama
                getline(file, line);
                pos = line.find(": ") + 2;
                string agama = line.substr(pos);
                end = agama.find_last_not_of(" |");
                newData[idx].Agama = agama.substr(0, end + 1);
                
                // Status Perkawinan
                getline(file, line);
                pos = line.find(": ") + 2;
                string status = line.substr(pos);
                end = status.find_last_not_of(" |");
                newData[idx].StatusPerkawinan = status.substr(0, end + 1);
                
                // Pekerjaan
                getline(file, line);
                pos = line.find(": ") + 2;
                string pekerjaan = line.substr(pos);
                end = pekerjaan.find_last_not_of(" |");
                newData[idx].Pekerjaan = pekerjaan.substr(0, end + 1);
                
                // Kewarganegaraan
                getline(file, line);
                pos = line.find(": ") + 2;
                string kwn = line.substr(pos);
                end = kwn.find_last_not_of(" |");
                newData[idx].Kewarganegaraan = kwn.substr(0, end + 1);
                
                idx++;
            }
        }
        
        file.close();
        
        // Update data
        if (idx > 0) {
            delete[] dataKTP;
            dataKTP = newData;
            jumlahKTP = idx;
            cout << "[v] " << jumlahKTP << " data KTP berhasil dimuat dari database.\n";
        } else {
            delete[] newData;
            cout << "[i] Gagal parsing data. Menggunakan data default...\n";
        }
    }

public:
    AuthSystem(KTP* ktp, int jumlah) : dataKTP(ktp), jumlahKTP(jumlah), isLoggedIn(false) {
        // AUTO-LOAD saat inisialisasi
        autoLoadKTP();
    }
    
    // Cari KTP berdasarkan NIK
    KTP* cariKTP(string nik) {
        for (int i = 0; i < jumlahKTP; i++) {
            if (dataKTP[i].NIK == nik) {
                return &dataKTP[i];
            }
        }
        return NULL;
    }
    
    // Registrasi pengguna baru dengan AUTO-SAVE
    bool registrasi() {
        system("cls");
        cout << "\n+---------------------------------------------------------------+\n";
        cout << "|                    REGISTRASI PENGGUNA BARU                   |\n";
        cout << "+---------------------------------------------------------------+\n\n";
        
        KTP newKTP;
        cin.ignore();
        
        cout << "NIK (16 digit)           : ";
        getline(cin, newKTP.NIK);
        
        // Validasi NIK
        if (newKTP.NIK.length() != 16) {
            cout << "\n[!] NIK harus 16 digit!\n";
            return false;
        }
        
        // Validasi hanya angka
        for (size_t i = 0; i < newKTP.NIK.length(); i++) {
            if (newKTP.NIK[i] < '0' || newKTP.NIK[i] > '9') {
                cout << "\n[!] NIK harus berisi angka saja!\n";
                return false;
            }
        }
        
        // Cek apakah NIK sudah terdaftar
        if (cariKTP(newKTP.NIK) != NULL) {
            cout << "\n[!] NIK sudah terdaftar! Silakan login.\n";
            return false;
        }
        
        cout << "Nama Lengkap             : ";
        getline(cin, newKTP.Nama);
        
        cout << "Tempat Lahir             : ";
        getline(cin, newKTP.TempatLahir);
        
        cout << "Tanggal Lahir (DD-MM-YYYY): ";
        getline(cin, newKTP.TanggalLahir);
        
        cout << "Jenis Kelamin (L/P)      : ";
        string jk;
        getline(cin, jk);
        newKTP.JenisKelamin = (jk == "L" || jk == "l") ? "Laki-laki" : "Perempuan";
        
        cout << "Alamat Lengkap           : ";
        getline(cin, newKTP.Alamat);
        
        cout << "Agama                    : ";
        getline(cin, newKTP.Agama);
        
        cout << "Status Perkawinan        : ";
        getline(cin, newKTP.StatusPerkawinan);
        
        cout << "Pekerjaan                : ";
        getline(cin, newKTP.Pekerjaan);
        
        newKTP.Kewarganegaraan = "WNI";
        
        // Tambahkan ke array (resize)
        KTP* temp = new KTP[jumlahKTP + 1];
        for (int i = 0; i < jumlahKTP; i++) {
            temp[i] = dataKTP[i];
        }
        temp[jumlahKTP] = newKTP;
        
        delete[] dataKTP;
        dataKTP = temp;
        jumlahKTP++;
        
        // AUTO-SAVE ke file
        autoSaveKTP();
        
        cout << "\n+---------------------------------------------------------------+\n";
        cout << "|                    REGISTRASI BERHASIL!                       |\n";
        cout << "+---------------------------------------------------------------+\n";
        cout << "\n[v] Data KTP Anda telah tersimpan ke database.\n";
        cout << "[v] File disimpan di: " << DATABASE_KTP_FILE << "\n";
        cout << "[i] Silakan login dengan NIK Anda.\n";
        
        return true;
    }
    
    // Login pengguna
    bool login() {
        system("cls");
        cout << "\n+---------------------------------------------------------------+\n";
        cout << "|                         LOGIN PENGGUNA                        |\n";
        cout << "+---------------------------------------------------------------+\n\n";
        
        string nik;
        cout << "Masukkan NIK (16 digit): ";
        cin.ignore();
        getline(cin, nik);
        
        KTP* user = cariKTP(nik);
        if (user == NULL) {
            cout << "\n[!] NIK tidak terdaftar!\n";
            cout << "[i] Silakan registrasi terlebih dahulu.\n";
            return false;
        }
        
        userLogin = *user;
        isLoggedIn = true;
        
        cout << "\n+---------------------------------------------------------------+\n";
        cout << "|                      LOGIN BERHASIL!                          |\n";
        cout << "+---------------------------------------------------------------+\n";
        cout << "\nSelamat datang, " << userLogin.Nama << "!\n";
        cout << "NIK: " << userLogin.NIK << "\n";
        
        return true;
    }
    
    // Logout
    void logout() {
        isLoggedIn = false;
        cout << "\n+---------------------------------------------------------------+\n";
        cout << "|                      LOGOUT BERHASIL!                         |\n";
        cout << "+---------------------------------------------------------------+\n";
        cout << "\n[v] Anda telah keluar dari sistem.\n";
    }
    
    // Cek status login
    bool checkLogin() {
        return isLoggedIn;
    }
    
    // Dapatkan data user yang login
    KTP getUserLogin() {
        return userLogin;
    }
    
    // Update pointer data KTP (penting setelah registrasi)
    void updateDataKTP(KTP* ktp, int jumlah) {
        dataKTP = ktp;
        jumlahKTP = jumlah;
    }
    
    // Export manual KTP ke file (tambahan fitur)
    void exportKTPToFile(const char* filename = "KTP_Export.txt") {
        ofstream file(filename);
        if (!file.is_open()) {
            cout << "[!] Gagal membuat file " << filename << "\n";
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
        cout << "\n[v] Data KTP berhasil diekspor ke " << filename << "\n";
    }
    
    // Getter untuk dataKTP (untuk keperluan menu admin)
    KTP* getDataKTP() {
        return dataKTP;
    }
    
    int getJumlahKTP() {
        return jumlahKTP;
    }
};

#endif
