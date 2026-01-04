#ifndef TRANSACTIONS_H
#define TRANSACTIONS_H

#include "DataModel.h"
#include <iostream>
#include <iomanip>
#include <fstream>
#include <sstream>
#include <algorithm>
#include <cstdlib>

// ============== STACK untuk Pembatalan Order ==============
class Stack {
private:
    NodeStack* top;
    int size;

public:
    Stack() : top(NULL), size(0) {}
    
    // Push pembatalan ke stack
    void push(int idProduk, int jumlah, string nama, string ukuran) {
        NodeStack* newNode = new NodeStack;
        newNode->idProduk = idProduk;
        newNode->jumlah = jumlah;
        newNode->namaPembeli = nama;
        newNode->ukuran = ukuran;
        newNode->next = top;
        top = newNode;
        size++;
    }
    
    // Pop pembatalan dari stack
    bool pop(int& idProduk, int& jumlah, string& nama, string& ukuran) {
        if (top == NULL) return false;
        
        NodeStack* temp = top;
        idProduk = temp->idProduk;
        jumlah = temp->jumlah;
        nama = temp->namaPembeli;
        ukuran = temp->ukuran;
        
        top = top->next;
        delete temp;
        size--;
        return true;
    }
    
    // Cek apakah stack kosong
    bool isEmpty() {
        return top == NULL;
    }
    
    // Tampilkan semua pembatalan pending
    void tampilkan() {
        if (top == NULL) {
            cout << "\n[!] Tidak ada pembatalan pending.\n";
            return;
        }
        
        NodeStack* temp = top;
        int no = 1;
        
        cout << "\n+----------------------------------------------------------+\n";
        cout << "| No | ID Produk| Nama Pembeli            | Ukuran | Qty  |\n";
        cout << "|----+----------+-------------------------+--------+------|\n";
        
        while (temp != NULL) {
            cout << "| " << left << setw(2) << no++ << " | ";
            cout << setw(8) << temp->idProduk << " | ";
            cout << setw(23) << temp->namaPembeli.substr(0, 23) << " | ";
            cout << setw(6) << temp->ukuran << " | ";
            cout << setw(4) << temp->jumlah << " |\n";
            temp = temp->next;
        }
        cout << "+----------------------------------------------------------+\n";
        cout << "Total Pembatalan Pending: " << size << endl;
    }
    
    int getSize() { return size; }
    
    ~Stack() {
        while (top != NULL) {
            NodeStack* temp = top;
            top = top->next;
            delete temp;
        }
    }
};

// ============== QUEUE untuk Antrian Kasir ==============
class Queue {
private:
    NodeQueue* front;
    NodeQueue* rear;
    int size;

public:
    Queue() : front(NULL), rear(NULL), size(0) {}
    
    // Enqueue - Tambah ke antrian
    void enqueue(string nama, Produk* produk, int jumlah, string ukuran, double total) {
        NodeQueue* newNode = new NodeQueue;
        newNode->namaPembeli = nama;
        newNode->produk = produk;
        newNode->jumlah = jumlah;
        newNode->ukuran = ukuran;
        newNode->totalHarga = total;
        newNode->next = NULL;
        
        if (rear == NULL) {
            front = rear = newNode;
        } else {
            rear->next = newNode;
            rear = newNode;
        }
        size++;
    }
    
    // Dequeue - Keluarkan dari antrian
    bool dequeue(string& nama, Produk*& produk, int& jumlah, string& ukuran, double& total) {
        if (front == NULL) return false;
        
        NodeQueue* temp = front;
        nama = temp->namaPembeli;
        produk = temp->produk;
        jumlah = temp->jumlah;
        ukuran = temp->ukuran;
        total = temp->totalHarga;
        
        front = front->next;
        if (front == NULL) rear = NULL;
        
        delete temp;
        size--;
        return true;
    }
    
    // Cek apakah queue kosong
    bool isEmpty() {
        return front == NULL;
    }
    
