#ifndef AUTH_H
#define AUTH_H

#include "DataModel.h"
#include <iostream>
#include <iomanip>
#include <string>

using namespace std;

class AuthSystem {
private:
    KTP* dataKTP;
    int jumlahKTP;
    KTP userLogin;
    bool isLoggedIn;

public:
    AuthSystem(KTP* ktp, int jumlah) : dataKTP(ktp), jumlahKTP(jumlah), isLoggedIn(false) {}
    
    // Cari KTP berdasarkan NIK
    KTP* cariKTP(string nik) {
        for (int i = 0; i < jumlahKTP; i++) {
            if (dataKTP[i].NIK == nik) {
                return &dataKTP[i];
            }
        }
        return NULL;
    }
    
    // Registrasi pengguna baru
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
        
        // Tambahkan ke array (resize jika perlu)
        KTP* temp = new KTP[jumlahKTP + 1];
        for (int i = 0; i < jumlahKTP; i++) {
            temp[i] = dataKTP[i];
        }
        temp[jumlahKTP] = newKTP;
        
        delete[] dataKTP;
        dataKTP = temp;
        jumlahKTP++;
        
        cout << "\n[?] Registrasi berhasil! Silakan login dengan NIK Anda.\n";
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
        
        cout << "\n[?] Login berhasil!\n";
        cout << "Selamat datang, " << userLogin.Nama << "!\n";
        
        return true;
    }
    
    // Logout
    void logout() {
        isLoggedIn = false;
        cout << "\n[?] Logout berhasil!\n";
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
};

#endif