    // Tampilkan antrian
    void tampilkan() {
        if (front == NULL) {
            cout << "\n[!] Antrian kosong.\n";
            return;
        }
        
        NodeQueue* temp = front;
        int no = 1;
        
        cout << "\n+-------------------------------------------------------------------------------------+\n";
        cout << "| No | Nama Pembeli            | Produk                 | Ukuran | Qty | Total      |\n";
        cout << "|----+-------------------------+------------------------+--------+-----+------------|\n";
        
        while (temp != NULL) {
            cout << "| " << left << setw(2) << no++ << " | ";
            cout << setw(23) << temp->namaPembeli.substr(0, 23) << " | ";
            cout << setw(22) << temp->produk->Nama.substr(0, 22) << " | ";
            cout << setw(6) << temp->ukuran << " | ";
            cout << setw(3) << temp->jumlah << " | Rp ";
            cout << setw(8) << fixed << setprecision(0) << temp->totalHarga << " |\n";
            temp = temp->next;
        }
        cout << "+-------------------------------------------------------------------------------------+\n";
        cout << "Total Antrian: " << size << endl;
    }
    
    int getSize() { return size; }
    
    ~Queue() {
        while (front != NULL) {
            NodeQueue* temp = front;
            front = front->next;
            delete temp;
        }
    }
};

// ============== LAPORAN TRANSAKSI dengan AUTO-SAVE/LOAD ==============
class LaporanTransaksi {
private:
    Transaksi* daftarTransaksi;
    int kapasitas;
    int jumlah;
    
public:
    LaporanTransaksi() {
        kapasitas = 100;
        jumlah = 0;
        daftarTransaksi = new Transaksi[kapasitas];
        
        // AUTO-LOAD: Load data dari file saat inisialisasi
        autoLoad();
    }
    
    // AUTO-LOAD: Membaca data dari file
    void autoLoad() {
        const char* DATABASE_FILE = "database_transaksi.txt";
        ifstream file(DATABASE_FILE);
        
        if (!file.is_open()) {
            cout << "\n[i] Database belum ada. Membuat database baru...\n";
            return;
        }
        
        cout << "\n[?] Memuat data transaksi dari database...\n";
        
        string line;
        int count = 0;
        
        // Skip header
        getline(file, line);
        getline(file, line);
        getline(file, line);
        getline(file, line);
        
        while (getline(file, line)) {
            if (line.find("+---") != string::npos || line.empty()) {
                continue;
            }
            
            if (line.find("|") != string::npos) {
                // Parse data dari line
                stringstream ss(line);
                string temp;
                int index = 0;
                string data[8];
                
                while (getline(ss, temp, '|')) {
                    // Trim whitespace
                    size_t start = temp.find_first_not_of(" \t");
                    size_t end = temp.find_last_not_of(" \t");
                    
                    if (start != string::npos && end != string::npos) {
                        temp = temp.substr(start, end - start + 1);
                        if (!temp.empty() && index < 8) {
                            data[index++] = temp;
                        }
                    }
                }
                
                // Validasi dan tambahkan ke array jika data lengkap
                if (index >= 7 && data[0].length() > 0 && data[0][0] >= '0' && data[0][0] <= '9') {
                    if (jumlah >= kapasitas) {
                        // Resize array jika penuh
                        kapasitas *= 2;
                        Transaksi* temp = new Transaksi[kapasitas];
                        for (int i = 0; i < jumlah; i++) {
                            temp[i] = daftarTransaksi[i];
                        }
                        delete[] daftarTransaksi;
                        daftarTransaksi = temp;
                    }
                    
                    try {
                        daftarTransaksi[jumlah].namaPembeli = data[1];
                        daftarTransaksi[jumlah].namaProduk = data[2];
                        daftarTransaksi[jumlah].ukuran = data[3];
                        daftarTransaksi[jumlah].jumlah = atoi(data[4].c_str());
                        
                        // Parse harga (remove "Rp" dan spasi)
                        string totalStr = data[5];
                        size_t pos = totalStr.find("Rp");
                        if (pos != string::npos) {
                            totalStr = totalStr.substr(pos + 2);
                        }
                        // Remove spaces manually
                        string cleanTotal = "";
                        for (size_t i = 0; i < totalStr.length(); i++) {
                            if (totalStr[i] != ' ') {
                                cleanTotal += totalStr[i];
                            }
                        }
                        daftarTransaksi[jumlah].totalHarga = atof(cleanTotal.c_str());
                        
                        // Parse profit
                        string profitStr = data[6];
                        pos = profitStr.find("Rp");
                        if (pos != string::npos) {
                            profitStr = profitStr.substr(pos + 2);
                        }
                        // Remove spaces manually
                        string cleanProfit = "";
                        for (size_t i = 0; i < profitStr.length(); i++) {
                            if (profitStr[i] != ' ') {
                                cleanProfit += profitStr[i];
                            }
                        }
                        daftarTransaksi[jumlah].profit = atof(cleanProfit.c_str());
                        
                        daftarTransaksi[jumlah].timestamp = (index >= 8) ? data[7] : "-";
                        
                        jumlah++;
                        count++;
                    } catch (...) {
                        // Skip data yang corrupt
                        continue;
                    }
                }
            }
        }
        
        file.close();
        
        cout << "[?] " << count << " transaksi berhasil dimuat dari database.\n";
        if (count > 0) {
            cout << "[i] Total Penjualan: Rp " << fixed << setprecision(0) << getTotalPenjualan() << "\n";
            cout << "[i] Total Keuntungan: Rp " << getTotalKeuntungan() << "\n";
        }
    }
    
    // AUTO-SAVE: Menyimpan data ke file
    void autoSave() {
        const char* DATABASE_FILE = "database_transaksi.txt";
        ofstream file(DATABASE_FILE);
        
        if (!file.is_open()) {
            cout << "\n[!] ERROR: Gagal menyimpan ke database!\n";
            return;
        }
        
        file << "+------------------------------------------------------------------------------------------------+\n";
        file << "|                            DATABASE TRANSAKSI PENJUALAN                                        |\n";
        file << "+------------------------------------------------------------------------------------------------+\n";
        file << "| No | Nama Pembeli          | Produk                 | Ukuran | Qty | Total     | Profit    | Waktu           |\n";
        file << "|----+-----------------------+------------------------+--------+-----+-----------+-----------+-----------------|\n";
        
        for (int i = 0; i < jumlah; i++) {
            file << "| " << left << setw(2) << (i+1) << " | ";
            file << setw(21) << daftarTransaksi[i].namaPembeli.substr(0, 21) << " | ";
            file << setw(22) << daftarTransaksi[i].namaProduk.substr(0, 22) << " | ";
            file << setw(6) << daftarTransaksi[i].ukuran << " | ";
            file << setw(3) << daftarTransaksi[i].jumlah << " | Rp ";
            file << setw(7) << fixed << setprecision(0) << daftarTransaksi[i].totalHarga << " | Rp ";
            file << setw(7) << daftarTransaksi[i].profit << " | ";
            file << setw(15) << daftarTransaksi[i].timestamp.substr(0, 15) << " |\n";
        }
        
        file << "+------------------------------------------------------------------------------------------------+\n";
        file << "\n=== RINGKASAN ===\n";
        file << "Total Transaksi  : " << jumlah << " transaksi\n";
        file << "Total Penjualan  : Rp " << fixed << setprecision(0) << getTotalPenjualan() << "\n";
        file << "Total Keuntungan : Rp " << getTotalKeuntungan() << "\n";
        file << "+------------------------------------------------------------------------------------------------+\n";
        
        file.close();
    }
    
    void tambahTransaksi(string nama, int idProduk, string namaProduk, string ukuran,
                         int qty, double total, double profit, string timestamp) {
        if (jumlah >= kapasitas) {
            // Resize array jika penuh
            kapasitas *= 2;
            Transaksi* temp = new Transaksi[kapasitas];
            for (int i = 0; i < jumlah; i++) {
                temp[i] = daftarTransaksi[i];
            }
            delete[] daftarTransaksi;
            daftarTransaksi = temp;
        }
        
        daftarTransaksi[jumlah].namaPembeli = nama;
        daftarTransaksi[jumlah].idProduk = idProduk;
        daftarTransaksi[jumlah].namaProduk = namaProduk;
        daftarTransaksi[jumlah].ukuran = ukuran;
        daftarTransaksi[jumlah].jumlah = qty;
        daftarTransaksi[jumlah].totalHarga = total;
        daftarTransaksi[jumlah].profit = profit;
        daftarTransaksi[jumlah].timestamp = timestamp;
        jumlah++;
    }
    
    double getTotalKeuntungan() {
        double total = 0;
        for (int i = 0; i < jumlah; i++) {
            total += daftarTransaksi[i].profit;
        }
        return total;
    }
    
    double getTotalPenjualan() {
        double total = 0;
        for (int i = 0; i < jumlah; i++) {
            total += daftarTransaksi[i].totalHarga;
        }
        return total;
    }
    
    void tampilkan() {
        if (jumlah == 0) {
            cout << "\n[!] Belum ada transaksi.\n";
            return;
        }
        
        cout << "\n+------------------------------------------------------------------------------------------------+\n";
        cout << "| No | Nama Pembeli          | Produk                 | Ukuran | Qty | Total     | Profit    |\n";
        cout << "|----+-----------------------+------------------------+--------+-----+-----------+-----------|\n";
        
        for (int i = 0; i < jumlah; i++) {
            cout << "| " << left << setw(2) << (i+1) << " | ";
            cout << setw(21) << daftarTransaksi[i].namaPembeli.substr(0, 21) << " | ";
            cout << setw(22) << daftarTransaksi[i].namaProduk.substr(0, 22) << " | ";
            cout << setw(6) << daftarTransaksi[i].ukuran << " | ";
            cout << setw(3) << daftarTransaksi[i].jumlah << " | Rp ";
            cout << setw(7) << fixed << setprecision(0) << daftarTransaksi[i].totalHarga << " | Rp ";
            cout << setw(7) << daftarTransaksi[i].profit << " |\n";
        }
        cout << "+------------------------------------------------------------------------------------------------+\n";
        cout << "\nTotal Penjualan: Rp " << fixed << setprecision(0) << getTotalPenjualan() << endl;
        cout << "Total Keuntungan: Rp " << getTotalKeuntungan() << endl;
        cout << "\n[i] Data disimpan otomatis di: database_transaksi.txt\n";
    }
    
    void exportToFile(const char* filename) {
        ofstream file(filename);
        if (!file.is_open()) {
            cout << "[!] Gagal membuat file laporan.\n";
            return;
        }
        
        file << "---------------------------------------------------------------------------\n";
        file << "                    LAPORAN PENJUALAN CLOTHING BRAND                       \n";
        file << "---------------------------------------------------------------------------\n\n";
        
        file << "+------------------------------------------------------------------------------------------------+\n";
        file << "| No | Nama Pembeli          | Produk                 | Ukuran | Qty | Total     | Profit    |\n";
        file << "|----+-----------------------+------------------------+--------+-----+-----------+-----------|\n";
        
        for (int i = 0; i < jumlah; i++) {
            file << "| " << left << setw(2) << (i+1) << " | ";
            file << setw(21) << daftarTransaksi[i].namaPembeli.substr(0, 21) << " | ";
            file << setw(22) << daftarTransaksi[i].namaProduk.substr(0, 22) << " | ";
            file << setw(6) << daftarTransaksi[i].ukuran << " | ";
            file << setw(3) << daftarTransaksi[i].jumlah << " | Rp ";
            file << setw(7) << fixed << setprecision(0) << daftarTransaksi[i].totalHarga << " | Rp ";
            file << setw(7) << daftarTransaksi[i].profit << " |\n";
        }
        file << "+------------------------------------------------------------------------------------------------+\n\n";
        
        file << "---------------------------------------------------------------------------\n";
        file << "Total Transaksi   : " << jumlah << " transaksi\n";
        file << "Total Penjualan   : Rp " << fixed << setprecision(0) << getTotalPenjualan() << "\n";
        file << "Total Keuntungan  : Rp " << getTotalKeuntungan() << "\n";
        file << "---------------------------------------------------------------------------\n";
        
        file.close();
        cout << "\n[?] Laporan berhasil disimpan ke " << filename << endl;
    }
    
    int getJumlah() { return jumlah; }
    
    ~LaporanTransaksi() {
        delete[] daftarTransaksi;
    }
};

#endif
